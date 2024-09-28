<?php
// Script de déconnexion du site.

// On détruit toutes les variables de session.
session_unset();
// On détruit la session 
session_destroy();
// On redirige l'utilisateur vers la page d'accueil.
echo '<script language="Javascript">
		<!--	
		setTimeout("Redirect()",00);
		function Redirect()
		{
			 location.href = "http://admin.icyber-corp.gabriel-cassano.be/";
		}
		// -->
	 </script>';
?>
								
