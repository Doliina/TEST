<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Stagiaires.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les formations
    $stagiaire = new Stagiaires($db);

    // On récupère les données
    // la méthode php "file_get_contents" lit tout le fichier dans une chaine de caractères
    // puis vérifie si les données ne sont pas vides.
    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->code_stgr)){
        $stagiaire->code_stgr = $donnees->code_stgr;

        if($stagiaire->delete()){
            // Ici la suppression a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La suppression a été effectuée"]);
        }else{
            // Ici la suppression n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "La suppression n'a pas été effectuée"]);         
        }
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}