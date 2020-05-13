<?php $this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Billet Simple pour l'Alaska</h1>

<?= $this->session->show('register'); ?>
<?= $this->session->show('login'); ?>
<?= $this->session->show('logout'); ?>
<?= $this->session->show('deleteAccount'); ?>


<?php
foreach ($episodes as $episode) {
    ?>
    <div class="episode-container col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= $episode->getTitle(); ?></a>
        <div><?= substr($episode->getContent(), 0, 300); ?></div>
        <p> Publié le : <?= htmlspecialchars($episode->getCreatedAt()); ?></p>
        <p class="likes"><img src="../Projet_4/public/icones/likeFull.svg" alt="likes" class="icone"> <?= htmlspecialchars($episode->getLikes()); ?></p>
    </div>
    <?php
}
?>
