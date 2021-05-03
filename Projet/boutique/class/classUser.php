<?php 

class User
{
    private $id;
    public $login;
    public $password;
    public $email;
    public $db;
    private $id_droits;

    public function __construct()
    {
        $this->db = connect();
    }
// ----------------------------- CONNEXION --------------------------------------

    public function ConnectUser($login, $password)
    {
// On prépare la requête, on l'execute puis on fait un fetch pour récupérer les infos
        $ConnectUser = $this->db->prepare("SELECT user.login, user.password, user.email, user.id, user.id_droits, droits.nom FROM user INNER JOIN droits ON user.id_droits = droits.id WHERE user.login = :login ");
        $ConnectUser->bindValue(':login', $login, PDO::PARAM_STR);
        $ConnectUser->execute();
        $user = $ConnectUser->fetch(PDO::FETCH_ASSOC);
// si le fetch récupère quelque chose, alors :
        if(!empty($user))
        {
            if(password_verify($password, $user['password']))
            {
                $this->id = $user['id'];
                $this->login = $user['login'];
                $this->password = $user['password'];
                $this->email = $user['email'];
                $this->id_droits = $user['nom'];
                $_SESSION['id_droits'] = $user['id_droits'];
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user['id'];
// on regroupe le resultat du fetch dans un tableau de session
                $_SESSION['user'] = [
                    'id' =>
                        $this->id,
                    'login' =>
                        $this->login,
                    'password' =>
                        $this->password,
                    'email' =>
                        $this->email,
                    'id_droits' =>
                        $this->id_droits,
                ];
                header('location:../pages/profil.php');

            }
            else {
                echo "Le login ou le mot de passe est erroné.";
            }
        }
            else {
                echo "Le login ou le mot de passe est erroné.";
            }
    }
// ---------------------------------- DECONNEXION -----------------------------

    public function Disconnect(){

        session_unset();
        session_destroy();
        header('location:../index.php'); // ou autres pages 

    }
// --------------------------- INSCRIPTION ----------------------------------   
    public function register ($login, $email, $password, $confirmPW){

        $error_log = null;
        $login =  htmlspecialchars(trim($login));
        $email = htmlspecialchars(trim($email));
        $password = htmlspecialchars(trim($password));
        $confirmPW = htmlspecialchars(trim($confirmPW));  
        if (!empty($login) && !empty($password) && !empty($confirmPW) && !empty($email)) {
        
            $logLength = strlen($login); 
            $passLength = strlen($password); 
            $confirmLength = strlen($confirmPW); 
            $mailLength = strlen($email);
        
                if (($logLength >= 2) && ($passLength >= 2) && ($confirmLength >= 2) && ($mailLength >=2)) {
                   $checkLength = $this->db->prepare("SELECT login FROM user WHERE login=:login");
                   $checkLength->bindValue(":login", $login, PDO::PARAM_STR);
                   $checkLength->execute();
                   $count = $checkLength->fetch(); 

                   if (!$count) {
                    
                    if ( $password == $confirmPW) {
    
                        
    
                       $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
                    //    $this->login = $login ; 
                       $insert = $this->db->prepare("INSERT INTO user (login, password, email, id_droits ) VALUES (:login, :cryptedpass ,:email, 1)"); 
                       $insert->bindValue(":login", $login, PDO::PARAM_STR);
                       $insert->bindValue(":cryptedpass", $cryptedpass, PDO::PARAM_STR);
                       $insert->bindValue(":email", $email, PDO::PARAM_STR); 
                    //    $insert->bindValue(); 
                       $insert->execute();
                       header('location:../pages/profil.php'); 
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

// ----------------------------------------- UPDATE ------------------------------------------------//
    public function profile($login, $email, $password, $confirmPW)// intégrer e-mail
    {
        $login =  htmlspecialchars(trim($login));
        $email = htmlspecialchars(trim($email));
        $password =  htmlspecialchars(trim($password));
        $confirmPW =  htmlspecialchars(trim($confirmPW));

        if (!empty($login) && !empty($email) && !empty($password) && !empty($confirmPW)){
            

            if ($confirmPW==$password) {
                $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
                $update = ($this->db)->prepare("UPDATE user SET login = :login, password = :cryptedpass, email= :mail WHERE id = :myID"); 
                $update->bindValue(":login", $login, PDO::PARAM_STR);
                $update->bindValue(":cryptedpass",$cryptedpass, PDO::PARAM_STR);
                $update->bindValue(":myID", $_SESSION['user']['id'], PDO::PARAM_INT);
                $update->bindValue(":mail",$email, PDO::PARAM_STR);
                
                $result = $update->execute();

                if ($result) {
                    $ConnectUser = $this->db->prepare("SELECT user.login, user.password, user.email, user.id, user.id_droits, droits.nom FROM user INNER JOIN droits ON user.id_droits = droits.id");
                    $ConnectUser->execute();
                    $user = $ConnectUser->fetch(PDO::FETCH_ASSOC);

                    $this->id = $user['id'];
                    $this->login = $user['login'];
                    $this->password = $user['password'];
                    $this->email = $user['email'];
                    $this->id_droits = $user['nom'];
                    $_SESSION['id_droits'] = $user['id_droits'];
                    $_SESSION['user'] = $user;
                    $_SESSION['id'] = $user['id'];
// on regroupe le resultat du fetch dans un tableau de session
                    $_SESSION['user'] = [
                        'id' =>
                            $this->id,
                        'login' =>
                            $this->login,
                        'password' =>
                            $this->password,
                        'email' =>
                            $this->email,
                        'id_droits' =>
                            $this->id_droits,
                    ];

                    header('location:../pages/profil.php'); 
                }
            }
            else  $error_log="Confirmation du mot de passe incorrect";
        }
        else $error_log = "veuillez remplir les champs";
     
        if (isset ($error_log)) {
        return $error_log;
        }
    }
//--------------------------------------Modding User------------------------------------------

public function getUser(){
    $i = 0;
    $get = $this->db->prepare("SELECT * FROM user");
    $get->execute();
    while($fetch = $get->fetch(PDO::FETCH_ASSOC)){
        $tableau[$i][] = $fetch['id'];
        $tableau[$i][] = $fetch['login'];
        $i++;
    }
    return $tableau;
}

public function getDisplay(){
    $display = new User();
    $tableau = $display->getUser();
    foreach($tableau as $value){
        echo '<option values"' .$value[0] . '">' . $value[1] . '</option>';
    }
}

public function updateDroit($login, $id_droits){
    $update = $this->db->prepare("UPDATE user SET id_droits = :id_droits WHERE id = :login");
    $update->bindValue(":login", $login, PDO::PARAM_STR);
    $update->bindValue(":id_droits", $id_droits, PDO::PARAM_INT);
    $update->execute();

}


public function commandes($id){
    $sql = "SELECT * FROM facoprod INNER JOIN produits p ON id_produits = p.id INNER JOIN commandes c ON id_commande = c.id WHERE c.id_user = :id ORDER BY c.date DESC";
    $requete = $this->db->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $test = $requete->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['commandes'] = $test;
}

}
?>