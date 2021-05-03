<?php
    require_once 'classes/Autoloader.php';
    session_start();
    require_once 'functions/functions.php';

    Autoloader::register();
    
    // retour de l'objet $game = new Memory()
    $game = unserialize($_SESSION['game']);

    // 
    if (isset($_GET['id']) && !$game->pTurnExists()) {
        $game->setPreviousTurn($_GET['id']);
        // echo 'reçu une première ID: ', $game->showActualId();
        $_SESSION['game'] = serialize($game);
        header("Location: playing.php");
        return;
    }
    elseif (isset($_GET['id']) && $game->pTurnExists()) {
        $game->setPreviousTurn($_GET['id']);
        $_SESSION['game'] = serialize($game);
        header("Location: playing.php");
        return;
    }
    if ($game->pTurnExists() && $game->aTurnExists()) {
        $game->comparison();
    }
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/game.css">
        <title>Memory: le jeu</title>
    </head>
    <body>
        <header>
            <ul>
                <li><a href="index.php">index</a></li>
                <li><a href="playing.php">Jeu</a></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </header>
        <?php 
            echo $game->printScore();
            // DEBUG
            echo $game->printReminder();
        ?>
        <article class="game flex d-flex justify-content-around">
        <?php
            if ($game->stopGame())
                echo 'METTRE UN MESSAGE DE FIN!';
            else 
                $game->buildDeck($_SESSION['shuffledDeck']);
        ?>
        </article>
    </body>
</html>

<?php 
    // DEBUG
    prp($game, '$game');

    
    $_SESSION['game'] = serialize($game);
?>