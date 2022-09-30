<?php

namespace Application\Controllers\Comment;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Model\CommentRepository;

class AddComment
{
    public function execute(string $post, array $input, int $user_id, bool $status)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $author = null;
        $comment = null;

        if (!empty($input['comment'])) {
            $user_id = $_SESSION['id'];
//            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $comment, $user_id, $status);

        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
