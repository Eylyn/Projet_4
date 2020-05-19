<?php
$route = isset($post) && $post->get('id') ? 'editEpisode&episodeId='.$post->get('id') : 'addEpisode';
$submit = $route === 'addEpisode' ? 'Publier' : 'Mettre à jour';
?>

<form method="post" action="index.php?route=<?= $route; ?>">
    <label for="title">Titre</label>
    <input type="text" id="title" name="title" class="wysiwygTitle" value="<?= isset($post) ? htmlspecialchars($post->get('title')): ''; ?>">
    <label for="content">Contenu</label>
    <textarea name="content" id="content" class="wysiwygContent"><?= isset($post) ? htmlspecialchars($post->get('content')): ''; ?> </textarea>
    <input type="submit" id="submit" name="submit" value="<?= $submit; ?>">
</form>