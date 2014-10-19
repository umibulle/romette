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

function chercheid($texte,$queltype="article") {
	if (ereg ("($queltype=[a-zA-Z0-9' _-]{1,255})", $texte, $regs)) {
		return ereg_replace("$queltype=","",$regs[0]);
	} else { return ""; }
}

function chercheextension($texte){
	$texte = strtolower(end(explode(".", $texte)));
	return $texte;
}

function addghost($texte) {
	if (ereg("article.php3",$texte)) {
		$texte = $texte. "&fond=ghost";
		$texte = ereg_replace("article.php3", "page.php3", $texte);
	}

	if (ereg("spip.php", $texte)) {
		$texte=ereg_replace("article", "page=ghost&id_article=",$texte);

	}
	return $texte;
}

function trouvepage($texte){
	if (ereg ("(page=[a-zA-Z0-9' _-]{1,255})", $texte, $regs)) {
		return $regs[0];
	} else if (ereg ("article[0-9]{1,5}|rubrique[0-9]{1,5}|mot[0-9]{1,5}|groupe[0-9]{1,5}", $texte, $regs)) {
		// c'est une page type
		return $regs[0];
	} else { return ""; }
}

function envpart($texte,$lequel=0){
	$texte=explode("|",$texte);
	if($lequel <= count($texte)) {
		return $texte[$lequel];
	} else {
		return "";
	}
}

function tableau2in($texte){
	$texte=explode("|",$texte);
	return $texte;
}

function tableau2invirgule($texte){
	$texte=explode(",",$texte);
	return $texte;
}

function tableau2array($texte,$split){
	$texte=explode($split,$texte);
	return $texte;
}

function element($texte,$element) {
	$result="rien";
	if (is_array($texte))   //echo " \$texte n'est pas un tableau <br> \n";  
	{
	foreach($texte as $elem => $param){
		if ($elem == $element){
			$result=$param;
		}
	}}
	return $result;
}

function taille_img_diaporama($largeur,$hauteur,$destlargeur=600,$desthauteur=500) {

	$neolargeur=0;
	$neohauteur=0;
	// calcule la largeur sur base du rapport hauteurlargeur
	if ($largeur > $destlargeur) {
		$neolargeur=$destlargeur;
		$neohauteur=($hauteur/($largeur/$destlargeur));
	}

	if (($neohauteur > $desthauteur) or ($neohauteur==0 and ($hauteur > $desthauteur))) {
		//on reduit donc sur base de desthauteur
		$neohauteur=$desthauteur;
		$neolargeur=$largeur/($hauteur/$desthauteur);
	}

	// si ni neohauteur ni neolargeur ne sont definis, c'est qu'ils sont corrects
	if ($neohauteur == 0) { $neohauteur=$hauteur; }
	if ($neolargeur == 0) { $neolargeur=$largeur; }


	return array($neolargeur,$neohauteur);
}

// remonte l'arborescence et retourne le premier thème trouvé pour une rubrique donnée 
function premier_theme($id_rubrique){
	$id_parent = $id_rubrique;
	while($id_parent != 0) {
		// un thème est-il présent pour cette rubrique?
		$result = spip_query("SELECT id_theme FROM spip_magu_themes_rubriques WHERE id_rubrique=$id_rubrique");
		if (spip_mysql_count($result) == 1) {
			$row = spip_fetch_array($result);
			return $row['id_theme'];
		}
		// sinon, continuer et vérifier pour le parent
		$result = spip_query("SELECT id_parent FROM spip_rubriques WHERE id_rubrique=$id_rubrique");
		$row = spip_fetch_array($result);
		$id_parent = $row['id_parent'];
		$id_rubrique = $id_parent;
	}
	// aucun thème n'a été trouvé, on prend le thème par défaut
	$result = spip_query("SELECT id_theme FROM spip_magu_themes_rubriques WHERE id_rubrique=0");
	$row = spip_fetch_array($result);
	return $row['id_theme'];
}

// retourne le logo d'un bloc libre si il existe
function logo_bloc($id_bloc){
	$handle = @opendir("IMG/illu-bloc-libre/");
	while($fichier = @readdir($handle)) {
		if (ereg("^illu_bloc_libre-$id_bloc\.(jpg|png|gif)$", $fichier)) {
			$logo = $fichier;
		}
	}
	if (!isset($logo)){
		return false;
	} else {
		return "IMG/illu-bloc-libre/$logo";
	}
}

// retourne le logo d'un groupe si il existe
function logo_groupe($id_groupe){
	$handle = @opendir("IMG/logo-groupe/");
	while($fichier = @readdir($handle)) {
		if (ereg("^logo-$id_groupe\.(jpg|png|gif)$", $fichier)) {
			$logo = $fichier;
		}
	}
	if (!isset($logo)){
		return false;
	} else {
		return "IMG/logo-groupe/$logo";
	}
}

function controlelargeur($texte) {
	if ($texte==0) { $texte= 160; };
	return $texte;
}

function controlehauteur($texte) {
	if ($texte==0) { $texte = 120; };
	return $texte;
}

function nospace($texte) {
	$texte = ereg_replace("&nbsp;", "", $texte);
	$texte = ereg_replace(" ", "", $texte);
	return $texte;
}

function no_accent($chaine){
	$chaine = strtr
	// La ligne suivante entre parenthèse doit être sur une seule ligne, sinon erreur php
	($chaine,  "À�?ÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌ�?Î�?ìíîïÙÚÛÜùúûüÿÑñ", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	$chaine = str_replace("\"", "&quot;", $chaine);
	return $chaine;
}



/*
 *   +-------------------------------------+
 *    Nom du Filtre : Conversion des ancres
 *   +-------------------------------------+
 *    Date : vendredi 18 juin 2004
 *    Auteur :  AliGator (aligator@macfr.com)
 *   +-------------------------------------+
 *    Fonctions de ce filtre :
 *      Ce script permet de gérer les ancres insérées dans un
 *      article sous la forme [nomancre<-] ou [#nomancre<-]
 *      pour les remplacer par une ancre HTML (<a name="#nomancre"></a>)
 *      Ceci vous permet d'autoriser les auteurs des articles sur votre site
 *                à utiliser ce nouveau "raccourci typographique"
 *   +-------------------------------------+
 */

function gerer_ancres($texte)
{
	$res = preg_replace("|\[\#?([A-Za-z0-9_]*)<-\]|U" ,
                "<a name=\"\$1\"></a>" , $texte);
	return $res;
}

function vignettewebmaton($texte) {
	$texte= ereg_replace("/mp4/","/webmaton-vignettes/",$texte);
	$texte = ereg_replace("\.mp4$", ".png", $texte);
	if (file_exists($texte)) {
		return $texte;
	}
}

function transguillemet ($texte) {
	$texte = ereg_replace("\"", "''", $texte);
	$texte = ereg_replace("\n", "", $texte);
	$texte = ereg_replace("\t", " ", $texte);
	return $texte;
}

function lienitunes($texte){
	$texte = ereg_replace("^http://", "itpc://", $texte);
	return $texte;
}

function nomfichier($texte) {
	$texte = explode('/', trim($texte, "/"));
	return end($texte);
}

function sans_newline($texte){
	$texte = ereg_replace("\n", "", $texte);
	return $texte;
}

function premiere_lettre($texte){
	$premiere = $texte{0};
	if (eregi("^[a-z]$",$premiere)) {
		return strtoupper($premiere);
	} else {
		return "#";
	}
}

function balise_THEME($params) {
	include_spip('inc/cherche-theme');
	$theme=theme_actuel();
	$morceaux=explode("|",$theme);
	$params->code = "$morceaux[0]";
	$params->type = 'html';
	return $params;
}

function balise_LARGEUR_CORPS($params) {
	$largeur=trouveintheme('LARGEURCORPS', '480');
	$params->code = "'$largeur'";
	$params->type = 'html';
	return $params;
}

function balise_LARGEUR_CONTEXTE1($params) {
	$largeur=trouveintheme('LARGEURCONTEXTE1', '150');
	$params->code = "'$largeur'";
	$params->type = 'html';
	return $params;
}

function balise_LARGEUR_CONTEXTE2($params) {
	$largeur=trouveintheme('LARGEURCONTEXTE2', '120');
	$params->code = "'$largeur'";
	$params->type = 'html';
	return $params;
}

function trouveintheme($quoi, $defaut) {
	include_spip('inc/cherche-theme');
	include_spip('inc/xml-parser');

	$letruc=$defaut;
	$quoi=strtoupper($quoi);

	$theme=theme_actuel();
	$morceaux=explode("|",$theme);
	if (count($morceaux)==1) {

		$declinaison=FALSE;
	} else {
		$declinaison=$morceaux[1];
	}

	$theme=$morceaux[0];

	$p =& new xmlParser();
	$p->parse(_DIR_PLUGIN_ARTY.'themes/'.$theme.'/theme.xml');
	foreach($p->output[0]['child'] as $tag) {
		if ($tag['name']==$quoi) {
			$letruc=$tag['content'];
		}

		if ($tag['name']=='DECLINAISON' && $tag['attrs']['CHEMIN']==$declinaison) {
			foreach($tag['child'] as $tagchild) {
				if ($tagchild['name']==$quoi) {
					$letruc=$tagchild['content'];
				}
			}
		}

	}

	return $letruc;
}

function parametres($texte){
	// fabrique un array associatif des parametres du site, une seule lecture xml donc.
	include_spip('inc/cherche-theme');
	include_spip('inc/xml-parser');

	$theme=theme_actuel();
	$morceaux=explode("|",$theme);
	if (count($morceaux)==1) {
		$declinaison=FALSE;
	} else {
		$declinaison=$morceaux[1];
	}
	$theme=$morceaux[0];

	$params_acceptes =array("separateur","titre");

	if($texte == "theme") {
		$letruc=$theme;
	} else if (in_array($texte,$params_acceptes))  {
		$p =& new xmlParser();
		$p->parse(_DIR_PLUGIN_ARTY.'themes/'.$theme.'/theme.xml');
		$texte=strtoupper($texte);
		$letruc=trouvelem($p->output[0]['child'],$declinaison,$texte,"");
	} else {
		$p =& new xmlParser();
		$p->parse(_DIR_PLUGIN_ARTY.'themes/'.$theme.'/theme.xml');

		$navigation=trouvelem($p->output[0]['child'],$declinaison,"NAVIGATION","general");
		$chemin=trouvelem($p->output[0]['child'],$declinaison,"CHEMIN_PAGE","general");
		$footer=trouvelem($p->output[0]['child'],$declinaison,"FOOTER","general");
		$contenus=trouvelem($p->output[0]['child'],$declinaison,"DIV_CONTENUS","non");

		$letruc=array("theme" => $theme,"navigation" => $navigation,"footer" => $footer, "chemin" => $chemin,"contenus" => $contenus);
	}

	return $letruc;
}

function trouvelem($tableau,$declinaison,$elem,$defaut){
	$elemtrouve=$defaut;
	foreach($tableau as $tag) {
		if ($tag['name']==$elem) {
			$elemtrouve=$tag['content'];
		}

		if ($tag['name']=='DECLINAISON' && $tag['attrs']['CHEMIN']==$declinaison) {
			foreach($tag['child'] as $tagchild) {
				if ($tagchild['name']==$elem) {
					$elemtrouve=$tagchild['content'];
				}
			}
		}

	}
	return $elemtrouve;
}

?>
