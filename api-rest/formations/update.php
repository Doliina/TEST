<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Formations.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $formation = new Formations($db);

    // On récupère les données
    // la méthode php "file_get_contents" lit tout le fichier dans une chaine de caractères
    // puis vérifie si les données ne sont pas vides.
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->code_formation) && !empty($donnees->nom_formation) && !empty($donnees->debut) && !empty($donnees->fin) && !empty($donnees->code_filiere)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $formation->code_formation = $donnees->code_formation;
        $formation->nom_formation = $donnees->nom_formation;
        $formation->date_debut = $donnees->debut;
        $formation->date_fin = $donnees->fin;
        $formation->code_filiere_formation = $donnees->code_filiere;

        if($formation->update()){
            // Ici la modification a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La modification a été effectuée"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "La modification n'a pas été effectuée"]);         
        }
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}