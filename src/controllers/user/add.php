<?php

namespace Application\Controllers\User;

require_once __ROOT__ . '/src/lib/database.php';
require_once __ROOT__ . '/src/model/UserRepository.php';

use Application\Lib\Database\DatabaseConnection;
//use Application\Model\CommentRepository;
use Application\Model\UserRepository;

class AddUser
{
    public function execute(string $username, string $email, string $role, string $password)
    {
        session_start();

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
