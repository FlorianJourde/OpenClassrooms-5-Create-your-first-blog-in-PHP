<?php

namespace Application\Controllers\Comment;

use Application\Lib\CheckUserRole;
use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
use Application\Model\CommentRepository;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class ManageComments
{
    public function execute(/* int $identifier */)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $userRole = new CheckUserRole();

         if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
             if ($userRole->isAdmin($_SESSION['role']) ?? 'Guest') {

                 $hiddenComments = $commentRepository->getHiddenComments();

                 $posts = [];

                 foreach ($hiddenComments as $comment) {
//                     var_dump("Comment before : ", $comment);
//                     var_dump($comment->user_id);
//                     var_dump($userRepository->getUserFromId($comment->user_id)->username);
//                     $comment->username = $userRepository->getUserFromId($comment->user_id)->username;
//                     var_dump($userRepository->getUserFromId($comment->user_id)->username);
                     $comment->username = $userRepository->getUserFromId($comment->user_id)->username;
                     $comment->post = $postRepository->getPost($comment->post_id);

//                     var_dump("Comment after : ", $comment);
//                     var_dump($comment->post);
//                     var_dump($comment->username);
//                     var_dump($comment->post);
//                     var_dump($userRepository->getUserFromId($comment->user_id)->username);
//                     var_dump($post);
//                     $comment->user = $userRepository->getUserFromId($comment->post->user_id)->username;
//                     var_dump($comment);
//                     var_dump($userRepository->getUserFromId($comment->post->user_id)->username);
//                     die();

//                     var_dump($comment);

                     if (!in_array($comment->post, $posts)) {
//                         var_dump($comment->username);
//                         var_dump($posts->username);
//                     $posts[] = $comment->username;
                         $posts[] = $comment->post;
//                         var_dump($comment);
                     }
//                 var_dump($comment);
                 }

//                 var_dump($posts);

                 foreach ($posts as $post) {
//                     var_dump($post);
//                     var_dump($commentRepository->getHiddenCommentsFromId($post->identifier));
                     $post->hiddenComments = $commentRepository->getHiddenCommentsFromId($post->identifier);
                     $post->username = $userRepository->getUserFromId($post->user_id)->username;
//                     var_dump($post);
//                     var_dump($post->user_id);
//                     var_dump($userRepository->getUserFromId($post->user_id)->username);
//                     var_dump($post->username = $userRepository->getUserFromId());
                 }
//             }
             }
         } else {
             throw new \Exception('Vous n\'avez pas accès à cette page !');
         }

        $twig = new RenderFront();
        echo $twig->render('manage_comments.twig', [/* 'comments' => $comments,  */'posts' => $posts, 'session' => $_SESSION]);
    }
}
