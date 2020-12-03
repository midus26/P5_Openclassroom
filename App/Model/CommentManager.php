<?php
	namespace App\Model;
	require('vendor/autoload.php');
	use App\Model\Manager;
	
class CommentManager extends Manager
{
	//Recuperer les commentaires
	public function getcommentaire($Section,$Id)
	{
		$bdd = $this->bddConnect();
		$Comments = $bdd->prepare('SELECT commentaire.Message, client.Pseudo,commentaire.Id FROM commentaire INNER JOIN client ON commentaire.Id_Client = client.Id WHERE commentaire.Section=? AND commentaire.Id_Post=? ORDER BY Id DESC ');
		$Comments->execute(array($Section,$Id));
		return $Comments;
	}
	//Recuperer un commentaire
	public function selectComment($Section,$Id_Post,$Id_Comment)
	{
		$bdd= $this->bddConnect();
		$SelectComment = $bdd->prepare('SELECT commentaire.Message, client.Pseudo,commentaire.Id,commentaire.Section,commentaire.Id_Post FROM commentaire INNER JOIN client ON commentaire.Id_Client = client.Id WHERE commentaire.Section=? AND commentaire.Id_Post=? AND commentaire.Id=?');
		$SelectComment->execute(array($Section,$Id_Post,$Id_Comment));
		return $SelectComment;
	}
	public function updateComment($IdComment,$Message)
	{
		$bdd = $this->bddConnect();
		$Update = $bdd->prepare('UPDATE commentaire SET Message= :newMessage WHERE Id= :IdMsg');
		$Update->execute(array(
		'newMessage' => $Message,
		'IdMsg' => $IdComment));
	}
	public function returnPseudo($idComment)
	{
		$bdd = $this->bddConnect();
		$Pseudo = $bdd->prepare('SELECT client.Pseudo FROM commentaire INNER JOIN client ON commentaire.Id_Client = client.Id WHERE commentaire.id=?');
		$Pseudo->execute(array($idComment));
		$PseudoSelect = $Pseudo->fetch();
		return $PseudoSelect['Pseudo'];
	}
	//Ajout d'un commentaire
	public function addComment($Section,$Id_Post,$Id_Client,$Message)
	{
	$bdd= $this->bddConnect();
    $comments = $bdd->prepare('INSERT INTO commentaire(Section,Id_Post, Id_Client, Message) VALUES(?,?, ?, ?)');
    $affectedLines = $comments->execute(array($Section,$Id_Post,$Id_Client,$Message));
    return $affectedLines;
	}
	//Modification d'un commentaire
	public function editComment($idComment,$Message)
	{
		$bdd= $this->bddConnect();
		$comment = $bdd->prepare('UPDATE commentaire SET Message= :ModifComment WHERE id= :Commentid');
		$comment->execute(array(
		'ModifComment' => $Message,
		'Commentid' => $idComment));
		echo 'Message mis à jour';
	}
	//Signalé un commentaire
	public function signalComment($idComment)
	{
		$bdd= $this->bddConnect();
		$comment = $bdd->prepare('UPDATE commentaire SET Alert_Msg = 1 WHERE Id=?');
		$comment->execute(array($idComment));
	}
	//Supprimer un commentaire
	public function deleteComment($idComment)
	{
		$bdd= $this->bddConnect();
		$comment = $bdd->prepare('DELETE FROM commentaire WHERE id=?');
		$comment->execute(array($idComment));
	}
	//Restaurer un commentaire
	public function restoreComment($idComment)
	{
		$bdd = $this->bddConnect();
		$comment = $bdd->prepare('UPDATE commentaire SET Alert_Msg = 0 WHERE Id = ?');
		$comment->execute(array($idComment));
	}
	//Envoie la liste des commentaires signalé
	public function ReturnAlertMsg()
	{
		$bdd= $this->bddConnect();
		$AlertMsg = $bdd->prepare('SELECT commentaire.Id,commentaire.Message,client.Pseudo FROM commentaire INNER JOIN client ON commentaire.Id_Client = client.Id WHERE Alert_Msg= :Alert');
		$AlertMsg->execute(array(
		'Alert' => 1));
		return $AlertMsg;
	}
}