<?php

require 'vendor/autoload.php';
require 'MyExtension.php';

//use \Michelf\Markdown;
//
//echo App\Helper\Form::input();
//
//echo Markdown::defaultTransform('Bonjour, j\'essaie le **markdown**');

$page = 'home';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

//Get last tutorials
function getPosts() {
    $pdo = new PDO('mysql:dbname=blog;charset=utf8;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $posts = $pdo->query('SELECT * FROM posts');
    return $posts;
}

//Render template
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new Twig\Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
    'debug' => true
]);

$twig->addFunction(new \Twig\TwigFunction('markdown_function', function ($value) {
    return \Michelf\MarkdownExtra::defaultTransform($value);
}, ['is_safe' => ['html']]));

$twig->addExtension(new MyExtension());
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addGlobal('current_page', $page);

switch ($page) {
    case 'contact':
        echo $twig->render('contact.twig', ['name' => 'Marc', 'email' => 'demo@demo.fr']);
        break;
    case 'home':
        echo $twig->render('home.twig', ['posts' => getPosts()]);
        break;
    default:
        header('HTTP/1.0 404 Not found');
        echo $twig->render('404.twig');
        break;
}
