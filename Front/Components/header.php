<?php
    $navGen = array(['title' => 'Accueil', 'action' => 'home'], ['title' => 'Nos livres à l\'échange', 'action' => 'afficherlivres']);
    if (isset($_SESSION['user']))
    {
        $navConnected = array(
            ['title' => 'Messagerie', 'action' => 'messagerie'], 
            ['title' => 'Mon Compte', 'action' => 'moncompte'], 
            ['title' => 'Déconnexion', 'action' => 'deconnexion']
        );
    }
    else
    {
        $navConnected = array(['title' => 'Connexion', 'action' => 'showinscription']);        
    }
    require('nav.php'); 
?>

<header>
    <div>
        <h3>Tom Troc</h3>
        <?= nav($navGen); ?>
    </div>
    <?= nav($navConnected); ?>
</header>