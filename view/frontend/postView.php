<?php $title = "Jean Forteroche - " . htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
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
<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['name'])) 
{
?>
<h2>Commentaires</h2>
<h4>Écrivez un commentaire en tant que : <?= $_SESSION['name'] ?></h4>
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="comment">Commentaire</label><br>
        <textarea id="comment" name="comment" rows="8" cols="40"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php 
}
else
{
?>
<p>Connectez-vous ou inscrivez-vous à l'espace membre pour pouvoir rédiger un commentaire.</p>
<a href="index.php?action=register">Connexion | Inscription</a>
<?php 
}
?>
</div>
<div class="comment-list">
<?php
while ($comment = $comments->fetch())
{
?>
    <div class="comment">
        <p><strong><a href="index.php?action=showProfile&amp;name=<?= $comment['user_name'] ?>"><?php echo $comment['user_name'] ?></a></strong> le <?php echo $comment['comment_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p><br>
        <?php 
        if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
            if ($_SESSION['id'] == $comment['user_id']) 
            {
            ?>
            <div class="link-update"><a href="index.php?action=update&amp;id=<?= $comment['id'] ?>">Modifier</a></div>
            <?php
            }
            else 
            {
            ?>
            <div class="link-report"><a href="#">Signaler</a></div>
            <?php
            }
        }
        ?>
    </div>
<?php
}
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>