<?php

namespace Application\Controllers\Post;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class DeletePost
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);

        $userRole = new CheckUserRole();

        $post->image === null ? $post->image = 'placeholder-min.jpg' : $post->image;
        $post->username = $userRepository->getUserFromId($post->userId)->username;

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
            if ($userRole->isAdmin($_SESSION['role'] ?? 'Guest')) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $success = $postRepository->deletePost($identifier);

                    if ($success) {
                        header(sprintf('Location: index.php?action=archive'));
                    } else {
                        header(sprintf('Location: index.php?action=post&id=%d', $identifier));
                    }
                }
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('delete_post.twig', ['post' => $post, 'session' => $_SESSION]);
    }
}
