<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link rel="apple-touch-icon" sizes="57x57" href="/public/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/public/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/public/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/public/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/public/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/public/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/public/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/public/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/public/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/public/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <script src="https://cdn.tiny.cloud/1/50b9t4itc4o9gqlx8amxckfmfju1qcpyvxljpdpjvjgnh820/tinymce/5/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#tm_new_post'
            });
        </script>
    </head>
        
    <body>
        <script src="public/js/scroll.js"></script>

    	<header>
    		<div class="header-logo"><a href="index.php"><img src="public/images/JF_icon.png" alt="Jean Forteroche : acceuil du site"></a></div>
    		<nav>
    			<ul>
	    			<li><a href="index.php?action=listPosts&amp;page=1">Blog</a></li>
	    			<li><a href="index.php?action=about">À propos</a></li>
	    			<li><a href="index.php?action=contact">Contact</a></li>
                    <?php 
                    if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
                        ?>
                        <li><p class="profile-link"><a href="index.php?action=showProfile&amp;id=<?= $_SESSION['id'] ?>&amp;page=1"><?php echo $_SESSION['name'] ?></a></p></li>
                        <li><a href="index.php?action=logout">Déconnexion</a></li>
                        <?php
                        if (isset($_SESSION['status']) AND $_SESSION['status'] === "admin") {
                        ?>
                        <li class="admin-link"><a href="index.php?action=adminAccess">Administration du site</a></li>
                        <?php
                        }
                    }
                    else {
                        ?>
                        <li><a href="index.php?action=register">Connexion</a></li>
                        <?php
                    }
                    ?>	    			
	    		</ul>
    		</nav>
    	</header>

        <div class="snowflakes" aria-hidden="true">
            <div class="snowflake">
            ❅
            </div>
            <div class="snowflake">
            ❅
            </div>
            <div class="snowflake">
            ❆
            </div>
            <div class="snowflake">
            ❄
            </div>
            <div class="snowflake">
            ❅
            </div>
            <div class="snowflake">
            ❆
            </div>
            <div class="snowflake">
            ❄
            </div>
            <div class="snowflake">
            ❅
            </div>
            <div class="snowflake">
            ❆
            </div>
            <div class="snowflake">
            ❄
            </div>
        </div>

    	<div id="content">
        <?= $content ?>
    	</div>

        <div><a id="b-Back" class="b-Hidden" href="#up"></a></div>

    	<footer>
    		<div id="links">
    			<p>Retrouvez moi sur les réseaux sociaux :</p>
    			<ul>
	    			<li><img src="public/images/facebook-icon.png"></li>
	    			<li><img src="public/images/instagram-icon.png"></li>
	    			<li><img src="public/images/Twitter-icon.png"></li>
	    		</ul>
    		</div>
    		<div id="legal">
    			<p>Copyright © 2019 - Jean Forteroche - Tous droits réservés / Site réalisé par <a href="https://julienbarre.fr">un glandu</a></p>
                <div class="footer-links">
    			<p>Plan du site : <a href="index.php">Acceuil</a> | <a href="index.php?action=listPosts&amp;page=1">Blog</a> | <a href="index.php?action=about">À propos</a> | <a href="index.php?action=contact">Contact</a> | <?php if (isset($_SESSION['id']) AND isset($_SESSION['name'])) { ?><span class="profile-link"><a href="index.php?action=showProfile&amp;id=<?= $_SESSION['id'] ?>&amp;page=1"><?php echo $_SESSION['name'] ?></a></span> | <a href="index.php?action=logout">Déconnexion</a><?php } else { ?><a href="index.php?action=register">Connexion</a><?php }?></p>
                </div>
    		</div>
    	</footer>

    </body>
</html>