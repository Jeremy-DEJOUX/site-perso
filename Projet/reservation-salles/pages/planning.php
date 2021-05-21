<?php
require_once('../src/pdo.php');
$path_index = "../index.php";
$path_inscription = "inscription.php";
$path_connexion = "connexion.php";
$path_formulaire = "reservation-form.php";
$path_planning = "planning.php";
$path_reservation = "reservation.php";
$path_profil = "profil.php";

date_default_timezone_set ('Europe/Paris');

$title = 'planning';

$eventsFromDB = new Events();
$tableCell = [];
$currentEvent = [];

$actWeek = new Week($_GET['day'] ?? null, $_GET['month'] ?? null, $_GET['year'] ?? null);

$startingDayWeek = $actWeek->getFirstDay();
$end = (clone $startingDayWeek)->modify('+ 1 week - 1 second');
$events = $eventsFromDB->getEventsBetweenByDayTime($startingDayWeek, $end);
foreach ($events as $k => $event) {
    $tableCell[$event['case']] = $event['length'];
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="../CSS/header.css">
  <link rel="stylesheet" href="../CSS/planning.css">
  <link rel="stylesheet" href="../CSS/inscription.css">
</head>
<body>
  <?php include_once('header.php'); ?>


    <main class="flex column j_around a_center">

    <section class="flex j_around a_center">
        <a href="planning.php?day=<?= $actWeek->previousWeek()->day; ?>&month=<?= $actWeek->previousWeek()->month; ?>&year=<?= $actWeek->previousWeek()->year; ?>"> <= </a>
        <h1> <?= $actWeek->ToString(); ?> </h1>
        <a href="planning.php?day=<?= $actWeek->nextWeek()->day; ?>&month=<?= $actWeek->nextWeek()->month; ?>&year=<?= $actWeek->nextWeek()->year; ?>"> => </a>
    </section>

    <table>
        <?php
            for ($y = 0; $y < 12; ++$y) {
                echo '<tr>', "\n";
                // COLUMNS
                for ($x = 0; $x < 8; ++$x) {
                    $coordinate = $y . '-' . $x;
                    $cellLength = null;

                    if ($y == 0 && $x == 0)
                        echo '<th>Horaires</th>';

                    elseif ($y == 0 && $x > 0) {
                        $daysNumber = $actWeek->mondaysDate + $x - 1;
                        echo '<th>' . $actWeek->getDays($x - 1) . ' ' . $daysNumber .  '</th>';
                    }
                    elseif ($y > 0 && $x == 0) {
                        $tempHour = 7 + $y;
                        if ($tempHour < 10) {
                            $hour = '0' . $tempHour . ':00';
                        }
                        else {
                            $hour = $tempHour . ':00';
                        }
                        echo '<th>' . $hour . '</th>';
                    }
                    else {
                        foreach($tableCell as $key => $value) {
                            if ($coordinate === $key) {
                                $cellLength = $value;
                            }
                        }
                        foreach ($events as $k => $event) {
                            if ($coordinate == $event['case']) {
                                $currentEvent = $event;
                            }
                        }
                        if (isset($cellLength) && $cellLength !== FALSE) {
                            echo '<td id="reservation" rowspan="'. $cellLength . '"';
                            echo '(' . $cellLength . ')', '<br>';
                            echo $currentEvent['login'], ',<br />';
                            echo $currentEvent['titre'], '<br />';
                            echo "<a href=\"reservation.php?id=" . $currentEvent['id'] . '">détails...</a>';
                            echo '</td>';

                            // logical part pour les Rowspan
                            $tempY = $y + 1;
                            while ($cellLength > 1) {
                                $tableCell[$tempY . '-' . $x] = FALSE;
                                $tempY++;
                                $cellLength--;
                            }
                        }
                        else {
                            if (isset($tableCell[$coordinate])) {
                                echo "";
                            }
                            else {
                                echo '<td>';
                                echo '</td>';
                            }
                        }
                    }
                }
                echo '</tr>', "\n";
            }
        ?>
    </table>

  </body>
</html>
