<?php

namespace Application\Lib;

require_once "Request.php";
require_once (Root . "/src/lib/Request.php");
require_once (Root . "/src/controllers/AddComment.php");
require_once (Root . "/src/controllers/DeleteComment.php");
require_once (Root . "/src/controllers/HideComment.php");
require_once (Root . "/src/controllers/ShowComment.php");
require_once (Root . "/src/controllers/ManageComments.php");
require_once (Root . "/src/controllers/UpdateComment.php");
require_once (Root . "/src/controllers/AddPost.php");
require_once (Root . "/src/controllers/DeletePost.php");
require_once (Root . "/src/controllers/UpdatePost.php");
require_once (Root . "/src/controllers/AuthenticationUser.php");
require_once (Root . "/src/controllers/LogoutUser.php");
require_once (Root . "/src/controllers/Archive.php");
require_once (Root . "/src/controllers/Contact.php");
require_once (Root . "/src/controllers/Homepage.php");
require_once (Root . "/src/controllers/Post.php");
require_once (Root . "/src/controllers/Register.php");
require_once (Root . "/src/controllers/Login.php");

use Exception;

class Rooter {
    // Root incoming request : execute associated action
    public function execute() {
        try {
            // Merge GET & POST request parameters
            $request = new Request(array_merge($_GET, $_POST));
            $this->createController($request);
        }
        catch (Exception $e) {
            $this->catchError($e->getMessage());
        }
    }

    // Create appropriated controller, depending on request
    private function createController(Request $request) {
        $controller = "Homepage";
        if ($request->existParameter('action')) {
            $controller = $request->getParameter('action');
        }

        // Controller filename creation
        $classController = $controller;
        $fileController = (Root . "/src/controllers/" . $classController . ".php");
        if (file_exists($fileController)) {
            $className = "Application\\Controllers\\".$controller;
            return (new $className())->execute();
        } else {
            throw new Exception("Fichier '$fileController' introuvable");
        }
    }

    // Handle execution error (exception)
    private function catchError($exception) {
        $twig = new Vue();
        echo $twig->render('error.twig', ['errorMessage' => $exception, 'session' => $_SESSION]);
    }
}
