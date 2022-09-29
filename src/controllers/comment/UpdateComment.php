<?php

namespace Application\Controllers\Comment;

use Application\Lib\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class UpdateComment
{
    public function execute(int $identifier, ?array $input)
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->post);

        if ($_SESSION['role'] === 'Admin' || $_SESSION['id'] === $comment->user_id) {
            if ($input !== null) {
                $comment = null;

                if (!empty($input['comment'])) {
                    $comment = $input['comment'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

                $success = $commentRepository->updateComment($identifier, $comment);
                $comment = $commentRepository->getComment($identifier);

                if (!$success) {
                    throw new \Exception('Impossible de modifier le commentaire !');
                }
                if ($comment->post === null) {
                    throw new \Exception('Le commentaire concerné n\'existe pas !');
                }

                header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
            }

            if ($comment === null) {
                throw new \Exception("Le commentaire $identifier n'existe pas.");
            }

        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Render();
        echo $twig->render('update_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
