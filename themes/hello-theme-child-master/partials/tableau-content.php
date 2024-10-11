<?php      
global $post;
$post_id = $post->ID; // This should be set correctly if setup_postdata() was called

// Fallback to the POST data if $post->ID is not set
if (!$post_id && isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);
}

$year = get_post_meta($post_id, '_artiste_tableaux_tableau_year', true);

// Add some error logging
error_log("Post ID: " . $post_id);
error_log("Year value: " . $year);
   
           // Get custom field values
           $year = get_post_meta( get_the_ID(), '_artiste_tableaux_tableau_year', true );
           $medium = get_post_meta( get_the_ID(), '_artiste_tableaux_tableau_medium', true );
           $dimensions = get_post_meta( get_the_ID(), '_artiste_tableaux_tableau_dimensions', true );
           $status = get_post_meta( get_the_ID(), '_artiste_tableaux_tableau_status', true );
           $additional_images = get_post_meta( get_the_ID(), '_artiste_tableaux_tableau_additional_images', true );
           $image_captions = get_post_meta( get_the_ID(), '_artiste_tableaux_image_captions', true );
           $captions = !empty($image_captions) ? explode(',', $image_captions) : [];


   // Debugging output
   error_log('Year: ' . $year);
   error_log('Medium: ' . $medium);
   error_log('Dimensions: ' . $dimensions);
   error_log('Status: ' . $status);
   error_log('Additional Images: ' . $additional_images); 
   error_log('Year Meta: ' . print_r($year, true)); // Log the raw output

   ?>
           <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
               <div class="entry-content">
                   <div class="tableau-all">
                       <div class="tableau-main-image">
                           <?php 
                           if ( has_post_thumbnail() ) {
                               $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0];
                               $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
                               ?>
                               <div class="image-magnifier-container">
                                   <img id="main-tableau-image" src="<?php echo esc_url($large_image_url ); ?>" alt="<?php the_title_attribute(); ?>" class="main-image" data-full-image="<?php echo esc_url( $full_image_url ); ?>">
                                   <div class="magnifier-frame"></div>
                                   <?php if ($status === 'vendu') : ?>
                                       <div class="status-circle"></div> 
                                   <?php endif; ?>
                               </div>
                           <?php
                           }
                           ?>
                       </div>
                       <div class="tableau-details-wrapper">
                           <div class="topContainer">
                               <div class="tableau-description">
                                   <h1 class="entry-title top"><?php the_title(); ?></h1>
                                   <?php the_content(); ?>
                               </div>
                               <div class="tableau-details">
                                   <p><strong><?php _e( 'Année', 'text_domain' ); ?></strong> <?php echo esc_html( $year ); ?></p>
                                   <p><strong><?php _e( 'Technique', 'text_domain' ); ?></strong> <?php echo esc_html( $medium ); ?></p>
                                   <p><strong><?php _e( 'Dimensions', 'text_domain' ); ?></strong> <?php echo esc_html( $dimensions ); ?></p>
                                   <p><strong><?php _e( 'Statut', 'text_domain' ); ?></strong> 
                                       <span class="status-<?php echo esc_attr($status); ?>">
                                           <?php echo esc_html( $status === 'disponible' ? __( 'Disponible', 'text_domain' ) : __( 'Vendu', 'text_domain' ) ); ?>
                                       </span>
                                   </p>
                               </div>
                           </div>
                           <div class="bottomContainer">
                               <div class="tableau-navigation">
                                   <?php
                                   $prev_post = get_previous_post();
                                   $next_post = get_next_post();
                                   ?>
                                   <?php if (!empty($prev_post)) : ?>
                                       <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-button prev-tableau" data-id="<?php echo $prev_post->ID; ?>">
                                           &larr; Tableau précédent
                                       </a>
                                   <?php endif; ?>
                                   <?php if (!empty($next_post)) : ?>
                                       <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-button next-tableau" data-id="<?php echo $next_post->ID; ?>">
                                           Tableau suivant &rarr;
                                       </a>
                                   <?php endif; ?>
                               </div>
                           </div>
                       </div>
                       <div class="zoomed-image-container"></div>
                   </div>
               </div>
           </article>
