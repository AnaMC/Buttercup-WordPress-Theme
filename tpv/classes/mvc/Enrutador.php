<?php

class Enrutador {
    
    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Ruta ('Modelo','Vista','Controlador');
        $this->rutas['usuario'] = new Ruta('ModeloUsuario', 'VistaUsuario', 'ControladorUsuario');
        //$this->rutas['index'] = new Ruta('ModeloUsuario', 'VistaUsuario', 'ControladorUsuario');
        $this->rutas['ajax'] = new Ruta('ModeloAjax', 'VistaAjax', 'ControladorAjax');
        $this->rutas['product'] = new Ruta('ModeloProduct', 'Vista', 'ControladorProduct');
        $this->rutas['client'] = new Ruta('ModeloClient', 'Vista', 'ControladorClient');
        //añadir rutas
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }
}