$('td.calendar-day').click(function(){
	$('#calendaraddevent').modal();
	$('form#formcalendar').attr('day', $(this).attr('day'));
	$('form#formcalendar').attr('month', $(this).attr('month'));
	$('form#formcalendar').attr("year", $(this).attr('year'));
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


