<?php
/**
 * @name 		ADX MENU | SPIP 2.0 plugin
 * @author 		Piero Wbmstr <@link piero.wbmstr@gmail.com>
 * @copyright 	CreaDesign 2009 {@link http://creadesignweb.free.fr/}
 * @license		(c) 2009 GNU GPL v3 {@link http://opensource.org/licenses/gpl-license.php GNU Public License}
 * @version 	0.2 (06/2009)
 *
 * BASED ON :
 * - ADXmenu.js V4.21
 *   By Aleksandar Vacic (aplus.co.yu)
 *   Under CC BY 3.0 Attribution license.
 */
if (!defined("_ECRIRE_INC_VERSION")) return;

function balise_SCROLLBOX_dist($p) {
	return calculer_balise_dynamique($p, scrollbox, array());
}

function balise_scrollbox_dyn($id_div, $width=20, $a_size=20, $arrow=true) {
	$div = 
'<script type="text/javascript">
$(function(){
	$("'.$id_div.'").jScrollPane({ showArrows: '.$arrow.', scrollbarWidth: '.$width.', arrowSize: '.$a_size.' ,dragMaxHeight: "200"});
});
</script>
';
	echo $div;
}
?>