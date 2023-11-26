




function password() {

    
    const passwordStrength = document.getElementById('passwordStrength');
    console.log(passwordStrength)

    const passwordInput = document.getElementById('password');
    console.log(passwordInput);

    const confirmPasswordInput = document.getElementById('confirmPassword');
    console.log(confirmPasswordInput);

    const strengthText = document.getElementById('strengthText');
    const passwordRegex = [
        /\d/, // Au moins un chiffre
        /[a-z]/, // Au moins une lettre minuscule
        /[A-Z]/, // Au moins une lettre majuscule
        /[^a-zA-Z\d]/, // Au moins un caractère spécial
    ];
    
    // Attacher les gestionnaires d'événements
    passwordInput.addEventListener('input', checkPasswordStrength);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    
    
    
    
    /**
     * 
    */
   function checkPasswordStrength() {
       const password = passwordInput.value;
       let strength = 0;
       
       passwordRegex.forEach(regex => {
           if (regex.test(password)) {
               strength++;
            }
        });
        
        const percentage = (strength / passwordRegex.length) * 100;
        passwordStrength.style.width = percentage + '%';
        passwordStrength.style.background = getColorForStrength(percentage);
        
        // Affichage du texte de force
        strengthText.textContent = getStrengthText(strength);
    }
    
    
    
    
    /**
     * 
    */
   function checkPasswordMatch() {
       const password = passwordInput.value;
       const confirmPassword = confirmPasswordInput.value;
       
       if (password === confirmPassword) {
           confirmPasswordInput.setCustomValidity('');
        } else {
            confirmPasswordInput.setCustomValidity('Les mots de passe ne correspondent pas.');
        }
    }
    
    
    
    
    
    /**
     * 
     * @param {*} percentage 
     * @returns 
    */
   function getColorForStrength(percentage) {
       const red = Math.min(255, Math.round((100 - percentage) * 5.1));
       const green = Math.min(255, Math.round(percentage * 5.1));
       return `rgb(${red}, ${green}, 0)`;
    }
    
    
    
    
    /**
     * 
     * @param {*} strength 
     * @returns 
    */
   function getStrengthText(strength) {
       switch (strength) {
           case 0:
               return 'Très faible';
               case 1:
                   return 'Faible';
                   case 2:
                       return 'Moyenne';
                       case 3:
                           return 'Forte';
                           case 4:
                               return 'Très forte';
                               default:
                                   return '';
                                }
                            }
                        }