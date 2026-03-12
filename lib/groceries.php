<?php

Class Groceries {

    Private $connection;

    Public function __construct($connection){
        $this->connection = $connection; 
    }

    Public function addGroceries($recipe_id, $user_id) {

        $sql = "SELECT * from ingredients where recipe_id = $recipe_id"; 
        $result = mysqli_query($this->connection, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
            echo "<pre>"; 
            print_r($row); 

            $product_id = $row["product_id"];                                               // ga naar het product dat bij het recept hoort 
            
            $exists = $this->productOnList($product_id, $user_id);                          // kijken of producten al op de lijst staan

                if ($exists) {                                                              // als het product bestaat moet het amount verhoogd worden

                    $sql = "UPDATE groceries
                            SET amount = amount + 1
                            WHERE user_id = $user_id
                            AND product_id = $product_id";

                   
                    mysqli_query($this->connection, $sql); 
                    
                    echo "Amount of products +1";
                    echo "<pre>";
                    echo $sql; 
                  
                    ; 
                }
                
                else {

                    $sql =  "INSERT INTO groceries 
                            (user_id, recipe_id, product_id, amount) 
                            VALUES ($user_id, $recipe_id, $product_id, 1)";                 //als het product niet bestaat moet het worden toegevoegd 
                    
                    mysqli_query($this->connection, $sql); 
                    
                    echo "Product added"; 
                    echo "<pre>";
                    echo $sql; 
                    
                }
        }
    }     


    Private function productOnList($product_id, $user_id){

        $sql = "SELECT id FROM groceries 
                WHERE user_id = $user_id 
                AND product_id = $product_id";

        $result = mysqli_query($this->connection, $sql);

        if(!$result){
            echo "SQL error in productOnList():" . mysqli_error($this->connection);
            return false;                                                                   //query faalt --> behandelen als niet op lijst
        }

        return mysqli_num_rows($result) > 0;                                                // true als het product dus al op de lisjt staat
    }

    Public function deleteGroceries($user_id) {
        
        $sql = "DELETE FROM groceries WHERE user_id = $user_id";                            //verwijder alle rijen van deze gebruiker
        mysqli_query($this->connection, $sql);

        $sql2 = "ALTER TABLE groceries AUTO_INCREMENT = 1";                                 //ik wil dat groceries id weer reset
        mysqli_query($this->connection, $sql2); 

        echo"<pre>";
        echo"All groceries are deleted";
    }
 }

