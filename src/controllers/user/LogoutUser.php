<?php

namespace Application\Controllers\User;

class LogoutUser
{
    public function execute()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: index.php');
    }
}
