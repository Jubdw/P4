<?php $title = "Gestion des utilisateurs"; ?>

<?php ob_start(); ?>

<div class="title">
	<h2>Gestion des utilisateurs :</h2>
	<a href="index.php?action=adminAccess">Retour à l'acceuil admin</a>
</div>

<div id="user-management">
	<?php 
	while ($users = $userManagement->fetch())
	{
	?>
	<div class="user-data">
		<p><strong><a href="index.php?action=showProfile&amp;id=<?= $users['id'] ?>"><?= $users['name'] ?></a></strong></p>
		<p>Inscrit(e) depuis le <?= $users['register_date_fr'] ?></p>
		<p><a href="mailto:<?= $users['email'] ?>"><?= $users['email'] ?></a></p>
		<p>Status : <?= $users['status'] ?></p>
		<?php 
		if ($users['status'] === "admin") 
		{
		?>
		<div class="user-is-admin">
			<a href="index.php?action=showProfile&amp;id=<?= $users['id'] ?>">Aller sur votre profil</a>
		</div>
		<?php
		}
		elseif ($users['status'] === "user")
		{
		?>
		<div class="user-delete">
			<a href="index.php?action=blockUser&amp;id=<?= $users['id'] ?>">Bloquer</a>
		</div>
		<?php 
		}
		elseif ($users['status'] === "blocked")
		{
		?>
		<div class="user-delete">
			<a href="index.php?action=unblockUser&amp;id=<?= $users['id'] ?>">Débloquer</a>
		</div>
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