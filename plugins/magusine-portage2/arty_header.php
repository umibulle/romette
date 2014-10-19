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
include_spip('inc/cherche-theme');

function arty_ajouterHeader($flux) {
	
    $theme=theme_actuel();
    $head = generer_head($theme);
    return $flux.=$head;
}

function generer_head($theme) {
    $morceaux=explode("|", $theme);
    if (count($morceaux)==1) {
        //le theme est un theme plein, pas de declinaison
        $dossier=$morceaux[0];
        $declinaison=FALSE;
    } else {
        // le theme est une declinaison
        $dossier=$morceaux[0];
        $declinaison=$morceaux[1];
    }

    // scripts ie7
    $inclusion_theme ="<!-- plugin magusine developpe par les corsaires asbl http://www.magusine.net-->\n";
    $inclusion_theme .="<!-- compliance patch for microsoft browsers -->\n";
    $inclusion_theme .="<!--[if lt IE 7]><script src='ie7/ie7-standard-p.js' type='text/javascript'></script><![endif]-->\n";

    // fichier javascript de base
    $print="";
    $inclusion_theme .="\n";
    $inclusion_theme .="<script src='"._DIR_PLUGIN_ARTY."javascript/javascript-public.js' type='text/javascript' language='javascript'></script>\n";
    $inclusion_theme .="<script src='"._DIR_PLUGIN_ARTY."javascript/thickbox.js' type='text/javascript' language='javascript'></script>\n";
    /*$inclusion_theme .="<script src='"._DIR_PLUGIN_ARTY."javascript/fadeEffect.js' type='text/javascript' language='javascript'></script>\n";*/
    $inclusion_theme .="<script src='"._DIR_PLUGIN_ARTY."javascript/romette.js' type='text/javascript' language='javascript'></script>\n";

    // dans le theme
    $inclusion_theme .=generejavacss(_DIR_PLUGIN_ARTY."themes/".$dossier);
    // ajouter la declinaison
    if ($declinaison) {
        $inclusion_theme .= "<link href='"._DIR_PLUGIN_ARTY."themes/".$dossier."/declinaisons/".$declinaison."' rel='stylesheet' type='text/css' media='screen' />\n";
    }
    //dans le dossier pages-custom
    $inclusion_theme .=generejavacss("pages-custom");

    if(!ereg("media='print'",$inclusion_theme)){
        $inclusion_theme .="<link href='"._DIR_PLUGIN_ARTY."css/print.css' rel='stylesheet' type='text/css' media='print' />\n";
    }

    $larubbandeau=trouvelarub();
    $lebandeau=trouver_bandeau($larubbandeau);
    if($lebandeau){
        $lebandeau ="<style type='text/css'>
		<!--
		#bandeau { background-image: url(.$lebandeau); }
		-->
		</style>";

        $inclusion_theme .=$lebandeau;
    }
    return $inclusion_theme;
}

function trouver_bandeau($id_rubrique){
    $url_bandeau = false;
    $extensions = Array("jpg","png","gif");
    $id_parent = $id_rubrique;

    // TODO : mazu Gestion db devrait alléger le processus
    if($id_parent >= 0){
        foreach($extensions as $ext){
            if (file_exists(_DIR_IMG."bandeau/bandeau-$id_rubrique.$ext")){
                $url_bandeau = "/"._DIR_IMG."bandeau/bandeau-$id_rubrique.$ext";
                return $url_bandeau;
            }
        }
        
        while($id_parent != 0) {
            // un bandeau est-il présent pour cette rubrique?
            foreach($extensions as $ext){
                if (file_exists(_DIR_IMG."bandeau/bandeau-$id_rubrique.$ext")){
                    $url_bandeau = "/"._DIR_IMG."bandeau/bandeau-$id_rubrique.$ext";
                    return $url_bandeau;
                }
            }
            // sinon, continuer et vérifier pour le parent
            $result = spip_query("SELECT id_parent FROM spip_rubriques WHERE id_rubrique=$id_rubrique");
            $row = spip_fetch_array($result);
            $id_parent = $row['id_parent'];
            $id_rubrique = $id_parent;
        }
    }
     // aucun bandeau spécifique n'a été trouvé
     foreach($extensions as $ext){
     if (file_exists(_DIR_IMG."bandeau/bandeau.".$ext)){
     $url_bandeau = "/"._DIR_IMG."bandeau/bandeau.".$ext;
     }
     }

    return $url_bandeau;
}

function trouvelarub() {
    if (isset($GLOBALS['contexte']['id_rubrique'])) {
        // si c'est une page rubrique, trouver le thème de la rubrique ou des rubriques parentes
        $id_rubrique = $GLOBALS['contexte']['id_rubrique'];
    } else if (isset($GLOBALS['contexte']['id_article'])) {
        // si c'est un article, trouver sa rubrique et ensuite son thème, ou le thème des rubriques parentes 
        $result = spip_query("SELECT id_rubrique FROM spip_articles WHERE id_article='".addslashes($GLOBALS['contexte']['id_article'])."'");
        $row = spip_fetch_array($result);
        $id_rubrique = $row['id_rubrique'];
    } else {
        $id_rubrique=0;
    }

    return $id_rubrique;
}

// lire le dossier, en extraire css et javascript
function generejavacss($dossiertheme) {
    $inclusion_theme="";
    if(is_dir($dossiertheme)){
        $liste_ignore = Array(".","..",".DS_Store");
        $handle = opendir($dossiertheme);
        while ($fichier=readdir($handle)){
            if (!in_array($fichier, $liste_ignore)){
                if (eregi("^[a-zA-Z0-9_-]*\.css$",$fichier)) {
                    if ($fichier=="print.css") {
                        $inclusion_theme .="<link href='".$dossiertheme."/".$fichier."' rel='stylesheet' type='text/css' media='print' />\n";
                    } else {
                        $inclusion_theme .= "<link href='".$dossiertheme."/".$fichier."' rel='stylesheet' type='text/css' media='screen' />\n";
                    }
                } elseif (eregi("\.js$",$fichier)) {
                    $inclusion_theme .="<script src='".$dossiertheme."/".$fichier."' type='text/javascript' language='javascript'></script>\n";
                } elseif (eregi("\.ico$",$fichier)) {
                    $inclusion_theme .="<link rel='shortcut icon' href='".$dossiertheme."/".$fichier."' />\n";
                }
            }
        }
    }
    return $inclusion_theme;
}

?>
