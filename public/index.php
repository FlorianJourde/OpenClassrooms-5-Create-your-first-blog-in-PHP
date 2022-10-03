<?php

define('__ROOT__', dirname(dirname(__FILE__)));

require_once __ROOT__ . '/src/controllers/comment/AddComment.php';
require_once __ROOT__ . '/src/controllers/comment/DeleteComment.php';
require_once __ROOT__ . '/src/controllers/comment/ManageComments.php';
require_once __ROOT__ . '/src/controllers/comment/UpdateComment.php';
require_once __ROOT__ . '/src/controllers/post/AddPost.php';
require_once __ROOT__ . '/src/controllers/post/DeletePost.php';
require_once __ROOT__ . '/src/controllers/post/UpdatePost.php';
require_once __ROOT__ . '/src/controllers/user/AddUser.php';
require_once __ROOT__ . '/src/controllers/user/AuthenticationUser.php';
require_once __ROOT__ . '/src/controllers/user/LogoutUser.php';
require_once __ROOT__ . '/src/controllers/Homepage.php';
require_once __ROOT__ . '/src/controllers/Archive.php';
require_once __ROOT__ . '/src/controllers/Post.php';
require_once __ROOT__ . '/src/controllers/Register.php';
require_once __ROOT__ . '/src/controllers/Login.php';

use Application\Controllers\Comment\AddComment;
use Application\Controllers\Comment\DeleteComment;
use Application\Controllers\Comment\UpdateComment;
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = $_POST;
            }

            (new AddPost())->execute($_POST);
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
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
//        var_dump($_GET);
//        die();

        (new Homepage())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    $loader = new \Twig\Loader\FilesystemLoader(__ROOT__ . '/templates');
    $twig = new \Twig\Environment($loader, [
//        'cache' => 'cache',
        'debug' => true
    ]);

    $twig->addExtension(new \Twig\Extension\DebugExtension());

    echo $twig->render('error.twig', ['errorMessage' => $errorMessage]);
}
