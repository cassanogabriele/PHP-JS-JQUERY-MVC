<?php
// Protection en PHP du formulaire en plus du plugin jQuery "validationEngine" utilisé.

// Messages d'erreur lorsque l'internaute n'entre pas les informations correctes dans le formulaire d'inscription.

// Si l'utilisateur n'entre rien dans le champ de formulaire pour le pseudo et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['pseudo']) && empty($_POST['pseudo']))	{
	 echo '<p class="errors">Vous devez indiquer un pseudo</p>';					
}
		
// Si l'utilisateur entre un pseudo qui ne respecte pas les règles établies pour la définition du mot de passe et qu'il clique sur le bouton pour envoyer le formulaire.		
if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
	if(!preg_match("/^(.){4,}$/",$_POST['pseudo']))	{ 
		 echo '<p class="errors">Le pseudo doit comporter minimum 4 caract&eacute;res</p>';						  
	} else if(!preg_match("/[a-z][0-9]|[a-z][0-9]/",$_POST['pseudo'])) {   
		echo '<p class="errors">Le pseudo doit comporter des lettres et des chiffres</p>'; 
	}
}

// Si l'utilisateur n'entre rien dans le champ de formulaire pour le mot de passe et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['password']) && empty($_POST['password']))	{
	echo ('<p class="errors">Vous devez indiquer un mot de passe</p>');					 
}

// Si l'utilisateur entre un mot de passe qui ne respecte pas les règles établies pour la définition du mot de passe et qu'il clique sur le bouton pour envoyer le formulaire.	
if (isset($_POST['password']) && !empty($_POST['password'])) {						
	if(!preg_match("/^(.){6,}$/",sha1($_POST['password'])))	{ 
		echo '<p class="errors">Le mot de passe doit comporter min 6 caractères</span>';  
	} else if(!preg_match("/[a-z][0-9]|[a-z][0-9]/",sha1($_POST['password']))) {   
		echo '<p class="errors">Le mot de passe doit comporter des lettres et des chiffres</p>';   
	}
}	

// Si l'utilisateur n'entre rien dans le champ de formulaire pour le nom et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['nom']) && empty($_POST['nom'])){
	echo '<p class="errors">Vous devez indiquer votre nom</p>';
}

// Si l'utilisateur n'entre rien dans le champ de formulaire pour l'email et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['email']) && empty($_POST['email'])) {
	 echo ('<p class="errors">Votre indiquer un email</p>');					 
}

// Si l'utilisateur entre autre chose qu'un email dans le champ email du formulaire et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['email']) && !empty($_POST['email']))	{
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))	{  
		echo '<p class="errors">Votre adresse email est invalide!</p>';
	}
}

// Si l'utilisateur ne choisit pas un nombre pour l'âge et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['age']) && empty($_POST['age'])){
	echo '<p class="errors">Vous devez indiquer votre âge</p>';
}

// Si l'utilisateur n'entre rien dans le champs de formulaire pour les styles et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['style']) && empty($_POST['style'])){
	echo '<p class="errors">Vous devez indiquer vos styles de musique</p>';
}

// Si l'utilisateur n'entre rien dans le champs de formulaire pour les intérêts et qu'il clique sur le bouton pour envoyer le formulaire.
if (isset($_POST['interests']) && empty($_POST['interests'])){
	echo '<p class="errors">Vous devez indiquer vos passions</p>';
}

// Script utilisé pour valider le formulaire si les champs sont correctement remplit.
if(isset($_FILES['avatar'])){ 
	// On définit le dossier dans lequel l'avatar de l'utilisateur sera stockée.
	$dossier = 'upload/';
	// On définit un nom complet pour l'avatar (les informations sur les fichiers envoyés sont contenues dans le tableau global $_FILES°.
	$fichier = basename($_FILES['avatar']['name']);	
	
	// Si cette fonction renvoie true, c'est que cela à fonctionné
	if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier.$fichier)) {
		  echo '<p class="alert alert-info msg">Votre image a été téléchargée avec succès !</p>';
	 } else { 
		  // Sinon, on affiche un message pour avertir l'utilisateur que cela n'a pas fonctionné.
		  echo '<p class="alert alert-danger msg">Echec du téléchargement de votre image !</p>';
	}
	
	// On récupère les informations du formulaire avec la méthode POST, si rien n'est envoyé, les variables sont définies à "NULL"
	$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;			
	$password = isset($_POST['password']) ? $_POST['password'] : NULL;			
	$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;			
	$email = isset($_POST['email']) ? $_POST['email'] : NULL;			
	$age = isset($_POST['age']) ? $_POST['age'] : NULL;			
	$style = isset($_POST['style']) ? $_POST['style'] : NULL;			
	$interests = isset($_POST['interests']) ? $_POST['interests'] : NULL;

	// On prépare la requête pour l'enregistrement des données de formulaire dans la base de données.
	$req = $bdd->prepare('INSERT INTO users(pseudo, mdp, nom, email, avatar, date_inscription, age, styles_de_musique, interets) VALUES(:pseudo, :mdp, :nom, :email, :photo, NOW(), :age, :styles, :interest)')or die('Erreur SQL !'.mysql_error());
	// On met les informations reçues dans un tableau.
	$req->execute(array(
		'pseudo' => $pseudo,
		'mdp' => sha1($password),
		'nom' => $nom,
		'email' => $email,
		'photo' => $dossier.$fichier,
		'age' => $age,
		'styles' => $style,
		'interest' => $interests				
	));
	
	// On redirige l'utilisateur vers la page d'accueil à l'aide d'un script JavaScript.
	echo '<script language="Javascript">
			<!--	
			setTimeout("Redirect()",20);
			function Redirect()
			{
			  location.href = "http://musicmaniac.gabriel-cassano.be";
			}
			// -->
			</script>';
}
?>