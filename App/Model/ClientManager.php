<?php
	namespace App\Model;
	require('vendor/autoload.php');
	
	use App\Model\Manager;
	
class ClientManager extends Manager
{
	public function addClient()
	{
		$bdd = $this->bddConnect();
		//Hachage du Mot de Passe
			$Pass_hache = password_hash($_POST['Password'], PASSWORD_DEFAULT);

		// Insertion
			$req = $bdd->prepare('INSERT INTO client(Pseudo, Password) VALUES(:Pseudo, :Password)');
			$req->execute(array(
				'Pseudo' => $_POST['Pseudo'],
				'Password' => $Pass_hache));
	}
	public function checkConnexion()
	{
		$bdd= $this->bddConnect();
		//  Récupération de l'utilisateur et de son pass hashé
			$req = $bdd->prepare('SELECT Id,Droit, Password FROM client WHERE Pseudo = :Pseudo');
			$req->execute(array(
				'Pseudo' => $_POST['Pseudo']));
			$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
			$isPasswordCorrect = password_verify($_POST['Password'], $resultat['Password']);

		if (!$resultat)
		{
			throw new \Exception("Erreur de connexion");
		}
		else
		{
			if ($isPasswordCorrect){
				$_SESSION['Id'] = $resultat['Id'];
				$_SESSION['Pseudo'] = $_POST['Pseudo'];
				$_SESSION['Droit'] = $resultat['Droit'];
			}
			else {
				throw new \Exception('Mauvais identifiant ou mot de passe !');
			}
		}
	}
	public function sessionDestroy()
	{
		$_SESSION = array();
		session_destroy();
	}
	public function VerifPseudo($Pseudo)
	{
		$UsePseudo = false;
		$bdd= $this->bddConnect();
		$req = $bdd->prepare('SELECT Pseudo FROM client WHERE Pseudo= ?');
		$req->execute(array($Pseudo));
		while($PseudoClient = $req->fetch()){
			if ($Pseudo == $PseudoClient['Pseudo']){
				$UsePseudo = true;
			}
		}
		return $UsePseudo;
	}
}