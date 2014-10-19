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

function arty_ajouterBoutons($boutons_admin) {
	$boutons_admin['configuration']->sousmenu['theme'] = new Bouton(
      _DIR_PLUGIN_ARTY."images/bouton-magusine-24.png",  // icone
	_T('arty:options_arty')	// titre
	);
	return $boutons_admin;
}
?>
