<?php

namespace Application\Controllers\Post;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Render;
use Application\Model\PostRepository;

class DeletePost
{
    public function execute(int $identifier)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        if ($_SESSION['role'] != 'Admin') {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        } else {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $success = $postRepository->deletePost($identifier);

                if ($success) {
                    header(sprintf('Location: index.php?action=archive'));
                } else {
                    header(sprintf('Location: index.php?action=post&id=%d', $identifier));
                }
            }
        }

        $twig = new Render();
        echo $twig->render('delete_post.twig', ['post' => $postRepository->getPost($identifier), 'session' => $_SESSION]);
    }
}
