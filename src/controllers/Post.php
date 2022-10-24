<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;
use Exception;

class Post
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

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

        $twig = new Vue();
        echo $twig->render('post.twig', ['post' => $post, 'comments' => array_reverse($visibleComments), 'session' => $_SESSION]);
    }
}
