<?php
// Si l'utilisateur n'entre pas la nouveau mot de passe dans le champs de formulaire qui lui permet de modifier son email, on lui affiche un message d'erreur.
if (isset($_POST['newpass']) && empty($_POST['newpass'])){
	echo '<p class="errors">Vous devez entrer le mot de passe !</p>';
}

// On a un deuxième champ qui demande de confirmer le mot de passe.
if (isset($_POST['title_subject']) && empty($_POST['title_subject'])){
	echo '<p class="errors">Vous devez entrer un sujet !</p>';
}

// Si les deux champs pour l'email sont remplis.
if(isset($_POST['newpass']) && isset($_POST['newpass_confirm'])){
	// Si l'utilisateur n'entre pas le même mot de passe dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newpass'] != $_POST['newpass_confirm']){
		echo '<p id="samepass">Les deux mots de passe sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouveau mot de passe entré par l'utilisateur concerné.
		$reset_password = $bdd->query('UPDATE users SET mdp="'.sha1($_POST['newpass']).'" WHERE pseudo="'.$pseudo.'"');
		// On redirige l'utilisateur vers sa page de profil à l'aide d'un script JavaScript.
		echo '<script language="Javascript">
				<!--	
				setTimeout("Redirect()",20);
				function Redirect()
				{
					location.href = "http://musicmaniac.gabriel-cassano.be/index.php?uc=reconnexion";
				}
				// -->
				 </script>';
	}								
}	
?>

