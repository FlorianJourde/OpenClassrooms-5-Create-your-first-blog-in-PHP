<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/lib/Database.php';
require_once __ROOT__ . '/src/lib/Render.php';
require_once __ROOT__ . '/src/model/Post.php';
require_once __ROOT__ . '/src/model/PostRepository.php';
require_once __ROOT__ . '/src/model/Comment.php';
require_once __ROOT__ . '/src/model/CommentRepository.php';
require_once __ROOT__ . '/src/model/User.php';
require_once __ROOT__ . '/src/model/UserRepository.php';
require_once __ROOT__ . '/vendor/autoload.php';

use Application\Lib\Database\DatabaseConnection;
use Application\Lib\Render;
use Application\Model\PostRepository;

class Homepage
{
    public function execute()
    {
        session_start();

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();


        $twig = new Render();
        echo $twig->render('home.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);
    }
}
