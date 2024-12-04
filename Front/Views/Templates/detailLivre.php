<?php 
    $messageBtn = array (
        "component" => "button",
        "buttonData" => [
            "action" => "messagerie",
            "value" => "Envoyer un message"
        ]
    );
?>

<section class="detailLivre">
    <img src=<?= "./Front/images/livres/" . $livre->getImage() ?>>

    <section class="infoLivre">
        <h1><?= $livre->getTitre() ?></h1>
        <span>par <?= $livre->getAuteur() ?></span>
        <p><?= $livre->getDescription() ?></p>
        <span>Propiétaire</span>
        <form action="comptePublic" method="post">
            <input type="hidden" name="userId" value="<?= $user->getId() ?>"/>
            <button>
                <img src=<?= "./Front/images/livres/" . $user->getPhoto() ?>>
                <span><?= $user->getPseudo() ?></span>
            </button>
        </form>
        <?= TomTroc\Front\Components\Component::render($messageBtn) ?>
    </section>
</section>