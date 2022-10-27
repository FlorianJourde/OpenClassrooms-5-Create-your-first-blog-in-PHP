<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class ManageComments
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

        $userRole = new CheckUserRole();

        if (($userRole->isAuthenticated($_SESSION['token'] ?? ''))
        && ($userRole->isAdmin($_SESSION['role']) ?? 'Guest')) {
                $hiddenComments = $commentRepository->getHiddenComments();
                $posts = [];

                foreach ($hiddenComments as $comment) {
                    if ($userRepository->getUserFromId($comment->userId) !== null) {
                        $comment->username = $userRepository->getUserFromId($comment->userId)->username;
                    } else {
                        $comment->username = 'Compte supprimé';
                    }

                    $comment->post = $postRepository->getPost($comment->postId);

                    if (!in_array($comment->post, $posts)) {
                        $posts[] = $comment->post;
                    }
                }

                rsort($posts);

                foreach ($posts as $post) {
                    $post->hiddenComments = $commentRepository->getHiddenCommentsFromId($post->identifier);
                    $post->username = $userRepository->getUserFromId($post->userId)->username;
                    
                    foreach ($post->hiddenComments as $hiddenComment) {
                        if ($userRepository->getUserFromId($hiddenComment->userId) !== null) {
                            $hiddenComment->username = $userRepository->getUserFromId($hiddenComment->userId)->username;
                        } else {
                            $hiddenComment->username = 'Compte supprimé';
                        }
                    }
                }
            } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Vue();
        echo $twig->render('manage_comments.twig', ['posts' => $posts, 'session' => $_SESSION]);
    }
}
