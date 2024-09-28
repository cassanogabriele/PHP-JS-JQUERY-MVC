<?php
// Si l'utilisateur n'entre pas la nouveau pseudo dans le champs de formulaire qui lui permet de modifier son email, on lui affiche un message d'erreur.
if (isset($_POST['newpseudo']) && empty($_POST['newpseudo'])){
	echo '<p class="errors">Vous devez entrer votre pseudo !</p>';
}

// On a un deuxième champ qui demande de confirmer le pseudo.
if (isset($_POST['newpseudo_confirm']) && empty($_POST['newpseudo_confirm'])){
	echo '<p class="errors">Vous devez entrer un sujet !</p>';
}

// Si les deux champs pour le pseudo sont remplis.
if(isset($_POST['newpseudo']) && isset($_POST['newpseudo_confirm'])){
	// Si l'utilisateur n'entre pas le même pseudo dans les deux champs, on lui affiche un message d'erreur.
	if($_POST['newpseudo'] != $_POST['newpseudo_confirm']){
		echo '<p id="samepass">Les deux pseudos sont différents</p>';
	} else{
		// Sinon, on met à jour la table "users" en enregistrant le nouveau pseudo entré par l'utilisateur concerné.
		$reset_password = $bdd->query('UPDATE users SET pseudo="'.$_POST['newpseudo'].'" WHERE pseudo="'.$pseudo.'"');		 																
		session_destroy();
		// On affiche un message pour avr
		echo '<p id="succeschpass">Le pseudo a été modifié</p>';
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

