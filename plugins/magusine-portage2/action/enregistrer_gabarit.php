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

if (!defined("_ECRIRE_INC_VERSION")) return;

function action_enregistrer_gabarit_dist(){

    $post    = $_POST;
    $gabarit = _request('gabarit');
    // correspondance entre conteneur et valeur numerique
    $colonnes=array("contexte1" => 1,"contexte2" => 2,"corps" => 3,"reserve" =>0,"avance"=> 4);

    foreach(array_keys($colonnes) as $colonne) {
        if (in_array($colonne, array_keys($post)))	{
            foreach($post[$colonne] as $ordre => $bloc) {

                // est-ce qu'il y a un parametre pour ce bloc ?
                if ($post[$bloc]) {
                    $parametre=addslashes($post[$bloc]);
                } else { $parametre =""; }

                $bloc=addslashes($bloc);
                // fait la correspondance entre le nom du conteneur et son equivalent numerique (0,1 etc.) pour entrer dans la base
                $colonnenum = $colonnes[$colonne];
                $ordre =(int) $ordre;
                $resultat = spip_query("SELECT id_bloc FROM spip_arty_gabarit_ordre WHERE gabarit='$gabarit' AND nom='$bloc'");

                //echo "sommaire : colonne :".$colonne." et bloc : ".$bloc." et ordre :".$ordre."\n";
                if(spip_mysql_count($resultat)) {
                    $row=spip_fetch_array($resultat);
                    spip_query("UPDATE spip_arty_gabarit_ordre SET ordre=$ordre, conteneur=$colonnenum, param='$parametre' WHERE id_bloc=".$row['id_bloc']);
                    	
                } else {
                    spip_query("INSERT INTO spip_arty_gabarit_ordre (nom, ordre, conteneur, gabarit, param) VALUES ('$bloc', $ordre, $colonnenum, '$gabarit', '$parametre') ");

                }
            }
        }
    }

    echo _T("arty:le_changement_a_ete_effectue");
    exit();
}
?>