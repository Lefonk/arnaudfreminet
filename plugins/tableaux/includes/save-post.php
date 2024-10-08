<?php
function artiste_tableaux_save_tableau_custom_fields( $post_id ) {
    // Sauvegarder l'image mise en avant
    if ( isset( $_POST['post_thumbnail'] ) ) {
        $thumbnail_id = intval( $_POST['post_thumbnail'] );
        set_post_thumbnail( $post_id, $thumbnail_id );
    }

    // Vérifier le nonce
    if ( ! isset( $_POST['artiste_tableaux_tableau_details_nonce'] ) ) {
        return $post_id;
    }
    $nonce = $_POST['artiste_tableaux_tableau_details_nonce'];
    if ( ! wp_verify_nonce( $nonce, 'artiste_tableaux_tableau_details_nonce' ) ) {
        return $post_id;
    }

    // Vérifier si c'est une sauvegarde automatique
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // Vérifier les autorisations
    if ( 'tableau' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    // Sauvegarder les champs personnalisés
    $fields = array( 'year', 'medium', 'dimensions', 'status' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST['artiste_tableaux_tableau_' . $field] ) ) {
            $value = sanitize_text_field( $_POST['artiste_tableaux_tableau_' . $field] );
            update_post_meta( $post_id, '_artiste_tableaux_tableau_' . $field, $value );
        }
    }

    // Sauvegarder les images supplémentaires
    if ( isset( $_POST['artiste_tableaux_tableau_additional_images'] ) ) {
        $additional_images = sanitize_text_field( $_POST['artiste_tableaux_tableau_additional_images'] );
        update_post_meta( $post_id, '_artiste_tableaux_tableau_additional_images', $additional_images );
    }

    // Sauvegarder les légendes des images supplémentaires
    if ( isset( $_POST['artiste_tableaux_image_caption'] ) ) {
        $captions = array_map('sanitize_text_field', $_POST['artiste_tableaux_image_caption']);
        // Remove empty captions
        $captions = array_filter($captions, 'strlen');
        update_post_meta( $post_id, '_artiste_tableaux_image_captions', implode(',', $captions) );
    }

    // Mettre à jour uniquement le tag de statut
    if ( isset( $_POST['artiste_tableaux_tableau_status'] ) ) {
        $new_status = sanitize_text_field( $_POST['artiste_tableaux_tableau_status'] );
        
        // Supprimer les tags 'disponible' et 'vendu'
        wp_remove_object_terms( $post_id, 'disponible', 'post_tag' );
        wp_remove_object_terms( $post_id, 'vendu', 'post_tag' );
        
        // Ajouter le nouveau tag de statut
        wp_add_post_tags( $post_id, $new_status );
    }
}
add_action( 'save_post', 'artiste_tableaux_save_tableau_custom_fields' );