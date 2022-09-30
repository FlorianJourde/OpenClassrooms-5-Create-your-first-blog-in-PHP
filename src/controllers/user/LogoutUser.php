<?php

namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Model\UserRepository;

class LogoutUser
{
    public function execute()
    {
        session_start();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $userRepository->deleteToken($_SESSION['id']);

        session_unset();
        session_destroy();

        header('Location: index.php');
    }
}
