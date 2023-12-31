<?php
include_once 'includes/_config.php';
require_once 'includes/_functions.php';

getIdentification("./.env");

include 'includes/_dbconnect.php';

session_start();
generateToken();

include_once 'includes/_head.php';
?>

<body data-token=<?= $_SESSION['token'] ?>>

    <header class="header">
        <?php include('./components/header/header.php');  ?>

        <?php include('./components/header/filter/filter-nav.php'); ?>

        <nav class="submenu__container">
            <?php include('./components/header/nagivation/navigation.php'); ?>
        </nav>
    </header>

    <section id="notifications">
        <?php include('./components/notification/notification.php'); ?>
    </section>

    <section id="user-infos" class="user__container">
    <?php include ('./components/userinfos/userinfos.php');?>
    </section>
    
    <main id="main" class="main__container">
        <?php include('./pages/home/home.php'); ?>
    </main>

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

    <script src="./assets/scripts/debug.js"></script>
    <script src="./assets/scripts/functions.js"></script>
    <script src="./assets/scripts/api.js"></script>
    <script src="./assets/scripts/index.js"></script>
    <script src="./assets/scripts/navigation.js"></script>
    <script src="./assets/scripts/formulaire.js"></script>
    <script src="./assets/scripts/display.js"></script>
    <script src="./assets/scripts/notifications.js"></script>
    <script src="./assets/scripts/password.js"></script>
    <script src="./assets/scripts/addgame.js"></script>

</body>

</html>