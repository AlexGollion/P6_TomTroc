<?php 

?>

<form action=<?= $formData["action"] ?> method="post" enctype="multipart/form-data">
    <?php foreach($formData["label"] as $index => $label) { ?>
        <label for=<?= $label ?>> <?= $label ?> </label>
        <?php if (isset($formData["placeholder"])) { ?>
            <input type=<?= $formData["type"][$index] ?> id=<?= $formData["input"][$index] ?> name=<?= $formData["input"][$index] ?> 
            placeholder=<?= $formData["placeholder"][$index] ?> />
        <?php } else { ?>
            <input type=<?= $formData["type"][$index] ?> id=<?= $formData["input"][$index] ?> name=<?= $formData["input"][$index] ?> />
    <?php } } ?>
    <input type="submit" value= "<?= $formData["submit"] ?> " class="submit"/>
</form>