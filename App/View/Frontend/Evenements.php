<?php ob_start(); ?>
<?php $title = "ASSCVM - Evenement"; ?>
	<h2>La fête de l'ASSCVM</h2>
	<div id="Paragraphe">
		<p>Découvrez tous les évenements organisés par l'ASSCVM, pour l'instant du à la crise sanitaire, aucun évenements n'est prévus</p>
	</div>
	<?php while($event = $Events->fetch()){ ?>
		<div class="Event">
			<a href="index.php?action=event&amp;section=event&amp;idEvent=<?php echo $event['Id']; ?>">
				<h3><?php echo $event['Titre']; ?></h3>
				<img class="imgEvent" src="<?php echo $event['CheminImage']; ?>" alt="<?php echo $event['AltImage']; ?>" />
				<?php if($event['DateDebut'] == $event['DateFin']){ ?>
						<p>Le <?php echo $event['DateDebut'];?></p> 
					<?php } else{ ?>
					<p>Du <?php echo $event['DateDebut'];?> au <?php echo $event['DateFin']; ?></p>
					<?php } ?>
				<p>De <?php echo date("H:i",strtotime($event['HeureDebut'])); ?> à <?php echo date("H:i",strtotime($event['HeureFin'])); ?></p>
				<p><?php echo $event['Texte']; ?></p>
			</a>
		</div>
	<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
