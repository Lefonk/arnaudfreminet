<?php
// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

function artiste_tableaux_masonry_gallery_shortcode($atts) {
    $atts = shortcode_atts(array(
        'posts_per_page' => -1,
    ), $atts);

    // Get tags for filtering
    $tags = get_terms(array(
        'taxonomy' => 'post_tag',
        'hide_empty' => true,
    ));

    ob_start();
    ?>
    <div class="masonry-gallery-container">
        <!-- Big Screen Filter Interface -->
        <div class="filters-container big-screen">
            <div class="filter-group" id="main-filters">
                <button class="filter-button active" data-filter="*">All</button>
                <?php foreach ($tags as $tag): ?>
                    <button class="filter-button" data-filter=".<?= esc_attr($tag->slug) ?>">
                        <?= esc_html($tag->name) ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="filter-actions">
                <button id="clear-filters" class="action-button">Clear Filters</button>
                <button id="apply-filters" class="action-button primary">Apply Filters</button>
            </div>
        </div>

        <!-- Small Screen Filter Interface -->
        <button id="open-filter-modal" class="filter-toggle-button">
            <span class="filter-icon">&#9776;</span> Filter
        </button>

        <div class="masonry-gallery">
            <?php
            $args = array(
                'post_type' => 'tableau',
                'posts_per_page' => $atts['posts_per_page'],
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $post_tags = get_the_tags();
                    $tag_classes = '';
                    if ($post_tags) {
                        foreach ($post_tags as $tag) {
                            $tag_classes .= ' ' . esc_attr($tag->slug);
                        }
                    }
                    $year = get_post_meta(get_the_ID(), '_artiste_tableaux_tableau_year', true);
                    $medium = get_post_meta(get_the_ID(), '_artiste_tableaux_tableau_medium', true);
                    $dimensions = get_post_meta(get_the_ID(), '_artiste_tableaux_tableau_dimensions', true);
                    ?>
                    <div class="masonry-item<?php echo esc_attr($tag_classes); ?>" data-post-id="<?php the_ID(); ?>">
                    <a href="javascript:;" class="gallery-item-link">
                        <?php 
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        }
                        ?>
                    </a>
                    <p><?php the_title(); ?>
                    <?php if($medium !== ''): ?><br><?php echo esc_html($medium); ?><?php endif; ?>
                    <?php if($dimensions !== ''): ?><br><?php echo esc_html($dimensions); ?><?php endif; ?></p>
                </div> 
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No tableaux found.</p>';
            endif;
            ?>
        </div>
    </div>

    <div id="filter-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Filter Options</h2>
                <button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="filter-group" id="modal-filters">
                    <button class="filter-button active" data-filter="*">All</button>
                    <?php foreach ($tags as $tag): ?>
                        <button class="filter-button" data-filter=".<?= esc_attr($tag->slug) ?>">
                            <?= esc_html($tag->name) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button id="clear-filters-mobile" class="action-button">Clear</button>
                <button id="apply-filters-mobile" class="action-button primary">Apply</button>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('masonry_gallery', 'artiste_tableaux_masonry_gallery_shortcode');
?>