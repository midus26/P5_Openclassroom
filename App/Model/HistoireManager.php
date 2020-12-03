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
		public function addHistoire($Image,$altImage,$Annee,$Titre,$Texte)
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
						move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Histoire/' . $date . $Image['name']);
						$bdd = $this->bddConnect();
						$billet = $bdd->prepare('INSERT INTO histoire(CheminImage,AltImage,Annee,Titre,Texte) VALUES(?,?,?,?,?)');
						$billet->execute(array('App/Public/Image/Histoire/' . $date . $Image['name'],$altImage,intval($Annee),$Titre,$Texte));
					}
					else{
						throw new Exception("Extension de 'image invalide");
					}
				}
				else{
					throw new Exception("Image supérieur à 8Mo");
				}
			}
			else{
				throw new Exception("Image inexistante");
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
						move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Histoire/'. $date . $Image['name']);
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
		public function edithistoirepostnoImg($idHistoire,$Annee,$Titre,$Texte)
		{
			$bdd = $this->bddConnect();
			$histoire = $bdd->prepare('UPDATE histoire SET Annee=?,Titre=?,Texte=? WHERE Id=?');
			$histoire->execute(array($Annee,$Titre,$Texte,$idHistoire));
		}
		public function edithistoirePost($idHistoire,$Image,$AltImage,$Annee,$Titre,$Texte)
		{
			$date = date("d-m-Y-h-i-s_");
			$bdd = $this->bddConnect();
			$histoire = $bdd->prepare('UPDATE histoire SET CheminImage=?,AltImage=?,Annee=?,Titre=?,Texte=? WHERE Id=?');
			$histoire->execute(array('App/Public/Image/Histoire/'. $date . $Image['name'],$AltImage,$Annee,$Titre,$Texte,$idHistoire));
		}
		public function deleteImg($idHistoire)
		{
			$Billets = $this->selectHistoire($idHistoire);
			while($billet = $Billets->fetch()){
				$Open = opendir("App/Public/Image/Histoire");
				$Lecture = readdir($Open);
				unlink($billet['CheminImage']);
				closedir($Open);
			}
		}
		public function deleteHistoire($idHistoire)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('DELETE FROM histoire WHERE Id = ?');
			$Billets->execute(array($idHistoire));
		}
	}