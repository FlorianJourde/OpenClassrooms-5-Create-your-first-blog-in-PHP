<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Exception;

class ShowComment
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $userRole = new CheckUserRole();
        $success = false;

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role']) ?? 'Guest') {
                $success = $commentRepository->showComment($identifier);
            }
        } else {
            throw new Exception('Vous ne pouvez pas afficher ce commentaire !');
        }

        if (!$success) {
            throw new Exception('Impossible d\'afficher le commentaire !');
        } else {
            header('Location: ?action=manageComments');
        }
    }
}
