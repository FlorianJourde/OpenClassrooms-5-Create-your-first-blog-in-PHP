<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;
use Exception;

class DeleteComment
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

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->postId);

        // Check if comment author still exists
        if ($userRepository->getUserFromId($comment->userId) !== null) {
            $comment->username = $userRepository->getUserFromId($comment->userId)->username;
        } else {
            $comment->username = 'Compte supprimé';
        }

        // Check if user is authenticated and is comment author or administator
        if (($userRole->isAuthenticated($_SESSION['token'] ?? ''))
        && ($userRole->isAdmin(empty($_SESSION['role']) ? 'Guest' : $_SESSION['role'])
        || $userRole->isCurrentUser($comment->userId, $_SESSION['id'] ?? 0))) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $success = $commentRepository->deleteComment($identifier);

                header(sprintf('Location: /article/%d', $comment->postId));
                if (!$success) {
                    header(sprintf('Location: /article/%d', $comment->postId));
                }
            }
        } else {
            throw new Exception('Vous n\'avez pas accès à cette page !');
        }

        // Render vue with Twig
        $twig = new Vue();
        echo $twig->render('delete_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
