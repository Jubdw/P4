<?php $title = "Gestion des commentaires signalés et bloqués"; ?>

<?php ob_start(); ?>

<div class="title admin-title">
	<h2>Gestion des commentaires signalés et bloqués:</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
	<br>
	<a href="index.php?action=commentManagement&amp;page=1">Gestion des commentaires</a>
</div>


<div id="reported-comment-manage">
	<h3>Commentaires signalés</h3>
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
			<div class="other-pages"><a href="index.php?action=reportedCommentManagement&amp;page=<?= $i ?>&amp;bpage=<?= $_GET['bpage'] ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
	<?php
	while ($repComment = $reportedComments->fetch())
	{
	?>
	<div class="comment-admin-list reported">
		<div class="admin-comment">
			<p><a href="index.php?action=showProfile&amp;id=<?= $repComment['user_id'] ?>&amp;page=1"><strong><?= $repComment['user_name'] ?></strong></a> le : <?= $repComment['comment_date_fr'] ?></p>
			<p><?= nl2br(htmlspecialchars($repComment['comment'])) ?></p>
		</div>
		<div class="comment-admin-commands">
			<div class="comment-block">
				<a href="index.php?action=blockComment&amp;id=<?= $repComment['id'] ?>&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $_GET['bpage'] ?>">&#10004;</br>Bloquer</br>&#10004;</a>
			</div>
			<div class="comment-delete">
				<a href="index.php?action=deleteComment&amp;id=<?= $repComment['id'] ?>&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $_GET['bpage'] ?>" onclick="return(confirm('Cette action est définitive. Etes-vous sûr de vouloir supprimer ce commentaire ?'));">&#10060;</br>Effacer</br>&#10060;</a>
			</div>
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
			<div class="other-pages"><a href="index.php?action=reportedCommentManagement&amp;page=<?= $i ?>&amp;bpage=<?= $_GET['bpage'] ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
</div>

<div id="comment-management">
	<h3>Commentaires bloqués</h3>
	<div class="paging">
		<?php 
		for ($bi = 1; $bi <= $bMaxPages; $bi++) {
			if ($bi == $bCurrentPage) 
			{
			?>
			<div class="current-page"><p> <?= $bi ?> </p></div>
			<?php 
			}
			else 
			{
			?>
			<div class="other-pages"><a href="index.php?action=reportedCommentManagement&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $bi ?>"> <?= $bi ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
	<?php 
	while ($blockComment = $blockedComments->fetch())
	{
	?>
	<div class="comment-admin-list c-blocked">
		<div class="admin-comment">
			<p><a href="index.php?action=showProfile&amp;id=<?= $blockComment['user_id'] ?>&amp;page=1"><strong><?= $blockComment['user_name'] ?></strong></a> le : <?= $blockComment['comment_date_fr'] ?></p>
			<p><?= nl2br(htmlspecialchars($blockComment['comment'])) ?></p>
		</div>
		<div class="comment-admin-commands">
			<div class="comment-unblock">
				<a href="index.php?action=deBlockComment&amp;id=<?= $blockComment['id'] ?>&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $_GET['bpage'] ?>">&#10004;</br>Débloquer</br>&#10004;</a>
			</div>
			<div class="comment-delete">
				<a href="index.php?action=deleteComment&amp;id=<?= $blockComment['id'] ?>&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $_GET['bpage'] ?>" onclick="return(confirm('Cette action est définitive. Etes-vous sûr de vouloir supprimer ce commentaire ?'));">&#10060;</br>Effacer</br>&#10060;</a>
			</div>
		</div>
	</div>
	<?php 
	}
	?>
	<div class="paging">
		<?php 
		for ($bi = 1; $bi <= $bMaxPages; $bi++) {
			if ($bi == $bCurrentPage) 
			{
			?>
			<div class="current-page"><p> <?= $bi ?> </p></div>
			<?php 
			}
			else 
			{
			?>
			<div class="other-pages"><a href="index.php?action=reportedCommentManagement&amp;page=<?= $_GET['page'] ?>&amp;bpage=<?= $bi ?>"> <?= $bi ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>