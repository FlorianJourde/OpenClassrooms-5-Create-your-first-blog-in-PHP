<?php

//define('__ROOT__', dirname(dirname(__FILE__)));

require_once '../src/controllers/comment/AddComment.php';
require_once '../src/controllers/comment/DeleteComment.php';
require_once '../src/controllers/comment/HideComment.php';
require_once '../src/controllers/comment/ShowComment.php';
require_once '../src/controllers/comment/ManageComments.php';
require_once '../src/controllers/comment/UpdateComment.php';
require_once '../src/controllers/post/AddPost.php';
require_once '../src/controllers/post/DeletePost.php';
require_once '../src/controllers/post/UpdatePost.php';
require_once '../src/controllers/user/AddUser.php';
require_once '../src/controllers/user/AuthenticationUser.php';
require_once '../src/controllers/user/LogoutUser.php';
require_once '../src/controllers/Archive.php';
require_once '../src/controllers/Contact.php';
require_once '../src/controllers/Homepage.php';
require_once '../src/controllers/Post.php';
require_once '../src/controllers/Register.php';
require_once '../src/controllers/Login.php';

use Application\Controllers\Comment\AddComment;
use Application\Controllers\Comment\DeleteComment;
use Application\Controllers\Comment\HideComment;
use Application\Controllers\Comment\ShowComment;
use Application\Controllers\Comment\UpdateComment;
use Application\Controllers\Contact;
use Application\Controllers\Homepage;
use Application\Controllers\Archive;
use Application\Controllers\Comment\ManageComments;
use Application\Controllers\Login;
use Application\Controllers\Post;
use Application\Controllers\Post\AddPost;
use Application\Controllers\Post\DeletePost;
use Application\Controllers\Post\UpdatePost;
use Application\Controllers\Register;
use Application\Controllers\User\AddUser;
use Application\Controllers\User\AuthenticationUser;
use Application\Controllers\User\LogoutUser;
use Application\Lib\RenderFront;

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new Post())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'archive') {
            (new Archive())->execute();
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
        } elseif ($_GET['action'] === 'addPost') {
            $input = null;
            $image = $_FILES;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }

            (new AddPost())->execute($_POST/* , $image */);
        } elseif ($_GET['action'] === 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                // It sets the input only when the HTTP method is POST (ie. the form is submitted).
                $input = null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new UpdatePost())->execute($identifier, $input);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new DeletePost())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $userId = 0;
                $status = false;

                (new AddComment())->execute($identifier, $_POST, $userId, $status);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] === 'hideComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new HideComment())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'showComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];

                (new ShowComment())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
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
        } elseif ($_GET['action'] === 'manageComments') {
            $input = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }

            (new ManageComments())->execute();
        } elseif ($_GET['action'] === 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                $input = null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }

                (new DeleteComment())->execute($identifier);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'contact') {
//            if (isset($_GET['id']) && $_GET['id'] > 0) {
//                $identifier = $_GET['id'];
                $input = null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
//                    var_dump($_POST);
//                    die();
                }

                (new Contact())->execute($input);
//            } else {
//                throw new Exception('Aucun identifiant de commentaire envoyé');
//            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();


    $twig = new RenderFront();
    echo $twig->render('error.twig', ['errorMessage' => $errorMessage]);

//    $loader = new \Twig\Loader\FilesystemLoader('../templates');
//    $twig = new \Twig\Environment($loader, [
////        'cache' => 'cache',
//        'debug' => true
//    ]);
//
//    $twig->addExtension(new \Twig\Extension\DebugExtension());
//
//    echo $twig->render('error.twig', ['errorMessage' => $errorMessage]);
}
