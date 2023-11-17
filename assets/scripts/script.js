// declare breadscrum
let currentPage = "accueil";

// Listen to burger button
document.getElementById('burger-btn').addEventListener('click', (event) => {
    toggleSubMenu(event);
})

// listen to profil bar button
document.getElementById('profilarrow-btn-mobile').addEventListener('click', (event) => {
    toggleSubMenu(event);
})

// listen to arrows on footer menu
document.getElementById('footer-menu').addEventListener('click', (event) => {
    if (event.target.getAttribute("alt") !== "arrow") return
    displayFooterMenu(event);
    reverseFooterArrow(event);
})

// Listen to Collection menu in main menu
document.getElementById('collection').addEventListener('click', async () => {
    // close submenu
    closeSubMenu();

    // delete main container
    deleteContainer('main');

    // enable filter bar
    setFilterBar("collection");

    // awaiting for the page content
    await insertPageContent("collection.php", "pages/collection/", "main");
   
})


document.getElementById('filter-nav').addEventListener('click', (event) => {
    console.log(event.target)
  
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

let globalbotInfoContainer = null;
let globalNotesInfoContainer = null;

// Listen if any arrow-img is clicked
document.getElementById("main").addEventListener('click', (event) => {
    console.log(event.target);


    if (event.target.getAttribute("id") === "arrow-img") {

        // switch class to change arrow direction
        event.target.classList.toggle("arrow_change");

        // And sibling top-information and then bot-informations to toggle hidden class
        let botInfoContainer = event.target.closest(".top-informations").nextElementSibling;
        console.log('Element ciblé : ', botInfoContainer);
        botInfoContainer.classList.toggle('hidden');
        globalbotInfoContainer = botInfoContainer;
        closeNotesContainer(botInfoContainer)
    }
    // Lisen if inside this event the element edit-note is clicked
    if (event.target.getAttribute("id") === "edit-notes") {

        // The sibling parent element 
        let notesInfoContainer = event.target.closest('.bot-informations').nextElementSibling;
        console.log('Element ciblé : ', notesInfoContainer);
        notesInfoContainer.classList.toggle('hidden');
    };

    if (event.target.getAttribute('id') === 'textarea-erase') {
        event.preventDefault();
        eraseTextareaContent(event.target);
        closeNotesContainer(globalbotInfoContainer);
    }
})

