<?php
require_once('../Classes/Db.php');

if (isset($_POST['submit'])) {
    $_SESSION['user']->connexion($bdd, $_POST['login_user'], $_POST['password_user']);
}

$path_index = '../index.php';
$path_profil = 'profil.php';
$path_inscription = 'inscription.php';
$path_connexion = 'connexion.php';
if (isset($_SESSION['difficulty'])) {
    $path_wall = 'pages/WallOfFame.php?d=' . $_SESSION['difficulty'];
}
?>






<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/connexion.css">
</head>

<body>
    <?php include_once 'header.php'; ?>


    <!-- =======================================MAIN=============================================== -->
    <main class="flex a_center column j_around" id="main_connexion">
        <h1>Connexion</h1>
        <?php if (isset($_SESSION['error'])) {
            echo "<h2>" . $_SESSION['error'] . "</h2>";
        } ?>


        <form action="connexion.php" method="post" id="connexion_formulaire" class="flex a_center column j_around">
            <section class="flex column a_center j_center">
                <label for="login_user">Login :</label>
                <input type="text" name="login_user">
            </section>

            <section class="flex column a_center j_center">
                <label for="password_user">Password :</label>
                <input type="password" name="password_user">
            </section>

            <button type="submit" name="submit">Connexion</button>
        </form>
    </main>

</body>

</html>