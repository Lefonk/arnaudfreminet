<?php
// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

function artiste_tableaux_enqueue_admin_scripts($hook) {
    error_log('Hook: ' . $hook);
    // Check if we're on the post edit or new post page
    if (!in_array($hook, array('post.php', 'post-new.php'))) {
        error_log('Not on post edit or new post page');
        return;
    }

    // Check if the current screen is for our custom post type
    $screen = get_current_screen();
    error_log('Screen: ' . print_r($screen, true));

    if (!$screen || 'tableau' !== $screen->post_type) {
        error_log('Not on tableau post type');
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script('artiste-tableaux-admin-script', AT_PLUGIN_URL . 'assets/js/artiste-tableaux-admin.js', array('jquery'), AT_VERSION, true);
    wp_enqueue_style('artiste-tableaux-admin-style', AT_PLUGIN_URL . 'assets/css/artiste-tableaux-admin.css', array(), AT_VERSION); 
    error_log('Enqueuing scripts and styles');
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('artiste_tableaux_nonce'),
        'strings' => array(
            'selectImages' => __('Sélectionner des images', 'artiste-tableaux'),
            'useImages' => __('Utiliser ces images', 'artiste-tableaux'),
        )
    );
    wp_localize_script('artiste-tableaux-admin-script', 'artisteTableauxData', $script_data_array);
}
add_action('admin_enqueue_scripts', 'artiste_tableaux_enqueue_admin_scripts');

function artiste_tableaux_enqueue_frontend_scripts() {
    // Enqueue Isotope
    wp_enqueue_script('isotope', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array('jquery'), null, true);

    // Enqueue custom masonry gallery script
    wp_enqueue_script('artiste-tableaux-masonry', AT_PLUGIN_URL . 'assets/js/gallery-script.js', array('jquery', 'isotope'), AT_VERSION, true);

    // Enqueue custom masonry gallery styles
    wp_enqueue_style('artiste-tableaux-masonry-style', AT_PLUGIN_URL . 'assets/css/masonry-gallery.css', array(), AT_VERSION);
}
add_action('wp_enqueue_scripts', 'artiste_tableaux_enqueue_frontend_scripts');