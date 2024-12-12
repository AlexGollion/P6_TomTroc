<?php  
    if($inscription)
    {
        $title = "Inscription";
        $formData = array (
            "action" => "inscription",
            "label" => ["Pseudo", "Email", "Mot de passe"],
            "input" => ["pseudo", "email", "password"],
            "type" => ["text", "email", "password"],
            "submit" => "S'inscrire"
        );
        $span = "Déjà inscrit ?";
        $action = "showConnexion";
        $aText = "Connectez-vous";
    }
    else
    {
        $title = "connexion";
        $formData = array (
            "action" => "connexion",
            "label" => ["Pseudo", "Mot de passe"],
            "input" => ["pseudo", "password"],
            "type" => ["text", "password"],
            "submit" => "Se connecter"
        );
        $span = "Pas de compte ?";
        $action = "showInscription";
        $aText = "Inscrivez-vous";
    }
    $params = array("component" => "form", "formData" => $formData);
?>

<section class="connexion">
    <div>
        <h1><?= $title ?></h1>

        <?= TomTroc\Front\Components\Component::render($params); ?>

        <p><?= $span ?> <a href=<?= $action ?> ><?= $aText ?> </a> </p>
    </div>

    <img src="./Front/images/static/marialaura-gionfriddo-inscription.png">
</section>