<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        $users = $this->um->getAllUsers();
        // get all the users from the manager
        
        $this->render($users);
        // render
    }

    public function getUser(string $get)
    {
        $id = intval($get);
        $user = $this->um->getUserById($id);
        // get the user from the manager
        // either by email or by id
        
        $this->render(['user' =>$user]);
        // render
    }

    public function createUser(array $post)
    {
        $newUser = new User($post['username'], $post['first_name'], $post['last_name'], $post['email']);
        $createdUser = $this->um->createUser($newUser);
        // create the user in the manager

        $this->render(['createdUser' =>$createdUser]);
        // render the created user
    }

    public function updateUser(array $post)
    {
        $userToUpdate = new User($post['username'], $post['first_name'], $post['last_name'], $post['email']);
        $updatedUser = $this->um->updateUser($userToUpdate);
        // update the user in the manager

        $this->render(['updatedUser' =>$updatedUser]);
        // render the updated user
    }

    public function deleteUser(array $post)
    {
        $userToDelete = new User($post['username'], $post['first_name'], $post['last_name'], $post['email']);
        $deletedUser = $this->um->deleteUser($userToDelete);
        // delete the user in the manager

        $this->render($deletedUser);
        // render the list of all users
    }
}