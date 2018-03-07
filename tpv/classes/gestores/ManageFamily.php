<?php

class ManageFamily{
    
    const TABLA = 'famiy';
     private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    /**
     * Funcion privada que permite a partir de un objeto crear un array ordenado con todos sus campos.
     * 
     * @param objeto que se convertira en array
     * @return array con los valores del objeto.
     */ 
    private static function _getCampos($objeto) {
        $campos = $objeto->get();
        return $campos;
    }
    
    
    
    function addFamily(Family $objeto) {
        $campos = self::_getCampos($objeto);
        unset($campos['id']);
        return $this->db->insertParameters(self::TABLA, $campos);
    }
    
    function saveFamily(Family $objeto) {
        $campos =self::_getCampos($objeto);
        $id = $campos['id'];
        $r= true;
        $r = $this->db->updateParameters(self::TABLA, $campos, array('id' => $id) );

        return $r;
    }
    
    function deleteFamily($id) {
        return $this->db->deleteParameters(self::TABLA, array('id' => $id));
    }
    
    function getList() {
        $this->db->getCursorParameters(self::TABLA, '*');
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Family();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        
        return $respuesta;
    }
    
}