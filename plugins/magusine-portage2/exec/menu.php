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

include_spip('inc/arty_selecteur');

function exec_menu() {

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('arty:titre_options_menu').' &raquo;', 'configuration', 'magusine');

	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
		echo "<p><b>"._T('arty:acces_a_la_page')."</b></p>";
		fin_page();
		exit;
	}

	if ($_GET['mode'] == "sauver") {
		$types = array(
      "r" => "rubrique",
      "a" => "article",
      "g" => "groupe",
      "m" => "mot",
		);

		$langue_menu=$_GET['langue_menu'];
		print_r($_POST);
		print_r($_GET);
		if ($_GET['niveaux'] == "flat") {
			$valeurs_menu = array();
			if (isset($_POST['selection'])) {
				foreach($_POST['selection'] as $num => $element) {
					$morceaux = array();
					if ($element{0} == "l") {
						$element=transcode($element);
						if (eregi("^l([0-9]+)\|(.*)\|(.*)", $element, $morceaux)) {
							$type = "lien";
							$id = $morceaux[1];
							$nom = $morceaux[2];
							$url = $morceaux[3];
							$num = (int) $num;
							$valeurs_menu[] = "($num, '$type', $id, '$langue_menu', '$nom', '$url', 0)";
						}
					} else if (eregi("^(r|a|g|m)([0-9]+)$", $element, $morceaux)) {
						$type = $types[$morceaux[1]];
						$id = (int) $morceaux[2];
						$num = (int) $num;
						// ici ajout de la langue
						$valeurs_menu[] = "($num, '$type', $id, '$langue_menu', '', '', 0)";
					}
				}
			}
			spip_query("DELETE FROM spip_arty_menu WHERE langue='$langue_menu'");
			if (count($valeurs_menu)) {
				$query = "INSERT INTO spip_arty_menu (ordre, type, id, langue, nom, url, id_parent) VALUES ".implode(", ", $valeurs_menu);
				spip_query($query);
			}
			//die;
			echo _T("arty:le_changement_a_ete_effectue");
			return false;

		} else if ($_GET['niveaux'] == "nested") {
			$arty_cpt_lien = 0;
			$valeurs_menu = array();
			if (isset($_POST['selection'])) {

				foreach($_POST['selection'] as $num => $element) {
					$morceaux = array();
					if ($element['id']{0} == "l") {
							
						$element['id']=transcode($element['id']);
						echo "elem =-".$element['id']."----\n";
						if (ereg("^l([0-9]+)\|(.*)\|(.*)", $element['id'], $morceaux)) {
							$type = "lien";
							$id = $morceaux[1];
							$nom = $morceaux[2];
							$url = $morceaux[3];
							$num = (int) $num;
							$valeurs_menu[] = "($num, '$type', $id, '$langue_menu', '$nom', '$url', 0, '')";
							$arty_cpt_lien++;
						}
					} else if (eregi("^(r|a|g|m)([0-9]+)$", $element['id'], $morceaux)) {
						$type = $types[$morceaux[1]];
						$id = (int) $morceaux[2];
						$num = (int) $num;
						// ici ajout de la langue
						$valeurs_menu[] = "($num, '$type', $id, '$langue_menu', '', '', 0, '')";
					}
					// sous_niveaux
					$enfants = isset($element['children']) ? $element['children'] : false;
					if (is_array($enfants) && isset($id) && isset($type)) {
						$retour = valeursNiveauxR($enfants, $id, $type, $arty_cpt_lien);
						$arty_cpt_lien = $retour[1];
						$valeurs_menu = array_merge($valeurs_menu, $retour[0]);
					}
				}
			}

			spip_query("DELETE FROM spip_arty_menu WHERE langue='$langue_menu'");
			if (count($valeurs_menu)) {
				echo "INSERT INTO spip_arty_menu (ordre, type, id, langue, nom, url, id_parent, type_parent) VALUES ".implode(", ", $valeurs_menu);
				$query = "INSERT INTO spip_arty_menu (ordre, type, id, langue, nom, url, id_parent, type_parent) VALUES ".implode(", ", $valeurs_menu);
				spip_query($query);
			}
			//die;

			echo _T("arty:le_changement_a_ete_effectue");
			return false;

		}
	}

	traiter_post();

	echo barre_onglets("arty", "menu");
	echo debut_gauche("", true);
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:choix_de_la_langue_menu'));
	// selection de la langue du menu
	// recupérer dans le get
	//print_r($GLOBALS['codes_langues']);
	$langue_menu= $_GET['langue_menu'];
	$leslangues_menu=explode(",",$GLOBALS['meta']['langues_utilisees']);

	// par defaut ou si la langue passee n'est pas dans la liste: celle de la langue du site
	//print_r($leslangues_menu);
	if ($langue_menu=="" or !in_array($langue_menu, $leslangues_menu)) {
		$langue_menu=$GLOBALS['meta']['langue_site'];
	}
	echo "<p>"._T("arty:si_pas_langue")."</p>";
	echo "<form action='".generer_url_ecrire("menu")."' method='get'>";
	echo '<select name="langue_menu" onchange="window.location.href=\'?exec=menu&amp;langue_menu=\'+this.options[this.selectedIndex].value;">';


	foreach($leslangues_menu as $fullname) {
		echo "<option value='$fullname' ".(($langue_menu==$fullname)?'selected="selected"':'').">".$GLOBALS['codes_langues'][$fullname]."</option>";
	}
	echo "</select>";

	echo "</form>";

	// choix des niveaux du menu
	echo "<br /><p>"._T("arty:nombre_niveaux_menu")."</p>";


	$resultat= spip_query("SELECT * FROM spip_arty_parametres WHERE parametre ='".$fullname."config_niveaux_menu'");
	$resultat=spip_fetch_array($resultat);
	//print_r($_POST);
	//print_r($resultat);
	if($resultat) {
		$niveaux=$resultat['valeur'];
		$langue=$resultat['valeur2'];
		$lister_articles=$resultat['valeur3'];
	} else {
		$niveaux=1;
		$langue=$GLOBALS['meta']['langue_site'];
	}

	echo "<form action='".generer_url_ecrire('menu')."' method='post'>\n";
	echo "<input type='hidden' name='action_form' value='config_niveaux_menu' />";
	echo "<input type='hidden' name='langue' value='$langue_menu' />";
	echo "<p>"._T("arty:intro_niveaux_menu")."</p>";
	echo "<br /><p>"._T("arty:intro_choix_niveaux")."</p>";
	echo "<input id='niv1' type='radio' name='niveaux' value='1' ".(($niveaux=="1")?'checked="checked"':'')."> <label for='niv1'>"._T("arty:un_niveau")."</label><br />";
	echo "<input id='niv2' type='radio' name='niveaux' value='2' ".(($niveaux=="2")?'checked="checked"':'')."> <label for='niv2'>"._T("arty:deux_niveaux")."</label><br />";
	echo "<input id='nivn' type='radio' name='niveaux' value='n' ".(($niveaux=="n")?'checked="checked"':'')."> <label for='nivn'>"._T("arty:n_niveaux")."</label><br />";
	echo "<br /><p>"._T("arty:intro_menu_manuel")."</p>";
	echo "<input id='manuel' type='radio' name='niveaux' value='manuel' ".(($niveaux=="manuel")?'checked="checked"':'')."> <label for='manuel'>"._T("arty:manuel")."</label><br />";

	echo "<br /><p>"._T("arty:intro_lister_articles")."</p>";
	echo "<input id='lister_articles' type='checkbox' name='lister_articles' ".(($lister_articles=='on')?'checked="checked"':'')."> <label for='lister_articles'>"._T("arty:lister_articles")."</label><br />";

	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";

	echo "</form>";

	echo fin_cadre_relief(true);

	echo debut_droite("", true);
	echo gros_titre(_T("arty:titre_options_menu"), "", false);
	echo "<p class='intro'>"._T("arty:intro_menu")."</p>";

	echo "<p class='titre' style='font-weight:bold;'>"._T("arty:menu_actuel")." : ".$GLOBALS['codes_langues'][$langue_menu]."</p>";

	$noms_type_menu = array(
    '1'      => 'arty:un_niveau',
    '2'      => 'arty:deux_niveaux',
    'n'      => 'arty:n_niveaux',
    'manuel' => 'arty:manuel',
	);

	echo "<p class='titre' style='font-weight:bold;'>"._T('arty:type_de_menu')." : "._T($noms_type_menu[$niveaux])."</p>";

	$tables_spip = array(
    'rubrique' => array(
        "table" => "spip_rubriques",
        "colonne_id" => "id_rubrique",
	),
    'article' => array(
        "table" => "spip_articles",
        "colonne_id" => "id_article",
	),
    'groupe' => array(
        "table" => "spip_groupes_mots",
        "colonne_id" => "id_groupe",
	),
    'mot' => array(
        "table" => "spip_mots",
        "colonne_id" => "id_mot",
	),
	);

	//echo "test";

	echo '
    <script type="text/javascript">
    var traductions = new Object();
    traductions["rubrique"] = "'._T('arty:rubrique').'";
    traductions["article"] = "'._T('arty:article').'";
    traductions["groupe"] = "'._T('arty:groupe').'";
    traductions["mot"] = "'._T('arty:mot').'";   
    </script>
    ';  

	if ($niveaux != "manuel") {

		echo '
    <script type="text/javascript">
    var type_sortable = "flat";  
    </script>
    ';

		echo '
    <ul id="selection">
    ';

		$result = spip_query("SELECT * FROM spip_arty_menu WHERE id_parent = 0 AND langue='$langue_menu' ORDER BY ordre ASC");
		if (!spip_mysql_count($result)){
			$aucun_menu = true;
		}
		while ($row = spip_fetch_array($result)) {
			if ($row['type'] != 'lien') {
				$result2 = spip_query("SELECT titre FROM ".$tables_spip[$row['type']]['table']." WHERE ".$tables_spip[$row['type']]['colonne_id']." = ".$row['id']);
				if (spip_mysql_count($result2)) {
					$row2 = spip_fetch_array($result2);
					echo '<li id="'.substr($row['type'], 0, 1).$row['id'].'" class="sortable">';
					echo $row2["titre"];
					echo " <span class='url_petit'>("._T('arty:'.$row['type']).")</span>";
					echo ' <a href="javascript:supprimer(\'#'.substr($row['type'], 0, 1).$row['id'].'\')">x</a>';
					echo "</li>";
				} else {
					spip_query("DELETE FROM spip_arty_menu WHERE id_menu = ".$row["id_menu"]);
				}
			} else {
					
				echo '<li id="l'.$row['id'].'|'.transcodeinv($row['nom']).'|'.transcodeinv($row['url']).'" class="sortable">';
				echo $row["nom"];

				echo " <span class='url_petit'>(".$row["url"].")</span>";
				echo ' <a href="javascript:supprimer_lien(\'l'.$row['id']
				.'|'.transcodeinv($row['nom']).'|'
				. transcodeinv($row['url'])
				.'\')">x</a>';
				echo "</li>";
			}
		}

		echo '</ul>';

	} else if ($niveaux == "manuel") {

		echo '
    <script type="text/javascript">
    var type_sortable = "nested";
    </script>
    ';

		echo '
    <ul id="selection">';
		$result = spip_query("SELECT * FROM spip_arty_menu WHERE id_parent = 0 AND type_parent = '' AND langue='$langue_menu' ORDER BY ordre ASC");
		if (!spip_mysql_count($result)){
			$aucun_menu = true;
		}
		while ($row = spip_fetch_array($result)) {
			if ($row['type'] != 'lien') {
				$result2 = spip_query("SELECT titre FROM ".$tables_spip[$row['type']]['table']." WHERE ".$tables_spip[$row['type']]['colonne_id']." = ".$row['id']);
				if (spip_mysql_count($result2)) {
					$row2 = spip_fetch_array($result2);
					echo '<li id="'.substr($row['type'], 0, 1).$row['id'].'" class="sortable">';
					echo $row2["titre"];
					echo " <span class='url_petit'>("._T('arty:'.$row['type']).")</span>";
					echo ' <a href="javascript:supprimer(\'#'.substr($row['type'], 0, 1).$row['id'].'\')">x</a>';

					afficherNiveauxR($row['id'], $row['type'], $langue_menu);

					echo "</li>";
				} else {
					spip_query("DELETE FROM spip_arty_menu WHERE id_menu = ".$row["id_menu"]);
				}
			} else {

				$row['id']=transcodeinv($row['id']);
				echo '<li id="l'.$row['id'].'|'.transcodeinv($row['nom']).'|'.transcodeinv($row['url']).'" class="sortable">';

				echo $row["nom"];
				echo " <span class='url_petit'>(".$row["url"].")</span>";
				echo ' <a href="javascript:supprimer_lien(\'l'.$row['id'].'|'.transcodeinv($row['nom']).'|'.transcodeinv($row['url']).'\')">x</a>';

				afficherNiveauxR($row['id'], $row['type'], $langue_menu);

				echo "</li>";
			}
		}
		echo '</ul>';

	}

	if (isset($aucun_menu)){
		echo '
    <script type="text/javascript">
      var type_sortable = "aucun";
    </script>
    ';
		echo '<p id="avis_menu_auto">'._T('arty:avis_menu_auto').'</p>';
	}

	echo "<div id='bloc_sauver'>";
	echo "<img src='"._DIR_IMG_PACK."searching.gif' id='search' style='visibility:hidden' />";
	echo '<a href="javascript:sauver(\''.$langue_menu.'\');">sauver</a>';
	echo "<div id='reponse'></div>";
	echo "</div>";

	echo "<p class='titre' style='font-weight:bold;'>"._T("arty:menu_reservoir").":</p>";

	$args = array(
    "exec" => "menu",
    "ajouter" => "menu",
	);
	afficher_selecteur($args);
	afficher_selecteur_mots($args);

	// ajout d'une url
	echo "<form><div id='ajout_lien'><div id='ajout_lien_contenu'>";
	echo "<p>"._T("arty:ajouter_un_lien").":</p>";
	echo "<label for='nom_lien'>"._T("arty:nom_lien")."</label>";
	echo "<input id='nom_lien' type='text' size='30' name='nom' />";
	echo "<br />";
	echo "<label for='url_lien'>"._T("arty:url_lien")."</label>";
	echo "<input id='url_lien' type='text' size='53' name='url' />";
	echo "<br />";
	echo "<a href='javascript:ajouter_lien()'>"._T('arty:ajouter_ce_lien')."</a>";
	echo "</div></div>";
	echo "</form>";

	echo fin_gauche();
	echo fin_page();

}

function transcode($chaine){
	// dehacke le probleme du hash sur les lien et apostrophes
	$base = array("tttirrr", "aaapooo", "ggguiii");	$transcode = array("-", "'", "\"");
	$chaine = addslashes(str_replace($base, $transcode, $chaine));
	return $chaine;
}

function transcodeinv($chaine){
	// dehacke le probleme du hash sur les lien et apostrophes
	$base = array("-", "'", "\"");
	$transcode = array("tttirrr", "aaapooo", "ggguiii");	$chaine = str_replace($base, $transcode, $chaine);
	return $chaine;
}

function traiter_post() {
	//print_r($_POST);

	if($_POST['action_form'] == 'config_niveaux_menu') {
		$niveaux = addslashes($_POST['niveaux']);
		$langue = addslashes($_POST['langue']);
		$lister_articles=addslashes($_POST['lister_articles']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = '".$langue."config_niveaux_menu'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre, valeur, valeur2, valeur3) VALUES ('".$langue."config_niveaux_menu' ,'$niveaux', '$langue', '$lister_articles')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur= '$niveaux', valeur2='$langue', valeur3='$lister_articles' WHERE parametre = '".$langue."config_niveaux_menu'");
		}
	}
}

function valeursNiveauxR($elements, $id_parent, $type_parent, $arty_cpt_lien)
{
	$types = array(
    "r" => "rubrique",
    "a" => "article",
    "g" => "groupe",
    "m" => "mot",
	);
	$langue_menu = $_GET['langue_menu'];
	$valeurs_menu = array();

	foreach($elements as $num_element => $element) {
		$morceaux = array();
		if ($element['id']{0} == "l") {
			$element['id']=transcode($element['id']);
			if (ereg("^l([0-9]+)\|(.*)\|(.*)$", $element['id'], $morceaux)) {
				$type = "lien";
				$id = $morceaux[1];
				$nom = $morceaux[2];
				$url = $morceaux[3];
				$num = (int) $num;
				$valeurs_menu[] = "($num_element, '$type', $id, '$langue_menu', '$nom', '$url', $id_parent, '$type_parent')";
				$id = $arty_cpt_lien;
				$arty_cpt_lien++;
			}
		} else if (eregi("^(r|a|g|m)([0-9]+)$", $element['id'], $morceaux)) {
			$type = $types[$morceaux[1]];
			$id = (int) $morceaux[2];
			$num = (int) $num;
			$valeurs_menu[] = "($num_element, '$type', $id, '$langue_menu', '', '', $id_parent, '$type_parent')";
		}
		$enfants = isset($element['children']) ? $element['children'] : false;
		if (is_array($enfants) && isset($id) && isset($type)) {
			$retour = valeursNiveauxR($enfants, $id, $type, $arty_cpt_lien);
			$arty_cpt_lien = $retour[1];
			$valeurs_menu = array_merge($valeurs_menu, $retour[0]);
		}
	}
	return array($valeurs_menu, $arty_cpt_lien);
}

function afficherNiveauxR($id_parent, $type_parent, $langue_menu)
{
	$tables_spip = array(
    'rubrique' => array(
        "table" => "spip_rubriques",
        "colonne_id" => "id_rubrique",
	),
    'article' => array(
        "table" => "spip_articles",
        "colonne_id" => "id_article",
	),
    'groupe' => array(
        "table" => "spip_groupes_mots",
        "colonne_id" => "id_groupe",
	),
    'mot' => array(
        "table" => "spip_mots",
        "colonne_id" => "id_mot",
	),
	);

	$enfants = spip_query("SELECT * FROM spip_arty_menu WHERE id_parent = $id_parent AND type_parent='$type_parent' AND langue='$langue_menu' ORDER BY ordre ASC");
	if (spip_mysql_count($enfants)) {
		echo '<ul style="padding-left: 30px; padding-right: 0pt;">';
		while($row_enfant = spip_fetch_array($enfants)) {
			if ($row_enfant['type'] != 'lien') {
				$result2 = spip_query("SELECT titre FROM ".$tables_spip[$row_enfant['type']]['table']." WHERE ".$tables_spip[$row_enfant['type']]['colonne_id']." = ".$row_enfant['id']);
				if (spip_mysql_count($result2)) {
					$row2 = spip_fetch_array($result2);
					echo '<li id="'.substr($row_enfant['type'], 0, 1).$row_enfant['id'].'" class="sortable">';
					echo $row2["titre"];
					echo " <span class='url_petit'>("._T('arty:'.$row_enfant['type']).")</span>";
					echo ' <a href="javascript:supprimer(\'#'.substr($row_enfant['type'], 0, 1).$row_enfant['id'].'\')">x</a>';
					afficherNiveauxR($row_enfant['id'], $row_enfant['type'], $langue_menu);
					echo "</li>";
				} else {
					spip_query("DELETE FROM spip_arty_menu WHERE id_menu = ".$row_enfant["id_menu"]);
				}
			} else {
				echo '<li id="l'.$row_enfant['id'].'|'.transcodeinv($row_enfant['nom']).'|'.transcodeinv($row_enfant['url']).'" class="sortable">';
				echo $row_enfant["nom"];
				echo " <span class='url_petit'>(".$row_enfant["url"].")</span>";
				echo ' <a href="javascript:supprimer_lien(\'l'.$row_enfant['id'].transcodeinv($row_enfant['nom']).'|'.transcodeinv($row_enfant['url']).'\')">x</a>';
				afficherNiveauxR($row_enfant['id'], $row_enfant['type'], $langue_menu);
				echo "</li>";
			}
		}
		echo '</ul>';
	}
}
?>