<?php

namespace Application\Controllers\Comment;

use Application\Lib\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class DeleteComment
{
    public function execute(int $identifier)
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);

        if ($_SESSION['role'] != 'Admin') {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        } else {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $success = $commentRepository->deleteComment($identifier);

                header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
                if (!$success) {

                    header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
                }
            }
        }

        $twig = new Render();
        echo $twig->render('delete_comment.twig', ['comment' => $commentRepository->getComment($identifier), 'post' => $postRepository->getPost($comment->post), 'session' => $_SESSION]);
    }
}
