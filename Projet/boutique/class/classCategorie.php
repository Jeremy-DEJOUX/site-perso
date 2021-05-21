<?php


class Categorie{

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $titleImg;
    public $fullnameImg;
    public $orderImg;
    public $db;

    public function __construct(){
        $this->db = connect();
    }

    public function createCategory(string $name){
        if (empty($name)) {
            echo "Il faut remplir tous les champs";
            exit();

        } else {
            $stmt = $this->db->prepare("SELECT * FROM categories WHERE nom_cat = :nom");
            $stmt->bindValue(':nom', $name, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetch();

            if ($count > 0){
                echo "Le nom de la categorie existe déja";
                exit();

            } else {
                $stmt = $this->db->prepare("INSERT INTO categories (nom_cat) VALUES (:nom)");
                $stmt->bindValue(':nom', $name, PDO::PARAM_STR);
                $stmt->execute();
                header('Location: ../pages/admin.php');
            }
        }
    }

    public function getChoice(){
        $i = 0;
        $choice = $this->db->prepare("SELECT * FROM categories");
        $choice->execute();
        while($fetch = $choice->fetch(PDO::FETCH_ASSOC)){
            $tableau[$i][] = $fetch['id'];
            $tableau[$i][] = $fetch['nom_cat'];
            $i++;
        }
        return $tableau;
    }
    public function displayChoice(){
        $modelDroit = new Categorie;
        $tableau = $modelDroit->getChoice();
        foreach($tableau as $value){
            echo '<option value="'.$value[0].'">'.$value[1] .'</option>';
        }
    }

    public function deleteCat($id){
        $delete = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        $delete->bindValue(":id", $id, PDO::PARAM_INT);
        $delete->execute();
    }
}

?>
