<?php

// FICHIER DE TRADUCTION DES PAGES OPTIONS ARTY
// Pour les caractères spéciaux HTML voir  
//  http://www.ilovejackdaniels.com/cheat-sheets/html-character-entities-cheat-sheet/
// Attention à échapper les guillements par backspace : "l'apostrophe" -> "l\'apostrophe"

// Pour la traduction de la partie publique voir local_**.php

$GLOBALS['i18n_arty_es'] = array(

// TRADUCTIONS GENERALES
  'titre'                     => 'Título',
  'acces_a_la_page'           => 'Solamente los administradores o administradoras tienen acceso a esta página.',
  'modifier_cette_option'     => 'Modificar esta opción',
  'info'                      => 'info',
  'erreur'                    => 'Error',
  'le_changement_a_ete_effectue' => 'El cambio se ha realizado',

// messages d'erreur
  'erreur_extension'          => 'Este tipo de archivo no está permitido.',
  'upload_reussi'             => 'Imagen subida.',
  'upload_rate'               => 'Imposible subir la imagen.',
  'erreur_trop_gros'          => 'El archivo es demasiado grande.',
  'erreur_transmission'       => 'Ha habido un problema durante la transmisión del archivo.',

// menu de navigation

// boutons
  'enregistrer'               => 'Guardar',
  'modifier_et_retour' => 'Guardar y volver a la página',
  'supprimer'                 => 'Eliminar',
  'options_arty'              => 'Opciones Magusine',
// onglets
  'onglet_base'               => 'Configuración inicial',
  'onglet_themes'             => 'Temas',
  'onglet_avance'             => 'Blocs libres',
  'onglet_menu'               => 'Menús',
  'onglet_gabarit'            => 'Plantillas',
  'onglet_a_propos'           => 'Acerca de',
  
// blocs libres
  'titre_bloc_defaut'         => 'Título del bloc libre',
  'texte_bloc_defaut'         => 'Texto del bloc libre',
  'logo_bloc'                 => 'Logo del bloc libre:',
  'modifier_bloc_libre'       => 'Modificar este bloc',
  'supprimer_bloc'            => 'Eliminar este bloc',
  'charger_une_image'         => 'Añadir una imagen en este bloc:',
  'charger_autre_image'       => 'Cambiar la imagen de este bloc:',
  'supprimer_bandeau'         => 'Eliminar esta cabecera',
  'entrez_donnees_nouveau_bloc' => 'Título y texto del bloc libre',
  'bloc_lien'                 => 'Enlace (se aplica sobre la imagen y el texto del bloc, opcional)',
  'bloc_image'                => 'Illustration du bloc (optionnel)',
  
// bloc de logo de rubrique
 'intro_up_rub_bandeau' => 'Cliquea sobre el botón "Seleccionar el archivo" para añadir/cambiar la cabecera de esta sección',
 'titre_up_rub_bandeau' => 'Cabecera de esta sección',
 'invit_up_rub_bandeau' => 'Cambiar la cabecera',
 'upload_reussi'        => 'Upload realizada',
 'bandeau_actuel'       => 'Cabecera actual',
 'aucun_bandeau_rub'    => 'No hay cabecera seleccionada',

// TRADUCTIONS SPECIFIQUES
//ARTY.php - Options de base
  // titre page
  'titre_options_base'        => 'Opciones ARTY iniciales',
  'titre_configuration_base'  => 'Configuración inicial',
  'sideinfo_arty'             => 'En esta página puedes seleccionar las secciones de donde se recogerán los contenidos de la editorial, las noticias, etc.',
  'edito'                     => 'Sélecciona la editorial',
  'choix_rubrique_news'       => 'Elige la sección para las noticias',
  'rubrique_article_une'      => 'Rubrique et articles à la une',
  'pas_de_une'                => 'Pas de rubrique ou d\'article à la une',
  'explication_choix_rubrique_news' => 'Las noticias son informaciones cortas sobre tu actividad. Técnicamente son breves escritas en una sección.',
  'video_au_hasard'     => 'Selecciona la sección para vídeos al azar',
  'pas_de_image_hasard' => 'Sin imagen al azar',
 'cacher_edito'=> 'Ocultar la editorial (ocultar la editorial en las listas)',
 'lire_autres_editos' => 'Mostrar el enlace "leer las otras editoriales"',
 'ajouter_un_lien'=> 'Añadir un enlace manual',
  
  // bloc aide
  'titre_aide_base'           => 'Ayuda',
  'aide_options_base'         => 'Si tienes poco tiempo &#224; para personalizar el sitio, concentra tus esfuerzos en esta página.',
  
  // Page menu
  'si_pas_langue'      => 'Si el idioma para el que quieres crear un menú no está en la lista, es que todavía no has asignado ese idioma a una sección o a un artículo.',
  'titre_options_menu' => 'Creación de los menús',
  'intro_menu'         => 'Esta página permite crear el menú del sitio. Puedes poner secciones, artículos asi como grupos de palabras clave y palabras clave. Luego puedes organizar el orden estos elementos.',
  'menu_actuel'        => 'Menú para el idioma',
  'type_de_menu'       => 'Tipo de menú',
  'menu_reservoir'     => 'Selecciona los elementos a incluir en el menú',
  'nom_lien' => 'Nombre del enlace:',
  'url_lien'=> 'Dirección url del enlace:',
  'un_niveau'=> 'Un nivel',
  'deux_niveaux' => 'Dos niveles',
  'manuel'   => 'Manual',
  'nombre_niveaux_menu' => 'Puedes elegir entre 3 tipos de menú.',
  'intro_niveaux_menu' => 'En el menú, puedes hacer aparecer sólo los nombres de las secciones (1 nivel), pero también de las subsecciones (2 niveles). Si eliges el modo manual, tienes que elegir cada elemento a mostrar en el menú.',
  'intro_lister_articles' => 'Marca aquí si quieres mostrar los artículos (y las palabras claves) en el segundo nivel.',
  'lister_articles' => 'También mostrar los artículos y las palabras clave.',
  'choix_de_la_langue_menu' => 'Info',
  'rubrique' => 'Sección',
  'article' => 'Artículo',
  'groupe' => 'Grupo de palabras',
  'mot' => 'Palabra clave', 
  'intro_choix_niveaux' => 'Elige los niveles a mostrar:',
  'n_niveaux' => 'La jerarquía completa',
  'intro_menu_manuel' => 'Seleccionando el modo manual, puedes elegir uno a uno los elementos a mostrar en la jerarquía del menú.',
  'avis_menu_auto' => 'Como ningún elemento ha sido añadido al menú, este funciona de forma automática.',
  
  // page article
  'galerie_image'  => 'Galería de imágenes',
  'intro_creer_bloc' => 'Añadir un bloc libre',
  
//PAGE THEMES
  'sideinfo_theme' => 'Puedes seleccionar el tema principal del sitio asi como otras configuraciones generales: contenido del pie de página, las metas, y el texto de la página 404. El tema se encarga de a visualización gráfica del sitio',
  'aucun_bandeau' => 'No hay cabecera',
  'choix_du_theme' => 'Configuración de los temas',
  'choixtheme' => 'Elección del tema',
  'theme_actuel' => 'Tema actual.',
  'theme_base' => 'Tema inicial',
  'bouton_changer_theme' => 'Guardar',
  'titre_upload_bandeau' => 'Añadir una cabecera',
   'intro_upload_bandeau' => 'Aquí puedes subir una cabecera (baner, logo, imagen que se mostrará en todas las páginas del sitio) cogiéndolo de una carpeta que se encuentra en tu ordenador.',
   'footer'=> 'Añadir un pie de página',
   'votre_message_de_footer' => 'Aquí puedes subir los elementos para tu pie de página. Es el texto del pie de página que se añade a todas las páginas del sitio.',
   'metas' => 'Guardar tus metas',
'vos_metas' => 'Un "méta" es una información oculta en la página y que utilizan los motores de búsqueda. Por ejemplo: si quieres añadir la "méta" -pomme- y que la recoja gogle como -pomme-, vuestro sitio será mostrado en la lista de resultados cuando se busque -pomme-. Las tres metas principales son: keywords, description, robot.',
'type_meta' => 'Tipo de metas', 
'valeur_meta' => 'Tu(s) meta(s)',
'page_404'=> 'Personalizar la página de error (404). La página se muestra cuando no se encuentra un enlace.',
'votre_message_page_404'=> 'Marca el título y el texto del mensaje 404',
'liste_assoc' => 'Muestra los temas relacionados',
'ajouter_meta' => 'Añadir una meta',

// page Exec (configuration de base)
'pas_de_edito'=> 'No hay editorial.',
'pas_de_rubrique_news' => 'No hay sección noticias.',
'pas_de_video_hasard' => 'No hay vídeos al azar.',
'config_date_auteur' => 'Personnalizar fecha y autor o autora',
'intro_config_date_auteur' => 'Puedes elegir si mostrar o no la fecha o el autor o autora de los artículos y breves.',
'intro_date'=> 'Selecciona una opción',
'intro_auteur' => 'Selecciona una opción',

'afficher_date' => 'Mostrar la fecha',
'pas_de_date' => 'No mostrar la fecha',
'afficher_auteur' => 'Mostrar el autor o autora',
'pas_afficher_auteur' => 'No mostrar el autor o autora',
'intro_suite' => 'Selecciona una opción',
'afficher_suite' => 'Mostrar el botón "leer más"',
'pas_de_suite' => 'No mostrar el botón "leer más"',

'config_forum'=> 'Configuración de los foros',
'intro_config_forum'=>  'Elige el tipo de foros.',
'explication_forum'=> 'Un foro permite intercambiar opiniones: leer las de otras personas y publicar las tuyas. Dispones de dos opciones. La primera necesita javascript. La primera permite tener un foro en el artículo, la segunda en una ventana separada.',
'forum_self'=> 'Foro (con javascript)', 
'forum_forum' => 'Foro (sin javascript)',
'image_au_hasard'=> 'Elige la sección para cargar imágenes al azar',
'config_google_maps' => 'Configuración del mapa de google',
'intro_config_api_key' => 'Los mapas de google son mapas personalizados (con marcadores, recorridos, textos, imágenes) fáciles de incluir en el sitio de <a href="http://maps.google.com">google maps</a>. Para mostrarlos en tu sitio, tienes que crear una clave api y colocarla aquí. Es gratuita. Luego, carga los ficheros KML en tus artículos como documentos.',
'gmaps_afficher_controles' => 'Mostrar los botones de control en el mapa',

// page blocs libres
'gestion_bloc_libre' => "Gestión de los blocs libres",
'sideinfo_avance'=>'Aquí puedes gestionar los blocs libres, es decir, un texto, una imagen, un enlace, breve, un contenido que puede ser asociado a cualquier artículo, sección e incluso portada. Citar también las páginas de los artículos y las secciones para asociar al (a los) bloc(s)',
'creer_un_bloc_libre'=>'Crear un bloc libre',
'attention_modif_globale' => 'Attention, les modifications effectuées ici seront répercutées sur tous les endroits où le bloc a été associé!',
'modifier_ce_bloc' => 'Modificar el bloc',

//page gabarit
'sideinfo_gabarit'=>'Aquí puedes configurar la plantilla de la página desplazando los módulos. Los módulos de la columna de reserva réserve no se muestran en el sitio, deben estar situados en el cuerpo o en las columnas. Hay una plantilla para la página de portada, pero también para las secciones, artículos, grupos de palabras clave, foros, enlaces etc.',
'sauver'=> 'Guardar',
'configuration_des_gabarits'=>'Configuración de las plantillas:',
'contexte1'=> 'Columna 1',
'contexte2'=> 'Columna 2',
'corps'=> 'Cuerpo',
'reserve'=>'Reserva',
'avance' => 'Reserva avanzada',
'nouveau_gabarit'=>'Nueva plantilla',
'deriver_gabarit'=> 'Nombre de la nueva plantilla',
'baser_gabarit_sur'=> 'Partir de esta plantilla',
'modifier_un_autre_gabarit' => 'Modificar otra plantilla',
'nom_du_gabarit' => 'Nombre de la plantilla',
'liste_assoc_gabarit' => 'Páginas asociadas a esta plantilla',


// gabarits : noms des blocs
'bloc-libre' => 'Blocs libres',
'articles-une' => 'Articles à la une',
'liste-liens' => 'Lista de enlaces',
'derniers-liens' => 'Últimos enlaces',
'nombre_liens_affiches' => 'Número de enlaces mostrados',
'menu-langues' => 'Menú de idiomas',
'rechercher' => 'Buscar',
'editorial' => 'Editorial',
'derniers-articles' => 'Últimos artículos',
'nombre_articles_affiches' => 'Número de artículos mostrados',
'identification-visiteur' => 'Identificación de visitantes',
'liste-breves' => 'Lista de breves',
'nombre_breves_affichees' => 'Número de breves mostrados',

'derniers-forums' => 'Últimos foros',
'nombre_forums_affiches' => 'Número de foros mostrados',

'groupe-mots-cles' => 'Grupo de palabras clave',
'menu-groupe' => 'Palabras clave del grupo',
'rubriques-une' => 'Rubrique à la une',
'nombre_articles' => 'Número de artículos mostrados',
'bloc_libre_rubrique' => 'Blocs libres',
'bloc_libre_article' => 'Blocs libres',
'quels_blocs' => '¿Qué blocs?',
'blocs_article' => 'Del artículo',
'blocs_article_rubrique' => 'Del artículo y su sección',
'liste_extension_exclure' => 'Lista de extensiones a excluir separadas por barras verticales',
'pieces_jointes' => 'Archivo completo',
'rubrique_podcast' => 'Podcast de la sección',
'article_podcast' => 'Podcast del artículo',
'liste_groupe_inclure' => 'Lista aquí las "id", los números, de los grupos de palabras calve separados por barras verticales.',
'thesaurus_mots' => 'Tesauro',
'raccourcis_sous_rubrique' => 'Lista de subsecciones (anclas)',
'galerie_videos_rub' => 'Galería de vídeo',
'type_de_video' => 'Tipo de vídeo',
'video-hasard' => 'Vídeo al azar',
'flv_lecteur_flash' => 'FLV (lector flash)',
'tous_popup' => 'Todos (popup)',
'image-hasard' => 'Imagen al azar',

'nombre_news_affichees' => 'Número de noticias mostradas',
'bloc_sons_hasard_branche' => 'Sonidos de esta "branche" (secciín y sus subsecciones) al azar',
'nombre_playlist' => 'Número de sonidos en la lista',
'google-maps-rubrique' => 'Google map',
'google-maps-article' => 'Google map',
'bloc_proposer_lien' => 'Proponer un enlace',
'diaporama-rubrique' => 'Diaporama de imágenes',
'rubrique-head' => 'Título y logo de la sección',
'rubrique-texte' => 'Texto de la sección',
'liste-articles' => 'Artículos de esta sección',
'liste-rubriques' => 'Subsecciones de esta sección',
'forum' => 'Foros',
'galerie-image' => 'Galería de imágenes',
'galerie-audios-rub' => 'Galería de audio',
'galerie-audios' => 'Galería de audio',
'mots-cles' => 'Palabras clave de esta sección',
'liste-sites-motscles' => 'Sitios con la misma palabra clave',

'galerie-swf' => 'Galería de animaciones flash',
'diaporama-article-flash' => 'Diaporama de animaciones flash',
'autres-articles' => 'Otros artículos de la misma sección',
'article-head' => 'Título e informaciones del artículo',
'article-texte' => 'Texto del artículo',
'bloc-forum' => 'Foros',
'galerie-videos' => 'Galería de vídeos',

'groupe-autres-groupes' => 'Otros grupos de palabras clave',
'groupe-head' => 'Título y logo del grupo',
'groupe-texte' => 'Texto del grupo',
'groupe-liste-mots' => 'Lista de palabras clave del grupo',
'groupe-dernieres-entrees' => 'Últimas entradas el grupo',
'liste-mots-cles' => 'Lista de todas las palabras clave',

'404-head' => 'Título de la página 404',
'404-texte' => 'Texto de la página 404',
'auteur-ecrire' => 'Escribir al autor o autora',
'auteur_autres_auteurs' => 'Lista de otros autores y autoras',
'auteur-head' => 'Título de la página',
'auteur-info' => 'Informaciones sobre el autor o autora',
'liste-articles-auteur' => 'Lista de los artículos del autor o autora',
'bloc-login' => 'Formulario de login',
'recherche-head' => 'Título de la búsqueda',
'recherche-articles' => 'Artículos encontrados',
'recherche-rubriques' => 'Secciones encontradas',
'recherche-mots' => 'Palabras clave encontradas',
'recherche-documents' => 'Documentos encontrados',
'recherche-liens' => 'Enlaces encontrados',

'liste-agenda' => 'Lista de eventos (artículos)',

'abo-newsletter' => 'Inscribirse en los boletines',

// a propos
'a_propos' => 'Acerca de',
'dernieres_infos' => 'Últimas informaciones',
'sideinfo_about'=> 'Acerca de: buscar las últimas infos del plugin.',

// page groupe
'titre_up_rub_logo' => 'Logo del grupo',
'invit_up_rub_logo' => 'Modificar el logo',
'logo_actuel' => 'Logo actual',
'intro_up_logo' => 'Cliquea sobre el botón "Selecciona el archivo" para añadir/modificar la cabecera de esta sección',
'supprimer_logo' => 'Supprimer le logo',

//pages naviguer
'associer_un_bloc_libre' => 'Asociarr un bloc libre',
'associer_un_theme' => 'Asociar un tema',   
'creer_bloc_et_associer' => 'Crear un nuevo bloc',   
'ajouter' => 'Añadir',
'langue_bloc_assoc' => 'Idioma del bloc libre:',
'langue_bloc' => 'Idioma del bloc libre:',
'intro_associer_bloc_libre' => 'Asociar un bloc libre que ya exista a este entorno:',  
'blocs_libres_deja_associes' => 'Blocs libres ya asociados a este entorno:',
'intro_associer_gabarit' => 'Puedes elegir una plantilla específica para esta página.', 
'choisissez_un_gabarit' => 'Elige una plantilla',
'associer_un_gabarit' => 'Asociar una plantilla',
'bouton_changer_gabarit' => 'Asociar esta plantilla',
'editer_ce_gabarit' => 'Editar esta plantilla',
'creer_gabarit_et_associer' => 'Crear plantilla y asociarla',
'pas_de_page_associee' => 'No esta asociada a ninguna página.'
);
?>
