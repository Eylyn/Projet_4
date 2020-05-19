<?php $this->title =  "Votre Profil";
$this->style = '../Projet_4/public/css/style'; ?>


<section class="enTete">
    <div class="container">
        <h1>Espace Personnel</h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div class="info-perso">
        <?= $this->session->show('updatePassword'); ?><br>
        <h2>Pseudo : <?= $this->session->get('pseudo'); ?></h2>
        <p>Inscrit le : <?= $this->session->get('createdAt'); ?></p>
        <p>Dernière connexion le : <?= $this->session->get('lastConnection'); ?></p>
        <p>Role : <?= $this->session->get('role'); ?></p>

        <a href="../Projet_4/index.php?route=updatePassword">Modifier mon mot de passe</a>
        <?php
        if ($this->session->get('role') != 'Administrateur') {
        ?>
            <a href="../Projet_4/index.php?route=deleteAccount">Supprimer mon compte</a>
        <?php } ?>
    </div>
    <div class="posted-comments">
        <h3>Comentaires postés</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Article</th>
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
                        <td></td>
                        <td><?= htmlspecialchars(html_entity_decode($comment->getContent())); ?> </td>
                        <td><?= htmlspecialchars($comment->getCreatedAt()); ?> </td>
                        <td><a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($comment->getEpisodeId()); ?>"> Article n° <?= htmlspecialchars($comment->getEpisodeId()); ?></a></td>
                    </tr>

                </tbody>

            <?php
            }
            ?>
        </table><br>
    </div>

</section>