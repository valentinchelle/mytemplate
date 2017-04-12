
<div class="chat_container" id="discuss">
   <div class="col-sm-3 chat_sidebar">
      <div class="row">
         <div id="custom-search-input">
            <div class="input-group col-md-12">
               <input type="text" class="  search-query form-control" placeholder="Conversation" />
               <span class=" glyphicon glyphicon-search"></span>
            </div>
         </div>
         <div class="dropdown all_conversation">
            <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-weixin" aria-hidden="true"></i>
            All Conversations
            <span class="caret pull-right"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
               <li>
                  <a href="#"> All Conversation </a>  
                  <ul class="sub_menu_ list-unstyled">
                     <li><a href="#"> All Conversation </a> </li>
                     <li><a href="#">Another action</a></li>
                     <li><a href="#">Something else here</a></li>
                     <li><a href="#">Separated link</a></li>
                  </ul>
               </li>
               <li><a href="#">Another action</a></li>
               <li><a href="#">Something else here</a></li>
               <li><a href="#">Separated link</a></li>
            </ul>
         </div>
         <tbody style = "display:block;">
            <div class="member_list">
               <ul class="list-unstyled">
                  <?php
                     $bdd = db_connexion();
                     $requser = $bdd->prepare("SELECT * FROM discuss WHERE user1 = ? OR user2 = ?");
                     $requser->execute(array(htmlentities($_SESSION['id']),htmlentities($_SESSION['id'])));
                     while($donnees = $requser->fetch()){
                     
                     	if($donnees['user1'] == $_SESSION['id']){
                     		$dest = $donnees['user2'];
                     	}else{
                     		$dest = $donnees['user1'];
                     	}
                     	$reqdestinfo = $bdd->prepare("SELECT * FROM users WHERE id = ?");
                     	$reqdestinfo -> execute(array($dest));
                     	$destinfo = $reqdestinfo -> fetch();
                     	$reqdestinfo -> CloseCursor();
                     
                     	$nbrmessreq = $bdd-> prepare("SELECT COUNT(*) as count FROM messages WHERE seen = 0 and discuss = ? and id_to = ?");
                     	$nbrmessreq -> execute(array($donnees['id'], $_SESSION['id']));
                     	$nrbmess = $nbrmessreq -> fetch();
                     
                     ?>
                  <li class="left clearfix" >
                     <a href="index.php?<?php echo'p=discuss&discuss='.$donnees['id'];?>">
                        <span class="chat-img pull-left">
                        <img src="<?php echo $destinfo['profilepicture'];?>" alt="User Avatar" class="img-circle">
                        </span>
                        <div class="status statusoffline" iduser="<?php echo $destinfo['id']?>" style=" height:10px; width : 10px; margin-top : 23px; margin-left : 23px; ">
                        </div>
                        <div class="chat-body clearfix">
                           <div class="header_sec">
                              <strong class="primary-font"><?php echo htmlentities($destinfo['username']);?></strong> <strong class="pull-right">09:45AM</strong>
                           </div>
                           <div class="contact_sec">
                              <strong class="primary-font">(123) 123-456</strong> <span class="badge pull-right"><?php echo $nrbmess['count']; ?></span>
                           </div>
                        </div>
                     </a>
                  </li>
                  <?php
                     $nbrmessreq -> CloseCursor();
                     }
                     $requser->CloseCursor();
                     ?>
               </ul>
            </div>
         </tbody>
      </div>
   </div>
   <!--chat_sidebar-->
   <div class="col-sm-9 message_section">
      <tbody style = "display:block;" >
       
			<ul id="chat_area" class="list-unstyled chat_area">
		
		</ul>
      
         <!--chat_area-->
      </tbody>
		<form id ="formsendmessage" class="form-horizontal" method = "POST" action = "src/moduleMessagerie/sendmessages.php" enctype="multipart/form-data">
         <div class="message_write">
            <div class="col-md-11 pull-left">
               <textarea class="form-control " name="inputMessage" placeholder="type a message" style="height: 15vh;"></textarea>
            </div>
            <input type="hidden" name="id_discuss" value="<?php echo $_GET['discuss']; ?>">
            <button type="submit" name="envoi" class="pull-right btn btn-success col-md-1 pull-right" style="height:15vh;">Send</button>
            <div class="clearfix"></div>
            <div class="chat_bottom">
            </div>
         </div>
		   </div>
		   <!--message_section-->
		</div>
		</form>
<?php
   $sql = $bdd -> prepare("UPDATE messages SET seen = 1 WHERE discuss = ? and id_to = ?");
   $sql -> execute(array($_GET['discuss'],$_SESSION['id']));
   $sql->CloseCursor();
   ?>

