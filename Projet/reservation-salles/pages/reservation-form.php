<?php
    require_once('../src/pdo.php');
    require_once('../src/function.php');
    $title = 'réservation: formulaire';

    $path_index = "../index.php";
    $path_inscription = "inscription.php";
    $path_connexion = "connexion.php";
    $path_formulaire = "reservation-form.php";
    $path_planning = "planning.php";
    $path_reservation = "reservation.php";
    $path_profil = "profl.php";


    $data = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = $_POST;
        $errors = [];
        $validation = new EventValidator();
        $errors = $validation->validates($_POST);

        if (empty($errors)){
            $dateStart = $_POST['date'] . ' ' . $_POST['start'] . ':00';
            $dateEnd = $_POST['date'] . ' ' . $_POST['end'] . ':00';
            $insert = "INSERT INTO reservations
                (titre, description, debut, fin, id_utilisateur)
                VALUES (:title, :description, :debut, :fin, :id_user)";

            $stmt = $bdd->prepare($insert);

            $stmt->execute([
                ':title'=> htmlentities($_POST['name']),
                ':description'=> htmlentities($_POST['description']),
                ':debut'=> $dateStart,
                ':fin'=> $dateEnd,
                ':id_user'=> $_SESSION['id']
            ]);
        }

    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/reservation-form.css">
    <link rel="stylesheet" href="../CSS/footer.css">
</head>
    <body>
      <?php include_once('header.php'); ?>
        <main class="flex a_center column j_around">
            <h1>Formulaire de réservation de salle</h1>

            <form class="flex column a_center j_around" action="" method="post">


              <section class="flex j_around a_center">

                <article class="flex column a_center">
                  <label for="">Titres</label>
                  <input type="text" name="name" required value="<?= isset($data['name']) ? ($data['name']) : ''; ?>">

                      <?php if (isset($errors['name'])): ?>
                      <?= $errors['name']; ?>
                      <?php endif; ?>
                </article>


                <article class="flex column a_center">
                  <label for="">Date</label>
                  <input type="date" name="date" required value="<?= isset($data['date']) ? ($data['date']) : ''; ?>">

                      <?php if (isset($errors['Date'])): ?>
                          <?= $errors['Date']; ?>
                      <?php endif; ?>
                </article>
              </section>





              <section class="heure flex j_around a_center">

                <article class="flex column a_center">
                  <label for="">Heure de Début :</label>
                  <input type="time" name="start" value="<?= isset($data['start']) ? ($data['start']) : ''; ?>" required placeholder="HH:MM">

                      <?php if (isset($errors['start'])): ?>
                          <?= $errors['start']; ?>
                      <?php endif; ?>
                </article>


                <article class="flex column a_center">
                  <label for="">Heure de Fin :</label>
                  <input type="time" name="end" value="<?= isset($data['end']) ? ($data['end']) : ''; ?>" required placeholder="HH:MM">
                </article>
              </section>

              <label for="">Description</label>
              <textarea name="description" id="description" rows="8" cols="80"><?= isset($data['description']) ? ($data['description']) : ''; ?></textarea>



              <button type="submit" name="Send">Ajouter l'evenement</button>

            </form>
        </main>

    </body>
</html>
