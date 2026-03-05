<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/ingredient.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/RecipeInfo.php");
require_once("lib/recipe.php");



/// INIT
$db = new Database();
$pd = new Product ($db->getConnection());
$in = new Ingredient ($db->getConnection());
$us = new User ($db->getConnection());
$kt = new Kitchentype ($db->getConnection()); 
$rpin = new RecipeInfo ($db->getConnection());
$rp = new Recipe ($db->getConnection()); 

/// VERWERK 
$recipe = $rp->selectUser(3); 

/// RETURN
var_dump($recipe); 