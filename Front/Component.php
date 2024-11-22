<?php

namespace TomTroc\Front;

class Component
{
    public static function header(bool $isConnected)
    { 
        $navGen = array(['title' => 'Accueil', 'action' => 'home'], ['title' => 'Nos livres à l\'échange', 'action' => 'afficherLivres']);
        if ($isConnected)
        {
            $navConnected = array('Messagerie', 'Mon Compte', 'Déconnexion');
        }
        else
        {
            $navConnected = array(['title' => 'Connexion', 'action' => 'connexion']);        }
        ?>
        <header>
            <div>
                <h3>Tom Troc</h3>
                <?= self::nav($navGen); ?>
            </div>
            <?= self::nav($navConnected); ?>
        </header>
    <?php }
    
    private static function nav(array $params = [])
    { ?>
        <nav>
            <?php foreach ($params as $key) { ?>
                <a href="index.php?action=<?= $key['action'] ?>"><?= $key['title'] ?></a>
            <?php } ?>
        </nav>
    <?php }
}