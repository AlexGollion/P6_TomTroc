<section class="join">
    <div>
        <h1>Rejoignez nos <br> lecteurs passionnées</h1>
        <p>Donnez une nouvelle vies à vos livres en les <br>
            échangeant avec d'autres amoureux de la <br>
            lecture. Nous croyons en la magie du <br>
            partage de connaissances et d'histoires à <br>
            travers les livres
        </p>
        <a href="home" class="greenLink">Découvrir</a>
    </div>
    <div class="joinImg">
        <img src="./Front/images/static/hamza-nouasria-accueil.png">
        <span>Hamza</span>
    <div>
</section>

<section class="dernierAjout">
    <h2>Les derniers livres ajoutés</h2>
    <div class="livreHome">
    <?php foreach($livres as $index => $livre) {  ?>
        <a href="detailLivre&idLivre=<?= $livre["livre"]->getId() ?>">
            <img src=<?= "./Front/images/livres/" . $livre["livre"]->getImage() ?>>
            <h2><?= $livre["livre"]->getTitre() ?></h2>
            <h3><?= $livre["livre"]->getAuteur() ?></h3>
            <p>Vendu par : <?= $livre["user"] ?></p>
        </a>
    <?php } ?>
    </div>
    <a href="showAllLivres" class="greenLink">Voir tous les livres</a>
</section>

<section class="marche">
    <h2>Comment ça marche ?</h2>
    <p>Échanger des livres avec TomTroc c'est simple et <br> amusant ! Suivez ces étapes pour commencer :<p>
        <section class="cardMarche">
            <div>
                <p>Inscrivez-vous<br> gratuitement sur<br> notre plateforme.</p>
            </div>
            <div>
                <p>Ajoutez les livres que vous<br> souhaitez échanger à<br> votre profil.</p>
            </div>
            <div>
                <p>Parcourez les livres<br> disponibles chez d'autres<br> membres.</p>
            </div>
            <div>
                <p>Proposez un échange et<br> discutez avec d'autres<br> passionnés de lecture.</p>
            </div>

        </section>
    <a href="showAllLivres" class="whiteLink">Voir tous les livres</a>
</section>

<img src="./Front/images/static/clay-banks-accueil.png">

<section class="valeur">
    <div class="valeurContent">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le<br>
        partage, la découverte et la communauté. Nos<br>
        valeurs sont ancrées dans notre passion pour les<br>
        livres et notre désir de créer des liens entre les<br>
        lecteurs. Nous croyons en la puissance des histoires<br>
        pour rassembler les gens et inspirer des<br>
        conversations enrichissantes.<br>
        <br>
        Notre association a été fondée avec une conviction<br>
        profonde : chaque livre mérite d'être lu et partagé.<br>
        <br>
        Nous sommes passionnés par la création d'une<br>
        plateforme conviviale qui permet aux lecteurs de se<br>
        connecter, de partager leurs découvertes littéraires<br>
        et d'échanger des livres qui attendent patiemment<br>
        sur les étagères.</p>
        <div>
            <span>L'équipe Tom Troc</span>
            <img src="./Front/images/static/Vector.png">
        </div>
    </div>    
</section>