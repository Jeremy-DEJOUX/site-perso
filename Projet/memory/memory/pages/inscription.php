<?php

require_once('../Classes/Db.php');
if (isset($_POST['submit'])) {
    $_SESSION['user']->register($bdd, $_POST['login_user'], $_POST['password_user'], $_POST['confirmpassword']);
}


$path_index = '../index.php';
$path_profil= 'profil.php';
$path_inscription = 'inscription.php';
$path_connexion = 'connexion.php';
if (isset($_SESSION['difficulty'])) {
    $path_wall = 'pages/WallOfFame.php?d=' . $_SESSION['difficulty'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/inscription.css">
</head>

<body>
    <?php include_once'header.php'; ?>
    <main class="flex column j_around a_center">
        <h1><u>Formulaire d'Inscription</u></h1>

        <?php if (isset($_SESSION['error'])) {
            echo "<h2>" . $_SESSION['error'] . "</h2>";
        } ?>

        <form action="" method="post" id="formulaire_inscriptions" class="flex a_center column j_around">
            <section class="flex column a_center j_center">
                <label for="login_user">Login :</label>
                <input type="text" name="login_user" value="<?php if (isset($login)) {
                                                                echo $login;
                                                            } ?>">

            </section>

            <section class="flex j_around a_around j_center">
                <article class="flex column  a_center">
                    <label for="password_user">Password :</label>
                    <input type="password" name="password_user">

                </article>

                <article class="flex column a_center">
                    <label for="confirmpassword">Confirm Password :</label>
                    <input type="password" name="confirmpassword">

                </article>
            </section>

            <button type="submit" name="submit">Valider</button>
        </form>
    </main>

</body>

</html>