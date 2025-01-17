<?php 
    $formData = array (
        "action" => "changeInfo",
        "class" => "containerForm",
        "label" => ["Adresse email", "Mot de passe", "Pseudo"],
        "input" => ["email", "password", "pseudo"],
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
            <div class="compteImg">
                <?php if ($user->getPhoto() != null) { ?>
                    <img class="photoProfil" id="newImage" src="./Front/images/profils/<?= $user->getPhoto() ?>" alt="" >
                <?php } else { ?>
                    <img class="photoProfil" id="newImage" src="" alt="" >
                <?php } ?>
                <button class="openModal">modifier</button>
                <div class="overlay hidden"></div>
                <section class="modal hidden">
                    <img id="preview" src="" alt="">
                    <input type="file" id="image" name="image">
                    <input type="button" id="btnChoix" value="Choisissez votre photo de profil">
                    <button class="closeModal">Valider</button>
                </section>
            </div>
            <div class="compteLivre">
                <h2><?= $user->getPseudo(); ?></h2>
                <p id="date">Membre depuis <?= date_diff($user->getDateCreationDateTime(), date_create(date('Y-m-d H:i:s')))->format('%Y ans et %m mois'); ?></p>
                <p id="bibliotheque">Bibliothèque</p>
                <p> <?= TomTroc\Front\Components\Component::renderIcon("iconLivre") ?> <?= count($livres) ?> livres<p>
            </div>
        </div>
        
        <div class="infoPerso" id="containerForm">
            <h2>Vos informations personnelles</h2>
            <?= TomTroc\Front\Components\Component::render($paramsForm) ?>
        </div>
    </section>
</section>

<section class="tableau">
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
                <td><div><?= $livre->getDescription() ?></div></td>
                <td class="<?= $livre->getStatut() ?>"><p><?= $livre->getStatut() ?></p></td>
                <td>
                    <a href="editLivre&idLivre=<?= $livre->getId() ?>" class="editLink <?= TomTroc\Services\Utils::changeColorTableau($index)?>">Éditer</a>
                    <a href="deleteLivre&idLivre=<?= $livre->getId() ?>&image=<?= $livre->getImage() ?>" 
                    class="supprimerLink <?= TomTroc\Services\Utils::changeColorTableau($index)?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="showAddLivre" class="greenLink">Ajouter un livre</a>
    </section>