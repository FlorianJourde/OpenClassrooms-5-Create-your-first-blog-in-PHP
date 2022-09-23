<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/lib/database.php';
require_once __ROOT__ . '/src/model/Post.php';
require_once __ROOT__ . '/src/model/PostRepository.php';
require_once __ROOT__ . '/vendor/autoload.php';
//require_once __ROOT__ . '/ressources/css/main.css';

use Application\Lib\Database\DatabaseConnection;
use Application\Model\PostRepository;

class Homepage
{
    public function execute()
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $loader = new \Twig\Loader\FilesystemLoader(__ROOT__ . '/templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('home.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);
    }
}
