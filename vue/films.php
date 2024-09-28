<!-- Menu pour la sélection des styles pour la bibliothèque de médias (ma liste de cd). -->
<div id="navbar-bibli">
	<nav>
		<div class="nav-wrapper">		
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li class="active"><a href="index.php?uc=tous" class="links-white"><i class="fa fa-headphones" aria-hidden="true"></i>&nbsp; TOUS</a></li>
					<li class="active"><a href="index.php?uc=rock" class="links-white"><i class="fa fa-music" aria-hidden="true"></i>&nbsp; ROCK</a></li>
					<li class="active"><a href="index.php?uc=pop" class="links-white"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp;  POP</a></li>
					<li class="active"><a href="index.php?uc=metal" class="links-white"><i class="fa fa-play" aria-hidden="true"></i>&nbsp; METAL</a></li>	
					<li class="active"><a href="index.php?uc=vf" class="links-white"><i class="fa fa-volume-off" aria-hidden="true"></i>&nbsp; VARIETE FRANCAISE</a></li>
					<li class="active"><a href="index.php?uc=vi" class="links-white"><i class="fa fa-fast-forward" aria-hidden="true"></i>&nbsp; VARIETE ITALIENNE</a></li>
					<li class="active"><a href="index.php?uc=hiphop" class="links-white"><i class="fa fa-pause" aria-hidden="true"></i>&nbsp; HIP HOP</a></li>
					<li class="active"><a href="index.php?uc=punk" class="links-white"><i class="fa fa-stop" aria-hidden="true"></i>&nbsp; PUNK</a></li>
					<li class="active"><a href="index.php?uc=electro" class="links-white"><i class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp; ELECTRO</a></li>
					<li class="active"><a href="index.php?uc=reggae" class="links-white"><i class="fa fa-eject" aria-hidden="true"></i>&nbsp; REGGAE</a></li>
					<li class="active"><a href="index.php?uc=films" class="links-white"><i class="fa fa-step-forward" aria-hidden="true"></i>&nbsp; FILMS</a></li>
				</ul>
				
				<ul class="side-nav" id="mobile-demo">
					<li class="active"><a href="index.php?uc=tous" class="links-white"><i class="fa fa-headphones" aria-hidden="true"></i>&nbsp; TOUS</a></li>
					<li class="active"><a href="index.php?uc=rock" class="links-white"><i class="fa fa-music" aria-hidden="true"></i>&nbsp; ROCK</a></li>
					<li class="active"><a href="index.php?uc=pop" class="links-white"><i class="fa fa-volume-up" aria-hidden="true"></i>&nbsp;  POP</a></li>
					<li class="active"><a href="index.php?uc=metal" class="links-white"><i class="fa fa-play" aria-hidden="true"></i>&nbsp; METAL</a></li>	
					<li class="active"><a href="index.php?uc=vf" class="links-white"><i class="fa fa-volume-off" aria-hidden="true"></i>&nbsp; VARIETE FRANCAISE</a></li>
					<li class="active"><a href="index.php?uc=vi" class="links-white"><i class="fa fa-fast-forward" aria-hidden="true"></i>&nbsp; VARIETE ITALIENNE</a></li>
					<li class="active"><a href="index.php?uc=hiphop" class="links-white"><i class="fa fa-pause" aria-hidden="true"></i>&nbsp; HIP HOP</a></li>
					<li class="active"><a href="index.php?uc=punk" class="links-white"><i class="fa fa-stop" aria-hidden="true"></i>&nbsp; PUNK</a></li>
					<li class="active"><a href="index.php?uc=electro" class="links-white"><i class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp; ELECTRO</a></li>
					<li class="active"><a href="index.php?uc=reggae" class="links-white"><i class="fa fa-eject" aria-hidden="true"></i>&nbsp; REGGAE</a></li>
					<li class="active"><a href="index.php?uc=films" class="links-white"><i class="fa fa-step-forward" aria-hidden="true"></i>&nbsp; FILMS</a></li>
				</ul>
		</div>
	</nav>	
</div>

<div class="well">
	<table class="table">
	<?php
	// On inclue la classe chargée de faire le traitement pour l'affichage des données concernant les albums de style "film".
	include_once('classes/Bibliotheque.class.php');
	
	// Instanciation de la classe Bibliotheque.
	$bibliotheque = new Bibliotheque;
	// Appel de la fonction de la classe Bibliotheque chargée d'afficher les informations des albums.
	$bibliotheque->display_movies_albums();
	?>
	</table>
</div>

<script>
	 $(".button-collapse").sideNav();
</script>


	

