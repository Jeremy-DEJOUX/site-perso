<?php
require_once('../src/pdo.php');
$_SESSION['user']->disconnect();
session_destroy();
header('Location: connexion.php');

 ?>
