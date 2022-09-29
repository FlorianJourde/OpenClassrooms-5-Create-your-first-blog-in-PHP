<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
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
    }
}
