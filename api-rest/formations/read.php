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
    include_once '../models/Formations.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les formations
    $formation = new Formations($db);

    // On récupère les données
    $stmt = $formation->read();

    // On vérifie si on a au moins 1 formation
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauFormations = [];
        $tableauFormationss['formations'] = [];

        // On parcourt les formations
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $formation = [
                "code_formation" => $code_formation,
                "nom_formation" => $nom_formation,
                "date_debut" => $date_debut,
                "date_fin" => $date_fin,
                "code_filiere" => $code_filiere_formation
            ];

            $tableauFormations['formations'][] = $formation;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauFormations);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}