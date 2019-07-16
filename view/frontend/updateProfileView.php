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
	</form>
</div>

<div class="edit-profile edit-password">
	<h3>Modifier votre E-mail</h3>
	<form action="index.php?action=updateEmail" method="post">
		<div class="edit-inputs">
			<label for="email">Nouvelle adresse mail</label><br>
			<input type ="text" id="email" name="email" /><br>
		</div>
		<div class="submit">
			<input type="submit" />
		</div>
	</form>
</div>

<div class="edit-profile edit-email"></div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>