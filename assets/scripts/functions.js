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
if (fileName ==="collection.php") {
    currentPage = "collection";
    // document.querySelector('.menu__ul--profil.active').style.top = '125px';
} 
    } catch (error) {
        console.error(error.message);
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
