<?php $this->title = 'Episode';
$this->style = '../Projet_4/public/css/episode' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?= $this->session->show('setFlag'); ?><br>

    <div>
        <?= htmlspecialchars_decode($episode->getTitle()); ?>
        <?= htmlspecialchars_decode($episode->getContent()); ?>
        <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($episode->getLikes()); ?></p>
        <a href="../Projet_4/index.php?route=setLikes&episodeId=<?= $episode->getId(); ?>">Like</a>
    </div>
    <a href="../Projet_4/index.php?route=editEpisode&episodeId=<?= $episode->getId(); ?>">Editer</a>
    <div>
        <h3>Ajouter un commentaire</h3>
        <?php 
        if ($this->session->get('pseudo')) {
            include('formComment.php');
        }
        else {
            ?>
            Vous devez être connecté pour commenter
            <a href="../Projet_4/index.php?route=login">Se connecter</a>
            <a href="../Projer_4/index.php?route=register">S'inscrire</a>
            <?php
        }
        ?>
        <h3>Commentaires</h3>
        <?php
        foreach ($comments as $comment) {
            ?>
            <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
            <p><?= htmlspecialchars(html_entity_decode($comment->getContent())); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
            <p><?= htmlspecialchars($comment->isFlag()); ?></p>
            <a href="../Projet_4/index.php?route=setFlag&commentId=<?= $comment->getId(); ?>&episodeId=<?= $episode->getId(); ?>">Signaler</a>
        <?php
        }
        ?>
    </div>
    <a href="../Projet_4/index.php">Retour à l'accueil</a>