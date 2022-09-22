<?php

namespace Application\Controllers;

require_once('src/lib/database.php');
require_once('src/model/Post.php');
require_once('src/model/PostRepository.php');
require_once('vendor/autoload.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\PostRepository;

class Homepage
{
    public function execute()
    {
        session_start();
        var_dump($_SESSION);

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $_SESSION['allow_access'] = true;

        echo $twig->render('home.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);
    }
}
