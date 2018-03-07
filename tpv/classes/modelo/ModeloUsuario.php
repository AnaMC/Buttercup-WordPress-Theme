<?php

class ModeloUsuario extends Modelo {
    
    /* --- acceso usuario --- */
    
    function loginNombreUsuario($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        $usuarioDB = $manager->getFromNombreUsuario($usuario);
        return $usuarioDB;
    }

    /* -- insertar cliente base de datos -- */
    
    function insertarClienteBD($cliente){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->addCliente($cliente);
    }
    
    /* -- borrar cliente base de datos -- */
    function borrarClienteBD($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->removeCliente($id);
    }
    
    /* -- insertar producto base de datos -- */
    
    function insertarProductoBD($producto){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->addProducto($producto);
    }
    
    /* --- borrar producto base de datos --- */
    
    function borrarProductoBD($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->removeProducto($id);
    }

    function getUsuarios() {
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getAll();
    }

    
    /* --- Obtener datos de cliente --- */
    
    function getClient($id){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getClient($id);
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
    
    function getAllLimitProductos($offset , $rpp){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getAllLimitProduct($offset , $rpp);
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
  