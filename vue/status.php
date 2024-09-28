<?php
/*
* Pouruqoi ce morceau de code en dehors de tout ?
* tu test en dessous si session pseudo est parametrer
* et tu n'utilise nulle part pseudo ?
$pseudo = @$_SESSION['pseudo'];
*/
?>

<?php
//je rajoute un test pour vérifier non seulement isset mais aussi si il est videl
if(isset($_SESSION['pseudo'])){					
	echo "<div id='accueil'>
			<ul class='nav navbar-nav'>                   
				<li class='dropdown'>
			<a href='#' class='dropdow-toggle' data-toggle='dropdown'>";
	echo "<span id='user'>";
	echo "Bienvenu &nbsp;" ;
	echo "</span>";
	echo '<i class="fa fa-user" aria-hidden="true"></i> &nbsp;';						
	echo "<span id='user'>";
	echo $_SESSION['pseudo'];
	echo "</span>";
	echo "<li><a href='http://musicmaniac.gabriel-cassano.be/index.php?uc=profil'>Mon profil</a></li>";
	echo "<li><a href='index.php?uc=liste'>Bibliothèque</a></li>";
	echo "<li><a href='http://musicmaniac.gabriel-cassano.be/index.php?uc=deconnexion'><i class='fa fa-times' aria-hidden='true'></i> &nbsp; Se déconnecter</a></li>";
	echo "</ul></div>";
	
} else{
	echo "<div class='alert alert-warning center-align' id='welcome' role='alert'>
		Inscrivez-vous pour participer à l'activité de Music Maniac
		</div>";		
}
?>	
