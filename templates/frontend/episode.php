<?php $this->title = 'Episode';
$this->style = '../Projet_4/public/css/episode' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?= $this->session->show('setFlag'); ?><br>

    <div>
        <?= htmlspecialchars_decode($episode->getTitle()); ?>
        <?= htmlspecialchars_decode($episode->getContent()); ?>
        <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <a href="../Projet_4/index.php?route=editEpisode&episodeId=<?= $episode->getId(); ?>">Editer</a>
    <div>
        <h3>Ajouter un commentaire</h3>
        <?php include('formComment.php'); ?>
        <h3>Commentaires</h3>
        <?php
        foreach ($comments as $comment) {
            ?>
            <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
            <p><?= htmlspecialchars($comment->getContent()); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
            <p><?= htmlspecialchars($comment->isFlag()); ?></p>
            <a href="../Projet_4/index.php?route=setFlag&commentId=<?= $comment->getId(); ?>&episodeId=<?= $episode->getId(); ?>">Signaler</a>
        <?php
        }
        ?>
    </div>
    <a href="../Projet_4/index.php">Retour à l'accueil</a>