<?php

Class RecipeInfo {

    private $connection; 
    private $user;
    

    public function __construct($connection) {
        $this->connection = $connection; 
        $this->user = new User ($connection); 
    }

    private function selectUser($user_id){
        $user = $this->user->selectUser($user_id); 
        return($user); 
    }

    public function selectRecipeInfo($recipe_id, $record_type){

        $sql = "select * from recipe_info where recipe_id = $recipe_id and record_type = '$record_type'"; 
        $result = mysqli_query($this->connection, $sql);
        
        $recipe_infoPlusUser =[];


        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {                                //ik wil dat zolang er recipe_info id zijn je laat zien dat wanneer er een C of F type is je de user daarbij ophaalt
            
            $extra = [];                                                                            // initaliseren van de extra variabelen zodat extra altijd bestaat en een array is zelfs als if niet waar is, anders error
        
            if (in_array($record_type, ['F', 'C'], true)) {                                         //wanneer je door de rij van record types gaat en je komt een F of C tegen dan is hij true dus user ophalen!

                $user = $this->selectUser($row['user_id'] ?? null) ?? [];                           //de ?? null checkt of $row[]user_id] bestaat en niet null is en als dit niet bestaat of null is wordt null gebruikt 
                $extra = [
                    'user_name' => $user['user_name'] ?? null,
                    'image' => $user['image'] ?? null,
                ];
            } 
            
            $recipe_infoPlusUser[] = array_merge($row, $extra);
        } 

        return $recipe_infoPlusUser;                                                                 //return wil ik buiten de while loop omdat ik wil dat hij dit bij elke rij gaat doen in recipe info waar rt= F of C
                                 
    }

    //METHODES TOEGEVOEGD

                                                                                                    
    private function addFavorite ($user_id, $recipe_id){                                            //Wanneer een user Favorite heeft aangeklikt wil ik dit toevoegen aan mijn data

        $sql = "INSERT into recipe_info 
                WHERE user_id = '$user_id'
                AND recipe_id = '$recipe_id'
                AND record_type = 'F'";

        $result = mysqli_query($this->connection, $sql);

        return ($result); 
     }


     private function deleteFavorite ($user_id, $recipe_id){                                        //Wanneer een user Favorite verwijderd dan zal deze rij ook moeten verwijderd worden uit mijn data

        $sql = "DELETE FROM recipe_info 
                WHERE user_id = '$user_id'
                AND recipe_id = '$recipe_id'
                AND  record_type = 'F'"; 
        $result = mysqli_query($this->connection, $sql); 

        return ($result); 
     }      
}