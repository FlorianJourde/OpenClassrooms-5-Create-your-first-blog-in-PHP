<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Render;
use Application\Model\UserRepository;

class Register
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $twig = new Render();
        echo $twig->render('register.twig', ['users' => $userRepository->getUsers()]);
    }
}
