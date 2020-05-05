<?php $this->title = 'Modifier mon mot de passe';
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Modification du mot de passe</h1>
<?= $this->session->show('wrongPassword'); ?><br>

<div>
    <form method='post' action="../Projet_4/index.php?route=updatePassword">
        <label for="oldPassword">Ancien mot de passe</label>
        <input type="password" id="oldPassword" name="oldPassword">
        <label for="newPassword">Nouveau mot de passe</label>
        <input type="password" id="newPassword" name="newPassword">
        <input type="submit" value="Mettre à jour" id="submit" name="submit">
    </form>
</div>
<br>
<a href="../Projet_4/index.php">Retour à l'accueil</a>