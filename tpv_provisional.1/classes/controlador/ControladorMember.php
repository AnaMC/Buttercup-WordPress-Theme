<?php

class ControladorMember extends Controlador { 
    
    /*function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }*/

 function index() {
        if($this->isLogged()) {
            $this->getModel()->setDato('archivo', '_index_logueado.html');
        } else {
            $this->getModel()->setDato('archivo', '_index_nologueado.html');
        }
        $header = file_get_contents("plantilla/_header.html");
        $this->getModel()->setDato('header', $header);
        $footer = file_get_contents("plantilla/_footer.html");
        $this->getModel()->setDato('footer', $footer);
        
    }
    
    /* --- acceso member --- */
    
    function login(){
        $member = Request::read('member');
        $clave = Request::read('clave');
        $usuarioDB = $this->getModel()->loginNombreUsuario($member);
        if($usuarioDB !== null) {
            if(Util::verificarClave($clave , $usuarioDB->getClave())){
                    $this->getSesion()->login($usuarioDB);
                    $this->getModel()->setDato('login' , $this->getSesion()->getUser()->getLogin());
            } else {
                $this->getModel()->setDato('mensaje', 'Las contraseña no es correcta.');
            } 
            
        } else {
            $this->getModel()->setDato('mensaje', 'No estás registrado.');
        }
        $this->index();
    }
    
       
    
    function cerrarsesion() {
        $this->getSesion()->close();
        header('Location: index.php?op=logout');
        exit();
    }
    
}