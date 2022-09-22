<?php

require_once('src/controllers/comment/add.php');
require_once('src/controllers/comment/update.php');
require_once('src/controllers/user/add.php');
require_once('src/controllers/user/authentication.php');
require_once('src/controllers/user/logout.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/register.php');
require_once('src/controllers/login.php');

use Application\Controllers\Comment\AddComment;
use Application\Controllers\Comment\UpdateComment;
use Application\Controllers\Homepage;
use Application\Controllers\Login;
use Application\Controllers\Post;
use Application\Controllers\Register;
use Application\Controllers\User\AddUser;
use Application\Controllers\User\AuthenticationUser;
use Application\Controllers\User\LogoutUser;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'register') {
            (new Register())->execute();
        } elseif ($_GET['action'] === 'login') {
            (new Login())->execute();
        } elseif ($_GET['action'] === 'logoutUser') {
            (new LogoutUser())->execute();
        } elseif ($_GET['action'] === 'addUser') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = 'User';
            $password = $_POST['password'];

            (new AddUser())->execute($username, $email , $role, $password);
        } elseif ($_GET['action'] === 'userAuthentication') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            (new AuthenticationUser())->execute($email, $password);
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $user_id = '1';
                $status = true;

                (new AddComment())->execute($identifier, $_POST, $user_id, $status);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'updateComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new UpdateComment())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
//        'cache' => 'cache',
        'debug' => true
    ]);

    $twig->addExtension(new \Twig\Extension\DebugExtension());

    echo $twig->render('error.twig', ['errorMessage' => $errorMessage]);
}
