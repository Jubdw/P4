<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
	if ($_SESSION['name'] == $_GET['name']) {
		$title = "Votre profil";
		$u_com = "Vos commentaires";
	}
	else {
		$title = "Profil du membre " . $_GET['name'];
		$u_com = "Commentaires de " . $_GET['name'];
	}
}
?>

<?php ob_start(); ?>
<div class="title">
	<h1><?= $title ?></h1>
</div>

<div class="user-profile">
	<h4>Nom : <?= $_GET['name'] ?></h4>
	<em><a href="mailto:<?= $profile['email'] ?>">E-mail : <?= $profile['email'] ?></a></em>
	<em><p>Membre depuis le : <?= $profile['register_date_fr'] ?></p></em>
</div>

<div>
	<h4><?= $u_com ?></h4>
</div>

<div class="user-comments">
	<?php 
	while ($data = $userComments->fetch())
	{
	?>
	<div class="comment">
		<em><strong>Le <?= $data['comment_date_fr'] ?></strong></em>
		<p><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
		<?php 
		if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
			if ($_SESSION['name'] == $_GET['name']) 
			{
			?>
			<div class="link-update"><a href="index.php?action=update&amp;id=<?= $data['id'] ?>">Modifier</a></div>
			<?php
			}
			else 
			{
			?>
			<a href="#">Signaler</a>
			<?php
			}
		}
		?>
		<br>
		<div class="line-comment"></div>
		<br>	
	</div>
	<?php
	}
	?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>