<?php

namespace Application\Controllers;

require_once('src/model/User.php');
require_once('src/model/UserRepository.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\UserRepository;

class Login
{
    public function execute()
    {
        session_start();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('login.twig'/*, ['users' => $userRepository->getUsers()]*/);
//        echo $twig->render('login.twig');
    }
}