<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === 'addComment' ? 'Poster' : 'Mettre à jour';
?>

<form method="post" action="../Projet_4/index.php?route=<?= $route; ?>&episodeId=<?= htmlspecialchars($episode->getId()); ?>">
    <label for="content">Commentaire</label>
    <textarea name="content" id="content" class="wysiwygComment"><?= isset($post) ?htmlspecialchars($post->get('content')): '';?> </textarea>
    <input type="submit" name="submit" id="submit" value="<?= $submit; ?>">
</form>