<?php
require_once("../function/db.php");
require_once("../class/classAdmin.php");
require_once('../class/classProduits.php');
require_once('../class/classCategorie.php');
require_once('../class/classUser.php');
require_once('../class/classDroits.php');

//-----------------------chemin-----------------


// require_once('header.php');
if(!isset($_SESSION['id_droits']) OR $_SESSION['id_droits'] != 1337){
   echo "Only admin can accest this page"; 
}
else{

$produits = new Product;
//------------------------------------------PRODUITS---------------------------------
if (isset($_POST['product'])) {
    $produits->create_Product($_POST['nom'], $_POST['desc'], $_POST['price'], $_POST['stock'], $_POST['filetitle'], $_POST['filedesc'], $_FILES['fileupload'], $_POST['nom_cat']);
}

if (isset($_POST['category'])) {
    $category = new Categorie;
    $category->createCategory($_POST['nom_cat']);
}
if (isset($_POST['modifProd'])){
    $produits->modifProduit($_POST['id_prod'],$_POST['nameProd'], $_POST['desc'], $_POST['prix'], $_POST['stock'], $_POST['titleImg'], $_POST['descImg'], $_FILES['fileupload']);
}

if (isset($_POST['deleteProd'])) {
    $produits->deleteProd($_POST['id_prod']);
}
if (isset($_POST['delete_cat'])){
    $category = new Categorie;
    $category->deleteCat($_POST['deleteCat']);
}
//-----------------------------------------USER---------------------------------------------

if(isset($_POST['createUser'])){
    $create = new Admin;
    $create->registerNewUser($_POST['createLogin'], $_POST['eMail'], $_POST['createPW'], $_POST['confirmPW'], $_POST['droitsNewUser']);
}
if(isset($_POST['deleteUser'])){
    $delete = new Admin();
    $delete->deleteUser($_POST['moddingUser']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../ressources/CSS/admin.css">
</head>
<body>
    <main>


        <nav id="navigation">
            <a href="../index.php">Acceuil</a>
            <a href="admin.php?id=categorie">Cagtegorie</a>
            <a href="admin.php?id=produits">Produits</a>
            <a href="admin.php?id=user">Utilisateurs</a>
            <a href="admin.php?id=commandes">Commandes</a>
        </nav>
        


        <?php if(isset($_GET['id'])): ?>


<!--============================================PANEL CATEGORIE============================================-->

                <?php if($_GET['id'] == 'categorie'): ?>
                    
                    <section>
                        <h2>AJOUT DE CATEGORIE</h2>
                    
                        <form action="" method="post" id="Categories">
                            <input type="text" name="nom_cat" placeholder="Category name...">
                            <input type="submit" name="category" value="Envoyer">
                        </form>
                    </section>



                    <section>
                        <h2>SUPPRESSION DE CATEGORIE</h2>

                        <form action="" method="post">
                            <select name="deleteCat">
                                <option selected disabled hidden>Select</option>
                                    <?php
                                        $cat = new Categorie();
                                        $cat->displayChoice();
                                    ?>
                            </select>
                            <input type="submit" value="Supprimer" name="delete_cat">
                        </form>
                    </section>
                



<!--============================================PANEL PRODUITS============================================-->

                <?php elseif($_GET['id'] == 'produits'): ?>

                    <section>

                        <h2>AJOUT DE PRODUIT</h2>

                        <form id="add_product" action="" method="post" enctype="multipart/form-data">

                            <div class="product">
                                <input type="text" name="nom" placeholder="Product Name...">
                                <input type="text" name="desc" placeholder="Description...">
                                <input type="number" name="price" placeholder="Prix...">
                                <input type="number" step=".01" name="stock" placeholder="Stock...">

                                <label>Select Categorie</label>
                                    <select name="nom_cat">
                                        <option  selected disabled hidden>Select</option>
                                            <?php
                                                $cat = new Categorie();
                                                $cat->displayChoice();
                                            ?>
                                    </select>
                            </div>

                            <div class="product">
                                <input type="text" name="filetitle" placeholder="Image title...">
                                <input type="text" name="filedesc" placeholder="Image description...">
                                <input type="file" name="fileupload">
                            </div>

                            
                            <input type="submit" name="product" value="Envoyer">
                        </form>
                    </section>


                    <section>
                        <h2>MODIFICATION SUPPRESSION PRODUITS</h2>
                        <form id="add_product" action="" method="post" enctype="multipart/form-data">

                        <div class="product">
                            <label>Produits</label>
                            <select name="id_prod">
                                <option selected disabled hidden>Select</option>
                                    <?php
                                        $cat = new Product();
                                        $cat->displayProd();
                                    ?>
                            </select>

                            <input type="text" name="nameProd" placeholder="Nom du produit...">

                            <input type="text" name="desc" placeholder="Description...">

                            <input type="number" name="prix" placeholder="Prix...">

                            <input type="number" name="stock" placeholder="Stock...">
                        </div>
                            
                        <div class="product">
                            <input type="text" name="titleImg" placeholder="Titre IMG...">

                            <input type="text" name="descImg" placeholder="Description img...">

                            <input type="file" name="fileupload">
                        </div>
                            

                            <div>
                                <input type="submit" name="modifProd" value="Envoyer">
                                <input type="submit" name="deleteProd" value="Supprimer">
                            </div>

                        </form>
                    </section>


<!--============================================PANEL UTILISATEURS============================================-->
                <?php elseif($_GET['id'] == 'user'): ?>

                    <section id="section_user">
                        <article>
                            <h2>Ajout new user</h2>
                            <form id="add_user"  id="createUser" action="" method="POST">
                                <label for="createLogin">Login</label>
                                <input type="text" name="createLogin">
                                <label for="email">Email</label>
                                <input type="email" name="eMail">
                                <label for="createPW" name="password">Mot de passe</label>
                                <input type="password" name="createPW">
                                <label for="confirmPW">Confirmz vote mot de passe</label>
                                <input type="password" name="confirmPW">
                                <select name="droitsNewUser">
                                            <option  selected disabled hidden>Select</option>
                                            <?php
                                            $droits = new Droits();
                                            $droits->displayChoice();
                                            ?>
                                        </select>
                                <input type="submit" name="createUser" value="Create">
                            </form>
                        </article>

                        <article>
                            <h2>Modification de User</h2>
                            <form id="add_user" action="" method="POST">

                                <select name="moddingUser">
                                    <option  >Select</option>
                                    <?php
                                    $article = new User();
                                    $article->getDisplay();
                                    ?>
                                </select>
                                
                                <label for="UpdateLog">Login</label>
                                <input type="text" name="UpdateLog">

                                <label for="UpdateMail">E-Mail:</label>
                                <input type="eMail" name="UpdateMail">

                                <label for="updatePW">Nouveau mot de passe:</label>
                                <input type="password" name="updatePW">

                                <label for="updateCPW">Confirmez le mot de passe: </label>
                                <input type="password" name="updateCPW">

                                <label>Select Droits</label>
                                <select name="droitUser">
                                    <option>Select</option>
                                    <?php
                                    $droits = new Droits();
                                    $droits->displayChoice();
                                    ?>
                                </select>

                                <input type="submit" name="mod" value="Envoyer">
                                <input type="submit" name="deleteUser" value="Supprimer">
                            </form>
                        </article>
                    </section>
        <?php 
            if(isset($_POST['mod'])){
                $droits = new User();
                $droits->updateDroit($_POST['moddingUser'], $_POST['droitUser']);
                $update = new Admin();
                $update->UpdateNewUser($_POST['moddingUser'], $_POST['UpdateLog'], $_POST['UpdateMail'], $_POST['updatePW'], $_POST['updateCPW']);
            }
        ?>


                    <?php elseif($_GET['id'] == 'commandes'): ?>

                    <section id="commandes">
                        <form id="add_user" action="" method="POST">

                                <select name="choiceUser">
                                    <option  selected disabled hidden>Select</option>
                                    <?php
                                    $article = new User();
                                    $article->getDisplay();
                                    ?>
                                </select> <br>
                            <input type="submit" name="commandes" value="Voir commandes">
                        </form> <br>
                            <?php 
                                if (isset($_POST['commandes'])):
                                $user = new Admin;
                                if (isset($_POST['choiceUser'])){
                                $user->commandes_admin($_POST['choiceUser']);}
                                foreach($_SESSION['commandes'] as $row):
                            ?>

                                <div class="my_commandes">
                                    <p> Nom du produits: <?= $row['nom']; ?> </p>
                                    <img src="../ressources/img/<?= $row['FullNameImg']; ?>" alt="">
                                    <p>Date de la commande : <?= $row['date']; ?></p>
                                </div>
                            <?php 
                                endforeach; 
                                endif; 
                            ?>
                    </section>
                    
            <?php endif; ?>
        <?php endif; ?>


    </main>
</body>
</html>

<?php } ?>