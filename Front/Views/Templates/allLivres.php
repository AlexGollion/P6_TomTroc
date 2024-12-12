<section class="livres">
    <h1>Nos livres à l'échange</h1>
    <section class="grilleLivre">
    <?php foreach($livres as $index => $livre) {  ?>
        <form action="detailLivre" method="post">
            <input type="hidden" name="idLivre" value="<?= $livre["livre"]->getId() ?>" />
            <button class="card">
                <img src=<?= "./Front/images/livres/" . $livre["livre"]->getImage() ?>>
                <h2><?= $livre["livre"]->getTitre() ?></h2>
                <h3><?= $livre["livre"]->getAuteur() ?></h3>
                <p>Vendu par : <?= $livre["user"] ?></p>
            </button>
        </form>
    <?php } ?>
    </section>
</section>