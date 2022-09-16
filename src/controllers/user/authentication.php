<?php

namespace Application\Controllers\User;

require_once('src/lib/database.php');
require_once('src/model/UserRepository.php');

use Application\Lib\Database\DatabaseConnection;
//use Application\Model\CommentRepository;
use Application\Model\UserRepository;

class UserAuthentication
{
    public function execute(string $email, string $password)
    {
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $success = $userRepository->login($email, $password);

        if ($success === null) {
            throw new \Exception('Authentification impossible !');
        } else {
            header('Location: index.php');
        }
    }
}
