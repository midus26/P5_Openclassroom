<?php ob_start(); ?>
<?php $title = "ASSCVM - Evenement"; ?>
	<section>
		<h2>Evenements</h2>
		<div id="ListeArticles">
			<?php while($event = $Events->fetch()){ ?>
				<article class="Event">
					<h3><?php echo $event['Titre']; ?></h3>
						<figure>
							<img class="imgEvent" src="<?php echo $event['CheminImage']; ?>" alt="<?php echo $event['AltImage']; ?>" />
						</figure>
						<?php if(date("d m Y",strtotime($event['DateDebut'])) == date("d m Y",strtotime($event['DateFin']))): ?>
							<p>Le <?php echo date("d m Y",strtotime($event['DateDebut']));?></p> 
						<?php else: ?>
							<p>Du <?php echo date("d m Y",strtotime($event['DateDebut']));?> au <?php echo date("d m Y",strtotime($event['DateFin'])); ?></p>
						<?php endif; ?>
						<p>De <?php echo date("H:i",strtotime($event['HeureDebut'])); ?> à <?php echo date("H:i",strtotime($event['HeureFin'])); ?></p>
						<p><?php echo $event['Texte']; ?></p>
				</article>
			<?php } ?>
		</div>
	</section>
	<aside>
	<h3>Commentaire</h3>
		<?php if(isset($_SESSION['Id'])): ?>
			<form method="post" action="index.php?action=addcommentaireEvent&amp;idEvent=<?php echo $_GET['idEvent']; ?>">
				<label for="Message"></label>
				<input type="text" name="Message" id="Message" required/>
				<button id="AdminBtn" type="submit">Envoyer</button>
			</form>
		<?php endif; ?>
	<h4>Liste des commentaires</h4>
		<?php while($commentaire = $Commentaires->fetch()) { ?>
			<aside class="Commentaire">
				<div class="ContenuComment">
					<p><?php echo htmlspecialchars($commentaire['Pseudo']); ?></p>
					<p><?php  echo htmlspecialchars($commentaire['Message']); ?></p>
				</div>
				<div class="IconeComments">
					<?php if(isset($_SESSION['Pseudo']) && $_SESSION['Pseudo'] == $commentaire['Pseudo']): ?>
					<a href="index.php?action=editComment&amp;Section=event&amp;idEvent=<?php echo $_GET['idEvent'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Edit.png" alt="Crayon" class="IconeComment" title="Modifier le commentaire"/></a>
					<a href="index.php?action=deleteComment&amp;Section=event&amp;idEvent=<?php echo $_GET['idEvent'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Corbeille" class="IconeComment" title="Supprimer le commentaire"/></a>
					<?php endif; ?>
					<a href="index.php?action=signalComment&amp;Section=event&amp;idEvent=<?php echo $_GET['idEvent'] ?>&amp;idComment=<?php echo $commentaire['Id'] ; ?>"><img src="App/Public/Image/Icone/Alert.png" alt="Attention" class="IconeComment" title="Signaler le commentaire"/></a>
				</div>
			</aside>
		<?php } ?>
	</aside>
	<script src="App/Public/Js/CtrlComment.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
