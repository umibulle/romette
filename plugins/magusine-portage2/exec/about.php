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

include_spip('inc/arty_selecteur');
include_spip('inc/user_session');

function exec_about() {

	global $connect_statut;
	if ($connect_statut != "0minirezo" ) {
	 echo "<p><b>"._T('magusine:acces_a_la_page')."</b></p>";
	 fin_page();
	 exit;
	}

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page('&laquo; '._T('sideinfo_about').' &raquo;', 'configuration', 'magusine');
	echo barre_onglets("arty", "about");
	echo debut_gauche("", true);
	echo debut_cadre_relief(_DIR_PLUGIN_ARTY.'/images/aide.png', true, "", _T('arty:info'));
	echo _T("arty:sideinfo_about");

	if (file_exists(_DIR_PLUGIN_ARTY.'plugin.xml')) {
		$p =& new xmlParser();
		$p->parse(_DIR_PLUGIN_ARTY.'plugin.xml');
		foreach($p->output[0]['child'] as $prop) {
			if ($prop['name'] == "VERSION")
			$version = $prop['content'];
		}
	}

	if (isset($version)) {
		echo "<p>"._T("arty:version_actuelle").": ".$version."</p>";
	}

	echo fin_cadre_relief(true);

	echo debut_droite("", true);
	echo gros_titre(_T("arty:a_propos"), "", false);
	echo "<br />";
	// choix de l'edito
	echo debut_cadre_trait_couleur(_DIR_PLUGIN_ARTY."images/network-wireless.png", true, "", _T('arty:dernieres_infos'));
	echo "<iframe src='http://www.magunews.net/spip.php?fond=about&lang=".$GLOBALS['meta']['langue_site'].(isset($version) ? "&version=".urlencode($version) : '')."' width='100%' height='450px' frameborder='0'></iframe>";
	echo fin_cadre_trait_couleur(true);

	echo fin_gauche();

	echo fin_page();

}

?>
