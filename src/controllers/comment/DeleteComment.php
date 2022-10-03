<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

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
        $post = $postRepository->getPost($comment->post_id);

        $userRole = new CheckUserRole();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin(empty($_SESSION['role']) ?? 'Guest') || $userRole->isCurrentUser($comment->user_id, $_SESSION['id'] ?? 0)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $success = $commentRepository->deleteComment($identifier);

                    header(sprintf('Location: index.php?action=post&id=%d', $comment->post_id));
                    if (!$success) {

                        header(sprintf('Location: index.php?action=post&id=%d', $comment->post_id));
                    }
                }
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('delete_comment.twig', ['comment' => $comment, 'post' => $post, 'session' => $_SESSION]);
    }
}
