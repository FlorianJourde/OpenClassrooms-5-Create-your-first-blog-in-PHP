<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Model\UserRepository;

class LogoutUser
{
    public function execute()
    {
        session_start();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        // Empty token and last action to null in database
        $userRepository->setToken(null, $_SESSION['last_authentication'], $_SESSION['id']);
        $userRepository->setLastAction(null, $_SESSION['id']);

        // Disconnect user, remove session
        session_unset();
        session_destroy();

        header('Location: /');
    }
}
