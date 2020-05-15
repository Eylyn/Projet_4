<?php
$this->title = 'Accueil';
$this->style = '../Projet_4/public/css/style';
$this->enTete = '' ?>

<section id="enTete">
    <div class="container">
        <h1>Billet Simple pour l'Alaska</h1>
        <p> par Jean Forteroche</p>
    </div>
</section>

<section id="content" class="container-fluid">
    <?php
    foreach ($episodes as $episode) {
    ?>
        <div class="episode-container col-md-3 col-sm-5 col-xs-12">
            <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>"><?= $episode->getTitle(); ?></a>
            <div><?= substr($episode->getContent(), 0, 300); ?></div>
            <div class="infos">
                <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId()); ?>" class="col-xs-12">Continuer à lire...</a>
                <p> Publié le : <?= htmlspecialchars($episode->getCreatedAt()); ?></p>
                <p class="likes"><img src="../Projet_4/public/icones/likeFull.svg" alt="likes" class="icone"> <?= htmlspecialchars($episode->getLikes()); ?></p>
            </div>

        </div>
    <?php
    }
    ?>
</section>