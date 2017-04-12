
		<div class="profile-sidebar" style="margin-right:0px;">
		
			<div class="headerSidebar">
			 <div class="headerProfileBackground">
				<!-- Pour avoir fond blurred : <img src="<?php //echo $_SESSION['profilePicture']?>" class="profileBackground" /> -->
			</div> 
			
			
			
			
			<div class = "contentHeaderSidebar">
			<div class="profile-userpic">
				<img src="<?php echo htmlspecialchars($_SESSION['profilePicture']);?>" class="img-responsive" alt=""></img>
				<span class="status statusoffline monstatus" iduser="<?php echo $_SESSION['id'];?>" status = "offline" style=" height:30px; width : 30px; position:absolute; margin-top: -30px;margin-left:20px;"></span>
				
			</div>
			<!-- END SIDEBAR USERPIC -->
			<!-- SIDEBAR USER TITLE -->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo htmlspecialchars($_SESSION['username'])?>
				</div>
				<div class="profile-usertitle-job">
					<?php echo htmlspecialchars($_SESSION['email'])?>
				</div>
			</div>
				<!-- END SIDEBAR USER TITLE -->
			<!-- SIDEBAR BUTTONS -->
			
			</div>
			
			</div>
		
		
			<!-- END SIDEBAR BUTTONS -->
			<!-- SIDEBAR MENU -->
			<div class="profile-usermenu">
				<ul class="nav">
					<li class="active">
						<a href="#">
						<i class="glyphicon glyphicon-home"></i>
						Home </a>
					</li>
					<li>
						<a href="" data-toggle="modal" data-target="#profilemodif">
						<i class="glyphicon glyphicon-user" ></i>
						Account Settings </a>
					
											
					</li>
					<li>
						<a href="#" target="_blank">
						<i class="glyphicon glyphicon-ok"></i>
						Tasks </a>
					</li>
					<li>
						<a href="#">
						<i class="glyphicon glyphicon-flag"></i>
						Help </a>
					</li>
					<li>
						<a type="button" class="btn btn-danger btn-sm" style="color:#fff;" href="<?php echo $path_to_index; ?>index.php?p=logout">Log out</a>
					</li>
				</ul>
			</div>
			<!-- END MENU -->
		</div>
<br>