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

    $buttonData = array (
        "action" => "showAddLivre",
        "value" => "Ajouter un livre",
        "class" => "greenBtn"
    );
    $paramsBtn = array("component" => "button", "buttonData" => $buttonData);
?>

<section class="monCompte">
    <h1>Mon compte</h1>

    <section class="compteInfo">
        <div class="compte">
            <div>
                <button class="openModal">modifier</button>
                <div class="overlay hidden"></div>
                <section class="modal hidden">
                    <img>
                    <input type="file" id="photo" name="photo">
                    <input type="button" id="btn" value="Choisisseez votre photo de profil">
                    <button class="closeModal">Valider</button>
                </section>
            </div>
            <div>
                <h2><?= $user->getPseudo(); ?></h2>
                <p>Membre depuis <?= $user->getDateCreation(); ?></p>
                <span>Bibliothèque</span>
            </div>
        </div>
        
        <div class="infoPerso">
            <h2>Vos informations personnelles</h2>
            <?= TomTroc\Front\Components\Component::render($paramsForm) ?>
        </div>
    </section>
</section>

<section class="tableau">
    <?= TomTroc\Front\Components\Component::render($paramsBtn) ?>

    <table>
        <tr>
            <th class="first">Photo</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Description</th>
            <th>Disponibilité</th>
            <th>Action</th>
        </tr>

        <?php foreach($livres as $index => $livre) { 
                $deleteBtn = array (
                    "component" => "button",
                    "buttonData" => [
                    "action" => "deleteLivre",
                    "value" => "supprimer",
                    "hidden" => [
                            ["name" => "idLivre", "value" => $livre->getId()],
                            ["name" => "image", "value" => $livre->getImage()]
                        ],
                    "class" => "supprimerBtn " . TomTroc\Services\Utils::changeColor($index) 
                    ]
                );
                $editBtn = array (
                    "component" => "button",
                    "buttonData" => [
                    "action" => "editLivre",
                    "value" => "éditer",
                    "hidden" => [
                            ["name" => "idLivre", "value" => $livre->getId()]
                        ],
                    "class" => "editBtn " . TomTroc\Services\Utils::changeColor($index)
                    ]
                );

        ?>
            <tr class="<?= TomTroc\Services\Utils::changeColor($index) ?>">
                <td class="first"><img src=<?= "./Front/images/livres/" . $livre->getImage() ?>></td>
                <td><?= $livre->getTitre() ?></td>
                <td><?= $livre->getAuteur() ?></td>
                <td><?= $livre->getDescription() ?></td>
                <td class="<?= $livre->getStatut() ?>"><p><?= $livre->getStatut() ?></p></td>
                <td>
                    <?= TomTroc\Front\Components\Component::render($editBtn) ?>
                    <?= TomTroc\Front\Components\Component::render($deleteBtn) ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>