<footer>
    <nav class="flex j_around" id="headernav">
        <ul class="flex j_around">
            <li><a class="headerlink" href="<?= $path_index ?>">HOME</a></li>
            <?php if(empty($_SESSION['user'])){?>
                <li><a class="headerlink" href="<?= $path_connexion ?>">LOGIN/SIGN IN</a></li>
                <li><a class="headerlink" href="<?= $path_produits ?>">SHOP</a></li>
                <li><a class="headerlink" href="<?= $path_panier ?>">PANIER</a></li>
                <?php }?>
            <?php if(isset($_SESSION['user'])){
                echo
                "
                <a class='headerlink' href='$path_deconnexion'>DECONNEXION</a>
                ";  
            }
            if (isset ($_SESSION['id_droits'])){
                if($_SESSION['id_droits']==42 || $_SESSION['id_droits']==1337){
                    echo"<a class='headerlink' href='$path_admin'>ADMIN</a>";
                }
            }

            ?>

        </ul>
    </nav>
    
</footer>