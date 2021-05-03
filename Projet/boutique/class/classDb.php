<?php 

class Db{

    private $host = "localhost";
    private $username = "Jeremy";
    private $password = "Minato6510";
    private $database = "jeremy-dejoux_boutique";
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null){
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }

        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            die("<h1>Impossible de se connecter à la base de donnée</h1>");
        }
    }


    public function query($sql, $data = array()){
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}