<?php $title = 'Contactez Jean Forteroche'; ?>

<?php ob_start(); ?>

<?php 
if (isset($_GET['mailsent']) && $_GET['mailsent'] == 1) {
?>
<div class="mailsent">
	<p>Merci, votre message a bien été envoyé.</p>
</div>
<?php 
}
?>

<div class="contact">
	<div class="titles titles-contact">
		<h1>Contactez Jean Forteroche</h1>
		<h1><a href="mailto:jeanforteroche@fakeadress.com">Ici</a></h1>
	</div>
	<div class="title title-contact">
		<h2>Ou remplissez ce formulaire :</h2>
	</div>
</div>

<div class="contact-form">
	<form action="index.php?action=mail" method="post">
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