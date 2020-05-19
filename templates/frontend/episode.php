<?php $this->title = 'Episode';
$this->style = '../Projet_4/public/css/episode'; ?>

<?= $this->session->show('setFlag'); ?><br>

<section id="enTete">
    <div class="container">
        <h1><?= htmlspecialchars_decode(strip_tags($episode->getTitle())); ?></h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div class="col-lg-9 col-xs-12">
        <div class="singleEpisode">
            <?= htmlspecialchars_decode($episode->getContent()); ?>
            <p><?= htmlspecialchars($episode->getCreatedAt()); ?></p>
            <p><?= htmlspecialchars($episode->getLikes()); ?></p>
            <a href="../Projet_4/index.php?route=setLikes&episodeId=<?= $episode->getId(); ?>"><img src="../Projet_4/public/icones/likeEmpty.svg" class="icone"></a>
        </div>
        <?php if ($this->session->get('role') === 'Administrateur') { ?>
            <a href="../Projet_4/index.php?route=editEpisode&episodeId=<?= $episode->getId(); ?>">Editer</a>
        <?php
        }
        ?>
        <div class="navigation container-fluid">
            <span class="previous col-xs-6">
                <?php
                if (htmlspecialchars($episode->getId() - 1) != 0) {
                ?>
                    <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId() - 1); ?>"><img src="../Projet_4/public/icones/previous.svg" alt="icone-precedent" class="icone"> Episode Précédent</a>
                <?php
                }
                ?>
            </span>
            <span class="next col-xs-6">
                <a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($episode->getId() + 1); ?>">Episode Suivant <img src="../Projet_4/public/icones/next.svg" alt="icone-suivant" class="icone"> </a>
            </span>
        </div>
        <div class="comment-section">
            <h3>Ajouter un commentaire</h3>
            <?php
            if ($this->session->get('pseudo')) {
                include('formComment.php');
            } else {
            ?>
                Vous devez être connecté pour commenter <br>
                <a href="../Projet_4/index.php?route=login">Se connecter</a>
                <a href="../Projet_4/index.php?route=register">S'inscrire</a>
            <?php
            }
            ?>
            <h3>Commentaires</h3>
            <?php
            foreach ($comments as $comment) {
            ?>
                <div class="comments" id="<?= $comment->getId(); ?>">
                    <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
                    <p><?= htmlspecialchars(html_entity_decode($comment->getContent())); ?></p>
                    <p>Posté le <?= $comment->getCreatedAt(); ?></p>
                    <p><?= htmlspecialchars($comment->isFlag()); ?></p>
                    <a href="../Projet_4/index.php?route=setFlag&commentId=<?= $comment->getId(); ?>&episodeId=<?= $episode->getId(); ?>">Signaler</a>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-lg-3 hidden-md">
        <aside class="right-column">
            <div class="last-comments">
                <h4>Derniers commentaires</h4>
                <?php
                foreach ($lastComments as $lastComment) {
                ?>
                    <div class="last-comment">
                        <h5><?= $lastComment->getCreatedAt(); ?></h5>
                        <p><?= htmlspecialchars($lastComment->getContent()); ?></p>
                        <p><?= htmlspecialchars($lastComment->getPseudo()); ?></p>
                        <a href="../Projet_4/index.php?route=episode&episodeId=<?= $lastComment->getEpisodeId(); ?>#<?= $lastComment->getId(); ?>">Lire le commentaire</a>
                    </div>
                <?php
                }
                ?>
            </div>
                <div class="about">
                    <h4>L'auteur</h4>
        <p>Jean forteroche est un auteur...</p>
    </div>
    </div>



    </aside>




</section>