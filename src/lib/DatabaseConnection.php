<?php

namespace Application\Lib;

use PDO;

class DatabaseConnection
{
    public ?PDO $database = null;

    public function getConnection(): PDO
    {
        if ($this->database === null) {
            $dotenv = new DotEnv(dirname(__DIR__, 2) . '/.env');
            $dotenv->load();

            $host = $_ENV['DATABASE_HOST'];
            $dbname = $_ENV['DATABASE_NAME'];
            $charset = $_ENV['DATABASE_CHARSET'];
            $user = $_ENV['DATABASE_USER'];
            $password = $_ENV['DATABASE_PASSWORD'];

            $this->database = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $user,
                $password
            );

            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $this->database;
    }
}