<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?></title>

    <link href="<?= $style ?>.css" rel="stylesheet" />
    <link href="../Projet_4/public/css//bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@400;700&family=Lato&display=swap" rel="stylesheet">
    <link rel="icon" href="../Projet_4/public/images/logo-light.png">
    <script src="../Projet_4/public/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            mode: "specific_input",
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent('<h2></h2>');
                });
            },
            language: 'fr_FR',
            selector: "input#title",
            height: 100,
            plugins: 'autosave colorpicker emoticons preview textcolor wordcount',
            toolbar: 'bold italic underline ',
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
    <script>
        tinymce.init({
            mode: "specific_textareas",
            language: 'fr_FR',
            editor_selector: "wysiwygComment",
            plugins: ' autosave colorpicker emoticons preview textcolor wordcount',
            toolbar: 'bold italic underline',
            skin: 'commentDark',
            content_css: 'commentDark',
            browser_spellcheck: true,
            contextmenu: true,
            menubar: false
        });
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <img class="navbar-brand" src="../Projet_4/public/images/logo-dark.png" alt="Logo">
            <div class="container-fluid" id="menu-principal">
                <ul class="nav">
                    <li class="nav-item"><a href="../Projet_4/index.php"><img src="../Projet_4/public/icones/home.svg" alt="accueil" class="icone"> Accueil</a></li>
                    <?php
                    if ($this->session->get('pseudo')) {
                    ?>
                        <li class="nav-item"><a href="../Projet_4/index.php?route=profile"><img src="../Projet_4/public/icones/profile.svg" alt="profil" class="icone"> Mon profil</a></li>
                        <li class="nav-item"><a href="../Projet_4/index.php?route=logout"><img src="../Projet_4/public/icones/logout.svg" alt="deconnexion" class="icone"> Se deconnecter</a></li>
                        <?php if ($this->session->get('role') === 'Administrateur') { ?>
                            <li class="nav-item"><a href="../Projet_4/index.php?route=administration"><img src="../Projet_4/public/icones/admin.svg" alt="administration" class="icone"> Administration</a></li>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item"><a href="../Projet_4/index.php?route=login"><img src="../Projet_4/public/icones/login.svg" alt="connexion" class="icone"> Se connecter</a></li>
                        <li class="nav-item"><a href="../Projet_4/index.php?route=register"><img src="../Projet_4/public/icones/register.svg" alt="enregistrement" class="icone"> S'inscrire </a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="messages">
                <?= $this->session->show('register'); ?>
                <?= $this->session->show('login'); ?>
                <?= $this->session->show('logout'); ?>
                <?= $this->session->show('deleteAccount'); ?>
            </div>
        </nav>
    </header>

    <?= $content ?>

    <footer class="container-fluid col-xs-12">
        <section class="row container col-xs-12">
            <ul class="col-sm-offset-1 col-sm-5 col-xs-12">
                <li><a href="../Projet_4/index.php?route=mentions"> Mentions Légales</a></li>
                <li><a href="../Projet_4/index.php?route=confidentiality">Politique de confidentialité</a></li>
            </ul>
            <ul class="col-sm-5 col-xs-12">
                <li><a href="../Projet_4/index.php">Accueil</a></li>
                <li><a href="../Projet_4/index.php?route=APropos">A propos de l'auteur</a></li>
            </ul>
        </section>
        <section id="copyright" class="col-xs-12">
            <p>© 2020 Site par Elodie BASSIBEY - Formation OpenClassrooms <a href="https://openclassrooms.com/fr/paths/48-developpeur-web-junior"> Développeur Web Junior</a></p>
        </section>

    </footer>
</body>

</html>