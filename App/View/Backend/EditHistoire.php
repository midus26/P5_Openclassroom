<?php ob_start(); ?>
<?php $title = "ASSCVM - Modifier article d'histoire"; ?>
	<section>
		<h2>Modifier un article de l'histoire</h2>
		<article class="Article">
			<?php while($histoire = $Histoires->fetch()) { ?>
			<form method="post" enctype="multipart/form-data" action="index.php?action=edithistoirePost&amp;idHistoire=<?php echo $histoire['Id']; ?>">
				<img src="<?php echo $histoire['CheminImage']; ?>" alt="<?php echo $histoire['AltImage']; ?>" class="histoieImg" />
				<p>Voulez vous conserver l'image ci-dessus ?</p>
				<input type="radio" name="sameImage" id="sameImage" value="Oui" checked />
				<label for="sameImage">Oui</label>
				<input type="radio" name="sameImage" id="notsameImage" value="Non" />
				<label for="notsameImage">Non</label>
				<sup>Maximum 8Mo</sup>
				<input type="file" name="Image" id="Image"/>
				<label for="altImage">Texte alternatif</label>
				<input type="text" name="altImage" id="altImage" value="<?php echo $histoire['AltImage']; ?>" required/>
				<label for="Annee">Année</label>
				<input type="text" name="Annee" id="Annee" value="<?php echo $histoire['Annee']; ?>" required/>
				<label for="Titre">Titre</label>
				<input type="text" name="Titre" id="Titre" value="<?php echo $histoire['Titre']; ?>" required/>
				<label for="Texte">Texte</label>
				<textarea type="text" name="Texte" id="Texte" required><?php echo $histoire['Texte']; ?></textarea>
				<button id="AdminBtn" type="submit">Modifier</button>
			</form>
			<?php } ?>
		</article>
	</section>
	<script src="App/Public/Js/CtrlHistoire.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");