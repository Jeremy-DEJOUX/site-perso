<?php
require_once('../Classes/Db.php');



if (isset($_SESSION['id'])) {

    if (isset($_POST['new_submit'])) {
        $_SESSION['user']->update($_POST['new_login'], $_POST['new_password'], $_POST['confirm_new_password']);
    }

    $path_index = '../index.php';
    $path_profil = 'profil.php';
    $path_inscription = 'inscription.php';
    $path_connexion = 'connexion.php';
    $path_wall = 'WallOfFame.php?d=' . $_SESSION['difficulty'];


?>


    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Profil</title>
        <link rel="stylesheet" href="../styles/header.css">
        <link rel="stylesheet" href="../styles/profil.css">
    </head>

    <body>
        <?php include_once'header.php'; ?>

        <!-- =======================================MAIN=============================================== -->
        <main class="flex a_center column j_around" id="main_connexion">

            <section class="flex a_center column j_around">
                <h1>Profil de <?php echo $_SESSION['login']; ?></h1> <br />

                <?php if (isset($_SESSION['error'])) {
                    echo "<h2>" . $_SESSION['error'] . "</h2>";
                } ?>

                <a href="deconnexion.php">Se Déconnecter</a>
            </section>

            <form action="" method="post" id="formulaire_edition" class="flex a_center column j_around">

                <section class="flex column a_center j_center">
                    <label for="new_login">New Login :</label>
                    <input type="text" name="new_login" value="<?php echo $_SESSION['login']; ?>">
                </section>

                <section class="flex j_around a_around">
                    <article class="flex column j_center a_center">
                        <label for="new_password">New Password :</label>
                        <input type="password" name="new_password" value="">
                    </article>

                    <article class="flex column j_center a_center">
                        <label for="confirm_new_passsword">Confirm Password :</label>
                        <input type="password" name="confirm_new_password">
                    </article>
                </section>

                <button type="submit" name="new_submit">Mettre à jour mon profil</button>
        </main>


    </body>

    </html>
<?php } else {
    var_dump($_SESSION['user']);
} ?>