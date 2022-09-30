<?php

namespace Application\Controllers;

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Render;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class Archive
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $userRepository = new UserRepository();
        $userRepository->connection = new DatabaseConnection();

        $posts =  $postRepository->getPosts();

        foreach ($posts as $post) {
            $user = $userRepository->getUserFromId($post->user_id);
            $post->username = $user->username;
        }

        $twig = new Render();
        echo $twig->render('archive.twig', ['posts' => $posts, 'session' => $_SESSION/*, 'authors' => $userRepository->getUsers()*/]);
    }
}
