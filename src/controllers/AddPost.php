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

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '') && $userRole->isAdmin($_SESSION['role'] ?? 'Guest')) {
            // Check if datas have been sent with post method
            if (!empty($_POST)) {
                $file = $_FILES['file']['error'] !== 0 ? null : $_FILES['file'];

                // Check if an image have been sent
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

                        move_uploaded_file($tmpName, ROOT . '/public/ressources/images/posts/' . $file);
                    } else {
                        throw new \Exception('L\'image sélectionnée n\'est pas conforme.');
                    }
                }

                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    $title = $_POST['title'];
                    $content = Markdown::defaultTransform($_POST['content']);
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