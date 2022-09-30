<?php

namespace Application\Controllers\Post;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\PostRepository;

class DeletePost
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $userRole = new CheckUserRole();

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
        echo $twig->render('delete_post.twig', ['post' => $postRepository->getPost($identifier), 'session' => $_SESSION]);
    }
}
