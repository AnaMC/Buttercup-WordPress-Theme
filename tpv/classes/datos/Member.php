<?php

class Usuario {

    private $id, $nombre, $apellidos, $nombreusuario, $correo, $clave, $tipo, $fechaalta, $verificado;
    
    function __construct($id = null,
                        $nombre = null,
                        $apellidos = null,
                        $nombreusuario = null,
                        $correo = null,
                        $clave = null,
                        $fechaalta = '0000-00-00',
                        $tipo = 'normal',
                        $verificado = 0) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->nombreusuario = $nombreusuario;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->tipo = $tipo;
        $this->fechaalta = $fechaalta;
        $this->verificado = $verificado;
    }

    function getId(){
        return $this->id;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function getNombre(){
        return $this->nombre;
    }
    
    function setNombre($nombre){
        $this->nombre = $nombre;
    }
    
    function getApellidos(){
        return $this->apellidos;
    }
    
    function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    
    function getUser(){
        return $this->nombreusuario;
    }
    
    function setUser($user){
        $this->nombreusuario = $user;
    }
    
    function getCorreo(){
        return $this->correo;
    }
    
    function setCorreo($correo){
        $this->correo = $correo;
    }
    
    function getClave(){
        return $this->clave;
    }
    
    function setClave($clave){
        $this->clave = $clave;
    }
    
    function getTipo(){
        return $this->tipo;
    }
    
    function setTipo($tipo){
        $this->tipo = $tipo;
    }
    
    function getFecha(){
        return $this->fechaalta;
    }
    
    function setFecha($fecha){
        $this->fechaalta = $fecha;
    }
    
    function getVerificado(){
        return $this->verificado;
    }
    
    function setVerificado($verificado){
        $this->verificado = $verificado;
    }
    
    
    /* común a todas las clases */

    function getAttributes(){
        $atributos = [];
        foreach($this as $atributo => $valor){
            $atributos[] = $atributo;
        }
        return $atributos;
    }

    function getValues(){
        $valores = [];
        foreach($this as $valor){
            $valores[] = $valor;
        }
        return $valores;
    }
    
    
    function getAttributesValues(){
        $valoresCompletos = [];
        foreach($this as $atributo => $valor){
            $valoresCompletos[$atributo] = $valor;
        }
        return $valoresCompletos;
    }
    
    function read(){
        foreach($this as $atributo => $valor){
            $this->$atributo = Request::read($atributo);
        }
    }
    
    function set(array $array, $pos = 0){
        foreach ($this as $campo => $valor) {
            if (isset($array[$pos]) ) {
                $this->$campo = $array[$pos];
            }
            $pos++;
        }
    }
    
    function setFromAssociative(array $array){
        foreach($this as $indice => $valor){
            if(isset($array[$indice])){
                $this->$indice = $array[$indice];
            }
        }
    }
    
    public function __toString() {
        $cadena = get_class() . ': ';
        foreach($this as $atributo => $valor){
            $cadena .= $atributo . ': ' . $valor . ', ';
        }
        return substr($cadena, 0, -2);
    }
}