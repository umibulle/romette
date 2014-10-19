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

// importe la fonction creer_repertoire_documents, qui retourne le chemin vers un dossier donné dans le répertoire img, et le crée si nécessaire

include_spip('inc/getdocument');
include_spip('inc/layer');
include_spip('inc/upload-image');
include_spip('inc/xml-parser');
include_spip('inc/filtres_images_mini');

function arty_ajouterfonctionnalites($flux) {

	global $connect_statut;
	//print_r($flux);
	if ($connect_statut == "0minirezo" ) {
		 
		 
		if (isset($flux['args']['id_groupe']) && $flux['args']['exec'] == "mots_types"){
			 
			$flux['data'] .= formulaire_logo($flux['args']['id_groupe']);
			$flux['data'] .= bloc_formulaire_themes('groupe', $flux['args']['id_groupe'], "?exec=mots_type&id_groupe=".$flux['args']['id_groupe']);
			$flux['data'] .= formulaire_bloc_libre('groupe', $flux['args']['id_groupe'],"?exec=mots_type&id_groupe=".$flux['args']['id_groupe']);
			$flux['data'] .= bloc_gabarit('groupe-mots', $flux['args']['id_groupe'],"?exec=mots_type&id_groupe=".$flux['args']['id_groupe']);
			 
		}

		if (isset($flux['args']['id_article']) && $flux['args']['exec'] == "articles"){
			$flux['data'] .= bloc_formulaire_themes('article', $flux['args']['id_article'], "?exec=articles&id_article=".$flux['args']['id_article']);
			$flux['data'] .= formulaire_bloc_libre('article', $flux['args']['id_article'],"?exec=articles&id_article=".$flux['args']['id_article']);
			$flux['data'] .= bloc_gabarit('article', $flux['args']['id_article'],"?exec=articles&id_article=".$flux['args']['id_article']);
			 
		}

		if (isset($flux['args']['id_rubrique']) && $flux['args']['exec'] == "naviguer"){
			$flux['data'] .= formulaire_bandeau($flux['args']['id_rubrique']);
			$flux['data'] .= bloc_formulaire_themes('rubrique', $flux['args']['id_rubrique'], "?exec=naviguer&id_rubrique=".$flux['args']['id_rubrique']);
			$flux['data'] .= formulaire_bloc_libre('rubrique', $flux['args']['id_rubrique'],"?exec=naviguer&id_rubrique=".$flux['args']['id_rubrique']);
			if ($flux['args']['id_rubrique']) {
				$flux['data'] .= bloc_gabarit('rubrique', $flux['args']['id_rubrique'],"?exec=naviguer&id_rubrique=".$flux['args']['id_rubrique']);
			}
		}

		if (isset($flux['args']['id_mot']) && $flux['args']['exec'] == "mots_edit"){
			$flux['data'] .= bloc_gabarit('mot', $flux['args']['id_mot'],"?exec=mots_edit&id_mot=".$flux['args']['id_mot']);
			$flux['data'] .= bloc_formulaire_themes('mot', $flux['args']['id_mot'], "?exec=mots_edit&id_mot=".$flux['args']['id_mot']);
		}

	}

	$flux['data'] .= "";


	return $flux;

}

// formulaire de bloc libre
function formulaire_bloc_libre($type, $id, $url_retour) {
	// traitements de formulaire
	if (isset($_POST['action_form']) && isset($_POST['bloclibre'])) {
		if($_POST['action_form'] == 'associer_bloc_libre' && !is_nan($_POST['bloclibre'])) {
			//on peut sauver
			if ($type == "rubrique" && $id == 0 && isset($_POST['lang'])) {
				$resultat = spip_query("SELECT * FROM spip_arty_bloclibreassoc WHERE lang='".addslashes($_POST['lang'])."' AND type='$type' AND id=$id AND id_bloc_libre=".$_POST['bloclibre']);
				if (!spip_mysql_count($resultat)) {
					spip_query("INSERT INTO spip_arty_bloclibreassoc (id_bloc_libre, type, id, lang) VALUES (".$_POST['bloclibre'].",'$type',$id, '".addslashes($_POST['lang'])."')");
				}
			} else {
				$resultat = spip_query("SELECT * FROM spip_arty_bloclibreassoc WHERE type='$type' AND id=$id AND id_bloc_libre=".$_POST['bloclibre']);
				if (!spip_mysql_count($resultat)) {
					spip_query("INSERT INTO spip_arty_bloclibreassoc (id_bloc_libre, type, id) VALUES (".$_POST['bloclibre'].",'$type',$id)");
				}
			}
		}
	}

	if (isset($_POST['action_form']) && isset($_POST['bloclibre'])) {
		if($_POST['action_form'] == 'dissocier_bloclibre' && !is_nan($_POST['bloclibre'])) {
			if (isset($_POST["lang"])) {
				spip_query("DELETE FROM spip_arty_bloclibreassoc WHERE lang='".addslashes($_POST["lang"])."' AND type='$type' AND id=$id AND id_bloc_libre=".$_POST['bloclibre']);
			} else {
				spip_query("DELETE FROM spip_arty_bloclibreassoc WHERE type='$type' AND id=$id AND id_bloc_libre=".$_POST['bloclibre']);
			}
		}
	}

	if ($_POST['action_form']=='nouveaubloc' && isset($_POST['titre']) && isset($_POST['texte']) ) {

		$titre=trim(addslashes($_POST['titre']));
		$texte=trim(addslashes($_POST['texte']));
		$lien=trim(addslashes($_POST['lien']));

		if($lien=="http://") { $lien=""; }

		if ($titre!="" ) {//&& $texte!="") {
			spip_query("INSERT INTO spip_arty_bloclibre(titre, contenu,lien) VALUES('$titre', '$texte', '$lien')");
			$result = spip_query("SELECT LAST_INSERT_ID();");
			if ($result){
				$arr = spip_fetch_array($result);
				$id_last = (int) current($arr);

				if (!is_nan($id_last)){
					echo traiter_upload_image('illu_bloc_libre','illu-bloc-libre',$id_last);

					$resultat = spip_query("SELECT * FROM spip_arty_bloclibreassoc WHERE type='$type' AND id=$id AND id_bloc_libre=".$id_last);
					if (!spip_mysql_count($resultat)) {

						if ($type == "rubrique" && $id == 0 && isset($_POST['lang'])) {
							spip_query("INSERT INTO spip_arty_bloclibreassoc (id_bloc_libre, type, id, lang) VALUES (".$id_last.",'$type',$id, '".addslashes($_POST['lang'])."')");
						} else {
							spip_query("INSERT INTO spip_arty_bloclibreassoc (id_bloc_libre, type, id) VALUES (".$id_last.",'$type',$id)");
						}
					}
				}
			}
		}
	}
	
	// liste des blocs disponibles
	$result=spip_query("SELECT * FROM spip_arty_bloclibre");
	
	$balancemoica ="";
	if (spip_mysql_count($result)) {
		//$blocsdispos = debut_cadre_relief(_DIR_PLUGIN_ARTY."/images/config.png", true, "", _T('arty:associer_un_bloc_libre'));
		$blocsdispos .= _T('arty:intro_associer_bloc_libre')."<br />";
		$blocsdispos .= "<form action='$url_retour' method='post'>";
		$blocsdispos .= "<select name='bloclibre' class='forml'>";
		while ($row=spip_fetch_array($result)) {
			$blocsdispos .= "<option value='".$row['id_bloc_libre']."'>".htmlspecialchars($row['titre'])."</option>";
		}
		$blocsdispos .= "</select>";
		$blocsdispos .= "<input type='hidden' name='action_form' value='associer_bloc_libre'>";


		if ($type == "rubrique" && $id == 0) {

			$leslangues_menu=explode(",",$GLOBALS['meta']['langues_utilisees']);
			$def = $GLOBALS['meta']['langue_site'];
			 
			$blocsdispos .= "<br />"._T('arty:langue_bloc_assoc');
			$blocsdispos .= '<br /><select name="lang" class="forml">';

			foreach($leslangues_menu as $fullname) {
				$blocsdispos .= "<option value='$fullname' ".(($def==$fullname)?'selected="selected"':'').">".$GLOBALS['codes_langues'][$fullname]."</option>";
			}
			$blocsdispos .= "</select><br />";
		}
		$blocsdispos .= "<input type='submit' class='fondo' value='"._T('arty:ajouter')."' /></form>";
		
		// liste des blocs associ�s
		$resultat=spip_query("SELECT * FROM spip_arty_bloclibreassoc WHERE  type='$type' AND id=$id");
		if (spip_mysql_count($resultat)) {
			$blocsdispos .= "<br /><hr /><br />"._T('arty:blocs_libres_deja_associes');
			$blocsdispos .= "<ul style='padding-left:0px;' class='menu'>";
			while ($row=spip_fetch_array($resultat)) {
				$lebloc=spip_query("SELECT * FROM spip_arty_bloclibre WHERE id_bloc_libre =".$row['id_bloc_libre']);
				$lebloc=spip_fetch_array($lebloc);
				$blocsdispos .= "<li style='font-size:10px;'>".htmlspecialchars($lebloc['titre']);
				$blocsdispos .= $row['lang'] ? " <span style='color:#888'>[".$row['lang']."]</span>" : '';
				$blocsdispos .= "<form style='display:inline;' action='".generer_url_ecrire('avance')."#".$row['id_bloc_libre']."' method='post'>";
				$blocsdispos .= "<input type='hidden' name='retour' value='$url_retour' />";
				$blocsdispos .= "<input type='hidden' name='bloc' value='".$row['id_bloc_libre']."' />";
				if (_SPIP_AJAX) {
					$blocsdispos .= "<img src='"._DIR_PLUGIN_ARTY."/images/mod.png' alt='M' title='"._T('arty:modifier_ce_bloc')."' class='bouton-modifier' style='margin-left:3px; cursor: pointer;' />";
				} else {
					$blocsdispos .= "<input type='submit' value='"._T('arty:modifier_ce_bloc')."' />";
				}
				$blocsdispos .= "</form>";
				$blocsdispos .= "<form style='display:inline;' action='$url_retour' method='post' style='display:inline;'>";
				$blocsdispos .= "<input type='hidden' name='action_form' value='dissocier_bloclibre'>";
				if ($row['lang']) {
					$blocsdispos .= "<input type='hidden' name='lang' value='".$row["lang"]."'>";
				}
				$blocsdispos .= "<input type='hidden' name='bloclibre' value='".$row['id_bloc_libre']."'>";
				if (_SPIP_AJAX) {
					$blocsdispos .= "<img src='"._DIR_IMG_PACK."/croix-rouge.gif' alt='X' title='"._T("arty:supprimer")."' style='margin-left:2px; cursor: pointer;' class='bouton-supprimer' />";
				} else {
					$blocsdispos .= "<input type='submit' value='X'/>";
				}
				$blocsdispos .= "</form></li>";
			}
			$blocsdispos .= "</ul>";
			if (_SPIP_AJAX) {
				$blocsdispos .= "<script type='text/javascript'>
		jQuery('.bouton-supprimer').each(function(){
			jQuery(this).click(function(){
				jQuery(this).parent().submit();
				})
			})
		jQuery('.bouton-modifier').each(function(){
			jQuery(this).click(function(){
				jQuery(this).parent().submit();
				})
			})
		</script>";
			}

		}
		
		$balancemoica .= cadre_depliable(_DIR_PLUGIN_ARTY."images/bouton-arty.png",
		_T('arty:associer_un_bloc_libre'),
		false,
		$blocsdispos,
		'blocs_libres_dispos',
		'r');
		
	}
	
	// nouveau bloc
	$texte .= _T('arty:entrez_donnees_nouveau_bloc');
	$texte .= "<form action='".$url_retour."' method='post' enctype=\"multipart/form-data\">\n";
	$texte .= "<input type='hidden' name='action_form' value='nouveaubloc' />";
	$texte .= "<input type='text' class='forml' name='titre' value='"._T('arty:titre')."' onfocus='this.value=&#34;&#34;;' maxlength='255' size='20' />";
	$texte .= "<br /><textarea class='forml' name='texte' cols='20' rows='4'></textarea>";
	$texte .= "<br />"._T('arty:bloc_lien')."<br />";
	$texte .= "<input class='forml' type='text' name='lien' value='http://' maxlength='255' size='20' />";
	$texte .= "<br />"._T('arty:bloc_image')."<br />";
	$texte .= "<input type=\"file\" name=\"illu_bloc_libre\" size=\"10\" /><br />";

	if ($type == "rubrique" && $id == 0) {

		$leslangues_menu=explode(",",$GLOBALS['meta']['langues_utilisees']);
		$def = $GLOBALS['meta']['langue_site'];
		$texte .= "<br />"._T('arty:langue_bloc');
		$texte .= '<br /><select name="lang" class="forml">';

		foreach($leslangues_menu as $fullname) {
			$texte .= "<option value='$fullname' ".(($def==$fullname)?'selected="selected"':'').">".$GLOBALS['codes_langues'][$fullname]."</option>";
		}
		$texte .= "</select>";
	}

	$texte .= "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	$texte .= "</form>";
	
	$balancemoica .= cadre_depliable(_DIR_PLUGIN_ARTY."images/bouton-arty.png",
		_T('arty:creer_un_bloc_libre'),
		false,
		$texte,
		'creer_bloc_libre',
		'r');

	return $balancemoica;
}

// formulaire d'ajout/remplacement/suppression d'un bandeau à la rubrique
function formulaire_logo($id_groupe)
{
	$texte = "<p>"._T('arty:intro_up_logo')."</p>";
	traiter_suppression_logo($id_groupe);
	$message = _T(traiter_upload_image('logo','logo-groupe',$id_groupe));
	$texte .= ($message) ? "<p style=\"font-weight:bold;\">".$message."</p>" : "";

	$visible = false;

	$chem = creer_repertoire_documents("logo-groupe");
	$handle = @opendir($chem);
	while($fichier = @readdir($handle)) {
		if (ereg("^logo-$id_groupe\.(jpg|png|gif)$", $fichier)) {
			$logo = $fichier;
		}
	}
	if (!isset($logo)){
		$texte .= "<p>"._T("arty:aucun_logo_rub")."</p>";
	} else {
		$visible = true;
		$result = _T("arty:logo_actuel").":<br /><img width=\"190\" src=\""._DIR_IMG."logo-groupe/$logo?".uniqid(rand())."\" />"; // le nombre aléatoire permet d'éviter que le navigateur affiche la version en cache de l'image.
		$result .= "<p>[<a href=\"?exec=mots_type&id_groupe=$id_groupe&action=supprimer_logo&id_check=".$_SESSION['id_check']."\">"._T('arty:supprimer_logo')."</a>]</p>";
		$texte .= $result;
	}
	$texte .= "<form action=\"?exec=mots_type&amp;id_groupe=$id_groupe\" method=\"post\" enctype=\"multipart/form-data\">";
	$texte .= "<input type=\"file\" name=\"logo\" id=\"logo\" size=\"13\" /><br />";
	$texte .= "<div style=\"text-align:right;\"><input class=\"fondo\" name=\"filesubmit\" type=\"submit\" value=\""._T('arty:enregistrer')."\" /></div>";
	$texte .= "</form>";
	$data = debut_cadre_couleur("bouton-arty.png", true, "", _T('arty:titre_up_rub_logo'));
	$data .= block_parfois_visible("logo", _T("arty:invit_up_rub_logo"), $texte, '', $visible);
	$data .= fin_cadre_couleur(true);

	return $data;
}


function bloc_gabarit($type, $id, $url_retour)
{

	if (isset($_POST['action_form']) && isset($_POST['gabarit'])) {
		if($_POST['action_form'] == 'changer_gabarit' && trim($_POST['gabarit'])!="") {
			//on peut sauver
			spip_query("DELETE FROM spip_arty_gabaritassoc WHERE type='$type' AND id=$id");
			if ($_POST['gabarit'] !='gabarit_default') {
				spip_query("INSERT INTO spip_arty_gabaritassoc (gabarit, type, id) VALUES ('".addslashes(trim($_POST['gabarit']))."','$type',$id)");
			}
		}
	}

	$resultat = spip_query("SELECT * FROM spip_arty_gabaritassoc WHERE type='$type' AND id=$id");
	if (spip_mysql_count($resultat)) {
		$row=spip_fetch_array($resultat);
		$gabarit_actuel=$row['gabarit'];
	} else { $gabarit_actuel='gabarit_default'; }

	$ignore_liste = Array(".svn", ".", "..");
	$rep = _DIR_PLUGIN_ARTY."definitions-gabarits";
	$handle = opendir($rep);

	$balancemoica = debut_cadre_relief(_DIR_PLUGIN_ARTY."/images/bouton-arty.png", true, "", _T('arty:associer_un_gabarit'));
	$balancemoica .= _T('arty:intro_associer_gabarit')."<br /><br />";
	$balancemoica .= _T('arty:choisissez_un_gabarit').":<br />";
	$balancemoica .="<form action='$url_retour' method='post'>";

	$gabarits=array();
	$gabaritpardefaut=array("sommaire","rubrique","article");
	$ignore_liste=array(".","..",".DS_Store");
	$rep = _DIR_PLUGIN_ARTY."definitions-gabarits";
	$handle = opendir($rep);
	while($fichier = readdir($handle)) {

		if (!in_array($fichier, $ignore_liste) && eregi('^[a-zA-Z0-9_-]*\.xml$',$fichier)) {
			$p =& new xmlParser();
			$p->parse($rep.'/'.$fichier);
			if (!in_array(ereg_replace("\.xml$","",$fichier),$gabaritpardefaut)) {
				$gabarits[$p->output[0]['attrs']['TYPE']][] = ereg_replace("\.xml$","",$fichier);
			}
			$liste_gabarit[]=ereg_replace("\.xml$","",$fichier);
		}
	}

	//gabarits du dossier "pages-custom" (surclassage)
	$rep_custom = _DIR_RACINE."pages-custom/gabarits";
	if (file_exists($rep_custom)) {
		$handle = opendir($rep_custom);
		while($fichier = readdir($handle)) {
			if (!in_array($fichier, $ignore_liste) && eregi('^[a-zA-Z0-9_-]*\.xml$',$fichier) && !in_array($fichier, $liste_gabarit)) {
				$p =& new xmlParser();
				$p->parse($rep_custom.'/'.$fichier);
				$nom_gabarit = ereg_replace("\.xml$","",$fichier);
				$type_gabarit = $p->output[0]['attrs']['TYPE'];
				if (!in_array($nom_gabarit, $gabaritpardefaut) && !in_array($nom_gabarit, $gabarits[$type_gabarit])) {
					$gabarits[$type_gabarit][] = ereg_replace("\.xml$","",$fichier);
				}
				$liste_gabarit[] = ereg_replace("\.xml$","",$fichier);
			}
		}
	}
	//gabarits de la base de données
	$query = spip_query('SELECT * FROM spip_arty_gabarit_perso');
	while ($row = spip_fetch_array($query)) {
		if (!in_array($row['nom'], $liste_gabarit)) {
			$liste_gabarit[] = $row['nom'];
			$donnees = $row['type'];
			$gabarits[$donnees][] = $row['nom'];
		}
	}
	// faire le menu deroulant
	$leselect="";
	$leselect .="<select name='gabarit' class='forml'>";
	$leselect .="<option value='gabarit_default'>"._T('arty:gabarit_par_defaut')."</option>";
	foreach($gabarits as $nom => $typegabarit) {
		if ($type == $nom) {
			foreach($typegabarit as $cegabarit) {
				$leselect .="<option class='$type' value='$cegabarit' ".(($cegabarit ==$gabarit_actuel)?"selected='selected' " : "").">"._T("arty:$cegabarit")."</option>";
			}
		}
	}

	$leselect .="</select>";

	$balancemoica .= $leselect;
	 
	$balancemoica .="<input type='hidden' name='action_form' value='changer_gabarit' />";
	$balancemoica .= "<br /><input class='fondo' type='submit' value='"._T('arty:bouton_changer_gabarit')."' /><br />";
	$balancemoica .="</form>";

	// bouton de modification du gabarit + retour
	$balancemoica .= "<form action='?exec=gabarit&amp;gabarit=";
	if ($gabarit_actuel=="gabarit_default"){
		$balancemoica .= "$type";
	} else {
		$balancemoica .= "$gabarit_actuel";
	}
	$balancemoica .= "' method='post'>";
	$balancemoica .= "<input name='retour' value='$url_retour' type='hidden'>";
	$balancemoica .= "<br /><input class='fondo' type='submit' value='"._T('arty:editer_ce_gabarit')."' />";
	$balancemoica .= "</form>";
	$balancemoica .= fin_cadre_couleur(true);

	// formulaire de creation d'un gabarit à partir de la page
	$balancemoica .= debut_cadre_relief(_DIR_PLUGIN_ARTY."/images/bouton-arty.png", true, "", _T('arty:creer_gabarit_et_associer'));

	$balancemoica .= "<form action='".generer_url_ecrire('gabarit')."' method='post'>\n";
	$balancemoica .= "<input name='retour' value='$url_retour' type='hidden'>";
	$balancemoica .= "<p style='margin-top:0px; margin-bottom:2px;'>"._T("arty:deriver_gabarit")."</p>";
	$balancemoica .= "<input type='hidden' name='associer' value='". $id ."'/>";
	$balancemoica .= "<input type='hidden' name='action_form' value='deriver'/>";
	$balancemoica .= "<input type='text' name='nom_gabarit' value='"._T('arty:nom_du_gabarit')."' /><br />";

	$balancemoica .= "<p style='margin-top:8px; margin-bottom:2px;'>"._T("arty:baser_gabarit_sur")."</p>";
	$balancemoica .= "<select id='source' name='source' class='forml'>";

	foreach($gabaritpardefaut as $un_gabarit) {
		if ($un_gabarit == $type) {
			$balancemoica .= '<option name="'.$un_gabarit.'" value="'.$un_gabarit.'">'.$un_gabarit.'</option>';
		}
	}
	foreach($gabarits as $nom_type => $types_gabarits) {
		foreach($types_gabarits as $un_gabarit) {
			if ($nom_type == $type){
				$balancemoica .= '<option name="'.$un_gabarit.'" value="'.$un_gabarit.'">'.$un_gabarit.' '.$nom_type.'</option>';
			}
		}
	}
	$balancemoica .= "</select>";
	$balancemoica .= "<br /><div style='text-align: right;'><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' /></div>";
	$balancemoica .= "</form>";

	$balancemoica .= "</form>";



	$balancemoica .= fin_cadre_relief(true);

	closedir($handle);

	return $balancemoica;
}

function bloc_formulaire_themes($type, $id, $url_retour) {

	if (isset($_POST['action_form']) && isset($_POST['theme'])) {
		if($_POST['action_form'] == 'changer_theme' && trim($_POST['theme'])!="") {
			//print_r($_POST);
			//on peut sauver
			spip_query("DELETE FROM spip_arty_themeassoc WHERE type='$type' AND id=$id");
			if ($_POST['theme'] !='theme_default') {
				spip_query("INSERT INTO spip_arty_themeassoc (theme, type, id) VALUES ('".addslashes(trim($_POST['theme']))."','$type',$id)");
			}

		}
	}

	$resultat = spip_query("SELECT * FROM spip_arty_themeassoc WHERE type='$type' AND id=$id");
	if (spip_mysql_count($resultat)) {
		$row=spip_fetch_array($resultat);
		$theme=$row['theme'];
	} else { $theme='theme_default'; }

	$ignore_liste = Array(".svn", ".", "..",".DS_Store");
	$rep = _DIR_PLUGIN_ARTY."themes";
	$handle = opendir($rep);

	$balancemoica = debut_cadre_relief(_DIR_PLUGIN_ARTY."/images/bouton-arty.png", true, "", _T('arty:associer_un_theme'));
	$balancemoica .="<form action='$url_retour' method='post'>";
	$balancemoica .="<select name='theme' class='forml'>";
	$balancemoica .="<option value='theme_default'>"._T('arty:theme_par_defaut')."</option>";
	while($fichier = readdir($handle)) {

		if (in_array($fichier, $ignore_liste)) {
		} else if (is_dir($rep.'/'.$fichier)) {
			 
			if (file_exists($rep.'/'.$fichier.'/theme.xml')) {

				$p =& new xmlParser();
				$p->parse($rep.'/'.$fichier.'/theme.xml');
				//print_r($p->output);

				foreach($p->output[0]['child'] as $id => $tag) {
					if ($tag['name'] == "TITRE") {
						$balancemoica .="<option value='".$fichier."' ".(($fichier==$theme)?"selected='selected' ": '').">".$tag["content"]."</option>";
					}

					if ($tag['name'] == "DECLINAISON") {
						$balancemoica .="<option value='".$fichier."|".$tag["attrs"]["CHEMIN"]."' ".(($fichier."|".$tag["attrs"]["CHEMIN"]==$theme)?"selected='selected' ": '')."> - ".$tag["attrs"]["TITRE"]."</option>";
					}
						
				}
			}}}

			$balancemoica .="</select>";
			$balancemoica .="<input type='hidden' name='action_form' value='changer_theme' />";
			$balancemoica .= "<input class='fondo' type='submit' value='"._T('arty:bouton_changer_theme')."' />";
			$balancemoica .= fin_cadre_relief(true);
			$balancemoica .="</form>";

			closedir($handle);

			return $balancemoica;
}

// formulaire d'ajout/remplacement/suppression d'un bandeau à la rubrique
function formulaire_bandeau($id_rubrique)
{
	$texte = "<p>"._T('arty:intro_up_rub_bandeau')."</p>";

	//$message = _T(traiter_upload_bandeau($id_rubrique));
	//$texte .= ($message) ? "<p style=\"font-weight:bold;\">".$message."</p>" : "";

	$visible = false;

	$chem = creer_repertoire_documents("bandeau");
	$handle = @opendir($chem);
	while($fichier = @readdir($handle)) {
		if (ereg("^bandeau-$id_rubrique\.(jpg|png|gif)$", $fichier)) {
			$bandeau = $fichier;
		}
	}

	if (!$bandeau){
        # Formulaire à la mode CVT
		$contexte = array('id_rubrique'=>$id_rubrique,'largeurMax'=>186,'hauteurMax'=>186);
		$texte .= recuperer_fond('prive/upload_bandeau', $contexte);
	} else {
		# le nombre aléatoire permet d'éviter que le navigateur affiche la version en cache de l'image.
		$reducImg = image_reduire("<img src='"._DIR_IMG."bandeau/$bandeau?".uniqid(rand())."' alt='' class='miniature_logo' />", "186", "186");
		$texte .= "<div id='bandeau_icone' style='text-align:center'>".$reducImg;
		$request = "?exec=naviguer&amp;id_rubrique=".$id_rubrique."&amp;action=supprimer_bandeau&amp;id_check=".$_SESSION['id_check'];
		$AjAxtion = ajax_action_declencheur ($request, "bandeau_icone", $fct_ajax="");
		$texte .= "<p style=\"text-align:center\">&#91;<a href=\"javascript:void(0);\" onclick=".$AjAxtion.">"._T('lien_supprimer')."</a>&#93;</p>";
		$texte .= "</div>";
	}
	
	$visible = (($bandeau != "")?true:false);
	$bouton  = bouton_block_depliable(_T("arty:titre_up_rub_bandeau"), $visible, "bandeau");
	$data  = debut_cadre('r', _DIR_PLUGIN_ARTY."images/bouton-arty.png", '', $bouton, '', '', false);
	$data .= debut_block_depliable($visible, "bandeau")."<div class='cadre_padding'>".$texte."</div>".fin_block();
	$data .= fin_cadre_relief(true);
	return $data;

}

?>