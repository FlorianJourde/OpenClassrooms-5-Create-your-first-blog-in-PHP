<?php

namespace Application\Controllers\Comment;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;

class AddComment
{
    public function execute(int $postId, array $input, int $userId, bool $status)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userId = null;
        $comment = null;

        if (!empty($input['comment'])) {
            $userId = $_SESSION['id'];
            $comment = $input['comment'];
            $status = 0;
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }
        
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($postId, $comment, $userId, $status);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: ?action=post&id=' . $postId);
        }
    }
}
