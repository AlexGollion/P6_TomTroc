<section class="editLivre">
    <h1>Ajouter un livre</h1>
    <form action="updateLivre" method="post">
        <section class="imgLivre">
            <label for="photo">Photo</label>
            <input type="file" id="image" name="image"/>
        </section>

        <section class="infoLivre">
            <input type="hidden" name="idLivre" id="idLivre"/>
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre"/>
            <label for="auteur">Auteur</label>
            <input type="text" id="auteur" name="auteur"/>
            <label for="description">Commentaire</label>
            <textarea id="description" name="description">
            </textarea>
            <label for="statut">Disponibilité</label>
            <select name="statut" id="statut">
                <option value="true">
                    Disponible
                </option>
                <option value="false">
                    Indisponible
                </option>
            </select>
            <input type="submit" value="Valider" class="submit"/>
        </section>
    </form>
</section>
