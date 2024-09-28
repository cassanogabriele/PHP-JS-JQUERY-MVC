<?php
// Classes qui permet de gérer les sujets soumis par les utilisateurs.
class Subject
{
	// Déclaration des attributs dont on a besoin qui correspondent aux champs de la table "subjects".
	private $id;
	private $pseudo;
	private $title_subject;
	private $subject;
	private $id_user;
	private $date;	
	
	// Fonction qui affiche les sujets
	public function display_subjects(){
		include("./modele/connectdb.php");	
	
		// On définit les informations de localisation.
		setlocale(LC_TIME, 'fr_FR.utf8','fra');
		
		// Système de pagination automatique.
		
		// On affiche 5 sujet par page.
		$limit = 5;
		
		// Si aucune page n'est choisie, alors la page par défaut est la première.
		if(isset($_GET['page'])) {
			// Page de départ.
			$page = $_GET['page'] - 1;
			// On calcule le nombre de nombre de commentaires à afficher en fonction du nombre 
			$offset = $page * $limit;
		} else {
			// La page actuelle est 0.
			$page = 0; 
			$offset = 0;
		}

		// On calcul le nombre total de messagees 
		$count_msg = $bdd->query("SELECT COUNT(*) AS nb_msg FROM subjects");
		$nb_msg = $count_msg->fetch();
		// On récupère la totalité des messages. 
		$total_records = $nb_msg[0];
				
		// Si le nombre total des messages est supérieur au nombre de message définit par page.
		if ($total_records > $limit) {
			// On compte le nombre de pages.
			$number_of_pages = ceil($total_records / $limit);
		} else {
			// La page 
			$pages = 1;
			$number_of_pages = 1;
		}		
		
		// On récupère les informations des commentaires et on en affiche 5 par page.
		$request = $bdd->prepare('SELECT DISTINCT
											a.id_user,
											a.pseudo,
											a.avatar,
											b.pseudo,
											b.id_user,
											b.title_subject,
											b.subject,
											DATE_FORMAT(b.date, \'%d/%m/%Y \') AS Date											
									FROM 
										users as a,
										subjects as b									   
									WHERE 
										a.id_user = b.id_user
									AND
										a.pseudo = b.pseudo
									ORDER BY
										Date ASC
									LIMIT '.$offset.', '.$limit.'
									');
										
		$request->execute();
			
		// On affiche en boucle les commentaires.
		while($fetch = $request->fetch()){
			echo '<div class="panel panel-default" >';
			echo '<div class="row"> 
					<div class="panel-heading">										
						<div class="col s12 m4 l2">
							<p>
								<a href="'.$fetch['avatar'].'" data-lity>
									<img class="img-circle" id="img-subjects" src="'.$fetch['avatar'].'" alt="avatar">
									<a href="index.php?uc=profil_user&id='.$fetch['id_user'].'">'.$fetch['pseudo'].'</a>													
								</a>
							</p>
						</div>
										
						<div class="col s12 m4 l8">
							<p>
								<a href="index.php?uc=subject_user&title_subject='.$fetch['title_subject'].'"><h5 id="title-subject-home" class="center-align" >'.$fetch['title_subject'].'</h5></a>
							</p>
						</div>
										
						<div class="col s12 m4 l2">
							<h5 id="date-display-home">'.$fetch['Date'].'</h5>
						</div>
					</div>
				  </div>
				
					<hr id="hr-stylised">';					
			echo '</div>';	
		}
		
		// On affiche la pagination
		echo "<div id='pagination'>
				<ul class='d-flex justify-content-center page'>";		
		echo "<li class='page-item'><a style='float: left;' class='page-link' aria-label='Previous' href='http://musicmaniac.gabriel-cassano.be/index.php?uc=allsubjects'><span aria-hidden='true'>&laquo;</span><span class='sr-only'></span></a></li>";
		
		for ($i=1; $i<=$number_of_pages; $i++) {
			echo "<li class='page-item' ><a class='page active' href='http://musicmaniac.gabriel-cassano.be/index.php?uc=allsubjects&page=$i'>".$i."</a></li>";
		}   
		
		echo "<li class='page-item' id='page-link'><a class='page page-link' href='http://musicmaniac.gabriel-cassano.be/index.php?uc=allsubjects&page=$number_of_pages'><span aria-hidden='true'>&raquo;</span><span class='sr-only'></span></a> ";
		
		echo "</ul></div>";
	}
		
	// Fonction qui permet d'afficher le sujet de l'utilisateur.
	public function display_subject_user(){
		include("./modele/connectdb.php");	
		// L'id courant : celui du commentaire sélectionné par l'internaute.
		$CurrentMessageId="";	
		// On modifie les informations de localisation pour les mettre en français 
		setlocale(LC_TIME, 'fr_FR.utf8','fra');
		// On récupère le sujet choisit par l'internaute.
		// $subject = @$_GET['title_subject'];		
		$subject = $_GET['title_subject'];		
		// On récupère dans la table le sujet choisit par l'internaute.
		$request = $bdd->query("SELECT * FROM subjects WHERE title_subject ='$subject'")or die(mysql_error());
				
		// On fécupère en boucle les sujets.
		while($fetch = $request->fetch()){
			$date = date_create($fetch['date']);			
			echo '<div class="panel panel-default">							  
					<div class="panel-heading">
						<p><h5 id="title-subject-home" class="center-align">'.$fetch['title_subject'].'</h5><span id="date-display-subject">'.date_format($date, 'd-m-Y').'</span></p>								  
					</div>
					
					<div class="panel-body">
						<p>'.$fetch['subject'].'</p>						
					</div>							 
				  </div>';
			// On définit l'id courant du message comme étant celui récupèré de la base de données.
			$CurrentMessageId = $fetch['id'];	
			// On stocke cet id courant dans une variable de session.
			$_SESSION['message_id'] = $CurrentMessageId;	
		}
	}	
}
?>
		