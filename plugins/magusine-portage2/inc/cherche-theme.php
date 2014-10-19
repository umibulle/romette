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

function theme_actuel() {
	//print_r($GLOBALS['contexte']['id_article']);
	//echo "article -".$GLOBALS['contexte']['id_rubrique']."-";
	if (isset($GLOBALS['contexte']['id_rubrique'])) {
		// si c'est une page rubrique, trouver le thème de la rubrique ou des rubriques parentes
		$theme = trouver_theme($GLOBALS['contexte']['id_rubrique']);
		$id_rubrique = $GLOBALS['contexte']['id_rubrique'];
	} else if (isset($GLOBALS['contexte']['id_article'])) {
		
		// si c'est un article, trouver sa rubrique et ensuite son thème, ou le thème des rubriques parentes 
		$result = spip_query("SELECT id_rubrique FROM spip_articles WHERE id_article='".addslashes($GLOBALS['contexte']['id_article'])."'");
		$row = spip_fetch_array($result);
		$id_rubrique = $row['id_rubrique'];
		$theme = trouver_theme_article($GLOBALS['contexte']['id_article']);
		if (!$theme) {
			$theme = trouver_theme($row['id_rubrique']);
		}
	} elseif (isset($GLOBALS['contexte']['id_mot'])) {
		// si c'est un mot, trouver le mot sinon pour son groupe
		$theme = trouver_theme_mot($GLOBALS['contexte']['id_mot']);
		if (!$theme) {
			$result = spip_query("SELECT id_groupe FROM spip_mots WHERE id_mot='".addslashes($GLOBALS['contexte']['id_mot'])."'");
			$row = spip_fetch_array($result);
			$theme = trouver_theme_groupe($row['id_groupe']);
		}

	} elseif (isset($GLOBALS['contexte']['id_groupe'])) {
		// si c'est un groupe, trouver son thème 
		$theme = trouver_theme_groupe($GLOBALS['contexte']['id_groupe']);
	} else {
		// dans les autres cas, charger le thème par defaut
		$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=0 AND type ='rubrique'");
		$row = spip_fetch_array($result);
		$theme = $row['theme'];
		$id_rubrique = 0;
	}
	$theme = addslashes($theme);

	return $theme;

}

function trouver_theme_groupe($id_groupe) {
	$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=$id_groupe AND type='groupe'");
	if (spip_mysql_count($result) == 1) {
		$row = spip_fetch_array($result);
		return $row['theme'];
	} else {
		$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=0 AND type='rubrique'");
		$row = spip_fetch_array($result);
		return $row['theme'];
	}
}

function trouver_theme_article($id_article) {
	
	$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=$id_article AND type='article'");
	if (spip_mysql_count($result) == 1) {
		$row = spip_fetch_array($result);
		return $row['theme'];
	} else {
		return "";
	}
}

function trouver_theme_mot($id_mot) {
	$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=$id_mot AND type='mot'");
	if (spip_mysql_count($result) == 1) {
		$row = spip_fetch_array($result);
		return $row['theme'];
	} else {
		return "";
	}
}

function trouver_theme($id_rubrique)
{
	$id_parent = $id_rubrique;
	while($id_parent != 0) {
		// un thème est-il présent pour cette rubrique?
		$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=$id_rubrique AND type='rubrique'");
		if (spip_mysql_count($result) == 1) {
			$row = spip_fetch_array($result);
			return $row['theme'];
		}
		// sinon, continuer et vérifier pour le parent
		$result = spip_query("SELECT id_parent FROM spip_rubriques WHERE id_rubrique=$id_rubrique");
		$row = spip_fetch_array($result);
		$id_parent = $row['id_parent'];
		$id_rubrique = $id_parent;
	}
	// aucun thème n'a été trouvé, on prend le thème par défaut
	$result = spip_query("SELECT theme FROM spip_arty_themeassoc WHERE id=0 AND type='rubrique'");
	$row = spip_fetch_array($result);
	return $row['theme'];
}

?>