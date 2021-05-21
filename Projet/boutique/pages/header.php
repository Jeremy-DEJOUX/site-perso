<header>
    <nav class="flex j_around" id="headernav">
        <ul class="flex j_around">
            <a class="headerlink" href="<?= $path_index ?>">HOME</a>
            <?php if(empty($_SESSION['user'])){?>
                <a class="headerlink" href="<?= $path_connexion ?>">LOGIN/SIGN IN</a>
                <a class="headerlink" href="<?= $path_produits ?>">SHOP</a>
                <a class="headerlink" href="<?= $path_panier ?>">PANIER</a>
                <?php }?>
            <?php if(isset($_SESSION['user'])){
                echo
                "
                <a class='headerlink' href='$path_produits'>SHOP</a>
                <a class='headerlink' href='$path_panier'>PANIER</a>
                <a class='headerlink' href='$path_compte'>COMPTE</a>
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
</header>