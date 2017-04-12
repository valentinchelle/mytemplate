<?php

session_start(); // On démarre la session AVANT toute chose

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Template</title>

    <!-- Bootstrap -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/perso.css" rel="stylesheet">
	<link href="dist/css/calendar.css" rel="stylesheet">
	<?php include('src/config.php');	?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
					
  <?php
	
	
	if ((isset($_GET['p']) and $_GET['p'] == 'login' ) and (!isset($_SESSION['connecte']) or $_SESSION['connecte'] != true )) {
		include('src/moduleMembre/login.php');
	}else if ((isset($_GET['p']) and $_GET['p'] == 'signup' ) and (!isset($_SESSION['connecte']) or $_SESSION['connecte'] != true )) { //signup
		include('src/moduleMembre/signup.php');
	}else if((isset($_GET['p']) and $_GET['p'] == 'logout') ) {
		
		$_SESSION['connecte'] = false;
		include('src/moduleMembre/login.php');
	}else if(isset($_SESSION['connecte']) and $_SESSION['connecte'] == true ){
		$bdd = db_connexion();
		$req= $bdd->prepare('UPDATE users SET last_activity = ? WHERE id = ?');
		//$date = new DateTime(date('m-d-Y h:i:s', time()));
		$date = '12:00';
		//$req -> execute(array(date_format($date, 'Y-m-d H:i:s'), $_SESSION['id']));
		$req->CloseCursor();
		
	
		
		//$interval =  $time1->diff($date);
	
		//echo $interval->format("%H hours %i minutes %s seconds");
		include('src/moduleMembre/memberHome.php');
		
	
		
	}else{
		include('src/moduleMembre/login.php');
}
?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
	<!-- for modal window-->
	
	
	<script src="src/moduleMembre/profiledit.js"></script>
	<script src="src/moduleMessagerie/messages.js"></script>
	<script src ="src/moduleOnline/get-online.js" ></Script>
	<script> 
	
	getOnlineUsers();
	getMessages(function(){
		
	});
	
	var reloadTimeUsers = 20000;
	
	window.setInterval(getMessages, reloadTimeUsers);
	window.setInterval(getOnlineUsers, reloadTimeUsers);
	
	
	</script>
	<script src="js/perso.js"></script>
	<script src="js/messagerietri.js"></script>
	<script type="text/javascript" src="src/moduleCalendar/calendar.js"></script>
 

  </body>
</html>