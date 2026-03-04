<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/ingredient.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/RecipeInfo.php");



/// INIT
$db = new Database();
$pd = new Product ($db->getConnection());
$in = new Ingredient ($db->getConnection());
$us = new User ($db->getConnection());
$kt = new Kitchentype ($db->getConnection()); 
$rpin = new RecipeInfo ($db->getConnection());

/// VERWERK 
$recipe_info = $rpin->selectRecipeInfo(1, 'F'); 

/// RETURN
var_dump($recipe_info); 