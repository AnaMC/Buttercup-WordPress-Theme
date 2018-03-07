<?php

class ModeloProduct extends Modelo{
        
        function get($id, $json = false){
            $manager = new ManageProduct();
            $producto = $manager->get($id);
            if($json){
                 return $product->json();
            }else{
                return $product;
            }
           
        }
        
        function getList($json = false){
            $manager = new ManageProduct();
            $list =  $manager->getList();
            
            if($json){
                return $this->_json($list);
            }else{
                return $list;
            }
        }
        
        function getByName($nombre, $json = false){
            if( $nombre != null && $nombre != ""){
                $manager = new ManageProduct();
                $product = $manager->getByName( $nombre );
                if($json){
                    return $product->json();
                }else{
                    return $product;
                }
                
            }
                
        }
        
        function insert(Product $product){
            if( $product !== null ){
                $manager = new ManageProduct();
                $r = $manager->add($product);
                
                // if($r <= 0){
                //     return $r;
                // }else{
                //     return $this->get($r);
                // }
            }
        }
        
        function edit(Product $product){
             if( $product != null){
                $manager = new ManageProduct();
                return $manager->save($product);
             }
            
        }
        
        function remove($ids){
            $manager= new ManageProduct();
            return $manager->delete($ids);
        }
        
}