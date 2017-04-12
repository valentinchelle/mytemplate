$(function(){
	
	$('#formsendmessage').on('submit', function(e){
	
		  e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
		var $this = $(this);
		$.ajax({
				url: $this.attr('action'),
				type: $this.attr('method'),
				data: $this.serialize(),
				success: function(json) {
					$('.chat_area').append(json).fadeIn(1000);
					$('.chat_area').animate({scrollTop: $('.chat_area').prop("scrollHeight")},1000);
					$('#formsendmessage').find("input[type=text], textarea").val("");
				}
			});
		
		
		
		
		
		
	});

		
});
function GetURLParameter(sParam) {
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++) 
	{
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == sParam) 
		{
			return sParameterName[1];
		}
	}
}

function getMessages() {
	
	
	
	$.ajax({
						type: "POST",
						url: "src/moduleMessagerie/liremessages.php",
						
						data: "discuss=" + GetURLParameter('discuss'),
						success: function(msg){
							$('.chat_area').html(msg);
							
							$('.chat_area').animate({scrollTop: $('.chat_area').prop("scrollHeight")},0);
						},
						error: function(msg){
							$('.chat_area').html('erreur dans le chargement des messages');
							
						}
						
					});
	        
    
    

	
}