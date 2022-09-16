<?php

namespace Application\Model;

require_once ('src/lib/database.php');

class User
{
    public string $identifier;
    public string $username;
    public string $email;
    public string $role;
    public string $password;
}
