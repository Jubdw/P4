<?php 
if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']) {
	$title = "Votre profil";
	$u_com = "Vos commentaires";
}
if (!isset($_SESSION['id']) || $_SESSION['id'] != $_GET['id']) {
	$title = "Profil du membre " . $profile['name'];
	$u_com = "Commentaires de " . $profile['name'];
}
?>

<?php ob_start(); ?>
<div class="title">
	<h1><?= $title ?></h1>
</div>

<div class="user-profile">
	<h4>Nom : <?= $profile['name'] ?></h4>
	<?php 
	if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']) {
		?>
		<em>E-mail : <a href="mailto:<?= $profile['email'] ?>"><?= $profile['email'] ?></a></em>
		<?php
	}
	?>
	<em><p>Membre depuis le : <?= $profile['register_date_fr'] ?></p></em>
	<?php 
	if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']) {
		?>
		<a href="index.php?action=editProfile">Modifier votre profil</a>
		<?php
	}
	?>
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
		if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']) {
			?>
			<div class="link-update"><a href="index.php?action=update&amp;id=<?= $data['id'] ?>">Modifier</a></div>
			<?php
		}
		if (!isset($_SESSION['id']) || $_SESSION['id'] != $_GET['id']) {
			?>
			<div class="link-report"><a href="index.php?action=reportComment&amp;id=<?= $data['id'] ?>">Signaler</a></div>
			<?php
		}
		?>
	</div>
	<?php
	}
	?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>