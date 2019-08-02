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
	<h4><?= $profile['name'] ?></h4>
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

<?php 
if ($commentNb > 0) {
?>
<div>
	<h4><?= $u_com ?></h4>
</div>

<div class="user-comments">
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
            <div class="other-pages"><a href="index.php?action=showProfile&id=<?= $_GET['id'] ?>&page=<?= $i ?>"> <?= $i ?> </a></div>
            <?php 
            }
        }
        ?>
    </div>
	<?php 
	while ($data = $userComments->fetch())
	{
	?>
	<div class="comment">
		<p><strong>Chapitre <a href="index.php?action=post&amp;id=<?= $data['post_id'] ?>&amp;page=1"><?= $data['post_title'] ?> </a></strong><em>le <?= $data['comment_date_fr'] ?></em></p>
		<?php
		if ($data['blocked'] == 1)
		{
		?>
		<p><em>Ce commentaire a été bloqué par l'auteur. Veuillez respecter son travail ainsi que les commentaires des autres lecteurs.</em></p>
		<?php
		}
		else
		{
		?>
		<p><?= nl2br(htmlspecialchars($data['comment'])) ?></p>
		<?php
		}
		
		if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id'] && $data['blocked'] == 0) {
			?>
			<div class="link-update"><a href="index.php?action=update&amp;id=<?= $data['id'] ?>">&#9997; Modifier &#9997;</a></div>
			<?php
		}
		if (!isset($_SESSION['id']) || $_SESSION['id'] != $_GET['id'] && $data['blocked'] == 0 && $data['reported'] == 0) {
			?>
			<div class="link-report"><a href="index.php?action=reportComment&amp;id=<?= $data['id'] ?>">&#128683; Signaler &#128683;</a></div>
			<?php
		}
		if (!isset($_SESSION['id']) || $_SESSION['id'] != $_GET['id'] && $data['blocked'] == 0 && $data['reported'] == 1) {
			?>
			<div class="link-reported"><p>Ce commentaire a été signalé.</p></div>
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
            <div class="other-pages"><a href="index.php?action=showProfile&id=<?= $_GET['id'] ?>&page=<?= $i ?>"> <?= $i ?> </a></div>
            <?php 
            }
        }
        ?>
    </div>
</div>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>