<?php
function artiste_tableaux_register_post_type() {
    $labels = array(
        'name'                  => _x( 'Tableaux', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Tableau', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Tableaux', 'text_domain' ),
        'name_admin_bar'        => __( 'Tableau', 'text_domain' ),
        'archives'              => __( 'Archives des Tableaux', 'text_domain' ),
        'attributes'            => __( 'Attributs du Tableau', 'text_domain' ),
        'parent_item_colon'     => __( 'Tableau parent:', 'text_domain' ),
        'all_items'             => __( 'Tous les Tableaux', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter un Nouveau Tableau', 'text_domain' ),
        'add_new'               => __( 'Ajouter', 'text_domain' ),
        'new_item'              => __( 'Nouveau Tableau', 'text_domain' ),
        'edit_item'             => __( 'Modifier le Tableau', 'text_domain' ),
        'update_item'           => __( 'Mettre à jour le Tableau', 'text_domain' ),
        'view_item'             => __( 'Voir le Tableau', 'text_domain' ),
        'view_items'            => __( 'Voir les Tableaux', 'text_domain' ),
        'search_items'          => __( 'Rechercher un Tableau', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Tableau', 'text_domain' ),
        'description'           => __( 'Tableaux de l\'artiste', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-art',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'tableau', $args );
}