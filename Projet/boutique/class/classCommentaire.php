<?php
require_once('../class/classDb.php');
class Comment{

    private $id;
    public $comment;
    private $id_produit;
    public $date;
    private $idUser;


    public function __construct(){
        $this->db = connect();
    }

//------------Ajout de commentaire-------------------
    public function postComment($login, $comment, $id){
        $errorCom = null;
        $secureComment = htmlspecialchars(trim($comment));

        if(!empty($comment)){
            $comLength = strlen($comment);

            if(($comLength < 240)){
                $insertCom = $this->db->prepare("INSERT INTO commentaires (id_user, commentaire, id_produit, date) VALUES (:login, :commentaire, :id_produit, NOW())");
                $insertCom->bindValue(":login", $login['id'], PDO::PARAM_INT);
                $insertCom->bindValue(":commentaire", $secureComment, PDO::PARAM_STR);
                $insertCom->bindValue(":id_produit", $id, PDO::PARAM_INT);
                $insertCom->execute();
            }
            else{
                $errorCom = "Max comment 240 characters";
            }
        }
        echo $errorCom;
    }
//---------------------------------------------display commentaire--------------------------

    public function displayComment($id){
        $comment = $this->db->prepare("SELECT c.commentaire, c.date, c.id_user, c.id_produit, p.id, u.login FROM commentaires c INNER JOIN produits p ON c.id_produit = p.id INNER JOIN user u ON c.id_user = u.id WHERE p.id = :id ORDER BY c.date DESC LIMIT 5 ");    
        $comment->bindValue(':id', $id, PDO::PARAM_INT);
        $comment->execute();
        $result = $comment->fetchAll();
        $_SESSION['commentaire'] = $result;
    }
}
?>