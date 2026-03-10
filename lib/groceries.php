<?php

Class Groceries {


    private $connection;
    private $ingredients;

    Public function __construct($connection){
        $this->connection = $connection; 
        $this->ingredients = new Ingredients($connection); 
    }

    Public function addGroceries($recipe_id, $user_id) {

        $ingredients = $this->selectIngredients($recipe_id);

        while ($row = mysqli_fetch_assoc($ingredients)){
        
            $product_id = $row["product_id"]; // haal producten op
            
            $productOnList = $this->productOnList($product_id, $user_id); // kijken of producten al op de lijst staan

                if ($productOnList == False) {

                    $sql = "INSERT INTO groceries (user_id, product_id) VALUES ($user_id, $product_id)"; 

                }

            
            


        }
        
    }

    private function selectIngredients($recipe_id){
         return $this->ingredients->selectIngredients($recipe_id); 
    }

    private function productOnList($product_id, $user_id);


 }



