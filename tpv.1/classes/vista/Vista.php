<?php

class Vista {
    
    private $modelo;
    
    function __construct(Modelo $modelo) {
        $this->modelo = $modelo;
    }

    function getModel(){
        return $this->modelo;
    }
    
    function render($accion) {
        if(!method_exists(get_class(), $accion)) {
            $accion = 'index';
        }
        echo Util::varDump($this->getModel()->getDatos());
        return $this->$accion();
    }
    
    private function index() {
        $this->getModel()->setDatos('file','_index.html');
        $data= $this->getModel()->getDatos();
        $file = 'template/' . $data['file'];
        return Util::renderTemplate($file, $data);
    }
}