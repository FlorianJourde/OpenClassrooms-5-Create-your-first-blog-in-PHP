<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\UserRepository;
use DateTimeImmutable;

class AuthenticationUser
{
    public function execute()
    {
        session_start();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        // Secure datas before sending them to database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (is_string($_POST['email'])) {
                // Check if valid email address
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = strip_tags($_POST['email']);
                }
            }

            if (is_string($_POST['password'])) {
                $password = strip_tags($_POST['password']);
            }
        }

        $success = $userRepository->login($email, $password);

        if ($success === null) {
            throw new \Exception('Authentification impossible !');
            header('Location: /connexion');
        } else {
            $user = $userRepository->getUserFromEmail($email);
            $_SESSION['is_authenticated'] = true;
            $_SESSION['id'] = $user->identifier;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['role'] = $user->role;
            $_SESSION['time'] = time();
            $now = new DateTimeImmutable();
            $_SESSION['last_authentication'] = $now->format('d/m/Y à H:i:s');
            $_SESSION['token'] = bin2hex(random_bytes(16));
            $userRepository->setToken($_SESSION['token'], $_SESSION['last_authentication'], $user->identifier);

            header('Location: /');
        }
    }
}
