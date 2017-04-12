	<div class="row ">
	<?php
	$connexionreussie = false;
	?>
		<div class="col-md-4 col-md-offset-4 inscriptionBloc" >
		<h1 style="text-align:center"></h1>
		
		
		<form class="form-horizontal" method = "POST" action = "" >
		
		<div class = "champBoxLogin">
		
		<h2 style="text-align:center">Sign In</h2><br>
		<?php
			if (isset($_POST['envoi']) and  isset($_POST['inputEmail']) and isset($_POST['inputPassword']))
			{
				
				// Connexion à la base de données
				$bdd = db_connexion();
				$email = $_POST['inputEmail'];
				$password = sha1($_POST['inputPassword']);
				
				$req= $bdd->prepare('SELECT * FROM users WHERE email = ?');
				$req -> execute(array($email));
				$user = $req -> fetch();
				
				if ($password == $user['password']){
					$connexionreussie = true;
					echo '<span class="alert alert-success col-sm-12" style = "text-align:center">Login Successful. Welcome <b>'.htmlspecialchars($user['username']).'</b>.</span>';
					echo'<br> <br><br> <p style="text-align:center; ">Redirection en cours...</p>';
					$_SESSION['connecte'] = true;
					$_SESSION['id'] = $user['id'];
					$_SESSION['username'] = $user['username'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['profilePicture'] = $user['profilepicture'];
					
					$_SESSION['role'] = $user['role'];
					
					header('refresh:1; url= '.$path_to_index);      
					
				}
				else{
					echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >Email or password incorrect. <b>Try again</b>.</span><br><br><br>';
				}
			
				//Clotûre de la connexion à la base de données.
				
			$req->closeCursor();
			 
			}
			if ($connexionreussie == false){
				
			
			?>
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required="" >
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12">
			  <input type="password" class="form-control" id="inputPassword" name = "inputPassword" placeholder="Password" required="" >
			</div>
		  </div>
		 
		</div>
			  <button type="submit" class="col-sm-12   btn-lg colorPrimary buttonPrimary" name = "envoi">Login</button>
		 
		</form>
			
		<p style="text-align:center"><br />	<br /><br />Not a membre yet ? <a href="<?php echo $path_to_index; ?>index.php?p=signup" class="linkSecondary">Sign up now</a></p>
		<?php
			}
		?>
	</div>
	</div>