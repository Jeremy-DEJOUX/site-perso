<?php
session_start();
require_once('Classes/User.php');
require_once('Classes/Week.php');
require_once('Classes/Creneaux.php');
require_once('Classes/Validation.php');
require_once('Classes/ValidationForm.php');
require_once('function.php');

$_SESSION['user'] = new User();

    $dsn = "mysql:host=localhost;dbname=reservationsalles";
    $userDB = 'root';
    $passDB = '';
    $bdd = new PDO("$dsn","$userDB", "$passDB");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
