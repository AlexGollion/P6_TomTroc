<?php 
    function nav(array $params)
    { ?>
        <nav>
            <?php foreach ($params as $key) { ?>
                <a href="<?= $key['action'] ?>"><?= $key['title'] ?></a>
            <?php } ?>
        </nav>

    <?php }
?>
