<!-- Affichage du formulaire d'inscription au site. -->
<div class="inscription">
	<div class="container">
		<div class="row" id="form-inscription">
			<form id="validate_form" action="index.php?uc=gestionBlog&action=sinscrire" method="post" class="forms" enctype="multipart/form-data">
				<h1 id="title-form">Inscription</h1>
			
				<div class="form-group">	
					<input class="validate[required,custom[pseudo], minSize[4]] text-input" style="color:black;" type="text" name="pseudo" id="pseudo" placeholder="Veuillez entrer votre pseudo" />		
				</div>
				
				<div class="form-group">
					<input class="validate[required,custom[password], text-input ]" type="password" name="password" id="password" placeholder="Veuillez entrer votre mot de passe"/>
				</div>	
				
				<div class="form-group">
					<input class="validate[required] text-input" type="text" name="nom" id="nom" placeholder="Veuillez entrer votre nom" />
				</div>	
				
				<div class="form-group">
					<input class="validate[required,custom[email]]" type="text" name="email" id="email" placeholder="Veuillez entrer votre mail"/>
				</div>
				
				<div class="form-group">
					<input class="validate[required,custom[integer],min[2]]" type="number" name="age" id="age" placeholder="Entrez votre âge"/>
				</div>
				
				<div class="form-group">
					<input class="validate[required] text-input" type="text" name="style" id="style" placeholder="Veuiller entrez vos styles de musique, séparés par une virgule"/>
				</div>
				
				<div class="form-group">
					<input class="validate[required] text-input" type="text" name="interests" id="interests" placeholder="Veuillez entrer vos passions"/>
				</div>
				
				<div class="form-group">
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
				<label for="email" class="labels">Photo de profil</label> <input type="file" id="avatar" name="avatar">
				</div>
				
				<button class="btn btn-warning center-block buttons">Envoyer</button>					
			</form>						
		</div>
	</div>
</body>
</html>