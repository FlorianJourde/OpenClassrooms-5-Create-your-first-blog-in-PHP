<?php

define("Application\\Lib\\Root", $_SERVER['DOCUMENT_ROOT']);

require_once '../src/lib/Rooter.php';

use Application\Lib\Rooter;

$rooter = new Rooter();
$rooter->execute();
