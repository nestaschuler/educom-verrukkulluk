<?php

class Kitchentype { 

    private $connection; 

    public function __construct($connection){
        $this->connection = $connection; 
    }

    public function selectKitchentype($kitchentype_id, $record_type) {

        $sql = "select * from kitchentype where id = $kitchentype_id and record_type = '$record_type'";
        
        $result = mysqli_query($this->connection, $sql);
        $kitchentype = mysqli_fetch_array($result, MYSQLI_ASSOC); 

        echo "<pre>"; 
        return ($kitchentype); 
    }
}  
