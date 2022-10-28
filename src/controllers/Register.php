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

        // Redirect user to homepage if already authenticated
        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            header(sprintf('Location: /'));
        }

        // Secure datas before sending them to database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (is_string($_POST['username'])) {
                $username = strip_tags($_POST['username']);
            }

            if (is_string($_POST['email'])) {
                // Check if valid email address
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = strip_tags($_POST['email']);
                }
            }

            if (is_string($_POST['password'])) {
                $password = strip_tags($_POST['password']);
            }

            $role = 'User';

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
