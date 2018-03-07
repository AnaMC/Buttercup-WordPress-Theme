<?php

class ModeloUsuario extends Modelo {
    

    function getUsuarios() {
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getAll();
    }

    
    function getUser($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->get($id);
    }
    
    function editUser($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->editUser($usuario);
    }
    
    function editClave($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->editClave($usuario);
    }
    
    function editSinClave($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->editSinClave($usuario);
    }
    
    function editUserAdmin($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->editAdmin($usuario);
    }
    
    function deleteUser($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->remove($id);
    }
    
    function agregarUsuario(Usuario $usuario){
        $manager = new ManageUsuario($this->getDataBase());
        $resultado = $manager->addUsuario($usuario);
    }
    
    
    function countUsusarios(){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->countUsers();
    }
    

    
    function countAdmin(){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->countAdmin();
    }
    
    function getAllLimitUsuarios($offset , $rpp){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getAllLimit($offset , $rpp);
    }
    

    
    function getVerificadoId($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getVerifId($id);
    }
    
    function cambiaClave($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->editClave($usuario);
    }

}
  