<?php ob_start(); ?>
<?php $title = "Mon Blog"; ?>
	<h2>Les articles</h2>
	<div id="ListeArticlesColonne">
		<?php while($billet = $Billets->fetch()){ ?>
			<div class="Article">
				<a href='index.php?action=article&amp;Section=article&amp;idArticle=<?php echo $billet['Id']; ?>'>
				<img class="imgArticle" src="<?php echo $billet['CheminImage'] ?>" alt="<?php echo $billet['AltImage'] ?>"/>
				<h4><?php echo $billet['Titre'] ?></h4>
				<p><?php echo $billet['Texte'] ?></p>
				</a>
			</div>
		<?php } ?>
	</div>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
