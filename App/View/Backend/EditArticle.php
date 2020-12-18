<?php ob_start(); ?>
<?php $title = "ASSCVM - Modifier article"; ?>
	<section>
		<h2>Modifier un article</h2>
		<?php while($billet = $Billets->fetch()) { ?>
			<article class="Article">
				<form method="post" enctype="multipart/form-data" action="index.php?action=editarticlePost&amp;idArticle=<?php echo $billet['Id'] ?>">
					<img class="imgArticle" src="<?php echo $billet['CheminImage'] ?>" alt="<?php echo $billet['AltImage'] ?>" />
					<p>Voulez vous conserver l'image ci-dessus ?</p>
						<input type="radio" name="sameImage" id="sameImage" value="Oui" checked />
						<label for="sameImage">Oui</label>
						<input type="radio" name="sameImage" id="notsameImage" value="Non" />
						<label for="notsameImage">Non</label>
					<sup>Maximum 8Mo</sup>
					<input type="file" name="Image" id="Image"/>
					<label for="altImage">Texte alternatif</label>
					<input type="text" name="altImage" id="altImage" value="<?php echo $billet['AltImage'] ?>" required/>
					<label for="Titre">Titre</label>
					<input type="text" name="Titre" id="Titre" value="<?php echo $billet['Titre'] ?>" required/>
					<label for="Texte">Texte</label>
					<textarea type="text" name="Texte" id="Texte" required/><?php echo $billet['Texte'] ?></textarea>
					<button id="AdminBtn" type="submit">Modifier</button>
				</form>
			</article>
		<?php } ?>
	</section>
		<script src="App/Public/Js/CtrlArticle.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");