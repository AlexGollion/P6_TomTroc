<section class="livres">
    <div class="search">
        <h1>Nos livres à l'échange</h1>
        <form action="searchLivres" method="post">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Rechercher un livre" id="searchBar" name="searchBar"/>
        </form>
    </div>
    <section class="grilleLivre">
    <?php foreach($livres as $index => $livre) {  ?>
        <a href="detailLivre&idLivre=<?= $livre["livre"]->getId() ?>">
            <img src=<?= "./Front/images/livres/" . $livre["livre"]->getImage() ?>>
            <h2><?= $livre["livre"]->getTitre() ?></h2>
            <h3><?= $livre["livre"]->getAuteur() ?></h3>
            <p>Vendu par : <?= $livre["user"] ?></p>
        </a>
    <?php } ?>
    </section>
</section>