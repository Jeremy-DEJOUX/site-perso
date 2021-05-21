

<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
require_once('../function/db.php');
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');
$db = new Db;
$panier = new Panier($db);
$produits = new Product;

$path_index="../index.php";
$path_connexion="profil.php";
$path_panier="panier.php";
$path_produits="newproduct.php";
$path_admin="admin.php";
$path_footer='../ressources/css/footer.css';
$path_header='../ressources/css/header.css';
$path_deconnexion='deconnexion.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../ressources/CSS/produits.css">
    <title>Produits</title>
</head>
<body>

    <main>

        <div id="Container">
            <nav id="navigation">
                <a href="../index.php">Acceuil</a>
                <a href="profil.php">Compte</a>
                <a href="panier.php">Panier</a>
            </nav>

    
    
            <div id="Filtrage">
                <form action="" method="post">
                    <select name="trieCategorie" value="1">
                        <option value="" selected disabled hidden>Select</option>
                            <?php
                                $cat = new Categorie();
                                $cat->displayChoice();
                            ?>
                    </select>

                    <input class="myButton" type="submit" name="CategorieChoose" value="Filtrer">
                </form>


                </form>

                   
                <form method="post">

                    <input type='text' name='search' placeholder='Search'>
                    <input class="myButton" type="submit" name="submit-search" value="search">

                </form>
            </div>

    
    
            <div class="Container_Produits">
                <?php

                    if(isset($_POST['submit-search'])):
                        $search = $_POST['search'];
                        $sql = "SELECT * FROM produits WHERE nom LIKE '%$search%'";
                        $stmt=connect()->prepare($sql);
                        $stmt->execute();
                        $queryResult = $stmt->fetchAll();

                        if(COUNT($queryResult) > 0):
                            foreach ($queryResult as $key):
                ?>
                    <div class="box_product">
                        <a class="lien_product" href="produit.php?id=<?= $key['id'] ?>"> <img class="img_product" src="../ressources/img/<?= $key['FullNameImg'] ?>" alt="<?= $key['titleImg'] ?>"> </a>
                        <p> <?= $key['nom']; ?> </p>

                    </div>
                        
                <?php 
                        endforeach;
                    else:
                        echo "no results";
                    endif;
                else:;
                ?>

                <?php

                    if(isset($_POST['CategorieChoose'])):
                        if (isset($_POST['trieCategorie'])):
                            $search = $_POST['trieCategorie'];
                            $produits->produitsByCategory($search);
                            foreach ($_SESSION['categorie'] as $key):
                ?>
                    <div class="box_product">
                        <a class="lien_product" href="produit.php?id=<?= $key['id'] ?>"> <img class="img_product" src="../ressources/img/<?= $key['FullNameImg'] ?>" alt="<?= $key['titleImg'] ?>"> </a>
                        <p> <?= $key['nom']; ?> </p>

                    </div>
                        
                <?php 
                        endforeach;
                    else:
            ?>

                    <?php $products = $db->query("SELECT * FROM produits"); ?>
                    <?php foreach ($products as $product): ?>

                    <div class="box_product">
                        <a class="lien_product" href="produit.php?id=<?= $product->id; ?>"> <img class="img_product" src="../ressources/img/<?=$product->FullNameImg ?>" alt=""> </a>
                        <p> <?= $product->nom; ?> </p>
                    </div>

                    <?php 
                    endforeach;
                    endif;
                    else:
                ?>
                <?php $products = $db->query("SELECT * FROM produits"); ?>
                <?php foreach ($products as $product): ?>

                    <div class="box_product">
                        <a class="lien_product" href="produit.php?id=<?= $product->id; ?>"> <img class="img_product" src="../ressources/img/<?=$product->FullNameImg ?>" alt=""> </a>
                        <p class="nomJeu"> <?= $product->nom; ?> </p>
                    </div>

                <?php 
                    endforeach;
                    endif;
                    
                endif;
                ?>
            </div>


        </div>

    </main>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="../ressources/JS/script.js"></script>

</body>
</html>