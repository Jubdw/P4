<?php $title = 'À propos de Jean Forteroche'; ?>

<?php ob_start(); ?>
<div class="title">
<h1>Qui suis-je ?</h1>
</div>
<div class="about">
	<div class="about-text">
		<p>Jean Forteroche est un écrivain fictif né en 1954 en banlieue parisienne. Issu d'un milieu urbain et populaire, Jean Forteroche cherche très tôt refuge dans la littérature.</p>
	</div>
	<img src="public/images/photos/Jean_Forteroche.jpg" alt="Jean Forteroche, acteur, écrivain, aventurier">
    <div class="about-text">
	    <p>Il commence à s'évader avec Voyage au centre de la terre, De la terre à la lune ou encore Cinq semaines en ballon de Jules Verne. Il poursuit des études en littérature française et roumaine, et sort premier de sa promotion.</p>
	    <p>Il publie ensuite des poèmes sur la montagne dans la revue mensuelle Fictive, et remporte le premier prix du concours de nouvelles Plume de talent ! de sa ville.</p>
	    <p>C'est quand il découvre Journal d’un voyage de Chamouni à la Cime du Mont-Blanc en juillet et aoust 1787 de Horace Benedict de Saussure, qu'il décide de partir à l'aventure en Alaska, afin d'écrire son premier livre.</p>
	    <p>Ecrivain généreux et proche de ses lecteurs, Jean Forteroche a choisi de rendre son oeuvre public en la partageant ici, sur ce site, chapitre après chapitre.</p>
	    <p>Ce projet ambitieux s'achevera par la publication papier d'un livre, qui s'intitulera Billet simple pour l'Alaska.</p>
	</div>
</div>

<div class="books"></div>

<div class="movies"></div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>