<?php
require_once('../Classes/Db.php');

$path_index = '../index.php';
$path_profil = 'profil.php';
$path_inscription = 'inscription.php';
$path_connexion = 'connexion.php';
if (isset($_SESSION['difficulty'])) {
    $path_wall = 'WallOfFame.php?d=' . $_SESSION['difficulty'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/wall_of_fame.css">
    <title>Document</title>
</head>

<body>
</body>
<?php include_once('header.php'); ?>

<main class="flex column j_center a_center">
    <?php $wall->getAllScores($bdd, $_GET['d']) ?>

    <div class="flex j_around a_center" id="Choose">
        <a href="WallOfFame.php?d=<?= $_SESSION['difficulty'] = 3; ?>"> Mode Easy </a>

        <a href="WallOfFame.php?d=<?= $_SESSION['difficulty'] = 6 ?>"> Mode Normal </a>

        <a href="WallOfFame.php?d=<?= $_SESSION['difficulty'] = 9 ?>"> Mode Hard </a>
    </div>
</main>


</html>