<?php $this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?= $this->session->show('register'); ?>
<?= $this->session->show('login'); ?>
<?= $this->session->show('logout'); ?>
<?= $this->session->show('deleteAccount'); ?>




<?php
if ($this->session->get('pseudo')) {
?>
    <a href="../Projet_4/index.php?route=profile">Mon profil</a>
    <a href="../Projet_4/index.php?route=logout">Déconnexion</a>
    <?php if ($this->session->get('role') === 'Administrateur') {?>
        <a href="../Projet_4/index.php?route=administration">Administration</a>
    <?php
    }
    ?>

<?php
}
else {?>
    <a href="../Projet_4/index.php?route=register">Inscription</a>
<a href="../Projet_4/index.php?route=login">Connexion</a>
<?php
}
?>

<?php
foreach ($episodes as $episode) {
    ?>
    <div>
        <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= $episode->getTitle(); ?></a>
        <div><?= $episode->getContent(); ?></div>
        <p> Sorti le : <?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p>Likes : <?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <?php
}
?>
