<?php

define("Application\\Lib\\Root", $_SERVER['DOCUMENT_ROOT']);
use const Application\Lib\Root;

require_once (Root . "/src/lib/Rooter.php");

use Application\Lib\Rooter;

$rooter = new Rooter();
$rooter->execute();
