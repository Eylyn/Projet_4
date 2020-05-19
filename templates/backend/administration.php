<?php $this->title = "Administration";
$this->style = 'public/css/style' ; ?>
<?= $this->session->show('addEpisode'); ?>
<?= $this->session->show('editEpisode'); ?>
<?= $this->session->show('deleteEpisode'); ?>
<?= $this->session->show('unflag'); ?>
<?= $this->session->show('deleteComment'); ?>
<?= $this->session->show('deleteUser'); ?>

<h1>Administration</h1>

<h2>Episodes</h2>
<a href="index.php?route=addEpisode">Publier un nouvel Episode</a>
<table>
    <tr>
        <td>Titre</td>
        <td>Extrait</td>
        <td>Publié le : </td>
        <td>Commentaires</td>
        <td>Likes</td>
        <td>Modéré</td>
        <td>Signalé</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($episodes as $episode) {
    ?>
    <tr>
        <td><a href="index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= htmlspecialchars($episode->getTitle()); ?></a></td>
        <td><?= substr(htmlspecialchars($episode->getContent()), 0, 150); ?></td>
        <td><?= htmlspecialchars($episode->getCreatedAt()); ?></td>
        <td><?= htmlspecialchars($episode->getComments()); ?></td>
        <td><?= htmlspecialchars($episode->getLikes()); ?></td>
        <td></td>
        <td></td>
        <td>
            <a href="index.php?route=editEpisode&episodeId=<?= $episode->getId(); ?>">Editer</a>
            <a href="index.php?route=deleteEpisode&episodeId=<?= $episode->getId(); ?>">Supprimer</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<h2>Commentaires signalés</h2>
<table>
    <tr>
        <td>Episode</td>
        <td>Pseudo</td>
        <td>Posté le : </td>
        <td>Contenu</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($comments as $comment) {
    ?>
    <tr>
        <td><a href="index.php?route=episode&episodeId=<?= htmlspecialchars( $comment->getEpisodeId()); ?>"></a></td>
        <td><?=htmlspecialchars($comment->getPseudo()); ?></td>
        <td><?= htmlspecialchars($comment->getCreatedAt()); ?></td>
        <td><?= substr(htmlspecialchars($comment->getContent()), 0, 150); ?></td>
        <td>
            <a href="index.php?route=unflag&commentId=<?= $comment->getId(); ?>">Désignaler</a>  <br>
            <a href="index.php?route=deleteComment&commentId=<?= $comment->getId(); ?>">Supprimer le commentaire</a> 
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<h2>Membres</h2>
<table>
    <tr>
        <td>Pseudo</td>
        <td>Inscription</td>
        <td>Dernière connexion</td>
        <td>Commentaires</td>
        <td>Rôles</td>
        <td>Email</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($users as $user) {
    ?>
    <tr>
        <td><?= htmlspecialchars($user->getPseudo()); ?></td>
        <td><?= htmlspecialchars($user->getCreatedAt()); ?></td>
        <td><?= htmlspecialchars($user->getLastConnection()); ?></td>
        <td></td>
        <td><?= htmlspecialchars($user->getRole()); ?></td>
        <td><a href="mailto:<?= htmlspecialchars($user->getEmail()); ?>"><?= htmlspecialchars($user->getEmail()); ?></a></td>
        <td>
            <?php
            if ($user->getRole() != 'Administrateur') {
            ?>
            <a href="index.php?route=deleteUser&userId=<?= $user->getId(); ?>">Supprimer</a>
            <?php }
            else {
                ?>
                Suppression impossible
            <?php
            }
            ?>
            </td>
    </tr>
    <?php
    }
    ?>
</table>
<a href="index.php">Retour à l'accueil</a>
