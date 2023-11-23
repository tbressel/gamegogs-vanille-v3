// --------------------------------------------------------------------------------------------
// -------------------------------------     FUNCTIONS      -----------------------------------
// --------------------------------------------------------------------------------------------


// ---------------------------- MENU -------------------------------

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
 * Change arrows orientation  when clicking on main menu in desktop view
 * 
 */
function reverseProfilArrow() {
    document.getElementById('arrow-mobile').classList.toggle('down');
}


// ---------------------------- SUB MENU -------------------------------

/**
 *
 * Forcing the closure of the submenu
 *  
 */
function closeSubMenu() {
    document.querySelector(`.submenu__container .menu__ul--profil`).classList.toggle('active');
}


// ---------------------------- FILTER BAR -------------------------------

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




// --------------------------------------------------------------------------------------------
// -------------------------------------     LISTENERS      -----------------------------------
// --------------------------------------------------------------------------------------------

window.addEventListener('DOMContentLoaded', () => {


/**
 *   Listen to submenu links
 */
document.getElementById('submenu').addEventListener('click',  (event) => {
    console.log(event.target)
        if (event.target.getAttribute("data-id") === 'collection') {
            console.log('collection');
    
            // close submenu
            closeSubMenu();
    
            // delete main container
            deleteContainer('main');
    
            
            // awaiting for the page content
            insertPageContent("collection.php", "pages/collection/", "main");
            
            // get Json content
            getCollectionJson();
            // enable filter bar
            setFilterBar("collection");
    
        } else if (event.target.getAttribute("data-id") === 'logout') {
            console.log('deconnexion');
    
            // close submenu
            closeSubMenu();
    
   
            // close filter bar
            closeFilterBar();
    
            // awaiting for the page content
            logoutSession();
    
        } else if (event.target.getAttribute("data-id") === 'login') {
            console.log('connexion');
             // close submenu
             closeSubMenu();
    
             // delete main container
             deleteContainer('main');
     
             // close filter bar
             closeFilterBar();

              // awaiting for the page content
             insertPageContent("login.php", "components/login/", "main");
        } else {
            closeSubMenu();
        }




    });


})