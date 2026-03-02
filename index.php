<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/user.php");
require_once("lib/kitchentype.php"); 
require_once("lib/recipe.php");

/// INIT
$db = new database();
$pd = new product ($db->getConnection());
$us = new user ($db->getConnection());
$kt = new kitchentype($db->getConnection()); 
$rp = new recipe ($db->getConnection()); 


/// VERWERK 
$product = $pd->selectProduct(4);
$user = $us->selectUser(1);
$kitchentype = $kt->selectKitchentype(1); 
$recipe = $rp->selectRecipe(1); 

/// RETURN
var_dump($pd);
var_dump($us);
var_dump($kt); 
var_dump($rp); 
