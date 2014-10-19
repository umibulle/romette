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

function arty_ajouter_onglets($flux){
	$page=array('arty', 'theme');
	if(in_array($flux['args'],$page)){
		$flux['data']['theme']= new Bouton(_DIR_PLUGIN_ARTY."/images/themechoisi.png", _T('arty:onglet_themes'), generer_url_ecrire("theme"));
		$flux['data']['menu']= new Bouton(_DIR_PLUGIN_ARTY."/images/menu.png", _T('arty:onglet_menu'), generer_url_ecrire("menu"));
		$flux['data']['base']= new Bouton(_DIR_PLUGIN_ARTY."/images/options.png", _T('arty:onglet_base'), generer_url_ecrire("arty"));
		$flux['data']['avance']= new Bouton(_DIR_PLUGIN_ARTY."/images/blocs_libres_2.png", _T('arty:onglet_avance'), generer_url_ecrire("avance"));
		$flux['data']['gabarit']= new Bouton(_DIR_PLUGIN_ARTY."/images/agencement.png", _T('arty:onglet_gabarit'), generer_url_ecrire("gabarit"));
		$flux['data']['about']= new Bouton(_DIR_PLUGIN_ARTY."/images/bouton-arty.png", _T('arty:onglet_a_propos'), generer_url_ecrire("about"));
	}
	return $flux;
}
?>
