<!-- Page d'accueil du site quand l'utilisateur est connecté. -->
<div id="monmenu" class="menu-forum" class="navbar-collapse collapse navbar-right responsive">
<?php
include_once('classes/Subject.class.php');
	// Si l'utilisateur est connecté, on affiche les sujets des utilisateurs."
	if(isset($pseudo)){
		echo '<div class="panel panel-info">
				<div class="panel-body">';						
				$subject = new Subject;
				$subject->display_subjects();
		echo '</div></div>';
	} else{
		// Sinon, on affiche des boutons qui permettent d'utiliser les différentes fonctionnalités du site (si on est pas connecté comme utilisateur dans ce cas).
		echo '<ul class="nav navbar-nav" id="options">
				<li><a href="index.php?uc=connexion"><button data-toogle="tooltip" data-placement="right" title="Connectez-vous si vous avez un compte sur le blog" class="btn btn-warning btn-perso"><i class="fa fa-lock" aria-hidden="true"></i> Connexion</button></a></li>	
				<li><a href="index.php?uc=inscription"><button data-toogle="tooltip" data-placement="right" title="Inscrivez-vous sur le blog pour y participer" class="btn btn-primary  btn-perso"><i class="fa fa-user" aria-hidden="true"></i> Inscription</button></a></li>					
				<li><a href="index.php?uc=allsubjects"><button data-toogle="tooltip" data-placement="right" title="Consultez les sujets" class="btn btn-info btn-perso"><i class="fa fa-forumbee" aria-hidden="true"></i> Sujets</button></a></li>	
				<li><a href="index.php?uc=liste"><button data-toogle="tooltip" data-placement="right" title="N\'hésitez pas à consulter notre bibliothèque de médias" class="btn btn-success btn-perso"><i class="fa fa-play-circle" aria-hidden="true"></i> Bibliothèque</button></a></li>             
				</ul>';
	}	
	?>
</div>

<script>
jQuery(document).ready(function($) {    
  Materialize.updateTextFields();
  $('select').material_select();
});
</script>