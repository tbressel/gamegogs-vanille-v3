// declare breadscrum
let currentPage = "accueil";

// declare collection menu states
let globalbotInfoContainer = null;
let globalNotesInfoContainer = null;
let lastIdElementClicked = "";
let msgType;


document.addEventListener('DOMContentLoaded', () => {

  

    getLastGamesJson('display-last-games', 'POST', 'Game List OK:','games',displayLastGames,false);





    /**
     * Listen to each view button in collection user. And switch class to display the right one. 
     */
    document.getElementById('filter-nav').addEventListener('click', (event) => {

        if (event.target.getAttribute('alt') === "view1") {
            closeAllView();
            document.querySelector('.collection__view1').classList.toggle('hidden__view')

        } else if (event.target.getAttribute('alt') === "view2") {
            closeAllView();
            document.querySelector('.collection__view2').classList.toggle('hidden__view')

        } else if (event.target.getAttribute('alt') === "view3") {
            closeAllView();
            document.querySelector('.collection__view3').classList.toggle('hidden__view')

        } else if (event.target.getAttribute('data-btn-filter') === "") {
            document.getElementById('overlay-filter').classList.toggle('show');
        } 
    })




    /**
     * Listen to buttons inside each container
     */
    document.getElementById("main").addEventListener('click', (event) => {
        console.log(event.target)

        if (event.target.getAttribute("data-id") === "arrow-img") {

            // switch class to change arrow direction
            event.target.classList.toggle("arrow_change");

            // And sibling top-information and then bot-informations to toggle hidden class
            let botInfoContainer = event.target.closest(".top-informations").nextElementSibling.classList.toggle('hidden');
            globalbotInfoContainer = botInfoContainer;
            closeNotesContainer(botInfoContainer);

        } else if (event.target.getAttribute("data-set") === "bin") {
            const id = event.target.getAttribute("data-id")
            fetchApi('delete', id, getToken());

        } else if (event.target.getAttribute("data-set") === "pen") {
            lastIdElementClicked = event.target.getAttribute("data-id");
            document.getElementById(lastIdElementClicked).classList.toggle('hidden');

        } else if (event.target.getAttribute('data-id') === "notif-btn") {
            document.querySelector('.notif__container').classList.add('hidden__notif');
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













