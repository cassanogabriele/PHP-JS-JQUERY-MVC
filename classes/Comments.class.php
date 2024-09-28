<?php
// Classe qui permet de gérer les commentaires.

// Message courant : celui sur lequel un internaute veut laisser un commentaire.
$_SESSION['message_id'] = $CurrentMessageId;

class Comments
{
	// Déclaration des attributs dont on a besoin correspondant aux champs dans la table des commentaires.
	private $id;
	private $subject_id;
	private $nom;
	private $commentaire;
	private $visible;
	
	// Affichage des commentaires
	public function display_comment(){
		include("./modele/connectdb.php");
		// On récupère les commentaires concernant le sujet sur lequel l'utilisateur à cliqué.
		$resultat = "SELECT * FROM comments WHERE subjectId ='".$_SESSION['message_id']."'";     
		$resultat = $bdd->query($resultat);
		$mess_erreur = $resultat->rowCount();
		
		// S'il y a pas de commentaires présents, on affiche un message à l'utilisateur, sinon on affiche les commentaires 
		// concernant le sujet.
		if($mess_erreur == 0) {
			echo'<p id="error-comment">Il n\'y a pas de commentaires pour ce sujet</p>';	
		} else{
			while($rows = $resultat->fetch()){					
				echo '<div class="panel panel-danger">							  
						<div class="panel-heading">
							<p><h5 id="title-subject-home" class="center-align" >'.$rows['nom'].'</h5></p>								  
						</div>
							
						<div class="panel-body">
							<p>'.$rows['commentaire'].'</p>
						 </div>							 
					</div>';
			}
		}			
	}
	
	// Fonction qui insère les commentaires dans la base de données.
	public function insert_comment(){
		include("./modele/connectdb.php");		
		
		// Si le formulaire a été soumis.
		if($_REQUEST["form-submit"] != 0){
			$pseudo= isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;	
			$comment = isset($_POST['message']) ? $_POST['message'] : NULL;
			
			// On récupère les filtres dans la base de données qui servent à empêcher l'utilisateur d'écrire des insultes 
			// dans son commentaire.
			$liste_filtres = $bdd->query("SELECT * FROM filtres WHERE mot LIKE '%".$comment."%' ");	
			$nb_resultats = $liste_filtres->rowCount();	
			
			// Si dans le commentaire soumis, il y a une insulte, on avertit l'utilisateur.
			if($nb_resultats > 0){
				echo "<div class='alert alert-danger center-align confirm-comment' role='alert'>
					  <strong>Votre commentaire ne doit pas contenir d'insultes</strong>
					 </div>";
			} else{
				// On vérifie si le commentaire existe déjà.
				$comment = $bdd->query('SELECT EXISTS(SELECT * FROM comments WHERE subjectId="'.$_SESSION['message_id'].'" ) AS comment_exists');
				$resultat = $comment->fetch();
				
				// Si il existe, on avertit l'utlisateur qu'on ne l'enregistre pas, sinon il est enregistré en base de données 
				// et on affiche un message à l'utilisateur.
				if ($resultat['comment_exists'] == true) { 
					echo "ne pas enregistrer";
				} else { 
					$query ="INSERT INTO comments(id,subjectId,nom,commentaire) VALUES('0','".$_SESSION['message_id']."','".$pseudo."','".$comment."')";	
					$req = $bdd->query($query);
					echo "<div class='alert alert-success center-align confirm-comment' role='alert'>
						 <strong>Votre commentaire ne contient pas d'insultes et a été envoyé !</strong>
					  </div>";
				}
			}	
		}			
	}
}
?>
		