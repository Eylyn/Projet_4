<?php $this->title =  "Votre Profil";
$this->style = '../Projet_4/public/css/style'; ?>

<h1>Espace Personnel</h1>

<?= $this->session->show('updatePassword'); ?><br>
<h2>Pseudo : <?= $this->session->get('pseudo'); ?></h2>
<p>Inscrit le : <?= $this->session->get('createdAt'); ?></p>
<p>Dernière connexion le : <?= $this->session->get('lastConnection'); ?></p>
<p>Role : <?= $this->session->get('role'); ?></p>

<a href="../Projet_4/index.php?route=updatePassword">Modifier mon mot de passe</a>
<?php
if ($this->session->get('role') != 'Administrateur') {
    ?>
    <a href="../Projet_4/index.php?route=deleteAccount">Supprimer mon compte</a>
    <?php } 
else { ?>
    Suppression impossible
<?php
}
?>
<h3>Comentaires postés</h3>
<table>
    <tr>
        <td>Article</td>
        <td>Contenu</td>
        <td>Posté le : </td>
        <td>Lien vers l'article</td>
    </tr>
    <?php
    foreach ($comments as $comment) {
    ?>
        <tr>
            <td></td>
            <td><?= htmlspecialchars($comment->getContent()); ?></td>
            <td><?= htmlspecialchars($comment->getCreatedAt()); ?></td>
            <td><a href="../Projet_4/index.php?route=episode&episodeId=<?= htmlspecialchars($comment->getEpisodeId()); ?>"> Article n° <?= htmlspecialchars($comment->getEpisodeId()); ?></a></td>
        </tr>
    <?php
    }
    ?>
</table><br>
<a href="../Projet_4/index.php">Retour à l'accueil</a>