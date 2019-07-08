<?php $title = 'Erreur'; ?>

<?php ob_start(); ?>
<h1>Une erreur a eu lieu</h1>
<p><?php echo 'Erreur : ' . $e->getMessage(); ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>