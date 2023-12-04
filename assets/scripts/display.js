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

    // get template element
    const listItemsTemplate = document.getElementById(templateId);

    // get destination element
    const listItemsElements = document.getElementById(destinationId);

    // Lopping on myCollection array and creating clone template node into DOM
    myGames.forEach(game => {


        // Clone the template
        const templateContent = document.importNode(listItemsTemplate.content, true);

        // building the template
        templateContent.querySelector('.'+classType+'-items__maincontainer').setAttribute('data-id-copie', `${game.id_copie}`);
        templateContent.querySelector('.'+classType+'-items__title h3').textContent = game.game_title;
        templateContent.querySelector('.'+classType+'-items__subtitle h4').textContent = game.game_subtitle;
        
        if (classType === 'view1') {
            templateContent.querySelector('.'+classType+'-items__plateform img').setAttribute("src", `./assets/${game.machine_label_picture}`);
            templateContent.querySelector('.'+classType+'-items__coverimage img').setAttribute("src", `./assets/${game.game_cover}`);
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
        }       
        if (classType === 'view2') {
            templateContent.querySelector('.'+classType+'-items__coverimage img').setAttribute("src", `./assets/${game.game_cover}`);
            templateContent.querySelector('[data-set="bin"]').setAttribute('data-id', `${game.id_copie}`);
            // templateContent.querySelector('[data-set="pen"]').setAttribute('data-id', `${game.id_copie}`);
            templateContent.querySelector('.'+classType+'-items__plateform p').textContent = `${game.manufacturer_name} ${game.machine_model}`;
            templateContent.querySelector('.'+classType+'-items__editor p').textContent = `${game.editor_name}`;
            templateContent.querySelector('.'+classType+'-items__year p').textContent = `${game.date_year}`;
            templateContent.querySelector('.'+classType+'-items__date-state h5 span').textContent = `${game.copie_addition_date} à ${game.copie_addition_time}`;
            templateContent.querySelector('.'+classType+'-items__date-state p').textContent = `${game.copie_state_rank} - ${game.copie_state_name}`;
            templateContent.querySelector('.'+classType+'-items__color-state').classList.replace('view2-items__color-state', `${game.copie_state_description}`);
            
            templateContent.querySelector('.'+classType+'-items__category--genres').textContent = `${game.categories}`;
            
            statisticString = game.statistic;
            statisticArray = JSON.parse(statisticString);
            
            templateContent.querySelector('.'+classType+'-items__prices--minprice').textContent = `${statisticArray[1]} €`;
            templateContent.querySelector('.'+classType+'-items__prices--medprice').textContent = `${statisticArray[0]} € sur les ${statisticArray[3]} exemplaires existant`;
            templateContent.querySelector('.'+classType+'-items__prices--maxprice').textContent = `${statisticArray[2]} €`;

            // code to modify information
            // templateContent.querySelector(`[data-id-pen]`).setAttribute('data-id-pen', `${game.id_copie}`);
            // templateContent.querySelector(`[data-id-form]`).setAttribute('data-id-form', `${game.id_copie}`);
            // templateContent.querySelector(`[name="id_copie"]`).setAttribute('value', `${game.id_copie}`);
            // templateContent.getElementById(`new_copie_title`).setAttribute('value', `${game.game_title}`);
            // templateContent.getElementById(`new_copie_subtitle`).setAttribute('value', `${game.game_subtitle}`);
            // templateContent.getElementById(`new_manufacturer_name`).setAttribute('value', `${game.manufacturer_name}`);
        }
        if (classType === 'view3') {
            // templateContent.querySelector('[data-set="bin"]').setAttribute('data-id', `${game.id_copie}`);
            templateContent.querySelector('.'+classType+'-items__plateform--editor--year p').textContent = `${game.manufacturer_name} ${game.machine_model} - ${game.editor_name} (${game.date_year})`;
            templateContent.querySelector('.'+classType+'-items__prices h4 span').textContent = `${game.copie_price} €`;
            templateContent.querySelector('.'+classType+'-items__date h5 span').textContent = `${game.copie_addition_date} à ${game.copie_addition_time}`;
            templateContent.querySelector('.'+classType+'-items__state p').textContent = `${game.copie_state_rank} - ${game.copie_state_name}`;
            templateContent.querySelector('.'+classType+'-items__color-state').classList.replace('view3-items__color-state', `${game.copie_state_description}`);
            
        }
        

        // send template into DOM
        listItemsElements.appendChild(templateContent);
    });
}


/**
 * 
 * Display template with a Json Object
 * 
 * @param {Object} json 
 * @param {Node} templateId 
 * @param {Node} containerId 
 */
function displayFilter(json, templateId, containerId) {
    const template = document.getElementById(templateId);
    const container = document.getElementById(containerId);
   
    json.forEach(data => {
       
        // Clone model
        const clone = document.importNode(template.content, true);
       
        // Inject data into clone
        clone.querySelector('.name_filter p').textContent = `${data.filter_name}`;
        const texte = (data.games_owned_user <= 1) ? 'jeu possédé' : 'jeux possédés';
        clone.querySelector('.quantity_filter p').textContent = `${data.games_owned_user} ${texte} sur ${data.total_games}`;
       
        // add clone to container
        container.appendChild(clone);
    });
}
