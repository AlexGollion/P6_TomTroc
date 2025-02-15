<?php 
    //TomTroc\Services\Utils::dd($conversations);
    if(!empty($conversations))
    {
        foreach($conversations as $conv)
        {
            if($conv->getId() == $selected)
            {
                $conversationOpen = $conv;
            }
        }
    }
?>

<section class="messagerie">
    <section class="listeConversation">
        <h1>Messagerie</h1>
        <?php foreach($conversations as $conv) { ?>
            <a href="messagerie&idConv=<?= $conv->getId() ?>" <?php if($conv->getId() == $selected) { ?> class="convSelected" <?php } ?>>
                <div class="imgConv">
                <?php if ($conv->getUsers()[0]->getPhoto() != null) { ?>
                    <img src="./Front/images/profils/<?= $conv->getUsers()[0]->getPhoto() ?>" alt="photo de profil de <?= $conv->getUsers()[0]->getPseudo() ?>">
                <?php } if ($conv->getUsers()[1]->getPhoto() != null) {?>
                    <img src="./Front/images/profils/<?= $conv->getUsers()[1]->getPhoto() ?>" alt="photo de profil de <?= $conv->getUsers()[1]->getPseudo() ?>">
                <?php } ?>
                </div>
                <div class="listeConversationContent">
                    <div class="headerListeConversation">
                        <h3><?= $conv->getNom() ?></h3>
                    <?php if($conv->getLastMessage() != null) { ?>
                        <p class="dateLastMessage"><?= $conv->getLastMessage()->getDateCreationDateTime()->format("H:i") ?></p>
                    <?php } ?>
                    </div>
                    <?php if($conv->getLastMessage() != null) { ?>
                        <p><?= $conv->getLastMessage()->getContent() ?></p>
                    <?php } ?>
                </div>
            </a>
        <?php } ?>
    </section>

    <?php if(isset($conversationOpen)) { ?>
        <section class="sectionMessage">
            <div class="sectionMessageNom">
                <div class="imgConv">
                <?php if ($conversationOpen->getUsers()[0]->getPhoto() != null) { ?>
                    <img src="./Front/images/profils/<?= $conversationOpen->getUsers()[0]->getPhoto() ?>" alt="photo de profil de <?= $conversationOpen->getUsers()[0]->getPseudo() ?>">
                <?php } if ($conversationOpen->getUsers()[1]->getPhoto() != null) {?>
                    <img src="./Front/images/profils/<?= $conversationOpen->getUsers()[1]->getPhoto() ?>" alt="photo de profil de <?= $conversationOpen->getUsers()[1]->getPseudo() ?>">
                <?php } ?>
                </div>
                <h3><?= $conversationOpen->getNom() ?></h3>
            </div>
            <section class="listeMessage">
                <?php foreach($conversationOpen->getMessages() as $message) { ?>
                    <div class="<?= TomTroc\Services\Utils::changeColorMessage($message->getExpediteurId()) ?>">
                        <span><?= $message->getDateCreationDateTime()->format("m.d H:i") ?></span>
                        <p><?= $message->getContent() ?></p>
                    </div>
                <?php } ?>
            </section>
            <form action="sendMessage" method="post">
                <input type="hidden" id="idConversation" name="idConversation" value="<?= $selected ?>" />
                <input type="text" id="content" name="content" class="message" placeholder="Taper votre message ici"/>
                <input type="submit" value="Envoyer" class="submit"/>
            </form>
        </section>
    <?php } ?>
</section>