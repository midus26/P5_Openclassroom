<?php
	namespace App\Model;
	
	class Manager
	{
		protected function bddConnect()
		{
			$bdd = new \PDO('mysql:host=localhost;dbname=asscvm;charset=utf8', 'root', 'root');
			return $bdd;
		}
	}