<?php

namespace Application\Model;

use Application\Lib\DatabaseConnection;

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
//        $user->password = $row['password'];

        return $user;
    }

    public function getUserFromId(int $identifier): ?User
    {
        if (!is_int($identifier)) { return null; }

        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, email, role/*, password*/ FROM users WHERE id = ?"
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

        $affectedLines = $statement->execute([$username, $email, $role, MD5($password)]);

        return ($affectedLines > 0);
    }

    public function login(string $email, string $password): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, email, password, username, token FROM users WHERE email = ? AND password = ?"
        );

        $statement->execute([$email, MD5($password)]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        $user = new User();
        $user->email = $row['email'];

        return $user;
    }

    public function generateToken(string $token, string $lastAuthentication, $identifer): string
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE users set token = ?, last_authentication = ? WHERE id = ?"
        );

        $affectedLines = $statement->execute([$token, $lastAuthentication, $identifer]);

        return ($affectedLines > 0);
    }

    public function checkToken($token): ?User
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id FROM users WHERE token = ?"
        );

        $affectedLines = $statement->execute([$token]);

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        return new User();
    }

    public function deleteToken(string $identifer): string
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE users set token = null, last_authentication = null WHERE id = ?"
        );

        $affectedLines = $statement->execute([$identifer]);

        return ($affectedLines > 0);
    }
}
