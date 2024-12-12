<form action=<?= $buttonData["action"] ?> method="post" class="<?= $buttonData["class"]?>">
    <?php if (isset($buttonData["hidden"])) { ?>
        <?php foreach($buttonData["hidden"] as $index => $hidden) { ?>
            <input type="hidden" name=<?= $hidden["name"] ?> value="<?= $hidden["value"] ?>"/>
        <?php } ?>
    <?php } ?>
    <input type="submit" value="<?= $buttonData["value"] ?>"/>
</form>