// --------------------------------------------------------------------------------------------
// ---------------------------------- MAIN NAVIGATION FUNCTIONS -------------------------------
// --------------------------------------------------------------------------------------------

/**
 * 
 * Toggle submenu in the burger menu
 * 
 * @param {*} event 
 */
function toggleSubMenu(event) {
    document.querySelector(`.submenu__container .${event.target.getAttribute('data-set')}`).classList.toggle('active');
    reverseProfilArrow();
}

/**
 *
 * Forcing the closure of the submenu
 *  
 */
function closeSubMenu() {
    document.querySelector(`.submenu__container .menu__ul--profil`).classList.toggle('active');
}
/**
 * 
 * Change arrows orientation  when clicking on main menu in desktop view
 * 
 */
function reverseProfilArrow() {
    document.getElementById('arrow-mobile').classList.toggle('down');
}

// --------------------------------------------------------------------------------------------
// -------------------------------- FOOTER NAVIGATION FUNCTIONS -------------------------------
// --------------------------------------------------------------------------------------------
/**
 * 
 * Display footer menu
 * 
 * @param {*} event 
 */
function displayFooterMenu(event) {
    document.getElementById(event.target.getAttribute("data-set")).classList.toggle('active');
}
/**
 * 
 * Change arrows orientation when clicking on them
 * 
 * @param {*} event 
 */
function reverseFooterArrow(event) {
    event.target.classList.toggle('down');
}
// --------------------------------------------------------------------------------------------
// ------------------------------------ COLLECTION MENU BAR  ----------------------------------
// --------------------------------------------------------------------------------------------
/**
 * 
 * display filter bar
 * 
 * @param {*} pageName 
 * @returns 
 */
function setFilterBar(pageName) {
    if(currentPage === pageName) return
    document.getElementById("filter-nav").classList.toggle("show")
}
/**
 *
 * Forcing the closure of the filterbar
 *  
 */
function closeFilterBar() {
    document.getElementById("filter-nav").classList.remove("show")
}
/**
 * Closing all collection Views
 */
function closeAllView() {
    document.querySelector('.collection__view1').className = 'collection__view1 hidden__view';
    document.querySelector('.collection__view2').className = 'collection__view2 hidden__view';
    document.querySelector('.collection__view3').className = 'collection__view3 hidden__view';
}




/**
 * 
 * Fetching a main page and waiting for the response to send it to the destination node
 * 
 * @param {*} fileName 
 * @param {*} path 
 * @param {*} id 
 */
async function insertPageContent(fileName, path, id) {
    try {
        const response = await fetch(path + fileName);
        if (!response.ok) {
            throw new Error(`Erreur de chargement de ${fileName}`);
        }
        const content = await response.text();
        // send of content to destination node
        document.getElementById(id).innerHTML = content;
    } catch (error) {
        console.error(error.message);
    }
}


function updateSubmenuLogUser(bool) {
    // Sélectionner l'élément li avec l'attribut data-id="logout"
    let logoutMenuItem = document.querySelector('[data-id="logout"]');

    if (logoutMenuItem) {
        // Sélectionner le paragraphe (p) à l'intérieur de l'élément li
        let textElement = logoutMenuItem.querySelector('p');

        if (textElement) {
            // Mettre à jour le texte en fonction de la valeur de bool
            textElement.textContent = bool ? "Connexion" : "Déconnexion";
        }
    }
}



function deleteCopieNodes(id) {
    const elements = document.querySelectorAll('[data-id-copie="'+id+'"]');
    
    elements.forEach(element => {
        element.remove();
    });
}



























     /**
    * 
    * get the actual token
    * 
    * @returns 
    */
     function getToken() {
        let bodyElement = document.querySelector('body');
        let token = bodyElement.getAttribute('data-token');
        return token
    }





/**
 * 
 * to delete a child node content by its ID
 * 
 * @param {*} id 
 */
function deleteContainer(id) {
    document.getElementById(id).textContent = "";
}

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!  NOT TO KEEP BUT TO REPLACE AFTER PHP IMPLEMENT !!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

function findUserGameByUserId(id) {
    // find user in user list
    const usersData = JSON.parse(localStorage.getItem('usersData'));

    // loop the array to find user
    const user = usersData.find(user => user.id_user === id);

    if (user) {
        // filter gamesData to retrive userGames
        const userGames = gamesData.filter(game => user.games_user.includes(game.id_videogame));
        return userGames
    }
}


function eraseTextareaContent(target) {
    target.parentElement.firstElementChild.firstElementChild.value = "";
    console.log('contenu de <textarea> est effacé')
}

function closeNotesContainer(element) {
    // Close the notes container if main section of the item is closed
    if (element.nextElementSibling.classList.contains('hidden')) {
        return;
    } else {
        element.nextElementSibling.classList.add('hidden');
    }
}

function displayGenre() {

    // get JSON in array
    const gamesList = JSON.parse(localStorage.getItem('gamesData'));
    const usersList = JSON.parse(localStorage.getItem('usersData'));

    // get the user
    const userId = 1;
    const userArray = usersList.find(user => user.id_user === userId);

    // get id 's game from this user
    const userGameIds = userArray.games_user;

    // new array with genre and count
    const genreCount = {};
    const totalGamesByGenre = {};

    // loop on user's game
    userGameIds.forEach(gameId => {
        // find in gameList with games ID
        const game = gamesList.find(game => game.id_videogame === gameId);
        if (game) {
            // get it !
            const genre = game.genre_videogame;

            // is already exist ?
            if (genre in genreCount) {
                // if it is
                genreCount[genre]++;
            } else {
                // if not
                genreCount[genre] = 1;
            }
        }
    });

    // Loop on th whole game list
    gamesList.forEach((game) => {
        const genre = game.genre_videogame;
        if (genre in totalGamesByGenre) {
            totalGamesByGenre[genre]++;
        } else {
            totalGamesByGenre[genre] = 1;
        }
    });


    // get html element with id "genre_filter"
    const genreFilterElement = document.getElementById('genre_filter');

    // get the  template genre_filter_template
    const genreFilterTemplate = document.getElementById('genre_filter_template');

    // Ploop the array genreCount
    for (const genre in genreCount) {
        // clone hte template
        const genreFilterItem = document.importNode(genreFilterTemplate.content, true);
        genreFilterItem.querySelector('.name_filter p').textContent = genre;
        genreFilterItem.querySelector('.quantity_filter p').textContent = genreCount[genre] + ' jeux possédé(s) sur ' + (totalGamesByGenre[genre] || 0);
        genreFilterElement.appendChild(genreFilterItem);
    }
}
function displaySupport() {

    // get JSON in array
    const gamesList = JSON.parse(localStorage.getItem('gamesData'));
    const usersList = JSON.parse(localStorage.getItem('usersData'));


    // get the user
    const userId = 1;
    const userArray = usersList.find(user => user.id_user === userId);

    // get id 's game from this user
    const userGameIds = userArray.games_user;

    // new array with support and count
    const supportCount = {};
    const totalGamesBySupport = {};

    // loop on user's game
    userGameIds.forEach(gameId => {
        // find in gameList with games ID
        const game = gamesList.find(game => game.id_videogame === gameId);
        if (game) {
            // get it !
            const support = game.support_videogame;

            // is already exist ?
            if (support in supportCount) {
                // if it is
                supportCount[support]++;
            } else {
                // if not
                supportCount[support] = 1;
            }
        }
    });

    // Loop on th whole game list
    gamesList.forEach((game) => {
        const support = game.support_videogame;
        if (support in totalGamesBySupport) {
            totalGamesBySupport[support]++;
        } else {
            totalGamesBySupport[support] = 1;
        }
    });


    // get the element id "support_filter"
    const supportFilterElement = document.getElementById('support_filter');

    // get the templayte support_filter_template
    const supportFilterTemplate = document.getElementById('support_filter_template');

    // lopp the array supportCount
    for (const support in supportCount) {
        // clone the template
        const supportFilterItem = document.importNode(supportFilterTemplate.content, true);
        supportFilterItem.querySelector('.name_filter p').textContent = support;
        supportFilterItem.querySelector('.quantity_filter p').textContent = supportCount[support] + ' jeux possédé(s) sur ' + (totalGamesBySupport[support] || 0 );
        supportFilterElement.appendChild(supportFilterItem);
    }
}
function displayPlateform() {
    // get JSON in array
    const gamesList = JSON.parse(localStorage.getItem('gamesData'));
    const usersList = JSON.parse(localStorage.getItem('usersData'));


    // get the user by ID
    const userId = 1;
    const userArray = usersList.find((user) => user.id_user === userId);

    // get the games 
    const userGameIds = userArray.games_user;

    // create objet to get plateform counter and total game by plateform
    const plateformCount = {};
    const totalGamesByPlateform = {};

    // Loop with games's user array
    userGameIds.forEach((gameId) => {
        // with the game ID find the game
        const game = gamesList.find((game) => game.id_videogame === gameId);
        if (game) {
            const plateform = game.plateform_videogame[0];
            // update user plateform counter 
            if (plateform in plateformCount) {
                plateformCount[plateform]++;
            } else {
                plateformCount[plateform] = 1;
            }
        }
    });

    // Loop on the whole array af games and get plateforme plateforme
    gamesList.forEach((game) => {
        const plateform = game.plateform_videogame[0];
        if (plateform in totalGamesByPlateform) {
            totalGamesByPlateform[plateform]++;
        } else {
            totalGamesByPlateform[plateform] = 1;
        }
    });

    // het html element with id "plateform_filter"
    const plateformFilterElement = document.getElementById('plateform_filter');

    // get the template plateform_filter_template
    const plateformFilterTemplate = document.getElementById('plateform_filter_template');

    // loop on each plateforme plateformCount
    for (const plateform in plateformCount) {
        // clone the template
        const plateformFilterItem = document.importNode(plateformFilterTemplate.content, true);
        plateformFilterItem.querySelector('.name_filter p').textContent = plateform;
        plateformFilterItem.querySelector('.quantity_filter p').textContent =
            plateformCount[plateform] + ' jeux possédé(s) sur ' + (totalGamesByPlateform[plateform] || 0);
        plateformFilterElement.appendChild(plateformFilterItem);
    }
}



