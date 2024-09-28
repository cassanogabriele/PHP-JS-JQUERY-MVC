<?php
// On récupère le style dans une variable session (variable définie dans l'index qui correspond dans ce cas à chaque style mais qui est utilisée pour la détection de toutes les 
// pages.
$_SESSION['uc'] = $uc;

// Classe qui gère la bibliothèque de médias (ma collection de cd)
class Bibliotheque
{
	// Déclaration des attributs dont on a besoin qui correspondent aux champs de la table Bibliotheque.
	private $id_album;
	private $titre;
	private $link_img;
	private $style;	
		
	// On récupère chaque catégorie d'albums pour afficher les informations de cette catégorie dans la page chargée de les afficher.
	// On récupère les informations dans la table selon le style d'albums et on affiche les informations.
	public function display_albums(){
		include("./modele/connectdb.php");	

		// On définit chaque style dans un case pour n'exécuter qu'une seule fois la requête, le style est stocké dans une variable utilisée pour la requête.
		switch($_SESSION['uc']){
			case ($_SESSION['uc'] == 'tous');
				$style = '';
			break;
			case ($_SESSION['uc'] == 'rock');
				$style = 'rock';
			break;
			case ($_SESSION['uc'] == 'pop');
				$style = 'pop';
			break;
			case ($_SESSION['uc'] == 'metal');
				$style = 'metal';
			break;
			case ($_SESSION['uc'] == 'vf');
				$style = 'vf';
			break;
			case ($_SESSION['uc'] == 'vi');
				$style = 'vi';
			break;
			case ($_SESSION['uc'] == 'rap');
				$style = 'hip hop';
			break;
			case ($_SESSION['uc'] == 'punk');
				$style = 'punk';
			break;			
			case ($_SESSION['uc'] == 'electro');
				$style = 'electro';
			break;
			case ($_SESSION['uc'] == 'reggae');
				$style = 'reggae';
			break;
			case ($_SESSION['uc'] == 'films');
				$style = 'films';
			break;
			
			default;		
		}
		
		// Si il faut afficher tous les albums de tous les styles.
		if(($_SESSION['uc'] == 'tous')){
			$request = $bdd->query("SELECT * FROM bibliotheque ORDER BY titre ASC");
		} else{
			// Sinon on affiche les albums par style.
			$request = $bdd->query('SELECT * FROM bibliotheque where style="'.$style.'" ORDER BY titre ASC');
		}
		
		$count=0;
		
		// On récupère en boucle les informations des albums et on les affiche.
		while($fetch = $request->fetch()){
			$count++;
			echo '<td>';
			echo '<img class="img-albums" src="'.$fetch['link_img'].'" alt="albums" />
				  <h4 id="title-albums">'.$fetch['titre'].'</h4>';	
			echo '</td>';
			
			// Affichage des informations des albums par rangée de 3 images.
			if(($count % 3) == 0 ){
				echo '</tr><tr>';
			} 
		}
		
		if(($count % 3) != 0 ) 	{
			echo '</tr>';
		}		
	}	
}
?>
		
