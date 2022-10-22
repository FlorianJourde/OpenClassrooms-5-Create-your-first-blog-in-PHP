<?php

namespace Application\Lib;

class ManageSession
{
    public function execute(): array
    {
        session_start();

        $sessionDuration = 30;

        if(!empty($_SESSION) && $_SESSION['time'] < time() - $sessionDuration * 60){
            session_unset();
            session_destroy();
        }

        return $_SESSION;
    }
}
