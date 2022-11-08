<?php

class Formations
{
    // Pour la connexion
    private $connexion;
    private $table = "formation";


    // les propriétes de l'objet
    public $code_formation;
    public $nom_formation;
    public $date_debut;
    public $date_fin;
    public $code_filiere_formation;

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
        $sql = "SELECT code_formation, nom_formation, date_debut, date_fin, code_filiere_formation FROM " .$this->table;
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
        $sql = "INSERT INTO ".$this->table." SET code_formation=:code, nom_formation=:nom, date_debut=:debut, date_fin=:fin, code_filiere_formation=:filiere";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections SQL
        $this->code_formation = htmlspecialchars(strip_tags($this->code_formation));
        $this->nom_formation = htmlspecialchars(strip_tags($this->nom_formation));
        $this->date_debut = htmlspecialchars(strip_tags($this->date_debut));
        $this->date_fin = htmlspecialchars(strip_tags($this->date_fin));
        $this->code_filiere_formation = htmlspecialchars(strip_tags($this->code_filiere_formation));

        // Ajout des données protégées
        $query->bindParam(":code", $this->code_formation);
        $query->bindParam(":nom", $this->nom_formation);
        $query->bindParam(":debut", $this->date_debut);
        $query->bindParam(":fin", $this->date_fin);
        $query->bindParam(":filiere", $this->code_filiere_formation);

        // Execution de la requête
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Lire une formation
     *
     * @return void
     */
    public function readOne(){
        // On écrit la requête
        $sql = "SELECT code_formation, nom_formation, date_debut, date_fin, code_filiere_formation FROM " .$this->table." WHERE code_formation = ? ";
        //$sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache le code
        $query->bindParam(1, $this->code_formation);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->code_formation = $row['code_formation'];
        $this->nom_formation = $row['nom_formation'];
        $this->date_debut = $row['date_debut'];
        $this->date_fin = $row['date_fin'];
        $this->code_filiere_formation= $row['code_filiere_formation'];
    }

       /**
     * Modifier une formation
     *
     * @return void
     */
    public function update()
    {
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET nom_formation = :nom, date_debut = :debut, date_fin = :fin, code_filiere_formation = :code_filiere WHERE code_formation = :code";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->code_formation=htmlspecialchars(strip_tags($this->code_formation));
        $this->nom_formation=htmlspecialchars(strip_tags($this->nom_formation));
        $this->date_debut=htmlspecialchars(strip_tags($this->date_debut));
        $this->date_fin=htmlspecialchars(strip_tags($this->date_fin));
        $this->code_filiere_formation=htmlspecialchars(strip_tags($this->code_filiere_formation));
        
        // On attache les variables
        $query->bindParam(':nom', $this->nom_formation);
        $query->bindParam(':debut', $this->date_debut);
        $query->bindParam(':fin', $this->date_fin);
        $query->bindParam(':code_filiere', $this->code_filiere_formation);
        $query->bindParam(':code', $this->code_formation);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }

    /**
     * Supprimer une formation
     * @return void
     */

    public function delete()
    {
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE code_formation = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->code_formation=htmlspecialchars(strip_tags($this->code_formation));

        // On attache l'id
        $query->bindParam(1, $this->code_formation);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}
