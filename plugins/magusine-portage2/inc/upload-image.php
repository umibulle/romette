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

//gestion de l'upload d'un logo pour les groupes de mot
// les logos sont sauvés sous la forme bandeau.ext, et bandeau-id_rubrique.ext pour les bandeaux associés à une rubrique particulière 
function traiter_upload_image($nom,$rep,$id_groupe=0){
	if (isset($_FILES[$nom])) {
		if ($_FILES[$nom]["error"] == 0) {
			$ext = strtolower(end(explode(".", $_FILES[$nom]["name"])));

			$ext_ok = Array("jpg", "gif", "png");
			if (!in_array($ext, $ext_ok)) {
				return "arty:erreur_extension";
			}

			$chem = creer_repertoire_documents($rep);
			$chem = _DIR_IMG.$rep."/";

			if (!$id_groupe) {
				$nom_logo = $nom;
			} else {
				$nom_logo = "$nom-$id_groupe";
			}

			$dest = $chem.$nom_logo.".".$ext;
			$ok = false;
			if ($chem) {
				$ok = @move_uploaded_file($_FILES[$nom]['tmp_name'], $dest);
			}

			if ($ok){
				//nettoyage du dossier logo (les logo portant le même nom mais une extension différente du bandeau uploadé sont supprimés)
				$handle = @opendir($chem);
				while($fichier = @readdir($handle)) {
					if (ereg("^$nom_logo\.(jpg|png|gif)$", $fichier) && $fichier != $nom_logo.".".$ext){
						@unlink($chem.$fichier);
					}
				}
				return "arty:upload_reussi";
			} else {
				return "arty:upload_rate";
			}
		} else if ($_FILES[$nom]["error"] == 1 || $_FILES[$nom]["error"] == 2) {
			return "arty:erreur_trop_gros";
		} else if ($_FILES[$nom]["error"] == 3) {
			return "arty:erreur_transmission";
		}
	}
}

// supprime le bandeau d'une rubrique donnée
function traiter_suppression_logo($id_groupe=0){
	if (isset($_GET['action']) && isset($_GET['id_check'])){
		if ($_GET['action'] == "supprimer_logo" && $_GET['id_check'] == $_SESSION["id_check"]) {
			//$chem = creer_repertoire_documents("logo-groupe");
			$chem = _DIR_IMG."logo-groupe/";
			$handle = @opendir($chem);
			while($fichier = @readdir($handle)) {
				if (!$id_groupe) {
					if (ereg("^logo\.(jpg|png|gif)$", $fichier)){
						@unlink($chem.$fichier);
					}
				} else {
					if (ereg("^logo-$id_groupe\.(jpg|png|gif)$", $fichier)){
						@unlink($chem.$fichier);
					}
				}
			}
		}
	}
}

?>