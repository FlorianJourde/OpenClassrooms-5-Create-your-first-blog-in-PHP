<?php

namespace Application\Lib;

class RenderFront
{
    public function render(string $string, array $array = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__ROOT__ . '/templates');
        $twig = new \Twig\Environment($loader, [
            //            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        return $twig->render($string, $array);
    }
}
