<?php
require_once('../function/db.php');

class Droits{
    private $id;
    public $nom;

    public function __construct(){
        $this->db = connect();
    }
    public function getChoice(){
        $i = 0;
        $choise = $this->db->prepare("SELECT * FROM droits");
        $choise->execute();
        while($fetch = $choise->fetch(PDO::FETCH_ASSOC)){
            $tableau[$i][] = $fetch['id'];
            $tableau[$i][] = $fetch['nom'];
            $i++;
        }
        return $tableau;
    }
    public function displayChoice(){
        $modelDroit = new Droits();
        $tableau = $modelDroit->getChoice();
        foreach($tableau as $values){
            echo '<option value="' .$values[0] . '">'. $values[1] .'</option>';
        }
    }
}
?>