<?php

class Recipe {

    private $connection; 
    private $user; 
    private $kitchentype;
    private $ingredients; 
    private $recipeinfo; 
    private $product; 

    public function __construct($connection) {
        $this->connection = $connection; 
        $this->user = new User($connection);
        $this->kitchentype = new Kitchentype($connection); 
        $this->ingredients = new Ingredients($connection); 
        $this->recipeinfo = new RecipeInfo($connection); 
        $this->product = new Product($connection); 
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
            
            //haalt bijbehorende user, keuken, type en ingredienten op 
            $user=$this->selectUser($row["user_id"]);
            $kitchen=$this->selectKitchentype($row["kitchen_id"], 'K');
            $type=$this->selectKitchentype($row["type_id"], 'T'); 
            $ingredient=$this->selectIngredients($row["id"]);
            $comments=$this->selectRecipeInfo($row["id"], 'C'); 
            $preparation=$this->selectRecipeInfo($row["id"], 'P'); 
            $ratings=$this->selectRecipeInfo($row["id"], 'R'); 
            $average_rating=$this->selectAverageRating($row["id"]); 
            $totalCalories=$this->calcCalories($row["id"]); 
            $totalPrice=$this->calcPrice($row["id"]); 


            //Voeg recept toe plus bijbehorende waardes toe aan return-array
            $return[] = [
                "recipe_id" => $row["id"],
                "titel" => $row["titel"],  
                "kitchen_id"=> $kitchen["description"],
                "type_id" => $type["description"],
                "image" => $row["image"],
                "user_id" => $user["id"],
                "user_name" => $user["user_name"],
                "date" => $row["date"],
                "short_description" => $row["short_description"],
                "long_description" => $row["long_description"],
                "ingredients"=> $ingredient, 
                "comments"=> array_column($comments, "text_field"), 
                "preparation"=> array_column($preparation, "text_field"), 
                "ratings"=> $ratings, 
                "average_rating" => $average_rating,
                "calories" => $totalCalories, 
                "price" => $totalPrice, 

            ];
        }

        echo "<pre>";
        return $return; 

    }
 
///METHODES TOEGEVOEGD

    private function selectUser($user_id){
        return $this->user->selectUser($user_id); 
    }  

    private function selectKitchentype($kitchentype_id, $record_type){
        return $this->kitchentype->selectKitchentype($kitchentype_id, $record_type);
    }

    private function selectIngredients($recipe_id){
        return $this->ingredients->selectIngredients($recipe_id); 
    }

    private function selectRecipeInfo($recipe_id, $record_type){
        return $this->recipeinfo->selectRecipeInfo($recipe_id, $record_type); 
    }

    private function selectProduct($product_id){
        return $this->product->selectProduct($product_id); 
    }

    private function determineFavorite($user_id, $recipe_id){
        $sql = "SELECT * FROM recipe_info 
                WHERE user_id = $user_id
                AND recipe_id = $recipe_id
                AND record_type = 'F'";
        
        $result = mysqli_query($this->connection, $sql);  
        
        return ($result);
    }

    private function selectAverageRating($recipe_id){
        $sql = "SELECT * FROM recipe_info 
                WHERE recipe_id = $recipe_id 
                AND record_type = 'R'"; 
        $result = mysqli_query($this->connection, $sql);  

        $ratings = [];

        while($row = mysqli_fetch_assoc($result)) {
            $ratings[] = $row["numeric_field"];
        

            if (count($ratings) == 0) {
                return null;
            }

            $average = array_sum($ratings)/ count($ratings);
            return round($average);
        }
    }

    private function calcCalories($recipe_id){ 

        $sql = "SELECT * FROM ingredients WHERE recipe_id = $recipe_id";
        $result = mysqli_query($this->connection, $sql);

        $totalCalories = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            
            $quantity = $row['quantity']; 
            $product_id = $row['product_id']; 


            $product = $this->selectProduct($product_id);               //ik moet het product ophalen 
            $calories= $product["calories"];                            //Calories per 100 gram
            $unit = ($product['unit']); 
            
            if ($unit === "pieces"){                                    //calorien zijn per stuk ipv per 100 gram want 1 stuk avocado heeft 150 calorien                                          
                $totalCalories += $calories * $quantity;
            } 
            
            else {
                $totalCalories += ($calories / 100) * $quantity;        //calories per 100 gram/ml 
            }
        }

        return ($totalCalories); 
    }

    private function calcPrice($recipe_id){
        
        $sql = "SELECT * FROM ingredients WHERE recipe_id = $recipe_id"; //ik heb ingredienten en producten nodig om te weten welke totaal prijs er per recept is. 
        $result = mysqli_query($this->connection, $sql);

        $totalPrice = 0;

        while ($row = mysqli_fetch_assoc($result)) {
           
            $quantity = $row['quantity'];                               // ik moet ook quantity pakken, want als ze 2x van een product nodig hebben dan moet de prijs van dat product * 2/ 
            $product_id = $row['product_id'];
            
            $product = $this->selectProduct($product_id);               // product ophalen

            $price = $product['price'];
            $packagingAmount = $product['packaging_amount'];            // ik heb dit toegevoegd omdat het belangrijk is om de prijs te berekenen, omdat je soms 2x een product nodig hebt en andere keren maar 1x

            $packagesNeeded = ceil($quantity / $packagingAmount);       // dit is het aantal packages dat je sowieso nodig hebt, ik heb ceil toegevoegd want dit zorg ervoor dat het nummer naar boven word afgerond, je kan niet bv. 0,4 product uit de winkel halen. 
    
            $totalPrice += $packagesNeeded * $price; 
        }

        return ($totalPrice); 

    }
}

