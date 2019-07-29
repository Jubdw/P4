<?php $title = "Billet simple pour l'alaska"; ?>

<?php ob_start(); ?>
<div class="title">
    <h1>Billet simple pour l'alaska</h1>
    <h3>Derniers épisodes du roman :</h3>
    <a href="index.php">Retour à l'acceuil</a>
</div>

<div class="list-posts">
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
	        <div class="other-pages"><a href="index.php?action=listPosts&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
	        <?php 
	        }
	    }
	    ?>
	</div>
	<?php
	while ($data = $posts->fetch())
	{
	?>
	    <div class="episode">
	        <div class="episode-title">
	            <h2><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&page=1"><?= $data['title'] ?></a></h2>
	            <em>le <?= $data['creation_date_fr'] ?></em>
	        </div><br>

	        <p><?= nl2br($data['small_content']) ?> ... <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&page=1">Lire la suite</a></em></p>
	    </div><br>
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
	        <div class="other-pages"><a href="index.php?action=listPosts&amp;page=<?= $i ?>"> <?= $i ?> </a></div>
	        <?php 
	        }
	    }
	    ?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>