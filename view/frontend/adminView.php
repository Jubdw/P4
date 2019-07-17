<?php $title = "Administration du site - Bonjour M.Forteroche"; ?>

<?php ob_start(); ?>

<script src="public/js/hide.js"></script>
<div class="title">
	<h3>Bienvenue sur la page d'aministration, M.Forteroche</h3>
</div>

<div class="new-post">
	<h4>Ajoutez ici un nouveau chapitre au blog :</h4>
</div>

<div class="post-management">
	<h4>Gestion des chapitres :</h4>
</div>

<div id="user-management">
	<h4>Gestion des utilisateurs :</h4>
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
		if ($users['status'] != "blocked") 
		{
		?>
		<div class="user-delete">
			<a href="index.php?action=blockUser&amp;id=<?= $users['id'] ?>">Bloquer</a>
		</div>
		<?php
		}
		else 
		{
		?>
		<div class="user-delete">
			<p><em>Compte bloqué</em></p>
		</div>
		<?php 
		}
		?>
	</div>
	<?php 
	}
	?>
</div>

<div class="comment-management">
	<h4>Gestion des commentaires :</h4>
	<em>Les commentaires les plus signalés par les utilisateurs sont affichés en premiers.</em>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>