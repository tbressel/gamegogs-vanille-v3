/**
 * Start listening to input text field
 */
function listenGenreField() {
    document.getElementById('add-form').addEventListener('input', (event) => {
        console.log('ecouteur de input')

        if (event.target.id === 'title') {
            fetchField(event.target.id, 'game_title', 'game_subtitle', 'game_reference', 'game');
        }

    });

}


function listenToSubmitAddForm() {
    
  // Ajoute l'écouteur de clic sur le bouton "Valider"
document.getElementById('submit-button').addEventListener('click', function(event) {

    // Empêche le comportement par défaut du bouton (envoi du formulaire)
    event.preventDefault();
 
    // Récupère les valeurs du formulaire avec FormData
    const formData = new FormData(document.getElementById('add-form'));
 
    // Exemple : Envoi des données avec Fetch API
    fetch('api.php?action=addgame', {
       method: 'POST',
       body: formData
    })
    .then(response => response.json())
    .then(data => {
       // Fais quelque chose avec la réponse si nécessaire
       console.log(data);
    })
    .catch(error => console.error('Erreur lors de l\'envoi des données :', error));
 });
 
}



/**
 * 
 * fetch the API to get categorie LIKE listened on input field
 * it has the id name in parameter to put it in option request
 * 
 * @returns object
 */
function fetchField(fieldValue, keyName, keyName2, keyName3) {
    // trim() to delete space characters
    const getInputValue = document.getElementById(fieldValue).value.trim();

    // for no value found cleaning the result field
    if (getInputValue.length === 0) {
        document.getElementById(`autocomplete-${fieldValue}`).innerHTML = '';
        return;
    }

    // fetch the API
    fetch(`api.php?action=${fieldValue}&input=${getInputValue}`)
        .then(response => response.json())
        .then(data => {

            console.log(data[`${fieldValue}`]);
             displayAutocompleteResults(data[`${fieldValue}`], fieldValue, keyName, keyName2, keyName3);
        })
        .catch(error => console.error('Error fetching data:', error));
}

/**
 * 
 * display each result under the selected field
 * 
 * @param {*} fieldValue
 * @param {*} keyName 
 */
function displayAutocompleteResults(jsonValue, fieldValue, keyName, keyName2, keyName3) {
    const datalist = document.getElementById(`autocomplete-${fieldValue}`);
    datalist.innerHTML = '';

    jsonValue.forEach(result => {
        const option = document.createElement('option');
        option.value = result[ `${keyName}` ] + ' - ' + result[ `${keyName2}` ] + ' [' + result[ `${keyName3}` ] + ']';
        datalist.appendChild(option);
    });
}


