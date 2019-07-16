<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <script src="public/js/scroll.js"></script>

    	<header>
    		<h3><a href="index.php">Jean Forteroche</a></h3>
    		<nav>
    			<ul>
	    			<li><a href="index.php?action=listPosts">Blog</a></li>
	    			<li><a href="index.php?action=about">À propos</a></li>
	    			<li><a href="index.php?action=contact">Contact</a></li>
                    <?php 
                    if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
                        ?>
                        <li><a href="index.php?action=showProfile&amp;id=<?= $_SESSION['id'] ?>"><?php echo $_SESSION['name'] ?></a></li>
                        <li><a href="index.php?action=logout">Déconnexion</a></li>
                        <?php
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
    			<p>Plan du site : <a href="index.php">Acceuil</a> | <a href="index.php?action=listPosts">Blog</a> | <a href="index.php?action=about">À propos</a> | <a href="index.php?action=contact">Contact</a> | <?php if (isset($_SESSION['id']) AND isset($_SESSION['name'])) { ?><a href="index.php?action=showProfile&amp;id=<?= $_SESSION['id'] ?>"><?php echo $_SESSION['name'] ?></a> | <a href="index.php?action=logout">Déconnexion</a><?php } else { ?><a href="index.php?action=register">Connexion</a><?php }?></p>
    		</div>
    	</footer>

    </body>
</html>