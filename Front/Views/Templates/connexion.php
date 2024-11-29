<?php  
    if($inscription)
    {
        $title = "inscription";
        $formData = array (
            "action" => "inscription",
            "label" => ["Pseudo", "Email", "Mot de passe"],
            "input" => ["pseudo", "Email", "password"],
            "type" => ["text", "email", "password"],
            "submit" => "S'inscrire"
        );
        $span = "Déjà inscrit ?";
        $action = "showconnexion";
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
        $action = "showinscription";
        $aText = "Inscrivez-vous";
    }
    $params = array("component" => "form", "formData" => $formData);
?>

<h1><?= $title ?></h1>

<?= TomTroc\Front\Components\Component::render($params); ?>

<span><?= $span ?> </span>
<a href=<?= $action ?> ><?= $aText ?> </a>