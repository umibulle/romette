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
include_spip('inc/presentation');
include_spip('inc/layer');
include_spip('inc/getdocument');
include_spip('inc/upload-image');
include_spip('inc/extra');

include_spip('inc/arty_selecteur');
include_spip('inc/user_session');

function exec_avance() {
	$message_upload = traiter_post();
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('arty:gestion_bloc_libre').' &raquo;', 'configuration', 'magusine');

	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
	 echo "<p><b>"._T('magusine:acces_a_la_page')."</b></p>";
	 fin_page();
	 exit;
	}

	

	traiter_get();

	echo barre_onglets("arty", "avance"); //affiche la barre des onglets du groupe "magusine", l'onglet courant est "avance".
	echo debut_gauche("", true);
	if ($message_upload && $message_upload != "arty:upload_reussi") {
		echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/emblem-important.png', true, "", _T('arty:erreur'));
		echo "<p style='font-weight:bold; color:red;'>"._T($message_upload)."</p>";
		echo fin_cadre_relief(true);
	}
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:info'));
	echo _T("arty:sideinfo_avance");
	echo fin_cadre_relief(true);
	echo debut_droite("", true);

	echo gros_titre(_T("arty:gestion_bloc_libre"), "", false);
	 
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."/images/config.png", true, "", _T('arty:creer_un_bloc_libre'));
	echo "<div style='padding-left:5px;'>";
	echo "<br />";
	echo _T('arty:entrez_donnees_nouveau_bloc');
	echo "<form action='".generer_url_ecrire('avance')."' method='post' enctype=\"multipart/form-data\" name='formulaire' id='formulaire'>\n";
	echo "<input type='hidden' name='action_form' value='nouveaubloc' />\n";
	echo "<input type='text' name='titre' style='width:90%; color:#666; font-weight:bold;' value='"._T('arty:titre')."' onfocus='if(this.value==\""._T('arty:titre')."\"){this.value=&#34;&#34;;}' maxlength='255' size='50' />\n";
	echo "<textarea name='texte' style='width:90%; color:#444;' cols='50' rows='4' id='texte1'></textarea>\n";
	echo "<br /><br />"._T('arty:bloc_lien')."<br />\n";
	echo "<input type='text' name='lien' value='http://' maxlength='255'  style='width:90%' size='50' />\n";
	echo "<br /><br />"._T('arty:bloc_image')."<br />\n";

	echo "<input type=\"file\" name=\"illu_bloc_libre\" size=\"55\"  style='width:95%' /><br />\n";
	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />\n";
	echo "</form>\n";
	echo "</div>\n";
	echo fin_cadre_trait_couleur(true);
	$tousblocs = spip_query("SELECT * FROM spip_arty_bloclibre");

	while ($row=spip_fetch_array($tousblocs)) {
		echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."/images/config.png", true, "", htmlspecialchars($row['titre']));
		echo "<a name='".$row['id_bloc_libre']."'></a>";
		$chem = creer_repertoire_documents("illu-bloc-libre");

		$chem=_DIR_IMG."illu-bloc-libre/";
		$handle = @opendir($chem);
		$logo = false;
		while($fichier = @readdir($handle)) {

			if (ereg("^illu_bloc_libre-".$row['id_bloc_libre']."\.(jpg|png|gif)$", $fichier)) {
				$logo = $fichier;
			}
		}
		if ($logo){
			// le nombre aléatoire permet d'éviter que le navigateur affiche la version en cache de l'image.
			$image = "<div style='padding-left:5px'><p>"._T("arty:logo_actuel").":</p><img width=\"190\" src=\""._DIR_IMG."illu-bloc-libre/$logo?".uniqid(rand())."\" />";
			$image .="<form style='display:inline;' action='".generer_url_ecrire('avance')."' method='post'>\n"
			."<input type='hidden' name='action_form' value='supprimerillu' />"
			."<input type='hidden' name='id_bloc' value='".$row['id_bloc_libre']."' />"
			."<input type='submit' title='"._T("arty:supprimer_illu")."' value='X' class='fondo' style='position:relative; border-color:red; background-color:red; left:-30px; font-size:10px;' /><br /><br />"
			."</form></div>";
		} else {
			$image="";
		}

		$texte = $image."<form action='".generer_url_ecrire('avance')."' method='post' enctype=\"multipart/form-data\">\n"
		."<input type='hidden' name='action_form' value='modifierbloc' />"
		."<input type='hidden' name='id_bloc' value='".$row['id_bloc_libre']."' />"
		.(isset($_POST['retour']) ? "<input type='hidden' name='retour' value='".$_POST['retour']."' />" : "")
		."<input type='text' name='titre' value='".htmlspecialchars($row['titre'], ENT_QUOTES)."' maxlength='255' size='50' style='width:90%; color:#666; font-weight:bold;' />"
		."<textarea name='texte' cols='50' style='width:90%; color:#444;' rows='4'>".htmlspecialchars($row['contenu'])."</textarea>"
		."<br /><br />"._T('arty:bloc_lien')."<br />"
		."<input type='text' name='lien' value='".htmlspecialchars($row['lien'], ENT_QUOTES)."' maxlength='255' size='50' style='width:90%' />"
		."<br /><br />"._T('arty:bloc_image')."<br />"
		."<input type=\"file\" name=\"illu_bloc_libre\" size=\"55\" style='width:90%' /><br /><br /><br />"
		."<input type='submit' value='".(isset($_POST['retour']) ? _T("arty:modifier_et_retour") : _T("arty:enregistrer") )."' class='fondo' style='float:right; margin-right:45px;' />"
		._T("arty:attention_modif_globale")."<br />"
		."</form>";
		$texte .="<form action='".generer_url_ecrire('avance')."' method='post'>\n"
		."<input type='hidden' name='action_form' value='supprimerbloc' />"
		."<input type='hidden' name='id_bloc' value='".$row['id_bloc_libre']."' />"
		."<br /><div style='text-align:center;'><input type='submit' value='"._T("arty:supprimer_ce_bloc")."' class='fondo' style='background-color:red; border-color:red; font-size:9px; font-weight:normal; margin:10px auto;' /></div>"
		."</form>";

		$visible = ($_POST['bloc'] == $row['id_bloc_libre']) ? true : false;

		//echo block_parfois_visible("bloc".$row['id_bloc_libre'], _T('arty:modifier_ce_bloc'), $texte, '', $visible);
		
		echo cadre_depliable(find_in_path("img_pack/view_list.png"), _T('arty:modifier_ce_bloc'), $visible, $texte,"bloc".$row['id_bloc_libre'],'r');
		
		
		echo fin_cadre_trait_couleur(true);
	}

	echo fin_gauche();

	echo fin_page();

}

function traiter_post() {
	$message_upload = "";

	if ($_POST['action_form']=='nouveaubloc' && isset($_POST['titre']) && isset($_POST['texte']) ) {
		$titre=trim(addslashes($_POST['titre']));
		$texte=trim(addslashes($_POST['texte']));
		$lien=trim(addslashes($_POST['lien']));

		if($lien=="http://") { $lien=""; }

		if ($titre!="") { // && $texte!="") {
			spip_query("INSERT INTO spip_arty_bloclibre(titre, contenu,lien) VALUES('$titre', '$texte', '$lien')");
			$result = spip_query("SELECT LAST_INSERT_ID();");
			if ($result){
				$arr = spip_fetch_array($result);
				$id = (int) current($arr);

				if (!is_nan($id)){
					$message_upload = traiter_upload_image('illu_bloc_libre','illu-bloc-libre',$id);
				}
			}
		}
	}

	if ($_POST['action_form']=='supprimerbloc' && isset($_POST['id_bloc'])) {

		$id_bloc=(int) $_POST['id_bloc'];

		if (!is_nan($id_bloc)) {
			spip_query("DELETE FROM spip_arty_bloclibre WHERE id_bloc_libre= $id_bloc");
			supprimer_illu_bloc($id_bloc);
				
			// supprimer les associations
			spip_query("DELETE FROM spip_arty_bloclibreassoc WHERE id_bloc_libre= $id_bloc");
		}
	}

	if ($_POST['action_form']=='supprimerillu' && isset($_POST['id_bloc'])) {

		$id_bloc=(int) $_POST['id_bloc'];

		if (!is_nan($id_bloc)) {
			//spip_query("DELETE FROM spip_arty_bloclibre WHERE id_bloc_libre= $id_bloc");
			supprimer_illu_bloc($id_bloc);
		}
	}


	if ($_POST['action_form']=='modifierbloc' && isset($_POST['id_bloc']) && isset($_POST['titre']) && isset($_POST['texte']) ) {
		//print_r($_POST);
		$id_bloc=(int) $_POST['id_bloc'];
		$titre=trim(addslashes($_POST['titre']));
		$texte=trim(addslashes($_POST['texte']));
		$lien=trim(addslashes($_POST['lien']));
		if($lien=="http://") { $lien=""; }

		if ($titre!="" && !is_nan($id_bloc)) {
			spip_query("UPDATE spip_arty_bloclibre SET titre='$titre', contenu='$texte', lien='$lien' WHERE id_bloc_libre=$id_bloc");
			$message_upload = traiter_upload_image('illu_bloc_libre','illu-bloc-libre',$id_bloc);
		}

		//redirection vers la page d'origine
		if (isset($_POST['retour'])) {
			header('Location: '.$_POST['retour']);
		}
	}
	return $message_upload;
}

function supprimer_illu_bloc($id_bloc) {
	//$chem = creer_repertoire_documents("illu-bloc-libre");
	$chem = _DIR_IMG."illu-bloc-libre/";
	$handle = @opendir($chem);
	while($fichier = @readdir($handle)) {
		if (!$id_bloc) {
			if (ereg("^illu_bloc_libre\.(jpg|png|gif)$", $fichier)){
				@unlink($chem.$fichier);
			}
		} else {
			if (ereg("^illu_bloc_libre-$id_bloc\.(jpg|png|gif)$", $fichier)){
				@unlink($chem.$fichier);
			}
		}
	}
}

function traiter_get() {
	$param_accepte=array('edito');

	if(isset($_GET['ajouter']) && isset($_GET['verif'])){
		$param=$_GET['ajouter'];
		if(in_array($param, $param_accepte) && $_GET['verif']==$_SESSION['id_check']) {

			if(isset($_GET['id_rubrique'])) {
				$id_rubrique=(int) $_GET['id_rubrique'];
					
				if(is_numeric($id_rubrique)){
					$resultat = spip_query("SELECT * FROM spip_arty_paramassoc WHERE param = '$param' AND id_rubrique = $id_rubrique");
					if(!spip_mysql_count($resultat)) {
						spip_query("INSERT INTO spip_arty_paramassoc (param, id_rubrique) VALUES ('$param', $id_rubrique)");
					}
						
				}
					
			} elseif(isset($_GET['id_article'])) {
				$id_article=(int) $_GET['id_article'];
					
				if(is_numeric($id_article)){
					$resultat = spip_query("SELECT * FROM spip_arty_paramassoc WHERE param = '$param' AND id_article = $id_article");
					if(!spip_mysql_count($resultat)) {
						spip_query("INSERT INTO spip_arty_paramassoc (param, id_article) VALUES ('$param', $id_article)");
					}
						
				}
					
			}
				

		}

	}

	if(isset($_GET['supprimer']) && isset($_GET['verif'])){
		$id_assoc=(int) $_GET['supprimer'];
		if( is_numeric($id_assoc) && $_GET['verif']==$_SESSION['id_check']) {
			spip_query("DELETE FROM spip_arty_paramassoc WHERE id_assoc = $id_assoc");
		}
	}

}


?>
