<?php ob_start(); ?>
<?php $title = "ASSCVM - Ajout d'article"; ?>
	<h2>Ajout d'un article</h2>
	<form method="post" enctype="multipart/form-data" action="index.php?action=addarticlePost">
	<sup>Maximum 8Mo</sup>
		<input type="file" name="Image" />
		<label for="altImage">Texte alternatif</label>
		<input type="text" name="altImage" id="altImage" required/>
		<label for="Titre">Titre</label>
		<input type="text" name="Titre" id="Titre" required/>
		<label for="Texte">Texte</label>
		<textarea type="text" name="Texte" id="Texte" required/></textarea>
		<button id="AdminBtn" type="submit">Ajouter un article</button>
	</form>
	<script src="App/Public/Js/CtrlArticle.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
