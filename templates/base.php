<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>
    <link href="<?= $style ?>.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&family=Lato&display=swap" rel="stylesheet">
    <script src="../Projet_4/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            mode: "specific_input",
            language: 'fr_FR',
            selector: "input#title",
            height: 100,
            plugins: 'autosave colorpicker emoticons preview textcolor wordcount',
            toolbar: 'bold italic underline h2',
            block_formats: 'Titre =h2',
            skin: 'blog',
            content_css: 'blog',
            menubar: false
        });
    </script>
    <script>
        tinymce.init({
            mode: "specific_textareas",
            language: 'fr_FR',
            editor_selector: "wysiwygContent",
            plugins: 'image link autolink autosave colorpicker emoticons preview textcolor wordcount',
            toolbar: [
                'cut copy paste | link unlink image insertimage | preview',
                'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjusitify | outdent indent'
            ],
            skin: 'blog',
            content_css: 'blog',
            browser_spellcheck: true,
            contextmenu: true
        });
    </script>
</head>

<body>
    <div id="content">
        <?= $content ?>
    </div>
</body>

</html>