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

function arty_install($action){
	switch ($action)
	{  // La base est deja cree ?
		case 'test':
			// Verifier que le champ id_mon_plugin est present...
			include_spip('base/abstract_sql');
			$desc = sql_showtable("spip_arty_themeassoc", false, '', true);
			return (isset($desc['field']['id']));
			break;
			// Installer la base
		case 'install':
			include_spip('base/create');  // definir la fonction
			include_spip('base/tables_magusine'); // definir sa structure
			creer_base();
			// entre les gabarits dans la db
			demarre_magusine();
			break;
			// Supprimer la base
		case 'uninstall':
			// liste des tables à supprimer
			spip_query("DROP TABLE spip_arty_themeassoc");
			break;
	}
}

function demarre_magusine() {
	include_spip('inc/xml-parser');

	$resultat=spip_query("SELECT * FROM spip_arty_themeassoc WHERE type='rubrique' AND id = 0");
	if(!spip_mysql_count($resultat)) {
		spip_query("INSERT INTO spip_arty_themeassoc (theme, id, type) VALUES ('emilio', 0, 'rubrique')");
	}

	$gabarits=array();
	$ignore_liste=array(".","..",".DS_Store");
	$rep = _DIR_PLUGIN_ARTY."definitions-gabarits";
	$handle = opendir($rep);
	while($fichier = readdir($handle)) {
		if (!in_array($fichier, $ignore_liste) && eregi('^[a-zA-Z0-9_-]*\.xml$',$fichier)) {

			$p =& new xmlParser();
			$p->parse(_DIR_PLUGIN_ARTY.'definitions-gabarits/'.$fichier);

		 foreach($p->output[0]['child'] as $ordre => $bloc) {

		 	$resultat = spip_query("SELECT * FROM spip_arty_gabarit_ordre WHERE nom='".$bloc['content']."' AND gabarit='".addslashes(ereg_replace("\.xml$", "", $fichier))."'");

		 	if (!spip_mysql_count($resultat)) {
		 		spip_query("INSERT INTO spip_arty_gabarit_ordre (nom, ordre, conteneur ,gabarit, param) VALUES ('".$bloc['content']."', $ordre, ".addslashes($bloc['attrs']['STATUT'])." , '".addslashes(ereg_replace("\.xml$", "", $fichier))."', '".addslashes($bloc['attrs']['PARAMDEFAUT'])."')");
		 	}
		 }
		}
	}
}


?>

