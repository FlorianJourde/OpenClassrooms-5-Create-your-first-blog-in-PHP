<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class ShowComment
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
                $success = $commentRepository->showComment($identifier);
            }
        } else {
            throw new \Exception('Vous ne pouvez pas afficher ce commentaire !');
        }

        if (!$success) {
            throw new \Exception('Impossible d\'afficher le commentaire !');
        } else {
            header('Location: ?action=manageComments');
        }
    }
}
