<?php $title = "Modifier votre profil" ?>

<?php ob_start(); ?>
<div class="edit-profile edit-name">
	<h3>Modifier votre NOM</h3>
	<form action="index.php?action=updateName" method="post">
		<div class="edit-inputs">
			<label for="name">Nouveau nom</label><br>
			<input type ="text" id="name" name="name" /><br>
		</div>
		<div class="submit">
			<input type="submit" />
		</div>
</div>

<div class="edit-profile edit-password"></div>

<div class="edit-profile edit-email"></div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>