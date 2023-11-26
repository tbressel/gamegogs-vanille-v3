// declare breadscrum
let currentPage = "accueil";

// declare collection menu states
let globalbotInfoContainer = null;
let globalNotesInfoContainer = null;
let lastIdElementClicked = "";
let msgType;




document.addEventListener('DOMContentLoaded', () => {





    
    // Loading of the last 6 games recorded in the database 
    getLastGamesJson('display-last-games', 'POST', 'Game List OK:', 'games', displayLastGames, false);






    /**
     * Listen to buttons inside each container
     */
    document.getElementById("main").addEventListener('click', (event) => {
        const clickedElement = event.target;

        if (clickedElement.getAttribute("data-id") === "arrow-img") {
            // switch class to change arrow direction
            clickedElement.classList.toggle("arrow_change");

            // And sibling top-information and then bot-informations to toggle hidden class
            const botInfoContainer = clickedElement.closest(".top-informations").nextElementSibling;
            botInfoContainer.classList.toggle('hidden');
            globalbotInfoContainer = botInfoContainer;
            closeNotesContainer(botInfoContainer);

        } else if (clickedElement.getAttribute("data-set") === "bin") {
            const id = clickedElement.getAttribute("data-id")
            fetchApi('delete', id, getToken());

        }
        //   else if (clickedElement.getAttribute("data-set") === "pen") {
        //     const elementValue = clickedElement.getAttribute('data-id');
        //     document.querySelector('['+`data-id-pen="${elementValue}"`+']').classList.toggle('hidden');
        //     }

        else if (clickedElement.getAttribute('data-id') === "notif-btn") {

            const notifContainer = document.querySelector('.notif__container');
            if (notifContainer) {
                notifContainer.classList.add('hidden__notif');
            }
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

    });


});
