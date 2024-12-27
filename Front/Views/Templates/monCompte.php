<?php 
    $formData = array (
        "action" => "changeInfo",
        "label" => ["Email", "Mot de passe", "Pseudo"],
        "input" => ["Email", "password", "pseudo"],
        "type" => ["email", "password", "text"],
        "placeholder" => [$user->getEmail(), "••••••••", $user->getPseudo()],
        "submit" => "Enregistrer"
    );
    $paramsForm = array("component" => "form", "formData" => $formData);
?>

<section class="monCompte">
    <h1>Mon compte</h1>

    <section class="compteInfo">
        <div class="compte">
            <div>
                <img class="photoProfil" src="./Front/images/profils/<?= $user->getPhoto() ?>" alt="" >
                <button class="openModal">modifier</button>
                <div class="overlay hidden"></div>
                <section class="modal hidden">
                    <img id="preview" src="" alt="">
                    <input type="file" id="image" name="image">
                    <input type="button" id="btnChoix" value="Choisissez votre photo de profil">
                    <button class="closeModal">Valider</button>
                </section>
            </div>
            <div>
                <h2><?= $user->getPseudo(); ?></h2>
                <p>Membre depuis <?= $user->getDateCreation(); ?></p>
                <span>Bibliothèque</span>
            </div>
        </div>
        
        <div class="infoPerso" id="containerForm">
            <h2>Vos informations personnelles</h2>
            <?= TomTroc\Front\Components\Component::render($paramsForm) ?>
        </div>
    </section>
</section>

<section class="tableau">
    <a href="showAddLivre" class="greenLink">Ajouter un livre</a>

    <table>
        <tr>
            <th class="first">Photo</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Description</th>
            <th>Disponibilité</th>
            <th>Action</th>
        </tr>

        <?php foreach($livres as $index => $livre) { ?>
            <tr class="<?= TomTroc\Services\Utils::changeColorTableau($index) ?>">
                <td class="first"><img src=<?= "./Front/images/livres/" . $livre->getImage() ?>></td>
                <td><?= $livre->getTitre() ?></td>
                <td><?= $livre->getAuteur() ?></td>
                <td><?= $livre->getDescription() ?></td>
                <td class="<?= $livre->getStatut() ?>"><p><?= $livre->getStatut() ?></p></td>
                <td>
                    <a href="editLivre&idLivre=<?= $livre->getId() ?>" class="editLink <?= TomTroc\Services\Utils::changeColorTableau($index)?>">éditer</a>
                    <a href="deleteLivre&idLivre=<?= $livre->getId() ?>&image=<?= $livre->getImage() ?>" 
                    class="supprimerLink <?= TomTroc\Services\Utils::changeColorTableau($index)?>">supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>