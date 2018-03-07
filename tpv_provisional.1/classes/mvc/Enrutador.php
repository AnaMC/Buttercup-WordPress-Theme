<?php

class Enrutador {
    
    private $rutas = array();

    function __construct() {
       // $this->rutas['index'] = new Ruta('ModeloUsuario', 'VistaUsuario', 'ControladorUsuario');
       // $this->rutas['index'] = new Ruta('Modelo' , 'Vista' , 'Controlador');
        
        /* -- Miembro -- */
        $this->rutas['member'] = new Ruta('ModeloMember' , 'VistaMember' , 'ControladorMember');
        /*-- Cliente --*/
        $this->rutas['client'] = new Ruta('ModeloClient' , 'VistaClient' , 'ControladorClient');
        /*-- Product --*/
        $this->rutas['product'] = new Ruta('ModeloProduct' , 'VistaProduct' , 'ControladorProduct');
        //añadir rutas
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['member'];
        }
        return $this->rutas[$ruta];
    }
}