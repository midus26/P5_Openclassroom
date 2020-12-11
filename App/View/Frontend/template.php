<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>ASSCVM</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width"/>
		<link rel="icon" href="App/Public/Image/Icone/icone.jpg" />
		<link rel="stylesheet" href="App/Public/Css/style.css" />
	</head>
	
	<body>
		<header>
		<div id="En-tete">
			<div id="En-tete_Left">
				<a href="index.php" id ="LogoAccueil">
					<img src="App/Public/Image/360/360_Long.jpg" alt="Vue Chapelle st félix" id="Banderol"/>
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
		<div id="Container">
			<?= $content ?>
		</div>
	</body>
</html>