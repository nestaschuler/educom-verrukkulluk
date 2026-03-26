<?php

class Recipe {

    Private $connection; 
    Private $user; 
    Private $kitchentype;
    Private $ingredients; 
    Private $recipeinfo; 

    Public function __construct($connection) {
        $this->connection = $connection; 
        $this->user = new User($connection);
        $this->kitchentype = new Kitchentype($connection); 
        $this->ingredients = new Ingredients($connection); 
        $this->recipeinfo = new RecipeInfo($connection);
    }
   
    Public function selectRecipe($recipe_id=0) {                            //wanneer je geen recept selecteert wil ik dat hij alle recepten laat zien:

        if ($recipe_id>0) {
            $sql = "SELECT * FROM recipe WHERE id = $recipe_id";
            } else {
            $sql = "SELECT * FROM recipe";
            }

        $result = mysqli_query($this->connection, $sql); 

        while ($row = mysqli_fetch_assoc($result)){                         //haalt bijbehorende user, keuken, type en ingredienten op 
            $user=$this->selectUser($row["user_id"]);
            $kitchen=$this->selectKitchentype($row["kitchen_id"], 'K');
            $type=$this->selectKitchentype($row["type_id"], 'T'); 
            $ingredients=$this->selectIngredients($row["id"]);
            
            $return[] = [                                                   //Voeg recept toe plus bijbehorende waardes toe aan return-array
                "recipe_id" => $row["id"],
                "titel" => $row["titel"],  
                "kitchen"=> $kitchen["description"],
                "type" => $type["description"],
                "image" => $row["image"],
                "user_id" => $user["id"],
                "user_name" => $user["user_name"],
                "date" => $row["date"],
                "short_description" => $row["short_description"],
                "long_description" => $row["long_description"],
                "ingredients"=> $ingredients, 
                "comments"=> $this->selectRecipeInfo($row['id'], 'C'), 
                "preparation"=> $this->selectRecipeInfo($row['id'], 'P'), 
                "rating"=> array_column($this->selectRecipeInfo($row['id'], 'R'), 'numeric_field'),
                "average_rating" => $this->selectAverageRating($row['id']), 
                "calories" => $this->calcCalories($ingredients), 
                "price" => $this->calcPrice($ingredients), 

            ];
        }

        return $return; 

    }
 
///METHODES TOEGEVOEGD

    Private function selectUser($user_id){
        return $this->user->selectUser($user_id); 
    }  

    Private function selectKitchentype($kitchentype_id, $record_type){
        return $this->kitchentype->selectKitchentype($kitchentype_id, $record_type);
    }

    Private function selectIngredients($recipe_id){
        return $this->ingredients->selectIngredients($recipe_id); 
    }

    Private function selectRecipeInfo($recipe_id, $record_type){
        return $this->recipeinfo->selectRecipeInfo($recipe_id, $record_type); 
    }

    Public function addFavorite($user_id, $recipe_id){
        $sql = "INSERT INTO recipe_info (user_id, record_type, recipe_id) 
                VALUES ($user_id, 'F', $recipe_id)";
        
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    Public function addRating($recipe_id, $rating){

        $sql = "INSERT INTO recipe_info (recipe_id, record_type, numeric_field) 
                VALUES ($recipe_id, 'R', $rating)";

        mysqli_query($this->connection, $sql); 
    }

    Public function selectAverageRating($recipe_id){
                                                                   
        $ratings = array_column($this->selectRecipeInfo($recipe_id, 'R'), 'numeric_field');                                    // Haal eerst alle ratings op bij dat recipe_id, ik haal dus de rijen op van dat recipe_id met bijbehorende rating


        if (count($ratings) > 0){
            return round(array_sum($ratings)/ count ($ratings));                                                               // Gemiddelde berekenen
        } else {
            return null; 
        }                            
    }
  
    Private function calcCalories($ingredients){ 

        $totalCalories = 0;

        foreach ($ingredients as $ingredient){

            if ($ingredient['unit'] === "pieces") { 
                $totalCalories += $ingredient["calories"] * $ingredient["quantity"];
            } else {
                $totalCalories += ($ingredient["calories"] / 100) * $ingredient["quantity"];
            }
        }
    
        return $totalCalories;
    }

      
    Private function calcPrice($ingredients){

        $totalPrice = 0;

        foreach ($ingredients as $ingredient){
            $packagingAmount = $ingredient['packaging_amount'] ?? 1;                                //packaging amount mag niet 0 zijn want je mag niet door 0 delen 
            $packagesNeeded = ceil($ingredient['quantity'] / $packagingAmount);   
            $totalPrice += $packagesNeeded * $ingredient['price']; 
        }    

        return ($totalPrice); 

    }
}

