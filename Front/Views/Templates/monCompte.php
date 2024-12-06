<?php 
    $formData = array (
        "action" => "changeinfo",
        "label" => ["Email", "Mot de passe", "Pseudo"],
        "input" => ["Email", "password", "pseudo"],
        "type" => ["email", "password", "text"],
        "value" => [$user->getEmail(), $user->getPassword(), $user->getPseudo()],
        "submit" => "Enregistrer"
    );
    $paramsForm = array("component" => "form", "formData" => $formData);

    $buttonData = array (
        "action" => "showAddLivre",
        "value" => "Ajouter un livre"
    );
    $paramsBtn = array("component" => "button", "buttonData" => $buttonData);
?>

<h1>Mon compte</h1>

<div class="compteInfo">
    <section class="compte">
        <h2><?= $user->getPseudo(); ?></h2>
        <p>Membre depuis <?= $user->getDateCreation(); ?></p>
        <span>Bibliothèque</span>
    </section>

    <section class="infoPerso">
        <h2>Vos informations personnelles</h2>
        <?= TomTroc\Front\Components\Component::render($paramsForm) ?>
    </section>
</div>


<section class="tableau">
    <?= TomTroc\Front\Components\Component::render($paramsBtn) ?>

    <table>
        <tr>
            <th>Photo</th>
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
                        ]
                    ]
                );
                $editBtn = array (
                    "component" => "button",
                    "buttonData" => [
                    "action" => "editLivre",
                    "value" => "éditer",
                    "hidden" => [
                        ["name" => "idLivre", "value" => $livre->getId()]
                        ]
                    ]
                );

        ?>
            <tr>
                <td><img src=<?= "./Front/images/livres/" . $livre->getImage() ?>></td>
                <td><?= $livre->getTitre() ?></td>
                <td><?= $livre->getAuteur() ?></td>
                <td><?= $livre->getDescription() ?></td>
                <td><?= $livre->getStatut() ?></td>
                <td>
                    <?= TomTroc\Front\Components\Component::render($editBtn) ?>
                    <?= TomTroc\Front\Components\Component::render($deleteBtn) ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</section>