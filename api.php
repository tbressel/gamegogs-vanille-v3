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
    
// ------------------------------------------------------------------------------
// ---------------     SHOW OR DISPLAY LOGIN FORM & LOGIN     -------------------
// ------------------------------------------------------------------------------
if (isset($inputData['action']) && $inputData['action'] === "login") {

    if (
        !isset($inputData['pseudo'])
        || !isset($inputData['password'])
        || !isset($_SESSION['userId'])
        || !isset($_SESSION['pseudo'])
    ) {

        $user_nikename = htmlspecialchars($inputData['pseudo']);
        $user_password = htmlspecialchars($inputData['password']);

        $queryUser = $connexion->prepare('SELECT 
            id_user, 
            user_nikename,
            user_password_hash 
            FROM users 
            WHERE user_nikename = :user_nikename');

        $queryUser->bindValue(':user_nikename', $user_nikename, PDO::PARAM_STR);
        $isUserOK = $queryUser->execute();

        if ($isUserOK) {
            // get query result
            $userResult = $queryUser->fetch(PDO::FETCH_ASSOC);
            ob_clean();

            // is user exists ?
            if ($userResult && password_verify($user_password, $userResult['user_password_hash'])) {
                // YES the user exists
                $_SESSION['pseudo'] = $user_nikename;
                $_SESSION['userId'] = $userResult['id_user'];

                echo json_encode([
                    'result' => true,
                    'message' => 'Connecté avec succès',
                ]);
            } else {
                // NO the user doesn't
                echo json_encode([
                    'result' => false,
                    'message' => 'Pseudo ou mot de passe invalide',
                ]);
            }
        } else {
            echo json_encode([
                'result' => false,
                'message' => 'request error',
            ]);
        }
    } else {
        echo json_encode([
            'result' => false,
            'message' => 'Pseudo ou mot de passe obligatoires !',
        ]);
    }
}

// ------------------------------------------------------------------------------
// --------------------------     LOGOUT      -----------------------------------
// ------------------------------------------------------------------------------

else if (isset($inputData['action']) && $inputData['action'] === "logout") {

    unset($_SESSION['pseudo']);
    unset($_SESSION['userId']);
    session_destroy();
    session_unset();
    session_write_close();


    echo json_encode([
        'result' => true,
        'message' => 'déconnecté avec succès',                      
    ]);
    
 
    exit;
}
 // ------------------------------------------------------------------------------
 // ----------------------------    SIGN IN   ------------------------------------
 // ------------------------------------------------------------------------------


else if (isset($inputData['action']) && $inputData['action'] === 'signin') {

    $nickname = htmlspecialchars($inputData['nickname']);
    $birthdate = $inputData['birthdate'];
    $email= $inputData['email'];
    
    $user_password = htmlspecialchars($inputData['password']);
    // $user_password = hash('sha256', $user_password);
    $user_password = password_hash($user_password, PASSWORD_BCRYPT);

    $signin_date = new DateTime();
    $signin_date_string = $signin_date->format('Y-m-d H:i:s');

    $queryUser = $connexion->prepare('INSERT INTO users 
    (user_nikename, user_birthdate, user_email, user_signin_date, user_password_hash) VALUES
    (:nickname, :birthdate, :email, :signin_date, :user_password)');

    $queryUser->bindValue(':nickname', $nickname, PDO::PARAM_STR);
     $queryUser->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
     $queryUser->bindValue(':email', $email, PDO::PARAM_STR);
     $queryUser->bindValue(':signin_date', $signin_date_string, PDO::PARAM_STR);
     $queryUser->bindValue(':user_password', $user_password, PDO::PARAM_STR);
     
     $isUserOK = $queryUser->execute();
    

    echo json_encode([
        'result' => true,
        'message' => 'inscription réalisée avec succès',        
        // 'nickname' => $nickname,
        // 'email' => $email,
         'password' => $user_password,
    ]);
    
}

    
     // ------------------------------------------------------------------------------
     // ---------------     DISPLAY LAST ADDED COMMUNITY GAMES      -------------------
     // ------------------------------------------------------------------------------
    if (isset($inputData['action']) && $inputData['action'] === 'display-last-games') {
        $query = $connexion->prepare('SELECT DISTINCT game_title,
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
            JOIN machines USING (id_machine )
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
     // ------------------------------------------------------------------------------
     // ---------------     DISPLAY PERSONAL COLLECTION GAMES      -------------------
     // ------------------------------------------------------------------------------
     else if (isset($inputData['action']) && $inputData['action'] === 'display-my-games') {

        if (!isset($_SESSION['userId']) || !isset($_SESSION['pseudo'])) {
            echo json_encode([
                'result' => false,
                'message' => 'Veuillez vous connecter au site pour gérer votre collection',
                'logscreen'   => true
            ]);
            exit;
        }

        $id_user = intval(htmlspecialchars($_SESSION['userId']));

        $query = $connexion->prepare('SELECT
            id_game,
            id_copie,
            id_user,
            game_reference,
            game_title,
            game_subtitle,
            GROUP_CONCAT(category_name) AS categories,
            date_year,
            editor_name,
            country_name,
            manufacturer_name,
            machine_name,
            machine_model,
            media_type,
            ROUND(game_price, 2) AS game_price,
            game_cover,
            machine_label_picture
            FROM to_have
            JOIN machines USING (id_machine)
            JOIN categories USING (id_categorie)
            JOIN games USING (id_game)
            JOIN dates USING (id_dates)
            JOIN editors USING (id_editor)
            JOIN countries USING (id_country)
            JOIN manufacturers USING (id_manufacturer)
            JOIN copie USING (id_game)
            JOIN medias USING (id_medias)
            JOIN to_possess USING (id_copie)
            JOIN users USING (id_user)
            WHERE users.id_user = :id_user
            GROUP BY id_game, id_copie,game_reference, game_title, game_subtitle, date_year, editor_name, country_name,
                manufacturer_name, machine_name, machine_model, media_type, game_cover, machine_label_picture
            ORDER BY id_copie;
    
    ');
        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $myCollectionList = $query->fetchAll();

        $queryManufacturer = $connexion->prepare('SELECT manufacturer_name FROM manufacturers ORDER BY manufacturer_name');
        $queryManufacturer->execute();
        $manufacturersList = $queryManufacturer->fetchAll();

        $queryMachine = $connexion->prepare('SELECT machine_name FROM machines ORDER BY machine_name');
        $queryMachine->execute();
        $machinesList = $queryMachine->fetchAll();

        $queryModel = $connexion->prepare('SELECT machine_model FROM machines ORDER BY machine_model');
        $queryModel->execute();
        $modelsList = $queryModel->fetchAll();

        $queryDate = $connexion->prepare('SELECT date_year FROM dates ORDER BY date_year DESC');
        $queryDate->execute();
        $datesList = $queryDate->fetchAll();

        ob_clean();
        echo json_encode([
            'result' => true,
            'message' => 'Liste et informations des jeux de ma collection ont été récupérée avec succès',
            'games' => $myCollectionList
            // 'manufacturers' => $manufacturersList,
            // 'machines' => $machinesList,
            // 'models' => $modelsList,
            // 'dates' => $datesList
        ]);

     } 
     // ------------------------------------------------------------------------------
     // --------------------------     DELETE A COPIE       --------------------------
     // ------------------------------------------------------------------------------
     else if (isset($_GET['action']) && $_GET['action'] === 'delete') {
     
         if (isset($_GET['id'])) {
             $id_copie = htmlspecialchars($_GET['id']);
             $id_user = intval(htmlspecialchars($_SESSION['userId']));
         
             if (empty($id_copie) || !isset($_SESSION['userId'])) {
                 echo json_encode([
                     'result' => false,
                     'message' => 'Copie inconnue'
                 ]);
                 exit;
             }


         
             $connexion->beginTransaction();
         
             $query = $connexion->prepare('DELETE FROM to_possess 
                                             WHERE id_copie = :id_copie 
                                             AND id_user= :id_user');
             $query->bindValue(':id_copie', $id_copie, PDO::PARAM_INT);
             $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
             $isQueryOK = $query->execute();
         
             $query = $connexion->prepare('DELETE FROM copie 
                                             WHERE id_copie = :id_copie');
             $query->bindValue(':id_copie', $id_copie, PDO::PARAM_INT);
             $isQueryOK = $query->execute();
         
             // showMessages("delete");
             $resultat = $connexion->commit();
             echo json_encode([
                 'result' => true,
                 'message' => 'La copie n°' . $id_copie . ' du jeu a été effacée'
             ]);
         }
         exit;
     }
} else {
    $_SESSION['error'] = 'Aucune action ne peut être effectuée';
}

exit;




     
