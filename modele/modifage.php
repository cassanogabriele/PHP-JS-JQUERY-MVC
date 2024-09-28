<?php
// Si l'utilisateur n'entre pas la nouvel valeur pour l'âge (si par exemple, il s'est trompé ou veut mettre à jour plus tard son âge), on lui affiche un message d'erreur.
if (isset($_POST['newage']) && empty($_POST['newage'])){
	// On lui affiche un message d'erreur.
	echo '<p class="errors">Vous devez entrer votre age !</p>';
}

// On a un deuxième champ qui permet de confimer le nouvel âge.
if (isset($_POST['newage_confirm']) && empty($_POST['newage_confirm'])){
	echo '<p class="errors">Vous devez entrer à nouveau votre âge !</p>';
}

// Si les deux champs pour l'âge sont remplis.
if(isset($_POST['newage']) && isset($_POST['newage_confirm'])){
	// Si l'utilisateur n'entre pas le même âge dans les deux champs de formulaire.
	if($_POST['newage'] != $_POST['newage_confirm']){
		// On lui affiche un message d'erreur (on utilise la même classe CSS pour le formatage HTML).
		echo '<p id="samepass">Les deux âges sont différents</p>';
	} else{
		// Sinon, on met à jour l'âge dans la table "users" pour l'utilisateur concerné.
		$reset_age = $bdd->query('UPDATE users SET age="'.$_POST['newage'].'" WHERE pseudo="'.$pseudo.'"');
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

