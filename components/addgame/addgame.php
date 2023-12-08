<section id="test" class="collection__add hidden__view">

    <form id="add-form" method="post ">


        <div class="form__buttons">
            <button id="submit-button" type="button">Valider</button>
            <button type="reset">Annuler</button>
        </div>

        <label for="title">
            <input type="text" id="title" name="title" placeholder="Titre du jeu" list="autocomplete-title" required>
            <datalist id="autocomplete-title"></datalist>
        </label>
        <!-- <label for="subtitle">
            <input type="text" id="subtitle" name="subtitle" placeholder="Sous-titre" list="autocomplete-subtitle" required>
            <datalist id="autocomplete-subtitle"></datalist>
        </label> -->


        <!-- <div class="form__plateform">
            <label for="model">
                <input type="text" id="model" name="model" placeholder="modèle" list="autocomplete-model">
                <datalist id="autocomplete-model"></datalist>
            </label>
            <label for="media">
                <select id="media" name="media">
                    <option value="" disabled selected hidden>support</option>
                </select>
            </label>
        </div> -->



        <!-- <div class="form__genre">
            <div class="form__genre--choice">
                <input type="checkbox" id="combat" name="genre[]" value="Combat">
                <label for="combat">Combat</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="beat_em_up" name="genre[]" value="Beat em up">
                <label for="beat_em_up">Beat em up</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="course" name="genre[]" value="Course">
                <label for="course">Course</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="action" name="genre[]" value="Action">
                <label for="action">Action</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="strategie" name="genre[]" value="Stratégie">
                <label for="strategie">Stratégie</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="rpg" name="genre[]" value="RPG">
                <label for="rpg">RPG</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="fps" name="genre[]" value="FPS">
                <label for="fps">FPS</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="simulation" name="genre[]" value="Simulation">
                <label for="simulation">Simulation</label>
            </div>
            <div class="form__genre--choice">
                <input type="checkbox" id="plateforme" name="genre[]" value="Plateforme">
                <label for="plateforme">Plateforme</label>
            </div>

        </div> -->
<!-- 

        <div class="form__origin">
            <label for="country">
                <input type="text" id="country" name="country" placeholder="country" list="autocomplete-country">
                <datalist id="autocomplete-country"></datalist>
            </label>
            <label for="editor">
                <input type="text" id="editor" name="editor" placeholder="editor" list="autocomplete-editor">
                <datalist id="autocomplete-editor"></datalist>
            </label>

            <label for="date_sortie"></label>
            <input type="date" id="date_sortie" name="date_sortie" required><br><br>
        </div> -->

        <label for="price">
            <input type="text" id="price" name="price" placeholder="price">
        </label>

        <div class="state__container">

            <div class="state__container--comment">
                <p>Neuf sous blister - mint</p>
                <p>Neuf sous blister - presque mint</p>
                <p>Très bon état - comme neuf</p>
                <p>Très bon état</p>
                <p>Assez bon état - il a son âge </p>
                <p>Etat correct - il a pas mal servit</p>
                <p>Etat moyen - marqué par le temps</p>
                <p>Mauvais état - pas catastrophique</p>
                <p>Mauvais état - il a prit cher !</p>
                <p>Très mauvais état</p>
                <p>Très mauvais état et très sale !</p>
            </div>

            <div class="state__container--note">
                <p class="green-color">note : 10 / 10</p>
                <p class="green-color">note : 9,5 / 10</p>
                <p class="green-color">note : 9 / 10</p>
                <p class="green-color">note : 8 / 10</p>
                <p class="orange-color">note : 7 / 10</p>
                <p class="orange-color">note : 6 / 10</p>
                <p class="orange-color">note : 5 / 10</p>
                <p class="orange-color">note : 4,5 / 10</p>
                <p class="red-color">note : 4 / 10</p>
                <p class="red-color">note : 3 / 10</p>
                <p class="red-color">note : 2 / 10</p>
            </div>

            <div class="state__container--radio">
                <label for="12"><input type="radio" name="note" id="12" value="12"></label>
                <label for="11"><input type="radio" name="note" id="11" value="11"></label>
                <label for="10"><input type="radio" name="note" id="10" value="10"></label>
                <label for="9"><input type="radio" name="note" id="9" value="9"></label>
                <label for="8"><input type="radio" name="note" id="8" value="8"></label>
                <label for="7"><input type="radio" name="note" id="7" value="7"></label>
                <label for="6"><input type="radio" name="note" id="6" value="6"></label>
                <label for="5"><input type="radio" name="note" id="5" value="5"></label>
                <label for="4"><input type="radio" name="note" id="4" value="4"></label>
                <label for="3"><input type="radio" name="note" id="3" value="3"></label>
                <label for="2"><input type="radio" name="note" id="2" value="2"></label>
            </div>


        </div>

        <!-- 
        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="5" cols="40"></textarea><br><br>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image"><br><br> -->

    </form>
</section>