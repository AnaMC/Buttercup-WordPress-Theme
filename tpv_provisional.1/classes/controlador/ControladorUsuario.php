<?php

class ControladorUsuario extends Controlador { 

    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }
    

    /*--- redireccion --- */
    
    function tpv() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_tpv.html');
        } else {
            $this->index();
        }
    }
    


    
    function doagregarusuarior(){
        $nombre = Request::read('nombre');
        $apellidos = Request::read('apellidos');
        $nombreusuario = Request::read('nombreusuario');
        $correo = Request::read('correo');
        $clave = Request::read('clave');
        $tipo = Request::read('tipo');
        $verificado = Request::read('verificado');
        $aviso = Request::read('avisousuario');
        $usuarioDB = $this->getModel()->loginCorreo($correo);
        if($this->getSesion()->getUser()->getTipo() === 'administrador'){
            if(Filter::isEmail($correo)){
                if($usuarioDB){
                    $this->getModel()->setDato('mensaje', 'Ya tienes alta tu correo');
                } else {
                    $usuario = new Usuario(null, $nombre, $apellidos , $nombreusuario , $correo , $clave, date("Y-m-d H:i:s"), $tipo, $verificado);
                    $this->getModel()->agregarUsuario($usuario);
                    if($aviso === '1'){
                        $this->getModel()->avisoUsuario($correo);
                    }
                    $this->getModel()->setDato('mensaje', 'Alta nuevo usuario correcto');
                    
                }
            }else{
                $this->getModel()->setDato('mensaje', 'No correcto correo');
            }
        } else {
            //exit();
        }
        $this->index();
    }
    
    function nuevoClave(){
        $email = Request::read('correo');
        $data = Request::read('data');
        $this->getModel()->setDato('correo' , $email);
        $this->getModel()->setDato('data' , $data);
            
        $header = file_get_contents("plantilla/_header.html");
        $this->getModel()->setDato('header', $header);
        $footer = file_get_contents("plantilla/_footer.html");
        $this->getModel()->setDato('footer', $footer);
        $this->getModel()->setDato('archivo' , '_nuevoclave.html');
    }
    
    function doNuevoClave() {
            $correo = Request::read('correooculta');
            $data = Request::read('data');
            $nuevoClave = Request::read('nuevoclave');
            $repetidaClave = Request::read('repetidaclave');
            $usuarioDB = $this->getModel()->loginCorreo($correo);
            $dataDB = sha1($usuarioDB->getCorreo());
            if($nuevoClave === $repetidaClave){
                if($data === sha1($usuarioDB->getCorreo())){
                    $usuarioDB->setClave($nuevoClave);
                    $this->getModel()->editClave($usuarioDB);
                    $this->getModel()->setDato('mensaje', 'Guardar nueva contraseña.' . $dataDB);
                } else {
                  $this->getModel()->setDato('mensaje', 'No estás registrado.' . $dataDB);  
                }
            } else {
                 $this->getModel()->setDato('mensaje', 'No coincidir contraseña.' . $dataDB);
            }
            $this->index();
    }
   
    function editUser(){
        if($this->getUser()->getTipo() === 'administrador'){
            $usuario = new Usuario();
            $usuario->read();
            $res = $this->getModel()->editUserAdmin($usuario);
            header('Location: index.php?op=editUserAdmin&res=' . $res);
            exit;
        }elseif($this->getUser()->getId() === $id){
            
        }else{
            $this->index();
        }
    }

    
    function doeditarusuario(){
        $usuario = new Usuario();
        $usuario->read();
        $claveAnterior = Request::read('claveAnterior');
        $claveRepetida = Request::read('claveRepetida');
        $usuarioDB = $this->getModel()->getUser($usuario->getId());

        if($usuarioDB->getTipo() === 'administrador' || $usuarioDB->getTipo() === 'avanzado'){
            if($usuario->getClave() === null){
                $this->getModel()->editSinClave($usuario);
                $this->getModel()->setDato('mensaje', 'Editar correcto.');
            } else {
                if($usuario->getClave() === $claveRepetida){
                        $this->getModel()->editUser($usuario);
                        $this->getModel()->setDato('mensaje', 'Editar correcto.');
                    } else {
                        $this->getModel()->setDato('mensaje', 'No conicidir contrasñea');
                    }
                } 
        } else {
            if($usuario->getCorreo() !== $usuarioDB->getCorreo()){
                if($usuario->getClave() === null){
                    $this->getModel()->editSinClave($usuario);
                    $this->getModel()->setDato('mensaje', 'Editar correcto.');
                } else {
                    if($usuario->getClave() === $claveRepetida){
                        $this->getModel()->editUser($usuario);
                        $this->getModel()->setDato('mensaje', 'Editar correcto.');
                    } else {
                        $this->getModel()->setDato('mensaje', 'No conicidir contrasñea');
                    }
                }
                $this->getModel()->setCorreo2($usuario, $usuario->getCorreo());
            } else {
                if($usuario->getClave() === null){
                    $this->getModel()->editSinClave($usuario);
                    $this->getModel()->setDato('mensaje', 'Editar correcto.');
                } else {
                    if($usuario->getClave() === $claveRepetida){
                        $this->getModel()->editUser($usuario);
                        $this->getModel()->setDato('mensaje', 'Editar correcto.');
                } else {
                    $this->getModel()->setDato('mensaje', 'No conicidir contrasñea');
                }
            }
         }
 
        }
        $this->index();
    }

    function editarusuarioadministrador(){
        $id = Request::read('id');
        if($this->getUser()->getTipo() === 'administrador'){
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $archivo = '_editarusuarioadmin.html';
            $this->getModel()->setDato('archivo' , $archivo);
            $useredit = $this->getModel()->getUser($id);
            $this->getModel()->setDatos($useredit->getAttributesValues());
            
            if($useredit->getVerificado() === '1'){
                $checked = 'checked'; 
            } else {
                $checked = '';
            }
            $this->getModel()->setDato('checked' , $checked);
            
        } else{
            $this->index();
        }
    }
    


    
    function subirfoto() {
       if($this->isLogged()) {
            $subir = new FileUpload('foto', $this->getUser()->getId(), '../../foto', 2 * 1024 * 1024, FileUpload::SOBREESCRIBIR);
            $r = $subir->upload();
            header('Location: index.php?op=subirfoto&res=' . $r);
            exit();
            
        } else {
           $this->index();
        }
    }
    
    function veravatar() {
        if($this->isLogged()) {
            header('Content-type: image/*');
            $archivo = '../../foto/' . $this->getUser()->getId();
            if(!file_exists($archivo)) {
                $archivo = '../../foto/0';
            }
            readfile($archivo);
            exit();
        } else {
            $this->index();
        }
    }
    
}