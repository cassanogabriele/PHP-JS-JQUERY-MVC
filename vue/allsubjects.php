<link rel="stylesheet" href="css/2grid.css" type="text/css"/>

<div class="section group" id="no-border">
	<div class="col span_1_of_2">
	<?php
	// On inclut la classe "Subject" pour pouvoir afficher de manière formatée, tous les sujets entrés par les utilisateurs inscrits sur le site.
	include_once('classes/Subject.class.php');
	// On instancie la classe "Subject"
	$subject = new Subject;
	
	echo '<div class="panel panel-info" id="no-border" >			
			<div class="panel-body">';			
			// On utilise la fonction de la classe qui permet de récupérer les sujets des utilisateurs pour les afficher.
			$subject->display_subjects();
	echo '</div></div>';
	?>
	</div>
	
	<div class="col span_1_of_2">
	<?php 
	$users = $bdd->query("SELECT * FROM users ORDER BY id_user ASC");	
				
	while($fetch = $users->fetch()){
		echo '	<div class="panel panel-info" id="no-border">				
					<div class="panel-body" >
						<ul class="nav">
							<li id="list-users-profiles" >
								<a href="index.php?uc=profil_user&id='.$fetch['id_user'].'" style="color:#0080FF !important;">
								<img class="img-circle" id="img-subjects" src="'.$fetch['avatar'].'" alt="avatar">
								'.$fetch['pseudo'].'													
								</a>
							</li>
						</ul>
					</div>
				</div>';
	}
	?>
	</div>
</div>

<script>

  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
        
</script>

