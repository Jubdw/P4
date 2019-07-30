<?php $title = "Administration du site - Bonjour M.Forteroche"; ?>

<?php ob_start(); ?>

<div class="title admin-title">
	<h3>Bienvenue sur la page d'aministration, M.Forteroche</h3>
</div>

<div class="admin-view-posts">
	<div class="new-post">
		<a href="index.php?action=newPost">Rédigez un nouveau chapitre</a>
	</div>

	<div class="post-management">
		<a href="index.php?action=postManagement&amp;page=1">Gestion des chapitres</a>
	</div>
</div>

<div class="admin-view-comments">
	<div class="comment-management">
		<a href="index.php?action=commentManagement&amp;page=1">Gestion des commentaires</a>
	</div>
	<div class="comment-management">
		<a href="index.php?action=reportedCommentManagement&amp;page=1&amp;bpage=1">Gestion des commentaires Signalés & Bloqués</a>
	</div>
</div>

<div class="user-management">
	<a href="index.php?action=userManagement&amp;page=1">Gestion des utilisateurs</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>