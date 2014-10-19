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

//include_spip('base/serial'); // pour eviter une reinit posterieure des tables modifiees

global $tables_principales;
global $tables_auxiliaires;

// déclaration de toutes les tables

// bloclibre
$spip_arty_bloclibre = array(
  "id_bloc_libre"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "titre" => "VARCHAR(255) NOT NULL",
  "contenu" => "TEXT",
  "lien" => "VARCHAR(255) NOT NULL",
);
	
$spip_arty_bloclibre_key = array(
  "PRIMARY KEY" => "id_bloc_libre"
);

$tables_principales['spip_arty_bloclibre'] = array('field' => &$spip_arty_bloclibre, 'key' => &$spip_arty_bloclibre_key);

// bloclibreassoc
$spip_arty_bloclibreassoc = array(
  "id_assoc"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "type" => "VARCHAR(255) NOT NULL",
  "id_bloc_libre" => "bigint(21)",
  "id" => "bigint(21)",
  "lang" => "VARCHAR(32)",
);
	
$spip_arty_bloclibreassoc_key = array(
  "PRIMARY KEY" => "id_assoc"
);

$tables_principales['spip_arty_bloclibreassoc'] = array('field' => &$spip_arty_bloclibreassoc, 'key' => &$spip_arty_bloclibreassoc_key);

// gabarit_ordre
$spip_arty_gabarit_ordre = array(
  "id_bloc"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "nom" => "VARCHAR(255) NOT NULL",
  "ordre" => "bigint(21)",
  "conteneur" => "bigint(21)",  
  "gabarit" => "VARCHAR(255) NOT NULL",
  "param" => "TEXT NOT NULL",
);
	
$spip_arty_gabarit_ordre_key = array(
  "PRIMARY KEY" => "id_bloc"
);

$tables_principales['spip_arty_gabarit_ordre'] = array('field' => &$spip_arty_gabarit_ordre, 'key' => &$spip_arty_gabarit_ordre_key);

// gabarit perso
$spip_arty_gabarit_perso = array(
  "id"      => "bigint(21) NOT NULL AUTO_INCREMENT",
  "nom"     => "VARCHAR(255)",
  "type"    => "VARCHAR(255)",
  "donnees" => "TEXT",
);
	
$spip_arty_gabarit_perso_key = array(
  "PRIMARY KEY" => "id"
);

$tables_principales['spip_arty_gabarit_perso'] = array('field' => &$spip_arty_gabarit_perso, 'key' => &$spip_arty_gabarit_perso_key);

// gabarit assoc
$spip_arty_gabaritassoc = array(
  "id_assoc"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "gabarit" => "VARCHAR(255) NOT NULL",
  "id" => "bigint(21)",
  "type" => "VARCHAR(255)",
);
	
$spip_arty_gabaritassoc_key = array(
  "PRIMARY KEY" => "id_assoc"
);

$tables_principales['spip_arty_gabaritassoc'] = array('field' => &$spip_arty_gabaritassoc, 'key' => &$spip_arty_gabaritassoc_key);

// menu
$spip_arty_menu = array(
  "id_menu"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "ordre" => "bigint(21)",
  "type" => "VARCHAR(255) NOT NULL",
  "id" => "bigint(21)",
  "langue" => "VARCHAR(255)",
  "id_parent" => "bigint(21)",
  "type_parent" => "VARCHAR(255)",
  "nom" => "VARCHAR(255)",
  "url" => "TEXT",
);
	
$spip_arty_menu_key = array(
  "PRIMARY KEY" => "id_menu"
);

$tables_principales['spip_arty_menu'] = array('field' => &$spip_arty_menu, 'key' => &$spip_arty_menu_key);

// paramassoc
$spip_arty_paramassoc = array(
  "id_assoc"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "param" => "VARCHAR(255) NOT NULL",
  "id_article" => "bigint(21)",
  "id_rubrique" => "bigint(21)",
);
	
$spip_arty_paramassoc_key = array(
  "PRIMARY KEY" => "id_assoc"
);

$tables_principales['spip_arty_paramassoc'] = array('field' => &$spip_arty_paramassoc, 'key' => &$spip_arty_paramassoc_key);

// parametres
$spip_arty_parametres = array(
  "id_parametre"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "parametre" => "VARCHAR(255) UNIQUE NOT NULL",
  "valeur" => "TEXT",
  "valeur2" => "TEXT",
  "valeur3" => "TEXT"
);
	
$spip_arty_parametres_key = array(
  "PRIMARY KEY" => "id_parametre"
);

$tables_principales['spip_arty_parametres'] = array('field' => &$spip_arty_parametres, 'key' => &$spip_arty_parametres_key);

// themeassoc
$spip_arty_themeassoc = array(
  "id_assoc"  => "bigint(21) NOT NULL AUTO_INCREMENT",
  "theme" => "VARCHAR(255) NOT NULL",
  "id" => "bigint(21)",
  "type" => "VARCHAR(255) NOT NULL"
);
	
$spip_arty_themeassoc_key = array(
  "PRIMARY KEY" => "id_assoc"
);

$tables_principales['spip_arty_themeassoc'] = array('field' => &$spip_arty_themeassoc, 'key' => &$spip_arty_themeassoc_key);


// association aux tables spip
global $table_des_tables;
$table_des_tables['arty_bloclibre'] = 'arty_bloclibre';
$table_des_tables['arty_bloclibreassoc'] = 'arty_bloclibreassoc';
$table_des_tables['arty_gabarit_ordre'] = 'arty_gabarit_ordre';
$table_des_tables['arty_gabarit_perso'] = 'arty_gabarit_perso';
$table_des_tables['arty_gabaritassoc'] = 'arty_gabaritassoc';
$table_des_tables['arty_menu'] = 'arty_menu';
$table_des_tables['arty_paramassoc'] = 'arty_paramassoc';
$table_des_tables['arty_parametres'] = 'arty_parametres';
$table_des_tables['arty_themeassoc'] = 'arty_themeassoc';

?>