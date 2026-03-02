<?php

class kitchentype { 

    private $connection; 

    public function __construct($connection){
        $this->connection = $connection; 
    }

    public function selectKitchentype($kitchentype_id) {

        $sql = "select * from kitchentype where id = $kitchentype_id";
        
        $result = mysqli_query($this->connection, $sql);
        $kitchentype_id = mysqli_fetch_array($result, MYSQLI_ASSOC); 

        return ($result); 
    }
}  
