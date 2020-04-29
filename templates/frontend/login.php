<?php $this->title = " Connexion";
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Connection</h1>

<?= $this->session->show('error_login');?>
<div>
    <form method="post" action="../Projet_4/index.php?route=login">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')):'';?>"><br>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Se connecter" id="submit" name="submit">
    </form>
    <a href="../Projet_4/index.php">Retour à l'accueil</a>
</div>