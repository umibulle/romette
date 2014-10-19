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

if (!defined("_ECRIRE_INC_VERSION")) return;

// importe la fonction creer_repertoire_documents, qui retourne le chemin vers un dossier donné dans le répertoire img, et le crée si nécessaire
include_spip('inc/getdocument');
include_spip('inc/filtres_images_mini');

function formulaires_upload_bandeau_charger_dist($id_rubrique,$largeurMax,$hauteurMax)
{ 
    $valeurs = array(
    	"id_rubrique" =>$id_rubrique,
    	"id_check"    =>$_SESSION["id_check"],
        "largeurMax"  =>$largeurMax,
        "hauteurMax"  =>$hauteurMax
    );

    return $valeurs;
}

// gestion de l'upload d'un bandeau
// les bandeaux sont sauvés sous la forme bandeau.ext, et bandeau-id_rubrique.ext pour les bandeaux associés à une rubrique particulière 
function formulaires_upload_bandeau_traiter_dist($id_rubrique,$largeurMax,$hauteurMax)
{	
	if (isset($_FILES["bandeau"])) {
		if ($_FILES["bandeau"]["error"] == 0) {
			$ext = strtolower(end(explode(".", $_FILES["bandeau"]["name"])));
			$ext_ok = Array("jpg", "gif", "png");
			if (!in_array($ext, $ext_ok)) {
				return array('message_erreur'=>_T("arty:erreur_extension") );
			}

			$chem        = creer_repertoire_documents("bandeau");
			$chem        = _DIR_IMG."bandeau/";
			$nom_bandeau = "bandeau".((is_numeric($id_rubrique))?"-".$id_rubrique:"");
			$dest        = $chem.$nom_bandeau.".".$ext;

			$ok = false;
			if ($chem) {
				$ok = @move_uploaded_file($_FILES['bandeau']['tmp_name'], $dest);
			}

			if ($ok){
				//nettoyage du dossier bandeau (les bandeaux portant le même nom mais une extension différente du bandeau uploadé sont supprimés)
				$handle = @opendir($chem);
				while($fichier = @readdir($handle)) {
					if (ereg("^$nom_bandeau\.(jpg|png|gif)$", $fichier) && $fichier != $nom_bandeau.".".$ext){
						@unlink($chem.$fichier);
					}
				}
				
				$fichier_upload = $chem.$nom_bandeau.".".$ext;
				
				# calculer la nouvelle taille du bandeau
				list($rWidth, $rHeight, $rType, $rAttr) = getimagesize($fichier_upload);
				$ratioImg = image_ratio($rWidth,$rHeight,$largeurMax,$hauteurMax);
				
			
				$valeurs["message_ok"]["message"] = "";
				$valeurs["message_ok"]["hauteur"] = $ratioImg[1];
				$valeurs["message_ok"]["largeur"] = $ratioImg[0];
				$valeurs["message_ok"]["fichier_upload"] = $fichier_upload;
				
				return $valeurs;
				
			} else {
				return array('message_erreur'=>_T("arty:upload_rate") );
			}
		} else if ($_FILES["bandeau"]["error"] == 1 || $_FILES["bandeau"]["error"] == 2) {
			return array('message_erreur'=>_T("arty:erreur_trop_gros") );
		} else if ($_FILES["bandeau"]["error"] == 3) {
			return array('message_erreur'=>_T("arty:erreur_transmission") );
		}
	}
}

?>