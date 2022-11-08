<?php

class Stagiaires{

     // Pour la connexion
     private $connexion;
     private $table = "stagiaires";
 
 
     // les propriétes de l'objet
     public $code_stgr;
     public $nom_stgr;
     public $prenom_stgr;
     public $date_naissance_stgr;
     public $tel_fixe_stgr;
     public $tel_portable_stgr;
     public $email_stgr;
     public $code_formation_stgr;
 
     /**
      * Constructeur avec $db pour la connexion à la bdd
      * @param $db
      */
 
     public function __construct($db)
     {
         $this->connexion = $db;
     }
 
     /**
      * Lecture des formations
      * @return void
      */
 
     public function read()
     {
         // Ecriture de la requête
         $sql = "SELECT code_stgr, nom_stgr, prenom_stgr, date_naissance_stgr, tel_fixe_stgr, tel_portable_stgr, email_stgr, code_formation_stgr FROM " .$this->table;
         //$sql = "SELECT nom_formation, date_debut, date_fin, code_filiere_formation FROM formation";
 
         // Préparation de la requête
         $query = $this->connexion->prepare($sql);
 
         // Exécution de la requête
         $query->execute();
         
         // On renvoie le résultat
         return $query;
     }
 
     /**
      * Créer une formation
      * @return void
      */
 
     public function create()
     {
         // Ecriture de la requête sql
         $sql = "INSERT INTO ".$this->table." SET code_stgr=:code, nom_stgr=:nom, prenom_stgr=:prenom, date_naissance_stgr=:date, tel_fixe_stgr=:fixe, tel_portable_stgr=:portable, email_stgr=:email, code_formation_stgr=:formation_stgr";
 
         // Préparation de la requête
         $query = $this->connexion->prepare($sql);
 
         // Protection contre les injections SQL
         $this->code_stgr = htmlspecialchars(strip_tags($this->code_stgr));
         $this->nom_stgr = htmlspecialchars(strip_tags($this->nom_stgr));
         $this->prenom_stgr = htmlspecialchars(strip_tags($this->prenom_stgr));
         $this->date_naissance_stgr = htmlspecialchars(strip_tags($this->date_naissance_stgr));
         $this->tel_fixe_stgr = htmlspecialchars(strip_tags($this->tel_fixe_stgr));
         $this->tel_portable_stgr = htmlspecialchars(strip_tags($this->tel_portable_stgr));
         $this->email_stgr = htmlspecialchars(strip_tags($this->email_stgr));
         $this->code_formation_stgr = htmlspecialchars(strip_tags($this->code_formation_stgr));
 
         // Ajout des données protégées
         $query->bindParam(":code", $this->code_stgr);
         $query->bindParam(":nom", $this->nom_stgr);
         $query->bindParam(":prenom", $this->prenom_stgr);
         $query->bindParam(":date", $this->date_naissance_stgr);
         $query->bindParam(":fixe", $this->tel_fixe_stgr);
         $query->bindParam(":portable", $this->tel_portable_stgr);
         $query->bindParam(":email", $this->email_stgr);
         $query->bindParam(":formation_stgr", $this->code_formation_stgr);
 
         // Execution de la requête
         if ($query->execute()) {
             return true;
         }
         return false;
     }
 
     /**
      * Lire un stagiaire
      *
      * @return void
      */
     public function readOne(){
         // On écrit la requête
         $sql = "SELECT code_stgr, nom_stgr, prenom_stgr, date_naissance_stgr, tel_fixe_stgr, tel_portable_stgr, email_stgr, code_formation_stgr FROM " .$this->table." WHERE code_stgr = ? ";
         //$sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";
 
         // On prépare la requête
         $query = $this->connexion->prepare( $sql );
 
         // On attache le code
         $query->bindParam(1, $this->code_stgr);
 
         // On exécute la requête
         $query->execute();
 
         // on récupère la ligne
         $row = $query->fetch(PDO::FETCH_ASSOC);
 
         // On hydrate l'objet
         $this->code_stgr = $row['code_stgr'];
         $this->nom_stgr = $row['nom_stgr'];
         $this->prenom_stgr = $row['prenom_stgr'];
         $this->date_naissance_stgr = $row['date_naissance_stgr'];
         $this->tel_fixe_stgr = $row['tel_fixe_stgr'];
         $this->tel_portable_stgr = $row['tel_portable_stgr'];
         $this->email_stgr = $row['email_stgr'];
         $this->code_formation_stgr= $row['code_formation_stgr'];
     }
 
        /**
      * Modifier un stagiaire
      *
      * @return void
      */
     public function update()
     {
         // On écrit la requête
         $sql = "UPDATE " . $this->table . " SET code_stgr=:code, nom_stgr=:nom, prenom_stgr=:prenom, date_naissance_stgr=:date, tel_fixe_stgr=:fixe, tel_portable_stgr=:portable, email_stgr=:email, code_formation_stgr=:formation_stgr";
         
         // On prépare la requête
         $query = $this->connexion->prepare($sql);
         
         // On sécurise les données
         $this->code_stgr = htmlspecialchars(strip_tags($this->code_stgr));
         $this->nom_stgr = htmlspecialchars(strip_tags($this->nom_stgr));
         $this->prenom_stgr = htmlspecialchars(strip_tags($this->prenom_stgr));
         $this->date_naissance_stgr = htmlspecialchars(strip_tags($this->date_naissance_stgr));
         $this->tel_fixe_stgr = htmlspecialchars(strip_tags($this->tel_fixe_stgr));
         $this->tel_portable_stgr = htmlspecialchars(strip_tags($this->tel_portable_stgr));
         $this->email_stgr = htmlspecialchars(strip_tags($this->email_stgr));
         $this->code_formation_stgr = htmlspecialchars(strip_tags($this->code_formation_stgr));
         
         // On attache les variables
         $query->bindParam(":code", $this->code_stgr);
         $query->bindParam(":nom", $this->nom_stgr);
         $query->bindParam(":prenom", $this->prenom_stgr);
         $query->bindParam(":date", $this->date_naissance_stgr);
         $query->bindParam(":fixe", $this->tel_fixe_stgr);
         $query->bindParam(":portable", $this->tel_portable_stgr);
         $query->bindParam(":email", $this->email_stgr);
         $query->bindParam(":formation_stgr", $this->code_formation_stgr);
         
         // On exécute
         if($query->execute()){
             return true;
         }
         
         return false;
     }
 
     /**
      * Supprimer un stagiaire
      * @return void
      */
 
     public function delete()
     {
         // On écrit la requête
         $sql = "DELETE FROM " . $this->table . " WHERE code_stgr = ?";
 
         // On prépare la requête
         $query = $this->connexion->prepare( $sql );
 
         // On sécurise les données
         $this->code_stgr=htmlspecialchars(strip_tags($this->code_stgr));
 
         // On attache l'id
         $query->bindParam(1, $this->code_stgr);
 
         // On exécute la requête
         if($query->execute()){
             return true;
         }
         
         return false;
     }
}
