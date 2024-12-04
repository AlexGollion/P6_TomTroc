<?php
    $navGen = array(['title' => 'Accueil', 'action' => 'home'], ['title' => 'Nos livres à l\'échange', 'action' => 'showAllLivres']);
    if (isset($_SESSION['user']))
    {
        $navConnected = array(
            ['title' => 'Messagerie', 'action' => 'messagerie'], 
            ['title' => 'Mon Compte', 'action' => 'monCompte'], 
            ['title' => 'Déconnexion', 'action' => 'deconnexion']
        );
    }
    else
    {
        $navConnected = array(['title' => 'Connexion', 'action' => 'showInscription']);        
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