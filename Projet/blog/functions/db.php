<?php 
session_start();
function connect()
{

    $database = new \PDO('mysql:host=localhost; dbname=jeremy-dejoux_blog; charset=utf8', 'Jeremy', 'Minato6510' );

    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 
    return $database;
}

?>