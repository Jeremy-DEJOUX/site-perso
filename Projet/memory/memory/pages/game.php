<?php
require_once('../Classes/Db.php');
require_once '../functions/functions.php';
require_once '../classes/Autoloader.php';
spl_autoload_register(['Autoloader', 'autoload']);






$game = unserialize($_SESSION['game']);
unset($_SESSION['game']);


if (isset($_POST['cardId'])) {
    if ($game->previousTurnExists() && $game->actualTurnExists()) {
        $game->comparison();
        // $_SESSION['game'] = serialize($game);
    }
    if (!$game->previousTurnExists()) {
        $game->setPreviousTurn($_POST['cardId']);
        $_SESSION['game'] = serialize($game);
        header("Location: game.php");
        return;
    } else {
        $game->setActualTurn($_POST['cardId']);
        $_SESSION['game'] = serialize($game);
        header("Location: game.php");
        return;
    }
}
if ($game->previousTurnExists()  && $game->actualTurnExists() && $game->getTotalPairs() === 1) {
    $game->comparison();
    $_SESSION['game'] = serialize($game);
    header('Location: success.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/game.css">
    <title>game</title>
</head>

<body>
    <header>
        <ul class="flex j_around a_center" id="ul_nav">
            <li><h1>MEMORY</h1></li>
            <li><a href="deconnexion.php">Deconnexion</a></li>
        </ul>
    </header>
    <main class="flex j_around a_center">

        <?= $game->printScore(); ?>

        <article class="flex wrap j_center a_center" id="container">
            <?php
            if (!$game->stopGame()) {
                echo $game->printCard();
            } else {
                echo 'YOU WIN!';
            }
            ?>
        </article>

        <?php $wall->getAllScores($bdd, $_SESSION['difficulty']);?>
    </main>
</body>

</html>
<?php

$_SESSION['game'] = serialize($game);

?>