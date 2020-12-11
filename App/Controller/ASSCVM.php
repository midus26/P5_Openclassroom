<?php
	namespace App\Controller;
	require('vendor/autoload.php');
	
	use App\Model\BilletsManager;
	use App\Model\ClientManager;
	use App\Model\CommentManager;
	use App\Model\EventManager;
	use App\Model\HistoireManager;
	use App\Model\ImageManager;

class ASSCVM{
	static function ListBillets()
	{
		$billetsManager = new BilletsManager();
		$eventManager = new EventManager();
		
		$NbrarticlePage = 5;
		if(isset($_GET['pageArticle']) && intval($_GET['pageArticle'])){
			$Pagearticle = intval($_GET['pageArticle']);
			$Pagearticle = ($Pagearticle-1)*$NbrarticlePage;
		}
		else{
			$Pagearticle = 0;
		}
		if(isset($_GET['pageEvent']) && intval($_GET['pageEvent'])){
			$Pageevent = intval($_GET['pageEvent']);
			$Pageevent = ($Pageevent-1)*$NbrarticlePage;
		}
		else{
			$Pageevent = 0;
		}
		//Compte le nombre de d'articles/evenements
		$nombreBillet = $billetsManager->nombreBillets();
		$nombreEvent = $eventManager->nombreEvents();
		//Calcul du nombre de page possible à afficher
		$NbrpaginationArticle = ceil($nombreBillet['nb_billets']/$NbrarticlePage);
		$NbrpaginationEvent = ceil($nombreEvent['nb_events']/$NbrarticlePage);
		//Récuperer les Articles/Evenement selon la page demander de chacun
		$Billets = $billetsManager->selectbilletLimit($Pagearticle,$NbrarticlePage);
		$Events = $eventManager->selecteventfuturLimit($Pageevent,$NbrarticlePage);
		require("App/View/Frontend/index.php");
	}
	static function Articles()
	{
		$billetsManager = new BilletsManager();
		$Billets = $billetsManager->selectBillets();
		require("App/View/Frontend/Articles.php");
	}
	static function Article($Id)
	{
		$billetsManager = new BilletsManager();
		$commentaireManager = new commentManager();
		
		$Billets = $billetsManager->selectBillet($Id);
		$Commentaires = $commentaireManager->getcommentaire('article',$Id);
		require("App/View/Frontend/Article.php");
	}
	static function Histoires()
	{
		$histoireManager = new HistoireManager();
		$Histoires = $histoireManager->SelectHistoires();
		require("App/View/Frontend/Histoire.php");
	}
	static function Sites()
	{
		require("App/View/Frontend/Sites.php");
	}
	static function Events()
	{
		$eventManager = new EventManager();
		$Events = $eventManager->selectEvents();
		require("App/View/Frontend/Evenements.php");
	}
	
	//CONNEXION/INSCRIPTION
	
	static function Connexion()
	{
		require("App/View/Frontend/Connexion.php");
	}
	static function connexionCheck()
	{
		$clientManager = new ClientManager();
		if($clientManager->VerifPseudo($_POST['Pseudo'])):
			$clientManager->checkConnexion();
		else:
			throw new \Exception("Aucun utilisateur connu sous ce pseudo");
		endif;
		require("App/View/Frontend/Connexion.php");
	}
	static function Inscription()
	{
		$clientManager = new ClientManager();
			if($clientManager->VerifPseudo($_POST['Pseudo'])):
				throw new \Exception("Pseudo déjà utilisé");
			else:
				$Client = $clientManager->addClient();
			endif;
		require("App/View/Frontend/Connexion.php");
	}
	static function Deconnexion()
	{
		$clientManager = new ClientManager();
		$clientManager->sessionDestroy();
		require("App/View/Frontend/Connexion.php");
	}
	static function Administrateur()
	{
		$billetsManager = new BilletsManager();
		$eventManager = new EventManager();
		$histoireManager = new HistoireManager();
		$commentManager = new CommentManager();
		
		$Billets = $billetsManager->selectBillets();
		$Events = $eventManager->selectEvents();
		$Histoires = $histoireManager->selectHistoires();
		$Comments = $commentManager->ReturnAlertMsg();
		
		require("App/View/Backend/Admin.php");
	}
	//ARTICLE
	static function addArticle()
	{
		require("App/View/Backend/AjoutArticle.php");
	}
	static function addarticlePost()
	{
		$billetsManager = new BilletsManager();
		$imageManager = new ImageManager();
			if($imageManager->ctrlerrorImg($_FILES['Image'])):
				if($imageManager->ctrlsizeImg($_FILES['Image'])):
					if($imageManager->ctrlextensionImg($_FILES['Image'])):
						$date = date("d-m-Y-h-i-s");
						$imageManager->addImg($date,'Article',$_FILES['Image']);
						$billetsManager->addBillet($date,$_POST['Titre'],$_FILES['Image'],$_POST['altImage'],$_POST['Texte']);
					else:
						throw new \Exception("L'extension de l'image est invalide");
					endif;
				else:
					throw new \Exception("Image trop lourde pour être transmis");
				endif;
			else:
				throw new \Exception("Erreur sur l'image");
			endif;
		header('Location: index.php?action=Admin');
	}
	static function editArticle()
	{
		$billetsManager = new BilletsManager();
		$Billets= $billetsManager->selectBillet($_GET['idArticle']);
		require("App/View/Backend/EditArticle.php");
	}
	static function editarticlePost($sameImage)
	{
		$billetsManager = new BilletsManager();
		$imageManager = new ImageManager();
		if($sameImage == "Oui"){
			$Billets = $billetsManager->editbilletnoImg($_POST['altImage'],$_POST['Titre'],$_POST['Texte'],$_GET['idArticle']);
			header('Location: index.php?action=Admin');
		}
		elseif($sameImage == "Non"){
				if($imageManager->ctrlerrorImg($_FILES['Image'])):
					if($imageManager->ctrlsizeImg($_FILES['Image'])):
						if($imageManager->ctrlextensionImg($_FILES['Image'])):
							//Supprime l'ancienne image
							$imageManager->deleteImg("Article",$billetsManager->selectBillet($_GET['idArticle']));
							//Ajoute la nouvelle image
							$date = date("d-m-Y-h-i-s_");
							$imageManager->addImg($date,"Article",$_FILES['Image']);
							$Billets = $billetsManager->editBillet($date,$_FILES['Image'],$_POST['altImage'],$_POST['Titre'],$_POST['Texte'],$_GET['idArticle']);
						else:
							throw new \Exception("L'extension de l'image est incorrect");
						endif;
					else:
						throw new \Exception("Image trop lourde pour être transmis");
					endif;
				else:
					throw new \Exception("Erreur sur l'image");
				endif;
			header('Location: index.php?action=Admin');
		}
		else{
			throw new \Exception("Aucune des 2 possibilité pour conserver l'image n'est choisi");
		}
	}
	static function deleteArticle()
	{
		$billetsManager = new BilletsManager();
		$imageManager = new ImageManager();
		$imageManager->deleteImg("Article",$billetsManager->selectBillet($_GET['idArticle']));
		$Billets = $billetsManager->deleteArticle($_GET['idArticle']);
		header('Location: index.php?action=Admin');
	}
	//COMMENTAIRE
	static function addComment($Section,$idPost)
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->addComment($Section,$idPost,$_SESSION['Id'],$_POST['Message']);
		if($Section == "article"){
			header('Location: index.php?action=article&Section='. $Section . '&idArticle='.$idPost.'');
		}
		elseif($Section == "event"){
			header('Location: index.php?action=event&Section='. $Section . '&idEvent='.$idPost.'');
		}
		else{
			header('Location: index.php?');
		}
	}
	static function restoreComment()
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->restoreComment($_GET['idComment']);
		header('Location: index.php?action=Admin');
	}
	static function editComment($Section,$IdRef,$IdComment)
	{
		$commentManager = new CommentManager();
		$Commentaires = $commentManager->selectComment($Section,$IdRef,$IdComment);
		switch($Section){
			case "article":
				$billetsManager = new BilletsManager();
				$References = $billetsManager->selectBillet($IdRef);
			break;
			case "event":
				$eventManager = new EventManager();
				$References = $eventManager->selectEvent($IdRef);
			break;
			default:
				throw new \Exception("Erreur de la section de redirection");
			break;
		}
		require("App/View/Frontend/Commentaire.php");
	}
	static function editcommentPost($IdComment,$Message)
	{
		$commentManager = new CommentManager();
		$Commentaires = $commentManager->updateComment($IdComment,$Message);
	}
	static function deleteComment($IdComment)
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->deleteComment($IdComment);
	}
	static function signalComment($IdComment)
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->signalComment($IdComment);
	}
	//EVENEMENT
	static function event($Id)
	{
		$eventsManager = new EventManager();
		$Events = $eventsManager->SelectEvent($Id);
		$commentairesManager = new CommentManager();
		$Commentaires = $commentairesManager->getcommentaire('event',$Id);
		require("App/View/Frontend/Event.php");
	}
	static function addEvent()
	{
		require("App/View/Backend/AjoutEvent.php");
	}
	static function addeventPost()
	{
		$eventManager = new EventManager();
		$imageManager = new ImageManager();
		
		if($imageManager->ctrlerrorImg($_FILES['Image'])):
			if($imageManager->ctrlsizeImg($_FILES['Image'])):
				if($imageManager->ctrlextensionImg($_FILES['Image'])):
					$date = date("d-m-Y-h-i-s_");
					$imageManager->addImg($date,'Event',$_FILES['Image']);
					$event = $eventManager->addEvent($date,$_FILES['Image'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
					header('Location: index.php?action=Admin');
				else:
					throw new \Exception("L'extension de l'image est invalide");
				endif;
			else:
				throw new \Exception("Image trop lourde pour être transmis");
			endif;
		else:
			throw new \Exception("Erreur sur l'image");
		endif;
	}
	static function editEvent($idEvent)
	{
		$eventManager = new EventManager();
		$Events = $eventManager->SelectEvent($idEvent);
		require("App/View/Backend/EditEvent.php");
	}
	static function editeventPost($sameImage)
	{
		$eventManager = new EventManager();
		$imageManager = new ImageManager();
		
		if($sameImage == "Oui"):
			$Events = $eventManager->editeventpostnoImg($_GET['idEvent'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
			header('Location: index.php?action=Admin');
		elseif($sameImage == "Non"):
			if($imageManager->ctrlerrorImg($_FILES['Image'])):
				if($imageManager->ctrlsizeImg($_FILES['Image'])):
					if($imageManager->ctrlextensionImg($_FILES['Image'])):
						//Supprimer l'ancienne image
						$imageManager->deleteImg("Event",$eventManager->SelectEvent(intval($_GET['idEvent'])));
						//Ajouter la nouvelle image
						$date = date("d-m-Y-h-i-s_");
						$imageManager->addImg($date,"Event",$_FILES['Image']);
						$Events = $eventManager->editeventPost($date,intval($_GET['idEvent']),$_FILES['Image'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
						header('Location: index.php?action=Admin');
					else:
						throw new \Exception("L'extension de l'image incorrect");
					endif;
				else:
					throw new \Exception("Image trop lourde pour être transmise");
				endif;
			else:
				throw new \Exception("Erreur sur l'image");
			endif;
		else:
			throw new \Exception("Aucune des 2 possibilité pour conserver l'image n'est choisi");
		endif;
	}
	static function deleteEvent()
	{
		$eventManager = new EventManager();
		$imageManager = new ImageManager();
		
		$imageManager->deleteImg("Event",$eventManager->SelectEvent(intval($_GET['idEvent'])));
		$eventManager->deleteEvent(intval($_GET['idEvent']));
		header('Location: index.php?action=Admin');
	}
	//Histoire
	static function addHistoire()
	{
		$histoireManager = new HistoireManager();
		$Histoires = $histoireManager->selectHistoires();
		require("App/View/Backend/addHistoire.php");
	}
	static function addhistoirePost()
	{
		$histoireManager = new HistoireManager();
		$imageManager = new ImageManager();
		
		if($imageManager->ctrlerrorImg($_FILES['Image'])):
			if($imageManager->ctrlsizeImg($_FILES['Image'])):
				if($imageManager->ctrlextensionImg($_FILES['Image'])):
					$date = date("d-m-Y-h-i-s_");
					$imageManager->addImg($date,"Histoire",$_FILES['Image']);
					$histoireManager->addHistoire($date,$_FILES['Image'],$_POST['altImage'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
					header('Location: index.php?action=Admin');
				else:
					throw new \Exception("Extension de l'image incorrect");
				endif;
			else:
				throw new \Exception("Image trop lourde pour être transmis");
			endif;
		else:
			throw new \Exception("Erreur sur l'image");
		endif;
	}
	static function editHistoire($idHistoire)
	{
		$histoireManager = new HistoireManager();
		$Histoires = $histoireManager->SelectHistoire($idHistoire);
		require("App/View/Backend/editHistoire.php");
	}
	static function edithistoirePost($sameImage)
	{
		$histoireManager = new HistoireManager();
		$imageManager = new ImageManager();
		
		if ($sameImage == "Oui"):
			$histoireManager->edithistoirepostnoImg($_GET['idHistoire'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
			header('Location: index.php?action=Admin');
		elseif($sameImage == "Non"):
			if($imageManager->ctrlerrorImg($_FILES['Image'])):
				if($imageManager->ctrlsizeImg($_FILES['Image'])):
					if($imageManager->ctrlextensionImg($_FILES['Image'])):
					//Supprimer l'ancienne image
					$imageManager->deleteImg("Histoire",$histoireManager->selectHistoire($_GET['idHistoire']));
					//Ajouter la nouvelle image
						$date = date("d-m-Y-h-i-s_");
						$imageManager->addImg($date,"Histoire",$_FILES['Image']);
						$histoireManager->edithistoirePost($date,$_GET['idHistoire'],$_FILES['Image'],$_POST['altImage'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
						header('Location: index.php?action=Admin');
					else:
						throw new \Exception("Extension de l'image incorrect");
					endif;
				else:
					throw new \Exception("Taille de l'image trop importante");
				endif;
			else:
				throw new \Exception("Erreur sur l'image transmise");
			endif;
		else:
			throw new \Exception("Default sur la conservation de l'image");
		endif;
	}
	static function deleteHistoire($idHistoire)
	{
		$histoireManager = new HistoireManager();
		$imageManager = new ImageManager();
		
		$imageManager->deleteImg("Histoire",$histoireManager->selectHistoire(intval($_GET['idHistoire'])));
		$histoireManager->deleteHistoire($idHistoire);
		header('Location: index.php?action=Admin');
	}
	//ERREUR throw new Exception
	static function Erreur($TexteErreur)
	{
		require("App/View/Frontend/Erreur.php");
	}
}