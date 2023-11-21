<section class="lastgames-items__container">

    <!-- header -->
    <div class="lastgames-items__maintitle">
        <h2>Explorer les ajouts récents</h2>
    </div>

    <div id="list-items" class="lastgames-items__last-items-container"></div>

    <!-- footer -->
    <div class="lastgames-items__footer-list">
        <p>
            voir plus d'ajout récents >
        </p>
    </div>

</section>





<template id="list-items-template">
    <div id="0" class="lastgames-items__last-items item__Amstrad js-item">
        <div class="lastgames-items__coverimage">
            <img id="js-maxclic" src="./assets/img/covers/no-photo.png" alt="artwork cover">
        </div>
        <div class="lastgames-items__title">
            <h3>Titre</h3>
        </div>
        
        <div class="lastgames-items__subtitle">
                    <h6>ajouté le <br> à <br> par <br> </h6>
        </div>
        <div class="lastgames-items__plateform">
            <img src="./assets/img/plateforms/sony-playstation4.png" alt="plateform label">
        </div>
    </div>


    <div class="hidden__field">
        <div class="lastgames-maxitem__title">
            <h3>Titre</h3>
        </div>
        <div class="lastgames-maxitem__subtitle">
            <h4>sous titre</h4>
        </div>
        <div class="lastgames-maxitem__plateform">
            <p>plateforme</p>
        </div>
        <div class="lastgames-maxitem__year">
            <p>année</p>
        </div>
        <div class="lastgames-maxitem__coverimage">
            <img src="./assets/img/covers/no-photo.png" alt="artwork cover">
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
</template>

