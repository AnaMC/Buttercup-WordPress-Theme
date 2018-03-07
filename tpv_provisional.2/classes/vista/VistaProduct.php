<?php

class VistaProduct extends Vista {

    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }
    
    private function index() {
        //los datos que hay en el modelo sirven para mostrarlos o incluso para saber el archivo que estoy procesando
        $datos = $this->getModel()->getDatos();
        $archivo = 'plantilla/' . $datos['archivo'];
        return Util::renderTemplate($archivo, $datos);
    }

    function render($accion) {
        if(!method_exists(get_class(), $accion)) {
            $accion = 'index';
        }
        return $this->$accion();
    }
}