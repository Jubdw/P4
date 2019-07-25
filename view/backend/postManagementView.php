<?php $title = "Gestion des chapitres"; ?>

<?php ob_start(); ?>

<div class="title admin-title">
	<h2>Gestion des chapitres :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
	<br>
	<a href="index.php?action=newPost">Rédiger un nouveau chapitre</a>
</div>

<div id ="post-management">
	<?php 
	while ($posts = $posts_small->fetch()) 
	{
	?>
	<div class="post-admin-list">
		<div class="small-post">
			<h4><?= $posts['title'] ?></h4>
			<strong><em>Le : <?= $posts['creation_date_fr'] ?></em></strong>
			<p><?= $posts['small_content'] ?>...</p>
		</div>
		<div class=" post-manage">
			<div class="post-link">
				<a href="index.php?action=post&amp;id=<?= $posts['id'] ?>&amp;page=1">&#128270;<br>Lire<br>&#128270;<br></a>
			</div>
			<div class="post-edit">
				<a href="index.php?action=postToEdit&amp;id=<?= $posts['id'] ?>">&#10004;<br>Modifier<br>&#10004;</a>
			</div>
			<div class="post-delete">
				<a href="index.php?action=deletePost&amp;id=<?= $posts['id'] ?>" onclick="return(confirm('Cette action est définitive. Etes-vous sûr de vouloir supprimer ce chapitre ?'));">&#128683;<br>Effacer<br>&#128683;</a>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>