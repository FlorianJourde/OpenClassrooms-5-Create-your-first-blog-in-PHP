<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;
use Exception;

class AddComment
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postId = $_GET['id'];
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

        // Check if a comment have been sent
        if (!empty( $_POST['comment'])) {
            $userId = $_SESSION['id'];
            $comment = $_POST['comment'];
            $status = 0;
        } else {
            throw new Exception('Les données du formulaire sont invalides.');
        }

        $success = $commentRepository->createComment($postId, $comment, $userId, $status);

        if (!$success) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: /article/' . $postId);
        }
    }
}
