<?php ob_start(); ?>
<?php $title = "ASSCVM - Commentaire"; ?>
	<section>
		<?php while($reference = $References->fetch()) { ?>
			<article class="Article">
				<h3><?php echo $reference['Titre'] ; ?></h3>
				<figure>
					<img class="imgComment" src="<?php echo $reference['CheminImage'] ; ?>" alt="<?php echo $reference['AltImage'] ; ?>" />
				</figure>
				<?php if(isset($_GET['Section']) && $_GET['Section'] == "event"): ?>
					<p>Du <?php echo $reference['DateDebut'] . ' au ' . $reference['DateFin'] ; ?></p>
					<p>De <?php echo $reference['HeureDebut'] . " jusqu'a " . $reference['HeureFin'] ; ?></p>
				<?php endif; ?>
				<p><?php echo $reference['Texte'] ; ?></p>
			</article>
		<?php } ?>
	</section>
	<aside>
		<h3>Commentaire</h3>
		<?php if(!isset($_SESSION['Pseudo'])): ?>
			<p>Vous devez être connecter pour poster un commentaire</p>
		<?php else: ?>
			<?php while($commentaire = $Commentaires->fetch()){ ?>
				<form method="post" action="index.php?action=editcommentairePost&amp;Section=<?php echo $commentaire['Section'];?>&amp;
				<?php switch($commentaire['Section']){
					case "article":
						echo 'idArticle=' . $_GET['idArticle'];
					break;
					case "event" :
						echo 'idEvent='.$_GET['idEvent'];
					break;
					default:
						throw new \Exception("Erreur de l'identifiant du post");
					break;
				}?>
				&amp;idComment=<?php echo $commentaire['Id']; ?>">
					<label for="Message">Commentaire</label>
					<input type="text" name="Message" id="Message" value="<?php echo $commentaire['Message']; ?>" required/>
					<button id="AdminBtn" type="submit">Modifier</button>
				</form>
			<?php } ?>
		<?php endif; ?>
	</aside>
	<script src="App/Public/Js/CtrlComment.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
