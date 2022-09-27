<?php

namespace Application\Model;

use Application\Lib\Database\DatabaseConnection;

require_once __ROOT__ . '/src/lib/database.php';
require_once __ROOT__ . '/src/controllers/post.php';

class UserRepository
{
    public  DatabaseConnection $connection;

    private function fetchUser($row): User
    {
        $user = new User();
        $user->identifier = $row['id'];
        $user->username = $row['username'];
        $user->email = $row['email'];
        $user->role = $row['role'];
        $user->password = $row['password'];

        return $user;
    }

    public function getUserFromId(int $identifier): ?User
    {
        if (!is_int($identifier)) { return false; }

        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, role, password FROM users WHERE id = ?"
        );

        $statement->execute([$identifier]);
        $row = $statement->fetch();

        return $this->fetchUser($row);
    }

    public function getUserFromEmail(string $email): User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, role, password FROM users WHERE email = ?"
        );

        $statement->execute([$email]);
        $row = $statement->fetch();

        return $this->fetchUser($row);
    }

    public function getUsers(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, username, email, role, password FROM users"
        );

        $users = [];

        while (($row = $statement->fetch())) {
            $this->fetchUser($row);
            $users[] = $this->fetchUser($row);
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
            "SELECT id, email, password, username FROM users WHERE email = ? AND password = ?"
        );

        $statement->execute([$email, $password]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $user = new User();
        $user->email = $row['email'];

        return $user;
    }
}
