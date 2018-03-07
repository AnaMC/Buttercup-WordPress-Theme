<?php

class ControladorClient extends Controlador { 
    
    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }

    /* ---  plantilla Insertar cliente --- */
    
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
    
        /* --- insertar nuevo cliente --- */
     
    function doinsertarCliente() {
        if($this->isLogged()) {
            $cliente = new Client();
            $cliente->read();
            $resultado = -1;
            if(Filter::isEmail($cliente->getEmail())){
                $resultado = $this->getModel()->insertarClienteBD($cliente);
                header('Location: ?ruta=client&accion=listaCliente');
            } else {
                $this->getModel()->setDato('mensaje', 'El formato de correo no está bien');
            }
         } else {
            $this->index();
         }
    }

    
        /* --- Borrar cliente --- */
        
    function doborrarCliente(){
        if($this->isLogged()){
            $cliente = $this->getModel()->getClient(Request::read('id'));
            $r = $this->getModel()->borrarClienteBD($cliente->getId());
            header('Location: ?ruta=client&accion=listaCliente');
        }else{
            $this->index();
        }
    }
    
    /* --- ver ficha y editar cliente --- */
    
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
    
        function doeditarCliente(){
        if($this->isLogged()){
            $cliente = new Client();
            $cliente->read();
            $r = $this->getModel()->editarClienteBD($cliente);
          //  header('Location: ?ruta=client&op=doeditarCliente&res=' . $r);
            header('Location: ?ruta=client&accion=listaCliente');
            exit();
        }else{
            $this->index();
        }
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
                            <a href="?ruta=client&accion=editarCliente&id={{id}}"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-success" data-original-title="Ver más detalle">
                                <i class="fa fa-search"></i>
                            </a>
                        </td> 
                        <td>
                            <a href="?ruta=client&accion=doborrarCliente&id={{id}}"
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
            $rows = $this->getModel()->countClientes();
            $rpp = 3;
            $pagination = new Pagination($rows , $page , $rpp);
            $clientes = $this->getModel()->getAllLimitClientes($pagination->getOffset() , $pagination->getRpp());
            $todo = '';
            foreach($clientes as $indice => $cliente) {
                $r = Util::renderText($linea, $cliente->getAttributesValues());
                $todo .= $r;
            }
            $this->getModel()->setDato('lineasUsuario', $todo);
            
            $clickPaginacion = '<ul class="pagination" id="pagination">
                                <li><a href="?ruta=client&accion=listaCliente&page=' . $pagination->getFirst() . '"><i class="fa fa-chevron-left "></i><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="?accion=listaCliente&page=' . $pagination->getPrevius() . '"><i class="fa fa-chevron-left "></i></a></li>';
            $rango = $pagination->getRange();
            foreach ($rango as $pagina) {
                $clickPaginacion .= '<li><a href="?ruta=client&accion=listaCliente&page=' . $pagina . '">' . $pagina . '</a></li>';
            }
            $clickPaginacion .= '<li><a href="?ruta=client&accion=listaCliente&page=' . $pagination->getNext() . '"><i class="fa fa-chevron-right "></i></a></li>
                                 <li><a href="?ruta=client&accion=listaCliente&page=' . $pagination->getLast() . '"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
                                </ul>';
            $this->getModel()->setDato('clickPaginacion', $clickPaginacion);
            
            $this->getModel()->setDato('mensaje', $rows);
            
        } else {
            $this->index();
        }
    }
}    