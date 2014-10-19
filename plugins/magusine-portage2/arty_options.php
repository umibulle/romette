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

session_start();
if (!isset($_SESSION['id_check'])) {
	$_SESSION['id_check'] = uniqid(rand());
}

$p=explode(basename(_DIR_PLUGINS)."/",str_replace('\\','/',realpath(dirname(__FILE__))));
define('_DIR_PLUGIN_ARTY',(_DIR_PLUGINS.end($p)));

$forcer_lang = true;
// pour free : tester si on est en admin privee ou publique
if (!ereg("^\.\.", _DIR_PLUGIN_ARTY)) {
	$GLOBALS['dossier_squelettes'] = implode(":", Array(
'pages-custom',
	_DIR_PLUGIN_ARTY.'/squelettes',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/logos',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/galeries',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/article',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/rubrique',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/sommaire',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/404',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/mot',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/recherche',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/login',
	_DIR_PLUGIN_ARTY.'/squelettes/blocs/groupe'
	));
}
// structure des tables

include_spip("base/tables_magusine");

?>