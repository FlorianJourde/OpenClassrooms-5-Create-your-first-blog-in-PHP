<?php

namespace Application\Controllers;

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\UserRepository;

class Login
{
    public function execute()
    {
        session_start();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $twig = new Render();
        echo $twig->render('login.twig');
    }
}