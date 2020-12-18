<?php ob_start(); ?>
<?php $title = "ASSCVM - Evenements"; ?>
	<aside id="Paragraphe">
		<h2>La fête de l'ASSCVM</h2>
		<p>Découvrez tous les évenements organisés par l'ASSCVM, pour l'instant du à la crise sanitaire, aucun évenements n'est prévus</p>
	</aside>
	<section id="ListeArticlesColonne">
		<?php while($event = $Events->fetch()){ ?>
			<article class="Event">
				<a href="index.php?action=event&amp;section=event&amp;idEvent=<?php echo $event['Id']; ?>">
					<h3><?php echo $event['Titre']; ?></h3>
					<figure>
						<img class="imgEvent" src="<?php echo $event['CheminImage']; ?>" alt="<?php echo $event['AltImage']; ?>" />
					</figure>
					<?php if($event['DateDebut'] == $event['DateFin']): ?>
						<p>Le <?php echo $event['DateDebut'];?></p> 
					<?php else: ?>
						<p>Du <?php echo $event['DateDebut'];?> au <?php echo $event['DateFin']; ?></p>
					<?php endif; ?>
					<p>De <?php echo date("H:i",strtotime($event['HeureDebut'])); ?> à <?php echo date("H:i",strtotime($event['HeureFin'])); ?></p>
					<p><?php echo $event['Texte']; ?></p>
				</a>
			</article>
		<?php } ?>
	</section>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
