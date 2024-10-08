<?php
function artiste_tableaux_add_meta_boxes() {
    if (get_post_type() !== 'tableau') {
        return;
    }
    
    add_meta_box(
        'artiste_tableaux_tableau_details',
        __( 'Détails du Tableau', 'text_domain' ),
        'artiste_tableaux_tableau_details_callback',
        'tableau',
        'normal',
        'default'
    );
    add_meta_box('postimagediv', __('Image principale du tableau'), 'post_thumbnail_meta_box', 'tableau', 'side', 'low');
}
add_action( 'add_meta_boxes', 'artiste_tableaux_add_meta_boxes' );

function artiste_tableaux_tableau_details_callback( $post ) {
    wp_nonce_field( 'artiste_tableaux_tableau_details_nonce', 'artiste_tableaux_tableau_details_nonce' );
    $year = get_post_meta( $post->ID, '_artiste_tableaux_tableau_year', true );
    $medium = get_post_meta( $post->ID, '_artiste_tableaux_tableau_medium', true );
    $dimensions = get_post_meta( $post->ID, '_artiste_tableaux_tableau_dimensions', true );
    $status = get_post_meta( $post->ID, '_artiste_tableaux_tableau_status', true );
    $additional_images = get_post_meta( $post->ID, '_artiste_tableaux_tableau_additional_images', true );
    $image_captions = get_post_meta( $post->ID, '_artiste_tableaux_image_captions', true );

    // Convertir les légendes en tableau
    $captions = !empty($image_captions) ? explode(',', $image_captions) : [];
    ?>
    
    <div class="two-column">
        <div>
            <label for="artiste_tableaux_tableau_year"><?php _e( 'Année:', 'text_domain' ); ?></label>
            <input type="text" id="artiste_tableaux_tableau_year" name="artiste_tableaux_tableau_year" value="<?php echo esc_attr( $year ); ?>" />
        </div>
        <div>
            <label for="artiste_tableaux_tableau_medium"><?php _e( 'Technique:', 'text_domain' ); ?></label>
            <input type="text" id="artiste_tableaux_tableau_medium" name="artiste_tableaux_tableau_medium" value="<?php echo esc_attr( $medium ); ?>" />
        </div>
        <div>
            <label for="artiste_tableaux_tableau_dimensions"><?php _e( 'Dimensions:', 'text_domain' ); ?></label>
            <input type="text" id="artiste_tableaux_tableau_dimensions" name="artiste_tableaux_tableau_dimensions" value="<?php echo esc_attr( $dimensions ); ?>" />
        </div>
        <div>
            <label for="artiste_tableaux_tableau_status"><?php _e( 'Statut:', 'text_domain' ); ?></label>
            <select id="artiste_tableaux_tableau_status" name="artiste_tableaux_tableau_status">
                <option value="disponible" <?php selected( $status, 'disponible' ); ?>><?php _e( 'Disponible', 'text_domain' ); ?></option>
                <option value="vendu" <?php selected( $status, 'vendu' ); ?>><?php _e( 'Vendu', 'text_domain' ); ?></option>
            </select>
        </div>
    </div>
    <p>
        <label for="artiste_tableaux_tableau_additional_images"><?php _e( 'Images supplémentaires:', 'text_domain' ); ?></label>
        <input type="hidden" id="artiste_tableaux_tableau_additional_images" name="artiste_tableaux_tableau_additional_images" value="<?php echo esc_attr( $additional_images ); ?>" />
        <button type="button" class="button" id="artiste_tableaux_add_images"><?php _e( 'Ajouter des images', 'text_domain' ); ?></button>
    </p>
    <div id="artiste_tableaux_image_container">
    <?php
    if ( $additional_images ) {
        $image_ids = explode( ',', $additional_images );
        foreach ( $image_ids as $index => $image_id ) {
            $full_image_url = wp_get_attachment_image_src( $image_id, 'full' )[0];
            echo '<div class="image-wrapper" data-id="' . $image_id . '">';
            echo '<img src="' . wp_get_attachment_image_src( $image_id, 'thumbnail' )[0] . '" data-full="' . $full_image_url . '" />';
            echo '<input type="text" name="artiste_tableaux_image_caption[]" placeholder="Légende" value="' . esc_attr( isset($captions[$index]) ? $captions[$index] : '' ) . '" class="caption-input" />';
            echo '<button type="button" class="remove-image button">Supprimer</button>';
            echo '</div>';
        }
    }
    ?>
    </div>
    <div id="previewImage"></div>
    <?php
    echo '<p>' . __('Pour définir l\'image principale du tableau, utilisez le panneau "Image mise en avant" dans la colonne de droite.', 'text_domain') . '</p>';
}