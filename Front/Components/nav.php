<?php 
    function nav(array $params)
    { 
        $class = $_SESSION["header"]; ?>
        <nav>
            <?php foreach ($params as $key) { ?>
                <a class="<?php echo ($key['action'] == $class) ? "headerSelectedPage" : ""; ?>" href="<?= $key['action'] ?>"><?= $key['title'] ?></a>
            <?php } ?>
        </nav>

    <?php }
?>
