
<?php
include('src/moduleCalendar/functioncalendar.php');

?>


<div class="panel-body">

<div class="modal fade" id="calendaraddevent"  role="dialog" aria-labelledby="profileModal" aria-hidden="true" >
	
		<div class="col-md-6 col-md-offset-3 inscriptionBloc" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>        
			
		<form id="formcalendar" class="form-horizontal" day="" month="" year="" method = "POST" action = "" enctype="multipart/form-data">
		
		<div class = "champBoxLogin" style="display:block; overflow:auto;" >
			<span class="pull-left col-xs-12"  >
				<textarea name="content" class="form-control"  id="comment" style="display:block;"></textarea>
				<br />
		<button type="submit" class="col-xs-4 col-xs-offset-4 btn-lg colorPrimary buttonPrimary calendarchangebutton" style="padding-top:10px;" name = "envoi"><span>✓</span>UPDATE</button>
		 
			</span>
		
		</div>
			  
		</form>
			
		
	</div>
	
</div>

	<?php
	
	/* draws a calendar */
	function draw_calendar($month,$year){
		$infomois = recup_month($month, $year);
		/* draw table */
		$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

		/* table headings */
		$headings = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday', 'Sunday');
		$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

		/* days and weeks vars now ... */
		$running_day = date('w',mktime(0,0,0,$month,1,$year)); //récupére avec w le jour de la semaine, ici le premier du mois
		//problème : le dimanche vaut 0 et le samedi 6, on veut finir sur le dimanche
		
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();

		/* row for week one */
		$calendar.= '<tr class="calendar-row">';

		/* print "blank" days until the first of the current week */
		for($x = 1; $x < $running_day; $x++): //on commence à lundi ( x = 1)
			$calendar.= '<td class="calendar-day-np"> </td>';
			if ($x == 6):
				$x = -1; // avec l'incrementation ça nous permettra de arriver à dimanche. (x = 0)
			endif;
			$days_in_this_week++;
		endfor;

		/* keep going with days.... */
		for($list_day = 1; $list_day <= $days_in_month; $list_day++):
			$calendar.= '<td day="'.$list_day.'" month="'.$month.'" year="'.$year.'" class="calendar-day">';
				/* add in the day number */
				
				$calendar.= '<div class="day-number">'.$list_day.'.  </div>';
				
				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				
				if ($infomois[$list_day-1] == "none" or $infomois[$list_day-1][1] == ""){// on a pas de contenu
					$calendar.='<div class="dayempty">';
					$calendar.='<span class="glyphicon glyphicon-plus openmodifmodal" aria-hidden="true"></span>';
					$calendar.='</div>';
					
				}else{
					$calendar.='<span class="'.$infomois[$list_day-1][0].'">'.$infomois[$list_day-1][1].'</span>';
					$calendar.='<div class="iconcalendar">';
					$calendar.='<span class="glyphicon glyphicon-pencil openmodifmodal" aria-hidden="true"></span>';
					$calendar.='<span class="glyphicon glyphicon-remove deleteday" aria-hidden="true"></span>';
					$calendar.='</div>';
				}
			
				
			$calendar.= '</td>';
			if($days_in_this_week== 7): // si on est dimanche on fini la week
				$calendar.= '</tr>';
				if(($day_counter+1) != $days_in_month){ // si on a pas fini on recommence
					$calendar.= '<tr class="calendar-row">';
					$days_in_this_week = 0;// vaudra 1 en fin de boucle 
				}else{
					$days_in_this_week = 6; // dans le cas ou dimanche est le dernier jour, on veut qu'a  la fin de la boucle, days in this week vale 7
				}
				
				$running_day = 1;
			endif;
			$days_in_this_week++; 
			if($running_day==6):
				$running_day = -1; // avec le ++ deviendra 0 : on passera de samedi à dimanche
			endif;
			$running_day++; 
			
			$day_counter++;
		endfor;
		/* finish the rest of the days in the week */
		if($days_in_this_week < 7):
			for($x = 1; $x <= (8 - $days_in_this_week); $x++):
				$calendar.= '<td class="calendar-day-np"> </td>';
			endfor;
		endif;

		/* final row */
		$calendar.= '</tr>';

		/* end the table */
		$calendar.= '</table>';
		
		/* all done, return result */
		return $calendar;
	}

	/* sample usages */
	echo draw_calendar(7,2017);

	?>
</div>
