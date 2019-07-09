<?php $title = "Jean Forteroche - " . htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<?php 
if (isset($_SESSION['success'])) : ?>
    <h3>Le commentaire à bien été modifié</h3>
<?php endif; ?>
<div class="title">
    <h1>Billet simple pour l'Alaska</h1>
    <p><a href="index.php?action=listPosts">Retour à la liste des derniers épisodes</a></p>
    <p><a href="index.php">Retour à l'acceuil</a></p>
</div>

<div class="episode">
    <div class="episode-title">
        <h2><?= htmlspecialchars($post['title']) ?></h2>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </div><br>

    <p><?= nl2br(htmlspecialchars($post['content'])) ?><br></p>
</div><br>

<div id="comment-section">
<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br>
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <div class="comment"><p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> <a href="index.php?action=update&amp;id=<?= $comment['id'] ?>">Modifier</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p></div>
<?php
}
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
<?php unset($_SESSION['success']); ?>