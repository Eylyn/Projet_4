<?php $this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?php
foreach ($episodes as $episode) {
    ?>
    <div>
        <h2><a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= htmlspecialchars($episode->getTitle()); ?></a></h2>
        <p><?= htmlspecialchars($episode->getContent()); ?></p>
        <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <?php
}
?>