<?php

Class Ingredient {

        private $connection; 
        private $product; 

        public function __construct($connection) {
                 $this->connection = $connection;
                 $this->product = new product($connection); 
                }

        private function selectProduct($product_id) {
                $product = $this->product->selectProduct($product_id);
                return($product); 
                }

        public function selectIngredient($recipe_id) {
                //Ik wil dat je alle ingredienten van 1 recept laat zien       

                $sql = "select * from ingredient where recipe_id = $recipe_id"; 
                $result = mysqli_query($this->connection, $sql);

                $ingredientenPlusArtikelen = [];
        
                 // ik wil per rij dat hij het bijbehorende product gaat ophalen    
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
           
                        $product_id = $row ['product_id']; 
                        $product = $this->selectProduct($product_id); 

                        $ingredientenPlusArtikelen[] = [
                                "id" => $row["id"],
                                "recipe_id" => $row["recipe_id"],
                                "product_id" => $row["product_id"],
                                "quantity" => $row["quantity"],
                                "unit" => $product["unit"], 
                                "name" => $product["name"],
                                "price"=> $product["price"], 
                                ];
                }
                
                //ik wil dat hij mij de ingredientenPlusArtikelen laat zien

                return $ingredientenPlusArtikelen; 
        }

}