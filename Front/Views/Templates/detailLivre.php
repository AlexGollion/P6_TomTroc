<?php 
    $messageBtn = array (
        "component" => "button",
        "buttonData" => [
            "action" => "newMessagerie",
            "value" => "Envoyer un message",
            "hidden" => [
                ["name" => "idUserLivre", "value" => $user->getId()]
            ],
            "class" => "greenBtn"
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
            <h2>description</h2>
            <p id="description"><?= $livre->getDescription() ?></p>
            <h2>Propiétaire</h2>
            <a href="comptePublic&userId=<?= $user->getId() ?>" class="proprietaire">
                <?php if ($user->getPhoto() != null) { ?>
                    <img src=<?= "./Front/images/profils/" . $user->getPhoto() ?>>
                <?php } ?>
                <span><?= $user->getPseudo() ?></span>
            </a>
            <?= TomTroc\Front\Components\Component::render($messageBtn) ?>
        </section>
    </div>
</section>