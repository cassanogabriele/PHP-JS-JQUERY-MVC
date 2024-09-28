<?php
// Si l'utilisateur n'entre pas un nouvel intérêt dans le champ de formulaire pour l'ajout des intérêts, on lui affiche un message d'erreur.
if (isset($_POST['newinterests']) && empty($_POST['newinterests'])){
	echo '<p class="errors">Vous devez entrer les nouveaux intérêts !</p>';
}

// On demande donc à l'utilisateur de confirmer ce nouvel intérêt.
if (isset($_POST['newinterests_confirm']) && empty($_POST['newinterests_confirm'])){
	echo '<p class="errors">Vous devez entrer à nouveau les nouveaux intérêts !</p>';
}

// Si l'utilisateur à bien remplit les deux champs pour enregistrer un nouvel intérêt.
if(isset($_POST['newinterests']) && isset($_POST['newinterests_confirm'])){
	// Si l'utilisateur n'entre pas le même intérêt dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newinterests'] != $_POST['newinterests_confirm']){		
		echo '<p id="samepass">Les intérêts sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouvel intérêt entré par l'utilisateur concerné.
		$reset_email = $bdd->query('UPDATE users SET interets="'.$_POST['newinterests'].'" WHERE pseudo="'.$pseudo.'"');
		// On redirige l'utilisateur vers sa page de profil à l'aide d'un script JavaScript.
		echo '<script language="Javascript">
				<!--	
				setTimeout("Redirect()",20);
				function Redirect()
				{
					location.href = "http://musicmaniac.gabriel-cassano.be/index.php?uc=profil";
				}
				// -->
			</script>';
		}								
}	
?>

