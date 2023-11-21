<?php
// Dans le contexte d'une requête POST avec un en-tête Content-Type: application/json, 
// les données ne sont pas automatiquement analysées et placées dans les superglobales PHP telles que $_POST. 
// Au lieu de cela, elles sont directement lues depuis le flux d'entrée brut.
include "./includes/_functions.php";

getIdentification(".env");

include "./includes/_dbconnect.php";

session_start();

header('Content-Type: application/json');

// fonction utilisée pour lire le contenu du flux d'entrée. 
// 'php://input' est une pseudo-url qui permet d'accéder aux données brutes de la requête POST.
$inputJSON = file_get_contents('php://input');

// pour les convertir en un tableau PHP
$inputData = json_decode($inputJSON, true);

if (isset($_GET['action']) || isset($_POST['action']) || (isset($inputData['action']))) {
    /*
     * Afficher les derniers jeux ajoutés dans la base de données triés par date.
     */
    if (isset($inputData['action']) && $inputData['action'] === 'display-last-games') {
        $query = $connexion->prepare('SELECT game_title,
            game_subtitle,
            game_cover,
            machine_label_picture,
            games.id_game,
            DATE(copie_addition_date) AS copie_addition_date,
            TIME(copie_addition_date) AS copie_addition_time,
            copie.id_copie,
            to_possess.id_user,
            users.user_nikename
            FROM to_have
            JOIN machines USING (id_machine)
            JOIN games USING (id_game)
            JOIN (
                SELECT id_game, copie_addition_date, id_copie
                FROM copie
                ORDER BY copie_addition_date DESC LIMIT 6
            ) AS copie ON games.id_game = copie.id_game
            JOIN to_possess USING (id_copie)
            JOIN users USING (id_user)');
        $query->execute();
        $gameList = $query->fetchAll();


        // pour s'assurer qu'il n'y a pas de sortie non souhaitée ou d'espaces blancs avant d'envoyer la réponse JSON.
        // Elle permet de garantir que la réponse est propre et ne contient que le JSON que vous souhaitez envoyer.
        ob_clean();

        echo json_encode([
            'result' => true,
            'message' => 'Liste des dernier jeu a été récupérée avec succès',
            'games' => $gameList
        ]);
    }
} else {
    $_SESSION['error'] = 'Aucune action ne peut être effectuée';
}

exit;




    // // ------------------------------------------------------------------------------
    // // --------------------------     DELETE A COPIE       --------------------------
    // // ------------------------------------------------------------------------------
    // if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        
    //     if (isset($_GET['id'])) {
    //         $id_copie = htmlspecialchars($_GET['id']);
            
    //         if (empty($id_copie)) {
    //             echo json_encode([
    //                 'result' => false,
    //                 'message' => 'Copie inconnue'
    //             ]);
    //             exit;
    //         }
            
    //         $connexion->beginTransaction();
            
    //         $query = $connexion->prepare('DELETE FROM to_possess 
    //                                         WHERE id_copie = :id_copie 
    //                                         AND id_user= 1');
    //         $query->bindValue(':id_copie', $id_copie, PDO::PARAM_INT);
    //         $isQueryOK = $query->execute();
            
    //         $query = $connexion->prepare('DELETE FROM copie 
    //                                         WHERE id_copie = :id_copie');
    //         $query->bindValue(':id_copie', $id_copie, PDO::PARAM_INT);
    //         $isQueryOK = $query->execute();
            
    //         // showMessages("delete");

    //         $resultat = $connexion->commit();

    //         echo json_encode([
    //             'result' => true,
    //             'message' => 'La copie n°' . $id_copie . ' du jeu a été effacée'
    //         ]);
    //     }
    //     exit;
    // }
