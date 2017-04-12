
<?php
session_start();
include('../config.php');
   if (isset($_POST['inputMessage'])  and isset($_POST['id_discuss']) and ($_POST['inputMessage']) != ''){
  
   	$bdd=db_connexion();
   	$sql1 = $bdd->prepare("SELECT * FROM discuss WHERE id=?");
   	$sql1->execute(array($_POST['id_discuss']));
   	$discuss_info = $sql1->fetch();
   	$sql1->CloseCursor();
   	$id_discuss = $_POST['id_discuss'];
   	$nouvellediscuss = -1; //id de la nouvelle discuss
   	if ($discuss_info['id'] == ""){
   		//pas  de discuss correspondante
   		//il faudra vérigiersi il n'existe pas une autre disc avec les mêmes users.
   		if(isset($_GET['dest'])){
   			$verif = $bdd->prepare("SELECT * FROM users WHERE id = ?");
   			$verif -> execute(array($_GET['dest']));
   			$result = $verif->fetch();
   			if($result['id'] != ""){
   				echo $_SESSION['id'];
   				$verifdiscexist = $bdd->prepare("SELECT * FROM discuss WHERE user1 = ? and user2 = ? OR user2 = ? and user1 = ?");
   				$verifdiscexist ->execute(array($_GET['dest'], $_SESSION['id'], $_GET['dest'], $_SESSION['id']));
   				$result = $verifdiscexist ->fetch();
   				$verifdiscexist -> CloseCursor();
   
   				if ($result['id'] == ""){
   
   					$req = $bdd->prepare("INSERT INTO discuss(user1,user2) VALUES (?,?)");
   					$req -> execute(array(htmlentities($_GET['dest']), $_SESSION['id']));
   					$req -> CloseCursor();
   					$req = $bdd-> prepare("SELECT * FROM discuss WHERE user1 = ? AND user2 = ?");
   					$req->execute(array(htmlentities($_GET['dest']), $_SESSION['id']));
   					$newreq = $req->fetch();
   					$nouvellediscuss = $newreq['id'];
   					echo $nouvellediscuss;
   					$req->CloseCursor();
   				}else{
   					$nouvellediscuss = $result['id'];
   				}
   
   			}else{
   				//echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >Cette discussion n\'est pas disponible. Pas d\'utilisateur correspondant.</span><br><br><br>';
   
   			}
   			$verif -> CloseCursor();
   		}else{
   			//echo '<span class="alert alert-danger col-sm-12" role="alert" style="text-align:center" >Cette discussion n\'est pas disponible. Pas de destinataire spécifié</span><br><br><br>';
   
   		}
   
   	}
   	if($nouvellediscuss != -1){
   		$sql1 = $bdd->prepare("SELECT * FROM discuss WHERE id=?");
   		$sql1->execute(array($nouvellediscuss));
   		$discuss_info = $sql1->fetch();
   		$sql1->CloseCursor();
   	}
   
   
   	if($discuss_info['user1'] != $_SESSION['id'] and $discuss_info['user2'] != $_SESSION['id']){
   		if($nouvellediscuss == -1){
   			}
   	}else{
   	if ($discuss_info['user1'] == $_SESSION['id']){
   		$destinataire = $discuss_info['user2'];
   	}else{
   		$destinataire = $discuss_info['user1'];
   	}
   
   	$sql2 = $bdd->prepare("INSERT INTO	messages( content,id_from, id_to, discuss) VALUES (?,?,?,?)");
   	$sql2-> execute(array( htmlspecialchars ($_POST['inputMessage']), $_SESSION['id'], $destinataire, $discuss_info['id'] ));
   	$sql2->CloseCursor();
	  ?>
<li class="left clearfix">
	<span class="chat-img1 pull-right">
		<img src="<?php echo htmlspecialchars($_SESSION['profilePicture'])?>" alt="User Avatar" class="img-circle">
	</span>
	<div class="sentmessage clearfix pull-right">
		<p>	<?php echo htmlspecialchars($_POST['inputMessage']); ?></p><br>
	</div>
</li>
		<?php
   		}
 
   
   }
   
   ?>