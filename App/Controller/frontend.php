<?php

	require('vendor/autoload.php');

	use App\Model\BilletsManager;
	use App\Model\ClientManager;
	use App\Model\CommentManager;
	use App\Model\EventManager;
	use App\Model\HistoireManager;
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
		//Calcul du nombre de page à afficher
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
		$Billets = $billetsManager->selectBillet($Id);
		$commentaireManager = new commentManager();
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
	static function Connexion()
	{
		require("App/View/Frontend/Connexion.php");
	}
	static function connexionCheck()
	{
		$clientManager = new ClientManager();
		$clientManager->checkConnexion();
		require("App/View/Frontend/Connexion.php");
	}
	static function VerifPseudo($Pseudo)
	{
		$clientManager = new ClientManager();
		$pseudoCheck = $clientManager->VerifPseudo($Pseudo);
		return $pseudoCheck;
	}
	static function inscription()
	{
		$clientManager = new ClientManager();
		$Client = $clientManager->addClient();
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
		$Billets = $billetsManager->selectBillets();
		$eventManager = new EventManager();
		$Events = $eventManager->selectEvents();
		$histoireManager = new HistoireManager();
		$Histoires = $histoireManager->selectHistoires();
		$commentManager = new CommentManager();
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
		$billetsManager->addBillet($_POST['Titre'],$_FILES['Image'],$_POST['altImage'],$_POST['Texte']);
		ASSCVM::Administrateur();
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
		if($sameImage == "Oui"){
			$Billets = $billetsManager->editbilletnoImg($_POST['altImage'],$_POST['Titre'],$_POST['Texte'],$_GET['idArticle']);
			ASSCVM::Administrateur();
		}
		elseif($sameImage == "Non"){
			$Billets = $billetsManager->addImg($_FILES['Image']);
			if($Billets):
				$Billets = $billetsManager->deleteImg($_GET['idArticle']);
				$Billets = $billetsManager->editBillet($_FILES['Image'],$_POST['altImage'],$_POST['Titre'],$_POST['Texte'],$_GET['idArticle']);
			else:
			
			endif;
			ASSCVM::Administrateur();
		}
		else{
			throw new Exception("Aucune des 2 possibilité pour conserver l'image n'est choisi");
		}
	}
	static function deleteArticle()
	{
		$billetsManager = new BilletsManager();
		$Billets = $billetsManager->deleteImg($_GET['idArticle']);
		$Billets = $billetsManager->deleteArticle($_GET['idArticle']);
		ASSCVM::Administrateur();
	}
	//COMMENTAIRE
	static function addComment($Section,$idPost)
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->addComment($Section,$idPost,$_SESSION['Id'],$_POST['Message']);
		if($Section == "article"){
			ASSCVM::Article($idPost);
		}
		elseif($Section == "event"){
			ASSCVM::Event($idPost);
		}
		else{
			ASSCVM::ListBillets();
		}
	}
	static function restoreComment()
	{
		$commentaireManager = new CommentManager();
		$Commentaires = $commentaireManager->restoreComment($_GET['idComment']);
		ASSCVM::Administrateur();
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
				throw new Exception("Erreur de la section de redirection");
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
		$event = $eventManager->addEvent($_FILES['Image'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
		ASSCVM::Administrateur();
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
		if($sameImage == "Oui"):
			$Events = $eventManager->editeventpostnoImg($_GET['idEvent'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
			ASSCVM::Administrateur();
		elseif($sameImage == "Non"):
			$Event = $eventManager->addImg($_FILES['Image']);
			if($Event):
				$Event = $eventManager->deleteImg($_GET['idEvent']);
			endif;
			$Events = $eventManager->editeventPost($_GET['idEvent'],$_FILES['Image'],$_POST['altImage'],$_POST['Lieu'],$_POST['Titre'],$_POST['Texte'],$_POST['DateDebut'],$_POST['DateFin'],$_POST['TimeStart'],$_POST['TimeEnd']);
			ASSCVM::Administrateur();
		else:
			throw new Exception("Aucune des 2 possibilité pour conserver l'image n'est choisi");
		endif;
	}
	static function deleteEvent()
	{
		$eventManager = new EventManager();
		$Events = $eventManager->deleteImg($_GET['idEvent']);
		$Events = $eventManager->deleteEvent($_GET['idEvent']);
		ASSCVM::Administrateur();
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
		$Histoires = $histoireManager->addHistoire($_FILES['Image'],$_POST['altImage'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
		ASSCVM::Administrateur();
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
		if ($sameImage == "Oui"):
			$Histoires = $histoireManager->edithistoirepostnoImg($_GET['idHistoire'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
			ASSCVM::Administrateur();
		elseif($sameImage == "Non"):
			$Histoires = $histoireManager->addImg($_FILES['Image']);
			if($Histoires):
				$Histoires = $histoireManager->deleteImg($_GET['idHistoire']);
			endif;
			$Histoires = $histoireManager->edithistoirePost($_GET['idHistoire'],$_FILES['Image'],$_POST['altImage'],$_POST['Annee'],$_POST['Titre'],$_POST['Texte']);
			ASSCVM::Administrateur();
		else:
			throw new Exception("Default sur la conservation de l'image");
		endif;
	}
	static function deleteHistoire($idHistoire)
	{
		$histoireManager = new HistoireManager();
		$Histoire = $histoireManager->deleteImg($idHistoire);
		$Histoires = $histoireManager->deleteHistoire($idHistoire);
		ASSCVM::Administrateur();
	}
	//ERREUR throw new Exception
	static function Erreur($TexteErreur)
	{
		require("App/View/Frontend/Erreur.php");
	}
}
$monASSCVM = new ASSCVM();