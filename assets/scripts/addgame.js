/**
 * Start listening to input text field
 */
function listenGenreField() {
    document.getElementById('collection-add-form').addEventListener('input', (event) => {
        if (event.target.id === 'title') {
            fetchField(event.target.id, 'game_title');
        }
        if (event.target.id === 'subtitle') {
            fetchField(event.target.id, 'game_subtitle');
        }

        if (event.target.id === 'genre') {
            fetchField(event.target.id, 'category_name');
        }

        if (event.target.id === 'manufacturer') {
            fetchField(event.target.id, 'manufacturer_name');
        }
        if (event.target.id === 'machine') {
            fetchField(event.target.id, 'machine_name');
        }
        if (event.target.id === 'model') {
            fetchField(event.target.id, 'machine_model');
        }
    });
}


/**
 * 
 * fetch the API to get categorie LIKE listened on input field
 * it has the id name in parameter to put it in option request
 * 
 * @returns object
 */
function fetchField(fieldValue, keyName) {
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
             displayAutocompleteResults(data[`${fieldValue}`], fieldValue, keyName);
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
function displayAutocompleteResults(jsonValue, fieldValue,keyName) {
    const datalist = document.getElementById(`autocomplete-${fieldValue}`);
    datalist.innerHTML = '';

    jsonValue.forEach(result => {
        const option = document.createElement('option');
        option.value = result[`${keyName}`];
        datalist.appendChild(option);
    });
}


