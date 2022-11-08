<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Stagiaires.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les stagiaires
    $stagiaire = new Stagiaires($db);

    // On récupère les données
    // la méthode php "file_get_contents" lit tout le fichier dans une chaine de caractères
    // puis vérifie si les données ne sont pas vides.
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->code_stgr) && !empty($donnees->nom_stgr) && !empty($donnees->prenom_stgr) && !empty($donnees->date_naissance_stgr) && !empty($donnees->email_stgr) && !empty($donnees->code_formation_stgr)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $stagiaire->code_stgr = $donnees->code_stgr;
        $stagiaire->nom_stgr = $donnees->nom_stgr;
        $stagiaire->prenom_stgr = $donnees->prenom_stgr;
        $stagiaire->date_naissance_stgr = $donnees->date_naissance_stgr;
        $stagiaire->email_stgr = $donnees->email_stgr;
        $stagiaire->code_formation_stgr = $donnees->code_formation_stgr;

        if($stagiaire->create()){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}