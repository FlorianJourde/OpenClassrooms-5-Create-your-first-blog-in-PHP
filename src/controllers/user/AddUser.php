<?php

namespace Application\Controllers\User;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\UserRepository;

class AddUser
{
    public function execute(string $username, string $email, string $role, string $password)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $success = $userRepository->createUser($username, $email, $role, $password);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter l\'utilisateur !');
        } else {
            header('Location: index.php');
        }
    }
}
