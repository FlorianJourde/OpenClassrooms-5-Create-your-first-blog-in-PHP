<?php

namespace Application\Controllers;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\PostRepository;
use Application\Model\UserRepository;
use Exception;
use League\HTMLToMarkdown\HtmlConverter;
use Michelf\Markdown;

class UpdatePost
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        // Check if parameter exist and is bigger than zero
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $identifier = $_GET['id'];
            // It sets the input only when the HTTP method is POST (ie. the form is submitted).
            $input = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $post = $postRepository->getPost($identifier);
        $user = $userRepository->getUserFromId($postRepository->getPost($identifier)->userId)->username;
        $userRole = new CheckUserRole();
        $post->image === null ? $post->image = 'placeholder-min.jpg' : $post->image;
        $htmlToMarkdownConverter = new HtmlConverter(array('strip_tags' => true));
        $post->content = $htmlToMarkdownConverter->convert($post->content);

        if ($userRole->isAuthenticated($_SESSION['token'] ?? '')
        && ($userRole->isAdmin($_SESSION['role'] ?? 'Guest'))) {
            if ($input !== null) {
                $content = null;
                $title = null;
                $image = null;

                if (!empty($input['content']) && !empty($input['title'])) {
                    $title = $input['title'];
                    $content = Markdown::defaultTransform($input['content']);
                    $image = $post->image;
                    $file = $_FILES['file']['error'] !== 0 ? $image : $_FILES['file'];

                    if ($file !== $image) {
                        if ($post->image !== 'placeholder-min.jpg') {
                            unlink('../public/ressources/images/posts/' . $post->image);
                        };

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
                } else {
                    throw new Exception('Les données du formulaire sont invalides.');
                }

                $success = $postRepository->updatePost($identifier, $content, $title, $file);

                if (!$success) {
                    throw new Exception('Impossible de modifier l\'article !');
                }
                if ($identifier === null) {
                    throw new Exception('L\'article concerné n\'existe pas !');
                }

                header(sprintf('Location: /article/%d', $identifier));
            }
        } else {
            throw new Exception('Vous n\'avez pas accès à cette page !');
        }

        $twig = new Vue();
        echo $twig->render('update_post.twig', ['post' => $post, 'user' => $user, 'session' => $_SESSION]);
    }
}
