<?php $title = 'À propos de Jean Forteroche'; ?>

<?php ob_start(); ?>
<div class="title">
<h1>Qui suis-je ?</h1>
</div>
<div class="about">
	<img src="public/images/photos/Jean_Forteroche.jpg" alt="Jean Forteroche, acteur, écrivain, aventurier">
    <div class="about-text">
    	<p>On pourrait foutre le feu à la forêt pour les obliger à sortir. La ferme! On vous met une dague sous le cou et on traverse le camp en gueulant "bougez-pas, bougez-pas ou un bute le roi".</p>
	    <p>C’est quand même magnifique une armée bien coordonnée, hein! Ben attendez, je vais vous rendre la vôtre. On vous met une dague sous le cou et on traverse le camp en gueulant "bougez-pas, bougez-pas ou un bute le roi". Un chef de guerre qui commande plus c’est pas bon.</p>
	    <p>Il va déprimer, il va s’mettre à bouffer, il va prendre quarante livres! Ah, ben tourné vers là-bas c'est sûr, moi non plus je vois rien. J’ai envie d’faire des tartes, voilà! Vous n’allez pas m’obliger à m’justifier! Mais oui mon p’tit père il faudra bien vous y coller! À moins que vous préfériez vous taper les tartes! Non mais n’exagérez pas non plus! J’vous demande quand même pas de manger des briques!</p>
	    <p>Alors là, personne sait qui est tombé et tout le monde s’en fout! Si ça se trouve? Alors pour nous sortir de là va falloir un plus solide que du si ça se trouve! A genoux, pas à genoux c’est une chose... Enfin en attendant je vous donne pas tout notre or.</p>
	    <p>Il s’est fait chier dessus par un bouc! Putain en plein dans sa mouille! Ah non, non! Y a pas de pécor pour la quête du Graal! Enfin… À moins ça ait changé? Allez-y mollo avec la joie! Mais vous êtes complètement con? Qu’est ce que vous nous chantez? Vous êtes pas gaulois que je sache!</p>
	    <p>C’est une tarte aux myrtilles. Pourquoi elle vous revient pas? Non Provençal c’est mon nom. Si ça se trouve? Alors pour nous sortir de là va falloir un plus solide que du si ça se trouve! Léodagan et moi on fait semblant de vous prendre en otage. Alors par contre, si vous sentez qu’il s’énerve un peu, hein, vous lui sortez un morceau de viande. Sans vouloir abuser. Il me semble pas que vous soyez provençal non plus… A genoux, pas à genoux c’est une chose... Enfin en attendant je vous donne pas tout notre or. Vous allez me faire le plaisir devous remuez un peu les miches, Sire, j’ai l’impression de me battre contre une vieille!</p>
	</div>
</div>

<div class="books"></div>

<div class="movies"></div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>