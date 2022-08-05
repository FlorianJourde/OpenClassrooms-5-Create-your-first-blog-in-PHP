<?php

spl_autoload_register(static function(string $fqcn) {
    // $fqcn contient Domain\Forum\Message
    // remplaçons les \ par des / et ajoutons .php à la fin.
    // on obtient Domain/Forum/Message.php
    $path = str_replace('\\', '/', $fqcn) . '.php';

    // puis chargeons le fichier
    require_once($path);
});

//require_once('Domain/Forum/Message.php');
//require_once('Domain/User/User.php');

use Domain\Forum\Message;
use Domain\User\User;

$user = new User;
$user->name = 'Greg';

$forumMessage = new Message($user, 'J\'aime les pates.');

var_dump($forumMessage);