<?php

namespace Application\Controllers;

require_once __ROOT__ . '/src/lib/CheckUserRole.php';
require_once __ROOT__ . '/src/lib/DatabaseConnection.php';
require_once __ROOT__ . '/src/lib/ManageSession.php';
require_once __ROOT__ . '/src/lib/RenderFront.php';
require_once __ROOT__ . '/src/model/Post.php';
require_once __ROOT__ . '/src/model/PostRepository.php';
require_once __ROOT__ . '/src/model/Comment.php';
require_once __ROOT__ . '/src/model/CommentRepository.php';
require_once __ROOT__ . '/src/model/User.php';
require_once __ROOT__ . '/src/model/UserRepository.php';
require_once __ROOT__ . '/vendor/autoload.php';

use Application\Lib\DatabaseConnection;
use Application\Lib\ManageSession;
use Application\Lib\RenderFront;
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

//        var_dump($_SESSION);
//        $userRepository = new UserRepository();
//        $userRepository->checkToken($_SESSION['token'] ?? []);
//        var_dump($userRepository->checkToken($_SESSION['token']));

        $twig = new RenderFront();
        echo $twig->render('home.twig', ['posts' => $postRepository->getPosts(), 'session' => $_SESSION]);
    }
}
