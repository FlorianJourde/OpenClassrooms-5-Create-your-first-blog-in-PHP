<?php

namespace Application\Lib;

class Vue
{
    public function render(string $string, array $array = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader, [
            //            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        return $twig->render($string, $array);
    }
}
