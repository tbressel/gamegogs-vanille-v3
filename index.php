<?php
// Récupérer le chemin à partir du paramètre GET "url"
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Vous pouvez maintenant traiter l'URL comme vous le souhaitez, par exemple, charger la page correspondante
    // Vous devrez peut-être faire correspondre l'URL à un contrôleur ou à une action spécifique dans votre application
    // Par exemple, vous pourriez utiliser une table de routage pour cela.
} else {
    // Aucun paramètre "url" n'a été fourni, vous pouvez traiter la page d'accueil ici
}


include_once 'includes/_config.php';
require_once 'includes/_functions.php';

getIdentification("./.env");

include 'includes/_dbconnect.php';


session_start();
generateToken();

//  session_destroy();
//   $_SESSION['id_user'] = 1;


include_once 'includes/_head.php';
?>    

<body data-token=<?=$_SESSION['token']?>>
    
<header class="black-bg">
    <?php
        include('./components/header/header.php'); 
        include ('./components/filter/filter-nav.php');
    ?>
    </header>
    
    
    <nav class="submenu__container">
        <?php 
        include('./components/header/nagivation/navigation.php');

        ?>
    </nav>

    <section id="logState">
  <?php
  if (isset($_SESSION['pseudo'])) {
    echo "<p class='connected'>connecté en tant que " .  $_SESSION['pseudo'] . "</p>";
  } else {
    echo "<p class='not-connected'>Vous n'êtes pas connecté</p>";
  }
  ?>
</section>
    <main id="main" class="main__container" >
        <?php  include('./pages/home/home.php');?>
    </main>
       <?php
        var_dump($_SESSION);
        ?> 

    <?php




?>
    <footer class="black-bg">
        <div class="footer__container">
            <?php
            include('./components/footer/social-networks/social-networks.php');
            include('./components/footer/about/about.php'); 
            include('./components/footer/logo/logo.php'); 
            include('./components/footer/rgpd/rgpd.php');
            ?>
        </div>
    </footer>


    <script src="./assets/scripts/functions.js"></script>
    <script src="./assets/scripts/script.js"></script>
    <script src="./assets/scripts/api.js"></script>
    <script src="./assets/scripts/formulaire.js"></script>
    <script src="./assets/scripts/display.js"></script>

</body>

</html>