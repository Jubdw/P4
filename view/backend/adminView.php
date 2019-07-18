<?php $title = "Administration du site - Bonjour M.Forteroche"; ?>

<?php ob_start(); ?>

<div class="title">
	<h3>Bienvenue sur la page d'aministration, M.Forteroche</h3>
</div>

<div class="new-post">
	<h4>Ajoutez ici un nouveau chapitre au blog :</h4>
</div>

<div class="post-management">
	<h4>Gestion des chapitres :</h4>
</div>

<div class="user-management">
	<a href="index.php?action=userManagement">Gestion des utilisateurs</a>
</div>

<div class="comment-management">
	<h4>Gestion des commentaires :</h4>
	<em>Les commentaires les plus signalés par les utilisateurs sont affichés en premiers.</em>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>