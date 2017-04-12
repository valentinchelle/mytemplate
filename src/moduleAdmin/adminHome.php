<div class="row ">
	


	<?php

	if ($_SESSION['role']>=3){
		

	?>
	<div class="col-md-10 " >

		<ul class="nav nav-tabs nav-justified">
		  <li>Tableau de Bord</li>	
		  <li>Utilisateurs</li>
		  <li>Pharmaciens</li>
		  
		</ul>

	</div>
	<?php
	}else{
		?>
		<div class="alert alert-danger" role="alert">ACCESS DENIED</div>
		
		<?php
	}
		?>
	
</div>