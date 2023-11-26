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
 * sign out from a session
 * 
 */
function signoutSession() {

    const dataLogout = {
        action: 'signout',
    };

    fetchFormApi(dataLogout, 'signout', 'POST')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP! Statut: ${response.status}`);
            }
            return response.json();
        })
        .then(jsonData => {
            let userMessage = jsonData.message;
            msgType = jsonData.type;
            showMessage(userMessage)
            
        })
        .catch(error => {
            showMessage(error)
        });
}
/**
 * 
 * Log out from a session
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
            let userMessage = jsonData.message;
            msgType = jsonData.type;
            showMessage(userMessage)
            
        })
        .catch(error => {
            showMessage(error)
        });
}

/**
 *  Login user session
 */
document.addEventListener('submit', (event) => {
    if (event.target.id === 'login-form') {
        event.preventDefault();

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
                   let userMessage = jsonData.message;
                    msgType = jsonData.type;
                   showMessage(userMessage)
            })
            .catch(error => {
                showMessage(error)
            });
    }
});

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
                console.log('Category Stat:', jsonData.categoryStat);
                console.log('media Stat:', jsonData.mediaStat);
                console.log('Manufacturers Stat:', jsonData.manufacturerStat);
                console.log('machine Stat:', jsonData.machineStat);


                // Assuming jsonData.games is an array of games
                const myGames = jsonData.games;
                const categoryStat = jsonData.categoryStat;
                const mediaStat = jsonData.mediaStat;
                // const manufacturerStat = jsonData.manufacturerStat;
                const machineStat = jsonData.machineStat;
                displayFilter(categoryStat, 'genre_filter_template', 'genre_filter');
                displayFilter(mediaStat, 'media_filter_template', 'media_filter');
                displayFilter(machineStat, 'plateform_filter_template', 'plateform_filter');



                // Continue display my games
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
            showMessage(error)
        });
}

/**
 * Sign in session
 */
document.addEventListener('submit', (event) => {
    if (event.target.id === 'registration-form') {
        event.preventDefault();

        if (validatePassword()) {
            const data = {
                action: 'signin',
                token: getToken(),

                nickname: event.target.querySelector('input[name="nickname"]').value,
                birthdate: event.target.querySelector('input[name="birthdate"]').value,
                email: event.target.querySelector('input[name="email"]').value,
                password: event.target.querySelector('input[name="password"]').value
            };
            console.log(data);

            fetchFormApi(data, "signin", "POST")
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                    }
                    return response.json();
                })

                .then(jsonData => {
                    let userMessage = jsonData.message;
                    msgType = jsonData.type;
                   showMessage(userMessage)
                })
                .catch(error => {
                    showMessage(error)
                });
        }
    }
});

/**
 * Send email for newsletter
 */
document.addEventListener('submit', (event) => {
    if (event.target.id === 'newsletter-form') {
         event.preventDefault();

            const data = {
                action: 'newsletter',
                token: getToken(),
                email: event.target.querySelector('input[name="email"]').value
            };
            console.log(data);

            fetchFormApi(data, "newsletter", "POST")
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                    }
                    return response.json();
                })

                .then(jsonData => {
                    let userMessage = jsonData.message;
                    msgType = jsonData.type;
                   showMessage(userMessage)
                })
                .catch(error => {
                    showMessage(error)
                });
        
    }
});
