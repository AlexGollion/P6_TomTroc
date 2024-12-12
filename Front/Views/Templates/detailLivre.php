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
    <img src=<?= "./Front/images/livres/" . $livre->getImage() ?>>

    <section class="infoLivre">
        <h1><?= $livre->getTitre() ?></h1>
        <p id="auteur">par <?= $livre->getAuteur() ?></p>
        <h2>description</h2>
        <p id="description"><?= $livre->getDescription() ?></p>
        <h2>Propiétaire</h2>
        <form action="comptePublic" method="post" class="proprietaire">
            <input type="hidden" name="userId" value="<?= $user->getId() ?>"/>
            <button>
                <img src=<?= "./Front/images/livres/" . $user->getPhoto() ?>>
                <span><?= $user->getPseudo() ?></span>
            </button>
        </form>
        <?= TomTroc\Front\Components\Component::render($messageBtn) ?>
    </section>
</section>