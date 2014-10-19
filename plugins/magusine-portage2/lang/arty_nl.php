<?php

// FICHIER DE TRADUCTION DES PAGES OPTIONS ARTY
// Pour les caractères spéciaux HTML voir  
//  http://www.ilovejackdaniels.com/cheat-sheets/html-character-entities-cheat-sheet/
// Attention à échapper les guillements par backspace : "l'apostrophe" -> "l\'apostrophe"

// Pour la traduction de la partie publique voir local_**.php

$GLOBALS['i18n_arty_nl'] = array(

// TRADUCTIONS GENERALES
  'titre'                     => 'Titre',
  'acces_a_la_page'           => 'Seuls les administrateurs ont acc&egrave;s &agrave; cette page.',
  'modifier_cette_option'     => 'Modifier cette option',
  'info'                      => 'info',
  'erreur'                    => 'Erreur',
  'le_changement_a_ete_effectue' => 'Le changement a été effectué',

// messages d'erreur
  'erreur_extension'          => 'Ce type de fichier n\'est pas autoris&eacute;.',
  'upload_reussi'             => 'Image chargée avec succès.',
  'upload_rate'               => 'Impossible de charger l\'image.',
  'erreur_trop_gros'          => 'Le fichier est trop volumineux.',
  'erreur_transmission'       => 'Un probl&egrave;me est survenu pendant la transmission du fichier.',

// menu de navigation

// boutons
  'enregistrer'               => 'Enregistrer',
  'modifier_et_retour' => 'Enregister et revenir à la page',
  'supprimer'                 => 'Supprimer',
  'options_arty'              => 'Options Magusine',
// onglets
  'onglet_base'               => 'Configuration de base',
  'onglet_themes'             => 'Th&egrave;mes',
  'onglet_avance'             => 'Blocs libres',
  'onglet_menu'               => 'Menus',
  'onglet_gabarit'            => 'Gabarits',
  'onglet_a_propos'           => 'About',
  
// blocs libres
  'titre_bloc_defaut'         => 'Titre du bloc libre',
  'texte_bloc_defaut'         => 'Texte du bloc libre',
  'logo_bloc'                 => 'Logo du bloc libre:',
  'modifier_bloc_libre'       => 'Modifier ce bloc',
  'supprimer_bloc'            => 'Supprimer ce bloc',
  'charger_une_image'         => 'Ajouter une image &agrave; ce bloc:',
  'charger_autre_image'       => 'Remplacer l\'image de ce bloc:',
  'supprimer_bandeau'         => 'Supprimer ce bandeau',
  'entrez_donnees_nouveau_bloc' => 'Titre et texte du bloc libre',
  'bloc_lien'                 => 'Lien (s\'applique sur l\'image et le texte du bloc, optionnel)',
  'bloc_image'                => 'Illustration du bloc (optionnel)',
  
// bloc de logo de rubrique
 'intro_up_rub_bandeau' => 'Cliquez sur le bouton "Choisir le fichier" pour ajouter/modifier le bandeau de cette rubrique',
 'titre_up_rub_bandeau' => 'Bandeau de cette rubrique',
 'invit_up_rub_bandeau' => 'Modifier le bandeau',
 'upload_reussi'        => 'Upload réussi !',
 'bandeau_actuel'       => 'Bandeau actuel',
 'aucun_bandeau_rub'    => 'Actuellement aucun bandeau.',

// TRADUCTIONS SPECIFIQUES
//ARTY.php - Options de base
  // titre page
  'titre_options_base'        => 'Options ARTY de base',
  'titre_configuration_base'  => 'Configuration de base',
  'sideinfo_arty'             => 'Dans cette page, vous pouvez sélectionner les rubriques d\'où proviendrons les contenus de l\'éditorial, des news, etc.',
  'edito'                     => 'Sélection de l\'editorial',
  'choix_rubrique_news'       => 'Choix de la rubrique de news',
  'rubrique_article_une'      => 'Rubrique et articles à la une',
  'pas_de_une'                => 'Pas de rubrique ou d\'article à la une',
  'explication_choix_rubrique_news' => 'Les news sont des informations courtes sur votre activité. Il s\'agit techniquement de breves écrites dans une rubrique.',
  'video_au_hasard'     => 'Choix de la rubrique de vidéo au hasard',
  'pas_de_image_hasard' => 'Pas d\'image au hasard',
 'cacher_edito'=> 'Cacher l\'édito (masquer l\'éditorial dans les listes)',
 'lire_autres_editos' => 'Afficher le lien "lire les autres éditos"',
 'ajouter_un_lien'=> 'Ajouter un lien manuellement',
  
  // bloc aide
  'titre_aide_base'           => 'Aide',
  'aide_options_base'         => 'Si vous n\'avez que peu de temps &#224; consacrer &agrave; la personnalisation de votre site, concentrez vos efforts sur cette page.',
  
  // Page menu
  'si_pas_langue'      => 'Si la langue pour laquelle vous voulez créer un menu ne se trouve pas dans cette liste, c\'est que vous n\'avez pas encore assigné cette langue à une rubrique ou un article.',
  'titre_options_menu' => 'Création des menus',
  'intro_menu'         => 'Cette page vous permet de créer le menu de votre site. Vous pouvez y disposer des rubriques, des articles ainsi que des groupes de mots-clés et des mots-clés. Vous pouvez ensuite agencer l\'ordre de ces éléments.',
  'menu_actuel'        => 'Menu pour la langue',
  'type_de_menu'       => 'Type de menu',
  'menu_reservoir'     => 'Choisissez les éléments à inclure dans le menu',
  'nom_lien' => 'Nom du lien:',
  'url_lien'=> 'Adresse url du lien:',
  'un_niveau'=> 'Un niveau',
  'deux_niveaux' => 'Deux niveaux',
  'manuel'   => 'Manuel',
  'nombre_niveaux_menu' => 'Vous pouvez choisir entre 3 types de menus.',
  'intro_niveaux_menu' => 'Dans le menu, vous pouvez juste faire s\'afficher les noms des rubriques (1 niveau) mais aussi ceux des sous-rubriques (2 niveaux). Si vous choisissez le mode manuel, vous devez choisir chaque élément à afficher dans le menu.',
  'intro_lister_articles' => 'Cochez la case ci-dessous si vous voulez lister les articles (et les mots-clés des groupes) dans le second niveau.',
  'lister_articles' => 'Lister les articles et les mots-clés également.',
  'choix_de_la_langue_menu' => 'Info',
  'rubrique' => 'Rubrique',
  'article' => 'Article',
  'groupe' => 'Groupe mots',
  'mot' => 'Mot-clé', 
  'intro_choix_niveaux' => 'Choisissez ici le nombre de niveaux à afficher:',
  'n_niveaux' => 'L\'arborescence complète',
  'intro_menu_manuel' => 'En choisissant le mode manuel, vous pouvez définir un à un les éléments à inclure dans l\'arborescence du menu.',
  'avis_menu_auto' => 'Tant qu\'aucun élément n\'a été inséré dans le menu, celui-ci fonctionne en mode automatique.',
  
  // page article
  'galerie_image'  => 'Galerie image',
  'intro_creer_bloc' => 'Ajouter un bloc libre',
  
//PAGE THEMES
  'sideinfo_theme' => 'Ici vous pouvez selectionner le thème principal de votre site ainsi que d\'autres configurations generales : contenu du footer des pages, les metas, et le texte de la page 404. Le thème correspond à l\'habillage graphique du site',
  'aucun_bandeau' => 'Il n\'y a pas de bandeau',
  'choix_du_theme' => 'Configuration des thèmes',
  'choixtheme' => 'Choix du thème',
  'theme_actuel' => 'Thème actuel.',
  'theme_base' => 'Thème de base',
  'bouton_changer_theme' => 'Enregistrer',
  'titre_upload_bandeau' => 'Insérer un bandeau',
   'intro_upload_bandeau' => 'C\'est ici que vous pouvez insérer un bandeau (bannière, logo, illustration qui se retrouvera à toutes les pages du site) en le chargeant à partir d\'un dossier qui se trouve sur votre ordinateur.',
   'footer'=> 'Insérer un footer',
   'votre_message_de_footer' => 'C\'est ici que vous pouvez charger les éléments qui composeront votre footer. Il s\'agit ddu texte en pied de page qui s\'affiche sur toutes les pages du site.',
   'metas' => 'Enregistrer vos metas',
'vos_metas' => 'Un "méta" est une information cachée dans la page et qui s\'adresse aux moteurs de recherche. Par exemple : si vous introduisez le "méta" -pomme-  et que vous introduisez dans google -pomme-, votre site sera affiché dans la liste des résultats comme correspondant à -pomme-. Les trois principaux métas utilisés sont : keywords, description, robot.',
'type_meta' => 'Type de métas', 
'valeur_meta' => 'Votre(vos) méta(s)',
'page_404'=> 'Personnaliser la page d\'erreur (404). La page s\'affiche quand le lien n\'est pas trouvé.',
'votre_message_page_404'=> 'Tapez ici le titre et le texte du message 404',
'liste_assoc' => 'Liste des thèmes déjà associés',
'ajouter_meta' => 'Ajouter un méta',

// page Exec (configuration de base)
'pas_de_edito'=> 'Il n\'y a pas d\'édito.',
'pas_de_rubrique_news' => 'Il n\'y a pas de rubrique news.',
'pas_de_video_hasard' => 'Il n\'y a pas de video au hasard.',
'config_date_auteur' => 'Personnalisation de la date et de l\'auteur',
'intro_config_date_auteur' => 'C\'est ici que vous pouvez choisir d\'afficher la date ou l\'auteur de vos articles et brèves.',
'intro_date'=> 'Sélectionnez l\'option désirée',
'intro_auteur' => 'Sélectionnez l\'option désirée',

'afficher_date' => 'Afficher la date',
'pas_de_date' => 'Ne pas afficher la date',
'afficher_auteur' => 'Afficher l\'auteur',
'pas_afficher_auteur' => 'Ne pas afficher l\'auteur',
'intro_suite' => 'Sélectionnez l\'option désirée',
'afficher_suite' => 'Afficher le bouton "suite"',
'pas_de_suite' => 'Ne pas afficher le bouton "suite"',

'config_forum'=> 'Configuration du forum',
'intro_config_forum'=>  'C\'est ici que vous pouvez choisir votre type de forum.',
'explication_forum'=> 'Un forum permet d\'échanger vos opinions : lire celles des autres et publier les vôtres. Vous disposez de deux options. La première demande javascript. La première permet d\'avoir un forum dans l\'article, la seconde dans une fenêtre séparée.',
'forum_self'=> 'Forum (avec javascript)', 
'forum_forum' => 'Forum (sans javascript)',
'image_au_hasard'=> 'Choix de la rubrique comprenant l\'image au hasard',
'config_google_maps' => 'Configuration de la google map',
'intro_config_api_key' => 'Les google map sont des cartes personnalisées (avec points de repères, parcours, textes, images) facile à fabriquer sur le site de <a href="http://maps.google.com">google map</a>. Pour les afficher sur votre site, vous devez fabriquer un clé api et la placer ci-dessous. C\'est gratuit. Ensuite, téléchargez les fichier KML dans vos articles en tant que documents.',
'gmaps_afficher_controles' => 'Afficher les boutons de contrôle sur la carte',

// page blocs libres
'gestion_bloc_libre' => "Gestion des blocs libres",
'sideinfo_avance'=>'Dans cette page, vous avez la possibilité de gérer des blocs libres, c\'est-à-dire, un texte, une image, un lien, bref, un contenu qui peut être associé à n\'importe quel article, rubiruqe et même sommaire. Rendez-vous aussi aux pages des articles et des rubriques pour associer le(s) bloc(s)',
'creer_un_bloc_libre'=>'Créer un bloc libre',
'attention_modif_globale' => 'Attention, les modifications effectuées ici seront répercutées sur tous les endroits où le bloc a été associé!',
'modifier_ce_bloc' => 'Modifier ce bloc',

//page gabarit
'sideinfo_gabarit'=>'Dans cette page, vous avez la possibilité de configurer votre page en déplaçant les modules où vous le désirez. Les modules dans la colonne réserve ne s\'affiche pas sur votre site, il doivent être déplacés dans le corps  de votre page ou une colonne contextuelle. Il existe un gabarit pour la page de sommaire mais aussi pour les rubriques, les articles, les groupe-mots, les forum, les liens etc.',
'sauver'=> 'Enregistrer',
'configuration_des_gabarits'=>'Configuration des gabarits :',
'contexte1'=> 'Colonne contextuelle 1',
'contexte2'=> 'Colonne contextuelle 2',
'corps'=> 'Corps',
'reserve'=>'Réserve',
'avance' => 'Réserve avancée',
'nouveau_gabarit'=>'Dériver un gabarit',
'deriver_gabarit'=> 'Nom du nouveau gabarit',
'baser_gabarit_sur'=> 'Baser le gabarit sur',
'modifier_un_autre_gabarit' => 'Modifier un autre gabarit',
'nom_du_gabarit' => 'Nom du gabarit',

// gabarits : noms des blocs
'bloc-libre' => 'Blocs libres',
'articles-une' => 'Articles à la une',
'liste-liens' => 'Liste de liens',
'derniers-liens' => 'Derniers liens',
'nombre_liens_affiches' => 'Nombre de liens affichés',
'menu-langues' => 'Menu des langues',
'rechercher' => 'Rechercher',
'editorial' => 'Editorial',
'derniers-articles' => 'Derniers articles',
'nombre_articles_affiches' => 'Nombre d\'articles affichés',
'identification-visiteur' => 'Identification des visiteurs',
'liste-breves' => 'Liste des brèves',
'nombre_breves_affichees' => 'Nombre de brèves affichées',

'derniers-forums' => 'Derniers forums',
'nombre_forums_affiches' => 'Nombre de forums affichés',

'groupe-mots-cles' => 'Groupe de mots clés',
'menu-groupe' => 'Mots clés d\'un groupe',
'rubriques-une' => 'Rubrique à la une',
'nombre_articles' => 'Nombre d\'articles affichés',
'bloc_libre_rubrique' => 'Blocs libres',
'bloc_libre_article' => 'Blocs libres',
'quels_blocs' => 'Quels blocs ?',
'blocs_article' => 'De l\'article',
'blocs_article_rubrique' => 'De l\'article et sa rubrique',
'liste_extension_exclure' => 'Liste d\'extension à exclure, séparées par des barres verticales',
'pieces_jointes' => 'Pièces jointes',
'rubrique_podcast' => 'Podcast de la rubrique',
'article_podcast' => 'Podcast de l\'article',
'liste_groupe_inclure' => 'Listez ici les id des groupes séparés par des barres verticales.',
'thesaurus_mots' => 'Thésaurus',
'raccourcis_sous_rubrique' => 'Liste des sous rubriques (ancres)',
'galerie_videos_rub' => 'Galerie vidéo',
'type_de_video' => 'Type de vidéo',
'video-hasard' => 'Vidéo au hasard',
'flv_lecteur_flash' => 'FLV (lecteur flash)',
'tous_popup' => 'Tous (popup)',
'image-hasard' => 'Image au hasard',

'nombre_news_affichees' => 'Nombre de news affichées',
'bloc_sons_hasard_branche' => 'Sons au hasard de cette branche',
'nombre_playlist' => 'Nombre de sons dans la liste',
'google-maps-rubrique' => 'Google map',
'google-maps-article' => 'Google map',
'bloc_proposer_lien' => 'Proposer un lien',
'diaporama-rubrique' => 'Diaporama image',
'rubrique-head' => 'Titre et logo de la rubrique',
'rubrique-texte' => 'Texte de la rubrique',
'liste-articles' => 'Articles de cette rubrique',
'liste-rubriques' => 'Sous-rubriques de cette rubrique',
'forum' => 'Forums',
'galerie-image' => 'Galerie d\'images',
'galerie-audios-rub' => 'Galerie audio',
'galerie-audios' => 'Galerie audio',
'mots-cles' => 'Mots clés de cette rubrique',
'liste-sites-motscles' => 'Sites comportants le même mot-clé',

'galerie-swf' => 'Galerie d\'animations flash',
'diaporama-article-flash' => 'Diaporama image flash',
'autres-articles' => 'Autres articles de la même rubrique',
'article-head' => 'Titre et informations de l\'article',
'article-texte' => 'Texte de l\'article',
'bloc-forum' => 'Forums',
'galerie-videos' => 'Galerie vidéo',

'groupe-autres-groupes' => 'Autres groupes de mots-clés',
'groupe-head' => 'Titre et logo du groupe',
'groupe-texte' => 'Texte du groupe',
'groupe-liste-mots' => 'Liste de mots du groupe',
'groupe-dernieres-entrees' => 'Dernières entrées du groupe',
'liste-mots-cles' => 'Liste de tous les mots clés',

'404-head' => 'Titre de la page 404',
'404-texte' => 'Texte de la page 404',
'auteur-ecrire' => 'Ecrire à l\'auteur',
'auteur_autres_auteurs' => 'Liste des autres auteurs',
'auteur-head' => 'Titre de la page',
'auteur-info' => 'Informations sur l\'lauteur',
'liste-articles-auteur' => 'Liste des articles de l\'auteur',
'bloc-login' => 'Formulaire de login',
'recherche-head' => 'Titre de la recherche',
'recherche-articles' => 'Articles correspondants',
'recherche-rubriques' => 'Rubriques correspondantes',
'recherche-mots' => 'Mots correspondants',
'recherche-documents' => 'Documents correspondants',
'recherche-liens' => 'Liens correspondants',

'liste-agenda' => 'Liste des événements (articles)',

'abo-newsletter' => 'Abonnement à la newsletter',

// a propos
'a_propos' => 'A propos',
'dernieres_infos' => 'Dernières informations',
'sideinfo_about'=> 'À propos : retrouver les dernières infos du plugin.',

// page groupe
'titre_up_rub_logo' => 'Logo du groupe',
'invit_up_rub_logo' => 'Modifier le logo',
'logo_actuel' => 'Logo actuel',
'intro_up_logo' => 'Cliquez sur le bouton "Choisir le fichier" pour ajouter/modifier le bandeau de cette rubrique',
'supprimer_logo' => 'Supprimer le logo',

//pages naviguer
'associer_un_bloc_libre' => 'Associer un bloc libre',
'associer_un_theme' => 'Associer un thème',   
'creer_bloc_et_associer' => 'Créer un nouveau bloc',   
'ajouter' => 'Ajouter',
'langue_bloc_assoc' => 'Langue du bloc libre:',
'langue_bloc' => 'Langue du bloc libre:',
'intro_associer_bloc_libre' => 'Associer un bloc libre préexistant à cet endroit:',  
'blocs_libres_deja_associes' => 'Blocs libres déjà associés à cet endroit:',
'intro_associer_gabarit' => 'Vous pouvez choisir ici un gabarit de présentation spécifique à cette page.', 
'choisissez_un_gabarit' => 'Choisissez un gabarit',
'associer_un_gabarit' => 'Associer un gabarit',
'bouton_changer_gabarit' => 'Associer ce gabarit',
);
?>
