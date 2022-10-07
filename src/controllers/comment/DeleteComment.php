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
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $comment = $commentRepository->getComment($identifier);
        $post = $postRepository->getPost($comment->postId);

        $userRole = new CheckUserRole();
        $comment->username = $userRepository->getUserFromId($post->userId)->username;

//        var_dump($comment);
//        die();

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin(empty($_SESSION['role']) ?? 'Guest') || $userRole->isCurrentUser($comment->userId, $_SESSION['id'] ?? 0)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//                    var_dump($comment->postId);
//                    die();
                    $success = $commentRepository->deleteComment($identifier);


                    header(sprintf('Location: index.php?action=post&id=%d', $comment->postId));
                    if (!$success) {

                        header(sprintf('Location: index.php?action=post&id=%d', $comment->postId));
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
