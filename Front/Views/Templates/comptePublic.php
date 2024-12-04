<section class="compte">
        <h2><?= $user->getPseudo(); ?></h2>
        <p>Membre depuis <?= $user->getDateCreation(); ?></p>
        <span>Bibliothèque</span>
</section>

<section class="tableau">
    <table>
        <tr>
            <th>Photo</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Description</th>
            <th>Disponibilité</th>
        </tr>

        <?php foreach($livres as $index => $livre) { ?>
            <tr>
                <td><img src=<?= "./Front/images/livres/" . $livre->getImage() ?>></td>
                <td><?= $livre->getTitre() ?></td>
                <td><?= $livre->getAuteur() ?></td>
                <td><?= $livre->getDescription() ?></td>
                <td><?= $livre->getStatut() ?></td>
            </tr>
        <?php } ?>
    </table>
</section>