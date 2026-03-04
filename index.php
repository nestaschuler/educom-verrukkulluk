<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/ingredient.php");


/// INIT
$db = new Database();
$pd = new Product ($db->getConnection());
$in = new Ingredient ($db->getConnection());

/// VERWERK 
$ingredient = $in->selectIngredient(1); 

/// RETURN
var_dump($ingredient); 