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

    public function getUser(array $get)
    {
        $user = $this->um->getUserById();
        // get the user from the manager
        // either by email or by id
        
        $this->render(['user' =>$user]);
        // render
    }

    public function createUser(array $post)
    {
        $createdUser = $this->um->createUser();
        // create the user in the manager

        $this->render(['createdUser' =>$createdUser]);
        // render the created user
    }

    public function updateUser(array $post)
    {
        $updatedUser = $this->um->updateUser();
        // update the user in the manager

        $this->render(['updatedUser' =>$updatedUser]);
        // render the updated user
    }

    public function deleteUser(array $post)
    {
        $deletedUser = $this->um->deleteUser();
        // delete the user in the manager

        $this->render($deletedUser);
        // render the list of all users
    }
}