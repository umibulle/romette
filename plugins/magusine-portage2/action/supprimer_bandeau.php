<?php
/***************************************************************************\
 Plugin   : magusine
 Licence  : GPL
 Auteurs  : Stéphane Noël, Philippe Vanderlinden
 Infos    : http://www.spip-contrib.net/Le-plugin-Magusine
 http://www.magunews.net/spip.php?rubrique645

 $LastChangedRevision: 12345 $
 $LastChangedBy: bubu $
 $LastChangedDate: 2008-03-21 15:50:47 +0100 (ven, 21 mar 2008) $
 \***************************************************************************/

# supprime le bandeau d'une rubrique donnée
function action_supprimer_bandeau_dist()
{	
	$request_id_check    = _request('id_check');
	$request_id_rubrique = _request('id_rubrique');
	$chem                = _DIR_IMG."bandeau/";
	$handle              = @opendir($chem);
		
	# Vérifier si $id_rubrique est un entier
	if(!is_numeric($request_id_rubrique) )
	{ 
		echo "<p>"._T("arty:erreur_supprimer_bandeau")."</p>";
		exit();
	}

	
	if ($request_id_check == $_SESSION["id_check"])
	{
		// TODO : mazu - faut-il faire un while, pourquoi pas directement le unlink sur $chem.$fichier? 
		while($fichier = @readdir($handle) )
		{
			if (ereg("^bandeau-$request_id_rubrique\.(jpg|png|gif)$", $fichier) )
			{
				if(unlink($chem.$fichier) )
				{ 
					$contexte = array('id_rubrique'=>$request_id_rubrique,'largeurMax'=>350,'hauteurMax'=>250);
					echo recuperer_fond('prive/upload_bandeau', $contexte);
					exit();
				}
			}
		}
	}
	echo "<p>"._T("arty:erreur_supprimer_bandeau")." -> ".$chem."bandeau-".$request_id_rubrique."</p>";
	exit();
}
?>