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
    include_once '../models/Stagiaire.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les formations
    $stagiaire = new Stagiaires($db);

    // On récupère les données
    $stmt = $stagiaire->read();

    // On vérifie si on a au moins 1 formation
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauStagiaire = [];
        $tableauStagiairess['Stagiaires'] = [];

        // On parcourt les formations
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $stagiaire = [
                "code_stgr" => $code_stgr,
                "nom_stgr" => $nom_stgr,
                "prenom_stgr" => $prenom_stgr,
                "date_naissance_stgr" => $date_naissance_stgr,
                "tel_fixe_stgr" => $tel_fixe_stgr,
                "tel_portable_stgr" => $tel_portable_stgr,
                "email_stgr" => $eamil_stgr,
                "code_formation_stgr" => $code_formation_stgr
            ];

            $tableauStagiaires['Stagiaires'][] = $stagiaire;
        }

        // On envoie le code réponse 200 OK
        http_response_code(200);

        // On encode en json et on envoie
        echo json_encode($tableauStagiaires);
    }

}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}