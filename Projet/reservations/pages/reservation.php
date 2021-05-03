<?php

$path_index = "../index.php";
$path_inscription = "inscription.php";
$path_connexion = "connexion.php";
$path_formulaire = "reservation-form.php";
$path_planning = "planning.php";
$path_reservation = "reservation.php";
$path_profil = "profl.php";

require_once('../src/function.php');
require_once('../src/pdo.php');

$title = 'réservation';

if (isset($_GET['id'])) {
    // GET INFOS FROM DB
    $event = new Events;
    $eventInfos = $event->getEventById($_GET['id']);

    // FORMAT DATE & TIME
    $timestampStart = strtotime($eventInfos['debut']);
    $timestampEnd = strtotime($eventInfos['fin']);
    $formated = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::MEDIUM);
}
else {
    $_SESSION['error'] = "Cette page n'a pas été accédé par le planning";
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <title>Profil</title>
      <link rel="stylesheet" href="../CSS/header.css">
      <link rel="stylesheet" href="../CSS/reservation.css">
      <link rel="stylesheet" href="../CSS/footer.css">
  </head>
  <body class="container">
    <?php include_once('header.php'); ?>
    <main class="flex column j_center a_center">
        <h1><u>Réservation</u></h1>

        <?php if (!isset($_SESSION['id']) || !$_SESSION['id']) :
            echo '<p class="error">Cette partie du site où vous pourrez voir la réservation de salle sélectionnée, ne sera visible qu\'une fois connecté</p>';

        elseif (isset($_SESSION['error'])):
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);

        else :
            ?>
            <section class="flex j_around a_center">
              <article class="flex column j_center a_center">
                <p>Réalisée par : </p>
                <?= $eventInfos['login']; ?>
              </article>

              <article class="flex column j_center a_center">
                <p>Titre : </p>
                "<?= $eventInfos['titre']; ?>"
              </article>

              <article class="flex column j_center a_center">
                <p>Description :</p>
                <?= $eventInfos['description']; ?>
              </article>

              <article class="flex column a_center">
                <p>Commence le : </P>
                <?= $formated->format($timestampStart); ?>,
                <p>Finit le : </p>
                <?= $formated->format($timestampEnd); ?>.
              </article>
            </section>
        <?php endif; ?>
    </main>
  </body>
</html>
