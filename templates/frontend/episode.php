<?php $this->title = 'Episode';
$this->style = '../Projet_4/public/css/episode' ; ?>

<h1>Billet Simple pour l'Alaska</h1>


    <div>
        <h2><?= htmlspecialchars($episode->getTitle()); ?></h2>
        <p><?= htmlspecialchars($episode->getContent()); ?></p>
        <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <div>
        <h3>Commentaires</h3>
        <?php
        foreach ($comments as $comment) {
            ?>
            <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
            <p><?= htmlspecialchars($comment->getContent()); ?></p>
            <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
            <p><?= htmlspecialchars($comment->isFlag()); ?></p>
        <?php
        }
        ?>
    </div>
    <a href="../Projet_4/index.php">Retour à l'accueil</a>