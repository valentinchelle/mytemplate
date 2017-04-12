$('.openmodifmodal').click(function(){
	var parentinfo = $(this).closest('.calendar-day'); //on remonte pour avoir les infos du jour.

	$('#calendaraddevent').modal();
	//on change les attributs :
	$('form#formcalendar').attr('day', parentinfo.attr('day'));
	$('form#formcalendar').attr('month', parentinfo.attr('month'));
	$('form#formcalendar').attr("year", parentinfo.attr('year'));
	//on change le titre :
	
	$('h4.modal-title').html(parentinfo.attr('day') + '/' + parentinfo.attr('month') + '/' + parentinfo.attr('year'));
	// on change le contenu du form en utilisant celui qu'il y a dans le span de l'enfant.
	var content = parentinfo.children('span').text();
	
	$('#formcalendar textarea').text(content).html();
});

$('.deleteday').click(function(){
	var $this = $(this).closest('.calendar-day'); // on remonte pour avoir les infos du mois.

	$.ajax({
			url: '',
			type: 'POST',
			data: "req=deletecal&day=" + $this.attr("day") + "&month=" + $this.attr("month") + "&year=" + $this.attr("year") + "&hour=0" ,
			success: function(json) {
				
					 

				
			}
		});
	
	
	
});

	
$('form#formcalendar').on('submit', function(e){
	
	e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
	var $this = $(this);
	var btn = $(this).find("input[type=submit]:focus" );
	$.ajax({
			url: $this.attr('action'),
			type: $this.attr('method'),
			data:  $this.serialize() + "&req=updatecal&day=" + $this.attr("day") + "&month=" + $this.attr("month") + "&year=" + $this.attr("year") + "&hour=0" ,
			success: function(json) {
				$('.calendarchangebutton').css('color','#fff');
				(function loop(i) {          
				   setTimeout(function () {   

						$value = 100 - 2*i+25;
						$('.calendarchangebutton').css('background', 'linear-gradient(90deg, var(--main-color) ' + $value+'%, #fff '+$value+'%)');
					  if (--i) loop(i); // iteration counter en DESC
				   }, 1) // delay
				})(50); // iterations count, 
				$('#calendaraddevent').modal('toggle');
				$('.calendarchangebutton').css('background', 'linear-gradient(90deg, var(--main-color) 25%, #fff 25%)'); // on reset
					 

				
			}
		});
	
	
	
	
	
	
});


