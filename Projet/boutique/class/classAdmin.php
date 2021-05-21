<?php

class Admin{
    public $login;
    public $password;
    public $id_droits;
    public $db;

    public function __contruct(){
        $this->db = connect();
    }
//------------------------------------------------------Donné les droits -------------------------------------------------------------------------------------
    public function updateDroits($login, $id_droits){
        if (!empty($id_droits) && !empty($login)){
        $query = $this->db->prepare("UPDATE user SET id_droits=:id WHERE id=:login");
        $query->bindValue(":id", $id_droits, PDO::PARAM_INT);
        $query->bindValue(":login", $login, PDO::PARAM_STR);
        $query->execute();
    }else {
        echo "Veuillez remplir tous les champs";
    }
    }   
//----------------------------------------Ajout Utilisateur-------------------------------------------------------------------------------
    public function registerNewUser ($login, $email, $password, $confirmPW, $id_droits){

        $error_log = null;

        $login     = htmlspecialchars(trim($login));
        $email     = htmlspecialchars(trim($email));
        $password  = htmlspecialchars(trim($password));
        $confirmPW = htmlspecialchars(trim($confirmPW));

        if (!empty($login) && !empty($password) && !empty($confirmPW) && !empty($email) && !empty($id_droits)){
            
            $logLength = strlen($login); 
            $passLength = strlen($password); 
            $confirmLength = strlen($confirmPW); 
            $mailLength = strlen($email);

            if(($logLength >= 2) && ($passLength >= 2) && ($confirmLength >= 2) && ($mailLength >= 2)){
                $checkLength = connect()->prepare("SELECT login FROM user WHERE login=:login");
                $checkLength->bindValue(":login", $login, PDO::PARAM_STR);
                $checkLength->execute();
                $count = $checkLength->fetch();

                if(!$count){

                    if ($password == $confirmPW){
                        
                        $cryptepass = password_hash($password, PASSWORD_BCRYPT);
                        $insert = connect()->prepare("INSERT INTO user (login, password, email, id_droits ) VALUES (:login, :cryptedpass, :email, :id_droits)");
                        $insert->bindValue(":login", $login, PDO::PARAM_STR);
                        $insert->bindValue(":cryptedpass", $cryptepass, PDO::PARAM_STR);
                        $insert->bindValue(":email", $email, PDO::PARAM_STR);
                        $insert->bindValue(":id_droits", $id_droits, PDO::PARAM_INT);
                        $insert->execute();
                        echo "New user Added";
                    }
                    else {
                        $error_log = "confirmation du mot de passe incorrect"; 
                    }
                }
                else {
                    $error_log = "l'identifiant existe déjà"; 
                }
            }
            else {
                $error_log = "2 caractères minimum doivent être insérés dans chaques champs" ; 
            }
        }
        else {
            $error_log = "Champs non remplis" ; 
        }
        echo $error_log;
    }
//--------------------------------------------------------Update USER ADMIN----------------------------------------------------
    public function UpdateNewUser($old_login, $login, $email, $password, $confirmPW){

        $login     = htmlspecialchars(trim($login));
        $email     = htmlspecialchars(trim($email));
        $password  = htmlspecialchars(trim($password));
        $confirmPW = htmlspecialchars(trim($confirmPW));

        if (!empty($login) && !empty($email) && !empty($password) && !empty($confirmPW)){

            $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
            $update = connect()->prepare("UPDATE user SET login = :login, password = :cryptedpass, email= :mail WHERE login = :old_login"); 
            $update->bindValue(":login", $login, PDO::PARAM_STR);
            $update->bindValue(":cryptedpass",$cryptedpass, PDO::PARAM_STR);
            $update->bindValue(":old_login", $old_login, PDO::PARAM_STR);
            $update->bindValue(":mail",$email, PDO::PARAM_STR);
            
            $update->execute();

            }
            else{ $error_log = "veuillez remplir les champs";
            }
        
        
     if (isset ($error_log)) {
        return $error_log;
    }}
//-----------------------------------------------------------------------------delete user-----------------------------------------------------------------------
    public function deleteUser($login)
    {

        $deleteQuery = connect()->prepare("DELETE FROM user WHERE login = :login");
        $deleteQuery->bindValue(":login", $login, PDO::PARAM_STR);
        $deleteQuery->execute();
    }


    public function commandes_admin($id){
    $sql = "SELECT * FROM facoprod INNER JOIN produits p ON id_produits = p.id INNER JOIN commandes c ON id_commande = c.id  INNER JOIN user u ON c.id_user = u.id WHERE u.login = :id ORDER BY c.date DESC";
    $requete = connect()->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $test = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['commandes'] = $test;
}


}
?>  