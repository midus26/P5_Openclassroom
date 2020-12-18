<?php ob_start(); ?>
<?php $title = "ASSCVM - Article"; ?>
	<section>
		<h2>Article</h2>
		<div id="ListeArticles">
			<?php while($billet = $Billets->fetch()){ ?>
				<article class="Article">
					<h4><?php echo $billet['Titre'] ?></h4>
					<figure>
						<img class="imgArticle" src="<?php echo $billet['CheminImage'] ?>" alt="<?php echo $billet['AltImage'] ?>"/>
					</figure>
					<p class="articleTexte"><?php echo $billet['Texte'] ?></p>
				</article>
			<?php } ?>
		</div>
	</section>
	<aside>
		<h3>Commentaire</h3>
			<?php if(isset($_SESSION['Id'])): ?>
				<form method="post" action="index.php?action=addcommentaireArticle&amp;idArticle=<?php echo $_GET['idArticle']; ?>">
					<label for="Message">Commentaire</label>
					<input type="text" name="Message" id="Message" required/>
					<button id="AdminBtn" type="submit">Envoyer</button>
				</form>
			<?php else: ?>
				<p>Vous devez être connecter pour poster un commentaire</p>
			<?php endif; ?>
		<h4>Liste des commentaires</h4>
		<?php while($commentaire = $Commentaires->fetch()){ ?>
			<aside class="Commentaire">
				<div class="ContenuComment">
					<p><?php echo htmlspecialchars($commentaire['Pseudo']); ?></p>
					<p><?php  echo htmlspecialchars($commentaire['Message']); ?></p>
				</div>
				<div class="IconeComments">
					<?php if(isset($_SESSION['Pseudo']) && $_SESSION['Pseudo'] == $commentaire['Pseudo']): ?>
					<a href="index.php?action=editComment&amp;Section=article&amp;idArticle=<?php echo $_GET['idArticle'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Edit.png" alt="Crayon" class="IconeComment" title="Modifier le commentaire"/></a>
					<a href="index.php?action=deleteComment&amp;Section=article&amp;idArticle=<?php echo $_GET['idArticle'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Corbeille" class="IconeComment" title="Supprimer le commentaire"/></a>
					<?php endif; ?>
					<a href="index.php?action=signalComment&amp;Section=article&amp;idArticle=<?php echo $_GET['idArticle'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Alert.png" alt="Attention" class="IconeComment" title="Signaler le commentaire"/></a>
				</div>
			</aside>
		<?php } ?>
	</aside>
	<script src="App/Public/Js/CtrlComment.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
