<?php

namespace Application\Controllers\Post;

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\PostRepository;

class AddPost
{
    public function execute(?array $input)
    {
        session_start();

        if ($_SESSION['role'] != 'Admin') {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        } else {
            if (!empty($input)) {
                $title = null;
                $content = null;

                if (!empty($input['title']) && !empty($input['content'])) {
                    $title = $input['title'];
                    $content = $input['content'];
                    $user_id = $_SESSION['id'];
                    $status = true;
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

                $postRepository = new PostRepository();
                $postRepository->connection = new DatabaseConnection();
                $success = $postRepository->createPost($user_id, $title, $content, $status);
//
                header(sprintf('Location: index.php?action=archive'));
            }
        }

        $twig = new Render();
        echo $twig->render('add_post.twig', [/*'content' => */'session' => $_SESSION]);
    }
}