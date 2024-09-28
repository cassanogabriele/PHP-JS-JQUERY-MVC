<?php 
// On démarre une nouvelle session.
session_start();
// On sauve le pseudo en session.
$pseudo = $_SESSION['pseudo'];
?>

<?php
// Si l'utilisateur n'entre pas de pseudo, on lui affiche un message d'erreur.
if (isset($_POST['pseudo']) && empty($_POST['pseudo'])){
	echo '<p class="errors">Vous devez entrer votre pseudo !</p>';
}
?>

<?php
// Si l'utilisateur n'entre pas de mot de passe, on lui affiche un message d'erreur.
if (isset($_POST['password']) && empty($_POST['password'])){
	echo ('<p class="errors">Votre mot de passe doit être remplit</p>');
}
			
// Si le mot de passe entré par l'utilisateur n'est pas correct, on lui indique comment définir son mot de passe.			
if (isset($_POST['password']) && !empty($_POST['password'])){									
	if(!preg_match("/^(.){6,}$/",sha1($_POST['password']))) { 
		echo '<p class="errors">Le mot de passe doit comporter min 6 caract&eacute;res</p>'; 
	} else if(!preg_match("/[a-z][0-9]|[a-z][0-9]/",sha1($_POST['password'])) ) {   
		echo '<p class="errors">Le mot de passe doit comporter des lettres et des chiffres</p>'; 							
	}
}	
?>

<?php
// On sauve le pseudo et le mot de passe dans des variables.
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$password = isset($_POST['password']) ? $_POST['password'] : NULL;

// On prépare la requête pour récupérer les informations de l'utilisateur pour la connexion au site.
$req = $bdd->prepare('SELECT * FROM users WHERE pseudo="'.$pseudo.'" AND mdp="'.sha1($password).'"');
// On exécute la requête, on met dans un tableau les informations qu'on doit sélectionner qui doivent correspondre au pseudo et au mot de passe entré par l'utilisateur.
$req->execute(array(
	'pseudo' => $pseudo,
	'password' => $password));
	
// On récupère le résultat de la requête.
$resultat = $req->fetch();	
				
// Si le formulaire à été soumis.		
	
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// Si l'utilisateur n'entre pas le mot de passe ou le pseudo, on lui affiche un message d'erreur.
	if(empty($pseudo) || empty($password)){					
		echo '<p class="alert alert-danger msg">Une erreur s\'est produite durant l\'identification.</p>';		
	} else {
		// Sinon, si le mot de passe entré correspond à celui enregistré dans la table "users", on sauvagerde le pseudo et l'identifiant de l'utilisateur dans des varialbes 
		// de session.
		if($resultat['mdp'] == sha1($password)){			
			$_SESSION['pseudo'] = $resultat['pseudo'];	
			$_SESSION['id_user'] = $resultat['id_user'];
			// On redirige l'utilisateur vers la page d'accueil du site avec un script JavaScript.
			echo '<script language="Javascript">
					<!--	
					setTimeout("Redirect()",00);
					function Redirect()
					{
						location.href = "http://musicmaniac.gabriel-cassano.be";
					}
					// -->
					 </script>';
			} else{
				// Sinon on lui affiche un message d'erreur et on l'invite à recommencer la connexion via la page de connexion et on lui laisse également le choix de revenir 
				// à la page d'accueil.
				echo '<p class="alert alert-danger msg">Le mot de passe ou le pseudo entré n\'est pas correct</p>';
				echo '<p class="center"><a href="http://musicmaniac.gabriel-cassano.be/index.php?uc=connexion">Essayer à nouveau</a></p>';
				echo '<p class="center"><a href="http://musicmaniac.gabriel-cassano.be">Revenir à la page d\'accueil</a></p>';
				echo '<p id="empty"></p>';
			}
		}					
} 
?>