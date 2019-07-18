<?php $title = "Gestion des commentaires"; ?>

<?php ob_start(); ?>

<div class="title">
	<h2>Gestion des commentaires :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
</div>


<div id="reported-comment-manage">
	<h3>Commentaires signalés</h3>
	<?php
	while ($repComment = $reportedComments->fetch())
	{
	?>
	<div class="comment-admin-list reported">
		<div class="admin-comment">
			<p><strong><?= $repComment['user_name'] ?></strong> le : <?= $repComment['comment_date_fr'] ?></p>
			<p><?= $repComment['comment'] ?></p>
		</div>
		<div class="comment-block">
			<a href="index.php?action=blockComment&amp;id=<?= $repComment['id'] ?>">Bloquer</a>
		</div>
	</div>
	<?php 
	}
	?>
</div>

<div id="comment-management">
	<h3>Commentaires bloqués</h3>
	<?php 
	while ($blockComment = $blockedComments->fetch())
	{
	?>
	<div class="comment-admin-list">
		<div class="admin-comment">
			<p><strong><?= $blockComment['user_name'] ?></strong> le : <?= $blockComment['comment_date_fr'] ?></p>
			<p><?= $blockComment['comment'] ?></p>
		</div>
		<div class="comment-block">
			<a href="index.php?action=deBlockComment&amp;id=<?= $blockComment['id'] ?>">Débloquer</a>
		</div>
	</div>
	<?php 
	}
	?>
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