<section class="detailLivre">
    <h1>Modifier les informations</h1>
    <form action="updateLivre" method="post">
        <label for="photo">Photo</label>
        <img src=<?= "./Front/images/livres/" . $livre->getImage() ?>>
        <input type="file" id="image" name="image"/>

        <section class="infoLivre">
            <input type="hidden" name="idLivre" id="idLivre" value="<?= $livre->getId() ?>"/>
            <label for="photo">Titre</label>
            <input type="text" id="titre" name="titre" value="<?= $livre->getTitre() ?>"/>
            <label for="auteur">Auteur</label>
            <input type="text" id="auteur" name="auteur" value="<?= $livre->getAuteur() ?>"/>
            <label for="description">Commentaire</label>
            <textarea id="description" name="description"><?= $livre->getDescription() ?>
            </textarea>
            <label for="statut">Disponibilité</label>
            <select name="statut" id="statut">
                <option value="true" <?php if ($livre->getStatut()) { ?> selected <?php } ?>>
                    Disponible
                </option>
                <option value="false" <?php if (!$livre->getStatut()) { ?> selected <?php } ?>>
                    Indisponible
                </option>
            </select>
        </section>
        <input type="submit" value="Valider"/>
    </form>
</section>