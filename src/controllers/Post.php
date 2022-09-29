<?php

namespace Application\Controllers;

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class Post
{
    public function execute(int $identifier)
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $twig = new Render();
        echo $twig->render('post.twig', ['post' => $postRepository->getPost($identifier), 'comments' => $commentRepository->getComments($identifier), 'session' => $_SESSION]);
    }
}
