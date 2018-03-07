<?php

class ModeloProduct extends Modelo {
    
        /* -- insertar producto base de datos -- */
    
    function insertarProductoBD($producto){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->addProducto($producto);
    }
    
    /* --- borrar producto base de datos --- */
    
    function borrarProductoBD($id){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->removeProducto($id);
    }
    
    /* --- editar producto base de datos --- */
    function editarProductoBD($id){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->editProducto($id);
    }
    
    /* ---- Obtener datos de producto ---*/
    
    function getProduct($id) {
        $manager = new ManageProduct($this->getDataBase());
        return $manager->getProductBD($id);
    }
    
     /* --- Cuantos  productos --- */
    
    function countProductos(){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->countProducts();
    }
   
   /* cuantos paginacion productos --*/ 
    function getAllLimitProductos($offset , $rpp){
        $manager = new ManageProduct($this->getDataBase());
        return $manager->getAllLimitProduct($offset , $rpp);
    }
    
    /* -- Devuelve nombre de familia de producto -- */
    function getNombreFamilia($idFamily){
        $manager = new ManageFamily($this->getDataBase());
        return $manager->getNameFamily($idFamily);
    }
}