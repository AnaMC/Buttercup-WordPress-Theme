<?php

class ControladorProduct extends Controlador{
    
    function get(){
        $id= Request::read('idProducto');
        $result = $this->getModelo()->get($id);
    }
    
    function _getByName($nombre){
        return $this->getModel()->getByName($nombre);
    }

    function doinsert(){
        $producto = new Product();
        $producto->read();
        $r = $this->getModel()->insert($producto);
        // $this->getListJson();
    }
    
    function dodelete(){
        $ids = $_GET['id'];
        $r = $this->getModel()->remove($ids);
    }
    
    function doedit(){
        $producto = new Product();
        $producto->read();
        $this->getModel()->edit($producto);
        // $lista = $this->getListJson();
    }
    
    function getList(){
         $this->getListJson(false);
    }
    
    function getListJson($json = true){
        $listaProduct = $this->getModel()->getList($json);
        $this->getModel()->setDatos('listaProduct', $listaProduct);
    }
    function index(){
        $this->getModel()->setDatos('file', '_index.html');
    }
    
    // function getatributes(){
    //     $product = new Product();
    //     echo $product->json();
    // }
}