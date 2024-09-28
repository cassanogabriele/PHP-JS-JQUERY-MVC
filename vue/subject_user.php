<?php 
// On récupère l'id courant (celui cliqué par l'utilisateur lorsqu'il clique sur le sujet choisit).
$_SESSION['message_id'] = $CurrentMessageId;
?>

<div class="container">
	<div style="margin-top:30px;">	
		<div class="panel panel-info">		  
			<div class="panel-body">				
			<?php 	
			// On inclut la classe du sujet pour afficher le sujet.
			include_once('classes/Subject.class.php');	
			// On inclut la classe des commentaires pour afficher les commentaires concernant le sujet.
			include_once('classes/Comments.class.php');	
			// Instanciation de la classe Subject.
			$subject = new Subject;
			// Affichage du sjuet
			$subject->display_subject_user();
			// Instanciation de la classe Comments.
			$comments = new Comments;			
			?>	
			</div>
		</div>
		
		<?php
		// Si l'utilisateur est connecté, on affiche les commentaires concernant le sujet.
		if(isset($_SESSION['pseudo'])){
			$comments-> display_comment();		
		} else{
			// Sinon, on lui affiche un message qui l'invite à s'inscrire sur le site.
			echo "<div class='alert alert-info center-align' role='alert'>Vous devez inscrit et connecté pour voir les commentaires sur le sujet</div>";
		}
		?>
		
			
		<?php
		// Si l'utilisateur est inscrit, on affiche le formulaire qui lui permet de laisser un commentaire sur le sujet.
		if(isset($_SESSION['pseudo'])){					
			echo "<div class='panel panel-info'>	
					<div class='panel panel-default'>	
						<div class='panel-heading'><h5 id='title-subject-home' class='center-align' >Votre commentaire</h5></div>
					</div>
				
					<form id='validate_form' action='' method='post' class='forms' style='height:400px;'>
						<div class='row'>				
							<div class='form-group col-sm-6'>
								<label for='name' class='h4'>pseudo</label>
								<input type='text' class='form-control' id='name' name='pseudo' placeholder='Entrez votre pseudo' required>
							</div>						
						</div>		
					
						<div class='form-group'>
							<label for='message' class='h4'>Commentaire</label>
							<textarea name='message' class='form-control' rows='5' placeholder='Entrez votre commentaire' required></textarea>
							<input type='hidden' name='currentmessageid' value='".$CurrentMessageId."'/>
							<button type='submit' name='form-submit' class='btn btn-warning pull-right' style='margin-top:25px;' value='1'>Envoyer</button>
						</div>	
							
						<div id='msgSubmit' class='h3 text-center hidden'>Commentaire envoyé</div>
					</form>
				</div>";
		} else{
			echo "<div class='alert alert-danger center-align' role='alert'>Vous devez inscrit et connecté pour envoyer un commentaire sur ce sujet.</div>";
		}		
		?>
	</div>
</div>

