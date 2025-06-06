<?php

namespace Application\Controllers;

require_once '../src/lib/CheckUserRole.php';
require_once '../src/lib/DatabaseConnection.php';
require_once '../src/lib/DotEnv.php';
require_once '../src/lib/ManageSession.php';
require_once '../src/lib/Vue.php';
require_once '../src/model/Post.php';
require_once '../src/model/PostRepository.php';
require_once '../src/model/Comment.php';
require_once '../src/model/CommentRepository.php';
require_once '../src/model/User.php';
require_once '../src/model/UserRepository.php';
require_once '../vendor/autoload.php';

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\Vue;
use Application\Model\PostRepository;
use Application\Model\UserRepository;

class Homepage
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();

        $posts = array_slice($postRepository->getPosts(),0, 3);

        foreach ($posts as $post) {
            $post->image === null ? $post->image = 'placeholder-min.jpg' : $post->image;
        }

        $twig = new Vue();
        echo $twig->render('home.twig', ['posts' => $posts, 'session' => $_SESSION]);
    }
}
