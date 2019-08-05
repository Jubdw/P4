<?php $title = 'Jean Forteroche, acteur, écrivain, aventurier'; ?>

<?php ob_start(); ?>
<div class="title">
    <h1>Bienvenue sur mon site</h1>    
    <div class="separation">
        <div class="line"></div><p>⭐</p><div class="line"></div>
    </div>
</div>

<div class="home-about">
    <div class="home-about-img">
        <a href="index.php?action=about"><img src="public/images/photos/Jean_Forteroche-small.jpg" alt="Jean Forteroche"></a>
        <h3>Jean Forteroche</h3>
        <p>Acteur, écrivain, aventurier</p>
    </div>
    <div class="home-about-text">
        <p>Après plusieurs années de voyage autour la terre, je reviens à ma première passion : l'écriture. J'ai décidé de vous partager mes expériences vécues lors de mes périgrinations. Je poste régulièrement sur ce blog de nouveaux chapitres de mon roman en cours : Billet simple pour l'Alaska. Revenez toutes les semaines découvrir de nouvelles pages de cette aventure sur les terres gelées d'Alaska, cette région du monde si isolée et sauvage, qui me fascinne tant...</p>
    </div>
</div>
<div class="title">
    <h1><a href="index.php?action=listPosts&amp;page=1">Les derniers épisodes du roman :</a></h1>
</div>

<div class="home-episode">
<?php
while ($data = $posts->fetch())
{
?>
    <div class="h-episode">
        <div class="episode-title">
            <h2><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;page=1"><?= $data['title'] ?></a></h2>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </div><br>

        <p><?= nl2br($data['small_content']) ?> ... <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;page=1">Lire la suite</a></em></p>
    </div><br>
<?php
}
$posts->closeCursor();
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>