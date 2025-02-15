<section class="editLivre">
    <a href="monCompte"><i class="fa-solid fa-arrow-left"></i> retour</a>
    <h1>Modifier les informations</h1>
    <section class="editMain">
        <section class="previewImageLivre">
            <div class="overlay hidden"></div>
            <section class="modal hidden">
                <img id="preview" src="" alt="">    
                <input type="file" id="image" name="image">
                <input type="button" id="btnChoix" value="Choisisseez l'image du livre">
                <button class="closeModal">Valider</button>
            </section>
    
            <span>Photo</span>
            <img id="newImage" src=<?= "./Front/images/livres/" . $livre->getImage() ?> alt="Image du livre <?= $livre->getTitre() ?>">
            <button class="openModal">modifier la photo</button>
        </section>
        <section id="containerForm">
            <form action="updateLivre" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idLivre" id="idLivre" value="<?= $livre->getId() ?>"/>
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" value="<?= $livre->getTitre() ?>"/>
                <label for="auteur">Auteur</label>
                <input type="text" id="auteur" name="auteur" value="<?= $livre->getAuteur() ?>"/>
                <label for="description">Commentaire</label>
                <textarea id="description" name="description"><?= $livre->getDescription() ?>
                </textarea>
                <label for="statut">Disponibilité</label>
                <select name="statut" id="statut">
                    <option value="1" <?php if ($livre->getStatutBool()) { ?> selected <?php } ?>>
                        Disponible
                    </option>
                    <option value="0" <?php if (!$livre->getStatutBool()) { ?> selected <?php } ?>>
                        Indisponible
                    </option>
                </select>
                <input type="submit" value="Valider" class="submit"/>
            </form>
        </section>
    </section>
</section>