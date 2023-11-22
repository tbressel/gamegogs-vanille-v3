<section class="myitems-items__container">
  <div class="login__text">
    <p>
      Connectez-vous pour gérer votre collection de jeux.
    </p>
  </div>
  <div id="login-form-container" class="form-container">
    <h2>Connexion</h2>
    <form id="login-form" method="post">
      <label for="pseudoField">Pseudo* :</label>
      <input id="pseudoField" name="pseudo" type="text" placeholder="Votre pseudo" required />
     
      <label for="passwordField">Mot de passe* :</label>
      <div class="password-container">
        <input id="passwordField" name="password" type="password" placeholder="Votre mot de passe" required />
        <span id="togglePassword">👀</span>
      </div>
      
      <button class="btn btn__color-green" type="submit">Se connecter</button>
      <button id="signup-button" class="btn btn__color-blue" type="button">S'inscrire</button>
    </form>
  </div>

  <div id="registration-form-container" class="form-container hidden__form">
    <h2>Inscription</h2>
    
    <form id="registration-form" method="post">
      <label for="nickname">Pseudo :</label>
      <input type="text" id="nickname" name="nickname" required>
      
      <label for="birthdate">Date de naissance :</label>
      <input type="date" id="birthdate" name="birthdate" required>
      
      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required>
     
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>
      
      <button type="submit">S'inscrire</button>
      <button id="login-button" class="btn btn__color-green" type="button">Se connecter</button>
   
    </form>
  </div>
</section>