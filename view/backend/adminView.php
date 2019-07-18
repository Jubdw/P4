<?php $title = "Administration du site - Bonjour M.Forteroche"; ?>

<?php ob_start(); ?>

<div class="title">
	<h3>Bienvenue sur la page d'aministration, M.Forteroche</h3>
</div>

<div class="new-post">
	<h4>Ajoutez ici un nouveau chapitre au blog :</h4>
</div>

<div class="post-management">
	<a href="index.php?action=postManagement">Gestion des chapitres</a>
</div>

<div class="comment-management">
	
</div>

<div class="user-management">
	<a href="index.php?action=userManagement">Gestion des utilisateurs</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>