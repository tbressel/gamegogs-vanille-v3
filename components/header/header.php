<?php
echo (' <div class="header__container black-bg">
            <div class="header__container--top">
                <div class="header__container--brandname">

                    <div class="brandname__top">
                        <div class="brandname__top--joystick">
                            <img src="./assets/svg/joystick.svg" alt="joystick icon">
                        </div>
                        <div class="brandname__top--title">
                            <a href="./includes/dbconnect.php"><img src="./assets/svg/gamegog-logo.svg" alt="gamegog logo"></a>
                        </div>
                    </div>

                    <div class="brandname__bot">
                        <div class="brandname__bot--hook">
                            <img src="./assets/svg/hook.svg" alt="la chasse aux tresors">
                        </div>
                    </div>

                </div>
                <div id="burger-btn" class="header__container--burger">
                    <img src="./assets/svg/burger-icon.svg" alt="burger icon" data-set="menu__ul--profil">
                </div>
            </div>
            <div class="header__container--bot">
                <div class="header__container--searchfield">
                    <form action="#">
                        <label for="search">
                            <input class="field-search white-bg" id="search" type="search"
                                placeholder="Recherche GameGogs">
                        </label>
                    </form>

                </div>
                <div class="header__container--zoom">
                    <img src="./assets/svg/zoom-icon.svg" alt="search on gamegogs">
                </div>
            </div>
            <div class="header__container--menu">
                <ul class="menu__ul  black-bg">
                    <li class="menu__icon dashboard">
                        <img src="./assets/svg/dashboard-icon.svg" alt="dashboard">
                    </li>
                    <li class="menu__icon mail">
                        <img src="./assets/svg/mail-icon.svg" alt="mail">
                    </li>
                    <li class="menu__icon cart">
                        <img src="./assets/svg/cart-icon.svg" alt="cart">
                    </li>
                    <li id="profilarrow-btn-mobile" class="menu__icon profilarrow" data-set="menu__ul--profil">
                        <img src="./assets/svg/profil_icon.svg" alt="profil" data-set="menu__ul--profil">
                        <img id="arrow-mobile" class="" src="./assets/svg/arrowprofil-icon.svg" alt="arrow"
                            data-set="menu__ul--profil">
                    </li>
                </ul>
            </div>
        </div>');