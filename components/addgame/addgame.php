
    <form>
        <label for="nom">Nom du jeu :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="plateforme">Plateforme :</label>
        <select id="plateforme" name="plateforme">
            <option value="pc">PC</option>
            <option value="playstation">PlayStation</option>
            <option value="xbox">Xbox</option>
            <option value="nintendo">Nintendo</option>
            <option value="autre">Autre</option>
        </select><br><br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre" required><br><br>

        <label for="date_sortie">Date de sortie :</label>
        <input type="date" id="date_sortie" name="date_sortie" required><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="5" cols="40"></textarea><br><br>

        <label for="image">Image :</label>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" value="Soumettre">
    </form>