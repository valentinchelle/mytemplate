	<div class="row ">
		<div class="col-md-2 col-md-offset-5 inscriptionBloc" >
		<h1 style="text-align:center"></h1>
		
		
		<form class="form-horizontal" method = "POST" action = "" >
		
		<div class = "champBoxLogin">
		<h4> Panel Administrateur</h4><br />
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
				
				if ($password == $user['password'] && ($user['role'] == 5)){
					
					echo '<span class="alert alert-success col-sm-12" style = "text-align:center">Login Successful. Welcome <b>'.htmlspecialchars($user['username']).'</b>.</span>';
					echo'<br> <br><br> <p style="text-align:center; color:#fff;">Redirection en cours...</p>';
					$_SESSION['connecte'] = true;
					$_SESSION['id'] = $user['id'];
					$_SESSION['username'] = $user['username'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['profilePicture'] = $user['profilepicture'];
					$_SESSION['role'] = $user['role'];
					header('refresh:1; url= index.php');      
					
				}
				else{
					echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >Erreur.</span><br><br><br>';
				}
			
				//Clotûre de la connexion à la base de données.
				
			$req->closeCursor();
			 
			}
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
			
	</div>
	</div>