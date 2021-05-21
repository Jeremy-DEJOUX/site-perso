<?php
require_once('../class/classProduits.php');
require_once('../function/db.php');
require_once('../class/classPanier.php');
require_once('../class/classDb.php');
require_once('../class/classCommentaire.php');
$db = new Db;
$panier = new Panier($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Produit</title>
    <link rel="stylesheet" href="../ressources/CSS/Produit.css">
</head>
<body>

    <?php

        if(isset($_SESSION['user'])){
            $login = $_SESSION['user'];
        }
        if(isset($_POST["postComment"])){
            $comment = new Comment;
            $comment->postComment($login, $_POST['comment'], $_GET['id']);
        }
        $comment = new Comment;
        $comment->displayComment($_GET['id']);

        if (isset($_GET['id'])):
            $produit = new Product();
            $produit->ProduitById($_GET['id']);
            foreach ($_SESSION['produit'] as $row): ;
    ?>


    <main>
        
        <div id="first_box">
            <nav id="navigation">
                <a href="produits.php">Produits</a>
                <a href="profil.php">Compte</a>
                <a href="panier.php">Panier</a>
            </nav>
            <div id="box">

                <section id="box_left">

                    <article id="container_top">
                        <h1><?= $row->nom ?></h1>
                    </article>

                    <article id="container_mid">

                        <article id="tab_left">
                            <p><?= $row->description ?></p>
                        </article>



                        <article id="tab_right">
                            <article id="tab_top">
                                <p>Prix: <?= $row->prix ?>€</p>
                            </article>


                            <article id="tab_mid">
                                <p>Stock: <?= $row->stock ?></p>
                            </article>


                            <article id="tab_bot">
                                <p>Temps: 1 A 2h</p>
                            </article>
                        </article>

                    </article>

                    <div id="container_bot">

                        <?php if (isset($_SESSION['user'])): ?>
                            <form id="formCom" action="" method='POST'>
                                <label for="">Ajouter un commentaire</label><br>
                                <textarea name="comment" id="" cols="30" rows="2"></textarea><br>
                                <input type="submit" name="postComment" value="Envoyer">
                            </form>
                            <a id="add_cart" class="addPanier" href="addpanier.php?id=<?= $_GET['id'] ?>">ADD TO CART</a>

                            <?php else: ?>
                                <p>Pour ajouter se produits a votre panier veuillez vous <a href="profil.php"> connecter </a></p>
                        <?php endif; ?>

                        
                    </div>

                </section>



                <div id="box_right">
                    <img src="../ressources/img/<?= $row->FullNameImg ?>" alt="<?= $row->titleImg ?>">
                </div>


                            
                        <?php endforeach; ?>
                    <?php endif; ?>

                

            </div>


        </div>

        <div id="second_box">
            <h2>Commentaires :</h2>
            <?php foreach($_SESSION['commentaire'] as $row): ?>
                <div class="Commentaire_box">
                    <p class="login"> <?= $row['login'] ?> : </p>
                    <p class="commentaire"> <?= $row['commentaire'] ?> </p>
                    <?php $date = new DateTime($row['date']); ?>
                    <p class="date"> <?= date_format($date, 'Y-F-j G:i:s') ?> </p>
                </div>

            <?php endforeach; ?>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="../ressources/JS/script.js"></script>


    <?php //require_once'footer.php';?>
</body>
</html>


