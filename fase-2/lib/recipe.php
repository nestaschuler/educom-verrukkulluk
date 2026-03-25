<?php


class Recipe {


    public function selectRecipe() {

        $recipes = [

            [   "id" => 1,
                "title" => "Vegan Burger",
                "foto" => "assets/img/veganer-bohnen-burger.jpg",
                "ingredients" => [
                    ["id" => 1, "product_id" => 1, "recipe_id" => 1, "name" => "Pasta", "foto" => "assets/img/veganer-bohnen-burger.jpg"],
                    ["id" => 2, "product_id" => 2, "recipe_id" => 1, "name" => "Saus"],
                    ["id" => 3, "product_id" => 3, "recipe_id" => 1, "name" => "Gehakt"],
                ]
            ],

            [   "id" => 2,
                "title" => "Bami",
                "foto" => "assets/img/veganer-bohnen-burger.jpg",
                "ingredients" => [
                    ["id" => 4, "prodcut_id" => 10, "recipe_id" => 1, "name" => "Mie nestjes"],
                    ["id" => 5, "product_id" => 12, "recipe_id" => 1, "name" => "Bami kruiden"],
                    ["id" => 6, "product_id" => 31, "recipe_id" => 1, "name" => "Hamblokjes"],
                ]
            ],

            [   "id" => 2,
                "title" => "Bami",
                "foto" => "assets/img/veganer-bohnen-burger.jpg",
                "ingredients" => [
                    ["id" => 4, "prodcut_id" => 10, "recipe_id" => 1, "name" => "Mie nestjes"],
                    ["id" => 5, "product_id" => 12, "recipe_id" => 1, "name" => "Bami kruiden"],
                    ["id" => 6, "product_id" => 31, "recipe_id" => 1, "name" => "Hamblokjes"],
                ]
            ],

            [   "id" => 2,
                "title" => "Bami",
                "foto" => "assets/img/veganer-bohnen-burger.jpg",
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
