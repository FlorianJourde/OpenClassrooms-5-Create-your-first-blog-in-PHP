<?php

namespace Application\Lib;

/*
 * Classe modélisant une requête HTTP entrante
 *
 * @version 1.0
 * @author Baptiste Pesquet
 */

use Exception;

class Request {
    // Request parameter array
    private $parameters;

    // Constructor
    public function __construct($parameters) {
        $this->parameters = $parameters;
    }

    // Return true if parameter exist in request
    public function existParameter($name) {
        return (isset($this->parameters[$name]) && $this->parameters[$name] != "");
    }

    // Return asked parameter value
    public function getParameter($name) {
        if ($this->existParameter($name)) {
            return $this->parameters[$name];
        } else {
            throw new Exception("Paramètre '$name' absent de la requête");
        }
    }
}