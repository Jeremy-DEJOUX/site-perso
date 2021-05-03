<?php
include_once('ValidationForm.php');

class EventValidator extends Validator
{

    public function validates(array $data){
        parent::validates($data);
        $this->validate('name', 'minLength', 3);
        $this->validate('date', 'date');
        $this->validate('start', 'beforeTime', 'end');
        $this->validate('date', 'Week_End');
        return $this->errors;
    }

    public function send($bdd, $titre, $description, $debut, $fin, $id_utilisateur){
        $sql = $bdd->prepare("INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES(:titre, :desscription, :debut, :fin, :id_utilisateur)");
        $sql->execute([
            ':titre' => $titre,
            ':desciption'=> $description,
            ':debut' => $debut->format('Y-m-d-00:00:00'),
            ':fin' => $fin->format('Y-m-d-00:00:00'),
            ':id_utilisateur' => $id_utilisateur,
        ]);
    }
}
