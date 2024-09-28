<div class="jumbotron new-jumb">
	<div class="panel panel-primary" id="user-avatar">
		<div class="panel-heading">
			<p class="align">
			<?php
			$id = @$_GET['id'];					
			$request = $bdd->query("SELECT * FROM users WHERE id_user=$id")or die(mysql_error());
			$fetch = $request->fetch();
			echo '<p class="align pseudo">';
			echo $fetch['pseudo'];					
			echo '</p>';
			?>
			</p>					
		</div>
			  
		<div class="panel-body">
		<?php				
		// Dans cette partie de gauche, en-dessous du nom et du pseudo, on affiche l'avatar de l'utilisateur.
		echo'<img class="materialboxed responsive-img user-profile" src="'.$fetch["avatar"].'" alt="member"/>';	   
		?>	
		</div>
	</div>	
</div>

<div class="jumbotron new-jumb">
	<div class="panel panel-info">		  
		<div class="panel-heading">
			<p class="align pseudo" id="pseudo">Informations</p>
		</div>
				
		<div class="container" style="margin-top:40px;">			  
			<ul class="nav nav-pills">
				<li class="infos-links"><a data-toggle="pill" href="#infos" class="infos">Informations</a></li>
					
				<li class="infos-links">
					<a data-toggle="pill" href="#photos" class="infos">
					Photos
					&nbsp;<span class="badge">
					<?php
					include_once('classes/Users.class.php');
				
					$users = new Users;
					$users->number_pictures();
					?>
					</span>
					</a>
				</li>
					
				<li class="infos-links">
					<a data-toggle="pill" href="#posts" class="infos">
					Sujets
					&nbsp;<span class="badge">
					<?php
					$nb_posts = $bdd->query("SELECT COUNT(subject) AS nb_subjects FROM subjects WHERE id_user=$id");
					$fetch_nb_post = $nb_posts->fetch();						
										
					echo $fetch_nb_post['nb_subjects'];					
					?>
					</span>
					</a>
				</li>					
				<li class="infos-links"><a data-toggle="pill" href="#contact" class="infos">Contact</a></li>
			</ul>
  
			<div class="tab-content">
				<div id="infos" class="tab-pane fade in active toptext">
					<div class="row">
						<div class="col s12 m6">
							<div class="card-content">
								<div class="card-content white-text">
								<?php 
								echo '<p><i class="tiny material-icons white-text darken-6">check</i> Pseudo : '.$fetch['pseudo'].'</p>';
								echo '<p><i class="tiny material-icons white-text darken-4">check</i> Nom : '.$fetch['nom'].'</p>';
								echo '<p><i class="tiny material-icons white-text darken-4">check</i> Email : '.$fetch['email'].'</p>';
								echo '<p><i class="tiny material-icons white-text darken-4">check</i> Age : '.$fetch['age'].'</p>';
								echo '<p><i class="tiny material-icons white-text darken-4">check</i> Styles de musique : '.$fetch['styles_de_musique'].'</p>';
								echo '<p><i class="tiny material-icons white-text darken-4">check</i> Intérêts : '.$fetch['interets'].'</p>';									
								?>
							</div>           
						</div>
					</div>
				</div>
			</div>	
					
			<div id="photos" class="tab-pane fade">
				<table id="table-pictures">
				<?php
				$pictures_to_display = $bdd->query("SELECT * FROM photos WHERE id_user=$id")or die(mysql_error());

				$count=0;

				while($fetch_pictures_to_display = $pictures_to_display->fetch()){
					$count++;
					echo '<td>';								
					echo '<a class="thumbnail" href="'.$fetch_pictures_to_display['photos'].'" data-lity >
								<img class="materialboxed responsive-img" id="pictures-users" src="'.$fetch_pictures_to_display['photos'].'" alt="pictures from membre">
   						  </a>';	
					echo '</td>';								
										
					if(($count % 3) == 0 ){
						echo '</tr><tr>';
						} 
				}
								
				if(($count % 3) != 0 ) 	{
					echo '</tr>';
				}			
				?>
				</table>	
			</div>						
						
			<div id="posts" class="tab-pane fade">
			<?php						
			setlocale(LC_TIME, 'fr_FR.utf8','fra');						
			$posts = $bdd->query("SELECT title_subject, subject, date FROM subjects WHERE id_user=$id")or die(mysql_error());
						
			while($fetch = $posts->fetch()){
				$date = date_create($fetch['date']);
					
				echo '<div class="jumbotron">
						<h2 class="panel-title center-align" style="color:#000000;font-size:21px;font-weight:bold;">'.$fetch['title_subject'].'</h2>
						<hr style="border : 0.5px solid #848484;opacity:0.9">
						<h5 class="center-align" style="color:#DF013A;font-weight:bold;">'.date_format($date, 'd-m-Y').'</h5>
						<hr style="border : 0.5px solid #848484;opacity:0.9">
						<p style="color:#000000;">'.$fetch['subject'].'</p>
					</div>';
				}					
				?>	
			</div>
												
			<div id="contact" class="tab-pane fade">							
				<form class="col s12 form" id="validate_form" method="POST" action="">	
					<div class="input-field col s12">
						<input class="validate[required]" type="text" id="name" name="name">
						<?php
						if (isset($_POST['pseudo']) && empty($_POST['name'])){
							echo '<p class="errors">Vous devez entrer votre nom !</p>';
							}
						?>
						<label for="pseudo"><span class="forms-label">Nom et prénom</span></label>
					</div>	

					<div class="input-field col s12">
						<input class="validate[required,custom[email], minSize[4]] text-input]" type="text" id="email" name="email">
						<?php
						if (isset($_POST['pseudo']) && empty($_POST['pseudo'])){
							echo '<p class="errors">Vous devez entrer votre nom !</p>';
						}
						?>
						<label for="pseudo"><span class="forms-label">Email</span></label>
					</div>
								
									
					<div class="input-field col s12">
						<input class="validate[required]" type="text" name="title_subject" id="title_subject">
						<?php
						if (isset($_POST['title_subject']) && empty($_POST['title_subject'])){
							echo '<p class="errors">Vous devez entrer un sujet !</p>';
						}
						?>					
						<label for="sujet"><span class="forms-label">Titre du sujet</span></label>
					</div>
									
					<div class="input-field col s12">
						<textarea class="validate[required] materialize-textarea" rows="4" cols="50" name="subject" id="subject"></textarea> 				
							<label for="textarea1"><span class="forms-label">Sujet</label>
					</div>
								
					<button class="btn btn-larg btn-warning pull-right btn-form-home" >Envoyer</button>
								
					<?php
					if(isset($_POST["subject"]) && $_POST["subject"] != "") {
						$name = $_POST['name']; 
						$title_subject = $_POST['title_subject'];	
						$subject = $_POST['subject'];
						$mail = $_POST['email'];
									
						$destinataire = $fetch['email'];
																									
						$text = "From: <".$mail.">\n";
						$text .='Content-Type: text/html; charset="utf-8"'."\n";
						$text .='Content-Transfer-Encoding: 8bit';
						$text  = "-------------------------------------------\n";
						$text .= "Formulaire de contact\n";
						$text .= "-------------------------------------------\n";
						$text .= "\n";
						$headers = "From: <".$mail.">\n";
						$text .= "Nom        : ".$name." \n";
						$text .= "Titre du sujet        : ".$title_subject." \n";									
						$text .= "Sujet        : ".$subject." \n";
						$text .= "Email        : ".$mail." \n";	
						$text .= "\n";
						$text .= "Message\n";
						$text .= "--------\n";
						$text .= "\n";
						$text .= "$message\n";
						$text .= "\n";
						$text .= "-------------------------------------------\n";
						mail($destinataire, "Contact du site mvc",$text);	
					}
					?>
				</form>							
			</div>
			</div>
		</div>					
	</div>	
</div>

<script>
$(document).ready(function(){
  $('.materialboxed').materialbox();
});     
</script>