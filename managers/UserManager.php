<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $users;
        // get all the users from the database
    }

    public function getUserById(int $id) : User
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        
        $parameters = [
        'id' => $id
        ];
        
        $query->execute($parameters);
        
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUser = new User($user['id'], $user['username'], $user['first_name'], $user['last_name'], $user['email']);
        
        return $newUser;
    }

    public function createUser(User $user) : User
    {
        $query = $this->db->prepare('INSERT INTO users VALUES(:id, :username, :first_name, :last_name, :email)');
        
        $parameters = [
        'id' => null,
        'username' => $user->getUsername(),
        'first_name' => $user->getFirstName(),
        'last_name' => $user->getLastName(),
        'email' => $user->getEmail()
        ];
        
        $query->execute($parameters);
        
        $id = $this->db->LastInsertId();
        $user->setId($id);
        // create the user from the database
        
        $newUser = $query->fetch(PDO::FETCH_ASSOC);
        return getUserById($id);
        // return it with its id
    }

    public function updateUser(User $user) : User
    {
        $query = $this->db->prepare('UPDATE users SET username = :newUsername, first_name = :newFirst_name, last_name = :newLast_name, email = :newEmail WHERE id = :id');
        
        $parameters = [
        'id' => $user->getId(),
        'newUsername' => $user->getUsername(),
        'newFirst_name'=> $user->getFirstName,
        'newLast_name' => $user->getLastName(),
        'newEmail' => $user->getEmail()
        ];
        
        $query->execute($parameters);
        // update the user in the database
        
        $newUser = $query->fetch(PDO::FETCH_ASSOC);
        return $newUser;
        // return it
    }

    public function deleteUser(User $user) : array
    {
        $query = $this->db->prepare('DELETE from users WHERE id = :id');
        
        $parameters = [
        'id' => $user->getId()
        ];
        
        $query->execute($parameters);
        // delete the user from the database

        $this->getAllUsers();
        // return the full list of users
    }
}