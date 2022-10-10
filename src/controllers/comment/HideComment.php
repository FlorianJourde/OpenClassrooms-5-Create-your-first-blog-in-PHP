<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class HideComment
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $userRole = new CheckUserRole();
        $success = false;

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role']) ?? 'Guest') {
                $comment = $commentRepository->getComment($identifier);
                $postId = $comment->postId;
                $success = $commentRepository->hideComment($identifier);
            }
        } else {
            throw new \Exception('Vous ne pouvez pas masquer ce commentaire !');
        }

        if (!$success) {
            throw new \Exception('Impossible de masquer le commentaire !');
        } else {
            header('Location: ?action=post&id=' . $postId);
        }
    }
}
