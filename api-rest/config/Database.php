<?php


class Database {
    // connexion à la bdd
    private $host      = "le serveur MySQL";
    private $dbname    = "Le nom de la base de donnée";
    private $username  = "Le login";
    private $password  = "Le password";
    private $connexion;

    // getter pour la connexion
    public function getConnection(){
        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : ".$exception->getMessage();
        }

        return $this->connexion;
    }
}