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

            var_dump($_POST);
            var_dump($_FILES);

            if(isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
//                var_dump($_FILES['file']);
//                die();

                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];

                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                $maxSize = 1000000;

                if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;

                    move_uploaded_file($tmpName, '../public/ressources/images/' . $file);
                } else {
                    throw new \Exception('Le fichier est trop volumineux ou son extension n\'est pas valide.');
                }
            }

            // var_dump($file);

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

            $success = $postRepository->createPost($userId, $title, $content, $status, $file);
            
            header(sprintf('Location: ?action=archive'));
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new RenderFront();
        echo $twig->render('add_post.twig', [/*'content' => */'session' => $_SESSION]);
    }
}