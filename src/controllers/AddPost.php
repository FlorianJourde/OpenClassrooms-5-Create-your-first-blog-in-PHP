<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\PostRepository;
use Michelf\Markdown;

class AddPost
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $userRole = new CheckUserRole();

        $input = null;
        $image = $_FILES;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = $_POST;
        }

        if (empty($_SESSION['role'])) {
            $user_role = 'Guest';
        } else {
            $user_role = $_SESSION['role'];
        }

        if ($userRole->isAdmin($user_role)) {
            if (!empty($input)) {

                $title = null;
                $content = null;
                $file = $_FILES['file']['error'] !== 0 ? null : $_FILES['file'];

                if(isset($file)) {
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    $mimeType = mime_content_type($tmpName);
                    $extensions = ['image/jpeg', 'image/png', 'image/gif'];
                    $maxSize = 1000000;

                    if (in_array($mimeType, $extensions) && $size <= $maxSize && $error == 0) {
                        $uniqueName = uniqid('', true);
                        $file = $uniqueName . "." . $extension;

                        move_uploaded_file($tmpName, '../public/ressources/images/posts/' . $file);
                    } else {
                        throw new \Exception('L\'image sélectionnée n\'est pas conforme.');
                    }
                }

                if (!empty($input['title']) && !empty($input['content'])) {
                    $title = $input['title'];
                    $content = Markdown::defaultTransform($input['content']);
                    $userId = $_SESSION['id'];
                    $status = true;
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }

            $postRepository = new PostRepository();
            $postRepository->connection = new DatabaseConnection();

            $success = $postRepository->createPost($userId, $title, $content, $status, $file);
            
            header(sprintf('Location: /articles'));
            }
        } else {
            throw new \Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Vue();
        echo $twig->render('add_post.twig', ['session' => $_SESSION]);
    }
}