<?php

class ModeloClient extends Modelo{
        
        function get($id, $json = false){
            $manager = new ManageClient();
            $client = $manager->get($id);
            if($json){
                 return $client->json();
            }else{
                return $client;
            }
           
        }
        
        function getList($json = false){
            $manager = new ManageClient();
            $list =  $manager->getList();
            
            if($json){
                return $this->_json($list);
            }else{
                return $list;
            }
        }
        
        function getByName($nombre, $json = false){
            if( $nombre != null && $nombre != ""){
                $manager = new ManageClient();
                $client = $manager->getByName( $nombre );
                if($json){
                    return $client->json();
                }else{
                    return $client;
                }
                
            }
                
        }
        
        function insert(Client $client){
            if( $client !== null ){
                $manager = new ManageClient();
                $r = $manager->add($client);
                
                // if($r <= 0){
                //     return $r;
                // }else{
                //     return $this->get($r);
                // }
            }
        }
        
        function edit(Client $client){
             if( $client != null){
                $manager = new ManageClient();
                return $manager->save($client);
             }
            
        }
        
        function remove($ids){
            $manager= new ManageClient();
            return $manager->delete($ids);
        }
        
}