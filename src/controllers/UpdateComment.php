<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;
use Exception;

class UpdateComment
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
            // It sets the input only when the HTTP method is POST (ie. the form is submitted).
            $input = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }

//            (new UpdateComment())->execute($identifier, $input);
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->postId);
        $userRole = new CheckUserRole();

        // Check if comment author still exists
        if ($userRepository->getUserFromId($comment->userId) !== null) {
            $comment->username = $userRepository->getUserFromId($comment->userId)->username;
        } else {
            $comment->username = 'Compte supprimé';
        }

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')
        && (($userRole->isAdmin($_SESSION['role'] ?? 'Guest')
        || $userRole->isCurrentUser($comment->userId, $_SESSION['id'] ?? 0)))) {
            if ($input !== null) {
                $comment = null;

                if (!empty($input['comment'])) {
                    $comment = $input['comment'];
                } else {
                    throw new Exception('Les données du formulaire sont invalides.');
                }

                $success = $commentRepository->updateComment($identifier, $comment);
                $comment = $commentRepository->getComment($identifier);

                if (!$success) {
                    throw new Exception('Impossible de modifier le commentaire !');
                }
                if ($comment->postId === null) {
                    throw new Exception('Le commentaire concerné n\'existe pas !');
                }

                header(sprintf('Location: /article/%d', $comment->postId));
            }

            if ($comment === null) {
                throw new Exception("Le commentaire $identifier n'existe pas.");
            }
        } else {
            throw new Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Vue();
        echo $twig->render('update_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
