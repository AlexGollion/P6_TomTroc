<section class="comptePublic">
    <section class="compte">
            <div class="compteImg">
                <img class="photoProfil" src="./Front/images/profils/<?= $user->getPhoto() ?>" alt="" >
            </div>
            <div class="compteLivre">
                <h2><?= $user->getPseudo(); ?></h2>
                <p id="date">Membre depuis <?= date_diff($user->getDateCreationDateTime(), date_create(date('Y-m-d H:i:s')))->format('%Y ans et %m mois'); ?></p>
                <p>Bibliothèque</p>
                <p> <i class="fa-solid fa-pause"></i> <?= count($livres) ?> livres</p>
                <a href="newMessagerie&&idUserLivre=<?= $user->getId() ?>" class="whiteLink">Écrire un message</a>
            </div>
    </section>
    
    <section class="tableau">
        <table>
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Description</th>
            </tr>
    
            <?php foreach($livres as $index => $livre) { ?>
                <tr class="<?= TomTroc\Services\Utils::changeColorTableau($index) ?>">
                    <td class="first"><img src=<?= "./Front/images/livres/" . $livre->getImage() ?>></td>
                    <td><?= $livre->getTitre() ?></td>
                    <td><?= $livre->getAuteur() ?></td>
                    <td><?= $livre->getDescription() ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>
</section>