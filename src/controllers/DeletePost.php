<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\PostRepository;
use Application\Model\UserRepository;
use Exception;

class DeletePost
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $userRole = new CheckUserRole();

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
        } else {
            throw new Exception('Aucun identifiant d\'article envoyé');
        }

        $post = $postRepository->getPost($identifier);

        $post->image === null ? $post->image = 'placeholder-min.jpg' : $post->image;
        $post->username = $userRepository->getUserFromId($post->userId)->username;

        // Check if user is authenticated and administator
        if ($userRole->isAuthenticated($_SESSION['token'] ?? '') && $userRole->isAdmin($_SESSION['role'] ?? 'Guest')) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $success = $postRepository->deletePost($identifier);

                if ($success) {
                    if ($post->image !== 'placeholder-min.jpg') {
                        unlink(ROOT . '/public/ressources/images/posts/' . $post->image);
                    }
                    header(sprintf('Location: /articles'));
                } else {
                    header(sprintf('Location: /article/%d', $identifier));
                }
            }
        }  else {
            throw new Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Vue();
        echo $twig->render('delete_post.twig', ['post' => $post, 'session' => $_SESSION]);
    }
}
