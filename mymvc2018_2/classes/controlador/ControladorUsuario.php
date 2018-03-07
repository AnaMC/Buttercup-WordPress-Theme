<?php

class ControladorUsuario extends Controlador { 

    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }
    
    function index() {
        //$op = Request::read('op');
        //$res = request::read('res');
        //$this->getModel()->setDato('mensaje', $op . ' ' . $res);
        if($this->isLogged()) {
            $this->getModel()->setDato('archivo', '_index_logueado.html');
            if($this->getSesion()->getUser()->getTipo() === 'administrador') {
                $enlace = '<h2><a href="?accion=administrar">administrar</a></h2>';
                $this->getModel()->setDato('indexadministrador', $enlace);
            }
        } else {
            $this->getModel()->setDato('archivo', '_index_nologueado.html');
        }
        $header = file_get_contents("plantilla/_header.html");
        $this->getModel()->setDato('header', $header);
        $footer = file_get_contents("plantilla/_footer.html");
        $this->getModel()->setDato('footer', $footer);
        
    }

    function activar() {
        $id = Request::read('id');
        $data = Request::read('data');
        $r = $this->getModel()->activarUsuario($id, $data);
        if($r > 0){
            $this->getModel()->setDato('mensaje' , 'Alta activación.');
        } else {
            $this->getModel()->setDato('mensaje' , 'No puedo alta activación y por favor contacto con administrador');
        }
        $this->index();

    }

    function administrar() {
        
        if($this->getSesion()->getUser()->getTipo() === 'administrador') {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_administrarusuarios.html');
            $linea = '<tr>
                        <td>{{id}}</td> 
                        <td>{{nombre}}</td> 
                        <td>{{apellidos}}</td> 
                        <td>{{correo}}</td> 
                        <td>{{tipo}}</td> 
                        <td>
                            <a href="?ruta=index&accion=editarusuarioadministrador&id={{id}}"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-success" data-original-title="Editar usuario">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td> 
                        <td>
                            <a href="?ruta=index&accion=borrarusuario&id={{id}}"
                            onclick="return confirm(\'¿Quieres borrar {{correo}}?\');"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar usuario">
                                <i class="fa fa-times"></i>
                            </a>
                        </td> 
                    </tr>';
            //$usuarios = $this->getModel()->getUsuarios();
            $page = Request::read('page');
            if($page === null){
                $page = 1;
            }
            $rows = $this->getModel()->countUsusarios();
            $rpp = 3;
            $pagination = new Pagination($rows , $page , $rpp);
            $usuarios = $this->getModel()->getAllLimitUsuarios($pagination->getOffset() , $pagination->getRpp());
            $todo = '';
            foreach($usuarios as $indice => $usuario) {
                $r = Util::renderText($linea, $usuario->getAttributesValues());
                $todo .= $r;
            }
            $this->getModel()->setDato('lineasUsuario', $todo);
            
            $clickPaginacion = '<ul class="pagination" id="pagination">
                                <li><a href="?accion=administrar&page=' . $pagination->getFirst() . '"><i class="fa fa-chevron-left "></i><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="?accion=administrar&page=' . $pagination->getPrevius() . '"><i class="fa fa-chevron-left "></i></a></li>';
            $rango = $pagination->getRange();
            foreach ($rango as $pagina) {
                $clickPaginacion .= '<li><a href="?accion=administrar&page=' . $pagina . '">' . $pagina . '</a></li>';
            }
            $clickPaginacion .= '<li><a href="?accion=administrar&page=' . $pagination->getNext() . '"><i class="fa fa-chevron-right "></i></a></li>
                                 <li><a href="?accion=administrar&page=' . $pagination->getLast() . '"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
                                </ul>';
            $this->getModel()->setDato('clickPaginacion', $clickPaginacion);
            
        } else {
            $this->index();
        }
    }
    
    function agregarUsuario() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_agregarusuario.html');
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
    
    function cerrarsesion() {
        $this->getSesion()->close();
        header('Location: index.php?op=logout');
        exit();
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
    
    function editarusuario() {
        $id = Request::read('id');
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_editarusuario.html');
            $archivo = '_editarusuario.html';
            $this->getModel()->setDato('archivo' , $archivo);
            $useredit = $this->getModel()->getUser($id);
            $this->getModel()->setDatos($useredit->getAttributesValues());
        } else {
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
    
    function doeditarusuarioadministrador(){
        $verificado = Request::read('checkboxVerificado');
        if($this->getUser()->getTipo() === 'administrador'){
            $usuario = new Usuario();
            $usuario->read();
            $res = $this->getModel()->editUserAdmin($usuario);
            if($verificado === '1'){
                $this->getModel()->verificarUsuarioEditarAdmin($usuario->getId());
            }
            header('Location: index.php?op=editUserAdmin&res=' . $res);
            exit;
        }elseif($this->getUser()->getId() === $id){
            
        }else{
            $this->index();
        }
    }

    function login(){
        $correo = Request::read('correo');
        $clave = Request::read('clave');
        if(Filter::isEmail($correo)){
            $usuarioDB = $this->getModel()->loginCorreo($correo);
        } else {
            $usuarioDB = $this->getModel()->loginNombreUsuario($correo);
        }
        if($usuarioDB !== null) {
            if(Util::verificarClave($clave , $usuarioDB->getClave())){
                if($usuarioDB->getVerificado() === '1'){
                    $this->getSesion()->login($usuarioDB);
                    $this->getModel()->setDato('id' , $this->getSesion()->getUser()->getId());
                    $this->getModel()->setDato('correo' , $this->getSesion()->getUser()->getNombre());
                } else {
                    $this->getModel()->setDato('mensaje', 'Aun no has verificado tu email.'); 
                }
            } else {
                $this->getModel()->setDato('mensaje', 'Las contraseña no es correcta.');
            } 
            
        } else {
            $this->getModel()->setDato('mensaje', 'No estás registrado.');
        }
        $this->index();
    }
    
    function recuperar() {
        $correo = Request::read('correo');
        $usuarioDB = $this->getModel()->loginCorreo($correo);
        if(Filter::isEmail($correo)){
            if($correo === $usuarioDB->getCorreo()){ 
                    $this->getModel()->recuperarClave($usuarioDB->getCorreo());
                    $this->getModel()->setDato('mensaje', 'Te he enviado tu correo para recuperar clave.');
            } else {
                $this->getModel()->setDato('mensaje', 'No estás registrado.');
            }
        } else {
             $this->getModel()->setDato('mensaje', 'No correcto correo');
        }
        $this->index();
    }
    
    function restablecerClave() {
        $email = Request::read('correo');
        $data = Request::read('data');
        $this->getModel()->setDato('correo' , $email);
        $this->getModel()->setDato('data' , $data);
            
        $header = file_get_contents("plantilla/_header.html");
        $this->getModel()->setDato('header', $header);
        $footer = file_get_contents("plantilla/_footer.html");
        $this->getModel()->setDato('footer', $footer);
        $this->getModel()->setDato('archivo' , '_restablecerClave.html');
    }
    
    function doRestablecerClave() {
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
    
    function reenviarCorreoActivacion() {
        $correo = Request::read('correo');
        $usuarioDB = $this->getModel()->loginCorreo($correo);
        if(Filter::isEmail($correo)){
            if($correo === $usuarioDB->getCorreo()){
                if($usuarioDB->getVerificado() !== '1'){
                    $this->getModel()->reenviaCorreoActiva($usuarioDB->getCorreo());
                    $this->getModel()->setDato('mensaje', 'Te he reenviado tu correo para activación.');
                } else {
                    $this->getModel()->setDato('mensaje', 'Has verificado tu email.');
                }
            } else {
                $this->getModel()->setDato('mensaje', 'No estás registrado.');
            }
        } else {
             $this->getModel()->setDato('mensaje', 'No correcto correo');
        }
        $this->index();
    }
    
    function registro() {
        $nombre = Request::read('nombre');
        $apellidos = Request::read('apellidos');
        $nombreusuario = Request::read('nombreusuario');
        $correo = Request::read('correo');
        $clave = Request::read('clave');
        $claveRepetida = Request::read('claveRepetida');
        $usuarioDB = $this->getModel()->loginCorreo($correo);
        if(Filter::isEmail($correo)){
            if($clave === $claveRepetida){
                if($usuarioDB > 0){
                    $this->getModel()->setDato('mensaje', 'Ya tienes alta tu correo');
                } else {
                    $usuario = new Usuario(null, $nombre, $apellidos , $nombreusuario , $correo , $clave, date("Y-m-d H:i:s"));
                    $this->getModel()->registrar($usuario);
                    $this->getModel()->setDato('mensaje', 'Alta correcto');
                }
            } else {
            $this->getModel()->setDato('mensaje', 'No coincidir contraseña');
            }
        }else{
            $this->getModel()->setDato('mensaje', 'No correcto correo');
        }
        $this->index();
    }
    
    function borrarusuario(){
        $id = Request::read('id');
        if($this->getUser()->getTipo() === 'administrador'){
            if($this->getModel()->countAdmin() === '1' && $this->getModel()->getUser($id)->getTipo() === 'administrador'){
                $this->getModel()->setDato('mensaje' , 'No puedo borrar porque eres ultimo administrador');
            } else {
                $res = $this->getModel()->deleteUser($id);
                $this->getModel()->setDato('mensaje' , 'Borrado usuario');
            }
        } 
        $this->index();
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