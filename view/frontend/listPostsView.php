<?php $title = "Billet simple pour l'alaska"; ?>

<?php ob_start(); ?>
<div class="title">
    <h1>Billet simple pour l'alaska</h1>
    <h3>Derniers épisodes du roman :</h3>
</div>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="episode">
        <div class="episode-title">
            <h2><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&page=1"><?= htmlspecialchars($data['title']) ?></a></h2>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </div><br>

        <p><?= nl2br(htmlspecialchars($data['small_content'])) ?> ... <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&page=1">Lire la suite</a></em></p>
    </div><br>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>