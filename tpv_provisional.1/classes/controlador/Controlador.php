<?php

/* vamos a dejarlo con sólo los métodos comunes a todos */

class Controlador {

    private $modelo;
    private $sesion;

    function __construct(Modelo $modelo) {
        $this->modelo = $modelo;
        $this->sesion = new Session(Constants::NOMBRESESSION);
        if($this->isLogged()) {
            $usuario = $this->getUser();
            $this->getModel()->setDato('id', $usuario->getId());
        }
    }

    function getModel() {
        return $this->modelo;
    }
    
    function getSesion() {
        return $this->sesion;
    }

    function getUser() {
        return $this->getSesion()->getUser();
    }

  /*  function index() {
        $this->getModel()->setDato('index', 'index');
    } */
    
    function isLogged() {
        return $this->getSesion()->isLogged();
    }
    
  /*  function index() {
        if($this->isLogged()) {
            $this->getModel()->setDato('archivo', '_index_logueado.html');
        } else {
            $this->getModel()->setDato('archivo', '_index_nologueado.html');
        }
        $header = file_get_contents("plantilla/_header.html");
        $this->getModel()->setDato('header', $header);
        $footer = file_get_contents("plantilla/_footer.html");
        $this->getModel()->setDato('footer', $footer);
        
    } */
} 