<?php

class ControladorClient extends Controlador{
    
    function get(){
        $id= Request::read('idClient');
        $result = $this->getModelo()->get($id);
    }
    
    function _getByName($nombre){
        return $this->getModel()->getByName($nombre);
    }

 /*   function doinsert(){
        $client = new Client();
        $client->read();
        $r = $this->getModel()->insert($client);
        // $this->getListJson();
    } */
    function insert() {
      //  if($this->isLogged()) {
         //   $header = file_get_contents("plantilla/_header.html");
         //   $this->getModel()->setDato('header', $header);
         //   $footer = file_get_contents("plantilla/_footer.html");
        //    $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('file' , '_client.html');
      //  } else {
       //     $this->index();
      //  }
    }
    function doinsert() {
     //   if($this->isLogged()) {
            $client = new Client();
            $client->read();
            $r = -1;
            if(Filter::isEmail($client->getEmail())){
                $r = $this->getModel()->insert($client);
             //   header('Location: ?ruta=client&accion=listaCliente');
            } else {
                $this->getModel()->setDato('mensaje', 'El formato de correo no está bien');
            }
       //  } else {
          //  $this->index();
    //     }
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