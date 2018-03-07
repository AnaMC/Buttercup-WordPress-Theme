<?php

/* vamos a dejarlo con sólo los métodos comunes a todos */

class Controlador {

    private $model;
    private $session;

    function __construct(Modelo $model) {
        $this->model = $model;
        $this->session = new Session(Constants::NOMBRESESSION);
    }

    function getModel() {
        return $this->model;
    }
    
    function getSession() {
        return $this->session;
    }

    function index() {
        $this->getModel()->setDatos('file', '_index.html');
    }

}

