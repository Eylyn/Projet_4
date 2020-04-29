<?php $this->title =  "Votre Profil";
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Mon Profil</h1>

<h2>Pseudo : <?= $this->session->get('pseudo'); ?></h2>
<p>Inscrit le : <?= $this->session->get('createdAt'); ?></p>
<p>Dernière connexion le : <?= $this->session->get('lastConnection'); ?></p>

<h3>Comentaires postés</h3>
<table>
    <tr>
        <td>Article</td>
        <td>Titre du commentaire</td>
        <td>Contenu</td>
        <td>Posté le : </td>
        <td>Lien vers l'article</td>
    </tr>
</table><br>
<a href="../Projet_4/index.php">Retour à l'accueil</a>