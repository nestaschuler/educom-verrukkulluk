<?php

Class RecipeInfo {

    private $connection; 
    private $user;
    

    public function __construct($connection) {
        $this->connection = $connection; 
        $this->user = new User ($connection); 
    }

    public function selectUser($user_id){
        $user = $this->user->selectUser($user_id); 
        return($user); 
    }

    public function selectRecipeInfo($recipe_id, $record_type){

        $sql = "select * from recipe_info where recipe_id = $recipe_id and record_type = '$record_type'"; 
        $result = mysqli_query($this->connection, $sql);
        
        $recipe_infoPlusUser =[];

        
        //ik wil dat zolang er recipe_info id zijn je laat zien dat wanneer er een C of F type is je de user daarbij ophaalt

          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            if ($record_type == "F" || $record_type == "C") {

                $user_id = $row ["user_id"];
                $user = $this->selectUser($user_id); 

                $recipe_infoPlusUser [] = [
                                "id" => $row["id"],
                                "record_type" => $row["record_type"],
                                "recipe_id" => $row["recipe_id"],
                                "user_id" => $row["user_id"],
                                "user_name" => $user["user_name"], 
                                "image"=> $user["image"], 
                                "text_field" => $row["text_field"],
                                ];

            }
        } 
        //return wil ik buiten de while loop omdat ik wil dat hij dit bij elke rij gaat doen in recipe info waar rt= F of C
        return ($recipe_infoPlusUser);
    }

    //METHODES TOEGEVOEGD

    //Wanneer een user Favorite heeft aangeklikt wil ik dit toevoegen aan mijn data

    public function addFavorite ($user_id, $recipe_id){

        $sql = "INSERT into recipe_info 
                WHERE user_id = '$user_id'
                AND recipe_id = '$recipe_id'
                AND record_type = 'F'";

        $result = mysqli_query($this->connection, $sql);

        return ($result); 
     }

    //Wanneer een user Favorite verwijderd dan zal deze rij ook moeten verwijderd worden uit mijn data

     public function deleteFavorite ($user_id, $recipe_id){

        $sql = "DELETE FROM recipe_info 
                WHERE user_id = '$user_id'
                AND recipe_id = '$recipe_id'
                AND  record_type = 'F'"; 
        $result = mysqli_query($this->connection, $sql); 

        return ($result); 
     }      
}