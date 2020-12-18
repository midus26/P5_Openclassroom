<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>ASSCVM</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width"/>
		<meta name="description" content="Bienvenue sur le site de l'ASSCVM, Vous trouverez sur le site toutes les informations concernant l'association et les monuments de Montségur sur lauzon" />
		<link rel="icon" href="App/Public/Image/Icone/icone.jpg" />
		<link rel="apple-touch-icon" sizes="120x120" href="App/Public/Image/Icone/icone.jpg" />
		<link rel="apple-touch-icon" sizes="152x152" href="App/Public/Image/Icone/icone.jpg" />
		<link rel="stylesheet" href="App/Public/Css/style.css" />
	</head>
	
	<body>
		<header>
			<div id="En-tete">
				<div id="En-tete_Left">
					<a href="index.php" id ="LogoAccueil">
						<img src="App/Public/Image/360/360_Long(1).jpg" alt="Vue Chapelle st félix" id="Banderol"/>
						<h1 id="ASSCVM">ASSCVM</h1>
					</a>
				</div>
				<nav>
					<ul id="Raccourci">
						<li class="NavPrincipal"><a href="index.php">Accueil</a></li>
						<li class="NavPrincipal"><a href="index.php?action=Articles">Articles</a></li>
						<li class="NavPrincipal"><a href="index.php?action=Evenement">Evenements</a></li>
						<li class="NavPrincipal"><a href="index.php?action=Histoire">Histoires</a></li>
						<li class="NavPrincipal"><a href="index.php?action=Sites">Sites</a></li>
						<li class="NavPrincipal"><a href="index.php?action=Connexion">
							<?php if(empty($_SESSION['Pseudo'])):
								echo 'Connexion';
								else:
								echo htmlspecialchars($_SESSION['Pseudo']);
								endif;
							?></a></li>
						<?php if(isset($_SESSION['Droit']) && $_SESSION['Droit']){
							echo '<li class="NavPrincipal"><a href="index.php?action=Admin">Admin</li></a>';
						} ?>
					</ul>
				</nav>
			</div>
		</header>
		<main id="Container">
			<?= $content ?>
		</main>
		<footer>
			<ul id="ListeFooter">
						<li class="NavFooter"><a href="index.php">Accueil</a></li>
						<li class="NavFooter"><a href="index.php?action=Articles">Articles</a></li>
						<li class="NavFooter"><a href="index.php?action=Evenement">Evenements</a></li>
						<li class="NavFooter"><a href="index.php?action=Histoire">Histoires</a></li>
						<li class="NavFooter"><a href="index.php?action=Sites">Sites</a></li>
						<li class="NavFooter"><a href="index.php?action=Connexion">
							<?php if(empty($_SESSION['Pseudo'])):
								echo 'Connexion';
								else:
								echo htmlspecialchars($_SESSION['Pseudo']);
								endif;
							?></a></li>
						<?php if(isset($_SESSION['Droit']) && $_SESSION['Droit']){
							echo '<li class="NavFooter"><a href="index.php?action=Admin">Admin</li></a>';
						} ?>
			</ul>
			<ul id="LienExt">
				<li><a href="https://www.montsegursurlauzon.fr/">Site de la mairie</a></li>
				<li><a href="https://www.facebook.com/asscvm.montsegur.7">
					<figure>
						<img id="Fb" src="App/Public/Image/Icone/facebook.png" alt="Facebook" />
					</figure>
				</a></li>
			</ul>
		</footer>
	</body>
</html>