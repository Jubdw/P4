<?php $title = 'Contactez Jean Forteroche'; ?>

<?php ob_start(); ?>
<div class="contact">
	<div class="titles">
		<h1>Contactez Jean Forteroche</h1>
		<h3><a href="mailto:jeanforteroche@fakeadress.com">Ici</a></h3>
	</div>
	<div class="title">
		<h2>Ou remplissez ce formulaire :</h2>
	</div>
</div>

<div class="contact-form">
	<form action="" method="post">
		<div class="inputs">
			<label for="name">Votre nom : </label>
			<input type="text" name="name" id="name" required>
		</div><br>
		<div class="inputs">
			<label for="email">Votre email : </label>
			<input type="email" name="email" id="email" required>
		</div><br>
		<div class="inputs">
			<label for="message">Votre message : </label>
			<textarea name="message" id="message" rows="8" cols="40"></textarea>
		</div><br>
		<div class="submit">
	        <input type="submit" />
	    </div>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>