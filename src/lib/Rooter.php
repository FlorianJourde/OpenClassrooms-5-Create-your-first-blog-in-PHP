<?php

namespace Application\Lib;


require_once 'Request.php';
require_once 'Controller.php';
require_once '../src/lib/Request.php';
require_once '../src/controllers/AddComment.php';
require_once '../src/controllers/DeleteComment.php';
require_once '../src/controllers/HideComment.php';
require_once '../src/controllers/ShowComment.php';
require_once '../src/controllers/ManageComments.php';
require_once '../src/controllers/UpdateComment.php';
require_once '../src/controllers/AddPost.php';
require_once '../src/controllers/DeletePost.php';
require_once '../src/controllers/UpdatePost.php';
require_once '../src/controllers/AddUser.php';
require_once '../src/controllers/AuthenticationUser.php';
require_once '../src/controllers/LogoutUser.php';
require_once '../src/controllers/Archive.php';
require_once '../src/controllers/Contact.php';
require_once '../src/controllers/Homepage.php';
require_once '../src/controllers/Post.php';
require_once '../src/controllers/Register.php';
require_once '../src/controllers/Login.php';

use Exception;
//use Application\Controllers\Comment\AddComment;
//use Application\Controllers\Comment\DeleteComment;
//use Application\Controllers\Comment\HideComment;
//use Application\Controllers\Comment\ShowComment;
//use Application\Controllers\Comment\UpdateComment;
//use Application\Controllers\Contact;
//use Application\Controllers\Homepage;
//use Application\Controllers\Archive;
//use Application\Controllers\Comment\ManageComments;
//use Application\Controllers\Login;
//use Application\Controllers\Post;
//use Application\Controllers\Post\AddPost;
//use Application\Controllers\Post\DeletePost;
//use Application\Controllers\Post\UpdatePost;
//use Application\Controllers\Register;
//use Application\Controllers\User\AddUser;
//use Application\Controllers\User\AuthenticationUser;
//use Application\Controllers\User\LogoutUser;
//use Application\Lib\Vue;


class Rooter {

    // Route une requête entrante : exécute l'action associée
    public function execute() {

//        $classController = 'Homepage';
//        $homepage = new Homepage();
//        var_dump($classController);
//        var_dump($homepage);
//        $controller = (new Homepage())->execute();


//        $manageSession = new ManageSession();
//        $manageSession->execute();

        try {
            // Fusion des paramètres GET et POST de la requête
            $request = new Request(array_merge($_GET, $_POST));

            $controller = $this->createController($request);
//            var_dump($controller);
//            $action = $this->createAction($request);

//            $controller->executeAction($action);
        }
        catch (Exception $e) {
            $errorMessage = $e->getMessage();

            $twig = new Vue();
            echo $twig->render('error.twig', ['errorMessage' => $errorMessage, 'session' => $_SESSION]);
//            $this->catchError($e);
        }
    }

    // Crée le contrôleur approprié en fonction de la requête reçue
    private function createController(Request $request) {
        $controller = "Homepage";  // Contrôleur par défaut
        if ($request->existParameter('action')) {
            $controller = $request->getParameter('action');
            // Première lettre en majuscule
//            $controller = ucfirst(strtolower($controller));
        }
        // Création du nom du fichier du contrôleur
        $classController = $controller;

//        var_dump($controller);
        $fileController = "../src/controllers/" . $classController . ".php";
        if (file_exists($fileController)) {
            $className = "Application\\Controllers\\".$controller;
            return (new $className())->execute();
        }
        else
            throw new Exception("Fichier '$fileController' introuvable");
    }

    // Détermine l'action à exécuter en fonction de la requête reçue
    private function createAction(Request $request) {
        $action = "index";  // Action par défaut
        if ($request->existParameter('action')) {
            $action = $request->getParameter('action');
        }
        return $action;
    }

    // Gère une erreur d'exécution (exception)
//    private function catchError(Exception $exception) {
//        $vue = new Vue('erreur');
//        $vue->generate(array('errorMessage' => $exception->getMessage()));
//    }
}