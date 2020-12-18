<?php ob_start(); ?>
<?php $title = "ASSCVM - Ajout d'evenement"; ?>
	<section>
		<h2>Ajout un evenement</h2>
		<form method="post" enctype="multipart/form-data" action="index.php?action=addeventPost">
		<sup>Maximum 8Mo</sup>
			<input type="file" name="Image" />
			<label for="altImage">Texte alternatif</label>
			<input type="text" name="altImage" id="altImage" required/>
			<label for="DateDebut">Date du début de l'evenement</label>
			<input type="date" name="DateDebut" id="DateDebut" required/>
			<label for="DateFin">Date de fin de l'evenement</label>
			<input type="date" name="DateFin" id="DateFin" required/>
			<label for="TimeStart">Heure de début de l'evenement</label>
			<input type="time" name="TimeStart" id="TimeStart" required/>
			<label for="TimeEnd">Heure de fin de l'evenement</label>
			<input type="time" name="TimeEnd" id="TimeEnd" required/>
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
			<input type="text" name="Titre" id="Titre" required/>
			<label for="Texte">Texte</label>
			<textarea type="text" name="Texte" id="Texte" required/></textarea>
			<button name="Btn" id="AdminBtn" class="AdminBtn" type="submit">Ajouter un évenement</button>
		</form>
	</section>
	<script src="App/Public/Js/CtrlEvent.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
