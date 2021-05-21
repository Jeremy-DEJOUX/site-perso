<?php
require_once('../class/classDb.php');
require_once('../class/classPanier.php');
$db = new Db;
$panier = new Panier($db);
$json = array('error' => true);
if (isset($_GET['id'])) {
    $product = $db->query("SELECT id FROM produits WHERE id =:id", array('id' => $_GET['id']));
    if(empty($product)){
        $json['message'] = "Le produit séléctionné n'existe pas";
    }
    $panier->add($product[0]->id);
    $json['error'] = false;
    $json['message'] = "Le produit à bien étais ajouté à votre panier";
}else {
    $json['message'] = "Vous n'avez pas séléctionner de produits à ajouter au panier";
}
echo json_encode($json);
?>