document.addEventListener('DOMContentLoaded', () => {
    const dataLastGame = {
        action: 'display-last-games',
    };

    fetchFormApi(dataLastGame, 'display-last-games', 'POST')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(jsonData => {
            // console.log('Full JSON Response:', JSON.stringify(jsonData));

            if (jsonData.result === true) {
                console.log('Game List OK:', jsonData.games);

                // Assuming jsonData.games is an array of games
                const lastGames = jsonData.games;

                // Continue with your logic to display recent games
                displayLastGames(lastGames);
            } else {
                console.error('API returned an error:', jsonData.message);
            }
        })
        .catch(error => {
            console.error('Some errors during the JSON data response:', error);
        });
});



/**
 *  Display last games
 */
function displayLastGames(lastGames) {

    // Sorting games from the most recent first
    lastGames.sort((a, b) => new Date(b.copie_addition_date) - new Date(a.copie_addition_date));

    // select 6 games from index 0
    recentGames = lastGames.slice(0, 6);

    // get template element
    const listItemsTemplate = document.getElementById('list-items-template');

    // get destination element
    const listItemsElements = document.getElementById('list-items');

    // Lopping on recentGames array and creating clone template node into DOM
    recentGames.forEach(game => {
        // Clone the template
        const templateContent = document.importNode(listItemsTemplate.content, true);

        // building the template
        templateContent.querySelector('.lastgames-items__last-items').setAttribute('id', `${game.id_game}`);
        templateContent.querySelector('.lastgames-items__coverimage img').setAttribute("src", `./assets/${game.game_cover}`);
        templateContent.querySelector('.lastgames-items__title h3').textContent = game.game_title;
        // templateContent.querySelector('.lastgames-items__subtitle h4').textContent = game.game_subtitle;
        templateContent.querySelector('.lastgames-items__subtitle h6').innerHTML = `ajouté le ${game.copie_addition_date} <br> à ${game.copie_addition_time
        } <br> par ${game.user_nikename
        } <br>`;
        templateContent.querySelector('.lastgames-items__plateform img').setAttribute("src", `./assets/${game.machine_label_picture
        }`);

        // templateContent.querySelector('.lastgames-maxitem__title h3').textContent = game.title_videogame;
        // templateContent.querySelector('.lastgames-maxitem__subtitle h4').textContent = game.subtitle_videogame;
        // templateContent.querySelector('.lastgames-maxitem__plateform p').textContent = game.plateform_videogame[0];
        // templateContent.querySelector('.lastgames-maxitem__year p').textContent = game.year_videogame;
        // templateContent.querySelector('.lastgames-maxitem__coverimage img').setAttribute("src", `./assets/${game.coverpic_videogame}`);
        // templateContent.querySelector('.lastgames-maxitem__editor p').textContent = game.editor_videogame;
        // templateContent.querySelector('.lastgames-maxitem__genre p').textContent = game.genre_videogame;
        // templateContent.querySelector('.lastgames-maxitem__country p').textContent = game.country_videogame;
        // templateContent.querySelector('.lastgames-maxitem__ref p').textContent = game.ref_videogame;
        // templateContent.querySelector('.lastgames-maxitem__support p').textContent = game.support_videogame;

        // send template into DOM
        listItemsElements.appendChild(templateContent);
    });
}














// declare breadscrum
let currentPage = "accueil";


// Listen to burger button
document.getElementById('burger-btn').addEventListener('click', (event) => {
    toggleSubMenu(event);
});


// listen to profil bar button
document.getElementById('profilarrow-btn-mobile').addEventListener('click', (event) => {
    toggleSubMenu(event);
});


// listen to arrows on footer menu
document.getElementById('footer-menu').addEventListener('click', (event) => {
    if (event.target.getAttribute("alt") !== "arrow") return
    displayFooterMenu(event);
    reverseFooterArrow(event);
});


// Listen to Collection menu in main menu
document.getElementById('collection').addEventListener('click', async () => {
    // close submenu
    closeSubMenu();

    // delete main container
    deleteContainer('main');

    // enable filter bar
    setFilterBar("collection");

    // awaiting for the page content
    await insertPageContent("collection.php", "pages/collection/", "main");
});



/**
 * Listen to each view button in collection user. And switch class to display the right one. 
 */
document.getElementById('filter-nav').addEventListener('click', (event) => {

    if (event.target.getAttribute('alt') === "view1") {
        closeAllView();
        document.querySelector('.collection__view1').classList.toggle('hidden__view')

    } else if (event.target.getAttribute('alt') === "view2") {
        closeAllView();
        document.querySelector('.collection__view2').classList.toggle('hidden__view')

    } else if (event.target.getAttribute('alt') === "view3") {
        closeAllView();
        document.querySelector('.collection__view3').classList.toggle('hidden__view')

    } else if (event.target.getAttribute('data-btn-filter') === "") {
        document.getElementById('overlay-filter').classList.toggle('show');
    }
})

let globalbotInfoContainer = null;
let globalNotesInfoContainer = null;
let lastIdElementClicked = "";

/**
 * Listen to buttons inside each container
 */
document.getElementById("main").addEventListener('click', (event) => {

    if (event.target.getAttribute("data-id") === "arrow-img") {

        // switch class to change arrow direction
            event.target.classList.toggle("arrow_change");

        // And sibling top-information and then bot-informations to toggle hidden class
            let botInfoContainer = event.target.closest(".top-informations").nextElementSibling.classList.toggle('hidden');
            globalbotInfoContainer = botInfoContainer;       
            closeNotesContainer(botInfoContainer);

    } else if (event.target.getAttribute("data-set") === "bin") {
        const id = event.target.getAttribute("data-id")
        fetchApi('delete', id, getToken());

    } else if (event.target.getAttribute("data-set") === "pen") {
        lastIdElementClicked = event.target.getAttribute("data-id");
        document.getElementById(lastIdElementClicked).classList.toggle('hidden');
        
    } else if (event.target.getAttribute("data-id-form")){
        console.log(event.target)
        event.preventDefault();
        console.log(lastIdElementClicked)
    }


    // Lisen if inside this event the element edit-note is clicked
    // if (event.target.getAttribute("id") === "edit-notes") {

    //     // The sibling parent element 
    //     let notesInfoContainer = event.target.closest('.bot-informations').nextElementSibling;
    //     console.log('Element ciblé : ', notesInfoContainer);
    //     notesInfoContainer.classList.toggle('hidden');
    // };

    // if (event.target.getAttribute('id') === 'textarea-erase') {
    //     event.preventDefault();
    //     eraseTextareaContent(event.target);
    //     closeNotesContainer(globalbotInfoContainer);
    // }

})

