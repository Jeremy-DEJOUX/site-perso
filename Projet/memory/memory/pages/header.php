<!-- ====================CONNECTED==================== -->
<?php
// $connected = $_SESSION['user']->isConnected();
if (isset($_SESSION['id'])) {
?>
    <header class="flex a_center">
        <nav class="flex a_center">
            <ul class="flex j_around a_center">
                <li> <?php echo "<a href='$path_index'> Acceuil </a>"; ?> </li>
                <li> <?php echo "<a href='$path_profil'> Profil </a>"; ?> </li>
                <li> <?php echo "<a href='$path_wall'> Wall Of Fame </a>"; ?> </li>
            </ul>
        </nav>
    </header>

    <!-- =======================NOT CONNECTED================== -->
<?php
} else {
?>

    <header class="flex a_center">
        <nav class="flex a_center">
            <ul class="flex j_around a_center">
                <li> <?php echo "<a href='$path_index'>Acceuil</a>"; ?> </li>
                <li> <?php echo "<a  href='$path_inscription'> Inscription </a>";  ?> </li>
                <li> <?php echo "<a  href='$path_connexion'> Connexion </a>";  ?> </li>
            </ul>
        </nav>
    </header>

<?php
}
?>