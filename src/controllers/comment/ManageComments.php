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

        $comments = $commentRepository->getHiddenComments();

        // if (!in_array($value, $array)) {
        //     $array[] = $value; 
        // }

        // var_dump($comment->post_id);
        
        // if (!in_array($comment->post, $comments)) {
        //     $post[] = $comment->post; 
        // }

        $posts = [];

        foreach ($comments as $comment) {
            // var_dump('$comment->post_id : ', $comment->post_id);
            $comment->post = $postRepository->getPost($comment->post_id);
            // var_dump('$comment->post->identifier : ', $comment->post->identifier);
            // var_dump('$comment : ', $comment);

            if (!in_array($comment->post, $posts)) {
                $posts[] = $comment->post;
            }
            
            // $posts['hiddenComment'] = $comment;
            
            // $comment[] = $comment;
            // var_dump($comment);
            // $user = $userRepository->getUserFromId($comment->user_id);
            // $comment->username = $user->username;
        }

        // var_dump($posts);

        foreach ($posts as $post) {
            // var_dump($post->identifier);
            // var_dump($post);
            $post->hiddenComments = $commentRepository->getHiddenCommentsFromId($post->identifier);
            // $hiddenComments[] = $commentRepository->getHiddenCommentsFromId($post->identifier);
            // var_dump($hiddenComments);
            
            // $posts[] = $comment->post;
        }
        
        // $comment = $commentRepository->getComment();
        // $post = $postRepository->getPost($comment->post);

        // $userRole = new CheckUserRole();

        // var_dump($posts);

        // $userRepository = new UserRepository();
        // $userRepository->connection = new DatabaseConnection();

        // if ($userRole->isAuthenticated($_SESSION['token'] ?? '')) {
        //     if ($userRole->isAdmin(empty($_SESSION['role']) ?? 'Guest')) {
        //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //             $success = $commentRepository->deleteComment($identifier);

        //             header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
        //             if (!$success) {

        //                 header(sprintf('Location: index.php?action=post&id=%d', $comment->post));
        //             }
        //         }
        //     }
        // } else {
        //     throw new \Exception('Vous n\'avez pas accès à cette page !');
        // }

        $twig = new RenderFront();
        echo $twig->render('manage_comments.twig', [/* 'comments' => $comments,  */'posts' => $posts, 'session' => $_SESSION]);
    }
}
