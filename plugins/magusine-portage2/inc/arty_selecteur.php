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

function afficher_selecteur($args, $afficher_ajouter_rubrique=true, $afficher_ajouter_article=true)
{
	$retour = charger_structure();
	$arbo = $retour[0];
	$articles = $retour[1];
	echo "<ul class=\"selecteur\">";
	foreach($arbo as $id => $section) {
		echo "<li class=\"section\">";
		if ($afficher_ajouter_rubrique) {
			echo '<a href="'.generer_url(array_merge($args, array("id_rubrique" => $id))).'" class="ajouter"><img src="'._DIR_PLUGIN_ARTY.'images/ajouter.gif" alt="+" /></a>';
		}
		echo '<img class="fleche" onclick="deplier_contenu(this);" src="'._DIR_PLUGIN_ARTY.'images/deplierhaut.gif" alt=">" />';
		echo '<span class="titre_section">'.$section["titre"].'</span>';
		echo afficher_enfants($section["enfants"], $articles, $args, $afficher_ajouter_rubrique, $afficher_ajouter_article);
		if($afficher_ajouter_article) {
			echo selec_afficher_article($id, $articles, $args, $afficher_ajouter_rubrique, $afficher_ajouter_article);
		}
		echo "</li>";
	}
	echo "</ul>";
}

function charger_structure(){
	//rubriques
	$arbo = array();

	$result = spip_query("SELECT id_rubrique, titre FROM spip_rubriques WHERE id_parent=0");
	while ($row = spip_fetch_array($result)) {
		$arbo[$row['id_rubrique']] = array("titre" => $row['titre']);
		$arbo[$row['id_rubrique']]["enfants"] = rubriques_enfants($row['id_rubrique']);
	}

	//articles
	$articles = array();

	$result = spip_query("SELECT id_article, titre, id_rubrique FROM spip_articles WHERE statut='publie'");
	while ($row = spip_fetch_array($result)) {
		$articles[$row['id_article']] = array("titre" => $row['titre'], "id_rubrique" => $row['id_rubrique']);
	}

	return array($arbo, $articles);
}

function rubriques_enfants($id_parent){
	$return = array();
	$result = spip_query("SELECT id_rubrique, titre FROM spip_rubriques WHERE id_parent=".$id_parent);
	while ($rub = spip_fetch_array($result)){
		$return[$rub['id_rubrique']]["titre"] = ($rub['titre']);
		$return[$rub['id_rubrique']]["enfants"] = rubriques_enfants($rub['id_rubrique']);
	}
	return $return;
}

function afficher_enfants($arbo, $articles, $args, $afficher_ajouter_rubrique=true, $afficher_ajouter_article=true) {
	$html = "";
	foreach($arbo as $id => $rub){
		$html .= "<li class=\"rubrique\">";
		if ($afficher_ajouter_rubrique) {
			$html .= "<a href=\"".generer_url(array_merge($args, array("id_rubrique" => $id)))."\" class=\"ajouter\"><img src=\""._DIR_PLUGIN_ARTY."images/ajouter.gif\" alt=\"+\" /></a>";
		}
		$html .= '<img class="fleche" onclick="deplier_contenu(this);" src="'._DIR_PLUGIN_ARTY.'images/deplierhaut.gif" alt=">" />';
		$html .= "<span class=\"titre_rubrique\">".raccourcir_titre($rub["titre"], 45)."</span>";
		$html .= afficher_enfants($rub["enfants"], $articles, $args, $afficher_ajouter_rubrique, $afficher_ajouter_article);
		if ($afficher_ajouter_article) {
			$html .= selec_afficher_article($id, $articles, $args, $afficher_ajouter_rubrique, $afficher_ajouter_article);
		}
		$html .= "</li>";
	}
	if ($html != "") {
		$html = "<ul style=\"display:none;\">".$html."</ul>";
	}
	return $html;
}

function selec_afficher_article($id_rubrique, $articles, $args, $afficher_ajouter_rubrique=true, $afficher_ajouter_article=true){
	$html = "";
	foreach($articles as $id => $article){
		if ($article["id_rubrique"] == $id_rubrique) {
			$html .= "<li class=\"article\">";
			if ($afficher_ajouter_article) {
				$html .= "<a href=\"".generer_url(array_merge($args, array("id_article" => $id)))."\" class=\"ajouter\"><img src=\""._DIR_PLUGIN_ARTY."images/ajouter.gif\" alt=\"+\" /></a>";
			}
			$html .= "<span class=\"titre_article\">".raccourcir_titre($article["titre"], 45)."</span>";
			$html .= "</li>";
		}
	}
	if ($html != "") {
		$html = "<ul style=\"display:none;\">".$html."</ul>";
	}
	return $html;
}

function generer_url($args)
{
	$segments = array();
	$ancre = "";
	$script = "";
	foreach ($args as $param => $value) {
		if ($param == "#") {
			$ancre = "#".$value;
		} elseif ($param == "exec") {
			$script = $value;
		} else {
			$segments[] = $param."=".$value;
		}
	}
	$args = implode("&", $segments).$ancre;
	$url = generer_url_ecrire($script, $args);
	return $url;
}

function raccourcir_titre($titre, $max){
	if (strlen($titre) > $max) {
		return substr($titre, 0, $max)."...";
	} else {
		return $titre;
	}
}

function afficher_selecteur_mots($args)
{
	$groupes = charger_structure_mots();
	echo "<ul class=\"selecteur\">";
	foreach($groupes as $id => $groupe) {
		echo "<li class=\"groupe\">";
		echo '<a href="'.generer_url(array_merge($args, array("id_groupe" => $id))).'" class="ajouter"><img src="'._DIR_PLUGIN_ARTY.'images/ajouter.gif" alt="+" /></a>';
		echo '<img class="fleche" onclick="deplier_contenu(this);" src="'._DIR_PLUGIN_ARTY.'images/deplierhaut.gif" alt=">" />';
		echo '<span class="titre_groupe">'.$groupe["titre"].'</span>';
		echo afficher_mots($groupe['mots'], $args);
		echo "</li>";
	}
	echo "</ul>";
}

function charger_structure_mots(){
	//groupes de mots
	$groupes = array();
	$result = spip_query("SELECT id_groupe, titre FROM spip_groupes_mots");
	while ($row = spip_fetch_array($result)) {
		$result2 = spip_query("SELECT id_mot, titre FROM spip_mots WHERE id_groupe=".$row['id_groupe']);
		$mots = array();
		while ($row2 = spip_fetch_array($result2)) {
			$mots[$row2['id_mot']] = $row2['titre'];
		}
		$groupes[$row['id_groupe']] = array(
      'titre' => $row['titre'],
      'mots' => $mots,
		);

	}

	return $groupes;
}

function afficher_mots($mots, $args){
	$html = "";
	foreach($mots as $id => $mot){
		$html .= "<li class=\"mot\">";
		$html .= "<a href=\"".generer_url(array_merge($args, array("id_mot" => $id)))."\" class=\"ajouter\"><img src=\""._DIR_PLUGIN_ARTY."images/ajouter.gif\" alt=\"+\" /></a>";
		$html .= "<span class=\"titre_mot\">".raccourcir_titre($mot, 45)."</span>";
		$html .= "</li>";
	}
	if ($html != "") {
		$html = "<ul style=\"display:none;\">".$html."</ul>";
	}
	return $html;
}

?>
