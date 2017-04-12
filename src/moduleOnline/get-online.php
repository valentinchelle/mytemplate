<?php 
session_start();
include('../config.php');
$db = db_connexion();

$query = $db->prepare("
SELECT * 
FROM users_online
WHERE online_user = :id");

$query->execute(array(
'id' => $_SESSION['id']
));

// on compte le nombre d'entrées
$count = $query->rowCount();
$data = $query->fetch();

if(isset($_SESSION['id'])){
	
	if($count== 0){
		echo'ee';
		$insert = $db->prepare('
		INSERT INTO users_online(online_ip, online_user, online_status, online_time)
		VALUES(:ip, :user, :status, :time)
		');
		$insert->execute(array(
		'ip' => $_SERVER["REMOTE_ADDR"],
		'user'=> $_SESSION['id'],
		'status'=> '2',
		'time' => time()
		));
		$insert->closeCursor();
	}else{
		$update = $db->prepare('UPDATE users_online SET online_time = :time WHERE online_user = :user');
		$update -> execute(array(
			'time' => time(),
			'user' => $_SESSION['id']
		));
		$update-> closeCursor();
			
		
	}
}
$query-> closeCursor();
$time_out = time()-50;
$delete = $db->prepare('DELETE FROM users_online WHERE online_time < :time');
$delete -> execute(array('time' => $time_out));
$delete -> closeCursor();

$query = $db->prepare("SELECT online_id, online_user, online_status, online_time, id, username
	FROM users_online
	LEFT JOIN users ON users.id = users_online.online_user
	ORDER BY id");
	$query->execute();
	$json['error'] = '1';
	$count = $query->rowCount();
	
	if($count != 0){
		// aucune erreur 
		$json['error'] = 0;
		$i = 0;
		while($data = $query->fetch()) {
		if($data['online_status'] == '0') {
			$status = 'inactive';
		} elseif($data['online_status'] == '1') {
			$status = 'busy';
		} elseif($data['online_status'] == '2') {
			$status = 'active';
		}
		
		// On enregistre dans la colonne [status] du tableau
		// le statut du membre : busy, active ou inactive (occupé, en ligne, absent)
		$infos["status"] = htmlentities($status);
		// Et on enregistre dans la colonne [login] le pseudo
		$infos["login"] = htmlentities($data['username']);
		$infos["id"] = $data['id'];
		// Enfin on enregistre le tableau des infos de CE MEMBRE
		// dans la [i ème] colonne du tableau des comptes 
		$accounts[$i] = $infos;
		$i++;
	}
	// On enregistre le tableau des comptes dans la colonne [list] de JSON
	$json['list'] = $accounts;
} else {
	// Il y a une erreur, aucun membre dans la liste
	$json['error'] = '1';
}

$query->closeCursor();

// Encodage de la variable tableau json et affichage

echo json_encode($json);
?>