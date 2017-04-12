
<nav class="navbar navbar-default  navbar-fixed-top menuheader ">
  <div class="container-fluid  col-md-10 col-md-offset-2">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $path_to_index; ?>index.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	  <?php 
	  if(isset($_SESSION['connecte']) and $_SESSION['connecte']==true){
		
		  $req = $bdd -> prepare("SELECT count(*) AS count FROM messages WHERE id_to = ? AND seen = ?");
		  $req -> execute(array($_SESSION['id'], 0));
		  $messcount = $req -> fetch();
		  
		?>
        <li class="active"><a href="?p=discuss">Messages (<b><?php echo $messcount['count'];?></b>) <span class="sr-only">(current)</span></a></li>
		
	  <?php
	  }
	  ?>
        <li><a href="?p=cal">Calendar</a></li>
        <li>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">One more separated link</a></li>
			</ul>
        </li>
		
      </ul>
    
      <ul class="nav navbar-nav navbar-right">
       
        <li> <!-- rajouter class="dropdown" pour avoir le dropdown en hover. -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo htmlspecialchars($_SESSION['profilePicture'])?>" class="img-circle pull-left"  style="height:30px; width:30px;margin-top:-5px;margin-right:5px;" alt=""><?php echo '   '.htmlspecialchars($_SESSION['username']);?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a type="button" class="" style="" href="<?php echo $path_to_index; ?>index.php?p=logout">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		

			

 <div class="row profile" style="padding-top : 70px;">

	
	
	
				
				<?php
				if ((isset($_SESSION['connecte']))){
					 if (($_SESSION['connecte'] == true) and isset($_SESSION['username'])  and (isset($_SESSION['profilePicture'] ))){
					
						
				
					   
					   if (!isset($_GET['p'])){
						   ?><div class="col-md-2" style="padding-right:0px;"><?php
							include("widgetmembre.php");
							?></div>
							<div class="col-md-10" ><?php
							include('profiledit.php'); // fenetre modale
							include('src/moduleSearch/search.php');
							?></div><div class="col-md-10" ><?php
							include('src/moduleMessagerie/messagerie.php');
							?></div><?php
					   }else if( $_GET['p'] == 'mess'){
						   ?><div class="col-md-12" ><?php
							include('src/moduleMessagerie/messagerie.php');
							?></div><?php
							
					   }else if( $_GET['p'] == 'cal'){
						   ?><div class="col-md-12" ><?php
							include('src/moduleCalendar/calendar.php');
							?></div><?php
							
					   }else if (($_GET['p'] == 'prof') and isset($_GET['idprof'])){
							include('profile.php');
					   }		   
					   else if ($_GET['p'] and isset($_GET['discuss'])){
						   ?><div class="col-md-12"><?php
							include('src/moduleMessagerie/discuss.php');
							?></div><?php
					   }
					   else{
						   ?><div class="col-md-12" ><?php
							include('src/moduleMessagerie/messagerie.php');
							?></div><?php
					   }
					   ?>
					   
	

	</div>

<?php
	
	}}else{
		$_SESSION['connecte'] = false;
		header('refresh:1; url= '.$path_to_index);      
	}
	
?>
