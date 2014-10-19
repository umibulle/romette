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

include_spip('inc/xml-parser');

if (!defined("_ECRIRE_INC_VERSION")) return;
include_spip('inc/presentation');
include_spip('inc/filtres_images_mini');


function exec_theme() {

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('arty:choix_du_theme').' &raquo;', 'configuration', 'magusine');
	
	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
		echo "<p><b>"._T('arty:acces_a_la_page')."</b></p>";
		fin_page();
		exit;
	}

	traiter_post();
	$params= charger_parametres_gen();

	echo barre_onglets("arty", "theme");
	echo debut_gauche('', true);
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:info'));
	echo _T("arty:sideinfo_theme");
	echo fin_cadre_relief(true);
	echo lister_associations();
	echo creer_colonne_droite('', true);
	echo debut_droite('', true);
	echo gros_titre(_T("arty:choix_du_theme"), "", false);

	//liste des themes disponibles
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."/images/config.png", true, "", _T('arty:choixtheme'));
	listage_themes();
	echo fin_cadre_trait_couleur(true);

	echo "<br />";
	// suite : footer, metas, 404

	// affiche le formulaire d'upload du bandeau


	formulaire_bandeau();

	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/format-indent-more.png", true, "", _T('arty:footer'));
	echo _T('arty:votre_message_de_footer');
	echo "<form action='".generer_url_ecrire('theme')."' method='post'>\n";
	if (!in_array("footer", array_keys($params))) { $params['footer']=""; }
	echo "<textarea name='footer' cols='50' rows='3'>".htmlspecialchars($params['footer'])."</textarea>";

	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);



	echo "<br />";
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/format-indent-more.png", true, "", _T('arty:logos_bailleurs'));
	echo _T('arty:intro_afficher_logos_bailleurs');
	echo "<form action='".generer_url_ecrire('theme')."' method='post'>\n";
	if (!in_array("logos_bailleurs", array_keys($params))) { $params['logos_bailleurs']="true"; }
	echo "<input type='radio' name='logos_bailleurs' value='true' ".($params['logos_bailleurs'] == "true" ? 'checked="checked"' : '')." />";
	echo _T('arty:afficher_logos')."<br />";
	echo "<input type='radio' name='logos_bailleurs' value='false' ".($params['logos_bailleurs'] == "true" ? '' : 'checked="checked"')." />";
	echo _T('arty:ne_pas_afficher_logos')."<br />";
	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);
	echo "<br />";

	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/format-indent-more.png", true, "", _T('arty:metas'));
	echo _T('arty:vos_metas');
	echo "<form action='".generer_url_ecrire('theme')."' method='post'>\n";
	echo "<input type='hidden' name='action_form' value='metas' />";

	echo "<div id='metas'>";
	if (!count($params['metas'])) {
		$id_meta = uniqid("");
		echo "<table class='meta' id='meta$id_meta'>";
		echo "<tr><td><label for='metatype$id_meta' class='label_meta'>"._T('arty:type_meta')."</label></td>";
		echo "<td><input type='text' size='15' id='metatype$id_meta' name='metas[$id_meta][type]' /></td></tr>";
		echo "<tr><td><label for='metavaleur$id_meta' class='label_meta'>"._T('arty:valeur_meta')."</label></td>";
		echo "<td><input type='text' size='40' id='metavaleur$id_meta' name='metas[$id_meta][valeur]' />";
		echo "<a href='javascript:supprimerMeta(\"$id_meta\");'><img style='padding:3px;' src='"._DIR_IMG_PACK."/croix-rouge.gif' title='"._T('arty:supprimer')."' alt='x' /></a>";
		echo "</td></tr></table>";
	} else {
		foreach($params['metas'] as $meta) {
			$id_meta = uniqid("");
			echo "<table class='meta' id='meta$id_meta'>";
			echo "<tr><td><label for='metatype$id_meta' class='label_meta'>"._T('arty:type_meta')."</label></td>";
			echo "<td><input type='text' size='15' id='metatype$id_meta' name='metas[$id_meta][type]' value='".$meta['type']."' /></td></tr>";
			echo "<tr><td><label for='metavaleur$id_meta' class='label_meta'>"._T('arty:valeur_meta')."</label></td>";
			echo "<td><input type='text' size='40' id='metavaleur$id_meta' name='metas[$id_meta][valeur]' value='".$meta['valeur']."' />";
			echo "<a href='javascript:supprimerMeta(\"$id_meta\");'><img style='padding:3px;' src='"._DIR_IMG_PACK."/croix-rouge.gif' title='"._T('arty:supprimer')."' alt='x' /></a>";
			echo "</td></tr></table>";
		}
	}
	echo "</div>";

	echo "<a href='javascript:ajouterMeta()'>"._T('arty:ajouter_meta')."</a>";

	echo "<script language='javascript'>";
	echo "function ajouterMeta(){
    ran = Math.floor(Math.random()*100000000);
    jQuery('#metas').append(\"";
	echo "<table class='meta' id='meta\"+ran+\"'>";
	echo "<tr><td><label for='metatype\"+ran+\"' class='label_meta'>"._T('arty:type_meta')."</label></td>";
	echo "<td><input id='metatype\"+ran+\"' type='text' size='15' name='metas[\"+ran+\"][type]' /></td></tr>";
	echo "<tr><td><label for='metavaleur\"+ran+\"' class='label_meta'>"._T('arty:valeur_meta')."</label></td>";
	echo "<td><input id='metavaleur\"+ran+\"' type='text' size='40' name='metas[\"+ran+\"][valeur]' />";
	echo "<a href=\\\"javascript:supprimerMeta('\"+ran+\"');\\\"><img style='padding:3px;' src='"._DIR_IMG_PACK."/croix-rouge.gif' title='"._T('arty:supprimer')."' alt='x' /></a>";
	echo "</td></tr></table>";
	echo "\"
    );
  }";
	echo "</script>";

	echo "<script language='javascript'>";
	echo "function supprimerMeta(meta) {
    jQuery('#meta'+meta).remove();
  }";
	echo "</script>";
	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);
	
	echo "<br />";
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/emblem-important.png", true, "", _T('arty:page_404'));
	echo _T('arty:votre_message_page_404');
	echo "<form action='".generer_url_ecrire('theme')."' method='post'>\n";

	$resultat= spip_query("SELECT * FROM spip_arty_parametres WHERE parametre='404'");
	if ($resultat) {
		$le404=spip_fetch_array($resultat);
		//print_r($le404);
	} else {
		$le404['valeur']="";
		$le404['valeur2']="";

	}

	echo "<input type='hidden' name='action_form' value='404' />";
	echo "<input type='text' name='titre404' value='".htmlspecialchars($le404['valeur'])."' />";
	echo "<textarea name='texte404' cols='50' rows='3'>".htmlspecialchars($le404['valeur2'])."</textarea>";
	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);

	echo fin_gauche();

	echo fin_page();

}


//liste des thèmes dans le répertoire theme
function listage_themes()
{

	$params= charger_parametres();
	$ignore_liste = Array(".svn", ".", "..",".DS_Store");
	$rep = _DIR_PLUGIN_ARTY."themes";

	// affiche le theme courant
	echo "<div class='theme-actuel'><h4>"._T("arty:theme_actuel")."</h4>";
	$letheme = explode("|", $params);
	if (file_exists($rep.'/'.$letheme[0].'/theme.xml')) {
		$p =& new xmlParser();
		$p->parse($rep.'/'.$letheme[0].'/theme.xml');
		if (file_exists($rep.'/'.$letheme[0].'/illu-theme.jpg')) {
			$vignette = "<img src=".$rep.'/'.$letheme[0].'/illu-theme.jpg'." class='vignette-theme' />";
		}
		$descrip = $p->output[0]['child'][1]['content'];
		foreach($p->output[0]['child'] as $prop) {
			if ($prop['name'] == "TITRE") {
				$titre_theme = $prop['content'];
			}
		}
		if (count($letheme) > 1) {
			$nom_decli = ereg_replace("\.css$", "", $letheme[1]);
			if (file_exists($rep.'/'.$letheme[0].'/declinaisons/illu-theme-'.$nom_decli.'.jpg')) {
				$vignette = "<img src=".$rep.'/'.$letheme[0].'/declinaisons/illu-theme-'.$nom_decli.'.jpg'." class='vignette-theme' />";
			}
			foreach($p->output[0]['child'] as $prop) {
				if ($prop['name'] == "DECLINAISON") {
					 
					if($prop['attrs']['CHEMIN'] == $letheme[1]) {
						$titre_declinaison = " ("._T("arty:en_declinaison")." ".$prop['attrs']['TITRE']." )";
						// recherche de la description
						foreach($prop['child'] as $num => $propdescr) {
							if ($propdescr['name'] == "DESCRIPTION") {
								$descrip = $propdescr['content'];
							}
						}
							
					}
					 
				}
			}
		}
		if (!isset($titre_declinaison) && count($letheme) > 1) {
			$titre_declinaison = " ("._T("arty:en_declinaison")." ".$letheme[1]." )";
		}
	}
	echo "<h5>";
	echo isset($titre_theme) ? $titre_theme : $letheme[0];
	echo isset($titre_declinaison) ? $titre_declinaison : '' ;
	echo "</h5>";
	echo isset($vignette) ? $vignette : '';
	echo isset($descrip) ? $descrip : '';
	echo "<div class='clearer'></div></div>";



	$ignore_liste = Array(".svn", ".", "..",".DS_Store");
	$rep = _DIR_PLUGIN_ARTY."themes";
	$handle = opendir($rep);
	print('<form action="?exec=theme" method="post">');
	while($fichier = readdir($handle)) {

		if (in_array($fichier, $ignore_liste)) {
		} else if (is_dir($rep.'/'.$fichier)) {

			 
			if (file_exists($rep.'/'.$fichier.'/theme.xml')) {
				 
				 
				$p =& new xmlParser();
				$p->parse($rep.'/'.$fichier.'/theme.xml');

				//print_r($p->output);

				echo "<div class='conteneur-theme'>\n";

				// vignette des themes
				if (file_exists($rep.'/'.$fichier.'/illu-theme.jpg')) {
					$vignette =$rep.'/'.$fichier.'/illu-theme.jpg';
				} else { $vignette=_T("arty:pas_de_vignette"); }

				foreach($p->output[0]['child'] as $id => $tag) {
					if ($tag['name'] == "TITRE") {
						echo '<h5 class="theme_deplier" rel="'.$vignette.'">'.$tag["content"].'</h5>';
						echo "\n";
						echo "<div class=\"liste-declinaison\">";
						echo "\n";
						echo '<input id="'.$fichier.'" type="radio" '.(($params==$fichier)?'checked="checked"':'').' name="theme" value="'.$fichier.'"'.' class="declinaison" />';
						echo '<label for="'.$fichier.'"  >'._T("arty:theme_base").'</label><br />';
						echo "\n";
					}

					if ($tag['name'] == "DECLINAISON") {
						echo '<input id="'.$fichier.$id.'" type="radio" '.(($params==$fichier."|".$tag["attrs"]["CHEMIN"])?'checked="checked"':'').' name="theme" value="'.$fichier."|".$tag["attrs"]["CHEMIN"].'"'.$checked.' class="declinaison" />';
						echo '<label for="'.$fichier.$id.'">'.$tag["attrs"]["TITRE"].'</label><br />';
						echo "\n";
					}

				}
				echo "</div>\n";

			}
			echo "</div>\n";
		}

	}
	echo '<br />';
	//echo '<input type="hidden" name="action" value="changer_theme_principal" />';
	echo '<input class="fondo" type="submit" value="'._T('arty:bouton_changer_theme').'" />';
	print("</form>");
	closedir($handle);
}

function traiter_post() {

	if ($_POST['footer']) {

		if ($_POST['footer']==""){
			spip_query("DELETE FROM spip_arty_parametres WHERE parametre = 'footer'");
		}

		$value=addslashes($_POST['footer']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre='footer'");
		if (spip_mysql_count($resultat)) {
			spip_query("UPDATE spip_arty_parametres SET valeur= '$value' WHERE parametre = 'footer'");
		} else {
			spip_query("INSERT INTO spip_arty_parametres(parametre, valeur) VALUES('footer', '$value')");
		}

	}
	if ($_POST['action_form']=="404") {
		$titre=addslashes($_POST['titre404']);
		$texte=addslashes($_POST['texte404']);
		if ($titre=="" && $texte=="") {
			spip_query("DELETE FROM spip_arty_parametres WHERE parametre='404'");
		} else {
			spip_query("INSERT INTO spip_arty_parametres(parametre, valeur, valeur2) VALUES('404', '$titre', '$texte')");
			spip_query("UPDATE spip_arty_parametres SET valeur= '$titre', valeur2='$texte' WHERE parametre = '404'");
		}
	}

	if ($_POST['action_form']=="metas") {
		spip_query("DELETE FROM spip_arty_parametres WHERE parametre LIKE '%metas'");
		$metas = $_POST['metas'];
		if (is_array($metas)) {
			$i = 0;
			foreach($metas as $meta) {
				if ($meta['type'] && $meta['valeur']) {
					$meta['valeur']=htmlspecialchars($meta['valeur'], ENT_QUOTES);
					$meta['type']=htmlspecialchars($meta['type'], ENT_QUOTES);
					spip_query("INSERT INTO spip_arty_parametres (parametre, valeur, valeur2) VALUES ('".$i."metas', '".$meta['type']."', '".$meta['valeur']."')");
					$i++;
				}
			}
		}
	}

	foreach($_POST as $key => $value) {
		if ($key=='theme') {
			$value=addslashes($value);
			$resultat=spip_query("SELECT * FROM spip_arty_themeassoc WHERE id=0 AND type='rubrique'");
			if (spip_mysql_count($resultat)) {
				spip_query("UPDATE spip_arty_themeassoc SET theme= '$value' WHERE id=0 AND type='rubrique'");
			} else {
				spip_query("INSERT INTO spip_arty_themeassoc(id, type, theme) VALUES(0, 'rubrique', '$value')");
			}
		}

		if ($key == 'bloc_reseau' || $key == 'logos_bailleurs') {
			$value = addslashes($value);
			$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre='$key'");
			if (spip_mysql_count($resultat)) {
				spip_query("UPDATE spip_arty_parametres SET valeur = '$value' WHERE parametre='$key'");
			} else {
				spip_query("INSERT INTO spip_arty_parametres(parametre, valeur) VALUES ('$key', '$value')");
			}
		}

	}
}

function charger_parametres() {
	$resultat= spip_query("SELECT * FROM spip_arty_themeassoc WHERE id=0 AND type='rubrique'");
	if (spip_mysql_count($resultat)) {
		while ($row=spip_fetch_array($resultat)) {
			$theme = $row['theme'];
		}
	} else {
		$theme = "";
	}

	return $theme;
}

function charger_parametres_gen() {
	$params=array();
	$resultat= spip_query("SELECT * FROM spip_arty_parametres");
	if (spip_mysql_count($resultat)) {
		while ($row=spip_fetch_array($resultat)) {
			if (ereg("metas$",$row['parametre'])) {
				$params["metas"][] = array("type" => $row['valeur'], "valeur" => $row['valeur2']);
			} else {
				$params[$row['parametre']] = $row['valeur'];
			}
		}
	}
	return $params;
}

function formulaire_bandeau()
{
    echo "<div id=\"div_upload_bandeau\">";
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."/images/uploadbandeau.png", true, "", _T('arty:titre_upload_bandeau'));
	echo "<p>"._T('arty:intro_upload_bandeau')."</p>";

	$bandeau_site = array(_DIR_IMG."/bandeau/bandeau-0.jpg",
	                      _DIR_IMG."/bandeau/bandeau-0.png",
	                      _DIR_IMG."/bandeau/bandeau-0.gif"
	                      ); 
	
	foreach($bandeau_site as $filePath)
	{
		if (file_exists($filePath) )
		{
	        $bandeau_actuel = $filePath;
	    }        
	}
	
	if($bandeau_actuel )
	{
	    list($rWidth, $rHeight, $rType, $rAttr) = getimagesize($bandeau_actuel);
		$ratioImg = image_ratio($rWidth,$rHeight,350,250);
		
		echo "<div style=\"text-align:center\">";
		echo "<img src=\"".$bandeau_actuel."\" alt=\"\" width=\"".$ratioImg[0]."\" height=\"".$ratioImg[1]."\" /><br/>";
		echo "&#91;<a href=\"javascript:void(0);\" onclick=\"return AjaxSqueeze('./?exec=theme&amp;id_rubrique=0&amp;action=supprimer_bandeau&amp;id_check=".$_SESSION["id_check"]."','bandeau_icone','',event);\">"._T("lien_supprimer")."</a>&#93;";
	    echo "</div>";
		
	}else{
	    # Formulaire à la mode CVT
	    $contexte = array('id_rubrique'=>0,'largeurMax'=>350,'hauteurMax'=>250);
	    echo recuperer_fond('prive/upload_bandeau', $contexte);
	}
	
	echo fin_cadre_trait_couleur(true);
	echo "</div>";
}

function lister_associations()
{

	if ($_GET['action'] == 'delete_assoc' && $_GET['id_check'] == $_SESSION['id_check']) {
		$type = isset($_GET['type']) ? addslashes($_GET['type']) : false;
		$id = isset($_GET['id']) ? (int) $_GET['id'] : false;
		$theme = isset($_GET['theme']) ? addslashes($_GET['theme']) : false;
		if ($type && $id && $theme) {
			spip_query("DELETE FROM spip_arty_themeassoc WHERE type='$type' AND id=$id AND theme='$theme'");
		}
	}

	echo "<div id=\"div_liste_assoc\">";
	$result = spip_query("SELECT * FROM spip_arty_themeassoc WHERE type!='rubrique' OR id!=0");
	if (spip_mysql_count($result) > 0) {
		echo debut_cadre_couleur("doc-24.gif", true, "", _T('arty:liste_assoc'));
		echo "<div class='liste'><table border='0' cellspacing='0' cellpadding='3' width='100%'>";
		while ($row = spip_fetch_array($result)){
			echo "<tr class='tr_liste'>";
			$type = $row['type'];
			$id = $row['id'];
			switch ($type) {
				case "rubrique":
					$rubrique = spip_fetch_array(spip_query("SELECT titre FROM spip_rubriques WHERE id_rubrique=$id"));
					$titre = $rubrique['titre'];
					break;

				case "article":
					$article = spip_fetch_array(spip_query("SELECT titre FROM spip_articles WHERE id_article=$id"));
					$titre = $article['titre'];
					break;

				case "groupe":
					$groupe = spip_fetch_array(spip_query("SELECT titre FROM spip_groupes_mots WHERE id_groupe=$id"));
					$titre = $groupe['titre'];
					break;

				case "mot":
					$mot = spip_fetch_array(spip_query("SELECT titre FROM spip_mots WHERE id_mot=$id"));
					$titre = $mot['titre'];
					break;
			}

			$theme = $row['theme'];
			$nom_theme = ereg_replace("\|", " (", $theme);
			$nom_theme = ereg_replace("\.css", ")", $nom_theme);
			echo "<td class=\"arial1\">$titre</td>";
			echo "<td class=\"arial1\">$nom_theme</td>";
			echo "<td class=\"arial1\"><div style='text-align:right;'><a class=\"supprimer\" href='".generer_url_ecrire('theme')."&amp;action=delete_assoc&amp;id_check=".$_SESSION['id_check']."&amp;id=$id&amp;theme=$theme&amp;type=$type'><img src='../dist/images/croix-rouge.gif' alt='X' width='7' height='7' align='bottom' /></a></div></td>";
			echo "</tr>";
		}
		echo "</table></div>";
		echo fin_cadre_couleur(true);
	}
	echo "</div>";
}

?>
