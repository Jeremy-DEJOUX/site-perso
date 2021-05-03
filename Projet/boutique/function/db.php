<?php 
session_start();
function connect(){

    $database = new \PDO('mysql:host=localhost; dbname=boutique; charset=utf8', 'root', '' );

    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $database;
}
?>