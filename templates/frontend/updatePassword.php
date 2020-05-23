<?php $this->title = 'Modifier mon mot de passe';
$this->style = 'public/css/back'; ?>

<section class="enTete">
    <div class="container">
        <h1>Modification du mot de passe</h1>
    </div>
</section>

<section id="content" class="container-fluid">
    <div>
        <?= $this->session->show('wrongPassword'); ?>
        <form method='post' action="index.php?route=updatePassword">
            <label for="oldPassword">Ancien mot de passe</label><br>
            <input type="password" id="oldPassword" name="oldPassword"><br>
            <label for="newPassword">Nouveau mot de passe</label><br>
            <input type="password" id="newPassword" name="newPassword"><br>
            <input type="submit" value="Mettre à jour" id="submit" name="submit">
        </form>
    </div>
</section>