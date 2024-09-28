<?php
$action = $_REQUEST['action'];

// On fais un swich case qui sert à appeler les pages suivant la fonction choisie.
switch($action){
	// Inscription sur le site.
	case 'sinscrire':
	{include("modele/ajouter.php"); break;} 
	// Connexion sur le site.
	case 'seconnecter' :
    {include("modele/seconnecter.php"); break;} 
	// Modification du pseudo de l'utilisateur à partir de sa page de profil.
	case 'modifpseudo' :
    {include("modele/modifpseudo.php"); break;} 
	// Modification du nom de l'utilisateur à partir de sa page de profil.
	case 'modifname' :
    {include("modele/modifname.php"); break;} 
	// Modification de l'email de l'utilisateur à partir de sa page de profil.
	case 'modifemail' :
    {include("modele/modifemail.php"); break;}
	// Modification de l'âge de l'utilisateur à partir de sa page de profil.
	case 'modifage' :
    {include("modele/modifage.php"); break;}
	// Modification des styles de l'utilsateur à partir de sa page de profil.
	case 'style' :
    {include("modele/stylemusic.php"); break;}
	// Modification des intérêts de l'utilisateur à partir de sa page de profil. 
	case 'interets' :
    {include("modele/interets.php"); break;}
	// Modification du mot de passe de l'utilisateur à partir de sa page de profil.
	case 'modifpass' :
    {include("modele/modifpass.php"); break;}
}
?>