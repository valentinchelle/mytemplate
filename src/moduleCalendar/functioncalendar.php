<?php
function recup_month($month, $year){
	$bdd = db_connexion();
	$sql = $bdd -> prepare("SELECT * FROM calendar WHERE month = ? AND year = ?");
	$sql-> execute(array($month, $year));
	//on va faire un tableau contenant 31 CASES dans chacunes desquelles il y aura soit none soit le content du jour associé si il y en a un.
	
	$tableauretour = array();
	$i = 0;
	while($i < 31){// on met des none partout dans le tableaux pour l'initialiser.
	  array_push($tableauretour, "none");
	  $i++;
	}

	while($donnees = $sql->fetch()){
		
		$tableauretour[$donnees['day']-1] = [$donnees['class'], $donnees['content']];
	}

	
	$sql -> CloseCursor();
	return $tableauretour;
}

// dans le cas ou l'user a rentré un content pour un jour (l'appel sera ajaxé)
if(isset($_POST['req']) and $_POST['req'] == "updatecal" and isset($_POST['content']) and isset($_POST['year']) and isset($_POST['month']) and isset($_POST['day'])){
	echo'ae';
	$bdd = db_connexion();
	// pas encore sécurisé, overide possible du content des jours
	$sql = $bdd->prepare("INSERT INTO calendar(day, month, year, hour, content, class) VALUES (?,?,?,?,?, ?)");
	$sql -> execute(array(htmlspecialchars($_POST['day']),htmlspecialchars($_POST['month']),htmlspecialchars($_POST['year']),htmlspecialchars($_POST['hour']),htmlspecialchars($_POST['content']), 'lol'));
	$sql -> CloseCursor();
	
}
				  
?>