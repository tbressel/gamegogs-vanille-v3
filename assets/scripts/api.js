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
 * Fetching API for delete action
 * 
 * @param {*} action 
 * @param {*} id 
 * @param {*} token 
 */
function fetchApi(action, id, token) {
    fetch('api.php?action=' + action + '&id=' + id + '&token=' + token)
        .then(response => response.json())
        .then(data => {
            if (action === 'delete') {
                console.log('le jeu à été effacé de la base de donnée');
                deleteCopieNodes(id)
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



/**
 * Retrieves the latest games in JSON format.
 *
 * @param {string} action - The action to perform.
 * @param {string} method - The method to use.
 * @param {string} consoleMsg - The message to display in the console.
 * @param {object} jsonkey1 - The JSON data to use.
 * @param {boolean} redirect - Indicates whether a redirection should be performed.
 */
// function getLastGamesJson(action, method, consoleMsg, jsonkey1, callback, redirect) {
//     const data = {
//         action: action,
//     };
//     fetchFormApi(data, action, method)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(`Erreur HTTP! Statut: ${response.status}`);
//             }
//             return response.json();
//         })
//         .then(jsonData => {
//             if (jsonData.result === true) {
//                 console.log(consoleMsg, jsonData[jsonkey1]);

//                 if (callback !== false) callback(jsonData[jsonkey1]);

//                 if (redirect !== false)  window.location.href = 'index.php';

//             } else {
//                 console.error('API returned an error:', jsonData.message);
//             }
//         })
//   }

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
                 console.log('Game List OK:', jsonData['games']);
                 displayLastGames(jsonData['games']);
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
                // toggleConnexionForms();


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
      

        // toggleConnexionForms ();


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



document.addEventListener('submit', (event) => {
    if (event.target.id === 'registration-form') {

        event.preventDefault();
      
        console.log('ok');

        const signInData = {
            action: 'signin',
            token: getToken(),
            nickname: event.target.querySelector('input[name="nickname"]').value,
            birthdate: event.target.querySelector('input[name="birthdate"]').value,
            email: event.target.querySelector('input[name="email"]').value,
            password: event.target.querySelector('input[name="password"]').value
        };
        console.log(signInData);

        fetchFormApi(signInData, "signin", "POST")
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(jsonData => {
            // console.log('Full JSON Response:', JSON.stringify(jsonData));

            if (jsonData.result === true) {
                console.log('Enregistrement OK:', jsonData.games);

                // Assuming jsonData.games is an array of games
                const myGames = jsonData.message;
                // updateSubmenuLogUser(true);
                // window.location.href = 'index.php';

            } else {
                console.error('API returned an error:', jsonData.message);
            }
        })
        .catch(error => {
            console.error('Some errors during the JSON data response:', error);
        });
}



    });