<?php

namespace Application\Controllers\Post;

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/comment_repository.php');
require_once('src/model/post.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\Comment;
use Application\Model\CommentRepository\CommentRepository;
use Application\Model\PostRepository\PostRepository;

class Post
{
    public function execute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
//        $post = $postRepository->getPost($identifier);

//        $comment = new Comment();
//        $comment->connection = $connection;

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;
//        var_dump($commentRepository->getComments($identifier));
//        $comments = $commentRepository->getComments($identifier);

//        require('templates/post.php');

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('post.twig', ['post' => $postRepository->getPost($identifier), 'comments' => $commentRepository->getComments($identifier)]);
    }
}
