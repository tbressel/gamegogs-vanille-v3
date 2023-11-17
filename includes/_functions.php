<?php
// ----------------------------------------------------------------------------------
// ----------------------  PAGE CONTENT CONFIGURATION FUNCTIONS ---------------------
// ----------------------------------------------------------------------------------

/**
 * Return the current page name including its path
 *
 * @return string
 */
function getCurrentPageName(): string
{
    return  basename($_SERVER['SCRIPT_NAME']);
}


/**
 * Get array from data for current page data
 *
 * @param array $pages
 * @return array
 */
function getCurrentPageData(array $pages): ?array
{
    // foreach($pages as $page){
    //     if($page['file'] === getCurrentPageName()){
    //        return $page;
    //     }
    // }
    // return NULL;

    return current(array_filter($pages, fn ($p) => $p['file'] === getCurrentPageName()));
}

/**
 * Generate style sheet links
 *
 * @param array $styleSheetFiles
 * @return string
 */
function generateStyleSheetLinks(array $styleSheetFiles): string
{
    return implode('', array_map(fn ($cssFile) => "<link rel=\"stylesheet\" href=\"{$cssFile}\">", $styleSheetFiles));
}


function getLanguageType(array $pages): string 
{
    return $lang = implode("", array_column($pages,'language'));

};



// ----------------------------------------------------------------------------------
// ----------------------------  SECURITY FUNCTIONS ---------------------------------
// ----------------------------------------------------------------------------------
/**
 * getnerate a new token and an expiration date 
 *
 * @return void
 */
function generateToken():void {
    // Si le jeton n'est pas défini OU que l'heure actuelle est supérieure à l'heure d'expiration du jeton
    // alors on régénère un jeton ET une nouvelle heure d'expiration
    if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpire']) {
        $_SESSION['token'] = bin2hex(random_bytes(32)); // Génère un jeton de 64 caractères (32 octets)
        $_SESSION['tokenExpire'] = time() + 15 * 60;
    }
}



/**
 * Check for CSRF with referer and token
 * Redirect to the given page in case of error
 *
 * @param string $url The page to redirect
 * @return void
 */
function checkCSRFAsync(): void
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/')) {
        $error = 'error_referer';
    } else if (
        !isset($_SESSION['token']) || !isset($_REQUEST['token'])
        || $_REQUEST['token'] !== $_SESSION['token']
        || $_SESSION['tokenExpire'] < time()
    ) {
        $error = 'error_referer';
    }
    if (!isset($error)) return;
    
    echo json_encode([
        'result' => false,
        'message' => $error
    ]);
    
    exit;
}


/**
 * get values from the file .env to write them into $_ENV
 *
 * @param string $path
 * @return void
 */
function getIdentification(string $path): void {
    $fichier_env = file($path);
    if ($fichier_env) {
        foreach ($fichier_env as $line) {
            $result = preg_match('/\"(.*?)\"/', $line, $matches);
            if ($result) {
                $parts = explode("=", $line);
                $value = $matches[1];
                $key = trim($parts[0]);
                $_ENV[$key] = $value;
            }
        }       
    } else {
        echo "Erreur lors de la lecture du fichier .env";
    }
}


// ----------------------------------------------------------------------------------
// ----------------------------  DATABASE FUNCTIONS ---------------------------------
// ----------------------------------------------------------------------------------


