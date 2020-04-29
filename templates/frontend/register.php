<?php $this->title = "Inscription";
$this->style = '../Projet_4/public/css/style' ; ?>

<h1>Inscription</h1>
<form action="../Projet_4/index.php?route=register" method="post">
    <label for="pseudo">Votre pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br>
    <label for="password"> Votre Mot de passe</label>
    <input type="password" id="password" name="password"><br>
    <label for="email">Votre Email</label>
    <input type="email" id="email" name="email"><br>
    <input type="submit" value="S'inscrire" id="submit" name="submit">
</form>
<a href="../Projet_4/index.php">Retour à l'accueil</a>