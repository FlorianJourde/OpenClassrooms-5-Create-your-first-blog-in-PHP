<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/model/User.php';
require_once __ROOT__ . '/src/model/UserRepository.php';

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