<?php 
    $formData = array (
        "action" => "addLivre",
        "label" => ["Titre", "Auteur", "Image", "Description", "Statut"],
        "input" => ["titre", "auteur", "image", "description", "statut"],
        "type" => ["text", "text", "file", "text", "text"],
        "submit" => "Ajouter ce livre"
    );
    $paramsForm = array("component" => "form", "formData" => $formData);
?>

<h1>Ajouter un livre</h1>

<?= TomTroc\Front\Components\Component::render($paramsForm) ?>
