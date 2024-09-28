<?php
// On affiche les sujets de l'utilisateur enregistrés dans la table "subjects".
echo '<div class="panel panel-info">
		<div class="panel-body">';						
			$subject = new Subject;
			$subject->display_subjects();
echo '</div></div>';
?>