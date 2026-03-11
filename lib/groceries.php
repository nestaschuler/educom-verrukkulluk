<?php

Class Groceries {


    private $connection;
    private $ingredients;

    Public function __construct($connection){
        $this->connection = $connection; 
        $this->ingredients = new Ingredients($connection); 
    }

    Public function addGroceries($recipe_id, $user_id) {

        $sql = "SELECT * from ingredients where recipe_id = $recipe_id"; 
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
            $product_id = $row["product_id"]; // ga naar het product dat bij het recept hoort 
            
            $productOnList = $this->productOnList($product_id, $user_id); // kijken of producten al op de lijst staan

                if ($productOnList == False) {

                    $this->addProduct($product_id, $user_id);
                }
                
                else 

                    $this->updateProduct($product_id, $user_id);
                }

                    mysqli_query($this->connection, $sql); 

        }     


    private function productOnList($product_id, $user_id){

        $sql = "SELECT id FROM groceries 
                WHERE user_id = $user_id 
                AND product_id = $product_id";

        $result = mysqli_query($this->connection, $sql);

        if(mysqli_num_rows($result) > 0){
            return true;
        }

        return false;
    }

    private function addProduct($product_id, $user_id){

        $sql = "INSERT INTO groceries (user_id, product_id) VALUES ($user_id, $product_id)";

        mysqli_query($this->connection, $sql);
    }

    private function updateProduct($product_id, $user_id){

        $sql = "UPDATE groceries SET amount = amount + 1
                WHERE user_id = $user_id 
                AND product_id = $product_id"; 

        mysqli_query($this->connection, $sql);
    }

 }




 