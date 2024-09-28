<?php
// Si l'utilisateur n'entre pas la nouvel email dans le champs de formulaire qui lui permet de modifier son email, on lui affiche un message d'erreur.
if (isset($_POST['newemail']) && empty($_POST['newemail'])){
	echo '<p class="errors">Vous devez entrer votre nouvel email !</p>';
}

// On a un deuxième champ qui demande de confirmer l'email.
if (isset($_POST['newemail_confirm']) && empty($_POST['newemail_confirm'])){
	echo '<p class="errors">Vous devez entrer à nouveau votre nouvel email !</p>';
}

// Si les deux champs pour l'email sont remplis.
if(isset($_POST['newemail']) && isset($_POST['newemail_confirm'])){
	// Si l'utilisateur n'entre pas le même email dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newemail'] != $_POST['newemail_confirm']){		
		echo '<p id="samepass">Les deux email sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouvel email entré par l'utilisateur concerné.
		$reset_email = $bdd->query('UPDATE users SET email="'.$_POST['newemail'].'" WHERE pseudo="'.$pseudo.'"');
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

