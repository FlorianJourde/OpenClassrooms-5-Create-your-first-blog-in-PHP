<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class ManageComments
{
    public function execute(/* int $identifier */)
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

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role']) ?? 'Guest') {

                $hiddenComments = $commentRepository->getHiddenComments();

                $posts = [];

                foreach ($hiddenComments as $comment) {
                    $comment->username = $userRepository->getUserFromId($comment->userId)->username;
                    $comment->post = $postRepository->getPost($comment->postId);

                    if (!in_array($comment->post, $posts)) {
                        $posts[] = $comment->post;
                    }
                }

                foreach ($posts as $post) {
                    $post->hiddenComments = $commentRepository->getHiddenCommentsFromId($post->identifier);
                    $post->username = $userRepository->getUserFromId($post->userId)->username;
                    
                    foreach ($post->hiddenComments as $hiddenComment) {
                        $hiddenComment->username = $userRepository->getUserFromId($hiddenComment->userId)->username;
                    }
                }
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('manage_comments.twig', ['posts' => $posts, 'session' => $_SESSION]);
    }
}
