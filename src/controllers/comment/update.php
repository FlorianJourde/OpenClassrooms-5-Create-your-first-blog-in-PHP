<?php

namespace Application\Controllers\Comment\Update;

require_once('src/lib/database.php');
require_once('src/model/comment_repository.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class UpdateComment
{
    public function execute(string $identifier, ?array $input)
    {
        // It handles the form submission when there is an input.
        if ($input !== null) {
//            $author = null;
            $comment = null;
//            var_dump($identifier, $input);
//            die();

            if (!empty($input['comment'])) {
//                $author = $input['author'];
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
                throw new \Exception('L\'article concérné n\'existe pas !');
            }
//            sprintf('Location: index.php?action=post&id=%d', $comment->post);
//            var_dump(sprintf('Location: index.php?action=post&id=%d', $comment->post));
//            die();
//            header('Location: index.php?action=post&id=' . $comment->post);
            header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
        }

        // Otherwise, it displays the form.
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);
        if ($comment === null) {
            throw new \Exception("Le commentaire $identifier n'existe pas.");
        }

//        require('templates/update_comment.php');

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('update_comment.twig', ['comment' => $commentRepository->getComment($identifier), 'post' => $postRepository->getPost($comment->post)]);
    }
}
