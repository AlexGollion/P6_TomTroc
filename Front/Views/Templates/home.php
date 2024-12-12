<?php 
        $decouvrirBtn = array("component" => "button", "buttonData" => [
            "action" => "home",
            "value" => "Découvrir",
            "class" => "greenBtn"
        ]);

        $voirLivresGreenBtn = array("component" => "button", "buttonData" => [
            "action" => "showAllLivres",
            "value" => "Voir tous les livres",
            "class" => "greenBtn"
        ]);

        $voirLivresWhiteBtn = array("component" => "button", "buttonData" => [
            "action" => "showAllLivres",
            "value" => "Voir tous les livres",
            "class" => "whiteBtn"
        ]);
?>

<section class="join">
    <div>
        <h1>Rejoignez nos <br> lecteurs passionnées</h1>
        <p>Donnez une nouvelle vies à vos livres en les <br>
            échangeant avec d'autres amoureux de la <br>
            lecture. Nous croyons en la magie du <br>
            partage de connaissances et d'histoires à <br>
            travers les livres
        </p>
        <?= TomTroc\Front\Components\Component::render($decouvrirBtn) ?>
    </div>
    <img src="./Front/images/static/hamza-nouasria-accueil.png">
</section>

<section class="dernierAjout">
    <h2>Les derniers livres ajoutés</h2>
    <?= TomTroc\Front\Components\Component::render($voirLivresGreenBtn) ?>
</section>

<section class="marche">
    <h2>Comment ça marche ?</h2>
    <?= TomTroc\Front\Components\Component::render($voirLivresWhiteBtn) ?>
</section>

<img src="./Front/images/static/clay-banks-accueil.png">

<section class="valeur">
    <h2>Nos valeurs</h2>
</section>