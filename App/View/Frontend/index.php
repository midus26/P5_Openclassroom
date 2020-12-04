<?php ob_start(); ?>
<?php $title = "Mon Blog"; ?>
	<div id="Paragraphe">
		<h2>Bienvenue sur le site de l'ASSCVM</h2>
		<p>L'ASSCVM est fière de vous présenter, son nouveau site internet.<br/>Vous pouvez à présent participer au site, en vous inscrivant et ainsi pouvoir commenter les posts de chacun des articles qui vous interresse.</p>
	</div>
	<h3>Dernier articles</h3>
	<?php if($NbrpaginationArticle > 1){ ?>
	<div id="Pagination">
		<?php echo "<ul>"; ?>
			<?php for($i=1;$i<=$NbrpaginationArticle;$i++){
				if (!isset($_GET['pageArticle'])){
					if($i == 1){
						echo '<a class="PaginationlienActuel" href="index.php?pageArticle=' . $i . '"><li>' . $i . '</li></a>';
					}
					else{
						echo '<a class="PaginationLien" href="index.php?pageArticle=' . $i . '"><li>' . $i . '</li></a>';
					}
				}
				elseif(isset($_GET['pageArticle']) && $_GET['pageArticle'] == $i){
					echo '<a class="PaginationlienActuel" href="index.php?pageArticle=' . $i . '"><li>' . $i . '</li></a>';
				}
				else{
					echo '<a class="PaginationLien" href="index.php?pageArticle=' . $i . '"><li>' . $i . '</li></a>';
				}
			} ?>
		<?php echo "</ul>"?>
		</div>
	<?php } ?>
	<div id="ListeArticles">
		<?php while($billet = $Billets->fetch()){ ?>
		<div class="resumeArticle">
			<a href="index.php?action=article&amp;idArticle=<?php echo $billet['Id']; ?>">
				<img class="resumearticleImg" src="<?php echo $billet['CheminImage'] ?>" alt="<?php echo $billet['AltImage'] ?>"/>
				<h4 class="resumearticleTitre"><?php echo $billet['Titre'] ?></h4>
			</a>
		</div>
		<?php } ?>
	</div>
	<h3>Evenement à venir</h3>
	<?php if($NbrpaginationArticle > 1){ ?>
		<div id="Pagination">
		<?php echo "<ul>"; ?>
			<?php for($i=1;$i<=$NbrpaginationEvent;$i++){
				if (!isset($_GET['pageEvent'])){
					if($i == 1){
						echo '<a class="PaginationlienActuel" href="index.php?pageEvent=' . $i . '"><li>' . $i . '</li></a>';
					}
					else{
						echo '<a class="PaginationLien" href="index.php?pageEvent=' . $i . '"><li>' . $i . '</li></a>';
					}
				}
				elseif(isset($_GET['pageEvent']) && $_GET['pageEvent'] == $i){
					echo '<a class="PaginationlienActuel" href="index.php?pageEvent=' . $i . '"><li>' . $i . '</li></a>';
				}
				else{
					echo '<a class="PaginationLien" href="index.php?pageEvent=' . $i . '"><li>' . $i . '</li></a>';
				}
			} ?>
		<?php echo "</ul>"?>
		</div>
	<?php } ?>
	<div id="ListeEvents">
		<?php while($event = $Events->fetch()){ ?>
			<div class="resumeEvent">
				<a href="index.php?action=event&amp;idEvent=<?php echo $event['Id'] ?>">
					<h4><?php echo $event['Titre'] ?></h4>
					<?php if(date("d m Y",strtotime($event['DateDebut'])) == date("d m Y",strtotime($event['DateFin']))){ ?>
						<p>Le <em><?php echo date("d m Y",strtotime($event['DateDebut']));?></em></p> 
					<?php } else{ ?>
					<p>Du <em><?php echo date("d m Y",strtotime($event['DateDebut']));?></em> au <em><?php echo date("d m Y",strtotime($event['DateFin'])); ?></em></p>
					<?php } ?>
					<p>De <em><?php echo date("H:i",strtotime($event['HeureDebut'])); ?></em> à <em><?php echo date("H:i",strtotime($event['HeureFin'])); ?></em></p>
					<img class="imgEvent" src="<?php echo $event['CheminImage']; ?>" alt="<?php echo $event['AltImage'] ?>"/>
					<p class="TxtEvent"><?php echo $event['Texte'] ?></p>
				</a>
			</div>
		<?php } ?>
	</div>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
