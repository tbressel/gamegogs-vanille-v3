// --------------------------------------------------------------------------------------------
// ---------------------------------- DISPLAY JSON  -------------------------------------------
// --------------------------------------------------------------------------------------------

/**
 * 
 *   Display last games
 * 
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
        templateContent.querySelector('.lastgames-items__last-items').setAttribute('id', `${game.id_copie}`);
        templateContent.querySelector('.lastgames-items__coverimage img').setAttribute("src", `./assets/${game.game_cover}`);
        templateContent.querySelector('.lastgames-items__title h3').textContent = game.game_title;
        // templateContent.querySelector('.lastgames-items__subtitle h4').textContent = game.game_subtitle;
        templateContent.querySelector('.lastgames-items__subtitle h6').innerHTML = `ajouté le ${game.copie_addition_date} <br> à ${game.copie_addition_time
        } <br> par ${game.user_nikename
        } <br>`;
        templateContent.querySelector('.lastgames-items__plateform img').setAttribute("src", `./assets/${game.machine_label_picture}`);

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



/**
 * 
 * 
 * Display every games of user collection
 * 
 * 
 * @param {*} myGames 
 * @param {*} templateId 
 * @param {*} destinationId 
 * @param {*} classType 
 */
function displayMyGames(myGames, templateId, destinationId, classType) {

    // Sorting games from the most recent first
    myGames.sort((a, b) => new Date(b.date_year) - new Date(a.date_year));

    // select 6 games from index 0
    myCollection = myGames.slice(0, 6);

    // get template element
    const listItemsTemplate = document.getElementById(templateId);

    // get destination element
    const listItemsElements = document.getElementById(destinationId);

    // Lopping on myCollection array and creating clone template node into DOM
    myCollection.forEach(game => {
        // Clone the template
        const templateContent = document.importNode(listItemsTemplate.content, true);

        // building the template
        templateContent.querySelector('.'+classType+'-items__maincontainer').setAttribute('data-id-copie', `${game.id_copie}`);
        templateContent.querySelector('.'+classType+'-items__title h3').textContent = game.game_title;
        templateContent.querySelector('.'+classType+'-items__subtitle h4').textContent = game.game_subtitle;
        
        if (classType === 'view1') {
            templateContent.querySelector('.'+classType+'-items__plateform img').setAttribute("src", `./assets/${game.machine_label_picture}`);
        }       
        if (classType === 'view2') {
            templateContent.querySelector('[data-set="bin"]').setAttribute('data-id', `${game.id_copie}`);
        }
        if (classType !== 'view3') {
            templateContent.querySelector('.'+classType+'-items__coverimage img').setAttribute("src", `./assets/${game.game_cover}`);
        }
        
        //  templateContent.querySelector('.'+classType+'-maxitem__title h3').textContent = game.game_title;
        //  templateContent.querySelector('.'+classType+'-maxitem__subtitle h4').textContent = game.game_subtitle;
        //  templateContent.querySelector('.'+classType+'-maxitem__plateform p').textContent = game.plateform_videogame[0];
        //  templateContent.querySelector('.'+classType+'-maxitem__year p').textContent = game.year_videogame;
        //  templateContent.querySelector('.'+classType+'-maxitem__coverimage img').setAttribute("src", `./assets/${game.coverpic_videogame}`);
        //  templateContent.querySelector('.'+classType+'-maxitem__editor p').textContent = game.editor_videogame;
        //  templateContent.querySelector('.'+classType+'-maxitem__genre p').textContent = game.genre_videogame;
        //  templateContent.querySelector('.'+classType+'-maxitem__country p').textContent = game.country_videogame;
        //  templateContent.querySelector('.'+classType+'-maxitem__ref p').textContent = game.ref_videogame;
        //  templateContent.querySelector('.'+classType+'-maxitem__support p').textContent = game.support_videogame;

        // send template into DOM
        listItemsElements.appendChild(templateContent);
    });
}


