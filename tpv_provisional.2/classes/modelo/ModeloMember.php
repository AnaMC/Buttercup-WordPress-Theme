<?php

class ModeloMember extends Modelo {

    /* --- acceso usuario --- */
    
    function loginNombreUsuario($usuario){
        $manager = new ManageMember($this->getDataBase());
        $usuarioDB = $manager->getFromNombreUsuario($usuario);
        return $usuarioDB;
    }
}