<!-- <section class="collection__add hidden__view">
    
    </section> -->

<section class="collection__add hidden__view">


    <form id="collection-add-form">

    <div class="form__buttons">
    <input type="submit" value="Valider">
    <input type="reset" value="Annuler">
</div>

        <label for="title">
            <input type="text" id="title" name="title" placeholder="Titre du jeu" list="autocomplete-title" required>
            <datalist id="autocomplete-title"></datalist>

        </label>
        <label for="subtitle">
            <input type="text" id="subtitle" name="subtitle" placeholder="Sous-titre" list="autocomplete-subtitle" required>
            <datalist id="autocomplete-subtitle"></datalist>
        </label>

        <div>
            <label for="manufacturer">
                <input type="text" id="manufacturer" name="manufacturer" placeholder="fabriquant" list="autocomplete-manufacturer">
                <datalist id="autocomplete-manufacturer"></datalist>
            </label>
            <label for="machine">
                <input type="text" id="machine" name="machine" placeholder="machine" list="autocomplete-machine">
                <datalist id="autocomplete-machine"></datalist>
            </label>
            <label for="model">
                <input type="text" id="model" name="model" placeholder="modèle" list="autocomplete-model">
                <datalist id="autocomplete-model"></datalist>
            </label>

            <label for="genre">
                <input type="text" id="genre" name="genre" placeholder="genre" list="autocomplete-genre">
                <datalist id="autocomplete-genre"></datalist>
            </label>

            <label for="date_sortie">Date de sortie :</label>
            <input type="date" id="date_sortie" name="date_sortie" required><br><br>




            <div class="state__container">

                <div class="state__note">
                    <p>Neuf sous blister - mint</p>
                    <span class="green-color">note : 10 / 10</span>
                    <label for="note10"><input type="radio" name="note10" id="note10"></label>
                </div>
                <div class="state__note">
                    <p>Neuf sous blister - presque mint</p>
                    <span class="green-color">note : 9,5 / 10</span>
                    <label for="note95"><input type="radio" name="note95" id="note95"></label>
                </div>
                <div class="state__note">
                    <p>Très bon état - comme neuf</p>
                    <span class="green-color">note : 9 / 10</span>
                    <label for="note9"><input type="radio" name="note9" id="note9"></label>
                </div>
                <div class="state__note">
                    <p>Très bon état</p>
                    <span class="green-color">note : 8 / 10</span>
                    <label for="note8"><input type="radio" name="note8" id="note8"></label>
                </div>
                <div class="state__note">
                    <p>Assez bon état - il a son âge </p>
                    <span class="orange-color">note : 7/ 10</span>
                    <label for="note7"><input type="radio" name="note7" id="note7"></label>
                </div>
                <div class="state__note">
                    <p>Etat correct - il a pas mal servit</p>
                    <span class="orange-color">note : 6 / 10</span>
                    <label for="note6"><input type="radio" name="note6" id="note6"></label>
                </div>
                <div class="state__note">
                    <p>Etat moyen - marqué par le temps</p>
                    <span class="orange-color">note : 5 / 10</span>
                    <label for="note5"><input type="radio" name="note5" id="note5"></label>
                </div>
                <div class="state__note">
                    <p>Mauvais état - pas catastrophique</p>
                    <span class="orange-color">note : 4,5 / 10</span>
                    <label for="note45"><input type="radio" name="note45" id="note45"></label>
                </div>
                <div class="state__note">
                    <p>Mauvais état - il a prit cher !</p>
                    <span class="red-color">note : 4 / 10</span>
                    <label for="note4"><input type="radio" name="note4" id="note4"></label>
                </div>
                <div class="state__note">
                    <p>Très mauvais état</p>
                    <span class="red-color">note : 3 / 10</span>
                    <label for="note3"><input type="radio" name="note3" id="note3"></label>
                </div>
                <div class="state__note">
                    <p>Très mauvais état et très sale !</p>
                    <span class="red-color">note : 2 / 10</span>
                    <label for="note2"><input type="radio" name="note2" id="note2"></label>
                </div>

              
            </div>


            <label for="description">Description :</label><br>
            <textarea id="description" name="description" rows="5" cols="40"></textarea><br><br>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image"><br><br>

    </form>
</section>