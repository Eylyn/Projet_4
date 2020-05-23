<?php $this->title =  "Votre Profil";
$this->style = 'public/css/back'; ?>


<section class="enTete">
    <div class="container">
        <h1>Espace Personnel</h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div class="info-perso col-md-6 col-xs-12">
        <?= $this->session->show('updatePassword'); ?><br>
        <h2>Pseudo : <?= $this->session->get('pseudo'); ?></h2>
        <p>Inscrit le : <?= $this->session->get('createdAt'); ?></p>
        <p>Dernière connexion le : <?= $this->session->get('lastConnection'); ?></p>
        <p>Role : <?= $this->session->get('role'); ?></p>

        <a href="index.php?route=updatePassword"><img src="public/icones/user-edit-solid.svg" alt="modifier" class="icone"> Modifier mon mot de passe</a><br>
        <?php
        if ($this->session->get('role') != 'Administrateur') {
        ?>
            <a href="index.php?route=deleteAccount"><img src="public/icones/deleteAccount.svg" alt="supprimer" class="icone"> Supprimer mon compte</a>
        <?php } ?>
    </div>
    <div class="posted-comments col-md-6 col-sm-12">
        <h3>Comentaires postés</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Contenu</th>
                    <th>Posté le : </th>
                    <th>Lien vers l'article</th>
                </tr>
            </thead>

            <?php
            foreach ($comments as $comment) {
            ?>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars(html_entity_decode($comment->getContent())); ?> </td>
                        <td><?= htmlspecialchars($comment->getCreatedAt()); ?> </td>
                        <td><a href="index.php?route=episode&episodeId=<?= htmlspecialchars($comment->getEpisodeId()); ?>"> Article n° <?= htmlspecialchars($comment->getEpisodeId()); ?></a></td>
                    </tr>

                </tbody>

            <?php
            }
            ?>
        </table><br>
    </div>

</section>