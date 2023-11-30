<?php
// Dans le contexte d'une requête POST avec un en-tête Content-Type: application/json, 
// les données ne sont pas automatiquement analysées et placées dans les superglobales PHP telles que $_POST. 
// Au lieu de cela, elles sont directement lues depuis le flux d'entrée brut.
include "./includes/_functions.php";
include "./includes/_notifications.php";

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

    // Check if action existe AND if action = login
    if (isset($inputData['action']) && $inputData['action'] === "login") {

        // If not exist : pseudo OR password OR userId OR pseudo
        if (
            !isset($inputData['pseudo'])
            || !isset($inputData['password'])
            || !isset($_SESSION['userId'])
            || !isset($_SESSION['pseudo'])
        ) {

            // Security against XSS failure.
            $user_nikename = htmlspecialchars($inputData['pseudo']);
            $user_password = htmlspecialchars($inputData['password']);

            // Request prepare against SQL Injection
            $queryUser = $connexion->prepare('SELECT id_user, user_nikename,user_password_hash 
            FROM users WHERE user_nikename = :user_nikename');
            $queryUser->bindValue(':user_nikename', $user_nikename, PDO::PARAM_STR);
            $isUserOK = $queryUser->execute();

            if ($isUserOK) {
                $userResult = $queryUser->fetch(PDO::FETCH_ASSOC);

                if ($userResult && password_verify($user_password, $userResult['user_password_hash'])) {

                    $_SESSION['pseudo'] = $user_nikename;
                    $_SESSION['userId'] = $userResult['id_user'];
                    getJsonResponse(true, 'login_success', $notificationMessages);
                    exit;
                } else {
                    getJsonResponse(false, 'login_failure', $notificationMessages);
                    exit;
                }
            } else {
                getJsonResponse(false, 'request_error', $notificationMessages);
                exit;
            }
        } else {
            getJsonResponse(false, 'login_missing', $notificationMessages);
            exit;
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

        getJsonResponse(true, 'logout_success', $notificationMessages);
        exit;
    }
    // ------------------------------------------------------------------------------
    // ----------------------------    SIGN IN   ------------------------------------
    // ------------------------------------------------------------------------------

    else if (isset($inputData['action']) && $inputData['action'] === 'signin') {

        $nickname = htmlspecialchars($inputData['nickname']);
        $birthdate = $inputData['birthdate'];
        $email = htmlspecialchars($inputData['email']);
        $password = htmlspecialchars($inputData['password']);

        // [a-z]
        // $regex = '/^[a-z]*$/';

        // // [a-z] [A-Z] !@#$%^&*()_+{}|:;<>.?~[]-
        // $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:;<>,.?~[\]-])/'; 

        // [a-z] [A-Z] [0-9] !@#$%^&*()_+{}|:;<>.?~[]-
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}|:;<>,.?~[\]-])/';


        if (!preg_match($regex, $password) || strlen($password) < 8) {
            getJsonResponse(false, 'password_bad_format', $notificationMessages);
            exit;
        }

        // [a-z] [A-Z] [0-9] !@#$%^&*()_+{}|:;<>.?~[]-
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($regex, $email)) {
            getJsonResponse(false, 'email_bad_format', $notificationMessages);
            exit;
        }


        $user_password = htmlspecialchars($inputData['password']);
        $user_password = password_hash($user_password, PASSWORD_BCRYPT);



        $queryCheck = $connexion->prepare('SELECT COUNT(*) FROM users WHERE user_nikename = :nickname OR user_email = :email');
        $queryCheck->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $queryCheck->bindValue(':email', $email, PDO::PARAM_STR);
        $queryCheck->execute();
        // get the sum of founded entires
        $userExists = $queryCheck->fetchColumn();

        if ($userExists) {
            getJsonResponse(true, 'exist_data', $notificationMessages);
            exit;
        }

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
        $id_user = $connexion->lastInsertId();

        $browser =  $_SERVER['HTTP_SEC_CH_UA'];
        $operating_system = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];

        $server_adress = $_SERVER['SERVER_ADDR'];
        $server_name = $_SERVER['SERVER_NAME'];

        $remote_adress = $_SERVER['REMOTE_ADDR'];
        $remote_port = $_SERVER['REMOTE_PORT'];



        $queryOs = $connexion->prepare('INSERT INTO configuration (browser, operating_system, server_adress, server_name, remote_adress, remote_port) VALUES (:browser, :operating_system, :server_adress, :server_name, :remote_adress, :remote_port);
        ');
        $queryOs->bindValue(':browser', $browser, PDO::PARAM_STR);
        $queryOs->bindValue(':operating_system', $operating_system, PDO::PARAM_STR);
        $queryOs->bindValue(':server_adress', $server_adress, PDO::PARAM_STR);
        $queryOs->bindValue(':server_name', $server_name, PDO::PARAM_STR);
        $queryOs->bindValue(':remote_adress', $remote_adress, PDO::PARAM_STR);
        $queryOs->bindValue(':remote_port', $remote_port, PDO::PARAM_STR);
        $isOsOK = $queryOs->execute();
        $id_configuration = $connexion->lastInsertId();

        $queryAsso = $connexion->prepare('INSERT INTO to_connect (id_user, id_configuration) VALUES (:id_user, :id_configuration);
        ');
        $queryAsso->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $queryAsso->bindValue(':id_configuration', $id_configuration, PDO::PARAM_INT);
        $isAssoOK = $queryAsso->execute();



        getJsonResponse(true, 'signin_success', $notificationMessages);
        exit;
    }
    // ------------------------------------------------------------------------------
    // ----------------------------    SIGN OUT   ------------------------------------
    // ------------------------------------------------------------------------------

    else if ((isset($inputData['action']) && $inputData['action'] === 'signout') && (isset($_SESSION['userId']))) {


        $id_user = htmlspecialchars(intval($_SESSION['userId']));
        // Suppression des références à l'utilisateur dans la table copie
        $queryDeleteCopieReferences = $connexion->prepare('DELETE FROM copie WHERE id_user = :id_user');
        $queryDeleteCopieReferences->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $queryDeleteCopieReferences->execute();

        // Suppression des références à l'utilisateur dans la table to_connect et configuration
        $queryDeleteToConnectReferences = $connexion->prepare('
    DELETE to_connect, configuration
    FROM to_connect
    LEFT JOIN configuration ON to_connect.id_configuration = configuration.id_configuration
    WHERE to_connect.id_user = :id_user
');
        $queryDeleteToConnectReferences->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $queryDeleteToConnectReferences->execute();

        // Suppression de l'utilisateur dans la table users
        $queryDeleteUser = $connexion->prepare('DELETE FROM users WHERE id_user = :id_user');
        $queryDeleteUser->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $queryDeleteUser->execute();

        // Nettoyer la session
        unset($_SESSION['pseudo']);
        unset($_SESSION['userId']);
        session_destroy();
        session_unset();
        session_write_close();

        getJsonResponse(true, 'signout_success', $notificationMessages);
        exit;
    }
    // ------------------------------------------------------------------------------
    // ----------------------------  EMAIL NEWSLETTER  ------------------------------------
    // ------------------------------------------------------------------------------

    if (isset($inputData['action']) && $inputData['action'] === 'newsletter') {

        $email = htmlspecialchars($inputData['email']);

        // [a-z] [A-Z] [0-9] !@#$%^&*()_+{}|:;<>.?~[]-
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($regex, $email)) {
            getJsonResponse(false, 'email_bad_format', $notificationMessages);
            exit;
        }

        $queryCheck = $connexion->prepare('SELECT COUNT(*) FROM emails WHERE email = :email');
        $queryCheck->bindValue(':email', $email, PDO::PARAM_STR);
        $queryCheck->execute();
        // get the sum of founded entires
        $emailExists = $queryCheck->fetchColumn();

        if ($emailExists) {
            getJsonResponse(true, 'exist_data', $notificationMessages);
            exit;
        }

        $email_date = new DateTime();
        $email_date_string = $email_date->format('Y-m-d H:i:s');


        $browser =  $_SERVER['HTTP_SEC_CH_UA'];
        $mobile_browser = $_SERVER['HTTP_SEC_CH_UA_MOBILE'];
        $operating_system = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];

        $server_adress = $_SERVER['SERVER_ADDR'];
        $server_name = $_SERVER['SERVER_NAME'];

        $remote_adress = $_SERVER['REMOTE_ADDR'];
        $remote_port = $_SERVER['REMOTE_PORT'];



        $queryMail = $connexion->prepare('INSERT INTO emails (email, email_date, browser, mobile_browser, operating_system, server_adress, server_name, remote_adress, remote_port) VALUES (:email, :email_date, :browser, :mobile_browser, :operating_system, :server_adress, :server_name, :remote_adress, :remote_port);
        ');

        $queryMail->bindValue(':email', $email, PDO::PARAM_STR);
        $queryMail->bindValue(':email_date', $email_date_string, PDO::PARAM_STR);
        $queryMail->bindValue(':browser', $browser, PDO::PARAM_STR);
        $queryMail->bindValue(':mobile_browser', $mobile_browser, PDO::PARAM_STR);
        $queryMail->bindValue(':operating_system', $operating_system, PDO::PARAM_STR);
        $queryMail->bindValue(':server_adress', $server_adress, PDO::PARAM_STR);
        $queryMail->bindValue(':server_name', $server_name, PDO::PARAM_STR);
        $queryMail->bindValue(':remote_adress', $remote_adress, PDO::PARAM_STR);
        $queryMail->bindValue(':remote_port', $remote_port, PDO::PARAM_STR);
        $isMailOK = $queryMail->execute();

        getJsonResponse(true, 'email_success', $notificationMessages);
        exit;
    }


    // ------------------------------------------------------------------------------
    // ---------------     DISPLAY LAST ADDED COMMUNITY GAMES      -------------------
    // ------------------------------------------------------------------------------
    if (isset($inputData['action']) && $inputData['action'] === 'display-last-games') {
        $query = $connexion->prepare('SELECT DISTINCT
        games.id_game,
        game_title,
        game_subtitle,
        game_cover,
        machine_label_picture,
        copie.id_copie,
        DATE(copie_addition_date) AS copie_addition_date,
        TIME(copie_addition_date) AS copie_addition_time,
        users.id_user,
        users.user_nikename,
        machine_releasedate,
        manufacturer_name,
        machine_name,
        machine_model,
        machine_type
    FROM
        to_have
    JOIN
        machines USING (id_machine)
    JOIN
        manufacturers USING (id_manufacturer)
    JOIN
        games USING (id_game)
    JOIN
        copie ON games.id_game = copie.id_game
    JOIN
        users USING (id_user)
    ORDER BY
        copie_addition_date DESC
    LIMIT
        6;
    
    ');
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
            ob_clean();
            echo json_encode([
                'result' => false,
                'message' => 'Veuillez vous connecter au site pour gérer votre collection',
                'logscreen'   => true
            ]);
            exit;
        }

        $id_user = intval(htmlspecialchars($_SESSION['userId']));


        // Query to get all informations games
        $query = $connexion->prepare('SELECT
        id_game,
        id_copie,
        id_user,
        id_state,
        DATE(copie_addition_date) AS copie_addition_date,
        TIME(copie_addition_date) AS copie_addition_time,
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
        copie_state_rank,
        copie_state_name,
        copie_state_description,
        ROUND(copie_price, 2) AS copie_price,
        game_cover,
        machine_label_picture,
        (
            SELECT JSON_ARRAY(
                ROUND(gs.game_avg_price,2),
                ROUND(gs.game_min_price,2),
                ROUND(gs.game_max_price,2),
                gs.total_copies
            ) 
            FROM game_statistics gs 
            WHERE gs.id_game = games.id_game
        ) AS statistic
    FROM
        to_have
    JOIN machines USING (id_machine)
    JOIN categories USING (id_categorie)
    JOIN games USING (id_game)
    JOIN dates USING (id_dates)
    JOIN editors USING (id_editor)
    JOIN countries USING (id_country)
    JOIN manufacturers USING (id_manufacturer)
    JOIN copie USING (id_game)
    JOIN state USING (id_state)
    JOIN medias USING (id_medias)
    JOIN users USING (id_user)
    WHERE
        users.id_user = :id_user
    GROUP BY
        id_game, id_copie, id_state, game_reference, game_title, game_subtitle, date_year, editor_name, country_name,
        manufacturer_name, machine_name, machine_model, media_type, game_cover, machine_label_picture
    ORDER BY
        id_copie;
    
    ');
        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $myCollectionList = $query->fetchAll();



    // Query to get statistic information about category 
    $query = $connexion->prepare('SELECT
    m.machine_name AS filter_name,
    COUNT(DISTINCT g.id_game) AS total_games,
    COUNT(DISTINCT CASE WHEN co.id_user = :id_user THEN g.id_game END) AS games_owned_user
FROM
    machines m
LEFT JOIN
    to_have t USING (id_machine)
LEFT JOIN
    games g USING (id_game)
LEFT JOIN
    copie co ON g.id_game = co.id_game AND co.id_user = :id_user
GROUP BY
    m.machine_name;
');

        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $categoryStat = $query->fetchAll();



// Query to get statistic information about media 
        $query = $connexion->prepare('SELECT
        m.media_type AS filter_name,
        COUNT(DISTINCT g.id_game) AS total_games,
        COUNT(DISTINCT CASE WHEN co.id_user = :id_user THEN g.id_game END) AS games_owned_user
    FROM
        medias m
    LEFT JOIN
        copie co USING (id_medias)
    LEFT JOIN
        games g USING (id_game)
    GROUP BY
        m.media_type;');

        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        $mediaStat = $query->fetchAll();


        // Query to get statistice information about machine type
         $query = $connexion->prepare('SELECT 
            m.machine_name AS filter_name,
            COUNT(DISTINCT g.id_game) AS total_games,
            COUNT(DISTINCT CASE WHEN co.id_user = :id_user THEN g.id_game END) AS games_owned_user
         FROM
             machines m
         LEFT JOIN
             to_have t USING (id_machine)
         LEFT JOIN
             games g USING (id_game)
         LEFT JOIN
             copie co ON g.id_game = co.id_game AND co.id_user = :id_user
         GROUP BY
             m.machine_name;
         
         ');
         $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
         $query->execute();
         $machineStat = $query->fetchAll();



        ob_clean();
        echo json_encode([
            'result' => true,
            'message' => 'Liste et informations des jeux de ma collection ont été récupérée avec succès',
            'games' => $myCollectionList,
            'categoryStat' => $categoryStat,
            'mediaStat' => $mediaStat,
            'machineStat' => $machineStat,
            // 'manufacturerStat' => $manufacturerStat,
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

            $query = $connexion->prepare('DELETE FROM copie 
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
    } else if ($_REQUEST['action'] === "title") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT game_title FROM `games` WHERE game_title LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $title = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'title' => $title
        ]);
        exit;
    } else if ($_REQUEST['action'] === "subtitle") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT game_subtitle FROM `games` WHERE game_subtitle LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $subtitle = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'subtitle' => $subtitle
        ]);
        exit;
    } else if ($_REQUEST['action'] === "genre") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT * FROM categories WHERE category_name LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $categories = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'genre' => $categories
        ]);
        exit;
    } else if ($_REQUEST['action'] === "manufacturer") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT * FROM manufacturers WHERE manufacturer_name LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $manufacturer = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'manufacturer' => $manufacturer
        ]);
        exit;
    } else if ($_REQUEST['action'] === "machine") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT * FROM machines WHERE machine_name LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $machine = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'machine' => $machine
        ]);
        exit;
    } else if ($_REQUEST['action'] === "model") {
        // Récupérez la valeur du paramètre de requête 'query'
        $userInput = $_REQUEST['input'];
    
        // Effectuez la requête SQL pour récupérer les catégories en fonction de la saisie de l'utilisateur
        $queryAuto = $connexion->prepare('SELECT * FROM machines WHERE machine_model LIKE :input');
        $queryAuto->bindValue(':input', $userInput . '%', PDO::PARAM_STR);
        $queryAuto->execute();
        $model = $queryAuto->fetchAll(PDO::FETCH_ASSOC);
    
        ob_clean();
        echo json_encode([
            'result' => true, 
            'model' => $model
        ]);
        exit;
    }

} else {
    $_SESSION['error'] = 'Aucune action ne peut être effectuée';
}

exit;