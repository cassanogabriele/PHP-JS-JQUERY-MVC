<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>	
		<meta charset="UTF-8" />
		<meta name="description" content="" charset="UTF-8" />
		<meta name="robots" content="index, follow, all" />
		<meta name="keywords" content="" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<title>Espace membre</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="Cassano Gabriele" />
		
		<link rel="stylesheet" href="css/ValidationEngine.jquery.css" type="text/css"/>	
		<link rel="stylesheet" href="css/form-register.css" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" type="text/css"/>
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
		
		
		<script src="js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.validationEngine-fr.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script> 				
	</head>
	
	<body>
		<?php
		include("connectdb.php");		
		?>		
		
		<h1><img src="images/logo.png" alt="espace membre"></h1>
		
		<a href="deconnexion.php"><button type="button" id="deconnexion" class="btn btn-danger">Déconnexion</button></a>
		
		<div class="wrapper">
			<div id="one">
			<?php
			// On sélectionne tous les utilisateurs.
			$request = $bdd->query("SELECT * FROM users");
			// On récupère le résultat de la requête.
			$fetch = $request->fetch();				
			?>
			<!-- Pour afficher l'image venant directement du serveur
			<img class="members" src="<?php //echo 'uploads/' . basename($_FILES['avatar']['name']); ?>" alt="membre" />
			-->
			<center><img class="members" src="<?php echo $fetch['avatar'] ?>" alt="membre" /></center>		
			
			<?php				
			// On inclut la classe "Membre" pour pouvoir utiliser les fonctions de cette classe.
			include('classes/Membre.class.php');
			// On instancie la classe "Membre".
			$membre = new Membre;	
			// On apelle la fonction "getUsersByEmail" 
			echo $membre:: getUsersByEmail($arg);
			echo "<div class='col-lg-3 col-lg-offset-1' id='upload-img'>";
			echo $membre:: uploadFiles();	
			echo $membre:: comments();
			echo "</div>";
			?>
			</div>			
			
			<div id="two">			
			<?php			
			echo $membre:: displayComments();				
			?>
			</div>
		</div>	
	</body>	
</html>			
