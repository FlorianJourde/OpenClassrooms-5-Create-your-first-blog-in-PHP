<?php

namespace Application\Lib;

use Exception;

require_once 'Request.php';
//require_once 'Vue.php';

/**
 * Classe abstraite Controller
 * Fournit des services communs aux classes Controller dérivées
 *
 * @version 1.0
 */
abstract class Controller {

    /** Action à réaliser */
    private $action;

    /** Requête entrante */
    protected $requete;

    /**
     * Définit la requête entrante
     *
     * @param Request $requete Requete entrante
     */
    public function setRequest(Request $requete)
    {
        $this->requete = $requete;
    }

    /**
     * Exécute l'action à réaliser.
     * Appelle la méthode portant le même nom que l'action sur l'objet Controller courant
     *
     * @throws Exception Si l'action n'existe pas dans la classe Controller courante
     */
    public function executeAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        }
        else {
            $classController = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $classController");
        }
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
//    public abstract function index();

    /**
     * Génère la vue associée au contrôleur courant
     *
     * @param array $datasVue Données nécessaires pour la génération de la vue
     */
//    protected function generateVue($datasVue = array())
//    {
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
//        $classController = get_class($this);
//        $controller = str_replace("Controller", "", $classController);

        // Instanciation et génération de la vueF
//        $vue = new Vue($this->action, $controller);
//        $vue->generate($datasVue);
//    }

}