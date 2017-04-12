 <div class="panel panel-default" style="border-radius : 0px;">
	<?php
		//On récupère les données de l'utilisateur si il existe.
		$bdd = db_connexion();
		
		$id = 15;
		
		
		$req= $bdd->prepare('SELECT * FROM users WHERE id = ?');
		$req -> execute(array($id));
		$user = $req -> fetch();
		if($user['username'] != ""){
			
			$profile_username = htmlspecialchars($user['username']);
			$profile_email = htmlspecialchars($user['email']);
			$profile_picture = htmlspecialchars($user['profilepicture']);
			
			echo $profile_username;
		}
		
		
		else{
			
			echo ' ID invalide.';
		}
		
	
	$req-CloseCursor();
	
	?>	

</div>


