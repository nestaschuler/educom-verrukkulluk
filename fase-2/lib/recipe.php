<?php


class Recipe {


    public function selectRecipe() {

        $recipes = [

            [   "id" => 1,
                "title" => "Vegan Burger",
                "foto" => "https://www.inspiredtaste.net/wp-content/uploads/2019/03/Spaghetti-with-Meat-Sauce-Recipe-1-1200.jpg",
                "ingredients" => [
                    ["id" => 1, "product_id" => 1, "recipe_id" => 1, "name" => "Pasta"],
                    ["id" => 2, "product_id" => 2, "recipe_id" => 1, "name" => "Saus"],
                    ["id" => 3, "product_id" => 3, "recipe_id" => 1, "name" => "Gehakt"],
                ]
            ],

            [   "id" => 2,
                "title" => "Bami",
                "foto" => "https://www.leukerecepten.nl/wp-content/uploads/2019/03/bami_v.jpg",
                "ingredients" => [
                    ["id" => 4, "prodcut_id" => 10, "recipe_id" => 1, "name" => "Mie nestjes"],
                    ["id" => 5, "product_id" => 12, "recipe_id" => 1, "name" => "Bami kruiden"],
                    ["id" => 6, "product_id" => 31, "recipe_id" => 1, "name" => "Hamblokjes"],
                ]
            ],
        ];


        return($recipes);


    }



}
