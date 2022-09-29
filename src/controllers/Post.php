<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class Post
{
    public function execute(int $identifier)
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $post = $postRepository->getPost($identifier);
        $user = $userRepository->getUserFromId($post->user_id);
        $post->username = $user->username;
        $comments = $commentRepository->getComments($identifier);

        foreach ($comments as $comment) {
            $user = $userRepository->getUserFromId($comment->user_id);
            $comment->username = $user->username;
        }

//        var_dump($comments);

        $twig = new Render();
        echo $twig->render('post.twig', ['post' => $post, 'comments' => $comments, 'session' => $_SESSION]);
    }
}
