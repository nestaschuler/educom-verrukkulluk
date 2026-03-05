<?php

class Recipe {

    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection; 
    }
   
    public function selectRecipe($recipe_id=0) {

        //wanneer je geen recept selecteert wil ik dat hij alle recepten laat zien:

        if ($recipe_id>0) {
            $sql = "SELECT * FROM recipe WHERE id = $recipe_id";
            } 
            
            else {
            $sql = "SELECT * FROM recipe";
            }

        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_assoc($result)){
            echo "<pre>";
            print_r($row);
            echo "<pre>";
        }
        
        return ($result);
    }   

    //METHODES TOEGEVOEGD 


    public function selectIngredient($recipe_id) {
        $sql = "SELECT * FROM ingredient WHERE recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    //calorien van een gerecht bereken je door de ingredienten van dat gerecht 
    public function calcCalories() {}

    //prijs van een gerecht bereken je door de producten die je moet kopen om dat gerecht te maken
    public function calcPrice($recipe_id, $product_id) {
        }

    public function selectRating($recipe_id) {
        $sql = "SELECT * FROM recipe_info 
                WHERE recipe_id = $recipe_id
                AND record_type = 'R'"; 

        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    } 

    public function selectSteps($recipe_id) {
        $sql = "SELECT * FROM recipe_info 
                WHERE recipe_id = $recipe_id
                AND record_type = 'P'";

        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    public function selectComments($recipe_id) {
        $sql = "SELECT * FROM recipe_info 
                WHERE recipe_id = $recipe_id
                AND record_type = 'C'";

        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    public function selectKitchen($kitchen_id){
        $sql = "SELECT * FROM recipe WHERE kitchen_id = $kitchen_id";
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    public function selectType($type_id){
        $sql = "SELECT * FROM recipe WHERE type_id = $type_id";
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    public function determineFavorite($user_id, $recipe_id){
        $sql = "SELECT * FROM recipe_info 
                WHERE user_id = $user_id
                AND recipe_id = $recipe_id
                AND record_type = 'F'";
        
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }
}
