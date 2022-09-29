<?php

namespace Application\Controllers\User;

class LogoutUser
{
    public function execute()
    {
        session_start();
        session_destroy();

        header('Location: index.php');
    }
}
