<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/ingredients.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php");
require_once("lib/RecipeInfo.php");
require_once("lib/recipe.php");
require_once("lib/groceries.php"); 



/// INIT
$db = new Database();
$pd = new Product ($db->getConnection());
$in = new Ingredients ($db->getConnection());
$us = new User ($db->getConnection());
$kt = new Kitchentype ($db->getConnection()); 
$rpin = new RecipeInfo ($db->getConnection());
$rp = new Recipe ($db->getConnection()); 
$gr = new Groceries ($db->getConnection()); 

/// VERWERK 
$groceries = $gr->addGroceries(1, 2); 

/// RETURN
 