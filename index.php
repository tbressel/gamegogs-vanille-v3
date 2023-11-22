<?php

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
    <main id="main" class="main__container" >
        <?php
        include('./pages/home/home.php');
        ?>
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