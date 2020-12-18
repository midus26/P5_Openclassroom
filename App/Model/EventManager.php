<?php
	namespace App\Model;
	require('vendor/autoload.php');
	use App\Model\Manager;
	
	class EventManager extends Manager
	{
		//Chargement des evenements
		public function selectEvents()
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->query('SELECT Id,CheminImage,AltImage,Lieu,Titre,Texte,
			DATE_FORMAT(DateDebut, "%d %m %Y") AS DateDebut,
			DATE_FORMAT(DateFin, "%d %m %Y") AS DateFin,
			HeureDebut,HeureFin FROM evenement ORDER BY Id DESC');
			return $billet;
		}
		//Chargement d'un evenement
		public function selectEvent($idBillet)
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->prepare('SELECT * FROM evenement WHERE Id=?');
			$billet->execute(array($idBillet));
			return $billet;
		}
		public function selecteventFutur()
		{
			$bdd = $this->bddConnect();
			$billet = $bdd->query('SELECT * FROM `evenement` WHERE `DateFin` >= date(NOW())');
			return $billet;
		}
		public function selecteventfuturLimit($Debut,$NbarticlePage)
		{
			$bdd = $this->bddConnect();
			$events = $bdd->prepare('SELECT * FROM evenement WHERE DateFin >= date(NOW()) ORDER BY DateFin DESC LIMIT ' . $Debut . ',' . $NbarticlePage . '');
			$events->execute(array($Debut,$NbarticlePage));
			return $events;
		}
		public function editeventPost($date,$IdEvent,$Image,$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin)
		{
			$bdd = $this->bddConnect();
			$Events = $bdd->prepare('UPDATE evenement SET CheminImage=?,AltImage=?,Lieu=?,Titre=?,Texte=?,DateDebut=?,DateFin=?,HeureDebut=?,HeureFin=? WHERE Id=?');
			$Events->execute(array('App/Public/Image/Event/'. $date . $Image['name'],$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin,$IdEvent));
		}
		public function editeventpostnoImg($IdEvent,$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin)
		{
			$bdd = $this->bddConnect();
			$Events = $bdd->prepare('UPDATE evenement SET AltImage=?,Lieu=?,Titre=?,Texte=?,DateDebut=?,DateFin=?,HeureDebut=?,HeureFin=? WHERE Id=?');
			$Events->execute(array($AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin,$IdEvent));
		}
		public function deleteEvent($id)
		{
			$bdd= $this->bddConnect();
			$Events = $bdd->prepare('DELETE FROM evenement WHERE Id=?');
			$Events->execute(array($id));
		}
		public function addEvent($date,$Image,$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin)
		{
			$bdd = $this->bddConnect();
			$event = $bdd->prepare('INSERT INTO evenement(CheminImage,AltImage,Lieu,Titre,Texte,DateDebut,DateFin,HeureDebut,HeureFin) VALUES (?,?,?,?,?,?,?,?,?)');
			$event->execute(array('App/Public/Image/Event/' . $date . $Image['name'],$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin));
		}
		public function nombreEvents()
		{
			$bdd = $this->bddConnect();
			$Events = $bdd->query('SELECT COUNT(*) AS nb_events FROM evenement WHERE DateFin >= date(NOW())');
			return $Events->fetch();
		}
	}