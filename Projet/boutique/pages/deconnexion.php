<?php
require_once('../function/db.php');
require_once('../class/classUser.php');
$user = new User;
$user->Disconnect();
header('Location: profil.php');
?>