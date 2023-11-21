document.getElementById('main').addEventListener('click', function (event) {

    console.log(event.target)
    
        if (event.target.id === 'togglePassword') {
          
    
        const passwordInput = document.getElementById('passwordField');
         if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
          } else {
            passwordInput.type = 'password';
          }
    
        }
    });
    
    function toggleConnexionForms() {
        
        const mainContainer = document.getElementById('main');
        mainContainer.addEventListener('click', function(event) {
            const loginFormContainer = document.getElementById('login-form-container');
            const registrationFormContainer = document.getElementById('registration-form-container');
          const target = event.target;
          
          if (target.id === 'signup-button') {
            toggleFormVisibility(loginFormContainer, registrationFormContainer);
          } else if (target.id === 'login-button') {
            toggleFormVisibility(registrationFormContainer, loginFormContainer);
          }
        });
        
        function toggleFormVisibility(formToShow, formToHide) {
          formToShow.classList.toggle('hidden__form');
          formToHide.classList.toggle('hidden__form');
        }
      }