// --------------------------------------------------------------------------------------------
// ------------------------------------ API CALLS  --------------------------------------------
// --------------------------------------------------------------------------------------------
/**
 * 
 * Fetch Api datas which need action and method
 * 
 * @param {*} data 
 * @param {*} action 
 * @param {*} method 
 * @returns 
 */
async function fetchFormApi(data, action, method) {
    try {
        const response = await fetch('api.php?action=' + action, {
            method: method,
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        return response; // Renvoie la réponse complète

    } catch (error) {
        console.error("Erreur lors de la requête API :", error);
        throw new Error(error);
    }
}
/**
 * 
 * fetch api file 
 * 
 * @param {*} action 
 * @param {*} id 
 * @param {*} token 
 */
function fetchApi(action, id, token) {
    fetch('api.php?action=' + action + '&id=' + id + '&token=' + token)
        .then(response => response.json())
        .then(data => {


            if (action !== 'delete') {
                console.log('le jeu à été effacé de la base de donnée');

                deleteGame(id)

            }


        });
}

// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------

/**
 * 
 * Get Last games information from the database in a Json format
 * 
 */
function getLastGamesJson() {

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
}
/**
 * 
 * Get Last games information from the database in a Json format
 * 
 */
function logoutSession() {

    const dataLogout = {
        action: 'logout',
    };

    fetchFormApi(dataLogout, 'logout', 'POST')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(jsonData => {
            // console.log('Full JSON Response:', JSON.stringify(jsonData));

            if (jsonData.result === true) {
                console.log('Déconnexion OK:');
                updateSubmenuLogUser(false)
                window.location.href = 'index.php';

            } else {
                console.error('API returned an error:', jsonData.message);
            }
        })
        .catch(error => {
            console.error('Oupss ! Y\'a eu de la casse pendant la réponse du JSON:', error);
        });
}

/**
 * 
 * Get my collection information from the database in a Json format
 * 
 */
function getCollectionJson() {

    const dataMyGame = {
        action: 'display-my-games',
    };

    fetchFormApi(dataMyGame, 'display-my-games', 'POST')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(jsonData => {
            // console.log('Full JSON Response:', JSON.stringify(jsonData));

            if (jsonData.result === true) {
                console.log('My Games List OK:', jsonData.games);
                console.log('Manufacturers List OK:', jsonData.manufacturers);
                console.log('Machines List OK:', jsonData.machines);
                console.log('Models List OK:', jsonData.models);
                console.log('dates List OK:', jsonData.dates);

                // Assuming jsonData.games is an array of games
                const myGames = jsonData.games;

                // Continue with your logic to display recent games
                displayMyGames(myGames, 'my-items-template1', 'my-item-view1', 'view1');
                displayMyGames(myGames, 'my-items-template2', 'my-item-view2', 'view2');
                displayMyGames(myGames, 'my-items-template3', 'my-item-view3', 'view3');

            } else if (jsonData.logscreen === true) {

                console.log('on affiche lemodule de connexion');
                // awaiting for the page content
                insertPageContent("connexion.php", "./pages/connexion/", "main");
                toggleConnexionForms();


            } else {
                console.error('API returned an error:', jsonData.message);

            }
        })
        .catch(error => {
            console.error('Some errors during the JSON data response:', error);
        });
}






document.addEventListener('submit', (event) => {
    if (event.target.id === 'login-form') {
        event.preventDefault();
      

        toggleConnexionForms ();


        const data = {
            action: 'login',
            token: getToken(),
            pseudo: event.target.querySelector('input[name="pseudo"]').value,
            password: event.target.querySelector('input[name="password"]').value
        };

        fetchFormApi(data, "login", "POST")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                }
                return response.json();
            })
            .then(jsonData => {
                // console.log('Full JSON Response:', JSON.stringify(jsonData));

                if (jsonData.result === true) {
                    console.log('My Games List OK:', jsonData.games);

                    // Assuming jsonData.games is an array of games
                    const myGames = jsonData.yaca;
                    // updateSubmenuLogUser(true);
                    window.location.href = 'index.php';

                } else {
                    console.error('API returned an error:', jsonData.message);
                }
            })
            .catch(error => {
                console.error('Some errors during the JSON data response:', error);
            });
    }
});