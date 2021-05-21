<?php
require_once '../classes/Db.php';




$path_index = '../index.php';
$path_profil = 'profil.php';
$path_inscription = 'inscription.php';
$path_connexion = 'connexion.php';
$path_wall = 'WallOfFame.php?d=' . $_SESSION['difficulty'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/success.css">
    <title>Succes</title>
</head>

<body id="B_Success">
    <?php include_once 'header.php'; ?>

    <main class="flex column a_center"id="Success">
        <h1 id="Titre_suc"><?= $_SESSION['login'] ?></h1>
        <p>Vous avez un score de <?= $_SESSION['scores']; ?> au niveau de difficulté <?= $_SESSION['difficulty']; ?></p>
        <p>Souhaitez vous <a href="../index.php">rejouer</a> ?</p>

    </main>
</body>

</html>