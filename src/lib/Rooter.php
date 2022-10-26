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
require_once '../src/controllers/AuthenticationUser.php';
require_once '../src/controllers/LogoutUser.php';
require_once '../src/controllers/Archive.php';
require_once '../src/controllers/Contact.php';
require_once '../src/controllers/Homepage.php';
require_once '../src/controllers/Post.php';
require_once '../src/controllers/Register.php';
require_once '../src/controllers/Login.php';

use Exception;

class Rooter {
    // Route une requête entrante : exécute l'action associée
    public function execute() {
        try {
            // Fusion des paramètres GET et POST de la requête
            $request = new Request(array_merge($_GET, $_POST));
            $this->createController($request);
        }
        catch (Exception $e) {
            $this->catchError($e->getMessage());
        }
    }

    // Crée le contrôleur approprié en fonction de la requête reçue
    private function createController(Request $request) {
        $controller = "Homepage";  // Contrôleur par défaut
        if ($request->existParameter('action')) {
            $controller = $request->getParameter('action');
        }

        // Création du nom du fichier du contrôleur
        $classController = $controller;
        $fileController = "../src/controllers/" . $classController . ".php";
        if (file_exists($fileController)) {
//            die();
            $className = "Application\\Controllers\\".$controller;
            return (new $className())->execute();
        } else {
            throw new Exception("Fichier '$fileController' introuvable");
        }
    }

    // Gère une erreur d'exécution (exception)
    private function catchError($exception) {
        $twig = new Vue();
        echo $twig->render('error.twig', ['errorMessage' => $exception, 'session' => $_SESSION]);
    }
}
