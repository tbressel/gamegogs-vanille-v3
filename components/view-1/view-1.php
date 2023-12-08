<section class="myitems-items__container">
    <section id="my-item-view1" class="collection__view1"></section>
    <section id="my-item-view2" class="collection__view2 hidden__view"></section>
    <section id="my-item-view3" class="collection__view3 hidden__view"></section>
</section>



<template id="my-items-template1">
    <div data-id-copie="" class="view1-items__maincontainer">
        <div class="view1-items__coverimage">
            <img id="js-maxclic" src="./assets/" alt="artwork cover">
        </div>
        <div class="view1-items__title">
            <h3></h3>
        </div>
        <div class="view1-items__subtitle">
            <h4></h4>
        </div>
        <div class="view1-items__plateform">
            <img src="./assets/" alt="plateform label">
        </div>
    </div>


    <div class="hidden__field">
        <div class="view1-maxitem__title">
            <h3>$game['game_title'] </h3>
        </div>
        <div class="view1-maxitem__subtitle">
            <h4>$game['game_subtitle'] </h4>
        </div>
        <div class="view1-maxitem__plateform">
            <p>$game['manufacturer_name']  $game['machine_model'] </p>
        </div>
        <div class="view1-maxitem__year">
            <p>$game['date_year'] </p>
        </div>
        <div class="view1-maxitem__coverimage">
            <img src="./assets/" alt="artwork cover">
        </div>
        <div class="view1-maxitem__editor">
            <p>$game['editor_name'] </p>
        </div>
        <div class="view1-maxitem__genre">
            <p>$game['categories'] </p>
        </div>
        <div class="view1-maxitem__subcontainer">
            <div class="view1-maxitem__country">
                <p>$game['country_name'] </p>
            </div>
            <div class="view1-maxitem__ref">
                <p>$game['game_reference'] </p>
            </div>
            <div class="view1-maxitem__support">
                <p>$game['categories'] </p>
            </div>
        </div>
        <div class="view1-maxitem__price">' . "111 articles à partir de 15€50" . '</p>
        </div>
        <div class="buttons__item ">
            <span class="btn__item btn__item--color-empty">Ajouter au caddie</span>
            <span class="btn__item btn__item--color-orange">Ajouter aux Favoris</span>
        </div>
    </div>
</template>

<template id="my-items-template2">
    <div data-id-copie="0" class="view2-items__maincontainer">
        <div class="top-informations">
            <div class="select__bar">
                <button type="button" class="delete__btn btn" data-set="bin" data-id="$game['id_copie'] ">🗑️</button>
                <!-- <button type="button" class="modify__btn btn" data-set="pen" data-id="$game['id_copie'] ">✒️</button> -->
            </div>
            <div class="view2-items__coverimage">
                <img src="./assets/" alt="$game['game_title']  artwork cover">
            </div>

            <div class="view2-basicinfos__container">
                <div class="view2-items__title">
                    <h3>$game['game_title'] </h3>
                </div>
                <div class="view2-items__subtitle">
                    <h4>$game['game_subtitle'] </h4>
                </div>
                <div class="view2-basicinfos__subcontainer">
                    <div class="view2-items__plateform">
                        <p>$game['manufacturer_name'] $game['machine_model'] </p>
                    </div>
                    <div class="view2-items__editor">
                        <p>$game['editor_name'] </p>
                    </div>
                    <div class="view2-items__year">
                        <p>$game['date_year'] </p>
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
                    <h4>Minimum<span class="view2-items__prices--minprice">€100,50</span></h4>
                    <h4>Moyen<span class="view2-items__prices--medprice">€60,78</span></h4>
                    <h4>Maximum<span class="view2-items__prices--maxprice">€345,78</span></h4>
                </div>
                <div class="view2-items__category">
                    <h4>Genre : <span class="view2-items__category--genres">genres</span></h4>
                </div>

                <div class="view2-items__date-state">
                    <h5>Ajouté le <span></span></h5>
                    <p class="view2-items__color-state"></p>
                </div>
            </div>
        </div>
    </div>
</template>





<template id="my-items-template3">
    <div data-id-copie="$game['id_copie'] " class="view3-items__maincontainer">
        <div class="top-informations">
        <div class="select__bar">
                <button type="button" class="delete__btn btn" data-set="bin" data-id="$game['id_copie'] ">🗑️</button>
                <!-- <button type="button" class="modify__btn btn" data-set="pen" data-id="$game['id_copie'] ">✒️</button> -->
            </div>
            <div class="view3-basicinfos__container">
                <div class="view3-items__title">
                    <h3></h3>
                    <span class="view3-items__subtitle">
                        <h4></h4>
                    </span>
                </div>
                <div class="view3-basicinfos__subcontainer">
                    <div class="view3-items__plateform--editor--year">
                        <p></p>
                    </div>
                    <!-- <div class="view3-items__editor">
                        <p>$game['editor_name'] </p>
                    </div>
                    <div class="view3-items__year">
                        <p>$game['date_year'] </p>
                    </div> -->
                </div>
                <div class="view3-statesinfos__subcontainer">
                    <div class="view3-items__prices">
                        <h4>Prix d'achat : <span>$game['game_price'] €</span></h4>
                    </div>
                    <div class="view3-items__date">
                        <h5>Ajouté le <span>il y a 1 ans et 6 mois</span></h5>
                    </div>
                    <div class="view3-items__state">
                        <p class="view3-items__color-state">Très bon état - presque Mint</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>