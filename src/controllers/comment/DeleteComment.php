<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;

class DeleteComment
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->post);
        $user_id = $comment->user_id;

        $userRole = new CheckUserRole();

        if (empty($_SESSION['role'])) {
            $user_role = 'Guest';
            $current_user_id = 0;
        } else {
            $user_role = $_SESSION['role'];
            $current_user_id = $_SESSION['id'];
        }

        if ($userRole->isAdmin($user_role) || $userRole->isCurrentUser($user_id, $current_user_id)) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $success = $commentRepository->deleteComment($identifier);

                header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
                if (!$success) {

                    header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
                }
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('delete_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
