<?php

class ControladorAjax extends Controlador {

    function index(){
        $this->getModel()->setDato('html', '_index.html');
    }
    
    function doinsert(){
        //controlar la sesion
        $producto = new Product();
        $producto->read();
        $r = $this->getModel()->insert($producto);
        echo $r;
        exit;
        
        // $this->getListJson();
    }
}