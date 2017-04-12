<?php
	session_start();
	include('../config.php');
?>
	
               <?php
                  $bdd = db_connexion();
                  $sql = $bdd -> prepare("SELECT * FROM messages WHERE discuss = ? ORDER BY id ");
                  $sql -> execute(array($_POST['discuss']));
                  $sql2 = $bdd -> prepare("SELECT * FROM discuss WHERE id = ?");
                  $sql2 -> execute(array($_POST['discuss']));
                  $infodiscuss = $sql2->fetch();
                  $sql2->CloseCursor();
                  
                  if ($infodiscuss['user1'] == $_SESSION['id']){
                  	$otheruser = $infodiscuss['user2'];
                  }else{
                  	$otheruser = $infodiscuss['user1'];
                  }
                  $sql2 = $bdd->prepare("SELECT * FROM users WHERE id = ?");
                  $sql2->execute(array($otheruser));
                  $otheruserdonnees = $sql2->fetch();
                  $sql2->CloseCursor();
                  $count = 0;
                  $i = 0;
				  $liste=[];
				 
                  while($donnees = $sql->fetch()){

                  	if ( $donnees['id_from'] == $_SESSION['id']){

                  	?>
               <li class="left clearfix">
                  <span class="chat-img1 pull-right">
                  <img src="<?php echo htmlspecialchars($_SESSION['profilePicture'])?>" alt="User Avatar" class="img-circle">
                  </span>
                  <div class="sentmessage clearfix pull-right">
                     <p>	<?php echo htmlspecialchars($donnees['content']); ?></p>
                     <div class="chat_time pull-left hidden"  ><?php echo htmlspecialchars($donnees['time']);?></div>
                  </div>
               </li>
               <?php
                  }else{
                ?>
               <li class="left clearfix">
                  <span class="chat-img1 pull-left">
                  <img src="<?php echo $otheruserdonnees['profilepicture']?>" alt="User Avatar" class="img-circle">
                  </span>
                  <div class="receivedmessage clearfix pull-left">
                     <p><?php echo htmlspecialchars($donnees['content']); ?></p>
                     <div class="chat_time pull-right hidden"><?php echo htmlspecialchars($donnees['time']);?></div>
                  </div>
               </li>
               <?php
                  }
                  
                  $count +=1;
			
				  $i +=1;
				  
                  }
				  
                  if ($count == 0){
                  echo ' <br><br><br><p style="text-align:center; color:#7f8c8d">Il n\'y a pas encore de messages.</p>';
                  }
                  $sql->CloseCursor();
                  ?>
               </li>
        

