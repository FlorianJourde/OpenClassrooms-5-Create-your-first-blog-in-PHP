<?php

namespace Application\Model;

use Application\Lib\Database\DatabaseConnection;
//use Application\Model\User;

require_once ('src/lib/database.php');
require_once ('src/controllers/post.php');

class UserRepository
{
    public  DatabaseConnection $connection;

    public function getUser(string $identifier): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, role, password FROM users WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $user = new User();
        $user->identifier = $row['id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->role = $row['role'];
        $user->password = $row['password'];

        return $user;
    }

    public function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, username, email, role, password FROM users"
        );
        $users = [];

        while (($row = $statement->fetch())) {
            $user = new User();
            $user->identifier = $row['id'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->role = $row['role'];
            $user->password = $row['password'];

            $users[] = $user;
        }

        return $users;
    }

    public function createUser(string $username, string $email, string $role, string $password): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO users(username, email, role, password) VALUES(?, ?, ?, ?)"
        );

        $affectedLines = $statement->execute([$username, $email, $role, $password]);

        return ($affectedLines > 0);
    }

    public function login(string $email, string $password): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT email, password FROM users WHERE email = ? AND password = ?"
        );

        $statement->execute([$email, $password]);

//        var_dump($statement->fetch());

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

//        $row = $statement->fetch();
        $user = new User();
        $user->email = $row['email'];
        $user->password = $row['password'];

//        var_dump($user);
//        die();

        return $user;

//        var_dump($affectedLines);
//        die();

//        return ($affectedLines > 0);
    }
}
