<?php

namespace Application\Controllers\Comment;

require_once('src/lib/database.php');
require_once('src/model/CommentRepository.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class DeleteComment
{
    public function execute(string $identifier)
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

            $loader = new \Twig\Loader\FilesystemLoader('templates');
            $twig = new \Twig\Environment($loader, [
    //            'cache' => 'cache',
                'debug' => true
            ]);

            $twig->addExtension(new \Twig\Extension\DebugExtension());

            echo $twig->render('delete_comment.twig', ['comment' => $commentRepository->getComment($identifier), 'post' => $postRepository->getPost($comment->post), 'session' => $_SESSION]);
    }
}
