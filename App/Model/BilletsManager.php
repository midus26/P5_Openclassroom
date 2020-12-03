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
		public function selectbilletLimit($Debut,$NbrarticlePage)
		{
			$bdd = $this->bddConnect();
			$Billets = $bdd->prepare('SELECT * FROM billets ORDER BY Id DESC LIMIT ' . $Debut . ','. $NbrarticlePage . '');
			$Billets->execute(array($Debut));
			return $Billets;
		}
		//Ajout d'un article
		public function addBillet($Titre,$Image,$altImage,$Texte)
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
						move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Article/' . $date . $Image['name'] );
						$bdd = $this->bddConnect();
						$billet = $bdd->prepare('INSERT INTO billets(Titre,CheminImage,AltImage,Texte,DatePost) VALUES(?,?,?,?, NOW())');
						$billet->execute(array($Titre,'App/Public/Image/Article/' . $date . $Image['name'] ,$altImage,$Texte));
					}
					else{Throw new Exception("Extension non autorisée");}
				}
				else{Throw new Exception("L'image est superieur à 8Mo");}
			}
			else{throw new Exception("Erreur sur l'image");}
		}
		//Modifier un billet
		public function editBillet($CheminImage,$AltImage,$Titre,$Texte,$idArticle)
		{
			$date = date("d-m-Y-h-i-s_");
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
		public function deleteImg($idArticle)
		{
			$Billets = $this->selectBillet($idArticle);
			while($billet = $Billets->fetch()){
				$Open = opendir("App/Public/Image/Article");
				$Lecture = readdir($Open);
				unlink($billet['CheminImage']);
				closedir($Open);
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
							move_uploaded_file($Image['tmp_name'], 'App/Public/Image/Article/'. $date . $Image['name']);
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
				else{throw new Exception("Erreur sur l'image");
				$File = false;
				}
				return $File;
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