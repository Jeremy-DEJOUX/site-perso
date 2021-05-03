<?php

class Product {

    // public $id;
    // public $name;
    // public $description;
    // public $price;
    // public $stock;
    // public $titleImg;
    // public $fullnameImg;
    // public $orderImg;
    public $db;


    public function __construct(){
        $this->db = connect();
    }

    /**
     * Create a product
     *
     * @param string $nom
     * @param string $desc
     * @param float $price
     * @param integer $stock
     * @param string $titleImg
     * @param string $FullNameImg
     * @param int $orderImg
     * @param string $nameCategory
     * @return void
     */
    public function create_Product(string $nom, string $desc, float $price, int $stock, string $titleImg, string $newFileName, $uploadfile, string $nom_cat){
        if (empty($nom) || empty($desc) || empty($price) || empty($stock)){
            echo "Il faut remplir tous les champs";
            exit();

        } elseif ($price < 0 || $stock < 0) {
            echo "Erreur au niveaux du stock ou du prix";

        } elseif (empty($newFileName)) {
            $newFileName = "img";

        } else{
            $newFileName = strtolower(str_replace(" ", "-", $newFileName));
        }

        $file = $uploadfile;
        $fileName      = $file['name'];
        $fileType      = $file['type'];
        $fileTempName  = $file['tmp_name'];
        $fileError     = $file['error'];
        $fileSize      = $file['size'];

        $fileExt       = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed       = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0){
                if ($fileSize < 2000000) {
                    $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                    $imageFullName = str_replace("/", "_", $imageFullName);
                    $fileDestination = "../ressources/img/" . $imageFullName;
    
                    if (empty($titleImg)) {
                        echo "Votre image doit avoir un Titre";
                        header("Location: ../pages/produits.php?upload=empty");
                        exit();
                    } else{
                        $sql = "SELECT * FROM produits";
                        $stmt = $this->db->query($sql);
                        $rowCount = $stmt->fetchColumn();
                        $setImageOrder = $rowCount + 1;
    
                        $sql = "INSERT INTO produits (nom, description, prix, stock, titleImg, FullNameImg, orderImg) VALUES (:nom, :desc, :prix, :stock, :titleImg, :FullNameImg, :orderImg)";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
                        $stmt->bindValue(':desc', $desc, PDO::PARAM_STR);
                        $stmt->bindValue(':prix', $price, PDO::PARAM_INT);
                        $stmt->bindValue(':stock', $stock, PDO::PARAM_STR);
                        $stmt->bindValue(':titleImg', $titleImg, PDO::PARAM_STR);
                        $stmt->bindValue(':FullNameImg', $imageFullName, PDO::PARAM_STR);
                        $stmt->bindValue(':orderImg', $setImageOrder, PDO::PARAM_INT);
                        $stmt->execute();
    
                        move_uploaded_file($fileTempName, $fileDestination);

                        $sql = "SELECT * FROM produits WHERE nom = :nom";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
                        $stmt->execute();
                        $result_prod = $stmt->fetch(PDO::FETCH_ASSOC);
                        // var_dump($result_prod);

                        $sql = "SELECT * FROM categories WHERE id = :nom";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindValue(':nom', $nom_cat, PDO::PARAM_INT);
                        $stmt->execute();
                        $result_cat = $stmt->fetch(PDO::FETCH_ASSOC);
                        // var_dump($result_cat);


                        $sql = "INSERT INTO prod_cat (id_produits, id_categorie) VALUES (:id_produits, :id_categorie)";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindValue(':id_produits', $result_prod['id'], PDO::PARAM_INT);
                        $stmt->bindValue(':id_categorie', $result_cat['id'], PDO::PARAM_INT);
                        $stmt->execute();

                        header("Location: ../pages/produits.php?upload=success");
                    }
                } else {
                echo "File size is too big";
                exit();
            }
        } else {
            "Your photo had an error";
            exit();
        }
    } else {
        echo "You need to upload a proper file type!";
        exit();
    }

    }



    public function affichageProduits(){
        $sql = "SELECT * FROM produits ORDER BY orderImg DESC";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['result'] = $result;
    }


    public function produitsByCategory($categorie){
        if ($categorie == null){
            $sql = "SELECT * FROM produits ORDER BY orderImg DESC";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['categorie'] = $result;
        }
        else
        {
            $categories = $this->db->prepare("SELECT * FROM prod_cat INNER JOIN produits p ON id_produits = p.id WHERE id_categorie = :id_categorie");
            $categories->bindValue(':id_categorie', $categorie, PDO::PARAM_INT);
            $categories->execute();
            $result = $categories->fetchAll();
            $_SESSION['categorie'] = $result;
            // var_dump($result); //{DEBUG}
        }
    }
//----------------------------------------Barre de recherche 
    public function searchBar(){

        if(isset($_POST['submit-search'])){
            $search = $_POST['search'];
            $sql = "SELECT * FROM produits WHERE nom LIKE '%$search%' OR
            description LIKE '%$search%' OR prix LIKE '%$search%'";
            $stmt=$this->db->prepare($sql);
            $stmt->execute();
            $queryResult = $stmt->fetchAll();
            // var_dump($queryResult);
    
            if(COUNT($queryResult) > 0){
                foreach ($queryResult as $key) {
                    echo $key['nom'];
                    echo $key['description'];
                    echo $key['prix'];
                }
            }
            else{
                echo "no results";
            }
        }
    }


    public function ProduitById($id){
        $article = $this->db->prepare("SELECT produits.nom, description, prix, stock, titleImg, FullNameImg, orderImg, c.nom_cat
        FROM produits INNER JOIN prod_cat p ON produits.id = p.id_produits  INNER JOIN categories c ON p.id_categorie = c.id WHERE produits.id = :id");
        $article->bindValue(':id', $id, PDO::PARAM_INT);
        $article->execute();
        $result = $article->fetchAll(PDO::FETCH_OBJ);
        // var_dump($result);
        $_SESSION['produit'] = $result;
    }

    public function modifProduit($id, $nom, $description, $prix, $stock, $titleImg, $newFileName, $uploadfile){
        if (empty($nom) || empty($description) || empty($prix) || empty($stock)){
            echo "Il faut remplir tous les champs";
            exit();

        } elseif ($prix < 0 || $stock < 0) {
            echo "Erreur au niveaux du stock ou du prix";

        } elseif (empty($newFileName)) {
            $newFileName = "img";

        } else{
            $newFileName = strtolower(str_replace(" ", "-", $newFileName));
        }

        $file = $uploadfile;
        $fileName      = $file['name'];
        $fileType      = $file['type'];
        $fileTempName  = $file['tmp_name'];
        $fileError     = $file['error'];
        $fileSize      = $file['size'];

        $fileExt       = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed       = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0){
                if ($fileSize < 2000000) {
                    $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                    $fileDestination = "../ressources/img/" . $imageFullName;
    
                    if (empty($titleImg)) {
                        echo "Votre image doit avoir un Titre";
                        header("Location: ../pages/produits.php?upload=empty");
                        exit();
                    } else{
                        $sql = "SELECT * FROM produits";
                        $stmt = $this->db->query($sql);
                        $rowCount = $stmt->fetchColumn();
                        $setImageOrder = $rowCount + 1;
                        $sql = "SELECT * FROM produits WHERE id = :id";
                        $query = $this->db->prepare($sql);
                        $query->bindValue(':id', $id, PDO::PARAM_INT);
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        // var_dump($result);

                        $sql = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, stock = :stock, titleImg = :titleImg, FullNameImg = :FullNameImg, orderImg = :order WHERE id = :id";
                        $update = $this->db->prepare($sql);
                        $update->bindValue(':nom', $nom, PDO::PARAM_STR);
                        $update->bindValue(':description', $description, PDO::PARAM_STR);
                        $update->bindValue(':prix', $prix, PDO::PARAM_STR);
                        $update->bindValue(':stock', $stock, PDO::PARAM_INT);
                        $update->bindValue(':titleImg', $titleImg, PDO::PARAM_STR);
                        $update->bindValue(':FullNameImg', $imageFullName, PDO::PARAM_STR);
                        $update->bindValue(':order', $setImageOrder, PDO::PARAM_INT);
                        $update->bindValue(':id', $id, PDO::PARAM_INT);
                        $update->execute();

                        move_uploaded_file($fileTempName, $fileDestination);
                    }
                }
            }
        }
    }

    public function deleteProd($id){
        $delete = $this->db->prepare("DELETE FROM produits WHERE id = :id");
        $delete->bindValue(":id", $id, PDO::PARAM_INT);
        $delete->execute();
    }


    public function getProd(){
        $i = 0;
        $choice = $this->db->prepare("SELECT * FROM produits");
        $choice->execute();
        while($fetch = $choice->fetch(PDO::FETCH_ASSOC)){
            $tableau[$i][] = $fetch['id'];
            $tableau[$i][] = $fetch['nom'];
            $i++;
        }
        return $tableau;
    }
    public function displayProd(){
        $modelDroit = new Product;
        $tableau = $modelDroit->getProd();
        foreach($tableau as $value){
            echo '<option value="'.$value[0].'">'.$value[1] .'</option>';
        }
    }
//-------------------------------------------------------------------------------------------
    public function getDisplayProd(){
        $display = new Product();
        $tableau = $display->affichageProduits();
        for ($i=0; $i < count($_SESSION['result']); $i++) { 
            echo 
                "<a href='pages/produit.php?id=$i' class='a-slide'>
                    <img class='img-slide' src='ressources/img/" . $_SESSION['result'][$i]['FullNameImg'] . "'>
                </a>";
        }
    }
}
