<?php if (isset($_SESSION['pseudo']) && (isset($_SESSION['userId']))) {
            echo '<p class="user__container--green">Bienvenue sur Gamegogs ' . $_SESSION['pseudo'] . ' !</p>';           
            } else {
                echo '<p class="user__container--red">Bienvenue sur Gamegogs cher visiteur !</p>';
            }?>
        