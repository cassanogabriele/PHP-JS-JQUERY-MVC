<?php
// Page qui permet de se reconnecter, elle est similaire à la page de connexion au site.
$pseudo = $_SESSION['pseudo'];
?>

    <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.validationEngine-fr.js" type="text/javascript" charset="utf-8"></script>
	<script>
	$(document).ready(function(){
	$("#validate_form").validationEngine();
	});
	</script>	
		
	<div class="container">
      <div class="jumbotron" id="form">
			<form id="validate_form" class="forms" method="post" action="http://musicmaniac.gabriel-cassano.be/index.php?uc=connexion">
				<h1 id="title-form">Connexion</h1>
				
				<div class="alert alert-danger" role="alert">
					Vous devez vous connecter avec vos nouveaux identifiants.
				</div>
				
				<div class="input-field col s12">
					<input class="validate[required]" type="text" name="pseudo">
					<?php
					if (isset($_POST['pseudo']) && empty($_POST['pseudo'])){
						echo '<p class="errors">Vous devez entrer votre pseudo !</p>';
					}
					?>
					<label for="pseudo"><span class="forms-label">Entrez votre pseudo</span></label>
				</div>
				
				<div class="input-field col s12">
					<input class="validate[required]" type="password" name="password">
					<?php
					if (isset($_POST['password']) && empty($_POST['password'])){
						echo ('<p class="errors">Votre mot de passe doit être remplit</p>');
					}
					
					if (isset($_POST['password']) && !empty($_POST['password'])){									
						if(!preg_match("/^(.){6,}$/",sha1($_POST['password']))) { 
							echo '<p class="errors">Le mot de passe doit comporter min 6 caract&eacute;res</p>'; 
							
						} else if(!preg_match("/[a-z][0-9]|[a-z][0-9]/",sha1($_POST['password'])) ) {   
							echo '<p class="errors">Le mot de passe doit comporter des lettres et des chiffres</p>'; 							
						}					
					}
					?>
					<label for="password"><span class="forms-label">Entrez votre mot de passe</span></label>
				</div>	
					
								
				<button class="btn btn-warning center-block buttons">Connexion</button>
					
				<?php				
				$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
				$password = isset($_POST['password']) ? $_POST['password'] : NULL;

				$req = $bdd->prepare('SELECT * FROM users WHERE pseudo="'.$pseudo.'" AND mdp="'.sha1($password).'"');
				$req->execute(array(
					'pseudo' => $pseudo,
					'password' => $password));
				$resultat = $req->fetch();	
				
				if($_SERVER['REQUEST_METHOD'] == 'POST'){
					if(empty($pseudo) || empty($password)){					
						echo '<p class="alert alert-danger msg">Une erreur s\'est produite durant l\'identification.</p>';
					} else {
						if($resultat['pseudo'] == $pseudo){
							$_SESSION['pseudo'] = $resultat['pseudo'];	
							$_SESSION['id_user'] = $resultat['id_user'];
							
							echo '<script language="Javascript">
							  <!--	
								setTimeout("Redirect()",00);
								function Redirect()
								{
								  location.href = "http://musicmaniac.gabriel-cassano.be";
								}
								// -->
							 </script>';
						}
					}					
				} 
				?>
			</form>		
      </div>	  
    </div>
	
	


	
    
