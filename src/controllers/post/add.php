<?php

namespace Application\Controllers\Post;

use Application\Lib\Database\DatabaseConnection;
use Application\Model\PostRepository;

require_once('src/lib/database.php');
require_once('src/model/PostRepository.php');
require_once('src/model/Post.php');

class AddPost
{
    public function execute(?array $input)
    {
        session_start();

//        var_dump($input);
//        var_dump($_SESSION);

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

//                var_dump($success);
//                die();

//                $comment = $commentRepository->getComment($identifier);
//
//                if (!$success) {
//                    throw new \Exception('Impossible de modifier le commentaire !');
//                }
//                if ($comment->post === null) {
//                    throw new \Exception('L\'article concérné n\'existe pas !');
//                }
//
                header(sprintf('Location: index.php?action=archive'));
            }
        }

//        $author = null;
//        $comment = null;
//
//        if (!empty($input['author']) && !empty($input['comment'])) {
//            $author = $input['author'];
//            $comment = $input['comment'];
//        } else {
//            throw new \Exception('Les données du formulaire sont invalides.');
//        }
//
//        $commentRepository = new CommentRepository();
//        $commentRepository->connection = new DatabaseConnection();
//        $success = $commentRepository->createComment($post, $author, $comment, $user_id, $status);
//
//        if (!$success) {
//            throw new \Exception('Impossible d\'ajouter le commentaire !');
//        } else {
//            header('Location: index.php?action=post&id=' . $post);
////        }
//        $postRepository = new PostRepository();
//        $postRepository->connection = new DatabaseConnection();
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            //            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('add_post.twig', [/*'content' => */'session' => $_SESSION]);
    }
}