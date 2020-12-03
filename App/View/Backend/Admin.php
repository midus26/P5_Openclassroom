<?php ob_start(); ?>
<?php $title = "Admin"; ?>
	<h2>Administrateur</h2>
	<div id="AdminAjout">
		<form method="post" action="index.php?action=addArticle">
			<button type="submit" class="AdminBtn">Ajouter un article</button>
		</form>
		<form method="post" action="index.php?action=addEvent">
			<button type="submit" class="AdminBtn">Ajouter un evenement</button>
		</form>
		<form method="post" action="index.php?action=addHistoire">
			<button type="submit" class="AdminBtn">Ajouter une page de l'histoire</button>
		</form>
	</div>
		<h3>Liste des articles</h3>
		<table>
			<tr>
				<th>Image</th>
				<th>Titre</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php while($billet = $Billets->fetch()){ ?>
			<tr>
				<?php if (isset($billet['CheminImage'])): ?>
					<td><img src="<?php echo $billet['CheminImage']; ?>" alt="<?php echo $billet['AltImage']; ?>" class="ImgArticle" /></td>
				<?php ;endif; ?>
				<td><a href="index.php?action=article&amp;idArticle=<?php echo $billet['Id'];?>"><p><strong><?php echo $billet['Titre']; ?></strong></p></a></td>
				<td><a href="index.php?action=editArticle&amp;idArticle=<?php echo $billet['Id'] ; ?>"><img src="App/Public/Image/Icone/Edit.png" alt="Modifier" class="IconeEdit" /></td>
				<td><a href="index.php?action=deleteArticle&amp;idArticle=<?php echo $billet['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Supprimer" class="IconeSupp"/></td>
			</tr>
		<?php } ?>
		</table>
		<h3>Liste des Evenements</h3>
		<table>
			<tr>
				<th>Image</th>
				<th>Titre</th>
				<th class="Dopen">Date de Debut</th>
				<th class="Dclose">Date de fin</th>
				<th class="Hopen">Heure d'ouverture</th>
				<th class="Hclose">Heure de fin</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php while($event = $Events->fetch()){ ?>
			<tr>
				<?php if (isset($event['CheminImage'])): ?>
					<td><img class="ImgArticle" src="<?php echo $event['CheminImage']; ?>" alt="<?php echo $event['AltImage']; ?>" /></td>
				<?php endif; ?>
				<td><p><a href="index.php?action=event&amp;idEvent=<?php echo $event['Id'];?>"><strong><?php echo $event['Titre']; ?></strong></a></p></td>
				<td class="Dopen"><?php echo $event['DateDebut']; ?></td>
				<td class="Dclose"><?php echo $event['DateFin']; ?></td>
				<td class="Hopen"><?php echo date("H:i",strtotime($event['HeureDebut'])); ?></td>
				<td class="Hclose"><?php echo date("H:i",strtotime($event['HeureFin'])); ?></td>
				<td><a href="index.php?action=editEvent&amp;idEvent=<?php echo $event['Id'] ; ?>"><img src="App/Public/Image/Icone/Edit.png" alt="Modifier" class="IconeEdit" /></td>
				<td class="confirmDelete"><a href="index.php?action=deleteEvent&amp;idEvent=<?php echo $event['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Supprimer" class="IconeSupp"/></td>
			<?php } ?>
			</tr>
		</table>
		<h3>Liste des articles d'histoire</h3>
		<table>
			<tr>
				<th>Image</th>
				<th>Année</th>
				<th>Titre</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php while($histoire = $Histoires->fetch()){ ?>
			<tr>
				<?php if (isset($histoire['CheminImage'])){ ?>
					<td><img src="<?php echo $histoire['CheminImage'] ?>" alt="<?php echo $histoire['AltImage'] ?>" class="ImgArticle" /></td>
				<?php } ?>
				<td><p><?php echo $histoire['Annee']; ?></p></td>
				<td><p><strong><?php echo $histoire['Titre']; ?></strong></p></td>
				<td><a href="index.php?action=editHistoire&amp;idHistoire=<?php echo $histoire['Id'] ; ?>"><img src="App/Public/Image/Icone/Edit.png" alt="Modifier" class="IconeEdit" /></td>
				<td><a class="confirmDelete" href="index.php?action=deleteHistoire&amp;idHistoire=<?php echo $histoire['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Supprimer" class="IconeSupp"/></td>
			<?php } ?>
			</tr>
		</table>
		<h3>Commentaires signalées</h3>
		<table>
			<tr>
				<th>Pseudo</th>
				<th>Message</th>
				<th>Contenu correct</th>
				<th>Supprimer</th>
			</tr>
		<?php while($comment = $Comments->fetch()){ ?>
			<tr>
				<td><p><?php echo htmlspecialchars($comment['Pseudo']); ?></p></td>
				<td><p><?php echo htmlspecialchars($comment['Message']); ?></p></td>
				<td><a href="index.php?action=restoreComment&amp;idComment=<?php echo $comment['Id'] ; ?>"><img src="App/Public/Image/Icone/Ok.png" alt="Validé" class="IconeOk"/></td>
				<td><a class="confirmDelete" href="index.php?action=deleteComment&amp;Section=Admin&amp;idComment=<?php echo $comment['Id'] ; ?>"><img src="App/Public/Image/Icone/Supp.png" alt="Supprimer" class="IconeSupp"/></td>
			</tr>
		<?php } ?>
		</table>
		<script src="App/Public/Js/CtrlAdmin.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
