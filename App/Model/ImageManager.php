<?php
	namespace App\Model;
		require('vendor/autoload.php');
		
	class ImageManager
	{
		public function ctrlsizeImg($Image)
		{
			$File = false;
			if($Image['size'] <= 1000000):
				$File = true;
			else:
				$File = false;
			endif;
			return $File;
		}
		public function ctrlerrorImg($Image)
		{
			$File = false;
			if($Image['error'] == 0):
				$File = true;
			else: 
				$File = false;
			endif;
		return $File;
		}
		public function ctrlextensionImg($Image)
		{
			$File = false;
			$infosfichier = pathinfo($Image['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
			if (in_array($extension_upload, $extensions_autorisees)):
				$File = true;
			else:
				$File = false;
			endif;
			return $File;
		}
		public function addImg($date,$Section,$Image)
		{
			move_uploaded_file($Image['tmp_name'], 'App/Public/Image/'. $Section .'/'. $date . $Image['name']);
		}
		public function deleteImg($Section,$Billets)
		{
			while($billet = $Billets->fetch()){
				$Open = opendir('App/Public/Image/'.$Section);
				$Lecture = readdir($Open);
				unlink($billet['CheminImage']);
				closedir($Open);
			}
		}
	}