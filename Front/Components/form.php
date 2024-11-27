<?php 
    //echo $formData["submit"];
?>

<form action=<?= $formData["action"] ?> method="post" class="connexion">
    <?php foreach($formData["label"] as $index => $label) { ?>
        <label for=<?= $label ?>> <?= $label ?> </label>
        <input type=<?= $formData["type"][$index] ?> id=<?= $formData["input"][$index] ?> name=<?= $formData["input"][$index] ?> />
    <?php } ?>
    <input type="submit" value= <?= $formData["submit"] ?> />
</form>