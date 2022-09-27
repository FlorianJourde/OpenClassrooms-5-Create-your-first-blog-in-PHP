<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/lib/database.php';
require_once __ROOT__ . '/src/model/Comment.php';
require_once __ROOT__ . '/src/model/CommentRepository.php';
//require_once __ROOT__ . '/src/model/Post.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\Comment;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class Post
{
    public function execute(int $identifier)
    {
        session_start();

        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;

        $twig = new Render();
        echo $twig->render('post.twig', ['post' => $postRepository->getPost($identifier), 'comments' => $commentRepository->getComments($identifier), 'session' => $_SESSION]);
    }
}
