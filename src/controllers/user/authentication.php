<?php

namespace Application\Controllers\User;

require_once('src/lib/database.php');
require_once('src/model/UserRepository.php');

use Application\Lib\Database\DatabaseConnection;
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
            header('Location: index.php?action=login');
        } else {
            $user = $userRepository->getUserFromEmail($email);
            $_SESSION['is_authenticated'] = true;
            $_SESSION['id'] = $user->identifier;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['role'] = $user->role;
            header('Location: index.php');
        }
    }
}
