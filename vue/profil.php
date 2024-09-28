<!-- Page qui affiche le profil de l'utilisateur. -->
<?php
// On enregistre le pseudo dans une variable session.
$pseudo = $_SESSION['pseudo'];
?>

<div class="jumbotron new-jumb">
	<div class="panel panel-primary" id="user-avatar">
		<div class="panel-heading">
			<p class="align">
			<?php
			// On récupère le bon utilisateur dans la base de données en fonction du pseudo transmis dans la variable de session.
			$request = $bdd->query('SELECT * from users WHERE pseudo="'.$pseudo.'"');
			// On récupère le résultat de la requêtes
			$fetch = $request->fetch();
			// On affiche le nom et le pseudo de l'utilisateur dans la partie de gauche de la page.
			echo '<p class="align">';
			echo $fetch['nom'];
			$current_pseudo = $fetch['pseudo']; 
			$id = $fetch['id_user'];	
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
		<!-- Dans la partie de droite de la page, on affiche les informations de l'utilisateur récupérée dans la table "users". -->
		<div class="panel-heading">
			<p class="align pseudo" id="pseudo">Informations</p>
		</div>
				
		<div class="container" id="content-infos">			  
		  <ul class="nav nav-pills" id="menu-user">
			<li class="infos-links"><a data-toggle="pill" class="infos" href="#infos">Informations</a></li>					
				<li class="infos-links">
					<a data-toggle="pill" href="#photos" class="infos">
					Photos
					&nbsp;<span class="badge">
							
					<?php
					// Script qui permet à l'utilisateur d'enregistrer d'autres images sur son profil.
					if(isset($_FILES['avatar'])){ 
						$dossier = 'upload/';
						$fichier = basename($_FILES['avatar']['name']);
						$file1 = $dossier.$fichier;
							
						// Si l'image existe déjà, on en informe l'utilisateur.
						if (file_exists($file1)) {
							//echo "Le fichier $filename existe.";								
						} else {
							if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)){
								// Sinon, on insert les informations de l'image téléchargée par l'utilisateur.
								$req = $bdd->prepare('INSERT INTO photos(pseudo, photos, id_user) VALUES(:pseudo, :photos, :id_user)')or die('Erreur SQL !'.mysql_error());
								// On exécute la requête et on stocke les informations envoyés à la base de données dans un tableau.
								// déclarées pour la requêt
								$req->execute(array(
									// Le pseudo courant (donc celui de l'utilisateur courant).
									'pseudo' => $current_pseudo,
									// Le nom de la photo. 
									'photos' => $dossier.$fichier,
									// L'identifiant de l'utilisateur
									'id_user' => $id
								));
								
									// On ferme le curseur lorsque la requête est terminée
									$req->closeCursor();		
							} else {
								// Sinon, si l'image n'a pas été chargée, on affiche un message d'erreur à l'utilisateur.
								// echo 'Echec de l\'upload !';
							}							
						}	//fin else file_exists	
					}		
					?>	
						
					<?php
					// On compte le nombre de photos de l'utilisateur et on affiche le nombre de photos qu'il a enregistré sur son profil et on l'affiche.
					$pictures = $bdd->query('SELECT COUNT(photos) AS nb_photos from photos WHERE pseudo="'.$_SESSION['pseudo'].'"')or die(mysql_error());
					$fetch_pictures = $pictures->fetch();
						
					$nb_photos = $fetch_pictures['nb_photos'];						
					echo $nb_photos;						
					?>
					</span>
					</a>
				</li>
					
				<li class="infos-links">
					<a data-toggle="pill" href="#posts" class="infos">
					Sujets
					&nbsp;<span class="badge">
							
					<?php
					// On compte le nombre de sujet que l'utilisateur à soumis et on l'afiche
					$nb_posts = $bdd->query('SELECT COUNT(subject) AS nb_subjects from subjects WHERE pseudo="'.$_SESSION['pseudo'].'"')or die(mysql_error());
					$fetch_nb_post = $nb_posts->fetch();
					echo $fetch_nb_post['nb_subjects'];					
					?>
					</span>
					</a>
				</li>
					
				<li class="infos-links"><a data-toggle="pill" href="#subjects" class="infos">Ajouter un sujet</a></li>					
			 </ul>
  
			<div class="tab-content">
				<div id="infos" class="tab-pane fade in active" style="margin-top:50px;">
					<div class="row">
						<div class="col s12 m6">
							<div id="card-content">
								<div class="card-content white-text">
									<?php 
									echo '<p><i class="tiny material-icons white-text darken-6">check</i> Pseudo : '.$fetch['pseudo'].'';
									?>
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal"><i class="material-icons">create</i></a>&nbsp; Modifier	
									
										<!-- Modification du pseudo dans une fenêtre modale. -->
										<div id="myModal" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification du pseudo</h4>
													</div>
													
													 <div class="modal-body mb">
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=modifpseudo">							
															<p class="align pseudo" id="">Modifier le pseudo</p>
															
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newpseudo" name="newpseudo">
																<label for="pseudo"><span class="forms-label">Entrez votre nouveau pseudo</span></label>
															</div>
															
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newpseudo_confirm" id="newpseudo_confirm">
																<label for="sujet"><span class="forms-label">Confimer le nouveau pseudo</span></label>
															</div>
														
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
														</form>	
													  </div>
													  
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													  </div>
													</div>
												</div>						
										</div>
									</p>										
										
									<?php
									echo '<p><i class="tiny material-icons white-text darken-4">check</i> Nom : '.$fetch['nom'].'';
									?>
										
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal9"><i class="material-icons">create</i></a>&nbsp; Modifier	
										
										<!-- Modification du nom dans une fenêtre modale. -->
										<div id="myModal9" class="modal fade" role="dialog">
										  <div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification du nom</h4>
													</div>
													
													 <div class="modal-body mb">													
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=modifname">							
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newname" name="newname">
																<?php
																
																?>
																<label for="pseudo"><span class="forms-label">Entrez votre nom et prénom</span></label>
															</div>
															
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newname_confirm" id="newnames_confirm">
																<?php
																
																?>					
																<label for="sujet"><span class="forms-label">Confimer le nom et le prénom</span></label>
															</div>
														
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
														</form>	
													  </div>
													  
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													  </div>
												</div>
											</div>						
										</div>
									</p>
										
									<?php
									echo '<p><i class="tiny material-icons white-text darken-4">check</i> Email : '.$fetch['email'].'';
									?>
										
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal3"><i class="material-icons">create</i></a>&nbsp; Modifier	
										
										<!-- Modification de l'email dans une fenêtre modale. -->
										<div id="myModal3" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification de l'email</h4>
													</div>
													
													 <div class="modal-body mb">
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=modifemail">
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newemail" name="newemail">
																<label for="pseudo"><span class="forms-label">Entrez votre nouvel email</span></label>
															</div>
															
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newemail_confirm" id="newemail_confirm">
																<label for="sujet"><span class="forms-label">Confimer le nouvel email</span></label>
															</div>
														
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
														</form>	
													  </div>
													  
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													  </div>
													</div>
											</div>						
										 </div>
									</p>		
										
									<?php
									echo '<p><i class="tiny material-icons white-text darken-4">check</i> Age : '.$fetch['age'].'';
									?>
										
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal4"><i class="material-icons">create</i></a>&nbsp; Modifier	
										
										<!-- Modification de l'âge dans une fenêtre modale. -->
										<div id="myModal4" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification de l'âge</h4>
													</div>
												
													<div class="modal-body mb">
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=modifage">							
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newage" name="newage">															
																<label for="pseudo"><span class="forms-label">Entrez votre âge</span></label>
															</div>
														
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newage_confirm" id="newage_confirm">																			
																<label for="sujet"><span class="forms-label">Confimer l'âge</span></label>
															</div>
														
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
														</form>	
													</div>
												  
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													</div>
												</div>
											</div>						
										</div>
									</p>		
										
									<?php
									echo '<p><i class="tiny material-icons white-text darken-4">check</i> Styles de musique : '.$fetch['styles_de_musique'].'';
									?>
										
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal5"><i class="material-icons">create</i></a>&nbsp; Modifier	
										
										<!-- Modification des styles dans une fenêtre modale. -->
										<div id="myModal5" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification des styles</h4>
													</div>
												
													<div class="modal-body mb">
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=style">							
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newstyles" name="newstyles">															
																<label for="pseudo"><span class="forms-label">Entrez les nouveaux styles</span></label>
															</div>
														
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newstyles_confirm" id="newstyles_confirm">																				
																<label for="sujet"><span class="forms-label">Confimer les styles</span></label>
															</div>
													
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>
														</form>	
													</div>
												  
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													  </div>
												</div>
											</div>						
										</div>
									</p>
										
									<?php										
									echo '<p><i class="tiny material-icons white-text darken-4">check</i> Intérêts : '.$fetch['interets'].'';									
									?>
										
									&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal7"><i class="material-icons">create</i></a>&nbsp; Modifier	
										
										<!-- Modification des intérêts dans une fenêtre modale. -->
										<div id="myModal7" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification des intérêts</h4>
													</div>
												
													<div class="modal-body mb">													
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=interets">							
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newinterests" name="newinterests">															
																<label for="pseudo"><span class="forms-label">Entrez les nouveaux intérêts</span></label>
															</div>
														
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newinterests_confirm" id="newinterests_confirm">																				
																<label for="sujet"><span class="forms-label">Confimer les intérêts</span></label>
															</div>
													
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
														</form>	
													</div>
												  
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													</div>
												</div>
											</div>						
									  </div>
									</p>
										
									<p id="resetpassword">&nbsp;<a class="btn-floating red accent-1 mater-buttons" data-toggle="modal" data-target="#myModal2"><i class="material-icons">create</i></a>&nbsp; Modification du mot de passe</p>
										
										<!-- Modification du mot de passe dans une fenêtre modale. -->
										<div id="myModal2" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Modification le mot de passe</h4>
													</div>
												
													<div class="modal-body mb">
														<form class="col s12 form2" id="validate_form" method="post" action="index.php?uc=gestionBlog&action=modifpass">
															<div class="input-field col s12">
																<input class="validate[required]" type="text" id="newpass" name="newpass">															
																<label for="pseudo"><span class="forms-label">Entrez votre nouveau mot de passe</span></label>
															</div>
														
															<div class="input-field col s12">
																<input class="validate[required]" type="text" name="newpass_confirm" id="newpass_confirm">																			
																<label for="sujet"><span class="forms-label">Confimer le nouveau mot de passe</span></label>
															</div>
													
															<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>
														</form>	
													</div>
												  
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
													</div>
												</div>
											</div>						
										 </div>
									</p>
								</div>           
							</div>
						</div>
					</div>
				</div>	
					
				<div id="photos" class="tab-pane fade">		
					<form method="POST" id="upload-form" action="http://musicmaniac.gabriel-cassano.be/index.php?uc=profil#photos" enctype="multipart/form-data" style="background-color: black !important;">								
						<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
							<span class="input-group-btn"><span class=" btn btn-default btn-file">Parcourir <input type="file" name="avatar"></span>
							<div class="input-group" id="btn-send-img"><span class="input-group-btn"><span class=" btn btn-default btn-file" id="btn-style"><button class="btn btn-warning" id="button-send" type="submit" name="valider" value="Uploader">Envoyer</button></span></span></div>	
					</form>							
	  		
					<table id="table-pictures">						
					<?php
					// On récupère les photos de l'utilisateur en base de données et on les affiche
					$pictures_to_display = $bdd->query('SELECT * FROM photos WHERE pseudo="'.$pseudo.'"');							
					// On définit un compteur à "0".
					$count = 0;

					while($fetch_pictures_to_display = $pictures_to_display->fetch()){
						// On incrémente le compteur.
						$count++;
								
						echo '<td>';
						echo '<a class="thumbnail" href="'.$fetch_pictures_to_display['photos'].'" data-lity >
								<img class="materialboxed responsive-img" id="pictures-users" src="'.$fetch_pictures_to_display['photos'].'" alt="pictures from membre">
   							  </a>';	
						echo '</td>';
								
						// On affiche les images par rangée de 3 images.
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
				// On récupère l'identifiant de l'utilisateur dans la table "users"
				$id_user = $bdd->query('SELECT id_user FROM users WHERE pseudo="'.$_POST['pseudo'].'"')or die(mysql_error());
				$fetch_id_user = $id_user->fetch();								
				$id = $fetch_id_user['id_user'];
								
				// On enregistre le pseudo, le titre du sujet et le sujet, respectivement dans une variable session
				$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
				$title_subject = isset($_POST['title_subject']) ? $_POST['title_subject'] : NULL;
				$subject = isset($_POST['subject']) ? $_POST['subject'] : NULL;								
								
				// On récupère le pseudo de l'utilisateur du sujet dans la table "subjects" .
				$subject_user = $bdd->query('SELECT * FROM subjects WHERE pseudo="'.$_POST['pseudo'].'" ORDER BY id DESC LIMIT 0, 1') ;	
				$line_fetch = $subject_user->fetch();
				$pseudo_subject = line_fetch['pseudo'];
				$subject_title = $line_fetch['title_subject'];
							
				// Si le pseudo du sujet de la table "subjects" est le même que celui du sujet et que le titre du sujet de la table "subjects" est le même que celui 
				// du sujet
				if($pseudo_subject == $pseudo && $subject_title == $title_subject)
				{ 
					// On ne fais rien.
				} else{
					// Sinon, on ajoute le sujet							
					$req = $bdd->prepare('INSERT INTO subjects(pseudo, title_subject, subject, id_user, date) VALUES(:pseudo, :title_subject, :subject, '.$id.', NOW())')or die('Erreur SQL !'.mysql_error());
					// On exécute la requête 
					$req->execute(array(
						'pseudo' => $pseudo,
						'title_subject' => $title_subject,
						'subject' => $subject					
					));
				}								
				?>
						
				<?php						
				// On modifie les informations de localisation et on les définit au français.
				setlocale(LC_TIME, 'fr_FR.utf8','fra');	
						
				// On récupère les informations des sujets dans la base de données.
				$posts = $bdd->query('SELECT title_subject, subject, date FROM subjects WHERE pseudo="'.$_SESSION['pseudo'].'"')or die(mysql_error());							
											
				while($fetch = $posts->fetch()){
					// On formate la date pour l'affichage.
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

					<!-- Formulaire qui permet à un autre utilisateur de laisse un commentaire sur un sujet d'un utilisateur. -->
					<div id="subjects" class="tab-pane fade">
						<!-- On vérifie si les informations entrées dans les champs du formulaire sont correctes, sinon on affiche un message d'erreur à l'utlisateur. -->
						<form class="col s12 form" id="validate_form" method="post" action="#">							
							<div class="input-field col s12">
								<input class="validate[required]" type="text" name="pseudo">
								<?php
								if (isset($_POST['pseudo']) && empty($_POST['pseudo'])){
									echo '<p class="errors">Vous devez entrer votre pseudo !</p>';
								}
								?>
								<label for="pseudo"><span class="forms-label">Entrez votre pseudo</span></label>
							</div>
								
							<div class="input-field col s12">
								<input class="validate[required]" type="text" name="title_subject" id="title_subject">
								<?php
								if (isset($_POST['title_subject']) && empty($_POST['title_subject'])){
									echo '<p class="errors">Vous devez entrer un sujet !</p>';
								}
								?>					
								<label for="sujet"><span class="forms-label">Entrez un titre de sujet</span></label>
							</div>
								
							<div class="input-field col s12">
								<textarea class="validate[required] materialize-textarea" rows="4" cols="50" name="subject" id="subject"></textarea> 				
								<label for="textarea1"><span class="forms-label">Entrez votre sujet</label>
							</div>
								
							<button class="btn btn-larg btn-warning pull-right btn-form-home">Envoyer</button>	
						</form>	
				</div>						
			</div>
		</div>					
	</div>
</div>
		 
			 
