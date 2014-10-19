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

function arty_ajouterHeaderPrive($flux){
	$liste=array("arty","theme","gabarit","menu");
	if (in_array($_GET['exec'], $liste)) {
		$flux.="<!-- ici css privee-->\n";
		$flux.= "<link rel=\"stylesheet\" type=\"text/css\" href=\""._DIR_PLUGIN_ARTY."/css/privee.css\" />\n";
		$flux.= "<link rel=\"stylesheet\" type=\"text/css\" href=\""._DIR_PLUGIN_ARTY."/css/selecteur_priv.css\" />\n";
		$flux.= "<link rel=\"stylesheet\" type=\"text/css\" href=\""._DIR_PLUGIN_ARTY."/css/gabarits.css\" />\n";
		$flux.= "<link rel=\"stylesheet\" type=\"text/css\" href=\""._DIR_PLUGIN_ARTY."/css/menu.css\" />\n";
		$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/selecteur_priv.js\"></script>\n";
		$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/interface.js\"></script>\n";
		$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/manip_gabarit.js\"></script>\n";
		$flux.= "<!--[if lt IE 7.]><script defer type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/pngfix.js\"></script><![endif]-->\n";
		if ($_GET['exec'] == 'menu') {
			$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/manip_menu.js\"></script>\n";
			$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/inestedsortable.js\"></script>\n";
		}

		if ($_GET['exec'] == 'theme') {
			$flux.= "<script type=\"text/javascript\" src=\""._DIR_PLUGIN_ARTY."/javascript/theme.js\"></script>\n";
		}

	}

	return $flux;

}

?>
