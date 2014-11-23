<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2014                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;
include_spip('inc/presentation');

// Script de validation XML selon une DTD
// l'argument var_url peut indiquer un fichier ou un repertoire
// l'argument ext peut valoir "php" ou "html"
// Si "php", le script est execute et la page valide
// Si "html", on suppose que c'est un squelette dont on devine les args
// en cherchant les occurrences de Pile[0].
// Exemples:
// ecrire?exec=valider_xml&var_url=exec&ext=php pour tester l'espace prive
// ecrire?exec=valider_xml&var_url=../squelettes-dist&ext=html pour le public

// http://doc.spip.org/@exec_valider_xml_dist
function exec_valider_xml_dist()
{
	if (!autoriser('sauvegarder')) {
		include_spip('inc/minipres');
		echo minipres();
	} else valider_xml_ok(_request('var_url'), _request('ext'), intval(_request('limit')), _request('recur'));
}

// http://doc.spip.org/@valider_xml_ok
function valider_xml_ok($url, $req_ext, $limit, $rec)
{
	$url = urldecode(trim($url));
	$rec = !$rec ? false : array();
	if (!$limit) $limit = 200;
	$titre = _T('analyse_xml');
	if (!$url) {
		$url_aff = 'http://';
		$onfocus = "this.value='';";
		$texte = $bandeau = $err = '';
	} else {
		include_spip('inc/distant');
		if (is_dir($url)) {
			$dir = (substr($url,-1,1) === '/') ? $url : "$url/";
			$ext = !preg_match('/^[.*\w]+$/', $req_ext) ? 'php' : $req_ext;
			$files = preg_files($dir,  "$ext$", $limit, $rec);
			if (!$files AND $ext!=='html') {
				$files = preg_files($dir, 'html$', $limit, $rec);
				if ($files) $ext = 'html';
			}
			if ($files) {
				$res = valider_dir($files, $ext, $url);
				$mode = (($ext === 'html') AND substr_count($dir, '/') <= 1);
				list($err, $terr, $res) = valider_resultats($res, $mode);
				$err = '<br /><h2>' . $terr . " " . _T('erreur_texte') . " ($err/" . count($files) .')</h2>';
				$res = $err . $res;
			} else {
				$res = _T('texte_vide');
				$err = '';
			}
			$bandeau = $dir . '*' . $ext ;
		} else {
			if (preg_match('@^((?:[.]/)?[^?]*)[?]([0-9a-z_]+)=([^&]*)(.*)$@', $url, $r)) {
			  list(,$server, $dir, $script, $args) = $r;
				if (((!$server) OR ($server == './') 
				    OR strpos($server, url_de_base()) === 0)
				    AND is_dir($dir)) {
				  $url = $script;
				  // Pour quand le validateur saura simuler 
				  // une query-string...
				  // $args = preg_split('/&(amp;)?[a-z0-9_]+=/', $args);
				  $args = true;
				}
			} else { $dir = 'exec'; $script = $url; $args = true;}

			$transformer_xml = charger_fonction('valider', 'xml');
			$onfocus = "this.value='" . addslashes($url) . "';";
			if (preg_match(',^[a-z][0-9a-z_]*$,i', $url)) {
				if (($dir=='exec') AND (tester_url_ecrire($url) == 'fond')) {
					include_spip('exec/fond');
					$args = array($url, array());
					$url = 'fond_args';
				}
				$res = valider_script($transformer_xml, $script, $dir, $ext, $args);
				$url_aff = $res[3];
			} else {
				$res = $transformer_xml(recuperer_page($url));
				$url_aff = entites_html($url);
			}
			if ($res[1]) {
				list($texte, $err) = emboite_texte($res);
			}
			else {
				$err = '<h3>' . _T('spip_conforme_dtd') . '</h3>x';
				list($texte, ) = emboite_texte($res);
			}

			$res =
			"<div style='text-align: center'>" . $err . "</div>" .
			"<div style='margin: 10px; text-align: left'>" . $texte . '</div>';
			$bandeau = "<a href='$url_aff'>$url</a>";
		}
	}
	$titre .= ' ' . $url_aff; 
	$commencer_page = charger_fonction('commencer_page', 'inc');
	$debut = $commencer_page($titre);
	$jq = http_script("", 'jquery.js');
	
	echo str_replace('<head>', "<head>$jq", $debut);
	$onfocus = '<input type="text" size="70" value="' .$url_aff .'" name="var_url" id="var_url" onfocus="'.$onfocus . '" />';
	$onfocus = generer_form_ecrire('valider_xml', $onfocus, " method='get'");

	echo "<h1>", $titre, '<br />', $bandeau, '</h1>',
	  "<div style='text-align: center'>", $onfocus, "</div>",
	  $res,
	  fin_page();
}

// http://doc.spip.org/@valider_resultats
function valider_resultats($res, $mode)
{
	$i = $j = $k = 0;
	$table = '';
	rsort($res);
	foreach($res as $l) {
		$i++;
		$class = 'row_'.alterner($i, 'even', 'odd');
		list($nb, $texte, $erreurs, $script, $appel, $temps) = $l;
		if ($texte < 0) {
			$texte = (0- $texte);
			$color = ";color: red";
		} else  {$color = '';}

		$err = (!intval($nb)) ? '' : 
		  ($erreurs[0][0] . ' ' . _T('ligne') . ' ' .
		   $erreurs[0][1] .($nb==1? '': '  ...'));
		if ($err) {$j++; $k+= $nb;}
		$h = $mode
		? ($appel . '&var_mode=debug&var_mode_affiche=validation')
		: generer_url_ecrire('valider_xml', "var_url=" . urlencode($appel));
		
		$table .= "<tr class='$class'>"
		. "<td style='text-align: right'>$nb</td>"
		. "<td style='text-align: right$color'>$texte</td>"
		. "<td style='text-align: right'>$temps</td>"
		. "<td style='text-align: left'>$err</td>"
		. "<td><a href='$h' title='$appel'>$script</a></td>";
	}

	return array($j, $k, "<table class='spip' width='95%'>"
	  . "<tr><th>" 
	  . _T('erreur_texte')
	  . "</th><th>" 
	  . _T('taille_octets', array('taille' => ' '))
	  . "</th><th>"
	  . _T('zbug_profile', array('time' =>''))
	  . "</th><th>"
	  . _T('public:message')
	  . "</th><th>"
	  . _T('ecrire:info_url')
	  . "</th></tr>"
	  . $table
	  . "</table>");
}

// http://doc.spip.org/@valider_script
function valider_script($transformer_xml, $script, $dir, $ext, $args=true)
{
	$script = basename($script, '.php');
	$dir = basename($dir);
	$f = charger_fonction($script, $dir, true);
// ne pas se controler soi-meme ni l'index du repertoire ni un fichier annexe

	if ($script == _request('exec') OR $script=='index' OR !$f)
		return array(0, array(), $script,''); 

	list($texte, $err) = $transformer_xml($f, $args);
	$appel = '';
	
	// s'il y a l'attribut minipres, le test est non significatif
	// le script necessite peut-etre des arguments.
	// On regarde alors s'il existe une fonction de meme nom
	// mais avec "_args" au bout:
	// elle est censee recevoir les valeurs de $_REQUEST  et ne pas faire
	// les controles d'autorisation (fait par la fonction principale)
	// Si ou on l'appelle avec des arguments arbitraires;
	// si nouvel echec on abandonne:
	// que faire contre l'absence de reflexivite et de typage de ce fichu PHP

	if (strpos($texte, "id='minipres'")
	AND ($g = charger_fonction($script . '_args', $dir, true))) {
		$args = array(1, 'id_article', 1, 0);
		list($texte, $err) = $transformer_xml($g, $args);
		$appel = 'id_article=1&type=id_article&id=1';
	}
	$appel = valider_pseudo_url($dir, $script, $appel);
	return array($texte, $err, $script, $appel);
}

// http://doc.spip.org/@valider_pseudo_url
function valider_pseudo_url($dir, $script, $args='')
{
	return  ($dir == 'exec')
	? generer_url_ecrire($script, $args, false, true)
	: ("./?$dir=$script" . ($args ? "&$args" : ''));
}

// On essaye de valider un texte meme sans Doctype
// a moins qu'un Content-Type dise clairement que ce n'est pas du XML
// http://doc.spip.org/@valider_skel
function valider_skel($transformer_xml, $file, $dir, $ext)
{
	if (!lire_fichier ($file, $text)) return array('/', '/', $file,''); 
	if (!strpos($text, 'DOCTYPE')) {
		preg_match(",Content[-]Type:\s*[^/]+/([^ ;]+),", $text, $r);
		if ($r[1] === 'css' OR $r[1] === 'plain')
		  return array(0, array(), $file,'');
	}

	if ($ext != 'html') {
		// validation d'un non squelette
		$page = array('texte' => $text);
		$url = url_de_base() . _DIR_RESTREINT_ABS . $file;
		$script = $file;
	} else {
		$script = basename($file,'.html');
		// les squelettes en sous-repertoire sont problematiques,
		// traitons au moins le cas prive/exec
		if (substr_count($dir, '/') <= 1) {
			$url = generer_url_public($script, $contexte);
		} else 	$url = valider_pseudo_url(basename($dir), basename($file, '.html'), $contexte);
		$composer = charger_fonction('composer', 'public');
		list($skel_nom, $skel_code) = $composer($text, 'html', 'html', $file);

		spip_log("compilation de $file en " . strlen($skel_code) .  " octets de nom $skel_nom");
		if (!$skel_nom) return array('/', 0, $file,''); 
		$contexte = valider_contexte($skel_code, $file);
		$page = $skel_nom(array('cache'=>''), array($contexte));
	}
	list($texte, $err) = $transformer_xml($page['texte']);
	return array($texte, $err, $script, $url);
}

// Analyser le code pour construire un contexte plausible complet
// i.e. ce qui est fourni par $Pile[0]
// en eliminant les exceptions venant surtout des Inclure
// Il faudrait trouver une typologie pour generer un contexte parfait:
// actuellement ca produit parfois des erreurs SQL a l'appel de $skel_nom
// http://doc.spip.org/@valider_contexte
function valider_contexte($code, $file)
{
	static $exceptions = array('action', 'doublons', 'lang');
	preg_match_all('/(\S*)[$]Pile[[]0[]][[].(\w+).[]](\S*)/', $code, $r, PREG_SET_ORDER);
	$args = array();
	// evacuer les repetitions et les faux parametres
	foreach($r as $v) {
		list(,$f, $nom, $suite) = $v;
		if (!in_array($nom, $exceptions)
		AND (!isset($args[$nom]) OR !$args[$nom]))
			$args[$nom] = ((strpos($f, 'sql_quote') !== false)
				AND strpos($suite, "'int'") !==false);
	}
	$contexte= array(); // etudier l'ajout de:
	// 'lang' => $GLOBALS['spip_lang'],
	// 'date' => date('Y-m-d H:i:s'));
	foreach ($args as $nom => $f) {
		if (!$f)
		  $val = 'id_article';
		else {
		  // on suppose que arg numerique => primary-key d'une table
		  // chercher laquelle et prendre un numero existant
		  $val = 0;
		  $type = (strpos($nom, 'id_') === 0)  ? substr($nom,3) : $nom;
		  $trouver_table = charger_fonction('trouver_table', 'base');
		  $table = $trouver_table(table_objet_sql($type));
		  if ($table)
		    $val = @sql_getfetsel($nom, $table['table'], '', '','',"0,1");
		    // porte de sortie si ca marche pas, 
		  if (!$val) $val = 1; 
		}
		$contexte[$nom] =  $val;
	}
	return $contexte;
}

// http://doc.spip.org/@valider_dir
function valider_dir($files, $ext, $dir)
{
	$res = array();
	$transformer_xml = charger_fonction('valider', 'xml');
	$valideur = $ext=='php' ? 'valider_script' : 'valider_skel' ;
	include_spip('public/assembler');
	foreach($files as $f) {
		spip_timer($f);
		$val = $valideur($transformer_xml, $f, $dir, $ext);
		// Ne pas saturer la memoire, donner juste la taille de la page
		// avec un nombre negatif quand c'est un message d'erreur
		if (is_string($val[0])) {
			$n = strlen($val[0]);
			$val[0] = strpos($val[0], "id='minipres'") ? (0-$n):$n;
		}
		$n = spip_timer($f); 
		$val[]= $n;
		array_unshift($val, count($val[1]));
		spip_log("validation de $f en $n secondes");
		$res[]= $val;
	}
	return $res;
}
?>
