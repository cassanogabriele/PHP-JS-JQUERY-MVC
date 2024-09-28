<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine-fr.js" type="text/javascript" charset="utf-8"></script>
<script>
// Pour l'utilisation du plugin jQuery "validationEngine".
$(document).ready(function(){
	$("#validate_form").validationEngine();
});
</script>

<!-- Formulaire de connexion au site. -->
<div class="container">
    <div class="jumbotron" id="form">
		<form id="validate_form" class="forms" method="post" action="index.php?uc=gestionBlog&action=seconnecter">
			<h1 id="title-form">Connexion</h1>
			
			<div class="form-group">	
				<input class="validate[required] inputtext" type="text" name="pseudo" placeholder="Entrez votre pseudo">			
			</div>
			
			<div class="form-group">
				<input class="validate[required] inputtext" type="password" name="password" placeholder="Enrez votre mot de passe">
			</div>	
				
			<button class="btn btn-warning center-block buttons">Connexion</button>				
		</form>		
      </div>	  
</div>