<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/..");

require_once (ROOT . "/src/lib/Rooter.php");

use Application\Lib\Rooter;

$rooter = new Rooter();
$rooter->execute();
