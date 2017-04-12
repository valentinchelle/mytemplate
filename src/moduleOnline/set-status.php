<?php

session_start();
include('../config.php');
$db = db_connexion();
if(isset($_SESSION['id']) and isset($_POST['status'])) {
	$insert = $db->prepare('
		UPDATE users_online SET online_status = :status WHERE online_user = :user
	');
	$insert->execute(array(
		'status' => $_POST['status'],
		'user' => $_SESSION['id']		
	));
	
}
?>