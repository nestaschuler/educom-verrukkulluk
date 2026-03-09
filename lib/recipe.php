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
                //"calories" => 
                //"price" => add all the prices from the products you use with the specific recipe 

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
        }

            if (count($ratings) == 0) {
                return null;
            }

            else {
            $average = array_sum($ratings)/ count($ratings);}
        
        return round($average);
    }

    //Methodes toevoegen calcalorien en calprice --> to do!

    private function calPrice($product){
        $sql = "SELECT * FROM product WHERE id = $product_id";
        $result = mysqli_query($this->connection, $sql);

        


    
    }

}   




    //METHODES TOEGEVOEGD 
   

    /* public function selectIngredient($recipe_id) {
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
} */
