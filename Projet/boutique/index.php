<?php

require_once('class/classDb.php');
require_once("function/db.php"); 
require_once("class/classUser.php");
require_once("class/classProduits.php");
$db = new Db;
$produits = new Product;

$path_index="";
$path_connexion="pages/profil.php";
$path_panier="pages/panier.php";
$path_produits="pages/produits.php";
$path_admin="pages/admin.php";
$path_footer='../css/footer.css';
$path_compte='pages/profil.php';
$path_deconnexion='pages/deconnexion.php'

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="ressources/CSS/index.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once('pages/header.php'); ?>
    <img id='logo' src='ressources/img/logo.png' alt='Logo Site'>
        <main>
        <article class="box-slide">
            <h1 id="titre-prod">Nos Derniers produits</h1>
            <section class="slide-show">
            <?php $products = $db->query("SELECT * FROM produits ORDER BY id DESC LIMIT 3 "); ?>
            <?php foreach ($products as $product): ?>
                
                    <a class="a-slide" href="pages/produit.php?id=<?= $product->id; ?>"><img class='img-slide'src="ressources/img/<?=$product->FullNameImg ?>" alt="Img Produits"></a>

            <?php endforeach; ?>
            </section>
        </article>
            <div class="card-container"> 
                <div class="card"><a href="">
                    <div class="card--display"><i class="material-icons">À propos de Effing dice</i>
                    </div>
                    <div class="card--hover">
                        <h2>QUI SOMMES NOUS ?</h2>
                        <p>« Effing dice » actuel, d’origine Nantaise (et donc bretonne sans vouloir polémiquer ;) a été fondé en 1995 mais les "Grands Anciens" bordelais se rappellent sans doute d’une boutique du même nom par chez eux. Un lien ? Mmm... Presque ! Disons que le phénix a changé de peau et déménagé à Nantes... Depuis 1999, le Temple du Jeu est aussi sur internet et vous livre le plus rapidement possible tous les jeux de vos rêves. A l’heure actuelle, tous vos colis partent du magasin nantais, qui reste la maison-mère même si d’autres boutiques existent maintenant.</p>
                    </div></a>
                    <div class="card--border"></div>
                </div>
                </div>
                <div class="card-container"> 
                    <div class="card card--dark"><a href="">
                        <div class="card--display"><i class="material-icons">Ou nous trouver</i>
                            <h2>Partout en France</h2>
                        </div>
                        <div class="card--hover">
                            <p>Car Effing dice, ce n’est pas seulement un site internet : c’est aussi, depuis 1995, une boutique à Nantes (Médiathèque), qui propose sur près de 200m² toutes les références du site internet. Depuis 2006, un second "Temple" a ouvert à Rennes (Zola), suivi d’un troisième à Vannes (quartier St Patern). Des boutiques ont aussi plus récemment été ouvertes à Brest et Saint Nazaire, à Limoges et à Poitiers... Et sans doute très bientôt tout près de chez vous...</p>
                        </div></a>
                        <div class="card--border"></div>
                    </div>
                </div>
                <div class="card-container"> 
                    <div class="card card--dark"><a href="">
                        <div class="card--display"><i class="material-icons">Pourquoi nous</i>
                            <h2>DU CHOIX & DES GENS</h2>
                        </div>
                        <div class="card--hover">
                            <p>Jeux de société, jeux de figurines, cartes à collectionner ou jeux traditionnels... des milliers de références que vous ne trouverez nulle part ailleurs et des vendeurs passionnés avec chacun leur domaine de prédilection, pour vous aider à trouver le jeu qui vous plaira !</p>
                        </div></a>
                        <div class="card--border"></div>
                </div>
            </div>
        </main>
        <?php require_once('pages/footer.php');?>
</body>
</html>
