<?php
// Si l'utilisateur n'entre pas le nouveau style dans le champs de formulaire qui lui permet de modifier son nom, on lui affiche un message d'erreur.
if (isset($_POST['newstyles']) && empty($_POST['newstyles'])){
	echo '<p class="errors">Vous devez entrer les nouveaux styles !</p>';
}

// On a un deuxième champ qui demande de confirmer le style.
if (isset($_POST['newstyles_confirm']) && empty($_POST['newstyles_confirm'])){
	echo '<p class="errors">Vous devez entrer à nouveau les nouveaux styles !</p>';
}

// Si les deux champs pour le nom sont remplis.
if(isset($_POST['newstyles']) && isset($_POST['newstyles_confirm'])){
	// Si l'utilisateur n'entre pas le même style dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newstyles'] != $_POST['newstyles_confirm']){
		echo '<p id="samepass">Les styles sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouveau style entré par l'utilisateur concerné.
		$reset_style = $bdd->query('UPDATE users SET styles_de_musique="'.$_POST['newstyles'].'" WHERE pseudo="'.$pseudo.'"');
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

