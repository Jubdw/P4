<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<h2>Modifier un commentaire</h2>

<?php $onlyComment = $comment->fetch(); ?>

<form action="index.php?action=changeComment&amp;id=<?= $_GET['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= htmlspecialchars($onlyComment['author']); ?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($onlyComment['comment'])); ?></textarea>
        <input type="hidden" name="post_id" value="<?= $onlyComment['post_id']; ?>">
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>