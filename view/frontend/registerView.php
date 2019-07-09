<?php $title = "Inscription à l'espace membre"; ?>

<?php ob_start(); ?>
<div class="titles">
	<h2>Inscription à l'espace membre :</h2>
</div>

<div class="register-form">
	<form action="index.php?action=registerUser" method="post">
		<div class="inputs">
			<label for="name">Nom</label><br>
			<input type="text" id="name" name="name" />
		</div>
		<div class="inputs">
			<label for="password">Mot de passe</label><br>
			<input type="password" id="password" name="password" />
		</div>
		<div class="inputs">
			<label for="password_check">Répétez mot de passe</label><br>
			<input type="password" id="password_check" name="password_check" />
		</div>
		<div class="inputs">
			<label for="email">Email</label><br>
			<input type="text" id="email" name="email" />
		</div>
		<div class="submit">
			<input type="submit" />
		</div>
	</form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>