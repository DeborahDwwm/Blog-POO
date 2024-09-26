<?php

function dbconnect()
{
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=blog40nFinal', 'root', '');
        return $dbh;
        
        } catch (PDOException $e) {
        echo $e->getMessage();
    }
}