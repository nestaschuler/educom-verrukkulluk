<?php
    class ingredient {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection; 
        }

    public function selectIngredient(){

        $sql = "select * from ingredient where id = $ingredient_id";

        $result= mysqli 
    }
    }