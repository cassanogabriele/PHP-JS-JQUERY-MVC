<?php
class Connected
{		
	public function insert_connected(){
		include("./modele/connectdb.php");	
		// On vérifie si l'IP se trouve déjà dans la table.

		// Il suffit de compter le nombre d'entrées dont le champ "ip" est l'adresse IP du visiteur.
		$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
		$donnees = $retour->fetch();

		// Si l'IP ne se trouve pas dans la table, on va l'ajouter. Sinon, l'IP se trouve dans la table, on met juste à jour 
		// le timestamp.
		if($donnees['nbre_entrees'] == 0){
			$insert = $bdd->query('INSERT INTO connectes VALUES(\'' .$_SERVER['REMOTE_ADDR'] . '\', ' . time() . ')');
		} else{		
			$update = $bdd->query('UPDATE connectes SET timestamp=' . time() . ' WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
		}
		
		// On supprime toutes les entrées dont le timestamp est plus vieux que 5 minutes
		
		// On stocke dans une variable le timestamp qu'il était il y a 5 minutes.
		$timestamp_5min = time() - (60 * 5); // 60 * 5 : nombre de secondes écoulées en 5 minutes
		$delete = $bdd->query('DELETE FROM connectes WHERE timestamp < ' .$timestamp_5min);

		// On compte le nombre d'IP stockées dans la table qui correspond au nombre de visiteurs connectés.		
		$retour = $bdd->query('SELECT COUNT(*) AS nbre_entrees FROM connectes WHERE ip=\'' . $_SERVER['REMOTE_ADDR'] . '\'');
		$donnees = $retour->fetch();	
	}
}
?>
		