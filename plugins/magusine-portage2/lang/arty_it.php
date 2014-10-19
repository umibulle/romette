<?php

// FICHIER DE TRADUCTION DES PAGES OPTIONS ARTY
// Pour les caractÃ¨res spÃ©ciaux HTML voir  
//  http://www.ilovejackdaniels.com/cheat-sheets/html-character-entities-cheat-sheet/
// Attention Ã  Ã©chapper les guillements par backspace : "l'apostrophe" -> "l\'apostrophe"

// Pour la traduction de la partie publique voir local_**.php

$GLOBALS['i18n_arty_it'] = array(

// TRADUCTIONS GENERALES
  'titre'                     => 'Titolo',
  'acces_a_la_page'           => 'Solo gli amministratori hanno accesso a questa pagina.',
  'modifier_cette_option'     => 'Modificare questa opzione',
  'info'                      => 'info',
  'erreur'                    => 'Errore',
  'le_changement_a_ete_effectue' => 'La modifica è stata effettuata',

// messages d'erreur
  'erreur_extension'          => 'Questo tipo di file non è autorizzato.',
  'upload_reussi'             => 'Immagine caricata con successo.',
  'upload_rate'               => 'Impossibile caricare l\'immagine.',
  'erreur_trop_gros'          => 'Il file è troppo voluminoso.',
  'erreur_transmission'       => 'Un problema grave è intervenuto nel caricamento del file.',

// menu de navigation

// boutons
  'enregistrer'               => 'Registrare',
  'modifier_et_retour'        => 'Registrare e ritornare alla pagina',
  'supprimer'                 => 'Cancellare',
  'options_arty'              => 'Opzioni Magusine',
// onglets
  'onglet_base'               => 'Configuratione di base',
  'onglet_themes'             => 'Temi',
  'onglet_avance'             => 'Blocchi liberi',
  'onglet_menu'               => 'Menu',
  'onglet_gabarit'            => 'Schemi',
  'onglet_a_propos'           => 'Informazioni su',
  
// blocs libres
  'titre_bloc_defaut'         => 'Titolo del blocco libero',
  'texte_bloc_defaut'         => 'Testo del blocco libero',
  'logo_bloc'                 => 'Logo del blocco libero:',
  'modifier_bloc_libre'       => 'Modificare questo blocco',
  'supprimer_bloc'            => 'Cancellare questo blocco',
  'charger_une_image'         => 'Aggiungere un\'immagine a questo blocco:',
  'charger_autre_image'       => 'Sosituire l\'immagine a questo blocco:',
  'supprimer_bandeau'         => 'Cancellare il logo intestazione',
  'entrez_donnees_nouveau_bloc' => 'Titolo e testo del blocco libero',
  'bloc_lien'                 => 'Link (si applica all\'immagine e al testo del blocco, opzionale)',
  'bloc_image'                => 'Illustrazione del blocco (opzionale)',
  
// bloc de logo de rubrique
 'intro_up_rub_bandeau'    => 'Cliccare su "Scegliere il file" per aggiungere o modificare il logo di questa rubrica',
 'titre_up_rub_bandeau'    => 'Logo di questa rubrica',
 'invit_up_rub_bandeau'    => 'Modificare il logo',
 'upload_reussi'           => 'Upload riuscito!',
 'bandeau_actuel'          => 'Banner attuale',
 'aucun_bandeau_rub'       => 'Attualmente nessun logo.',

// TRADUCTIONS SPECIFIQUES
//ARTY.php - Options de base
  // titre page
  'titre_options_base'        => 'Optioni ARTY di base',
  'titre_configuration_base'  => 'Configurazione di base',
  'sideinfo_arty'             => 'In questa pagina, potete selezionare le rubriche da cui provengono i contenuti dell\'editoriale, delle news, ecc.',
  'edito'                     => 'Selezione dell\'editoriale',
  'choix_rubrique_news'       => 'Scelta della rubrica delle news',
  'rubrique_article_une'      => 'Rubrica e articoli in prima pagina',
  'pas_de_une'                => 'Nessuna rubrica o articolo in prima pagina',
  'explication_choix_rubrique_news' => 'Le news sono delle informazioni brevi sulla vostra attività. Si tratta tecnicamente di brevi scritti in una rubrica.',
  'video_au_hasard'           => 'Scelta della rubrica del video a caso',
  'pas_de_image_hasard'       => 'Nessuna immagine a caso',
  'cacher_edito'              => 'Nascondere l\'editoriale (celare l\'editoriale negli elenchi)',
  'lire_autres_editos'        => 'Mostrare il link "leggere gli altri editoriali"',
  'ajouter_un_lien'           => 'Aggiungere manualmente un link',
  
  // bloc aide
  'titre_aide_base'           => 'Aiuto',
  'aide_options_base'         => 'Se non avete che poco tempo da dedicare alla personalizzazione del vostro sito, concentrate i vostri sforzi su questa pagina.',
  
  // Page menu
  'si_pas_langue'      => 'Se la lingua per la quale volete creare un menu non appare in questa lista, significa che non avete ancora assegnato questa lingua ad una rubrica o a un articolo.',
  'titre_options_menu' => 'Creazione dei menu',
  'intro_menu'         => 'Questa pagina vi permette di creare il menu del vostro sito. Potete disporvi delle rubriche, degli articoli come dei gruppi di parole-chiave e delle parole-chiave. Potete quindi organizzare l\'ordine di questi elementi.',
  'menu_actuel'        => 'Menu per la lingua',
  'type_de_menu'       => 'Tipo di menu',
  'menu_reservoir'     => 'Scegliete gli elementi da inserire nel menu',
  'nom_lien'           => 'Nome del sito:',
  'url_lien'           => 'Indirizzo url del sito:',
  'un_niveau'          => 'Un livello',
  'deux_niveaux'       => 'Due livelli',
  'manuel'             => 'Manuale',
  'nombre_niveaux_menu' => 'Potete scegliere fra 3 tipi di menu.',
  'intro_niveaux_menu'  => 'Nel menu, potete far apparire i nomi delle rubriche (1 livello) ma anche quello delle sotto-rubriche (2 livelli). Se scegliete il modo manuale, dovete specificare manualmente ogni elemento da far apparire nel menu.',
  'intro_lister_articles' => 'Barrate la casella qui sotto se volete elencare gli articoli (e le parole-chiave dei gruppi) nel secondo livello.',
  'lister_articles'       => 'Elencare gli articoli e le parole-chiave.',
  'choix_de_la_langue_menu' => 'Info',
  'rubrique'                => 'Rubrica',
  'article'                 => 'Articolo',
  'groupe'                  => 'Gruppo parole-chiave',
  'mot'                     => 'Parola-chiave',
  'intro_choix_niveaux'     => 'Scegliete qui il numero di livelli da mostrare:',
  'n_niveaux'               => 'Tutti i livelli',
  'intro_menu_manuel'       => 'Scegliendo il modo manuale, potete definire uno a uno gli elementi da includere nel menu.',
  'avis_menu_auto'          => 'Se nessun elemento viene inserito nel menu, questo funziona in modo automatico.',
  
  // page article
  'galerie_image'           => 'Galleria immagini',
  'intro_creer_bloc'        => 'Aggiungere un blocco libero',
  
//PAGE THEMES
  'sideinfo_theme'          => 'Qui potete selezionare il tema principale del vostro sito come altre configurazioni generali: contenuto del piè di pagina delle pagine, i metacontenuti, e il testo della pagina 404. Il tema corrisponde all\'impostazione grafica del sito',
  'aucun_bandeau'           => 'Nessun banner',
  'choix_du_theme'          => 'Configurazione dei temi',
  'choixtheme'              => 'Scelta del tema',
  'theme_actuel'            => 'Tema attuale.',
  'theme_base'              => 'Tema di base',
  'bouton_changer_theme'    => 'Salvare',
  'titre_upload_bandeau'    => 'Inserire un banner',
   'intro_upload_bandeau'   => 'È qui che potete inserire un banner (logo, illustrazione che appare in tutte le pagine del sito) caricandolo da una cartella del vostro pc.',
   'footer'                 => 'Inserire un footer/piè di pagina',
   'votre_message_de_footer' => 'Qui potete caricare gli elementi che comporranno il piè di pagina (footer). Si tratta di testo in piè di pagina che appare su tutte le pagine del sito.',
   'metas'                   => 'Salvare i vostri meta',
'vos_metas'                  => 'Un "meta" è un\'informazione per i motori di ricerca e nascosta nella pagina. Per esempio: se inserite il "meta" -mela-  e inserite in google -mela-, il vostro sito apparirà nella lista dei risultati corrispondente a -mela-. I tre principali meta utilizzati sono: keywords, descrizione, robot.',
'type_meta'                  => 'Tipo di meta',
'valeur_meta'                => 'I vostri meta',
'page_404'                   => 'Personalizzare la pagina di errore (404). La pagina appare quando non viene trovato l\'indirizzo.',
'votre_message_page_404'     => 'Digitare qui il titolo e il testo della pagina 404',
'liste_assoc'                => 'Elenco dei temi già associati',
'ajouter_meta'               => 'Aggiungere un meta',

// page Exec (configuration de base)
'pas_de_edito'              => 'Nessun editoriale.',
'pas_de_rubrique_news'      => 'Nessuna rubrica news.',
'pas_de_video_hasard'       => 'Nessun video a caso.',
'config_date_auteur'        => 'Personalizzazione della data e dell\'autore',
'intro_config_date_auteur'  => 'Qui potete scegliere di mostrare la data o l\'autore degli articoli e delle brevi.',
'intro_date'                => 'Selezionare l\'opzione prescelta',
'intro_auteur'              => 'Selezionare l\'opzione prescelta',

'afficher_date'             => 'Mostrare la data',
'pas_de_date'               => 'Non mostrare la data',
'afficher_auteur'           => 'Mostrare l\'autore',
'pas_afficher_auteur'       => 'Non mostrare l\'autore',
'intro_suite'               => 'Selezionare l\'opzione prescelta',
'afficher_suite'            => 'Mostrare il pulsante "segue"',
'pas_de_suite'              => 'Non mostrare il pulsante "segue"',

'config_forum'              => 'Configurazione del forum',
'intro_config_forum'        => 'Qui potete scegliere il tipo di forum.',
'explication_forum'         => 'Un forum permette di scambiare le proprie opinioni: leggere quelle altrui e pubblicare le vostre. Disponete di due opzioni. La prima richiede javascript e permette di avere un forum nell\'articolo, la seconda in una finestra separata.',
'forum_self'                => 'Forum (con javascript)',
'forum_forum'               => 'Forum (senza javascript)',
'image_au_hasard'           => 'Scelta della rubrica contenente l\'immagine a caso',
'config_google_maps'        => 'Configurazione della google map',
'intro_config_api_key'      => 'Le google map sono carte geografiche personalizzate (con punti di riferimento, percorsi, testi, immagini) semplici da realizzare sul sito <a href="http://maps.google.com">google map</a>. Pour les afficher sur votre site, vous devez fabriquer un clÃ© api et la placer ci-dessous. C\'est gratuit. Ensuite, tÃ©lÃ©chargez les fichier KML dans vos articles en tant que documents.',
'gmaps_afficher_controles'  => 'Mostrare il pulsante di controllo sulla carta',

// page blocs libres
'gestion_bloc_libre'       => 'Gestione dei blocchi liberi',
'sideinfo_avance'          => 'In questa pagina, potete gestire dei blocchi liberi, cioè un testo, un\'immagine, un link, in sintesi un qualsiasi contenuto che può essere associato a non importa quale articolo, rubrica e anche sommario. Portarsi anche sulle pagine degli articoli e delle rubriche per associare i blocchi liberi',
'creer_un_bloc_libre'      => 'Creare un blocco libero',
'attention_modif_globale'  => 'Attenzione, le modifiche effettuate qui incideranno su tutti i luoghi associati ai blocchi liberi!',
'modifier_ce_bloc'         => 'Modificare questo blocco',

//page gabarit
'sideinfo_gabarit'         => 'Da qui è possibile configurare le pagine spostando i moduli dove si desidera. I moduli sulla colonna "Riserva" non appariranno nel vostro sito, devono essere collocati nel "corpo" della pagina o in una colonna contestuale. Esiste uno schema per la pagina di sommario ma altresì per le rubriche, gli articoli, i gruppo di parole-chiave, i forum, i link, ecc.',
'sauver'                   => 'Salvare',
'configuration_des_gabarits'=> 'Configurazione degli schemi:',
'contexte1'                    => 'Colonna contestuale 1',
'contexte2'                    => 'Colonna contestuale 2',
'corps'                        => 'Corpo',
'reserve'                      => 'Riserva',
'avance'                       => 'Riserva avanzata',
'nouveau_gabarit'              => 'Derivare uno schema',
'deriver_gabarit'              => 'Nome del nuovo schema',
'baser_gabarit_sur'            => 'Basare lo schema su',
'modifier_un_autre_gabarit'    => 'Modificare un altro schema',
'nom_du_gabarit'               => 'Nome dello schema',
'liste_assoc_gabarit'          => 'Pagine associate a questo schema',


// gabarits : noms des blocs
'bloc-libre'                => 'Blocchi liberi',
'articles-une'              => 'Articoli in prima pagina',
'liste-liens'               => 'Elenco dei links',
'derniers-liens'            => 'Ultimi links',
'nombre_liens_affiches'     => 'Numero dei links mostrati',
'menu-langues'              => 'Menu delle lingue',
'rechercher'                => 'Ricerca',
'editorial'                 => 'Editoriale',
'derniers-articles'         => 'Ultimi articoli',
'nombre_articles_affiches'  => 'Numero degli articoli da mostrare',
'identification-visiteur'   => 'Identificazione dei visitatori',
'liste-breves'              => 'Elenco delle brevi',
'nombre_breves_affichees'   => 'Numero delle brevi da mostrare',

'derniers-forums'           => 'Ultimi forums',
'nombre_forums_affiches'    => 'Numero dei forums mostrati',

'groupe-mots-cles'          => 'Gruppo di parole-chiave',
'menu-groupe'               => 'Parole-chiave di un gruppo',
'rubriques-une'             => 'Rubrica in prima pagina',
'nombre_articles'           => 'Numero di articoli mostrati',
'bloc_libre_rubrique'       => 'Blocchi liberi',
'bloc_libre_article'        => 'Blocchi liberi',
'quels_blocs'               => 'Quali blocchi?',
'blocs_article'             => 'Dell\'articolo',
'blocs_article_rubrique'    => 'Dell\'articolo e la sua rubrica',
'liste_extension_exclure'   => 'Elenco estensioni da escludere, separate da barre verticali',
'pieces_jointes'            => 'Allegati',
'rubrique_podcast'          => 'Podcast della rubrica',
'article_podcast'           => 'Podcast dell\'articolo',
'liste_groupe_inclure'      => 'Elencate qui gli id dei gruppi separati da barre verticali.',
'thesaurus_mots'            => 'Thesaurus',
'raccourcis_sous_rubrique'  => 'Elenco delle sotto-rubriche (ancres)',
'galerie_videos_rub'        => 'Galerria video',
'type_de_video'             => 'Tipo di video',
'video-hasard'              => 'Video a caso',
'flv_lecteur_flash'         => 'FLV (lecteur flash)',
'tous_popup'                => 'Tutti (popup)',
'image-hasard'              => 'Immagine a caso',

'nombre_news_affichees'     => 'Numero delle news mostrate',
'bloc_sons_hasard_branche'  => 'File audio a caso in questa sezione',
'nombre_playlist'           => 'Numero dei file audio nell\'elenco',
'google-maps-rubrique'      => 'Google map',
'google-maps-article'       => 'Google map',
'bloc_proposer_lien'        => 'Proporre un sito',
'diaporama-rubrique'        => 'Diaporama image',
'rubrique-head'             => 'Titolo e logo della rubrica',
'rubrique-texte'            => 'Testo della rubrica',
'liste-articles'            => 'Articoli della rubrica',
'liste-rubriques'           => 'Sotto-rubriche della rubrica',
'forum'                     => 'Forums',
'galerie-image'             => 'Galleria d\'immagini',
'galerie-audios-rub'        => 'Galleria audio',
'galerie-audios'            => 'Galerie audio',
'mots-cles'                 => 'Parole-chiave di questa rubrica',
'liste-sites-motscles'      => 'Siti con la stessa parola-chiave',

'galerie-swf'               => 'Galleria di animazioni flash',
'diaporama-article-flash'   => 'Diaporama image flash',
'autres-articles'           => 'Altri articoli nella medesima rubrica',
'article-head'              => 'Titolo e informazioni sull\'articolo',
'article-texte'             => 'Testo dell\'articolo',
'bloc-forum'                => 'Forums',
'galerie-videos'            => 'Galleria video',

'groupe-autres-groupes'     => 'Altri gruppi di parole-chiave',
'groupe-head'               => 'Titolo e logo del gruppo',
'groupe-texte'              => 'Testo del gruppoe',
'groupe-liste-mots'         => 'Elenco delle parole-chiave del gruppo',
'groupe-dernieres-entrees'  => 'Parole-chiave recenti del gruppo',
'liste-mots-cles'           => 'Elenco di tutte le parole-chiave',

'404-head'                  => 'Titolo della pagina 404',
'404-texte'                 => 'Testo della pagina 404',
'auteur-ecrire'             => 'Scrivere all\'autore',
'auteur_autres_auteurs'     => 'Elenco degli altri autori',
'auteur-head'               => 'Titolo della pagina',
'auteur-info'               => 'Informazioni sull\'autore',
'liste-articles-auteur'     => 'Elenco degli articoli dell\'autore',
'bloc-login'                => 'Formulario per il login',
'recherche-head'            => 'Titolo della ricerca',
'recherche-articles'        => 'Articoli corrispondenti',
'recherche-rubriques'       => 'Rubriche corrispondenti',
'recherche-mots'            => 'Parole corrispondenti',
'recherche-documents'       => 'Documenti corrispondenti',
'recherche-liens'           => 'Links corrispondenti',

'liste-agenda'              => 'Elenco degli eventi (articoli)',

'abo-newsletter'            => 'Abbonarsi alla newsletter',

// a propos
'a_propos'                  => 'A proposito',
'dernieres_infos'           => 'Ultime informazioni',
'sideinfo_about'            => 'A proposito: le ultime novità sul plugin.',

// page groupe
'titre_up_rub_logo'         => 'Logo del gruppo',
'invit_up_rub_logo'         => 'Modificare il logo',
'logo_actuel'               => 'Logo attuale',
'intro_up_logo'             => 'Cliccare sul pulsante "Scegliere il file" per aggiungere o modificare il banner di questa rubrica',
'supprimer_logo'            => 'Cancellare il logo',

//pages naviguer
'associer_un_bloc_libre'    => 'Associare un blocco libero',
'associer_un_theme'         => 'Associare un tema',
'creer_bloc_et_associer'    => 'Creare un nuovo blocco',
'ajouter'                   => 'Aggiungere',
'langue_bloc_assoc'         => 'Lingua del blocco libero:',
'langue_bloc'               => 'Lingua del blocco libero:',
'intro_associer_bloc_libre' => 'Associare un blocco libero a questo elemento:',
'blocs_libres_deja_associes' => 'Blocchi liberi già associati a questo elemento:',
'intro_associer_gabarit'     => 'Potete scegliere qui uno schema di presentazione specifica per questa pagina.',
'choisissez_un_gabarit'      => 'Scegliere uno schema',
'associer_un_gabarit'        => 'Associare uno schema',
'bouton_changer_gabarit'     => 'Associare uno schema',
'editer_ce_gabarit'          => 'Editare questo schema',
'creer_gabarit_et_associer'  => 'Creare uno schema e associarlo',
'pas_de_page_associee'       => 'Nessuna pagina associata.'
);
?>
