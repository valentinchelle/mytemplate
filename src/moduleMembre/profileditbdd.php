		
			
<?php // conteneur pour les alertes
session_start();
include('../config.php');

if ((isset($_POST['inputEmail']) or isset($_POST['inputPassword1']) or isset($_POST['inputUsername']) or isset($_FILES['profilePicture'])))
{
 
	// Connexion à la base de données
	$bdd = db_connexion();
	//email
	if( isset($_POST['inputEmail']) and $_POST['inputEmail']!= $_SESSION['email']){
		$email = htmlspecialchars($_POST['inputEmail']);
		$reqverif= $bdd->prepare('SELECT * FROM users WHERE email = ?');
		$reqverif -> execute(array($email));
		$verif = $reqverif -> fetch();
		$reqverif->closeCursor();
		if ($verif['id'] == ""){
			//l'adresse mail est dispo
			$req= $bdd->prepare('UPDATE users SET email = ? WHERE id = ?');
			$req->execute(array($email, $_SESSION['id']));
			$req->closeCursor();
		//echo '<span class="alert alert-success-perso col-sm-12" style = "text-align:center">Your email has been changed to <b>'.$email.'</b></span>';
		$_SESSION['email'] = $email;
		}else{
			//echo '<span class="alert alert-error-perso col-sm-12" role="alert" style="text-align:center" >This email already exists. <b>Try again</b>.</span><br><br><br>';
		}
	}
	//username
	if( isset($_POST['inputUsername']) and $_POST['inputUsername']!= $_SESSION['username']){
		$username=htmlspecialchars($_POST['inputUsername']);
		$req= $bdd->prepare('UPDATE users SET username = ? WHERE id = ?');
		$req->execute(array($username, $_SESSION['id']));
		$req->closeCursor();
		
		//echo '<span class="alert alert-success-perso col-sm-12" style = "text-align:center">Your username has been changed to <b>'.$username.'</b></span>';
		$_SESSION['username']= $username;
	}
	//password
	if( isset($_POST['inputPassword1']) and $_POST['inputPassword1']!= ""){
		if (isset($_POST['inputPassword2'])){
			if ($_POST['inputPassword2'] == $_POST['inputPassword1']){
				
				$password = sha1($_POST['inputPassword1']);
				$req= $bdd->prepare('UPDATE users SET password = ? WHERE id = ?');
				$req->execute(array($password, $_SESSION['id']));
				$req->closeCursor();
				//echo '<span class="alert alert-success-perso col-sm-12" style = "text-align:center">Your password has been changed.</span>';
				
			}else{
				
			//echo '<span class="alert alert-error-perso col-sm-12" role="alert" style="text-align:center" >Passwords don\'t match. <b>Try again</b>.</span><br><br><br>';
			}
		}
	}
	//photo de profil
	if (isset($_FILES['profilePicture']) AND $_FILES['profilePicture']['error'] == 0)
			{
					// Testons si le fichier n'est pas trop gros
					if ($_FILES['profilePicture']['size'] <= 10000000) // inférieur à 10Mo
					{
						// Testons si l'extension est autorisée
							$infosfichier = pathinfo($_FILES['profilePicture']['name']);
							$extension_upload = $infosfichier['extension'];
							$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
							if (in_array($extension_upload, $extensions_autorisees))
							{
								
									// On peut valider le fichier et le stocker définitivement
									move_uploaded_file($_FILES['profilePicture']['tmp_name'], '../../img/uploadsPP/' . basename($_FILES['profilePicture']['name']));
									$req= $bdd->prepare('UPDATE users SET profilePicture = ? WHERE id = ?');
									$req -> execute(array($path_to_index.'img/uploadsPP/' . basename(($_FILES['profilePicture']['name'])),$_SESSION['id'] ));	
									$req->closeCursor();
									
									//echo '<span class="alert alert-success-perso col-sm-12" style = "text-align:center">Your profile picture has been updated. </span>';
									$_SESSION['profilePicture'] = $path_to_index.'img/uploadsPP/' . basename(($_FILES['profilePicture']['name']));
		
									
							}else{
								echo '<span class="alert alert-error-perso col-sm-12 " role="alert" style="text-align:center" >2Erreur avec l\'image.  </span><br><br><br>';
					
							}
					}else{
							echo '<span class="alert alert-error-perso col-sm-12" role="alert" style="text-align:center" >Taille maximale pour l\'image dépassée.  '.$_FILES['profilePicture']['size'].'</span><br><br><br>';
					}
					
			}else{
			
			}
			$data = ['username' => $_SESSION['username'], 'pdp' => $_SESSION['profilePicture'], 'email' => $_SESSION['email'], 'message' => 'ok' ];
			echo json_encode($data);

		
		
	
}


?>