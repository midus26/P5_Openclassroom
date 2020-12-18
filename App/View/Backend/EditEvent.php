<?php ob_start(); ?>
<?php $title = "ASSCVM - Modifier evenement"; ?>
	<section>
		<h2>Modifier un evenement</h2>
		<?php while($event = $Events->fetch()) { ?>
		<article class="Event">
			<form method="post" enctype="multipart/form-data" action="index.php?action=editeventPost&amp;idEvent=<?php echo $event['Id'] ?>">
				<img class="imgEvent" src="<?php echo $event['CheminImage'] ?>" alt="<?php echo $event['AltImage'] ?>" />
				<p>Voulez vous conserver l'image ci-dessus ?</p>
					<input type="radio" name="sameImage" id="sameImage" value="Oui" checked />
					<label for="sameImage">Oui</label>
					<input type="radio" name="sameImage" id="notsameImage" value="Non" />
					<label for="notsameImage">Non</label>
				<sup>Maximum 8Mo</sup>
				<input type="file" name="Image" id="Image"/>
				<label for="altImage">Texte alternatif</label>
				<input type="text" name="altImage" id="altImage" value="<?php echo $event['AltImage'] ?>" required/>
				<label for="DateDebut">Date du début de l'evenement</label>
				<input type="date" name="DateDebut" id="DateDebut" value="<?php echo $event['DateDebut'] ?>" required/>
				<label for="DateFin">Date de fin de l'evenement</label>
				<input type="date" name="DateFin" id="DateFin" value="<?php echo $event['DateFin'] ?>" required/>
				<label for="TimeStart">Heure de début de l'evenement</label>
				<input type="time" name="TimeStart" id="TimeStart" value="<?php echo $event['HeureDebut'] ?>" required/>
				<label for="TimeEnd">Heure de fin de l'evenement</label>
				<input type="time" name="TimeEnd" id="TimeEnd" value="<?php echo $event['HeureFin'] ?>" required/>
				<label for="Lieu">Lieu de l'evenement</label>
					<select name="Lieu" id="Lieu">
						<option value="Salle des fetes">Salle des fêtes</option>
						<option value="Mairie">Mairie</option>
						<option value="ChapelleStFélix">Chapelle Saint Félix</option>
						<option value="Chapelle des barquets">Chapelle des barquets</option>
						<option value="ChapelleStClaude">Chapelle Saint Claude</option>
						<option value="ChapelleStJean">Chapelle Saint Jean</option>
					</select>
				<label for="Titre">Titre</label>
				<input type="text" name="Titre" id="Titre" value="<?php echo $event['Titre'] ?>" required/>
				<label for="Texte">Texte</label>
				<textarea type="text" name="Texte" id="Texte" required><?php echo $event['Texte']?></textarea>
				<button id="AdminBtn" type="submit">Modifier</button>
			</form>
		</article>
		<?php } ?>
	</section>
	<script src="App/Public/Js/CtrlEvent.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");