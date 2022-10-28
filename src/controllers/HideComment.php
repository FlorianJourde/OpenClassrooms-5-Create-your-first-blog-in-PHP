<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Exception;

class HideComment
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];

//            (new HideComment())->execute($identifier);
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $userRole = new CheckUserRole();
        $success = false;

        // Check if user is authenticated and administator
        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role']) ?? 'Guest') {
                $comment = $commentRepository->getComment($identifier);
                $postId = $comment->postId;
                $success = $commentRepository->hideComment($identifier);
            }
        } else {
            throw new Exception('Vous ne pouvez pas masquer ce commentaire !');
        }

        if (!$success) {
            throw new Exception('Impossible de masquer le commentaire !');
        } else {
            header('Location: /article/' . $postId);
        }
    }
}
