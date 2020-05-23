<?php $this->title = 'Episode';
$this->style = 'public/css/episode'; ?>

<?= $this->session->show('setFlag'); ?><br>

<section class="enTete">
    <div class="container">
        <h1><?= htmlspecialchars_decode(strip_tags($episode->getTitle())); ?></h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div class="col-md-9 col-xs-12">
        <div class="singleEpisode">
            <?= htmlspecialchars_decode($episode->getContent()); ?>
            <p class="col-xs-12 no-spaces"><img src="public/icones/clock-solid.svg" alt="horloge" class="icone"> <?= htmlspecialchars($episode->getCreatedAt()); ?></p>
            <p class="col-sm-1 col-xs-2 no-spaces"><img src="public/icones/likeFull.svg" alt="likes" class="icone"> <?= htmlspecialchars($episode->getLikes()); ?></p>
            <a class="col-sm-1 col-xs-2 no-spaces" href="index.php?route=setLikes&episodeId=<?= $episode->getId(); ?>"><img src="public/icones/likeEmpty.svg" class="icone"></a>
            <div class="button-container col-xs-12">
                <?php if ($this->session->get('role') === 'Administrateur') { ?>
                    <button><a href="index.php?route=editEpisode&episodeId=<?= $episode->getId(); ?>">Editer</a> </button>
                <?php
                }
                ?>
            </div>

        </div>

        <div class="navigation container-fluid">
            <span class="previous col-xs-6">
                <?php
                $prev = ($episode->getId() - 1);
                if ($prev != 0) {
                ?>
                    <a href="index.php?route=episode&episodeId=<?= $prev; ?>"><img src="public/icones/previous.svg" alt="icone-precedent" class="icone"> Episode Précédent</a>
                <?php
                }
                ?>
            </span>
            <span class="next col-xs-6">
                <?php
                $next = ($episode->getId() + 1);
                if ($next >= $maxId) {
                ?>
                    <a href="index.php?route=episode&episodeId=<?= $next; ?>">Episode Suivant <img src="public/icones/next.svg" alt="icone-suivant" class="icone"> </a>
                <?php
                }
                ?>

            </span>
        </div>
        <div class="comment-section">
            <h2>Ajouter un commentaire</h2>
            <?php
            if ($this->session->get('pseudo')) {
                include('formComment.php');
            } else {
            ?>
                Vous devez être connecté pour commenter <br>
                <a href="index.php?route=login">Se connecter</a>
                <a href="index.php?route=register">S'inscrire</a>
            <?php
            }
            ?>
            <h2>Commentaires</h2>
            <?php
            foreach ($comments as $comment) {
            ?>
                <div class="comments" id="<?= $comment->getId(); ?>">
                    <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
                    <p><?= htmlspecialchars(html_entity_decode($comment->getContent())); ?></p>
                    <p>Posté le <?= $comment->getCreatedAt(); ?></p>
                    <p><img src="public/icones/flag.svg" alt="drapeau" class="icone"> <?= htmlspecialchars($comment->isFlag()); ?></p>
                    <a href="index.php?route=setFlag&commentId=<?= $comment->getId(); ?>&episodeId=<?= $episode->getId(); ?>">Signaler</a>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-md-3 hidden-sm hidden-xs">
        <aside class="right-column">
            <div class="last-comments">
                <h2>Derniers commentaires</h2>
                <?php
                foreach ($lastComments as $lastComment) {
                ?>
                    <div class="last-comment">
                        <h5><?= $lastComment->getCreatedAt(); ?></h5>
                        <p><?= htmlspecialchars($lastComment->getContent()); ?></p>
                        <p><?= htmlspecialchars($lastComment->getPseudo()); ?></p>
                        <a href="index.php?route=episode&episodeId=<?= $lastComment->getEpisodeId(); ?>#<?= $lastComment->getId(); ?>">Lire le commentaire</a>
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