<?php 
    //var_dump($selected);
?>

<section class="messagerie">
    <section class="listeConversation">
        <h1>Messagerie</h1>
        <?php foreach($conversations as $conv) { ?>
            <div>
                <h3><?= $conv->getNom(); ?></h3>
            </div>
        <?php } ?>
    </section>

    <section class="listeMessage">
        <?php foreach($selected->getMessages() as $message) { ?>
            <div>
                <h3><?= $message->getContent(); ?></h3>
            </div>
        <?php } ?>
        <form action="sendMessage" method="post">
            <input type="hidden" id="idConversation" name="idConversation" value="<?= $selected->getId() ?>" />
            <input type="text" id="content" name="content" class="message"/>
            <input type="submit" value="envoyer" class="submit"/>
        </form>
    </section>
</section>