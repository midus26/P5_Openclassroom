<?php ob_start(); ?>
<?php $title = "ASSCVM - Histoire"; ?>
	<h2>Histoire de l'association</h2>
	<div id="Paragraphe">
		<p>Chaque monument de Montségur sur lauzon dispose d'une longue histoire, l'association aussi.</p>
	</div>
	<?php while($histoire = $Histoires->fetch()){ ?>
		<div class="Histoire">
			<img src="<?php echo $histoire['CheminImage']; ?>" alt="<?php echo $histoire['AltImage']; ?>" />
			<p><?php echo $histoire['Annee']; ?></p>
			<h3><?php echo $histoire['Titre']; ?></h3>
			<p><?php echo $histoire['Texte']; ?></p>
		</div>
	<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
