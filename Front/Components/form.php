<?php 

?>

<form action=<?= $formData["action"] ?> method="post" class="connexion" enctype="multipart/form-data">
    <?php foreach($formData["label"] as $index => $label) { ?>
        <label for=<?= $label ?>> <?= $label ?> </label>
        <?php if (isset($formData["value"])) { ?>
            <input type=<?= $formData["type"][$index] ?> id=<?= $formData["input"][$index] ?> name=<?= $formData["input"][$index] ?> 
            value=<?= $formData["value"][$index] ?> />
        <?php } else { ?>
            <input type=<?= $formData["type"][$index] ?> id=<?= $formData["input"][$index] ?> name=<?= $formData["input"][$index] ?> />
    <?php } } ?>
    <input type="submit" value= <?= $formData["submit"] ?> />
</form>