<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

function hello_elementor_child_scripts_styles() {
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['hello-elementor-theme-style'],
        HELLO_ELEMENTOR_CHILD_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles' );

/**
 * Enqueue frontend scripts and styles for the 'oeuvres' page and 'tableau' single posts.
 */
function enqueue_tableau_frontend_scripts() {
    if ( is_page( 'oeuvres' ) || is_singular( 'tableau' )) {
        wp_enqueue_style( 'tableau-style', get_stylesheet_directory_uri() . '/css/tableau-style.css', array(), '1.0' );
        wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.css' );

        // Ensure jQuery is loaded before other scripts that depend on it
        wp_enqueue_script('jquery');

        wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.umd.js', array('jquery'), '4.0', true );
        wp_enqueue_script( 'isotope-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'imagesloaded-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'tableau-script', get_stylesheet_directory_uri() . '/js/tableau-script.js', array('jquery', 'isotope-js', 'imagesloaded-js'), '1.0', true );
        wp_enqueue_script( 'gallery-script', get_stylesheet_directory_uri() . '/js/gallery-script.js', array('jquery'), '1.0.0', true );

        // Localize 'tableau-script.js' with filter data
        wp_localize_script( 'tableau-script', 'tableau_filter_data', get_tableau_filters() );

        // Localize 'gallery-script.js' with AJAX parameters
        wp_localize_script( 'gallery-script', 'gallery_ajax_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('load_tableau_nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_tableau_frontend_scripts');

/**
 * Get all categories and tags for 'tableau' posts, with counts.
 */
function get_tableau_filters() {
    $categories = get_terms([
        'taxonomy'   => 'category',
        'hide_empty' => true, // Only include categories with assigned posts
    ]);

    $tags = get_terms([
        'taxonomy'   => 'post_tag',
        'hide_empty' => true, // Only include tags with assigned posts
    ]);

    return [
        'categories' => $categories,
        'tags'       => $tags,
    ];
}

/**
 * Display filter buttons for categories and tags.
 */
function display_tableau_filters() {
    // This function outputs the filter buttons.

    $filters = get_tableau_filters();

    echo '<div class="tableau-filters">'; // Combined filters container

    foreach ($filters as $filter_type => $terms) {
        if (!empty($terms)) { // Check if there are any terms in this filter type
            echo '<div class="filter-group ' . esc_attr($filter_type) . '-filters">'; // Group filters by type
            echo '<h3>' . esc_html(ucfirst($filter_type)) . '</h3>'; // Add a heading for each filter type
            foreach ($terms as $term) {
                echo '<button class="filter-button" data-filter=".tag-' . esc_attr($term->slug) . '">'. esc_html($term->name) . '</button>';
            }
            echo '</div>';
        }
    }

    echo '</div>'; // Close combined filters container
}

/**
 * Display the 'tableau' posts in the gallery with proper data attributes.
 */
function display_tableaux_by_category_and_tags() {
    $args = [
        'post_type'      => 'tableau',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div id="tableau-container" class="post-cards masonry-gallery">'; // Added 'masonry-gallery' class
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_category();
            $tags = get_the_tags();

            $category_classes = array_map(function($cat) {
                return 'category-' . esc_attr($cat->slug);
            }, $categories);

            $tag_classes = $tags ? array_map(function($tag) {
                return 'tag-' . esc_attr($tag->slug);
            }, $tags) : [];

            $all_classes = array_merge($category_classes, $tag_classes);
            $data_tags = $tags ? implode(' ', array_map(function($tag) {
                return esc_attr($tag->slug);
            }, $tags)) : '';

            echo '<div class="card grid-item masonry-item ' . implode(' ', $all_classes) . '" data-tags="' . $data_tags . '" data-post-id="' . get_the_ID() . '">';

            // Gallery item link with proper attributes
            echo '<a href="javascript:;" class="gallery-item-link" data-fancybox="gallery">';
            if (has_post_thumbnail()) {
                echo '<div class="image-container">';
                echo get_the_post_thumbnail(get_the_ID(), 'medium');
                echo '</div>';
            }
            echo '</a>';

            // Title and meta information
            echo '<p>' . get_the_title();
            $medium = get_post_meta(get_the_ID(), '_artiste_tableaux_tableau_medium', true);
            $dimensions = get_post_meta(get_the_ID(), '_artiste_tableaux_tableau_dimensions', true);
            if ($medium !== '') {
                echo '<br>' . esc_html($medium);
            }
            if ($dimensions !== '') {
                echo '<br>' . esc_html($dimensions);
            }
            echo '</p>';

            echo '</div>';
        }
        echo '</div>';
    } else {
        echo 'Pas de tableaux avec ces critères';
    }

    wp_reset_postdata();
}

/**
 * AJAX handler to load tableau content for the modal.
 */
function load_tableau_content() {
    // Check nonce for security
    check_ajax_referer('load_tableau_nonce', 'nonce');

    $post_id = intval($_POST['post_id']);

    if (empty($post_id)) {
        wp_send_json_error('Invalid Post ID');
    }

    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'tableau') {
        wp_send_json_error('Post not found');
    }

    // Retrieve necessary data
    $title      = get_the_title($post_id);
    $image_url  = get_the_post_thumbnail_url($post_id, 'full');
    $year       = get_post_meta($post_id, '_artiste_tableaux_tableau_year', true);
    $medium     = get_post_meta($post_id, '_artiste_tableaux_tableau_medium', true);
    $dimensions = get_post_meta($post_id, '_artiste_tableaux_tableau_dimensions', true);

    // Create the HTML content for the modal
    ob_start();
    ?>
    <div class="modal-content-wrapper">
        <div class="modal-image">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
        </div>
        <div class="modal-details">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if ($year): ?>
                <p><strong>Année :</strong> <?php echo esc_html($year); ?></p>
            <?php endif; ?>
            <?php if ($medium): ?>
                <p><strong>Médium :</strong> <?php echo esc_html($medium); ?></p>
            <?php endif; ?>
            <?php if ($dimensions): ?>
                <p><strong>Dimensions :</strong> <?php echo esc_html($dimensions); ?></p>
            <?php endif; ?>
            <div class="modal-navigation">
                <button class="nav-button" id="prev-tableau">Tableau Précédent</button>
                <button class="nav-button" id="next-tableau">Tableau Suivant</button>
            </div>
        </div>
    </div>
    <?php
    $content = ob_get_clean();

    wp_send_json_success(array('content' => $content));
}
add_action('wp_ajax_load_tableau_content', 'load_tableau_content');
add_action('wp_ajax_nopriv_load_tableau_content', 'load_tableau_content');

/**
 * Shortcode to display the filters and gallery.
 */
function tableaux_shortcode() {
    ob_start();
    display_tableau_filters();
    display_tableaux_by_category_and_tags();
    return ob_get_clean();
}
add_shortcode('tableaux', 'tableaux_shortcode');