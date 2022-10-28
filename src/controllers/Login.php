<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\UserRepository;

class Login
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

        $twig = new Vue();
        echo $twig->render('login.twig');
    }
}
