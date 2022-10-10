<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
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

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            header(sprintf('Location: /'));
        }

        $twig = new RenderFront();
        echo $twig->render('login.twig');
    }
}
