<?php

namespace Application\Controllers\Post;

use Application\Lib\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class UpdatePost
{
    public function execute(int $identifier, ?array $input)
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $user = $userRepository->getUserFromId($postRepository->getPost($identifier)->user_id)->username;

        if ($_SESSION['role'] !== 'Admin') {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        } else {
            if ($input !== null) {
                $content = null;
                $title = null;

                if (!empty($input['content']) && !empty($input['title'])) {
                    $title = $input['title'];
                    $content = $input['content'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

                $success = $postRepository->updatePost($identifier, $content, $title);

                if (!$success) {
                    throw new \Exception('Impossible de modifier l\'article !');
                }
                if ($identifier === null) {
                    throw new \Exception('L\'article concerné n\'existe pas !');
                }

                header(sprintf('Location: index.php?action=post&id=%d', $identifier));
            }
        }

        $twig = new Render();
        echo $twig->render('update_post.twig', ['post' => $post, 'user' => $user,'session' => $_SESSION]);
    }
}