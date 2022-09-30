<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\UserRepository;

class Register
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $twig = new RenderFront();
        echo $twig->render('register.twig', ['users' => $userRepository->getUsers()]);
    }
}
