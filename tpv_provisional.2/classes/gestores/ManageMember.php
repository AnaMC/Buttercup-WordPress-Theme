<?php

class ManageMember {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }
    
    public function getFromNombreUsuario($nombreusuario){
        $sql = 'select * from member where login = :nombreusuario';
        $params = array(
            'nombreusuario' => $nombreusuario
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $objeto = new Member();
        if($resultado && $fila = $sentencia->fetch()) {
            $objeto->set($fila);
        } else {
            $objeto = null;
        }
        return $objeto;
    }
}