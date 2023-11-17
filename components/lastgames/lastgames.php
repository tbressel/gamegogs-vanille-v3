<?php
// en bon français :  obtenir les informations pour afficher les 6 derniers jeux enregistrés en base de donnée par tous les utilisateurs inscrit sur le site (donc chacun peut avoir en sa possession un exemplaire du même jeu)

$query = $connexion->prepare('SELECT game_title,game_subtitle,game_cover,machine_label_picture,games.id_game,
DATE(copie_addition_date) AS copie_addition_date,
TIME(copie_addition_date) AS copie_addition_time,
copie.id_copie,to_possess.id_user,users.user_nikename
FROM to_have
JOIN machines USING (id_machine)
JOIN games USING (id_game)
JOIN (
SELECT id_game, copie_addition_date,id_copie
FROM  copie
ORDER BY copie_addition_date DESC LIMIT 6
) AS copie ON games.id_game = copie.id_game
JOIN to_possess USING(id_copie)
JOIN users USING (id_user)');

$query->execute();
$gameList = $query->fetchAll();
?>

<section class="lastgames-items__container">
    <!-- header -->
    <div class="lastgames-items__maintitle">
        <h2>Explorer les ajouts récents</h2>
    </div>
    <div id="list-items" class="lastgames-items__last-items-container">


<?php foreach ($gameList as $game) { ?>

            <div id="<?=$game['id_copie']?>" class="lastgames-items__last-items item__Amstrad js-item">
                <div class="lastgames-items__coverimage">
                    <img id="js-maxclic" src="./assets/<?= $game['game_cover'] ?>" alt="artwork cover">
                </div>
                <div class="lastgames-items__title">
                    <h3><?=$game['game_title']?></h3>
                </div>
                <div class="lastgames-items__subtitle">
                    <h6>
                        ajouté le <?=$game['copie_addition_date']?><br> à <?=$game['copie_addition_time']?><br>
                        par <?=$game['user_nikename']?><br>
                    </h6>
                    <!-- <h4><?=$game['game_subtitle']?></h4> -->
                </div>
                <div class="lastgames-items__plateform">
                <img src="./assets/<?= $game['machine_label_picture'] ?>" alt="plateform label">

                </div>
            </div>

            <!-- Pas encore activé : à faire -->
            <div class="hidden__field">
                <div class="lastgames-maxitem__title">
                    <h3><?=$game['game_title']?></h3>
                </div>
                <div class="lastgames-maxitem__subtitle">
                    <h4><?=$game['game_subtitle']?></h4>
                </div>
                <div class="lastgames-maxitem__plateform">
                    <p>plateforme</p>
                </div>
                <div class="lastgames-maxitem__year">
                    <p>année</p>
                </div>
                <div class="lastgames-maxitem__coverimage">
                    <img src="./assets/<?= $game['game_cover'] ?>" alt="artwork cover">
                </div>
                <div class="lastgames-maxitem__editor">
                    <p>editeur</p>
                </div>
                <div class="lastgames-maxitem__genre">
                    <p>genre</p>
                </div>
                <div class="lastgames-maxitem__subcontainer">
                    <div class="lastgames-maxitem__country">
                        <p>Pays</p>
                    </div>
                    <div class="lastgames-maxitem__ref">
                        <p>reference</p>
                    </div>
                    <div class="lastgames-maxitem__support">
                        <p>support</p>
                    </div>
                </div>
                <div class="lastgames-maxitem__price">' . "111 articles à partir de 15€50" . '</p>
                </div>
                <div class="buttons__item ">
                    <span class="btn__item btn__item--color-empty">Ajouter au caddie</span>
                    <span class="btn__item btn__item--color-orange">Ajouter aux Favoris</span>
                </div>
            </div>
        <?php } ?>


    </div>
    <!-- footer -->
    <div class="lastgames-items__footer-list">
        <p>
            voir plus d'ajout récents >
        </p>
    </div>
</section>
