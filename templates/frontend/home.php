<?php $this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?php
foreach ($articles as $article) {
    ?>
    <div>
        <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getCreatedAt()); ?></p>
        <p><?= htmlspecialchars($article->getLikes()); ?></p>
    </div>
    <?php
}
?>