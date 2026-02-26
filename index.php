<?php

require_once("lib/database.php");
require_once("lib/product.php");
require_once("lib/user.php");

/// INIT
$db = new database();
$pd = new product ($db->getConnection());
$us = new user ($db->getConnection());


/// VERWERK 
$data = $pd->selecteerProduct(4);
$data = $us->selecteerUser(1);

/// RETURN
var_dump($pd);
var_dump($us);