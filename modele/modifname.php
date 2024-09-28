<?php
// Si l'utilisateur n'entre pas le nouveau nom dans le champs de formulaire qui lui permet de modifier son nom, on lui affiche un message d'erreur.
if (isset($_POST['newname']) && empty($_POST['newname'])){
	echo '<p class="errors">Vous devez entrer votre nom et prénom !</p>';
}

// On a un deuxième champ qui demande de confirmer le nom.
if (isset($_POST['newname_confirm']) && empty($_POST['newname_confirm'])){
	echo '<p class="errors">Vous devez entrer à nouveau votre nom et prénom !</p>';
}

// Si les deux champs pour le nom sont remplis.
if(isset($_POST['newname']) && isset($_POST['newname_confirm'])){
	// Si l'utilisateur n'entre pas le même nom dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newname'] != $_POST['newname_confirm']){
		echo '<p id="samepass">Les intérêts sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouveau nom entré par l'utilisateur concerné.
		$reset_name = $bdd->query('UPDATE users SET nom="'.$_POST['newname'].'" WHERE pseudo="'.$pseudo.'"');
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

