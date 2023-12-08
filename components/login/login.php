<section>
  <div id="login-form-container" class="login__container black-bg ">
    <div>
      <button id="signup-button" class="btn btn__color-blue" type="text">S'inscrire</button>
    </div>
    <div class="login__text">
      <p>
        Connectez-vous pour gérer votre collection de jeux.
      </p>
    </div>
    <form class="login__form" id="login-form" method="post">
      <label for="pseudoField">Pseudo* :
        <input id="pseudoField" name="pseudo" type="text" placeholder="Votre pseudo" required autocomplete="username" />
      </label>

      <div class="password-container">
          <label for="passwordField">Mot de passe* :
          <input id="passwordField" name="password" type="password" placeholder="Votre mot de passe" required autocomplete="current-password" />
          <span ><img id="togglePassword" class="password__eye" src="./assets/svg/eye.svg" alt=""></span>
        </div>
      </label>
      <ul>
        <li>
          <button class="btn btn__color-green" type="submit">Se connecter</button>
        </li>
        <!-- <li>
          <button id="signup-button" class="btn btn__color-blue" type="button">S'inscrire</button>
        </li> -->
      </ul>
    </form>
  </div>

  <div id="registration-form-container" class="login__container black-bg hidden__form">
    <div>
      <button id="login-button" class="btn btn__color-blue" type="button">Se connecter</button>
    </div>
    <form class="signin__form" id="registration-form" method="post">
      <label for="nickname">Pseudo :
        <input type="text" id="nickname" name="nickname" required autocomplete="username">
      </label>

      <label for="birthdate">Date de naissance :
        <input type="date" id="birthdate" name="birthdate" required autocomplete="birthdate">
      </label>
      <label for="email">Email :
        <input type="email" id="email" name="email" required autocomplete="email">
      </label>
      <label for="password">Mot de passe* :
        <input type="password" id="password" name="password" minlength="1" placeholder="Votre mot de passe" required autocomplete="current-password" />
      </label>
      <label for="confirmPassword">Confirmer le mot de passe* :
        <input type="password" id="confirmPassword" name="confirmPassword" minlength="1" placeholder="Confirmez votre mot de passe" required />
      </label>

      <ul>
        <li>
          <button class="btn btn__color-green" type="submit">S'inscrire</button>
        </li>
      </ul>
    </form>
    <div class="rgpd">
      <p>
        En cliquant sur « S'inscrire », vous confirmez que vous acceptez les Conditions générales d'utilisation et notre Politique de confidentialité qui vous informe des modalités de traitement de vos données personnelles ainsi que de vos droits sur ces données.
      </p>
      <p>
        Votre adresse email nous sert exclusivement à vous adresser les newsletters qui vous intéressent. Conformément à la loi, vous disposez d'un droit d'accès, de rectifications et d'opposition, en vous connectant à votre compte.
      </p>
    </div>
  </div>
</section>