<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\UserRepository;

class Register
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $userRole = new CheckUserRole();

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            header(sprintf('Location: /'));
        }

        if (!empty( $_POST)) {
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

        $twig = new Vue();
        echo $twig->render('register.twig', ['users' => $userRepository->getUsers()]);
    }
}
