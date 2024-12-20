<section class="editLivre">
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
    
            <label for="photo">Photo</label>
            <img src=<?= "./Front/images/livres/" . $livre->getImage() ?>>
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
                    <option value="true" <?php if ($livre->getStatut()) { ?> selected <?php } ?>>
                        Disponible
                    </option>
                    <option value="false" <?php if (!$livre->getStatut()) { ?> selected <?php } ?>>
                        Indisponible
                    </option>
                </select>
                <input type="submit" value="Valider" class="submit"/>
            </form>
        </section>
    </section>
</section>