<?php $this->title = " Connexion";
$this->style = 'public/css/style'; ?>


<section class="enTete">
    <div class="container">
        <h1>Connection</h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div class="form-connection">
        <form method="post" action="index.php?route=login">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')) : ''; ?>"><br>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"><br>
            <?= $this->session->show('errorLogin'); ?><br>
            <input type="submit" value="Se connecter" id="submit" name="submit">
        </form>
    </div>
</section>