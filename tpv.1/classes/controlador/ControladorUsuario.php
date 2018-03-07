<?php

class ControladorUsuario extends Controlador { 

    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }
    
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
    
    /* --- acceso usuario --- */
    
    function login(){
        $usuario = Request::read('usuario');
        $clave = Request::read('clave');
        $usuarioDB = $this->getModel()->loginNombreUsuario($usuario);
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
    
    /* ---  Insertar cliente --- */
    
    function insertarCliente() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_insertar_cliente.html');
        } else {
            $this->index();
        }
    }
    
    /* ---  Insertar producto --- */

    function insertarProducto() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_insertar_producto.html');
        } else {
            $this->index();
        }
    }
    
        
    /* --- Borrar cliente --- */
        
    function doborrarCliente(){
        if($this->isLogged()){
            $cliente = $this->getModel()->getClient(Request::read('id'));
            $r = $this->getModel()->borrarClienteBD($cliente->getId());
            header('Location: ?ruta=index&accion=listaCliente');
        }else{
            $this->index();
        }
    }

     /* --- borrar producto --- */ 
     
    function doborrarProducto() {
          if ($this->isLogged()){
            $id = Request::read('id');
            $res = $this->getModel()->borrarProductoBD($id);
        }else{
            $this->index();
        }
    }
    
    /* --- insertar nuevo cliente --- */
     
    function doinsertarCliente() {
        if($this->isLogged()) {
            $cliente = new Client();
            $cliente->read();
            $resultado = -1;
            if(Filter::isEmail($cliente->getEmail())){
                $resultado = $this->getModel()->insertarClienteBD($cliente);
                header('Location: ?ruta=index&accion=listaCliente');
            } else {
                $this->getModel()->setDato('mensaje', 'El formato de correo no está bien');
            }
         } else {
            $this->index();
         }
    }

    
    /* --- insertar nuevo producto --- */
    
    function doInsertarProducto() {
        $producto = new Product();
        $producto->read();
        $resultado = $this->getModel()->insertarProductoBD($producto);
        header('Location: ?ruta=index&accion=listaProducto');
    }
    
    /* --- Lista de cliente --- */
    
    function listaCliente() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_listado_cliente.html');
            $linea = '<tr>
                        <td>{{name}}</td> 
                        <td>{{surname}}</td> 
                        <td>{{tin}}</td> 
                        <td>{{email}}</td> 
                        <td>
                            <a href="?ruta=index&accion=editarCliente&id={{id}}"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-success" data-original-title="Ver más detalle">
                                <i class="fa fa-search"></i>
                            </a>
                        </td> 
                        <td>
                            <a href="?ruta=index&accion=doborrarCliente&id={{id}}"
                            onclick="return confirm(\'¿Quieres borrar {{name}} {{surname}}?\');"
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
            $clientes = $this->getModel()->getAllLimitUsuarios($pagination->getOffset() , $pagination->getRpp());
            $todo = '';
            foreach($clientes as $indice => $cliente) {
                $r = Util::renderText($linea, $cliente->getAttributesValues());
                $todo .= $r;
            }
            $this->getModel()->setDato('lineasUsuario', $todo);
            
            $clickPaginacion = '<ul class="pagination" id="pagination">
                                <li><a href="?accion=listaCliente&page=' . $pagination->getFirst() . '"><i class="fa fa-chevron-left "></i><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="?accion=listaCliente&page=' . $pagination->getPrevius() . '"><i class="fa fa-chevron-left "></i></a></li>';
            $rango = $pagination->getRange();
            foreach ($rango as $pagina) {
                $clickPaginacion .= '<li><a href="?accion=listaCliente&page=' . $pagina . '">' . $pagina . '</a></li>';
            }
            $clickPaginacion .= '<li><a href="?accion=listaCliente&page=' . $pagination->getNext() . '"><i class="fa fa-chevron-right "></i></a></li>
                                 <li><a href="?accion=listaCliente&page=' . $pagination->getLast() . '"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
                                </ul>';
            $this->getModel()->setDato('clickPaginacion', $clickPaginacion);
            
        } else {
            $this->index();
        }
    }
    
    /* --- Lista de producto no terminado --- */
    function listaProducto() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_listado_producto.html');
            $linea = '<tr>
                        <td>{{product}}</td> 
                        <td>{{price}}</td> 
                        <td>{{description}}</td> 
                        <td>{{idfamily}}</td> 
                        <td>
                            <a href="?ruta=index&accion=doeditarProducto&id={{id}}"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-success" data-original-title="Ver más detalle">
                                <i class="fa fa-search"></i>
                            </a>
                        </td> 
                        <td>
                            <a href="?ruta=index&accion=doborrarProducto&id={{id}}"
                            onclick="return confirm(\'¿Quieres borrar {{product}}?\');"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar el producto">
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
            $productos = $this->getModel()->getAllLimitProductos($pagination->getOffset() , $pagination->getRpp());
            $todo = '';
            foreach($productos as $indice => $producto) {
                $r = Util::renderText($linea, $producto->getAttributesValues());
                $todo .= $r;
            }
            $this->getModel()->setDato('lineasUsuario', $todo);
            
            $clickPaginacion = '<ul class="pagination" id="pagination">
                                <li><a href="?accion=listaProducto&page=' . $pagination->getFirst() . '"><i class="fa fa-chevron-left "></i><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="?accion=listaProducto&page=' . $pagination->getPrevius() . '"><i class="fa fa-chevron-left "></i></a></li>';
            $rango = $pagination->getRange();
            foreach ($rango as $pagina) {
                $clickPaginacion .= '<li><a href="?accion=listaProducto&page=' . $pagina . '">' . $pagina . '</a></li>';
            }
            $clickPaginacion .= '<li><a href="?accion=listaProducto&page=' . $pagination->getNext() . '"><i class="fa fa-chevron-right "></i></a></li>
                                 <li><a href="?accion=listaProducto&page=' . $pagination->getLast() . '"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
                                </ul>';
            $this->getModel()->setDato('clickPaginacion', $clickPaginacion);
            
        } else {
            $this->index();
        }
    }
    
    
    
    /* --- Ver ficha de cliente  --- */
    
    function editarCliente(){
        $id = Request::read('id');
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_editar_cliente.html');
            $clientEdit = $this->getModel()->getClient($id);
            $this->getModel()->setDatos($clientEdit->getAttributesValues());
        } else{
            $this->index();
        }
        $this->getModel()->setDato('mensaje', $this->getModel()->setDatos($clientEdit->getAttributesValues()));
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