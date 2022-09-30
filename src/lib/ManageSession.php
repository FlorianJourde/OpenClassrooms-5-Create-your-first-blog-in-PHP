<?php

namespace Application\Lib;

class ManageSession
{
    public function execute(): array
    {
        session_start();

        if(!empty($_SESSION) && $_SESSION['timeout'] < time() - 30 * 60){
            session_unset();
            session_destroy();
        }

        return $_SESSION;
    }
}
