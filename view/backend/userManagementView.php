<?php $title = "Gestion des utilisateurs"; ?>

<?php ob_start(); ?>

<div class="title admin-title">
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
		<p>Status : <span class="big"><?= $users['status'] ?></span></p>
		<?php 
		if ($users['status'] === "admin") 
		{
		?>
		<div class="user-is-admin">
			<a href="index.php?action=showProfile&amp;id=<?= $users['id'] ?>">Aller sur votre profil</br>&#127968;</a>
		</div>
		<?php
		}
		elseif ($users['status'] === "user")
		{
		?>
		<div class="user-not-blocked">
			<a href="index.php?action=blockUser&amp;id=<?= $users['id'] ?>">Bloquer</br>&#128683;</a>
		</div>
		<?php 
		}
		elseif ($users['status'] === "blocked")
		{
		?>
		<div class="user-blocked">
			<a href="index.php?action=unblockUser&amp;id=<?= $users['id'] ?>">Débloquer</br>&#128281;</a>
		</div>
		<?php 
		}
		?>
	</div>
	<?php 
	}
	?>
	<div class="paging">
		<?php 
		for ($i = 1; $i <= $maxPages; $i++) {
			if ($i == $currentPage) 
			{
			?>
			<div class="current-page"><p> <?= $i ?> </p></div>
			<?php 
			}
			else 
			{
			?>
			<div class="other-pages"><a href="index.php?action=userManagement&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
			<?php 
			}
		}
		?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>