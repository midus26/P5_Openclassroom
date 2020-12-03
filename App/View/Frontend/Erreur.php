<?php ob_start(); ?>
<?php $title = "Erreur"; ?>
	<p><?php echo $TexteErreur ?></p>
	<button><a href="index.php">Retour à la page d'acceuil</a></button>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
