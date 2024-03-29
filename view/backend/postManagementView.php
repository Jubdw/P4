<?php $title = "Gestion des chapitres"; ?>

<?php ob_start(); ?>

<div class="title admin-title">
	<h2>Gestion des chapitres :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
	<br>
	<a href="index.php?action=newPost">Rédiger un nouveau chapitre</a>
</div>

<div id ="post-management">
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
			<div class="other-pages"><a href="index.php?action=postManagement&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
	<?php 
	while ($posts = $posts_small->fetch()) 
	{
	?>
	<div class="post-admin-list">
		<div class="small-post">
			<div>
				<h4><?= $posts['title'] ?></h4>
				<strong><em>Le : <?= $posts['creation_date_fr'] ?></em></strong>
				<p><?= $posts['content'] ?>...</p>
			</div>
		</div>
		<div class=" post-manage">
			<div class="post-link">
				<a href="index.php?action=post&amp;id=<?= $posts['id'] ?>&amp;page=1">&#128270;<br>Lire<br>&#128270;<br></a>
			</div>
			<div class="post-edit">
				<a href="index.php?action=postToEdit&amp;id=<?= $posts['id'] ?>">&#10004;<br>Modifier<br>&#10004;</a>
			</div>
			<div class="post-delete">
				<a href="index.php?action=deletePost&amp;id=<?= $posts['id'] ?>" onclick="return(confirm('Cette action est définitive. Etes-vous sûr de vouloir supprimer ce chapitre ?'));">&#10060;<br>Effacer<br>&#10060;</a>
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
			<div class="other-pages"><a href="index.php?action=postManagement&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>