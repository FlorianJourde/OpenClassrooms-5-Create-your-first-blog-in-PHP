<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class UpdateComment
{
    public function execute(int $identifier, ?array $input)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->post);

        $userRole = new CheckUserRole();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role'] ?? 'Guest') || $userRole->isCurrentUser($comment->user_id, $_SESSION['id'] ?? 0)) {
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
        }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('update_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
