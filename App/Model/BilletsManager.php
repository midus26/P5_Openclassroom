<?php
	namespace App\Model;
	require('vendor/autoload.php');
	use App\Model\Manager;
	
	class BilletsManager extends Manager
	{
		//Chargement des articles
		public function selectBillets()
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->query('SELECT * FROM billets ORDER BY Id DESC');
			return $Billets;
		}
		//Chargement d'un article
		public function selectBillet($idBillet)
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->prepare('SELECT * FROM billets WHERE Id=?');
			$billet->execute(array($idBillet));
			return $billet;
		}
		//Pagination des billets
		public function selectbilletLimit($Debut,$NbrarticlePage)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('SELECT * FROM billets ORDER BY Id DESC LIMIT ' . $Debut . ','. $NbrarticlePage . '');
			$Billets->execute(array($Debut));
			return $Billets;
		}
		//Ajout d'un article
		public function addBillet($date,$Titre,$Image,$altImage,$Texte)
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->prepare('INSERT INTO billets(Titre,CheminImage,AltImage,Texte,DatePost) VALUES(?,?,?,?, NOW())');
			$billet->execute(array($Titre,'App/Public/Image/Article/' . $date . $Image['name'] ,$altImage,$Texte));
		}
		//Modifier un billet
		public function editBillet($date,$CheminImage,$AltImage,$Titre,$Texte,$idArticle)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('UPDATE billets SET CheminImage=?,AltImage=?,Titre=?,Texte=? WHERE Id = ?');
			$Billets->execute(array(('App/Public/Image/Article/'. $date . $CheminImage['name']),$AltImage,$Titre,$Texte,$idArticle));
		}
		public function editbilletnoImg($AltImage,$Titre,$Texte,$idArticle)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('UPDATE billets SET AltImage=?,Titre=?,Texte=? WHERE Id = ?');
			$Billets->execute(array($AltImage,$Titre,$Texte,$idArticle));
		}
		//Supprimer un billet
		public function deleteArticle($idArticle)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('DELETE FROM billets WHERE Id = ?');
			$Billets->execute(array($idArticle));
		}
		public function nombreBillets()
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->query('SELECT COUNT(*) AS nb_billets FROM billets');
			return $Billets->fetch();
		}
	}