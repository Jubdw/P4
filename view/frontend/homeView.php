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
        <p>On vous met une dague sous le cou et on traverse le camp en gueulant "bougez-pas, bougez-pas ou un bute le roi". Un chef de guerre qui commande plus c’est pas bon. Il va déprimer, il va s’mettre à bouffer, il va prendre quarante livres! Ah, ben tourné vers là-bas c'est sûr, moi non plus je vois rien. J’ai envie d’faire des tartes, voilà! Vous n’allez pas m’obliger à m’justifier! Mais oui mon p’tit père il faudra bien vous y coller! À moins que vous préfériez vous taper les tartes! Non mais n’exagérez pas non plus! J’vous demande quand même pas de manger des briques!</p>
    </div>
</div>
<div class="title">
    <h1><a href="index.php?action=listPosts">Les derniers épisodes du roman :</a></h1>
</div>

<div class="home-episode">
<?php
while ($data = $posts->fetch())
{
?>
    <div class="h-episode">
        <div class="episode-title">
            <h2><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h2>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </div><br>

        <p><?= nl2br(htmlspecialchars($data['small_content'])) ?> ... <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></em></p>
    </div><br>
<?php
}
$posts->closeCursor();
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>