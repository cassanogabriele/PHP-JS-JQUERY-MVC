<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-68888768-6"></script>

<a href="http://homesweethomedesign.gabriel-cassano.be/" style="display:none;">Home Sweet Home Design</a>
<a href="http://invokingdemons.gabriel-cassano.be/" style="display:none;">invoking demons</a>
<a href="http://icyber-corp.gabriel-cassano.be/" style="display:none;">Icyber-Corp.</a>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-68888768-6');
</script>

<?php
session_start();

include('modele/connectdb.php');
include_once('vue/header.php') ;
include_once('vue/menu.php') ;
include_once('vue/connectes.php');	
include_once('vue/status.php');	

if(!isset($_REQUEST['uc']))
    $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

switch($uc){
	case 'gestionBlog':
	{include("controleur/c_gestionBlog.php"); break;}
	case 'accueil':
	{include("vue/accueil.php"); break;} 
	case 'allsubjects':
	{include("vue/allsubjects.php"); break;} 
	case 'inscription' :
    {include("vue/formulaire_inscription.php"); break;} 
	case 'connexion' :
	{ include ("vue/connexion.php"); break;}
	case 'liste' :
	{ include ("vue/liste.php"); break;}
	case 'tous' :
	{ include ("vue/tous.php"); break;}
	case 'metal' :
	{ include ("vue/tous.php"); break;}
	case 'rock' :
	{ include ("vue/tous.php"); break;}
	case 'pop' :
	{ include ("vue/tous.php"); break;}
	case 'vf' :
	{ include ("vue/tous.php"); break;}
	case 'vi' :
	{ include ("vue/tous.php"); break;}
	case 'rap' :
	{ include ("vue/tous.php"); break;}
	case 'punk' :
	{ include ("vue/tous.php"); break;}
	case 'reggae' :
	{ include ("vue/tous.php"); break;}
	case 'electro' :
	{ include ("vue/tous.php"); break;}
	case 'films' :
	{ include ("vue/tous.php"); break;}
	case 'deconnexion':
	{ include ("vue/deconnexion.php"); break;}
	case 'profil':
	{ include ("vue/profil.php"); break;}
	case 'commentaires':
	{ include ("vue/formulaire_commentaires.php"); break;}
	case 'profil_user':
	{ include ("vue/profil_user.php"); break;}
	case 'subject_user':
	{ include ("vue/subject_user.php"); break;}	
	case 'reconnexion':
	{ include ("vue/reconnexion.php"); break;}	
}
include_once('vue/footer.php') ;
?>