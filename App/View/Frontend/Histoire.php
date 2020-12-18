<?php ob_start(); ?>
<?php $title = "ASSCVM - Histoire"; ?>
	<aside id="Paragraphe">
		<h2>Histoire de l'association</h2>
		<p>Chaque monument de Montségur sur lauzon dispose d'une longue histoire, l'association aussi.</p>
	</aside>
	<section id="ListeArticles">
		<?php while($histoire = $Histoires->fetch()){ ?>
			<article class="Histoire">
				<h3><?php echo $histoire['Titre']; ?></h3>
				<figure>
					<img src="<?php echo $histoire['CheminImage']; ?>" alt="<?php echo $histoire['AltImage']; ?>" />
				</figure>
				<p><?php echo $histoire['Annee']; ?></p>
				<p><?php echo $histoire['Texte']; ?></p>
			</article>
		<?php } ?>
	</section>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
