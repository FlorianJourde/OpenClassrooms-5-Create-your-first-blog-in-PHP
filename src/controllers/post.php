<?php

namespace Application\Controllers;

require_once('src/lib/database.php');
require_once('src/model/Comment.php');
require_once('src/model/CommentRepository.php');
require_once('src/model/Post.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class Post
{
    public function execute(string $identifier)
    {
        session_start();
        var_dump($_SESSION);

        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('post.twig', ['post' => $postRepository->getPost($identifier), 'comments' => $commentRepository->getComments($identifier), 'session' => $_SESSION]);
    }
}
