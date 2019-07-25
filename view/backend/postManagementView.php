<?php $title = "Gestion des utilisateurs"; ?>

<?php ob_start(); ?>

<div class="title">
	<h2>Gestion des chapitres :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
</div>

<div id ="post-management">
	<?php 
	while ($posts = $posts_small->fetch()) 
	{
	?>
	<div class="post-admin-list">
		<div class="small-post">
			<h4><?= $posts['title'] ?></h4>
			<em>Le : <?= $posts['creation_date_fr'] ?></em>
			<p><?= $posts['small_content'] ?>...</p>
		</div>
		<div class=" post-manage">
			<div class="post-link">
				<a href="index.php?action=post&amp;id=<?= $posts['id'] ?>&amp;page=1">Voir le chapitre</a>
			</div>
			<div class="post-edit">
				<a href="index.php?action=postToEdit&amp;id=<?= $posts['id'] ?>">Modifier</a>
			</div>
			<div class="post-delete">
				<a href="#">Effacer</a>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>