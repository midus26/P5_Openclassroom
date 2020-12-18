<?php
	namespace App\Model;
	require('vendor/autoload.php');
	use App\Model\Manager;
	
	class HistoireManager extends Manager
	{
		//Chargement des evenements
		public function selectHistoires()
		{
			$bdd = $this->bddConnect();
			$Histoires = $bdd->query('SELECT * FROM histoire ORDER BY Id DESC');
			return $Histoires;
		}
		//Chargement d'un evenement
		public function selectHistoire($idBillet)
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->prepare('SELECT * FROM histoire WHERE Id=?');
			$billet->execute(array($idBillet));
			return $billet;
		}
		public function addHistoire($date,$Image,$altImage,$Annee,$Titre,$Texte)
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->prepare('INSERT INTO histoire(CheminImage,AltImage,Annee,Titre,Texte) VALUES(?,?,?,?,?)');
			$billet->execute(array('App/Public/Image/Histoire/' . $date . $Image['name'],$altImage,intval($Annee),$Titre,$Texte));
		}
		public function edithistoirepostnoImg($idHistoire,$Annee,$Titre,$Texte)
		{
			$bdd = $this->bddConnect();
			$histoire = $bdd->prepare('UPDATE histoire SET Annee=?,Titre=?,Texte=? WHERE Id=?');
			$histoire->execute(array($Annee,$Titre,$Texte,$idHistoire));
		}
		public function edithistoirePost($date,$idHistoire,$Image,$AltImage,$Annee,$Titre,$Texte)
		{
			$bdd = $this->bddConnect();
			$histoire = $bdd->prepare('UPDATE histoire SET CheminImage=?,AltImage=?,Annee=?,Titre=?,Texte=? WHERE Id=?');
			$histoire->execute(array('App/Public/Image/Histoire/'. $date . $Image['name'],$AltImage,$Annee,$Titre,$Texte,$idHistoire));
		}
		public function deleteHistoire($idHistoire)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('DELETE FROM histoire WHERE Id = ?');
			$Billets->execute(array($idHistoire));
		}
	}