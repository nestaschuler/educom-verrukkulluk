<?php

Class Groceries {

    Private $connection;
    Private $ingredients;

    Public function __construct($connection){
        $this->connection = $connection; 
        $this->ingredients = new Ingredients($connection);
    }

    Public function addGroceries($recipe_id, $user_id) {                                    
        
        $ingredients = $this->ingredients->selectIngredients($recipe_id);                           // Haal ingrediënten op via de bestaande Recipe class

        foreach ($ingredients as $ingredient) {                                                     // voor elk ingredient ga je kijken of het product bij die user op de lijst staat
            $product_id = $ingredient['product_id'];

            if ($this->productOnList($product_id, $user_id)) {                                      // als product op lijst staat, voeg 1 toe (dus update)
                $updateSql = "UPDATE groceries 
                              SET amount = amount + 1 
                              WHERE user_id = $user_id AND product_id = $product_id";
                mysqli_query($this->connection, $updateSql);
            } else {                                                                                // als product niet op lijst staat voeg product toe
                $insertSql = "INSERT INTO groceries (user_id, recipe_id, product_id, amount)
                              VALUES ($user_id, $recipe_id, $product_id, 1)";
                mysqli_query($this->connection, $insertSql);
            }

            $added[] = [                                                                            // ik wil dat hij return laat zien waarin hij het product, naam van ingredient en hoeveelheid die hij heeft toegevoegd = +1 
                'user_id' => $user_id, 
                'recipe_id' => $recipe_id,
                'product_id' => $product_id,
                'name' => $ingredient['name'],
                'quantity_added' => 1
            ];
        }
    
        return $added; 
    }

    Private function productOnList($product_id, $user_id){

        $sql = "SELECT id FROM groceries 
                WHERE user_id = $user_id 
                AND product_id = $product_id";

        $result = mysqli_query($this->connection, $sql);

        if(!$result){
            echo "SQL error in productOnList():" . mysqli_error($this->connection);
            return false;                                                                       //query faalt --> behandelen als niet op lijst
        }

        return mysqli_num_rows($result) > 0;                                                    // true als het product dus al op de lisjt staat
    }

    Public function deleteGroceries($user_id) {
        
        $sql = "DELETE FROM groceries WHERE user_id = $user_id";                                //verwijder alle rijen van deze gebruiker
        mysqli_query($this->connection, $sql);

        $sql2 = "ALTER TABLE groceries AUTO_INCREMENT = 1";                                     //ik wil dat groceries id weer reset
        mysqli_query($this->connection, $sql2); 

        echo"All groceries are deleted";
    }
 }

