// -------------------------------------------------------------------------
// ------------------------------  LISTENERS   -----------------------------
// -------------------------------------------------------------------------
/**
 * Listener on display or hide password
 */
document.getElementById('main').addEventListener('click', function (event) {

  console.log(event.target)
  
if (event.target.id === 'password') {

  password();

} 


  if (event.target.id === 'togglePassword') {
    const passwordInput = document.getElementById('passwordField');
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
  
    } else {
      passwordInput.type = 'password';
    }
  }
});



/**
 * Listener to switch classes to hide of display login form or signin form
 */
const mainContainer = document.getElementById('main');

mainContainer.addEventListener('click', function (event) {

  const loginFormContainer = document.getElementById('login-form-container');
  const registrationFormContainer = document.getElementById('registration-form-container');
  
  if (event.target.id === 'signup-button') {
    toggleSubmenuText(loginFormContainer, registrationFormContainer);

  } else if (event.target.id === 'login-button') {
    toggleSubmenuText(registrationFormContainer, loginFormContainer);
  }
});



// -------------------------------------------------------------------------
// ------------------------------  FUNCTIONS   -----------------------------
// -------------------------------------------------------------------------
/**
 * 
 * Toggle classes beetween 2 DOM element 
 * 
 * @param {DOM element} formToShow 
 * @param {DOM element} formToHide 
 */
function toggleSubmenuText(formToShow, formToHide) {
  formToShow.classList.toggle('hidden__form');
  formToHide.classList.toggle('hidden__form');
}


/**
 * 
 * Return a boolean depends 
 * 
 * @returns 
 */
function validatePassword() {
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirmPassword");
  let confirmPasswordValue = confirmPassword.value;

  if (password !== confirmPasswordValue) {
    confirmPassword.classList.add("invalid-password");
    alert("Les mots de passe ne correspondent pas.");
    return false;
  } else {
    confirmPassword.classList.remove("invalid-password");
  }

  return true;
}

