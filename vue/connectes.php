<?php
// On vérfie si l'IP se trouve déjà dans la table "connectes" : il suffit de compter le nombre d'entrées dont le champ "ip" est l'adresse IP du visiteurs.
$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
// On récupère le résultat de cette requête.
$donnees = $retour->fetch();

// Si l'IP ne se trouve pas dans la table, on l'ajoute.
if($donnees['nbre_entrees'] == 0){
	$insert = $bdd->query('INSERT INTO connectes VALUES(\'' .$_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
} else{	
	// Sinon, l'IP se trouve déjà dans la table, on met juste à jour le timestamp. 
	$update = $bdd->query('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
}

// On supprime toutes les entrées dont le timestamp est plus vieux que 5 minutes.

// On stocke dans une variable le timestamp qu'il était il y a 5 minutes.
$timestamp_5min = time() - (60 * 5); // 60 * 5 : nombre de secondes écoulées en 5 minutes. 
$delete = $bdd->query('DELETE FROM connectes WHERE timestamp < ' .$timestamp_5min);

// On compte le nombre d'IP stockées dans la table, c'est le nombre de visiteurs connectés.
$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
$donnees = $retour->fetch();
?>

<div id="nb-visiteurs">
<?php
// On affiche le nombre d'utilisateurs connectés.
echo '<p id="visiteurs">Il y a actuellement ' . $donnees['nbre_entrees'] . ' visiteur(s) sur le site</p>';				
?> 
</div>	

								
