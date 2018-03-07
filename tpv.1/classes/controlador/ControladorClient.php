<?php

class ControladorClient extends Controlador{
    
    function get(){
        $id= Request::read('idClient');
        $result = $this->getModelo()->get($id);
    }
    
    function _getByName($nombre){
        return $this->getModel()->getByName($nombre);
    }

    function doinsert(){
        $client = new Client();
        $client->read();
        $r = $this->getModel()->insert($client);
        // $this->getListJson();
    }
    
    function dodelete(){
        $ids = $_GET['id'];
        $r = $this->getModel()->remove($ids);
    }
    
    function doedit(){
        $client = new Client();
        $client->read();
        $this->getModel()->edit($client);
        // $lista = $this->getListJson();
    }
    
    function getList(){
         $this->getListJson(false);
    }
    
    function getListJson($json = true){
        $listaClient = $this->getModel()->getList($json);
        $this->getModel()->setDatos('listaClient', $listaClient);
    }
    function index(){
        $this->getModel()->setDatos('file', '_index.html');
    }
    
    // function getatributes(){
    //     $product = new Product();
    //     echo $product->json();
    // }
}