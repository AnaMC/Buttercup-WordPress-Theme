<?php

class ManageUsuario {

    private $db;

    function __construct(DataBase $db) {
        $this->db = $db;
    }
    
    public function getFromNombreUsuario($nombreusuario){
        $sql = 'select * from member where login = :nombreusuario';
        $params = array(
            'nombreusuario' => $nombreusuario
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $objeto = new Usuario();
        if($resultado && $fila = $sentencia->fetch()) {
            $objeto->set($fila);
        } else {
            $objeto = null;
        }
        return $objeto;
    }

    /* -- insertar cliente base de datos -- */
    
    function addCliente($cliente){
        $sql = 'insert into client (name, surname, tin, address, location, postalcode, province, email)
            values (:name, :surname, :tin, :address, :location, :postalcode, :province, :email)';
        
        $params = array(
            'name' => $cliente->getName(),
            'surname' => $cliente->getSurname(),
            'tin' => $cliente->getTin(),
            'address' => $cliente->getAddress(),
            'location' => $cliente->getLocation(),
            'postalcode' => $cliente->getPostalcode(),
            'province' => $cliente->getProvince(),
            'email' => $cliente->getEmail()
        );
        $result = $this->db->execute($sql, $params);
        if($result) {
            $id = $this->db->getId();
            $cliente->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }
    
    /* -- insertar producto base de datos -- */
    
    public function addProducto($producto){
        $sql = 'insert into product (idfamily, product, price, description) 
            values (:idfamily, :product, :price, :description)';
        $params = array(
            'idfamily' => $producto->getIdfamily(),
            'product' => $producto->getProduct(),
            'price' => $producto->getPrice(),
            'description' => $producto->getDescription()
        );
        $result = $this->db->execute($sql, $params);
        if($result) {
            $id = $this->db->getId();
            $producto->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }
    /* borrar producto base de datos */
    
        public function removeProducto($id){
        $sql = 'delete from product where id = :id';
        $params = array(
            'id' => $id
        );
        $resultado = $this->db->execute($sql, $params);
        return $resultado;
    }
    
    /* borrar cliente base de datos */
    public function removeCliente($id){
        $sql = 'delete from client where id = :id';
        $params = array(
            'id' => $id
        );
        $resultado = $this->db->execute($sql, $params);
        return $resultado;
    } 

    public function addUsuario(Usuario $objeto) {
        $sql = 'insert into usuario (nombre, apellidos, nombreusuario, correo, clave, tipo, fechaalta, verificado)
        VALUES (:nombre, :apellidos, :nombreusuario, :correo, :clave, :tipo, :fechaalta, :verificado)';
        $params = array(
            'nombre' => $objeto->getNombre(),
            'apellidos' => $objeto->getApellidos(),
            'nombreusuario' => $objeto->getUser(),
            'correo' => $objeto->getCorreo(),
            'clave' => Util::encriptar($objeto->getClave(), 10),
            'tipo' => $objeto->getTipo(),
            'fechaalta' => $objeto->getFecha(),
            'verificado' => $objeto->getVerificado(),
        );
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $id = $this->db->getId();
            $objeto->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }

    public function editUser($objeto) {
        $sql = 'UPDATE usuario SET nombre = :nombre, apellidos = :apellidos, nombreusuario = :nombreusuario, clave = :clave,
        correo = :correo  WHERE id = :id';
        $params = array(
            'nombre' => $objeto->getNombre(),
            'apellidos' => $objeto->getApellidos(),
            'clave' => Util::encriptar($objeto->getClave(), 10),
            'nombreusuario' => $objeto->getUser(),
            'correo' => $objeto->getCorreo(),
            'id' => $objeto->getId()
        );
        $res = $this->db->execute($sql, $params);
        return $res;
    }
    
    public function editAdmin($objeto){
        $sql = 'UPDATE usuario SET nombre = :nombre, apellidos = :apellidos, nombreusuario = :nombreusuario, clave = :clave,
        correo = :correo, tipo = :tipo, verificado = :verificado WHERE id = :id';
        $params = array(
            'nombre' => $objeto->getNombre(),
            'apellidos' => $objeto->getApellidos(),
            'clave' => Util::encriptar($objeto->getClave(), 10),
            'nombreusuario' => $objeto->getUser(),
            'correo' => $objeto->getCorreo(),
            'tipo' => $objeto->getTipo(),
            'verificado' => $objeto->getVerificado(),
            'id' => $objeto->getId()
        );
        $res = $this->db->execute($sql, $params);
        return $res;
    }
    
    

    public function editClave(Usuario $objeto) {
        $sql = 'update usuario set clave = :clave where id = :id';
        $params = array(
            'clave' => Util::encriptar($objeto->getClave(), 10),
            'id' => $objeto->getId()
        );
        $resultado = $this->db->execute($sql, $params);
        if($resultado) {
            $filasAfectadas = $this->db->getRowNumber();
        } else {
            $filasAfectadas = -1;
        }
        return $filasAfectadas;
    }

    public function editSinClave($objeto) {
        $sql = 'UPDATE usuario SET nombre = :nombre, apellidos = :apellidos, nombreusuario = :nombreusuario, correo = :correo, verificado = :verificado  WHERE id = :id';
        $params = array(
            'nombre' => $objeto->getNombre(),
            'apellidos' => $objeto->getApellidos(),
            'nombreusuario' => $objeto->getUser(),
            'correo' => $objeto->getCorreo(),
            'id' => $objeto->getId(),
            'verificado' => $objeto->getVerificado()
        );
        $res = $this->db->execute($sql, $params);
        return $res;
    }
    
    public function editSinClave2($objeto) {
        $sql = 'UPDATE usuario SET nombre = :nombre, apellidos = :apellidos, nombreusuario = :nombreusuario, correo = :correo, verificado = :verificado  WHERE id = :id';
        $params = array(
            'nombre' => $objeto->getNombre(),
            'apellidos' => $objeto->getApellidos(),
            'nombreusuario' => $objeto->getUser(),
            'correo' => $objeto->getCorreo(),
            'id' => $objeto->getId(),
            'verificado' => $objeto->getVerificado()
        );
        $res = $this->db->execute($sql, $params);
        if($res) {
            $id = $this->db->getId();
            $objeto->setId($id);
        } else {
            $id = 0;
        }
        return $id;
    }
    
    public function getClient($id) {
        $sql = 'select * from client where id = :id';
        $params = array(
            'id' => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $client = new Client();
        if($resultado && $fila = $sentencia->fetch()) {
            $client->set($fila);
        } else {
            $client = null;
        }
        return $client;
    }

    public function get($id) {
        $sql = 'select * from usuario where id = :id';
        $params = array(
            'id' => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $objeto = new Usuario();
        if($resultado && $fila = $sentencia->fetch()) {
            $objeto->set($fila);
        } else {
            $objeto = null;
        }
        return $objeto;
    }

    public function getAll() {
        $sql = 'select * from usuario where 1';
        $resultado = $this->db->execute($sql);
        $objetos = array();
        if($resultado){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()) {
                $objeto = new Usuario();
                $objeto->set($fila);
                $objetos[] = $objeto;
            }
        }
        return $objetos;
    }
    
    /* --- limitado de datos por paginacion --- */
    
    function getAllLimit($offset , $rpp){
        $sql = 'select * from client order by name limit ' . $offset . ',' . $rpp . ';';
        $res = $this->db->execute($sql);
        $datos = array();
        if($res){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()){
                $client = new Client();
                $client->set($fila);
                $datos[] = $client;
            }
        }
        return $datos;
    }
    
    function getAllLimitProduct($offset , $rpp){
        $sql = 'select * from product order by product limit ' . $offset . ',' . $rpp . ';';
        $res = $this->db->execute($sql);
        $datos = array();
        if($res){
            $sentencia = $this->db->getStatement();
            while($fila = $sentencia->fetch()){
                $product = new Product();
                $product->set($fila);
                $datos[] = $product;
            }
        }
        return $datos;
    }
    
    function countUsers() {
        $sql = 'select count(*) from usuario WHERE 1';
        $res = $this->db->execute($sql);
        $cuenta = 0;
        if($res) {
            $sentencia = $this->db->getStatement();
            if($fila = $sentencia->fetch()) {
                $cuenta = $fila[0];
            }
        }
        return $cuenta;
    }
    
    function countAdmin(){
        $sql = 'select count(*) from usuario where tipo = \'administrador\'';
        $res = $this->db->execute($sql);
        $cuenta = 0;
        if($res){
            $sentencia = $this->db->getStatement();
            if($fila = $sentencia->fetch()) {
                $cuenta = $fila[0];
            }
        }
        return $cuenta;
    }

    public function getFromEmail($email) {
        $sql = 'select * from cliente where email = :email';
        $params = array(
            'email' => $email
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $objeto = new Cliente();
        if($resultado && $fila = $sentencia->fetch()) {
            $objeto->set($fila);
        } else {
            $objeto = null;
        }
        return $objeto;
    }

    
    public function getVerifId($id) {
        $sql = 'select verificado from usuario where id = :id';
        $params = array(
            'id' => $id
        );
        $resultado = $this->db->execute($sql, $params);//true o false
        $sentencia = $this->db->getStatement();
        $objeto = new Usuario();
        if($resultado && $fila = $sentencia->fetch()) {
            $objeto->set($fila);
        } else {
            $objeto = null;
        }
        return $objeto;
    }
    
    function noVerificado($correo){
        $sql = 'update usuario set verificado = 0 where correo = :correo';
        $params =  array(
            'correo' => $correo
            );
        $res = $this->database->execute($sql, $params);
        return $resultado;
    }
    


}