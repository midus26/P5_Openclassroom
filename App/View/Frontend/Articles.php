<?php ob_start(); ?>
<?php $title = "ASSCVM - Articles"; ?>
	<section>
		<h2>Les articles</h2>
		<div id="ListeArticlesColonne">
			<?php while($billet = $Billets->fetch()){ ?>
				<article class="Article">
					<a href='index.php?action=article&amp;Section=article&amp;idArticle=<?php echo $billet['Id']; ?>'>
						<h4><?php echo $billet['Titre'] ?></h4>
						<figure>
							<img class="imgArticle" src="<?php echo $billet['CheminImage'] ?>" alt="<?php echo $billet['AltImage'] ?>"/>
						</figure>
						<p><?php echo $billet['Texte'] ?></p>
					</a>
				</article>
			<?php } ?>
		</div>
	</section>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
