<?php

class Panier{

    private $db;

    public function __construct($db){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        $this->db = $db;
        if(isset($_GET['delPanier'])){
            $this->del($_GET['delPanier']);
        }
        if(isset($_POST['panier']['quantity'])){
            $this->recalc();
        }
    }

    public function recalc(){
        foreach ($_SESSION['panier'] as $product_id => $quantity){
            if(isset($_POST['panier']['quantity'][$product_id])){
                $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
            }
        }
    }

    public function add($product_id){
        if(isset($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        }else {
            $_SESSION['panier'][$product_id] = 1;
        }
    }

    public function del($product_id){
        unset($_SESSION['panier'][$product_id]);
    }

    public function total(){
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if(empty($ids)){
            $products = array();
        } else {
            $products = $this->db->query('SELECT id, prix FROM produits WHERE id IN ('.implode(',',$ids).')');
        }
        foreach( $products as $product){
            $total += $product->prix * $_SESSION['panier'][$product->id];
        }
        return $total;
    }

    public function count(){
        return array_sum($_SESSION['panier']);
    }

    public function commande($id, $nom = [] ){
        $commande = connect()->prepare("INSERT INTO commandes (date, id_user) VALUES (NOW(), :id)");
        $commande->bindValue(':id', $id, PDO::PARAM_INT);
        $commande->execute();

        if ($commande) {
            $prod = connect()->prepare("SELECT * FROM commandes INNER JOIN (SELECT id_user, MAX(date) AS MaxDateTime FROM commandes GROUP BY id_user) groupedtt ON commandes.id_user = groupedtt.id_user AND date = groupedtt.MaxDateTime WHERE commandes.id_user = :id");
            $prod->bindValue(':id', $id, PDO::PARAM_STR);
            $prod->execute();
            $result_com = $prod->fetch(PDO::FETCH_ASSOC);

            foreach ($nom as $name){

                echo "Votre commande à bien étais prise en compte";
                $prod = connect()->prepare("SELECT * FROM produits WHERE nom = :nom");
                $prod->bindValue(':nom', $name, PDO::PARAM_STR);
                $prod->execute();
                $result_prod = $prod->fetch(PDO::FETCH_ASSOC);

                $commande = connect()->prepare("INSERT INTO facoprod (id_produits, id_commande) VALUES (:id_produits, :id_commande)");
                $commande->bindValue(':id_produits', $result_prod['id'], PDO::PARAM_INT);
                $commande->bindValue(':id_commande', $result_com['id'], PDO::PARAM_INT);
                $commande->execute();

                if ($commande) {
                    $_SESSION['panier'] = [];
                }
            }




            
        }


    }
}