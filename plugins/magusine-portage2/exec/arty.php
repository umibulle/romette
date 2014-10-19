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
include_spip('inc/user_session');

function exec_arty() {

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('arty:sideinfo_arty').' &raquo;', 'configuration', 'magusine');

	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
	 echo "<p><b>"._T('magusine:acces_a_la_page')."</b></p>";
	 fin_page();
	 exit;
	}

	traiter_post();
	$params= charger_parametres();

	traiter_get();

	echo barre_onglets("arty", "base"); //affiche la barre des onglets du groupe "magusine", l'onglet courant est "base".
	echo debut_gauche("", true);
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:info'));
	echo _T("arty:sideinfo_arty");
	echo fin_cadre_relief(true);


	echo debut_droite("", true);
	echo gros_titre(_T("arty:titre_configuration_base"), "", false);

	// choix de l'edito
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/document-properties.png", true, "", _T('arty:edito'));
	$edito=array(
  "exec" => "arty",
  "#" => "acces_a",
  "ajouter" => "edito",
  "verif" => $_SESSION['id_check']
	);

	$message = afficher_selectionne("arty", "edito");
	if (!$message) { echo _T("arty:pas_de_edito"); }

	echo "<div><a href='javascript:montrer_item(\"#show_edito\")' class='bouton-montrer-options'>"._T("arty:modifier_cette_option")."</a></div>";
	echo "<div id='show_edito'>";

	afficher_selecteur($edito);

	echo "</div>";
	echo "<script type='text/javascript'>
  jQuery('#show_edito').css({
  	display: 'none'
  	});
  </script>";

	$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre='cacher_edito'");
	$resultat = spip_fetch_array($resultat);

	if($resultat) {
		$cacher = $resultat['valeur'];
		$lien = $resultat['valeur2'];
	} else {
		$cacher = "false";
		$lien= "false";
	}
	echo "<br />";
	echo "<form action='".generer_url_ecrire('arty')."' method='post'>";
	echo "<input type='hidden' name='cacher_edito' value='false' />";
	echo "<p><input type='checkbox' id='cacher_edito' name='cacher_edito' value='true' ".($cacher == "true" ? "checked='checked'" : '')." />";
	echo "<label for='cacher_edito'>"._T("arty:cacher_edito")."</label></p>";

	echo "<p><input type='checkbox' id='lire_autres_editos' name='lire_autres_editos' value='true' ".($lien == "true" ? "checked='checked'" : '')." />";
	echo "<label for='lire_autres_editos'>"._T("arty:lire_autres_editos")."</label></p>";

	echo "<input type='submit' class='fondo' value='"._T('arty:enregistrer')."' />";
	echo "</form>";

	echo fin_cadre_trait_couleur(true);

	// choix de la une
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/folder-new.png", true, "", _T('arty:rubrique_article_une'));
	$rubart_une=array(
  "exec" => "arty",
  "#" => "rubart_une",
  "ajouter" => "rubart_une",
  "verif" => $_SESSION['id_check']
	);

	$message = afficher_selectionne("arty", "rubart_une");
	if (!$message) { echo "<p>"._T("arty:pas_de_une")."</p>"; }

	echo "<div><a href='javascript:montrer_item(\"#show_une\")' class='bouton-montrer-options'>"._T("arty:modifier_cette_option")."</div>";
	echo "<div id='show_une'>";
	afficher_selecteur($rubart_une);

	echo "</div>";
	echo "<script type='text/javascript'>
  jQuery('#show_une').css({
  	display: 'none'
  	});
  </script>";
	echo fin_cadre_trait_couleur(true);


	// rubrique de news
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/edit-find.png", true, "", _T('arty:choix_rubrique_news'));
	// controle l'existence du parametre, sinon injecte par defaut

	echo "<p>"._T("arty:explication_choix_rubrique_news")."</p>";

	$news=array(
  "exec" => "arty",
  "#" => "news",
  "ajouter" => "rubrique-news",
  "verif" => $_SESSION['id_check']
	);

	$message = afficher_selectionne("arty", "rubrique-news");
	if (!$message) { echo "<p>"._T("arty:pas_de_rubrique_news")."</p>"; }

	echo "<div><a href='javascript:montrer_item(\"#show_news\")' class='bouton-montrer-options'>"._T("arty:modifier_cette_option")."</div>";
	echo "<div id='show_news'>";
	afficher_selecteur($news, true, false);
	echo "</div>";
	echo "<script type='text/javascript'>
  jQuery('#show_news').css({
  	display: 'none'
  	});
  </script>";

	echo fin_cadre_trait_couleur(true);


	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/camera-video.png", true, "", _T('arty:video_au_hasard'));
	$edito=array(
  "exec" => "arty",
  "#" => "access-d",
  "ajouter" => "video-hasard",
  "verif" => $_SESSION['id_check']
	);

	$message = afficher_selectionne("arty", "video-hasard");
	if (!$message) { echo "<p>"._T("arty:pas_de_video_hasard")."</p>"; }

	echo "<div><a href='javascript:montrer_item(\"#show_video_hasard\")' class='bouton-montrer-options'>"._T("arty:modifier_cette_option")."</div>";
	echo "<div id='show_video_hasard'>";
	afficher_selecteur($edito);
	echo "</div>";
	echo "<script type='text/javascript'>
  jQuery('#show_video_hasard').css({
  	display: 'none'
  	});
  </script>";
	echo fin_cadre_trait_couleur(true);


	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/camera-photo.png", true, "", _T('arty:image_au_hasard'));
	$image=array(
  "exec" => "arty",
  "#" => "acces-e",
  "ajouter" => "image-hasard",
  "verif" => $_SESSION['id_check']
	);

	$message = afficher_selectionne("arty", "image-hasard");
	if (!$message) { echo _T("arty:pas_de_image_hasard"); }

	echo "<div><a href='javascript:montrer_item(\"#show_image_hasard\")' class='bouton-montrer-options'>"._T("arty:modifier_cette_option")."</div>";
	echo "<div id='show_image_hasard'>";
	afficher_selecteur($image);
	echo "</div>";
	echo "<script type='text/javascript'>
  jQuery('#show_image_hasard').css({
  	display: 'none'
  	});
  </script>";
	echo fin_cadre_trait_couleur(true);



	// reglage des parametres : afficher la date et les auteurs
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/edit-find.png", true, "", _T('arty:config_date_auteur'));

	$resultat= spip_query("SELECT * FROM spip_arty_parametres WHERE parametre='date_auteur'");
	$resultat=spip_fetch_array($resultat);
	//print_r($resultat);
	if($resultat) {
		$date=$resultat['valeur'];
		$auteur=$resultat['valeur2'];
		$suite=$resultat['valeur3'];
	} else {
		$date="false";
		$auteur="false";
		$suite="false";
	}

	echo _T("arty:intro_config_date_auteur");
	echo "<form action='".generer_url_ecrire('arty')."' method='post'>\n";
	echo "<input type='hidden' name='action_form' value='config_date_auteur' />";
	echo "<p class='label_radio'>"._T("arty:intro_date")."</p>";
	echo "<input class='radio' id='datetrue' type='radio' name='date' value='true' ".(($date=="true")?'checked="checked"':'')."> <label for='datetrue'>"._T("arty:afficher_date")."</label><br />";
	echo "<input class='radio' id='datefalse' type='radio' name='date' value='false' ".(($date=="false")?'checked="checked"':'')."> <label for='datefalse'>"._T("arty:pas_de_date")."</label><br />";

	echo "<p class='label_radio'>"._T("arty:intro_auteur")."</p>";
	echo "<input class='radio' id='auteurtrue' type='radio' name='auteur' value='true' ".(($auteur=="true")?'checked="checked"':'')."> <label for='auteurtrue'>"._T("arty:afficher_auteur")."</label><br />";
	echo "<input class='radio' id='auteurfalse' type='radio' name='auteur' value='false' ".(($auteur=="false")?'checked="checked"':'')."> <label for='auteurfalse'>"._T("arty:pas_afficher_auteur")."</label><br />";

	echo "<p class='label_radio'>"._T("arty:intro_suite")."</p>";
	echo "<input class='radio' id='suitetrue' type='radio' name='suite' value='true' ".(($suite=="true")?'checked="checked"':'')."> <label for='suitetrue'>"._T("arty:afficher_suite")."</label><br />";
	echo "<input class='radio' id='suitefalse' type='radio' name='suite' value='false' ".(($suite=="false")?'checked="checked"':'')."> <label for='suitefalse'>"._T("arty:pas_de_suite")."</label><br />";


	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";

	echo "</form>";
	echo fin_cadre_trait_couleur(true);

	// forum dans la meme page ou dans la page forum
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/edit-find.png", true, "", _T('arty:config_forum'));

	//print_r($params);

	if(!$params['config_forum']) {
		$params['config_forum']="false";
	}

	echo "<p>"._T("arty:intro_config_forum")."</p>";
	echo "<form action='".generer_url_ecrire('arty')."' method='post'>\n";
	echo "<input type='hidden' name='action_form' value='config_forum' />";
	echo "<p>"._T("arty:explication_forum")."</p>";
	echo "<input class='radio' type='radio' name='config_forum' value='true' ".(($params['config_forum']=="true")?'checked="checked"':'')."> <label for='config_forum'>"._T("arty:forum_self")."</label><br />";
	echo "<input class='radio' type='radio' name='config_forum' value='false' ".(($params['config_forum']=="false")?'checked="checked"':'')."> <label for='config_forum'>"._T("arty:forum_forum")."</label><br />";

	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);


	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/edit-find.png", true, "", _T('arty:config_google_maps'));

	//print_r($params);

	if (!isset($params['google_api_key'])) {
		$params['google_api_key'] = "";
	}
	if (!isset($params['gmaps_afficher_controles'])) {
		$params['gmaps_afficher_controles'] = "false";
	}

	echo "<p>"._T("arty:intro_config_api_key")."</p>";
	echo "<form action='".generer_url_ecrire('arty')."' method='post'>\n";
	echo "<input type='text' style='width:90%' name='google_api_key' value='".$params['google_api_key']."' /><br />";
	echo "<input type='hidden' name='gmaps_afficher_controles' value='false' />";
	echo "<p><input class='radio' type='checkbox' id='gmaps_afficher_controles' name='gmaps_afficher_controles' value='true' ".($params['gmaps_afficher_controles'] == "true" ? "checked='checked'" : '')." />";
	echo "<label for='gmaps_afficher_controles'>"._T("arty:gmaps_afficher_controles")."</label></p>";
	echo "<br /><input type='submit' value='"._T("arty:enregistrer")."' class='fondo' />";
	echo "</form>";
	echo fin_cadre_trait_couleur(true);

	echo fin_gauche();

	echo fin_page();

}

function traiter_post() {
	//print_r($_POST);

	if($_POST['action_form']=='config_date_auteur') {
		$date=addslashes($_POST['date']);
		$auteur=addslashes($_POST['auteur']);
		$suite=addslashes($_POST['suite']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = 'date_auteur'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre,valeur,valeur2, valeur3) VALUES ('date_auteur','$date', '$auteur', '$suite')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur= '$date',valeur2='$auteur', valeur3='$suite' WHERE parametre = 'date_auteur'");
		}

	}

	if($_POST['action_form']=='config_forum') {
		$config_forum=addslashes($_POST['config_forum']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = 'config_forum'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre,valeur) VALUES ('config_forum','$config_forum')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur= '$config_forum' WHERE parametre = 'config_forum'");
		}

	}

	if (isset($_POST['cacher_edito'])) {
		$cacher = addslashes($_POST['cacher_edito']);
		$lien=addslashes($_POST['lire_autres_editos']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = 'cacher_edito'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre,valeur,valeur2) VALUES ('cacher_edito','$cacher','$lien')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur='$cacher',valeur2='$lien' WHERE parametre = 'cacher_edito'");
		}



	}

	if (isset($_POST['google_api_key'])) {
		$api_key = addslashes($_POST['google_api_key']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = 'google_api_key'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre,valeur) VALUES ('google_api_key','$api_key')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur='$api_key' WHERE parametre = 'google_api_key'");
		}

		$controles = addslashes($_POST['gmaps_afficher_controles']);
		$resultat = spip_query("SELECT * FROM spip_arty_parametres WHERE parametre = 'gmaps_afficher_controles'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_arty_parametres (parametre,valeur) VALUES ('gmaps_afficher_controles','$controles')");
		} else {
			spip_query("UPDATE spip_arty_parametres SET valeur='$controles' WHERE parametre = 'gmaps_afficher_controles'");
		}

		//enregistrement des formats kml et kmz
		$resultat = spip_query("SELECT * FROM spip_types_documents WHERE extension = 'kml'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_types_documents (titre, extension, mime_type, inclus, upload) VALUES ('Keyhole Markup Language','kml', 'application/vnd.google-earth.kml+xml', 'non', 'oui')");
		}
		$resultat = spip_query("SELECT * FROM spip_types_documents WHERE extension = 'kmz'");
		if(!spip_mysql_count($resultat)) {
			spip_query("INSERT INTO spip_types_documents (titre, extension, mime_type, inclus, upload) VALUES ('Keyhole Markup Language (compressed)','kmz', 'application/vnd.google-earth.kmz', 'non', 'oui')");
		}

	}


}

function charger_parametres() {
	$params=array();
	$resultat= spip_query("SELECT * FROM spip_arty_parametres");
	if (spip_mysql_count($resultat)) {
		while ($row=spip_fetch_array($resultat)) {
			$params[$row['parametre']] = $row['valeur'];
		}
	}

	return $params;
}

function traiter_get() {
	//print_r($_GET);

	$param_accepte=array('edito','video-hasard','rubrique-news','image-hasard', 'rubart_une');

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


function afficher_selectionne($page, $param) {

	$resultat = spip_query("SELECT * FROM spip_arty_paramassoc WHERE param = '$param'");
	if(spip_mysql_count($resultat)) {
		echo "<ul class='liste-association'>";
		while($row=spip_fetch_array($resultat)) {
			//print_r($row);
			if(is_numeric($row['id_article'])) {
				$lart=spip_query("SELECT titre FROM spip_articles WHERE id_article =".$row['id_article']);
				if(spip_mysql_count($lart)) {

					$lart=spip_fetch_array($lart);


					echo "<li class='liste-article'>&mdash; ".$lart['titre'];
					echo "<a href='?exec=$page&supprimer=".$row['id_assoc']."&verif=".$_SESSION['id_check']."#$param'>";
					echo "<img src='"._DIR_IMG_PACK."/croix-rouge.gif' alt ='x' title='"._T("arty:supprimer")."' />";
					echo "</a>";

					echo "</li>";


				} else {

					spip_query("DELETE FROM spip_arty_paramassoc WHERE id_assoc =".$row['id_assoc']);
						
				}
			}
			//print_r($row);
			elseif(is_numeric($row['id_rubrique'])) {
				$lart=spip_query("SELECT titre FROM spip_rubriques WHERE id_rubrique =".$row['id_rubrique']);
				if(spip_mysql_count($lart)) {

					$lart=spip_fetch_array($lart);


					echo "<li class='liste-rubrique'>&mdash; ".$lart['titre'];
					echo "<a href='?exec=$page&supprimer=".$row['id_assoc']."&verif=".$_SESSION['id_check']."#$param'>";
					echo "<img src='"._DIR_IMG_PACK."/croix-rouge.gif' alt ='x' title='"._T("arty:supprimer")."' />";
					echo "</a>";

					echo "</li>";


				} else {

					spip_query("DELETE FROM spip_arty_paramassoc WHERE id_assoc =".$row['id_assoc']);
						
				}
			}
		}
		echo "</ul>";
		return true;
			
	} else { return false; }

}


?>
