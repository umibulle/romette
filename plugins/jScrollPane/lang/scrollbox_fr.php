<?php

$GLOBALS[$GLOBALS['idx_lang']] = array(
	'testing_page_titre' => 'Page de test du plugin jScrollPane',	
	'doc_titre_court' => 'Documentation jScrollPane',	
	'doc_titre_page' => 'Documentation du plugin jScrollPane',	
	'doc_chapo' => 'Le plugin jScrollPane pour SPIP 2.0 ({et plus}) est une int&eacute;gration dans SPIP du plugin jQuery "{{jScrollPane}}" de <u>Kelvin Luck</u> ({[plus d\'infos->#bloc_licence]}) ; il permet de g&eacute;n&eacute;rer des scrollers personnalis&eacute;s en javascript sur des blocs CSS.',
	'exemple' => '{{{Exemple}}}

Le bloc ci-dessous vous pr&eacute;sente un exemple de bloc &eacute;quip&eacute; d\'un scroller.',
	'documentation' => '{{{Utilisation du mod&egrave;le}}}

Le scroller s\'utilise dans vos squelettes gr&acirc;ce &agrave; la balise {{&#035;SCROLLBOX}} avec les options suivantes :

<cadre class=\'spip\'>
[(&#035;SCROLLBOX{ &#035;div_id , width , arrow_width , arrow_visible })]
</cadre>
avec les options suivantes :
-* {{div_id}} (obligatoire) : l\'identifiant ou la classe du bloc CSS sur lequel appliquer les scrollers ({bien pr&eacute;ciser le di&egrave;se ou le point}),
-* {{width}} (20px par d&eacute;faut) : l\'&eacute;paisseur du dragueur,
-* {{arrow_width}} (20px par d&eacute;faut) : la taille des fl&egrave;ches,
-* {{arrow_visible}} (par d&eacute;faut "oui") : doit-on pr&eacute;senter les fl&egrave;ches ou non.

{{{Personnalisation}}}

Vous pouvez personnaliser le styles CSS des scrollers dans le fichier "css/jScrollPane.css" ({diff&eacute;rents sets d\'images sont propos&eacute;s dans le r&eacute;pertoire "img_pack/"}).

{{{Conditions d\'utilisation}}}

{{Attention :}}
- V&eacute;rifiez bien que vos squelettes utilisent la balise &#035;INSERT_HEAD[[C\'est le cas des squelettes de la distribution standard de SPIP.]]!
- V&eacute;rifiez bien que les deux plugins jQuery ci-dessous ne soient pas d&eacute;j&agrave; pr&eacute;sents dans vos pages[[Si un conflit survient, commentez le contenu de la fonction "scrollbox_insert_head()" du fichier "scrollbox_options.php".]]!

{{Licences :}}
- {{jquery.mousewheel.js}} (v. 3.0 pour jQuery 1.2.2+) : copyright &#169; 2006 [Brandon Aaron->http://brandonaaron.net] [MIT->http://www.opensource.org/licenses/mit-license.php]/[GPL->http://www.opensource.org/licenses/gpl-3.0.html]
- {{jquery.scrollpane.js}} : copyright &#169; 2006 [Kelvin Luck->http://www.kelvinluck.com] [MIT->http://www.opensource.org/licenses/mit-license.php]/[GPL->http://www.opensource.org/licenses/gpl-3.0.html]
',
	'titre_original' => 'jScrollPane, plugin pour SPIP 2.0+',
	'licence_originale' => 'Plugin original pour jQuery : {{"jScrollPane" - copyright &#169; 2006 [Kelvin Luck->http://www.kelvinluck.com] sous double licence [MIT->http://opensource.org/licenses/mit-license.php]/[GPL->http://www.opensource.org/licenses/gpl-3.0.html]}}.',
	'licence_actuelle' => 'Plugin pour SPIP 2.0+ : {{"jScrollPane" - copyright &#169; 2009 [Piero Wbmstr->http://www.spip-contrib.net/PieroWbmstr] sous les licences originales ({[MIT->http://opensource.org/licenses/mit-license.php]/[GPL->http://www.opensource.org/licenses/gpl-3.0.html]}) }}.',

	'lorem_ipsum' => '{{{Maecenas libero lectus}}} 

Eleifend congue, hendrerit eu, posuere accumsan, magna. Aenean euismod. Donec lobortis vestibulum sapien. Morbi pharetra ipsum ac nibh. Vestibulum quis mauris. Duis pulvinar lectus quis lectus. In hac habitasse platea dictumst. Ut consequat, nunc vel dictum faucibus, ante quam iaculis mi, sed gravida neque justo eu tellus. Sed vel massa vel orci laoreet luctus. Nulla facilisi. In risus. Cras et quam. Praesent sit amet mi. Maecenas consequat. Pellentesque consectetuer. Integer at urna non erat dapibus vehicula. Phasellus eu magna. In purus erat, consequat nec, ultrices a, sollicitudin id, leo.

{{Integer ultricies fringilla nunc. Fusce tempor augue vel tortor. Nullam at ante. Mauris faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque sodales interdum augue. Vivamus tempor viverra lacus. Mauris rutrum augue sit amet nisi. Mauris eleifend euismod sapien. In augue dui, dictum id, lobortis ac, aliquet in, libero.}}

{Proin ornare ligula vitae tellus.} Pellentesque risus felis, tempus eget, placerat et, elementum at, ipsum. Suspendisse faucibus gravida quam. Fusce odio. Maecenas mattis pharetra felis. Nam in nunc vitae velit vehicula suscipit. Duis accumsan, lorem non tristique rhoncus, lacus purus imperdiet nunc, eget feugiat augue metus eget justo. Donec quis dui a dui condimentum egestas. Nullam eget arcu. In placerat pulvinar lacus.

Nunc in ipsum. Mauris id ante. [Fusce lacinia->www.example.com]. Nullam laoreet ligula in pede. Vestibulum nunc purus, venenatis quis, blandit eget, congue at, risus. Sed orci. Nulla facilisi. Vestibulum vitae sem. Integer dignissim tortor vitae sem. Donec quis sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nonummy semper felis.

Nunc non nibh. Suspendisse potenti. Mauris elementum interdum nunc. Donec sit amet tortor. Morbi vehicula mauris at odio. Maecenas commodo ultricies orci. Vivamus varius quam. Aenean auctor lorem sit amet magna. Fusce quis tellus. Vestibulum placerat vulputate lorem. Nulla elementum mattis nisi. Integer nunc mauris, fringilla id, semper eget, sollicitudin ac, sapien.

Donec pretium velit ut massa hendrerit bibendum. Nullam elit orci, posuere vel, imperdiet ac, interdum vitae, tellus. Etiam nisl. Mauris iaculis erat eu nisi gravida accumsan. Pellentesque pharetra. Fusce in quam nec ante euismod cursus. Etiam diam. Proin aliquam, nibh malesuada fringilla blandit, ante orci feugiat sem, ut vehicula risus mauris non augue. Etiam dapibus elit ac massa. Praesent vitae metus. In sed augue. Suspendisse potenti. Vivamus lacinia justo ullamcorper arcu. Duis accumsan urna tempus dolor. Morbi felis. Nullam tortor urna, tincidunt tincidunt, luctus sodales, facilisis in, felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec in tellus.

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pede nisl, suscipit id, bibendum vel, euismod a, urna. Aliquam ut arcu. Nulla ullamcorper mauris ut velit. Etiam consectetuer ipsum id ligula. Nam euismod ipsum vitae felis. Quisque pede ante, pretium et, fermentum vel, tempor eget, dolor. Phasellus eu pede. Suspendisse bibendum, ligula at porta convallis, lacus mauris egestas risus, vitae scelerisque ante mauris a erat. Aenean varius ligula sed dui. Etiam pellentesque facilisis eros. In interdum orci. In augue pede, hendrerit ac, facilisis ut, convallis luctus, sapien. Nulla metus. Vestibulum neque justo, convallis eu, varius egestas, posuere eu, libero. Pellentesque nec elit nec diam commodo euismod. Aliquam aliquet convallis est. Integer consectetuer nibh non urna. Nam ultrices mauris.',
	// Infos squelette de documentation
	'docskel_sep' => '----',
	'info_doc' => 'Si vous rencontrez des probl&#232;mes pour afficher cette page, [cliquez-ici->@link@].',
	'info_doc_titre' => 'Note concernant l&#039;affichage de cette page',
	'info_skel_doc' => 'Cette page de documentation est con&#231;ue sous forme de squelette SPIP fonctionnant avec la distribution standard ({fichiers du r&#233;pertoire &#034;squelettes-dist/&#034;}). Si vous ne parvenez pas &#224; visualiser la page, ou que votre site utilise ses propres squelettes, les liens ci-dessous vous permettent de g&#233;rer son affichage :

-* [Mode &#034;texte simple&#034;->@mode_brut@] ({html simple + balise INSERT_HEAD})
-* [Mode &#034;squelette Zpip&#034;->@mode_zpip@] ({squelette Z compatible})
-* [Mode &#034;squelette SPIP&#034;->@mode_spip@] ({compatible distribution})',
	'info_skel_contrib' => 'Page de documentation compl&egrave;te en ligne sur spip-contrib : [->http://www.spip-contrib.fr/?article3571].',
);
?>
