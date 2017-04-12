	<div class="row ">
		<div class="col-md-4 col-md-offset-4 inscriptionBloc" >
		
		
		<form class="form-horizontal" method = "POST" action = "" enctype="multipart/form-data">
		
		<div class = "champBoxLogin">
		<h2 style="text-align:center">Sign Up</h2><br>
		<?php
			if (isset($_POST['envoi']) and  isset($_POST['inputEmail']) and isset($_POST['inputPassword']) and isset($_POST['inputUsername']) )
			{
				
				// Connexion à la base de données
				$bdd = db_connexion();
				$email = htmlspecialchars($_POST['inputEmail']);
				$username = htmlspecialchars($_POST['inputUsername']);
				$password = sha1($_POST['inputPassword']);
				// d'abord on vérifie qu'il n'y a pas de doublon
				$reqverif= $bdd->prepare('SELECT * FROM users WHERE email = ?');
				$reqverif -> execute(array($email));
				$verif = $reqverif -> fetch();
				$reqverif->closeCursor();
				if ($verif['id'] == ""){
					//if ok we look at the picture
					
					
						if (isset($_FILES['profilePicture']) AND $_FILES['profilePicture']['error'] == 0)
						{
								// Testons si le fichier n'est pas trop gros
								if ($_FILES['profilePicture']['size'] <= 4000000)
								{
						 
										// Testons si l'extension est autorisée
										$infosfichier = pathinfo($_FILES['profilePicture']['name']);
										$extension_upload = $infosfichier['extension'];
										$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
										if (in_array($extension_upload, $extensions_autorisees))
										{
											
												// On peut valider le fichier et le stocker définitivement
												move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'img/uploadsPP' . basename($_FILES['profilePicture']['name']));
												$chemin_pdp= $path_to_index.'img/uploadsPP' . basename(($_FILES['profilePicture']['name']));
												
											
						 
					
												
										}else{
												echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >The extension of the picture is wrong. <b>Try again</b>.</span><br><br><br>';
								
											}
										
								}else{
												echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >The size of the picture is wrong. <b>Try again</b>.</span><br><br><br>';
				
									}
						}else{
							$chemin_pdp = $path_to_index.'img/uploadsPP/default.png';
							
							}
							
						$req= $bdd->prepare('INSERT INTO users(email, username, password,profilepicture) VALUES (?,?,?,?)');							
						$req -> execute(array($email, $username, $password, $chemin_pdp));	
						$req->closeCursor();	
						echo '<span class="alert alert-success col-sm-12" style = "text-align:center">Thank you for your registration. <a href="'.$path_to_index.'">>LOG IN <</a></span>';
												
								
				}else{
					echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >This email already exists. <b>Try again</b>.</span><br><br><br>';
				
				}
			
				
			}
			?>
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required="" >
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" required="" >
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="password" class="form-control" id="inputPassword" name = "inputPassword" placeholder="Password" required="" >
			</div>
		  </div>
		  
			<br>
			
			<label class="btn btn-primary addPdp" for="inputFile">
				<input id="inputFile" type="file" style="display:none;" name="profilePicture"  >
						<p>
						<span class=" glyphicon glyphicon-plus " style="">   </span>  Import a profile picture</p>
					
					
			</label>
				
			<br>
		
		
		</div>
			  <button type="submit" class="col-sm-12   btn-lg colorPrimary buttonPrimary" name = "envoi">Sign Up</button>
		 
		</form>
			
		<p style="text-align:center"><br />	<br /><br />Already a member ? <a href="<?php echo $path_to_index; ?>index.php?p=login" class="linkSecondary">Sign in now</a></p>
	
	</div>
	</div>