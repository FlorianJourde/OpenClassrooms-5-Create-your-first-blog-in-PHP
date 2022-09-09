<?php

namespace Application\Controllers\Homepage;

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/post_repository.php');
require_once('vendor/autoload.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\PostRepository\PostRepository;

class Homepage
{
    public function execute()
    {
        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
//        $posts = $postRepository->getPosts();

//        require('templates/homepage.php');

        // Twig templating
        /*$loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);
        $twig = new \Twig\Environment($loader);

        echo $twig->render('index', ['name' => 'Fabien']);*/

        /*$loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);

        $twig = new \Twig\Environment($loader);

        $template = $twig->load('home.twig');
        echo $template->render();*/

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
//            'cache' => 'cache',
            'debug' => true
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $twig->render('home.twig', ['posts' => $postRepository->getPosts()]);
    }
}
