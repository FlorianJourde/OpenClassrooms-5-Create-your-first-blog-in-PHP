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
            $_SESSION['is_authenticated'] = true;
            $user = $userRepository->getUserFromEmail($email);
            $_SESSION['username'] = $user->username;
            header('Location: index.php');
        }
    }
}
