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
//require(_DIR_PLUGIN_ARTY.'/inc/xml-parser.php');

if (!defined("_ECRIRE_INC_VERSION")) return;
include_spip('inc/presentation');

function exec_gabarit() {

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('arty:configuration_des_gabarits').' &raquo;', 'configuration', 'magusine');

	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
		echo "<p><b>"._T('arty:acces_a_la_page')."</b></p>";
		fin_page();
		exit;
	}
    // mazu ici était le if du $_GET['mode']=="ajax" voir dans action/enregister_gabarit.php
	if ($_POST['action_form'] == 'supprimer') {
		$gabarit = isset($_POST['gabarit']) ? addslashes($_POST['gabarit']) : false;

		if ($gabarit) {
			//supprimer les blocs de gabarit_ordre
			spip_query("DELETE FROM spip_arty_gabarit_ordre WHERE gabarit='$gabarit'");
			//supprimer l'entrée du gabarit dans gabarit_perso
			spip_query("DELETE FROM spip_arty_gabarit_perso WHERE nom='$gabarit'");
			//supprimer les entrées du gabarit dans gabaritassoc
			spip_query("DELETE FROM spip_arty_gabaritassoc WHERE gabarit='$gabarit'");
			//echo _T("arty:gabarit_supprime");
		}
	}

	echo barre_onglets("arty", "gabarit");
	echo debut_gauche("", true);
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:info'));
	echo _T("arty:sideinfo_gabarit");
	echo fin_cadre_relief(true);

	$gabarits=array();
	$gabaritpardefaut=array("sommaire","rubrique","article","groupe","mot","breve");
	$ignore_liste=array(".","..",".DS_Store","^\.[.+]");
	$rep = _DIR_PLUGIN_ARTY."definitions-gabarits";
	$handle = opendir($rep);
	while($fichier = readdir($handle)) {

		if (!in_array($fichier, $ignore_liste) && eregi('^[a-zA-Z0-9_-]*\.xml$',$fichier)) {
			$p =& new xmlParser();
			$p->parse($rep.'/'.$fichier);
			if (!in_array(ereg_replace("\.xml$","",$fichier),$gabaritpardefaut)) {
				$gabarits[$p->output[0]['attrs']['TYPE']][]=ereg_replace("\.xml$","",$fichier);
			}
			$liste_gabarit[]=ereg_replace("\.xml$","",$fichier);
		}
	}

	//gabarits du dossier "pages-custom" (surclassage)
	$rep_custom = _DIR_RACINE."pages-custom/gabarits";
	if (file_exists($rep_custom)) {
		$handle = opendir($rep_custom);
		while($fichier = readdir($handle)) {
			if (!in_array($fichier, $ignore_liste) && eregi('^[a-zA-Z0-9_-]*\.xml$',$fichier) && !eregi('^ajout-',$fichier) && !in_array($fichier, $liste_gabarit)) {
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
			//$donnees = unserialize($row['donnees']);
			$gabarits[$donnees[0]['attrs']['TYPE']][] = $row['nom'];
		}
	}

	if ($_POST['action_form'] == "deriver") {

		if (isset($_POST['nom_gabarit']) && isset($_POST['source'])) {
			if (in_array($_POST['nom_gabarit'], $liste_gabarit)) {
				echo _T("arty:nom_deja_pris");
			} else {

				$source = addslashes($_POST['source']);

				//vérification de la présence d'un gabarit dans pages-custom (surclassage)
				$rep = _DIR_PLUGIN_ARTY."definitions-gabarits/";
				$rep_custom = _DIR_RACINE."pages-custom/gabarits/";
					
				if (file_exists($rep_custom.$source.".xml")) {
					$chemin_gabarit = $rep_custom.$source.".xml";
				} else if (file_exists($rep.$source.".xml")) {
					$chemin_gabarit = $rep.$source.".xml";
				}

				if (isset($chemin_gabarit)) {
					$p =& new xmlParser();
					$p->parse($chemin_gabarit);
					$donnees = $p->output;
				}

				if (isset($donnees)) {

					$type_source = addslashes($donnees[0]["attrs"]["TYPE"]);

					if ($type_source == "defaut") {
						$donnees[0]["attrs"]["TYPE"] = $source;
						$type_source = $source;
					}

					$nom = addslashes(trim(ereg_replace("[^a-zA-Z0-9_-]", "", $_POST['nom_gabarit'])));
					if (!$nom) { $nom="sansnom"; } // eviter le gabarit sans nom
					$donnees = serialize($donnees);

					$result = spip_query("SELECT * FROM spip_arty_gabarit_ordre WHERE gabarit='$source'");
					$blocs = array();
					while ($row = spip_fetch_array($result)) {
						$blocs[] = array(
              "nom"       => addslashes($row['nom']),
              "ordre"     => (!is_nan((int) $row['ordre'])) ? (int) $row['ordre'] : 0,
              "conteneur" => (!is_nan((int) $row['conteneur'])) ? (int) $row['conteneur'] : 0,
              "gabarit"   => $nom,
              "param"     => addslashes($row['param']),
						);
					}

					if ($blocs) {
						$query = "INSERT INTO spip_arty_gabarit_ordre (nom, ordre, conteneur, gabarit, param) VALUES ";
						for ($i=0; $i<count($blocs); $i++) {
							$query .= "('".$blocs[$i]['nom']."', ".$blocs[$i]['ordre'].", ".$blocs[$i]['conteneur'].", '".$blocs[$i]['gabarit']."', '".$blocs[$i]['param']."')";
							if ($i != count($blocs)-1) {
								$query .= ", ";
							}
						}

						spip_query($query);
						spip_query("INSERT INTO spip_arty_gabarit_perso (nom,type,donnees) VALUES ('$nom','$type_source','$source')");

						// echo _T("arty:nouveau_gabarit_cree");

						// si on vient de creer le gabarit a partir d'une page d'edition, associer le gabarit
						if ($_POST['associer']){
							$leid = (int) $_POST['associer'];

							// supprimer autre entree de gabarit
							spip_query("DELETE FROM spip_arty_gabaritassoc WHERE type='$type_source' AND id=$leid");
							spip_query("INSERT INTO spip_arty_gabaritassoc (gabarit,id,type) VALUES ('$nom','$leid','$type_source')");
						}

						$nouveau_gabarit = $nom;
						$liste_gabarit[] = $nom;
						$donnees = unserialize($donnees);
						$gabarits[$donnees[0]['attrs']['TYPE']][] = $nom;

					}
				}
			}
		}
	}

	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:nouveau_gabarit'));
	echo "<p style='margin-top:0px; margin-bottom:2px;'>"._T("arty:deriver_gabarit")."</p>";

	echo "<form action='".generer_url_ecrire('gabarit')."' method='post'>\n";
	echo "<input type='hidden' name='action_form' value='deriver'/>";
	echo "<input type='text' name='nom_gabarit' value='"._T('arty:nom_du_gabarit')."' /><br />";

	echo "<p style='margin-top:8px; margin-bottom:2px;'>"._T("arty:baser_gabarit_sur")."</p>";

	echo "<select id='source' name='source'>";


	foreach($gabaritpardefaut as $un_gabarit) {
		if ($un_gabarit != "sommaire") {
			echo '<option name="'.$un_gabarit.'" value="'.$un_gabarit.'">'.$un_gabarit.'</option>';
		}
	}

	foreach($gabarits as $nom_type => $types_gabarits) {
		if ($nom_type != "defaut") {
			$nom_type = "(".$nom_type.")";

			foreach($types_gabarits as $un_gabarit) {

				if ($nom_type!="()"){
					echo '<option name="'.$un_gabarit.'" value="'.$un_gabarit.'">'.$un_gabarit.' '.$nom_type.'</option>';
				}
			}
		}
	}
	echo "</select>";
	echo "<br /><br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";

	echo fin_cadre_relief(true);


	// pour la page principale : nom du gabarit en cours

	if (isset($nouveau_gabarit)) {
		$gabarit = $nouveau_gabarit;
	} else {
		$gabarit=$_GET['gabarit'];
	}
	if(!in_array($gabarit, $liste_gabarit)) {
		$gabarit="sommaire";
	}

	$liste_nonassociee=array("sommaire","article","rubrique","mot","groupe-mots","breve","404","forum","login","recherche","auteur","webmaton-mosaique","webmaton-questions");

	if (!in_array($gabarit, $liste_nonassociee)){
		lister_associations_gabarit($gabarit);
	}
	echo debut_droite("", true);

	echo "\n";


	echo gros_titre(_T("arty:configuration_des_gabarits")." "._T("arty:".$gabarit), "", false);

	// faire le menu deroulant

	echo "<div id='deroulant-gabarits'>"._T("arty:modifier_un_autre_gabarit").' : <select onchange="window.location.href=\''.generer_url_ecrire("gabarit", "gabarit=").'\'+this.options[this.selectedIndex].value;" class="selecteur-gabarit">';

	foreach ($gabaritpardefaut as $cegabarit) {
		$selected = ($cegabarit == $gabarit) ? 'selected="selected"' : '';

		echo "<option class='$type' value=\"".$cegabarit."\" $selected>"._T("arty:$cegabarit")."</option>";
	}

	foreach($gabarits as $type) {
		foreach($type as $cegabarit) {
			$selected = ($cegabarit == $gabarit) ? 'selected="selected"' : '';
			echo "<option class='$type' value=\"".$cegabarit."\" $selected>"._T("arty:$cegabarit")."</option>";
		}
	}
	echo "</select></div>";

	//print_r($gabarits);

	charger_gabarit(addslashes($gabarit));

	echo fin_gauche();
	echo fin_page();
}

function charger_gabarit($gabarit) {

	//vérification de la présence d'un gabarit dans pages-custom (surclassage)
	$rep = _DIR_PLUGIN_ARTY."definitions-gabarits/";
	$rep_custom = _DIR_RACINE."pages-custom/gabarits/";

	if (file_exists($rep_custom.$gabarit.".xml")) {
		$chemin_gabarit = $rep_custom.$gabarit.".xml";
		$origine=$gabarit;
	} else if (file_exists($rep.$gabarit.".xml")) {
		$chemin_gabarit = $rep.$gabarit.".xml";
		$origine=$gabarit;
	} else {
		$query = spip_query("SELECT * FROM spip_arty_gabarit_perso WHERE nom='$gabarit'");
		if (spip_mysql_count($query)) {
			$row = spip_fetch_array($query);
			$origine = $row['donnees'];
			$from_db = $row['type'];

			//retrouve le gabarit d'origine de la declinaison
			if (file_exists($rep_custom.$origine.".xml")) {
				$chemin_gabarit = $rep_custom.$origine.".xml";
			} else if (file_exists($rep.$origine.".xml")) {
				$chemin_gabarit = $rep.$origine.".xml";
			} else {
				echo _T("arty:gabarit_origine_non-trouve");
				return false;
			}
		}
	}

	if (isset($chemin_gabarit)) {
		$p =& new xmlParser();
		$p->parse($chemin_gabarit);
		$donnees = $p->output;
	}

	// fichier d'injection simple de bloc sur base du gabarit d'origine (physique)
	if (file_exists($rep_custom."ajout-".$origine.".xml")) {
		$pajout =& new xmlParser();
		$pajout->parse($rep_custom."ajout-".$origine.".xml");
		$donneesajout = $pajout->output;
		$donnees[0][child] = array_merge((array)$donnees[0][child], (array)$donneesajout[0][child]);
	}

	if (!isset($donnees)) {
		echo _T("arty:gabarit_non-trouve");
		return false;
	}

	if (isset($from_db)) {
		// formulaire de suppression
		echo "<form action='".generer_url_ecrire('gabarit')."' method='post'>\n";
		echo "<input type='hidden' name='action_form' value='supprimer'/>\n";
		echo "<input type='hidden' name='gabarit' value=\"".stripslashes($gabarit)."\" />\n";
		echo "<br /><input type='submit' value='"._T("arty:supprimer")."' class='fondo' />";
		echo "</form>";
	}

	$nom = $donnees[0]['attrs']['NOM'];

	$blocs =array();

	foreach($donnees[0]['child'] as $ordre => $bloc) {
		$blocs[$bloc['content']]=array('ordre'=> $ordre, 'conteneur' => $bloc['attrs']['STATUT'], 'param' => $bloc['attrs']['PARAM'], 'paramdefaut' => $bloc['attrs']['PARAMDEFAUT'],'paramdescr' => $bloc['attrs']['PARAMDESCR'],'paramtext' => $bloc['attrs']['PARAMTEXT'], 'paramvalue' => $bloc['attrs']['PARAMVALUE']);
	}

	$resultat=spip_query("SELECT * FROM spip_arty_gabarit_ordre WHERE gabarit='$gabarit'");
	while ($row=spip_fetch_array($resultat)) {
		if (in_array($row['nom'], array_keys($blocs))) {
			$blocs[$row['nom']]['conteneur']=$row['conteneur'];
			$blocs[$row['nom']]['ordre']=$row['ordre'];
			$blocs[$row['nom']]['paramdefaut']=$row['param']; // peut crasher
		} else {
			spip_query("DELETE FROM spip_arty_gabarit_ordre WHERE id_bloc=".$row['id_bloc']);
		}
	}

	uasort($blocs, "comparerblocs");

	echo "<div id='general'>\n";

	//print_r($donnees);
	echo "<div id='pageweb'><div id='bandeau'></div>";
	$colonnes = array("contexte1" => 1, "contexte2" =>2, "corps" =>3, "reserve" => 0, "avance" => 4);

	foreach( array_keys($colonnes) as $colonne) {
		//boucle pour tous les conteneurs
		if($colonne=='reserve') { echo "<br class='clearer'/><div id='footer'></div></div><div id='reserves'>";
		}

		echo "<ul id='$colonne' class='conteneur_bloc'>\n";

		echo "<li><h3>"._T("arty:$colonne")."</h3></li>\n";
		foreach($blocs as $bloc => $proprietes) {
			//on affiche le bloc
			if ($proprietes['conteneur']== $colonnes[$colonne]) {
				echo "<li id='".$bloc."' class='bloc $colonne' >";
				// poignée
				echo "<div class='poignee'></div>";
				echo "<span class='titre-bloc'>"._T("arty:".$bloc)."</span><br />";
				if($proprietes['paramdescr']) {
					echo "<p class='option-bloc'>"._T("arty:".$proprietes['paramdescr']);
				}

				if (preg_match("/^champ/",$proprietes['param'])) {
					// en cas de champ : montrer le champ
					echo "<input type='text' name='$bloc' class='selecteur-param' value='";
					echo $proprietes['paramdefaut'];
					echo "' style='width:100%' />";
					echo "</p>";

				} else if (preg_match("/^area/",$proprietes['param'])) {
					// en cas de area : montrer le champ
					echo "<textarea name='$bloc' class='selecteur-param' rows='4' style='width:100%'>";
					echo $proprietes['paramdefaut'];
					echo "</textarea>";
					echo "</p>";

				} else if ($proprietes['param'] !="") {
					// en cas de parametre : montrer le selecteur
					echo "<select name='$bloc' class='selecteur-param'>";

					if (ereg("SELECT",$proprietes['param'])) {
						$requete=spip_query($proprietes['param']);
						while ($row=spip_fetch_array($requete)) {
							echo "<option value='".$row[$proprietes['paramvalue']]."'>".$row[$proprietes['paramtext']]."</option>";
						}

					} else {
						// c'est une liste separee par des virgules
						$options=explode(",",$proprietes['param']);
						foreach($options as $option) {
							echo "<option value='$option'";
							if ( trim(strval($option))==trim(strval($proprietes['paramdefaut'])) ) { echo "selected='selected'"; }
							echo ">"._T("arty:$option")."</option>";

						}
					}

					echo "</select></p>";
				}

				echo "</li>\n";
			}
		}
		echo "</ul>\n";

		if($colonne=='avance'){
			echo "</div>\n";
		}
	}

	echo "<br class='clearer' />";
	echo "<div id='bloc_sauver'>";
	echo "<div id='reponse'></div>";
	echo "<img src='"._DIR_IMG_PACK."searching.gif' id='search' style='visibility:hidden' />";
	
	echo "<a href=\"javascript:sauver('".$gabarit."'";

	if ($_POST['retour']){
		// si un retour vers une page est prevu
		echo ",'".$_POST['retour']."');\">";
		echo _T("arty:modifier_et_retour");
	} else {
		echo ");\">"._T("arty:enregister");
	}
	
	//echo "<a href=\"javascript:void(0)\" onclick=\"return AjaxSqueeze('?exec=gabarit&action=enregistrer_gabarit','reponse','',event)\">"._T("arty:enregister")."</a>";
	echo "</a></div>";
	echo "</div>\n";
}

function testexist($nom, $liste) {
	$return=FALSE;
	foreach($liste as $bloc) {
		if ($bloc['content']==$nom) {
			$return=TRUE;
		}
	}
	return $return;
}

function comparerblocs ($a, $b) {
	if ($a['ordre'] == $b['ordre']) return 0;
	return ($a['ordre'] < $b['ordre']) ? -1 : 1;
}

function lister_associations_gabarit($gabarit)
{

	if ($_GET['action_form'] == 'delete_assoc_gabarit' && $_GET['id_check'] == $_SESSION['id_check']) {
		$type = isset($_GET['type']) ? addslashes($_GET['type']) : false;
		$id = isset($_GET['id']) ? (int) $_GET['id'] : false;
		$theme = isset($_GET['gabarit']) ? addslashes($_GET['gabarit']) : false;
		if ($type && $id && $theme) {
			spip_query("DELETE FROM spip_arty_gabaritassoc WHERE type='$type' AND id=$id AND gabarit='$gabarit'");
		}
	}

	echo "<div id=\"div_liste_assoc\">";
	$result = spip_query("SELECT * FROM spip_arty_gabaritassoc WHERE gabarit='$gabarit'");

	echo debut_cadre_couleur("doc-24.gif", true, "", _T('arty:liste_assoc_gabarit'));
	echo "<div class='liste'><table border='0' cellspacing='0' cellpadding='3' width='100%'>";
	if (spip_mysql_count($result) > 0) {
		while ($row = spip_fetch_array($result)){
			echo "<tr class='tr_liste'>";
			$type = $row['type'];
			$id = $row['id'];
			switch ($type) {
				case "rubrique":
					$rubrique = spip_fetch_array(spip_query("SELECT titre FROM spip_rubriques WHERE id_rubrique=$id"));
					$titre = $rubrique['titre'];
					$url="?exec=naviguer&id_rubrique=$id";
					break;

				case "article":
					$article = spip_fetch_array(spip_query("SELECT titre FROM spip_articles WHERE id_article=$id"));
					$titre = $article['titre'];
					$url="?exec=articles&id_article=$id";
					break;

				case "groupe":
					$groupe = spip_fetch_array(spip_query("SELECT titre FROM spip_groupes_mots WHERE id_groupe=$id"));
					$titre = $groupe['titre'];
					$url="?exec=mots_tous";
					break;

				case "mot":
					$mot = spip_fetch_array(spip_query("SELECT titre FROM spip_mots WHERE id_mot=$id"));
					$titre = $mot['titre'];
					$url="?exec=mots_tous&id_mot=$id";
					break;
			}

			$gabarit = $row['gabarit'];
			echo "<td class=\"arial1\"><a href=\"$url\">$titre</a></td>";
			echo "<td class=\"arial1\"> ($type $id)</td>";
			echo "<td class=\"arial1\"><div style='text-align:right;'><a class=\"supprimer\" href='".generer_url_ecrire('gabarit')."&amp;action_form=delete_assoc_gabarit&amp;id_check=".$_SESSION['id_check']."&amp;id=$id&amp;gabarit=$gabarit&amp;type=$type'><img src='../dist/images/croix-rouge.gif' alt='X' width='7' height='7' align='bottom' /></a></div></td>";
			echo "</tr>";
		}
	} else { echo "<tr><td class=\"arial1\">"._T("arty:pas_de_page_associee")."</td></tr>"; }
	echo "</table></div>";

	echo fin_cadre_couleur(true);

	echo "</div>";
}
?>