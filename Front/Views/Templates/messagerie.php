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

    <section class="sectionMessage">
        <section class="listeMessage">
            <?php foreach($selected->getMessages() as $message) { ?>
                <div class="<?= TomTroc\Services\Utils::changeColorMessage($message->getExpediteurId()) ?>">
                    <span><?= $message->getDateCreation() ?></span>
                    <p><?= $message->getContent() ?></p>
                </div>
            <?php } ?>
        </section>
        <form action="sendMessage" method="post">
            <input type="hidden" id="idConversation" name="idConversation" value="<?= $selected->getId() ?>" />
            <input type="text" id="content" name="content" class="message" placeholder="Taper votre message ici"/>
            <input type="submit" value="Envoyer" class="submit"/>
        </form>
    </section>
</section>