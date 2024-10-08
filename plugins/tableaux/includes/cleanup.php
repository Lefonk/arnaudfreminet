<?php
function artiste_tableaux_plugin_cleanup() {
    // Supprimer les types de post personnalisés et les métadonnées associées
    $args = array('post_type' => 'tableau', 'posts_per_page' => -1);
    $tableaux = get_posts($args);
    foreach ($tableaux as $tableau) {
        wp_delete_post($tableau->ID, true);
    }
    
    // Supprimer les options du plugin
    delete_option('artiste_tableaux_plugin_version');
}
register_deactivation_hook( __FILE__, 'artiste_tableaux_plugin_cleanup' );