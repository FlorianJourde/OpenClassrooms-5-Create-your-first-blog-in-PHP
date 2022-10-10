<?php

namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Model\UserRepository;

class AuthenticationUser
{
    public function execute(string $email, string $password)
    {
        session_start();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $success = $userRepository->login($email, $password);

        if ($success === null) {
            throw new \Exception('Authentification impossible !');
            header('Location: ?action=login');
        } else {
            $user = $userRepository->getUserFromEmail($email);
            $_SESSION['is_authenticated'] = true;
            $_SESSION['id'] = $user->identifier;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['role'] = $user->role;
            $_SESSION['timeout'] = time();
            $_SESSION['token'] = bin2hex(random_bytes(16));
            $userRepository->generateToken($_SESSION['token'], $user->identifier);

            header('Location: /');
        }
    }
}
