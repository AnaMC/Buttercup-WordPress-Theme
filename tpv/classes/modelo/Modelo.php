<?php
class Modelo {

    private $datos = array();
    
    function getDatos(){
        return $this->datos;
    }
    
    function setDatos($nombre, $valor){
        $this->datos[$nombre] = $valor;
    }
    
    function _json($lista){
        $s = '';
        foreach ($lista as $valor) {
            $s .= $valor->json() . ',';
        }
        $s = substr($s, 0, strlen($s) - 1);
        return '{ "data" : [' . $s . '] }';
    }

}