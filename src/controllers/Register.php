<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\UserRepository;

class Register
{
    public function execute()
    {
        session_start();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $twig = new Render();
        echo $twig->render('register.twig', ['users' => $userRepository->getUsers()]);
    }
}