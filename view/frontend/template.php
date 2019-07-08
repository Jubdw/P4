<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    	<header>
    		<h3><a href="index.php">Jean Forteroche</a></h3>
    		<nav>
    			<ul>
	    			<li><a href="index.php?action=listPosts">Blog</a></li>
	    			<li><a href="index.php?action=about">À propos</a></li>
	    			<li><a href="index.php?action=contact">Contact</a></li>
	    			<li><a href="#">Connexion</a></li>
	    		</ul>
    		</nav>
    	</header>


    	<div id="content">
        <?= $content ?>
    	</div>

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
    			<p>Plan du site : <a href="index.php">Acceuil</a> | <a href="index.php?action=listPosts">Blog</a> | <a href="index.php?action=about">À propos</a> | <a href="index.php?action=contact">Contact</a> | <a href="#">Connexion</a></p>
    		</div>
    	</footer>

    </body>
</html>