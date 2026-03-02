<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php"); 
require_once("lib/recipe.php");
require_once("lib/ingredient.php"); 
require_once("lib/recipe_info.php"); 


/// INIT
$db = new database();
$pd = new product ($db->getConnection());
$us = new user ($db->getConnection());
$kt = new kitchentype($db->getConnection()); 
$rp = new recipe ($db->getConnection()); 
$in = new ingredient($db->getConnection());
$rp_in = new recipe_info ($db->getConnection());


/// VERWERK 
$product = $pd->selectProduct(4);
$user = $us->selectUser(1);
$kitchentype = $kt->selectKitchentype(1); 
$recipe = $rp->selectRecipe(1); 
$ingredient = $in->selectIngredient(1);
$recipe_info = $rp_in->selectRecipe_info(1, "C"); 

/// RETURN
var_dump($pd);
var_dump($us);
var_dump($kt); 
var_dump($rp); 
var_dump($in); 
var_dump($rp_in);
