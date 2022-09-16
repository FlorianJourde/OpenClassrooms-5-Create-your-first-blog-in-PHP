<?php

namespace Application\Controllers\Comment;

require_once('src/lib/database.php');
require_once('src/model/CommentRepository.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class UpdateComment
{
    public function execute(string $identifier, ?array $input)
    {
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
                throw new \Exception('L\'article concérné n\'existe pas !');
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
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('update_comment.twig', ['comment' => $commentRepository->getComment($identifier), 'post' => $postRepository->getPost($comment->post)]);
    }
}
