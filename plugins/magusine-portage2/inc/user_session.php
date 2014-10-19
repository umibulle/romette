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

// cr�e une session et g�n�re un id unique qui sera utilis� pour v�rifier les actions transmises par url (id_check
session_start();
if (!isset($_SESSION['id_check'])){
	$_SESSION['id_check'] = uniqid(rand());
}
?>
