<?php
require_once('src/pdo.php');
$path_index = "index.php";
$path_inscription = "pages/inscription.php";
$path_connexion = "pages/connexion.php";
$path_formulaire = "pages/reservation-form.php";
$path_planning = "pages/planning.php";
$path_reservation = "pages/reservation.php";
$path_profil = "pages/profil.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Growingcork</title>
  </head>
  <body>
    <?php require_once('pages/header.php'); ?>


    <main>
      <div class="flex j_around a_around" id="Block_acceuil">
        <section id="Titre" class="flex j_center a_start">
          <h1 id="Rowingcork_Titles">Rowingcork</h1>
        </section>

        <section id="Room_column" class="flex column j_around a_center">
          <article class="Room" id="Room_1">

          </article>

          <article class="Room" id="Room_2">

          </article>

          <article class="Room" id="Room_3">

          </article>
        </section>
      </div>

      <div class="" id="Text_acceuil">
        <p>Le coworking ne cesse de se développer, et contrairement à ce que l’on pourrait croire, ce n’est pas essentiellement à Paris ! <br> De nombreux espaces sortent de terre un peu partout en France, dans de grandes villes comme dans de petits villages <br>
        Alors n'hésiters pas a venir chez <b><u>Rowingcork</u></b></p>
      </div>
    </main>


    <?php include_once('pages/footer.php'); ?>
  </body>
</html>
