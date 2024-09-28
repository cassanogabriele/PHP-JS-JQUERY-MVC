<?php
class Users
{
	private $id;
	private $pseudo;
	private $password;
	private $email;
	private $nom;
	private $date_inscription;
	private $statut;	
	
	public function number_pictures(){
		include("./modele/connectdb.php");
		
		// $id = @$_GET['id'];	
		// On récupère l'id passé.
		$id = $_GET['id'];
		// On récupère le nombre de photos enregistrées par l'utilisateur.
		$pictures = $bdd->query("SELECT COUNT(photos) AS nb_photos FROM photos WHERE id_user=$id");
		$fetch_pictures = $pictures->fetch();
		// On stocke ce nombre dans une variable.
		$nb_photos = $fetch_pictures['nb_photos'];
		// On affiche le nombre de photos.
		echo $nb_photos;		
	}
}
?>
		