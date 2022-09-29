<?php

namespace Application\Controllers\Comment;

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class UpdateComment
{
    public function execute(int $identifier, ?array $input)
    {
        session_start();

        if ($_SESSION['role'] != 'Admin') {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        } else {
            if ($input !== null) {
                $author = null;
                $comment = null;

                if (!empty($input['comment'])) {
                    $author = $input['author'];
                    $comment = $input['comment'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

                $commentRepository = new CommentRepository();
                $commentRepository->connection = new DatabaseConnection();
                $success = $commentRepository->updateComment($identifier, $comment);
                $comment = $commentRepository->getComment($identifier);

                if (!$success) {
                    throw new \Exception('Impossible de modifier le commentaire !');
                }
                if ($comment->post === null) {
                    throw new \Exception('L\'article concerné n\'existe pas !');
                }

                header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
            }

            $commentRepository = new CommentRepository();
            $commentRepository->connection = new DatabaseConnection();
            $comment = $commentRepository->getComment($identifier);
            if ($comment === null) {
                throw new \Exception("Le commentaire $identifier n'existe pas.");
            }

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();

            $twig = new Render();
            echo $twig->render('update_comment.twig', ['comment' => $commentRepository->getComment($identifier), 'post' => $postRepository->getPost($comment->post), 'session' => $_SESSION]);
        }
    }
}
