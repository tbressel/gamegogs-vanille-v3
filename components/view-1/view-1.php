<?php


require_once '../../includes/_functions.php';
getIdentification("../../.env");
include '../../includes/_dbconnect.php';
session_start();

// var_dump($_SESSION);

// en bon français :  obtenir la totalitées des informations de touts les jeux possédés pas un utilisateur spécifique (ici le id_user 1 qui possède 4 jeux) le CONCAT permet d'obtenir un tableau contenant plusieurs category pour un même exemplaire d'un jeu.

$query = $connexion->prepare('SELECT
    id_game,
    id_copie,
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
JOIN medias USING (id_medias)
JOIN to_possess USING (id_copie)
JOIN users USING (id_user)
WHERE
    users.id_user = 1 AND to_possess.id_user
GROUP BY
    id_game, id_copie,game_reference, game_title, game_subtitle, date_year, editor_name, country_name,
    manufacturer_name, machine_name, machine_model, media_type, game_cover, machine_label_picture
ORDER BY
    id_copie;

');

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


?>

<section class="myitems-items__container">
    <!-- <div class="myitems-items__maintitle">
        <h2>Jeux que je possède</h2>
    </div> -->
    <div id="list-items" class="myitems-items__last-items-container">
        <section class="collection__view1">
            <?php foreach ($myCollectionList as $game) { ?>
                <div data-id-copie="<?= $game['id_copie'] ?>" class="view1-items__maincontainer">
                    <div class="view1-items__coverimage">
                        <img id="js-maxclic" src="./assets/<?= $game['game_cover'] ?>" alt="artwork cover">
                    </div>
                    <div class="view1-items__title">
                        <h3><?= $game['game_title'] ?></h3>
                    </div>
                    <div class="view1-items__subtitle">
                        <h4><?= $game['game_subtitle'] ?></h4>
                    </div>
                    <div class="view1-items__plateform">
                        <img src="./assets/<?= $game['machine_label_picture'] ?>" alt="plateform label">
                    </div>
                </div>


                <div class="hidden__field">
                    <div class="view1-maxitem__title">
                        <h3><?= $game['game_title'] ?></h3>
                    </div>
                    <div class="view1-maxitem__subtitle">
                        <h4><?= $game['game_subtitle'] ?></h4>
                    </div>
                    <div class="view1-maxitem__plateform">
                        <p><?= $game['manufacturer_name'] ?><?= $game['machine_name'] ?><?= $game['machine_model'] ?></p>
                    </div>
                    <div class="view1-maxitem__year">
                        <p><?= $game['date_year'] ?></p>
                    </div>
                    <div class="view1-maxitem__coverimage">
                        <img src="./assets/<?= $game['game_cover'] ?>" alt="artwork cover">
                    </div>
                    <div class="view1-maxitem__editor">
                        <p><?= $game['editor_name'] ?></p>
                    </div>
                    <div class="view1-maxitem__genre">
                        <p><?= $game['categories'] ?></p>
                    </div>
                    <div class="view1-maxitem__subcontainer">
                        <div class="view1-maxitem__country">
                            <p><?= $game['country_name'] ?></p>
                        </div>
                        <div class="view1-maxitem__ref">
                            <p><?= $game['game_reference'] ?></p>
                        </div>
                        <div class="view1-maxitem__support">
                            <p><?= $game['categories'] ?></p>
                        </div>
                    </div>
                    <div class="view1-maxitem__price">' . "111 articles à partir de 15€50" . '</p>
                    </div>
                    <div class="buttons__item ">
                        <span class="btn__item btn__item--color-empty">Ajouter au caddie</span>
                        <span class="btn__item btn__item--color-orange">Ajouter aux Favoris</span>
                    </div>
                </div>
            <?php } ?>
        </section>






        <section class="collection__view2 hidden__view">
            <?php foreach ($myCollectionList as $game) { ?>
                <div data-id-copie="<?= $game['id_copie'] ?>" class="view2-item__maincontainer">
                    <div class="top-informations">
                        <div class="select__bar">
                            <button type="button" class="delete__btn btn" data-set="bin" data-id="<?= $game['id_copie'] ?>">🗑️</button>

                            <button type="button" class="modify__btn btn" data-set="pen" data-id="pen<?= $game['id_copie'] ?>">✒️</button>
                        </div>
                        <div class="view2-items__coverimage">
                            <img src="./assets/<?= $game['game_cover'] ?>" alt="<?= $game['game_title'] ?> artwork cover">
                        </div>

                        <div class="view2-basicinfos__container">
                            <div class="view2-items__title">
                                <h3><?= $game['game_title'] ?></h3>
                            </div>
                            <div class="view2-items__subtitle">
                                <h4><?= $game['game_subtitle'] ?></h4>
                            </div>
                            <div class="view2-basicinfos__subcontainer">
                                <div class="view2-items__plateform">
                                    <p><span>🖥️</span><?= $game['manufacturer_name'] ?> <?= $game['machine_name'] ?> <?= $game['machine_model'] ?></p>
                                </div>
                                <div class="view2-items__editor">
                                    <p><span>✒️</span><?= $game['editor_name'] ?></p>
                                </div>
                                <div class="view2-items__year">
                                    <p><span>©️</span><?= $game['date_year'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="arrow view2-arrow">
                            <img data-id="arrow-img" src="./assets/svg/chevron-up-solid.svg" alt="">
                        </div>
                    </div>
                    <!-- Hidden drawer part-->
                    <div id="view2-items-bot" class="bot-informations hidden">
                        <div class="select__bar"></div>
                        <div class="view2-statesinfos__subcontainer">
                            <div class="view2-items__prices">
                                <h4>Minimum<span>€100,50</span></h4>
                                <h4>Moyen<span>€60,78</span></h4>
                                <h4>Maximum<span>€345,78</span></h4>
                            </div>

                            <div class="view2-items__date-state">
                                <h5>Ajouté <span>il y a 1 ans et 6 mois</span></h5>
                                <p class="green-color">Très bon état - presque Mint</p>
                            </div>
                            <div class="view2-items__notes">
                                <h4>Notes <span id="edit-notes" class="edit-notes"> Editer les notes </span></h4>
                            </div>
                        </div>
                    </div>
                    <div id="view2-notes" class="note-informations hidden">
                        <div class="select__bar"></div>
                        <form class="form-notes" method="get" action="#" name="text-notes">
                            <label htmlfor="input-notes">
                                <textarea id="input-notes" class="input-notes" name="notes" rows="10" cols="50"></textarea>
                            </label>
                            <button class="btn__view2 btn__color-green" type="submit" formaction="#">Enregistrer</button>
                            <button id="textarea-erase" class="btn__view2 btn__color-empty">Annuler</button>
                        </form>
                    </div>

                    <section id="pen<?= $game['id_copie'] ?>" class="collection__modify hidden">

                        <form id="pen<?= $game['id_copie'] ?>" class="formModify"  method="POST">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                            <input type="hidden" name="id_copie" value="<?= $game['id_copie'] ?>">
                            <input type="hidden" name="action" value="modify">

                            <label for="new_copie_title"></label>
                            <input type="text" id="new_copie_title" name="new_copie_title" value="<?= $game['game_title'] ?>">

                            <label for="new_copie_subtitle"></label>
                            <input type="text" id="new_copie_subtitle" name="new_copie_subtitle" value="<?= $game['game_subtitle'] ?>">

                            <label for="new_manufacturer_name"></label>
                            <select id="new_manufacturer_name" name="new_manufacturer_name[]">
                                <?php foreach ($manufacturersList as $manufacturer) { ?>
                                    <option value="<?= $manufacturer['manufacturer_name'] ?>" <?= ($manufacturer['manufacturer_name'] === $game['manufacturer_name']) ? 'selected' : '' ?>>
                                        <?= $manufacturer['manufacturer_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="new_machine_name"></label>
                            <select id="new_machine_name" name="new_machine_name[]">
                                <?php foreach ($machinesList as $machine) { ?>
                                    <option value="<?= $machine['machine_name'] ?>" <?= ($machine['machine_name'] === $game['machine_name']) ? 'selected' : '' ?>>
                                        <?= $machine['machine_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="new_machine_model"></label>
                            
                            <select id="new_machine_model" name="new_machine_model[]">
                                <?php foreach ($modelsList as $model) { ?>
                                    <option value="<?= $model['machine_model'] ?>" <?= ($model['machine_model'] === $game['machine_model']) ? 'selected' : '' ?>>
                                        <?= $model['machine_model'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="new_editor"></label>
                            <input type="text" id="new_editor" name="new_editor" value="<?= $game['editor_name'] ?>">

                            <label for="new_date"></label>
                           <select id="new_date" name="new_date[]">
                                <?php foreach ($datesList as $date) { ?>
                                    <option value="<?= $date['date_year'] ?>" <?= ($date['date_year'] === $game['date_year']) ? 'selected' : '' ?>>
                                        <?= $date['date_year'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <input type="submit" data-id-form="<?= $game['id_copie'] ?>" value="✒️">
                        </form>

                     
                        </form>
                    </section>

                </div>
            <?php } ?>
        </section>






        <section class="collection__view3 hidden__view">
            <?php foreach ($myCollectionList as $game) { ?>
                <div data-id-copie="<?= $game['id_copie'] ?>" class="view3-item__maincontainer">
                    <div class="top-informations">
                        <div class="select__bar">
                            <input class="checkbox" type="checkbox" name="selected" id="">
                        </div>
                        <div class="view3-basicinfos__container">
                            <div class="view3-items__title">
                                <h3><?= $game['game_title'] ?> - <?= $game['game_subtitle'] ?></h3>
                            </div>
                            <div class="view3-basicinfos__subcontainer view3">
                                <div class="view3-items__plateform">
                                    <p><?= $game['manufacturer_name'] ?> <?= $game['machine_name'] ?> <?= $game['machine_model'] ?></p>
                                </div>
                                <div class="view3-items__editor">
                                    <p><?= $game['editor_name'] ?></p>
                                </div>
                                <div class="view3-items__year">
                                    <p><?= $game['date_year'] ?></p>
                                </div>
                            </div>
                            <div class="view3-statesinfos__subcontainer">
                                <div class="view3-items__prices">
                                    <h4>Prix d'achat : <span><?= $game['game_price'] ?> €</span></h4>
                                </div>
                                <div class="view3-items__date">
                                    <h5>Ajouté le <span>il y a 1 ans et 6 mois</span></h5>
                                </div>
                                <div class="view3-items__state">
                                    <p class="green-color">Très bon état - presque Mint</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>

</section>