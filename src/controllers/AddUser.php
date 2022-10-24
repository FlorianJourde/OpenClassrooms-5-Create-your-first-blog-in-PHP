<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\UserRepository;

class AddUser
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = 'User';
        $password = $_POST['password'];

        $success = $userRepository->createUser($username, $email, $role, $password);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter l\'utilisateur !');
        } else {
            header('Location: /');
        }
    }
}
