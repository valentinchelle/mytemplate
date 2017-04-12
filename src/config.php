<?php

$path_to_index = "/montemplate/";
//for the database
function db_connexion(){
	$db_host = "localhost";
	$db_name = "template";
	$db_username= "root";
	$db_password = "";

	try{
		$bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name.'',$db_username,$db_password);
		return $bdd;
		}catch(Exception $e){
			die('Erreur :'.$e->getMessage());
		}
	
}

?>