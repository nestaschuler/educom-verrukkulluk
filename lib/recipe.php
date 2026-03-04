<?php

class Recipe {

    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection; 
    }
   
    public function selectRecipe($recipe_id) {

        $sql = "select * from recipe where id = $recipe_id";
        
        $result = mysqli_query($this->connection, $sql);
        $recipe = mysqli_fetch_array($result, MYSQLI_ASSOC); 

           

        return ($recipe);
    }   
}
