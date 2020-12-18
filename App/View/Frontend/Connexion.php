<?php ob_start(); ?>
<?php $title = "ASSCVM - Connexion"; ?>
	<?php if(empty($_SESSION['Pseudo'])): ?>
	<h2>Connexion</h2>
		<form method="post" action="index.php?action=checkConnexion">
			<label for="Pseudo">Pseudo</label>
			<input type="text" name="Pseudo" id="Pseudo" class="Pseudo" required/>
			<label for="Password">Mot de passe</label>
			<input type="password" name="Password" id="Password" class="Password" required/>
			<button id="btnConnexion" type="submit">Connexion</button>
		</form>
	<?php else: ?>
		<p>Vous êtes connecté en tant que <?php echo htmlspecialchars($_SESSION['Pseudo']); ?></p>
		<form method="post" action="index.php?action=Disconnect">
			<button id="btnDeconnexion" type="submit">Déconnexion</button>
		</form>
		<h3>L'avantage d'avoir un compte sur l'asscvm</h3>
		<p>En étant connecté, vous pourrez commenter les différents articles ou évenements que vous souhaitez . </p>
	<?php endif; ?>
	<?php if(empty($_SESSION['Pseudo'])): ?>
		<h2>Inscription</h2>
		<form method="post" action="index.php?action=Inscription">
			<label for="Pseudo">Pseudo</label>
			<input type="text" name="Pseudo" id="Pseudo" class="Pseudo" required/>
			<label for="Password">Mot de passe</label>
			<input type="password" name="Password" id="Password" class="Password" required/>
			<label for="PasswordCheck">Retaper le mot de passe</label>
			<input type="password" name="PasswordCheck" id="PasswordCheck" required/>
			<button id="btnInscription" type="submit">inscription</button>
		</form>
	<?php endif; ?>
	<script src="App/Public/Js/CtrlConnexion.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php");
