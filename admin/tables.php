		
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div><!--/.row-->
				
		<br>
		<div class="row">
			<div class="col-lg-12">
							
			<div class="panel panel-info">
				<div class="panel-heading">Users</div>
				<div class="panel-body">
				<table class="table table-striped table-bordered"> 
					<thead> 
						<tr> 
							 
							<th>Id</th> 
							<th>Email</th> 
							<th>Username</th> 
							<th>Role</th> 
							<th>Actions</th>
						</tr>
					</thead> 
					<tbody> 
						<?php

				// Si tout va bien, on peut continuer
				$bdd = db_connexion();
				// On récupère tout le contenu de la table jeux_video
				$req = $bdd->query('SELECT * FROM users');

				// On affiche chaque entrée une à une
				while ($donnees = $req->fetch())
				{
				?>
					<tr> 
						
							<td><?php echo $donnees['id']; ?></td> 
							<td><?php echo $donnees['email']; ?></td> 
							<td><?php echo $donnees['username']; ?></td> 
							<td><?php if($donnees['role'] == 0){
									echo 'client';
							}else if ($donnees['role'] == 1){
								echo 'modérateur';
							}else if ($donnees['role'] == 2){
								echo 'modérateur';
							}else if ($donnees['role'] == 3){
								echo 'super modérateur';
							}else if ($donnees['role'] == 4){
								echo 'administrateur';
							}else if ($donnees['role'] == 5){
								echo 'fondateur';
							}
											
											
											
											
											?></td> 
							<td><a>Modifier</a></td>
						</tr> 
					
				 
				<?php
				}

				$req->closeCursor(); // Termine le traitement de la requête

			?>
						
						
					</tbody> 
				</table> 
				
				</div>
				
			</div>
			</div>
		</div><!--/.row-->	
		
