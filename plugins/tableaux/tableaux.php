<?php
/*
Plugin Name: Tableaux de l'Artiste
Description: Ajoute un type de contenu personnalisé pour les tableaux avec des champs personnalisés.
Version: 1.0
Author: Votre Nom
*/

// Empêcher l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Définir les constantes
define( 'AT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'AT_PREFIX', 'artiste_tableaux_' );
define( 'AT_VERSION', '1.0.0' ); // Use this for versioning your scripts and styles

// Inclure les fichiers nécessaires
require_once( AT_PLUGIN_DIR . 'includes/post-type.php' );
require_once( AT_PLUGIN_DIR . 'includes/scripts.php' );
require_once( AT_PLUGIN_DIR . 'includes/meta-boxes.php' );
require_once( AT_PLUGIN_DIR . 'includes/save-post.php' );
require_once( AT_PLUGIN_DIR . 'includes/cleanup.php' );
require_once( AT_PLUGIN_DIR . 'includes/masonry-gallery.php' );

// Initialiser le plugin
function artiste_tableaux_init() {
    artiste_tableaux_register_post_type();
}
add_action( 'init', 'artiste_tableaux_init' );

// Enregistrer la fonction de nettoyage pour la désactivation
register_deactivation_hook( __FILE__, 'artiste_tableaux_plugin_cleanup' );

