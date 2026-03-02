<?php

class recipe_info {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectRecipe_Info($recipe_id, $record_type){

        $sql = "select * from recipe_info where recipe_id = $recipe_id and record_type = '$record_type'"; 
    
        $return = [];

        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                 $return[]= $row;
        }

        return $return;
    }
}