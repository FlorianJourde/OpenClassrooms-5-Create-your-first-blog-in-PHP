<?php

namespace Application\Controllers\Post;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\PostRepository;

class AddPost
{
    public function execute(?array $input)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userRole = new CheckUserRole();

        if (empty($_SESSION['role'])) {
            $user_role = 'Guest';
        } else {
            $user_role = $_SESSION['role'];
        }

        if ($userRole->isAdmin($user_role)) {
            if (!empty($input)) {
            $title = null;
            $content = null;

            if (!empty($input['title']) && !empty($input['content'])) {
                $title = $input['title'];
                $content = $input['content'];
                $userId = $_SESSION['id'];
                $status = true;
            } else {
                throw new \Exception('Les données du formulaire sont invalides.');
            }

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();
            $success = $postRepository->createPost($userId, $title, $content, $status);
//
            header(sprintf('Location: index.php?action=archive'));
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('add_post.twig', [/*'content' => */'session' => $_SESSION]);
    }
}