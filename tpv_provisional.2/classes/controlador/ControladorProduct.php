<?php

class ControladorProduct extends Controlador { 

    function __construct(Modelo $modelo) {
        parent::__construct($modelo);
    }
    
        /* --- plantilla Insertar producto --- */

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
    
    /* --- insertar nuevo producto --- */
    
    function doInsertarProducto() {
        $producto = new Product();
        $producto->read();
        $resultado = $this->getModel()->insertarProductoBD($producto);
       // header('Location: ?ruta=product&accion=listaProducto');
        header('Location: ?ruta=product&accion=listaProducto');
    }

     /* --- borrar producto --- */ 
     
    function doborrarProducto() {
          if ($this->isLogged()){
            $id = Request::read('id');
            $res = $this->getModel()->borrarProductoBD($id);
            header('Location: ?ruta=product&accion=listaProducto');
        }else{
            $this->index();
        }
    }
    
    /* --- plantilla editar producto --- */ 
    
        function editarProducto() {
        $id = Request::read('id');
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_editar_producto.html');
            $productoEditar = $this->getModel()->getProduct($id);
            $this->getModel()->setDatos($productoEditar->getAttributesValues());
        } else {
            $this->index();
        }
         $this->getModel()->setDato('mensaje', $this->getModel()->setDatos($productoEditar->getAttributesValues()));
    }
    
    /* -- editar nuevo producto --*/
     
    function doeditarProducto() {
        if($this->isLogged()){
            $producto = new Product();
            $producto->read();
            $r = $this->getModel()->editarProductoBD($producto);
            header('Location: ?ruta=product&accion=listaProducto');
           // header('Location: ?ruta=product&op=doeditarProducto&res=' . $r);
           // exit();
        }else{
            $this->index();
        }
    }
    
    

    
    /* --- Lista de producto --- */
    function listaProducto() {
        if($this->isLogged()) {
            $header = file_get_contents("plantilla/_header.html");
            $this->getModel()->setDato('header', $header);
            $footer = file_get_contents("plantilla/_footer.html");
            $this->getModel()->setDato('footer', $footer);
            $this->getModel()->setDato('archivo' , '_listado_producto.html');
            $page = Request::read('page');
            if($page === null){
                $page = 1;
            }
            $rows = $this->getModel()->countProductos();
            $rpp = 3;
            $pagination = new Pagination($rows , $page , $rpp);
            $productos = $this->getModel()->getAllLimitProductos($pagination->getOffset() , $pagination->getRpp());
            $todo = '';
            
            //$familia = $this->getModel()->getFamilias();
            
            foreach($productos as $indice => $producto) {
                 $r = '<tr>
                        <td>' . $producto->getProduct() . '</td> 
                        <td>' . $producto->getPrice() . '</td> 
                        <td>' . $producto->getDescription() . '</td> 
                        <td>' . $this->getModel()->getNombreFamilia($producto->getIdfamily())->getFamily() . '</td> 
                        <td><img style="width: 100px;" src="img/productos/' . $producto->getId() . '.jpg"></td>
                        <td>
                            <a href="?ruta=product&accion=editarProducto&id=' . $producto->getId() . '"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-success" data-original-title="Ver más detalle">
                                <i class="fa fa-search"></i>
                            </a>
                        </td> 
                        <td>
                            <a href="?ruta=product&accion=doborrarProducto&id=' . $producto->getId() . '"
                            onclick="return confirm(\'¿Quieres borrar ' . $producto->getProduct() . '?\');"
                            data-toggle="tooltip" title class="btn btn-effect-ripple btn-sm btn-danger" data-original-title="Eliminar el producto">
                                <i class="fa fa-times"></i>
                            </a>
                        </td> 
                    </tr>';
                $todo .= $r;
            }
            $this->getModel()->setDato('lineasUsuario', $todo);
            //$this->getModel()->setDato('mensaje', $this->getModel()->getNombreFamilia(1));
            
            $clickPaginacion = '<ul class="pagination" id="pagination">
                                <li><a href="?ruta=product&accion=listaProducto&page=' . $pagination->getFirst() . '"><i class="fa fa-chevron-left "></i><i class="fa fa-chevron-left"></i></a></li>
                                <li><a href="?ruta=product&accion=listaProducto&page=' . $pagination->getPrevius() . '"><i class="fa fa-chevron-left "></i></a></li>';
            $rango = $pagination->getRange();
            foreach ($rango as $pagina) {
                $clickPaginacion .= '<li><a href="?ruta=product&accion=listaProducto&page=' . $pagina . '">' . $pagina . '</a></li>';
            }
            $clickPaginacion .= '<li><a href="?ruta=product&accion=listaProducto&page=' . $pagination->getNext() . '"><i class="fa fa-chevron-right "></i></a></li>
                                 <li><a href="?ruta=product&accion=listaProducto&page=' . $pagination->getLast() . '"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
                                </ul>';
            $this->getModel()->setDato('clickPaginacion', $clickPaginacion);
            
        } else {
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
    
    function verproduct() {
        if($this->isLogged()) {
            header('Content-type: image/*');
            $archivo = 'img/productos' . $this->getUser()->getId();
            if(!file_exists($archivo)) {
                $archivo = 'img/productos/0';
            }
            readfile($archivo);
            exit();
        } else {
            $this->index();
        }
    }
    
    
}