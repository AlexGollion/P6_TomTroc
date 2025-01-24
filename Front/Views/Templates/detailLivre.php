<?php 
    $messageBtn = array (
        "component" => "button",
        "buttonData" => [
            "action" => "newMessagerie",
            "value" => "Envoyer un message",
            "hidden" => [
                ["name" => "idUserLivre", "value" => $user->getId()]
            ],
            "class" => "button greenLink"
        ]
    );
?>

<section class="detailLivre">
    <p>Nos livres > <?= $livre->getTitre() ?></p>
    <div class="detailLivreContent">
        <img src=<?= "./Front/images/livres/" . $livre->getImage() ?>>
        <section class="infoLivre">
            <h1><?= $livre->getTitre() ?></h1>
            <p id="auteur">par <?= $livre->getAuteur() ?></p>
            <hr />
            <h2>DESCRIPTION</h2>
            <p id="description"><?= $livre->getDescription() ?></p>
            <h2>PROPRIETAIRE</h2>
            <a href="comptePublic&userId=<?= $user->getId() ?>" class="proprietaire">
                <?php if ($user->getPhoto() != null) { ?>
                    <img src=<?= "./Front/images/profils/" . $user->getPhoto() ?>>
                <?php } ?>
                <span><?= $user->getPseudo() ?></span>
            </a>
            <a href="newMessagerie&&idUserLivre=<?= $user->getId() ?>" class="button greenLink">Envoyer un message</a>
        </section>
    </div>
</section>