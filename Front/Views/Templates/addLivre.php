<section class="editLivre">
    <h1>Modifier les informations</h1>
    <section class="editMain">
        <section class="previewImageLivre">
            <div class="overlay hidden"></div>
            <section class="modal hidden">
                <img id="preview" src="" alt="">    
                <input type="file" id="image" name="image">
                <input type="button" id="btnChoix" value="Choisissez l'image du livre">
                <button class="closeModal">Valider</button>
            </section>
    
            <label for="photo">Photo</label>
            <img id="imageLivre" src="" alt=""> 
            <button class="openModal">modifier la photo</button>
        </section>
        <section id="containerForm">
            <form action="addLivre" method="post" enctype="multipart/form-data">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre"/>
                <label for="auteur">Auteur</label>
                <input type="text" id="auteur" name="auteur"/>
                <label for="description">Commentaire</label>
                <textarea id="description" name="description"></textarea>
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
            </form>
        </section>
    </section>
</section>