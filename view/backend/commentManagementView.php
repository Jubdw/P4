<?php $title = "Gestion des commentaires"; ?>

<?php ob_start(); ?>

<div class="title">
	<h2>Gestion des commentaires :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
</div>

<div id="comment-management">
	<h3>Autres commentaires</h3>
	<em>(non-signalés, non bloqués)</em>
	<?php 
	while ($comment = $noReportComments->fetch())
	{
	?>
	<div class="comment-admin-list">
		<div class="admin-comment">
			<p><strong><?= $comment['user_name'] ?></strong> le : <?= $comment['comment_date_fr'] ?></p>
			<p><?= $comment['comment'] ?></p>
		</div>
		<div class="comment-block">
			<a href="index.php?action=blockComment&amp;id=<?= $comment['id'] ?>">Bloquer</a>
		</div>
	</div>
	<?php 
	}
	?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>