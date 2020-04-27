<?php $this->title = 'Episode';
$this->style = '../Projet_4/public/css/episode' ; ?>

<h1>Billet Simple pour l'Alaska</h1>


    <div>
        <h2><?= htmlspecialchars($episode->getTitle()); ?></h2>
        <p><?= htmlspecialchars($episode->getContent()); ?></p>
        <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
