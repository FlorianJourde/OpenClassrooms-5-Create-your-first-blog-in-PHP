<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/lib/database.php';
require_once __ROOT__ . '/src/model/Post.php';
require_once __ROOT__ . '/src/model/PostRepository.php';
//require_once('vendor/autoload.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\PostRepository;

class Archive
{
    public function execute()
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $twig = new Render();
        echo $twig->render('archive.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);

//        echo $twig->render('archive.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);
    }
}
