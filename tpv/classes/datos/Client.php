<?php

class Client {

    private $id, $name, $surname, $tin, $address, $location, $postalcode, $province, $email;

    function __construct($id = null, $name = null, $surname = null, $tin = null, $address = null, 
                            $location = null, $postalcode = null, $province = null, $email = null) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->tin = $tin;
        $this->address = $address;
        $this->location = $location;
        $this->postalcode = $postalcode;
        $this->province = $province;
        $this->email = $email;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getTin() {
        return $this->tin;
    }

    function getAddress() {
        return $this->address;
    }

    function getLocation() {
        return $this->location;
    }

    function getPostalcode() {
        return $this->postalcode;
    }

    function getProvince() {
        return $this->province;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setTin($tin) {
        $this->tin = $tin;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function setEmail($email) {
        $this->email = $email;
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
        $this->id           = $array[ 0 + $inicio ];
        $this->name         = $array[ 1 + $inicio ];
        $this->surname      = $array[ 2 + $inicio ];
        $this->tin          = $array[ 3 + $inicio ];
        $this->address      = $array[ 4 + $inicio ];
        $this->location     = $array[ 5 + $inicio ];
        $this->postalcode   = $array[ 6 + $inicio ];
        $this->province     = $array[ 7 + $inicio ];
        $this->email        = $array[ 8 + $inicio ];
    }
    
}


