<?php
if (!defined("_ECRIRE_INC_VERSION")) return;
	
// ini_set('display_errors','1'); error_reporting(E_ALL);
$p=explode(basename(_DIR_PLUGINS)."/",str_replace('\\','/',realpath(dirname(__FILE__))));
define('_DIR_SCROLLBOX',(_DIR_PLUGINS.end($p)));

function scrollbox_insert_head($flux){
	$flux .= "\n<script src='".url_absolue(find_in_path('javascript/jquery.mousewheel.js'))."' type='text/javascript'></script>"
		."\n<script src='".url_absolue(find_in_path('javascript/jquery.scrollpane.js'))."' type='text/javascript'></script>"
		."\n<link rel='stylesheet' href='".url_absolue(find_in_path('css/jScrollPane.css'))."' type='text/css' media='projection, screen, tv' />";
	return $flux;
}

?>