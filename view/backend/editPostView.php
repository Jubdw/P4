<?php $title = "Modifier un épisode du roman - " . $postToEdit['title']; ?>

<?php ob_start(); ?>

<div class="title title-newPostView">
	<h1>Modifier un épisode du roman</h1>
	<br>
	<h2><?= $postToEdit['title'] ?></h2>
	<br>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
	<br>
	<a href="index.php?action=postManagement">Gestion des chapitres</a>
</div>

<div class="create-new-post">
	<form action="index.php?action=editPost&amp;id=<?= $postToEdit['id'] ?>" method="post">
		<label for="title">Titre</label>
		<br>
		<input type="text" name="title" value="<?= $postToEdit['title'] ?>">
		<br>
		<textarea id="tm_new_post" name="content" rows="40" cols="20"><?= $postToEdit['content'] ?></textarea>
		<br>
		<input type="submit" />
		<br>
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>