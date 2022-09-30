<?php

namespace Application\Controllers\Post;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class UpdatePost
{
    public function execute(int $identifier, ?array $input)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $post = $postRepository->getPost($identifier);

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();
        $user = $userRepository->getUserFromId($postRepository->getPost($identifier)->user_id)->username;

        $userRole = new CheckUserRole();

        if (empty($_SESSION['role'])) {
            $user_role = 'Guest';
        } else {
            $user_role = $_SESSION['role'];
        }

        if ($userRole->isAdmin($user_role)) {
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
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('update_post.twig', ['post' => $post, 'user' => $user,'session' => $_SESSION]);
    }
}