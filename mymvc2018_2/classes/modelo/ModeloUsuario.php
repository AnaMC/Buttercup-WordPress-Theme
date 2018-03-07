<?php

class ModeloUsuario extends Modelo {

    function activarUsuario($id, $sha1IdCorreo) {
        $manager = new ManageUsuario($this->getDataBase());
        $usuarioBD = $manager->get($id);
        $r = -1;
        if($usuarioBD !== null) {
            $sha1 = sha1($usuarioBD->getId() . $usuarioBD->getCorreo());
            if($sha1IdCorreo === $sha1) {
                $usuarioBD->setVerificado(1);
                $r = $manager->editSinClave($usuarioBD);
            }
        }
        return $r;
    }
    
    function verificarUsuarioEditarAdmin($id){
        $manager = new ManageUsuario($this->getDataBase());
        $usuarioBD = $manager->get($id);
        $usuarioBD->setVerificado(1);
        $manager->editSinClave($usuarioBD);
    }

    
    function getUsuarios() {
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getAll();
    }

    function loginNombreUsuario($usuario){
        $manager = new ManageUsuario($this->getDataBase());
        $usuarioDB = $manager->getFromNombreUsuario($usuario);
        return $usuarioDB;
    }
    
    function loginCorreo($correo){
        $manager = new ManageUsuario($this->getDataBase());
        return $manager->getFromCorreo($correo);
    }
    
    
    function reenviaCorreoActiva($correo) {
        $manager = new ManageUsuario($this->getDataBase());
        $resultado = $manager->getFromCorreo($correo);
        if($resultado > 0) {
          $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=activar&id=' . $resultado->getId() . '&data=' . sha1($resultado->getId().$resultado->getCorreo()). '">Activate</a>';
            $resultado2 = Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de activación: ' . $enlace);
        }
        return $resultado;
    }
    
    function registrar(Usuario $usuario) {
        $manager = new ManageUsuario($this->getDataBase());
        $resultado = $manager->addUsuario($usuario);
        if($resultado > 0) {
          $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=activar&id=' . $resultado . '&data=' . sha1($resultado.$usuario->getCorreo()) . '">Activate</a>';
            $resultado2 = Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de activación: ' . $enlace);
        }
        return $resultado;
    }

    function recuperarClave($correo) {
        $manager = new ManageUsuario($this->getDataBase());
        $resultado = $manager->getFromCorreo($correo);
        if($resultado) {
          $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=restablecerClave&correo=' . $correo . '&data=' . sha1($resultado->getCorreo()). '">Restablecer la contraseña</a>';
            Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de recuperar clave: ' . $enlace);
        }
        return $resultado;
    }
    
    function avisoUsuario($correo) {
        $manager = new ManageUsuario($this->getDataBase());
        $resultado = $manager->getFromCorreo($correo);
        if($resultado) {
          $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=nuevoClave&correo=' . $correo . '&data=' . sha1($resultado->getCorreo()). '">Nueva la contraseña</a>';
            Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de nueva clave: ' . $enlace);
        }
        return $resultado;
    }

    function setCorreo(Usuario $usuario, $correo) {
        $res = 0;
        $manager = new ManageUsuario($this->getDataBase());
        $user = $manager->getFromCorreo($usuario->getCorreo());
        $user->setCorreo($correo);
        $user->setVerificado(0);
        $res = $manager->editSinClave($user);
        if($res > 0) {
           $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=activar&id=' . $resultado . '&data=' . sha1($resultado.$usuario->getCorreo()). '">activate</a>';
            $resultado2 = Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de activación: ' . $enlace);
        }
        return $res;
    }
    
    function setCorreo2(Usuario $usuario, $correo) {
        $res = 0;
        $manager = new ManageUsuario($this->getDataBase());
        $user = $manager->getFromCorreo($usuario->getCorreo());
        $user->setCorreo($correo);
        $user->setVerificado(0);
        $res = $manager->editSinClave($user);
        $manager2 = new ManageUsuario($this->getDataBase());
        $user2 = $manager2->getFromCorreo($usuario->getCorreo());
        if($res > 0) {
           $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=activar&id=' . $user2->getId() . '&data=' . sha1($user2->getId().$user2->getCorreo()). '">activate</a>';
            $resultado2 = Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de activación: ' . $enlace);
        }
        return $res;
    }
    
    function setCorreoPassword(Usuario $usuario, $correo, $clave) {
        $res = 0;
        $manager = new ManageUsuario($this->getDataBase());
        $user = $manager->getFromCorreo($usuario->getCorreo());
        if($user->getCorreo() !== $correo) {
            $user->setCorreo($correo);
            $user->setVerificado(0);
        }
        $user->setClave($clave);
        $res = $manager->edit($user);
        if($user->getVerificado() === 0 && $res > 0) {
            $enlace = '<a href="https://daw-php-davidga.c9users.io/mymvc2018_2/index.php?ruta=index&accion=activar&id=' . $resultado . '&data=' . sha1($resultado.$usuario->getCorreo()). '">activate</a>';
            $resultado2 = Util::enviarCorreo (Constants::CORREO, Constants::APPNAME, 'Mensaje con el enlace de activación: ' . $enlace);
        }
        return $res;
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
  