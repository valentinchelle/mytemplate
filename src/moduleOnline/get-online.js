function getOnlineUsers() {
	
	// On lance la requête ajax
	$.getJSON('src/moduleOnline/get-online.php', function(data) {
		// Si data['error'] renvoi 0, alors ça veut dire que personne n'est en ligne
		// ce qui n'est pas normal d'ailleurs
		
		if(data['error'] == '0') {		
			var online = '', i = 1, status, text, intstatus;
			// On parcours le tableau inscrit dans
			// la colonne [list] du tableau JSON
			for (var id in data['list']) {
				
				// On met dans la variable text le statut en toute lettre
				// Et dans la variable image le lien de l'image
				if(data["list"][id]["status"] == 'busy') {
					text = 'Occup&eacute;';
					status = 'statusbusy';
					intstatus = 1;
				} else if(data["list"][id]["status"] == 'inactive') {
					text = 'Absent';
					status = 'statusinactive';
					intstatus = 0;
				} else {
					text = 'En ligne';
					status = 'statusactive';
					intstatus = 2;
				}
		
				// On affiche d'abord le lien pour insérer le pseudo dans la zone de texte
				online += '<a href="#post" onclick="insertLogin(\''+data['list'][id]["login"]+'\')" title="'+text+'">';
				
				// Enfin on affiche le pseudo
				online += data['list'][id]["login"]+'</a>';
				$('.status[iduser="'+data["list"][id]["id"]+'"]').removeClass('statusoffline').addClass(status).attr('status',status);
				$('.status.monstatus[iduser="'+data["list"][id]["id"]+'"]').click(function(){
				
					if ($(this).attr('status')=='statusactive'){
						$(this).removeClass($(this).attr('status'))
						status = 'statusbusy';
						intstatus = 1;
						$(this).attr('status',status);
						$(this).addClass(status);
					
					}else{
						$(this).removeClass($(this).attr('status'))
						status = 'statusactive';
						intstatus = 2;
						$(this).attr('status',status);
						$(this).addClass(status);
						
					}
					
									// On lance la requête ajax
					// type: POST > nous envoyons le nouveau statut
					$.ajax({
						type: "POST",
						url: "src/moduleOnline/set-status.php",
						
						data: "status="+intstatus,
						success: function(msg){
							
						},
						error: function(msg){
							// On affiche l'erreur dans la zone de réponse
							
						}
						
					});
				});
				// Si i vaut 1, ça veut dire qu'on a affiché un membre
				// et qu'on doit aller à la ligne			
				if(i == 1) {
					i = 0;	
					online += '<br>';

				}
				i++;		
			}
			$("#users").html(online);
		
			
			
		} else if(data['error'] == '1')
			$("#users").html('<span style="color:gray;">Aucun utilisateur connect&eacute;.</span>');
		//modif de son statut :
		
	});
	
	
}