<?php $this->title = "Inscription";
$this->style = 'public/css/style'; ?>



<section class="enTete">
    <div class="container">
        <h1>Inscription</h1>
    </div>
</section>

<section id="content" class="container-fluid">

    <form action="index.php?route=register" method="post">
        <label for="pseudo">Votre pseudo</label><br>
        <input type="text" name="pseudo" id="pseudo"><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
        <label for="password"> Votre Mot de passe (8 caractères, 1 majuscule, 1 minuscule, 1 chiffre et 1 symbole)</label><br>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password']:''; ?>
        <label for="email">Votre Email</label><br>
        <input type="email" id="email" name="email"><br>
        <?= isset($errors['email']) ? $errors['email']:''; ?>
        <input type="submit" value="S'inscrire" id="submit" name="submit">
    </form>
</section>