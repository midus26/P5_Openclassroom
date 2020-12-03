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
		public function editeventPost($IdEvent,$Image,$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin)
		{
			$date = date("d-m-Y-h-i-s_");
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
		public function addEvent($Image,$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin)
		{
			$date = date("d-m-Y-h-i-s_");
			//Controle du fichier
			if (isset($Image) && $Image['error'] == 0){
				// Testons si le fichier n'est pas trop gros
				if ($Image['size'] <= 1000000)
				{
					// Testons si l'extension est autorisée
					$infosfichier = pathinfo($Image['name']);
					$extension_upload = $infosfichier['extension'];
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						// On peut valider le fichier et le stocker définitivement
						move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Event/' . $date . $Image['name']);
						$bdd = $this->bddConnect();
						$event = $bdd->prepare('INSERT INTO evenement(CheminImage,AltImage,Lieu,Titre,Texte,DateDebut,DateFin,HeureDebut,HeureFin) VALUES (?,?,?,?,?,?,?,?,?)');
						$event->execute(array('App/Public/Image/Event/' . $date . $Image['name'],$AltImage,$Lieu,$Titre,$Texte,$DateDebut,$DateFin,$HeureDebut,$HeureFin));
					}
					else{
						throw new Exception("extension du fichier invalide");
					}
				}
				else{
					throw new Exception("Image supérieur à 8Mo");
				}
			}
			else{
				throw new Exception("Erreur sur l'image");
			}
		}
		public function addImg($Image)
		{
			$File = false;
			$date = date("d-m-Y-h-i-s_");
			//Controle du fichier
			if (isset($Image) && $Image['error'] == 0){
				// Testons si le fichier n'est pas trop gros
				if ($Image['size'] <= 1000000)
				{
					// Testons si l'extension est autorisée
					$infosfichier = pathinfo($Image['name']);
					$extension_upload = $infosfichier['extension'];
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
					if (in_array($extension_upload, $extensions_autorisees))
					{
						// On peut valider le fichier et le stocker définitivement
						move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Event/'. $date . $Image['name']);
						$File = true;
					}
					else{
						Throw new Exception("Extension non autorisée");
						$File = false;
					}
				}
				else{
					Throw new Exception("L'image est superieur à 8Mo");
					$File = false;
				}
			}
			else{
				throw new Exception("Erreur sur l'image");
				$File = false;
			}
			return $File;
		}
		public function deleteImg($idEvent)
		{
			$Billets = $this->selectEvent($idEvent);
			while($billet = $Billets->fetch()){
				$Open = opendir("App/Public/Image/Event");
				$Lecture = readdir($Open);
				unlink($billet['CheminImage']);
				closedir($Open);
			}
		}
		public function nombreEvents()
		{
			$bdd = $this->bddConnect();
			$Events = $bdd->query('SELECT COUNT(*) AS nb_events FROM evenement WHERE DateFin >= date(NOW())');
			return $Events->fetch();
		}
	}