<?php $title = "Jean Forteroche - " . $post['title']; ?>

<?php ob_start(); ?>
<div class="title">
    <h1>Billet simple pour l'Alaska</h1>
    <p><a href="index.php?action=listPosts&amp;page=1">Retour à la liste des derniers épisodes</a></p>
    <p><a href="index.php">Retour à l'acceuil</a></p>
</div>

<div class="episode episode-post">
    <div class="episode-title">
        <h2><?= $post['title'] ?></h2>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </div><br>

    <p><?= $post['content'] ?><br></p>
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
<?php 
if ($commentNb > 0) {
?>
<div class="comment-list">
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
            <div class="other-pages"><a href="index.php?action=post&id=<?= $_GET['id'] ?>&page=<?= $i ?>#comment-section"> <?= $i ?> </a></div>
            <?php 
            }
        }
    ?>
    </div>
<?php
while ($comment = $comments->fetch())
{
?>
    <div class="comment">
        <p><strong><a href="index.php?action=showProfile&amp;id=<?= $comment['user_id'] ?>&amp;page=1"><?= $comment['user_name'] ?></a></strong> le <?= $comment['comment_date_fr'] ?></p>
        <?php 
        if ($comment['blocked'] === '0') 
        {
        ?>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <?php 
        }
        else
        {
        ?>
        <p><em>Ce commentaire a été bloqué par l'auteur. Veuillez respecter son travail ainsi que les commentaires des autres lecteurs.</em></p>
        <?php
        }
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $comment['user_id'] && $comment['blocked'] === '0') 
            {
            ?>
            <div class="link-update"><a href="index.php?action=update&amp;id=<?= $comment['id'] ?>">&#9997; Modifier &#9997;</a></div>
            <?php
            }
            elseif ($comment['reported'] === '0' && $comment['blocked'] === '0')
            {
            ?>
            <div class="link-report"><a href="index.php?action=reportComment&amp;id=<?= $comment['id'] ?>">&#128683; Signaler &#128683;</a></div>
            <?php
            }
            elseif ($comment['reported'] === '1')
            {
            ?>
            <div class="link-reported"><p>Ce commentaire a été signalé.</p></div>
            <?php
            }
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
            <div class="other-pages"><a href="index.php?action=post&id=<?= $_GET['id'] ?>&page=<?= $i ?>#comment-section"> <?= $i ?> </a></div>
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