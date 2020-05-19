<?php $this->title = "Inscription";
$this->style = 'public/css/style'; ?>



<section class="enTete">
    <div class="container">
        <h1>Inscription</h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <form action="index.php?route=register" method="post">
        <label for="pseudo">Votre pseudo</label>
        <input type="text" name="pseudo" id="pseudo"><br>
        <label for="password"> Votre Mot de passe</label>
        <input type="password" id="password" name="password"><br>
        <label for="email">Votre Email</label>
        <input type="email" id="email" name="email"><br>
        <input type="submit" value="S'inscrire" id="submit" name="submit">
    </form>
</section>