<?php

require 'vendor/autoload.php';
//require 'App/Helper/form.php';

use \Michelf\Markdown;

echo App\Helper\Form::input();

echo Markdown::defaultTransform('Bonjour, j\'essaie le **markdown**');

?>
