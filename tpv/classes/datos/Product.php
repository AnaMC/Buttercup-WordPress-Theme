<?php
/*
create table product (
*/
class Product {
    
    private $id, $idfamily, $product, $price, $description;
    
    function __construct($id = null, $idfamily = null, $product = null, $price = null, $description = null) {
        $this->id          = $id;
        $this->idfamily    = $idfamily;
        $this->product     = $product;
        $this->price       = $price;
        $this->description = $description;
    }
    
    /** 
     * metodo GET
     * 
     * function get'*01'() {
     *  return $this->'*02';
     * }
     * 
    */
    
    function getId() {
        return $this->id;
    }
    
    function getIdFamily() {
        return $this->idfamily;
    }
    
    function getProduct() {
        return $this->product;
    }
    
    function getPrice() {
        return $this->price;
    }
    
    function getDescription() {
        return $this->description;
    }
    
    /** 
     * metodo SET
     * 
     * function set'*01'('*02') {
     *  $this->'*03' = '*02';
     * }
     * 
    */

    function setId($id) {
        $this->idproduct = $id;
    }
    
    function setIdFamily($idfamily) {
        $this->idfamily = $idfamily;
    }
    
    function setProduct($product) {
        $this->idproduct = $product;
    }
    
    function setPrice($price) {
        $this->price = $price;
    }
    
    function setDescription($description) {
        $this->description = $description;
    }
    
    /**
     * FUNCTIONES DE LAS POJOS
     */

    function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    function json() {
        return json_encode($this->get());
    }
    
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->id          = $array[ 0 + $inicio ];
        $this->idfamily    = $array[ 1 + $inicio ];
        $this->product     = $array[ 2 + $inicio ];
        $this->price       = $array[ 3 + $inicio ];
        $this->description = $array[ 4 + $inicio ];
    }
    
}