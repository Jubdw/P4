<?php $title = "Gestion des commentaires"; ?>

<?php ob_start(); ?>

<div class="title">
	<h2>Gestion des commentaires :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
	<br>
	<a href="index.php?action=reportedCommentManagement&amp;page=1&amp;bpage=1">Gestion des commentaires Signalés & Bloqués</a>
</div>

<div id="comment-management">
	<h3>Commentaires des utilisateurs</h3>
	<em>(non-signalés, non bloqués)</em>
	<div class="paging">
		<?php 
		for ($i = 1; $i <= $maxPages; $i++) {
			if ($i == $currentPage) 
			{
			?>
			<div class="current-page"><p> <?= $i ?> </p></div>
			<?php 
			}
			else 
			{
			?>
			<div class="other-pages"><a href="index.php?action=commentManagement&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
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
			<a href="index.php?action=blockComment&amp;id=<?= $comment['id'] ?>&amp;page=<?= $_GET['page'] ?>">&#128683;</br>Bloquer</br>&#128683;</a>
		</div>
	</div>
	<?php 
	}
	?>
	<div class="paging">
		<?php 
		for ($i = 1; $i <= $maxPages; $i++) {
			if ($i == $currentPage) 
			{
			?>
			<div class="current-page"><p> <?= $i ?> </p></div>
			<?php 
			}
			else 
			{
			?>
			<div class="other-pages"><a href="index.php?action=commentManagement&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>