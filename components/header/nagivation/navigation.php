<ul id="submenu" class="menu__ul--profil ">
    <li class="menu__icon collection <?php echo isset($_SESSION['pseudo']) ? '' : 'hidden__view'; ?>">
        <p data-id="collection">Ma collection</p>
    </li>
    <li class="menu__icon favorites">
        <p class="cream-alpha-color">Mes favoris</p>
    </li>
    <li class="menu__icon settings">
        <p class="cream-alpha-color">Paramètres</p>
    </li>
    <li class="menu__icon collection <?php echo isset($_SESSION['pseudo']) ? '' : 'hidden__view'; ?>">
        <p data-id="logout">Déconnexion</p>
    </li>
    <li class="menu__icon collection <?php echo isset($_SESSION['pseudo']) ? 'hidden__view' : ''; ?>">
        <p data-id="login">Connexion</p>
    </li>
    <li class="menu__icon collection <?php echo isset($_SESSION['pseudo']) ? 'hidden__view' : ''; ?>">
        <p data-id="signin">Inscription</p>
    </li>
    <li class="menu__icon collection <?php echo isset($_SESSION['pseudo']) ? '' : 'hidden__view'; ?>">
        <p data-id="signout">Se désinscrire</p>
    </li>
</ul>