<?php

// Headers requis
header("Access-Control-Allow-Origin: *"); // Autoriser l'accès à l'API pout toutes les sources. Votre API est publique
header("Content-Type: application/json; charset=UTF-8"); // Définition du contenu. Ici en JSON
header("Access-Control-Allow-Methods: GET"); // La méthode accepter pour la requête lire les données
header("Access-Control-Max-Age: 3600"); // Durée de vie de la requête en ms
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // les headers autorisés vis à vis du poste client


// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
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

        // On récupère la formation
        $stagiaire->readOne();

        // On vérifie sila formation existe
        if($stagiaire->nom_stgr != null){

            $stagiaire = [
                "code_stgr" => $stagiaire->code_stgr,
                "nom_stgr" => $stagiaire->nom_stgr,
                "prenom_stgr" => $stagiaire->prenom_stgr,
                "date_naissance_stgr" => $stagiaire->date_naissance_stgr,
                "tel_fixe_stgr" => $stagiaire->tel_fixe_stgr,
                "tel_portable_stgr" => $stagiaire->tel_portable_stgr,
                "email_stgr" => $stagiaire->eamil_stgr,
                "code_formation_stgr" => $stagiaire->code_formation_stgr
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($stagiaire);
        }else{
            // 404 Not found
            http_response_code(404);
         
            echo json_encode(array("message" => "Le stagiaire n'existe pas."));
        }
        
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}