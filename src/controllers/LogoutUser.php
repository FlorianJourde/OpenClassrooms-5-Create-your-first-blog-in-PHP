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

        $userRepository->setToken(null, $_SESSION['last_authentication'], $_SESSION['id']);
        $userRepository->setLastAction(null, $_SESSION['id']);

        session_unset();
        session_destroy();

        header('Location: /');
    }
}
