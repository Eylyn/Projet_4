<?php $this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?= $this->session->show('register'); ?>
<?= $this->session->show('login'); ?>

<a href="../Projet_4/index.php?route=register">Inscription</a>
<a href="../Projet_4/index.php?route=login">Connexion</a>
<a href="../Projet_4/index.php?route=profile">Mon profil</a>
<a href="../Projet_4/index.php?route=administration">Administration</a>

<?php
foreach ($episodes as $episode) {
    ?>
    <div>
        <h2><a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= htmlspecialchars($episode->getTitle()); ?></a></h2>
        <p><?= htmlspecialchars($episode->getContent()); ?></p>
        <p> Sorti le : <?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p>Likes : <?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <?php
}
?>
