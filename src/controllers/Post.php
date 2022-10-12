<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class Post
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $post = $postRepository->getPost($identifier);
        $user = $userRepository->getUserFromId($post->userId);
        $post->username = $user->username;
        $comments = $commentRepository->getComments($identifier);
        $visibleComments = [];
        $post->image === null ? $post->image = 'placeholder-min.jpg' : $post->image;

        foreach ($comments as $comment) {
            if($comment->status === true) {
                $user = $userRepository->getUserFromId($comment->userId);
                $comment->username = $user->username;
                $visibleComments[] = $comment;
            }
        }

        $twig = new RenderFront();
        echo $twig->render('post.twig', ['post' => $post, 'comments' => array_reverse($visibleComments), 'session' => $_SESSION]);
    }
}
