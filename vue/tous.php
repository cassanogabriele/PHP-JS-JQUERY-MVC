<!-- Page qui affiche tous les albums (sans choix de catégorie) -->

<!-- Menu pour la sélection des styles pour la bibliothèque de médias (ma liste de cd). -->
<?php
include_once("vue/navbar_menu.php");
?>

<div class="well">
	<table class="table">
	<?php
	// On inclue la classe chargée de faire le traitement pour l'affichage des données concernant tous les albums.
	include_once('classes/Bibliotheque.class.php');
		
	// Instanciation de la classe Bibliotheque.
	$bibliotheque = new Bibliotheque;
	// Appel de la fonction de la classe Bibliotheque chargée d'afficher les informations des albums.
	$bibliotheque->display_albums($dbConnection);		
	?>
	</table>
</div>

<script>
$(".button-collapse").sideNav();
</script>


	

