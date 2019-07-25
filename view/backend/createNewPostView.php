<?php $title = "Administration du site - Nouvel épisode du roman"; ?>

<?php ob_start(); ?>

<div class="title">
	<h1>Rédigez un nouvel épisode du roman</h1>
	<br>
	<h1>Billet Simple pour l'Alaska</h1>
</div>

<div class="create-new-post">
	<form action="index.php?action=addPost" method="post">
		<label for="title">Choisissez un titre :</label>
		<br>
		<input type="text" name="title">
		<br>
		<textarea id="tm_new_post" name="content"></textarea>
		<br>
		<input type="submit" />
		<br>
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>