<?php
	session_start();
	require("App/Controller/frontend.php");
	
try{
		if(isset($_GET['action'])):
			
			//ADMIN
			if($_GET['action'] == "Admin"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					ASSCVM::Administrateur();
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
				
			//ARTICLE
			
			//Acces aux articles
			elseif($_GET['action'] == "Articles"):
				ASSCVM::Articles();
			//Acces à un article
			elseif($_GET['action'] == "article"):
				if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
					ASSCVM::Article(intval($_GET['idArticle']));
				else:
					throw new Exception("Numero de l'article non transmis");
				endif;
			
			//Admin Ajout d'un article
			elseif($_GET['action'] == "addArticle"):
				if (isset($_SESSION['Droit']) && $_SESSION['Droit']):
					ASSCVM::addArticle();
				//Si l'utilisateur ne dispose pas des droits d'acces
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Validation de l'ajout d'un article
			elseif($_GET['action'] == "addarticlePost"):
				if (isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(file_exists($_FILES['Image']['tmp_name'])):
						if (!empty($_POST['altImage']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
							ASSCVM::addarticlePost();
						else:
							throw new Exception("Tous les champs ne sont pas remplis");
						endif;
					else:
						throw new Exception("Une erreur s'est produite sur l'image à envoyer");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Modification d'un article
			elseif($_GET['action'] == "editArticle"):
				if (isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
						ASSCVM::editArticle(intval($_GET['idArticle']));
					else:
						throw new Exception("Numero de l'article non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Verification de la modification d'un article
			elseif($_GET['action'] == "editarticlePost"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
						if(isset($_POST['sameImage']) && $_POST['sameImage'] == "Oui"):
							if(!empty($_POST['altImage']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
								ASSCVM::editarticlePost($_POST['sameImage']);
							else:
								throw new Exception("Tous les champs ne sont pas remplis");
							endif;
						elseif(isset($_POST['sameImage']) && $_POST['sameImage'] == "Non"):
							if(file_exists($_FILES['Image']['tmp_name']) && !empty($_POST['altImage']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
								ASSCVM::editarticlePost($_POST['sameImage']);
							else:
								throw new Exception("Aucune image transmis");
							endif;
						else:
							throw new Exception("Default sur le choix pour l'image");
						endif;
					else:
						throw new Exception("Numero de l'article à modifier non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'access");
				endif;
			//Supprimer un article
			elseif($_GET['action'] == "deleteArticle"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
						ASSCVM::deleteArticle();
					else:
						throw new Exception("Numero de l'article non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//COMMENTAIRE
			//Ajout d'un commentaire sur un article
			elseif($_GET['action'] == "addcommentaireArticle"):
				if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
					if(isset($_SESSION['Pseudo'])):
						if(!empty($_POST['Message'])):
							ASSCVM::addComment("article",$_GET['idArticle']);
						else:
							throw new Exception("Le contenu de votre commentaire est vide");
						endif;
					else:
						throw new Exception("Inscrivez vous sur le site pour pouvoir poster un commentaire");
					endif;
				else:
					throw new Exception("Numero de l'article non transmis");
				endif;
			//Ajout d'un commentaire sur un evenement
			elseif($_GET['action'] == "addcommentaireEvent"):
				if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
					if(isset($_SESSION['Droit'])):
						if(!empty($_POST['Message'])):
							ASSCVM::addComment("event",$_GET['idEvent']);
						else:
							throw new Exception("Le contenu de votre commentaire est vide");
						endif;
					else:
						throw new Exception("Vous ne disposez pas des droits pour poster un commentaire");
					endif;
				else:
					throw new Exception("Numero de l'article non transmis");
				endif;
			//Modifier son commentaire
			elseif($_GET['action'] == "editComment"):
				if(isset($_GET['Section'])):
					switch($_GET['Section']){
						case "article" :
							if(isset($_GET['idArticle']) && isset($_GET['idComment']) && intval($_GET['idArticle']) && intval($_GET['idComment'])):
								ASSCVM::editComment($_GET['Section'],$_GET['idArticle'],$_GET['idComment']);
							else:
								throw new Exception("Identifiant Article/Commentaire non transmis");
							endif;
						break;
						case "event" :
							if(isset($_GET['idEvent']) && isset($_GET['idComment']) && intval($_GET['idEvent']) && intval($_GET['idComment'])):
								ASSCVM::editComment($_GET['Section'],$_GET['idEvent'],$_GET['idComment']);
							else:
								throw new Exception("Identifiant Evenenement/Commentaire non transmis");
							endif;
						break;
						default :
							throw new Exception("Section non transmise");
						break;
					}
				else:
					throw new Exception("Section non transmise");
				endif;
			//Modifier commentaire + Redirection sur le post
			elseif($_GET["action"] == "editcommentairePost"):
				if(isset($_GET['Section'])):
					switch($_GET['Section']){
						case "article" :
							if(isset($_GET['idArticle']) && intval($_GET['idArticle'])):
								if(!empty($_POST['Message'])):
									ASSCVM::editcommentPost($_GET['idComment'],$_POST['Message']);
									ASSCVM::Article($_GET['idArticle']);
								else:
									throw new Exception("Le contenu du commentaire est vide");
								endif;
							else:
								throw new Exception("Identifiant article non transmis");
							endif;
						break;
						case "event" :
							if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
								if(!empty($_POST['Message'])):
									ASSCVM::editcommentPost($_GET['idComment'],$_POST['Message']);
									ASSCVM::Event($_GET['idEvent']);
								else:
									throw new Exception("Le contenu du commentaire est vide");
								endif;
							else:
								throw new Exception("Identifiant article non transmis");
							endif;
						break;
						default :
							throw new Exception("Section non transmis");
						break;
					}
				else:
					throw new Exception("information de la section non transmise");
				endif;
			//Supprimer un commentaire
			elseif($_GET['action'] == "deleteComment"):
				if(isset($_GET['Section'])):
					if(isset($_GET['idComment']) && intval($_GET['idComment'])):
						ASSCVM::deleteComment($_GET['idComment']);
					else:
						throw new Exception("Numero du commentaire non transmis");
					endif;
					switch($_GET['Section']){
						case "article" :
							ASSCVM::Article($_GET['idArticle']);
						break;
						case "event" :
							ASSCVM::Event($_GET['idEvent']);
						break;
						case "Admin":
							ASSCVM::Administrateur();
						break;
						default :
							throw new Exception("Section non transmise");
						break;
					}
				elseif(isset($_SESSION['Pseudo']) && $_SESSION['Pseudo']):
					throw new Exception("Section non transmise");
				else:
					throw new Exception("Section non transmise");
				endif;
			//Signaler
			elseif($_GET['action'] == "signalComment"):
				if(isset($_GET['Section'])):
					if(isset($_GET['idComment']) && intval($_GET['idComment'])):
						ASSCVM::signalComment($_GET['idComment']);
					else:
						throw new Exception("Identifiant du commentaire non transmis");
					endif;
					switch($_GET['Section']){
						case "article" :
							ASSCVM::Article($_GET['idArticle']);
						break;
						case "event" :
							ASSCVM::Event($_GET['idEvent']);
						break;
						default :
							throw new Exception("Redirection non transmis");
						break;
					}
				else:
					throw new Exception("Numero du commentaire non transmis");
				endif;
			//Ne plus signaler
			elseif($_GET['action'] == "restoreComment"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idComment']) && intval($_GET['idComment'])):
						ASSCVM::restoreComment();
					else:
						throw new Exception("Identifiant du commentaire non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//CONNEXION
			//Acces page de connexion/deconnexion
			elseif($_GET['action'] == 'Connexion'):
				ASSCVM::Connexion();
			//Verification de connexion
			elseif($_GET['action'] == 'checkConnexion'):
				if(!empty($_POST['Pseudo']) && !empty($_POST['Password'])):
					if(ASSCVM::VerifPseudo($_POST['Pseudo'])):
						ASSCVM::connexionCheck();
					else:
						throw new Exception("Pseudo inconnu");
					endif;
				else:
					throw new Exception("Tous les champs ne sont pas remplis");
				endif;
			//Deconnexion de l'utilisateur
			elseif($_GET['action'] == "Disconnect"):
				ASSCVM::Deconnexion();
			//Inscription du nouvel utilisateur
			elseif($_GET['action'] == "Inscription"):
				if(!empty($_POST['Pseudo']) && !empty($_POST['Password']) && !empty($_POST['PasswordCheck'])):
					if($_POST['Password'] != $_POST['PasswordCheck']):
						throw new Exception("Vous n'avez pas saisie le meme mot de passe");
					else:
						if(ASSCVM::VerifPseudo($_POST['Pseudo'])):
							throw new Exception("Pseudo déjà utilisé");
						else:
							ASSCVM::Inscription();
						endif;
					endif;
				else:
					throw new Exception("Tous les champs ne sont pas remplis");
				endif;
			//EVENEMENT
			elseif($_GET['action'] == "event"):
				if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
					ASSCVM::event($_GET['idEvent']);
				else:
					throw new Exception("Numero de l'event non transmis");
				endif;
			elseif($_GET['action'] == "addEvent"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					ASSCVM::addEvent();
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
				//Acces page des evenement
			elseif($_GET['action'] == 'Evenement'):
				ASSCVM::Events();
			//verification pour ajouter un evenement
			elseif($_GET['action'] == "addeventPost"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(file_exists($_FILES['Image']['tmp_name'])):
						if(!empty($_POST['altImage']) && !empty($_POST['Lieu']) && !empty($_POST['Titre']) && !empty($_POST['Texte']) && !empty($_POST['DateDebut']) && !empty($_POST['DateFin']) && !empty($_POST['TimeStart']) && !empty($_POST['TimeEnd'])):
							ASSCVM::addeventPost();
						else:
							throw new Exception("Tous les champs ne sont pas remplis");
						endif;
					else:
						throw new Exception("Erreur sur l'image");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Modifier un evenement
			elseif($_GET['action'] == "editEvent"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
						ASSCVM::editEvent($_GET['idEvent']);
					else:
						throw new Exception("Identifiant de l'evenement à modifier non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Verification pour modifier un evenement
			elseif($_GET['action'] == "editeventPost"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
						if(isset($_POST['sameImage']) && $_POST['sameImage'] == "Oui"):
							if(!empty($_POST['altImage']) && !empty($_POST['DateDebut']) && !empty($_POST['DateFin'])  && !empty($_POST['TimeStart']) && !empty($_POST['TimeEnd']) && !empty($_POST['Lieu']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
								ASSCVM::editeventPost($_POST['sameImage']);
							else:
								throw new Exception("Tous les champs ne sont pas remplis");
							endif;
						elseif(isset($_POST['sameImage']) && $_POST['sameImage'] == "Non"):
							if(file_exists($_FILES['Image']['tmp_name'])):
								ASSCVM::editeventPost($_POST['sameImage']);
							else:
								throw new Exception("Aucune image sélectionner");
							endif;
						else:
							throw new Exception("Erreur pour le choix de l'image");
						endif;
					else:
						throw new Exception("Numero de l'event non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Supprimer un evenement
			elseif($_GET['action'] == "deleteEvent"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idEvent']) && intval($_GET['idEvent'])):
						ASSCVM::deleteEvent();
					else:
						throw new Exception("Numero de l'event non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//HISTOIRE
			//Acces page de l'histoire de l'association
			elseif($_GET['action'] == 'Histoire'):
				ASSCVM::Histoires();
			//Ajout d'un article de l'histoire
			elseif($_GET['action'] == "addHistoire"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					ASSCVM::addHistoire();
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Verification de l'ajout d'un article d'histoire
			elseif($_GET['action'] == "addhistoirePost"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(file_exists($_FILES['Image']['tmp_name'])):
						if(!empty($_POST['altImage']) && !empty($_POST['Annee']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
							ASSCVM::addhistoirePost();
						else:
							throw new Exception("Tous les champs ne sont pas remplis");
						endif;
					else:
						throw new Exception("Erreur sur l'image");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Modifiaction d'un article d'histoire
			elseif($_GET['action'] == "editHistoire"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idHistoire']) && intval($_GET['idHistoire'])):
						ASSCVM::editHistoire($_GET['idHistoire']);
					else:
						throw new Exception("Numero de l'histoire non transmis");
					endif;
				
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			elseif($_GET['action'] == "edithistoirePost"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idHistoire']) && intval($_GET['idHistoire'])):
						if(isset($_POST['sameImage']) && $_POST['sameImage'] == 'Oui'):
							if(!empty($_POST['altImage']) && !empty($_POST['Annee']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
								ASSCVM::edithistoirePost($_POST['sameImage']);
							else:
								throw new Exception("Tous les champs ne sont pas remplis");
							endif;
						elseif(isset($_POST['sameImage']) && $_POST['sameImage'] == 'Non'):
							if(file_exists($_FILES['Image']['tmp_name']) && !empty($_POST['altImage']) && !empty($_POST['Annee']) && !empty($_POST['Titre']) && !empty($_POST['Texte'])):
								ASSCVM::edithistoirePost($_POST['sameImage']);
							else:
								throw new Exception("Image non transmis");
							endif;
						else:
							throw new Exception("Default sur le choix pour l'image");
						endif;
					else:
						throw new Exception("Numero de l'Identifiant histoire non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Supprimer un article de l'histoire
			elseif($_GET['action'] == "deleteHistoire"):
				if(isset($_SESSION['Droit']) && $_SESSION['Droit']):
					if(isset($_GET['idHistoire']) && intval($_GET['idHistoire'])):
						ASSCVM::deleteHistoire($_GET['idHistoire']);
					else:
						throw new Exception("Numero de l'histoire non transmis");
					endif;
				else:
					throw new Exception("Vous ne disposez pas des droits d'acces");
				endif;
			//Acces page des différents monuments
			elseif($_GET['action'] == 'Sites'):
				ASSCVM::Sites();
			endif;
		//Page d'accueil (par defaut)
		else:
			ASSCVM::ListBillets();
		endif;
}
catch(\Exception $e){

	ASSCVM::Erreur($e->getMessage());
}