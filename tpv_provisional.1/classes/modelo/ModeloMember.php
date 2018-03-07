<?php

class ModeloMember extends Modelo {

    /* --- acceso usuario --- */
    
    function loginNombreUsuario($member){
        $manager = new ManageMember($this->getDataBase());
        $memberDB = $manager->getFromNombreUsuario($member);
        return $memberDB;
    }
}