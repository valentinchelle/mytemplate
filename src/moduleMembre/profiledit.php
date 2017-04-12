<div class="col-md-12 ">
	<div class="reponseedit panel-body-alert autoclose">
	
			</div>
		</div>	
	<div class="modal fade" id="profilemodif" tabindex="-1" role="dialog" aria-labelledby="profileModal" aria-hidden="true" >
	
		<div class="col-md-6 col-md-offset-3 inscriptionBloc" >
		
		
		<form id="formprofiledit" class="form-horizontal" method = "POST" action = "src/moduleMembre/profileditbdd.php" enctype="multipart/form-data">
		
		<div class = "champBoxLogin" style="height : 400px;">
		<h2 style="text-align:center">My profile</h2><br>
	
			<label id="image_preview" class="btn btn-sq-primary addPdp pull-right img-responsive importpdp" for="inputFile"  style="height : 180px;width : 50%;background: url(<?php echo $_SESSION['profilePicture']?>) center; ">

				<input id="inputFile" type="file" style="display:none; position: absolute" name="profilePicture" >
						<p>
						<span class=" glyphicon glyphicon-plus btn-lg" style="display: inline-block; vertical-align: middle;margin-top :80px;">   </span> </p>
					
					
			</label>
		<span class="pull-left col-sm-6">
		  <div class="form-group">
			<div class=" col-sm-12 pull-left">
			  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="<?php echo $_SESSION['email']?>" value="<?php echo $_SESSION['email']?>" >
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12 pull-left">
			  <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="aa <?php echo $_SESSION['username']?>" value="<?php echo $_SESSION['username']?>"  >
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-12 pull-left">
			  <input type="password" class="form-control" id="inputPassword" name = "inputPassword1" placeholder="new password" >
			</div>
		</div>
		 <div class="form-group">
			<div class="col-sm-12 pull-left">
			  <input type="password" class="form-control" id="inputPassword" name = "inputPassword2" placeholder="reppeat the new password" >
			</div>
		  </div>
		  </span>
			<br>
			
		
			<br>
		
		</div>
			  <button type="submit" class="col-sm-12   btn-lg colorPrimary buttonPrimary" name = "envoi">Apply the changes</button>
		 
		</form>
			
		
	</div>
	
	</div>