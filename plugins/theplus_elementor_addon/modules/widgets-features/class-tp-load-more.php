<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://posimyth.com/
 * @since      5.6.2
 *
 * @package    ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Tpaep_Load_More' ) ) {

	/**
	 * Tpaep_Load_More
	 *
	 * @since 5.6.2
	 */
	class Tpaep_Load_More {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since 5.6.2
		 */
		public function __construct() {
			$this->tp_check_elements();
		}

		/**
		 * Check extra options switcher
		 *
		 * @since 5.6.2
		 */
		public function tp_check_elements() {
			add_action( 'wp_ajax_theplus_more_post', array( $this, 'theplus_more_post_ajax' ) );
			add_action( 'wp_ajax_nopriv_theplus_more_post', array( $this, 'theplus_more_post_ajax' ) );
		}

		/**
		 * Recent View Product
		 *
		 * @since 5.6.2
		 */
		public function theplus_more_post_ajax() {

			global $post;
			ob_start();

			$load_attr = isset( $_POST['loadattr'] ) ? wp_unslash( $_POST['loadattr'] ) : '';
			if ( empty( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$load_attr = tp_check_decrypt_key( $load_attr );
			$load_attr = json_decode( $load_attr, true );
			if ( ! is_array( $load_attr ) ) {
				ob_get_contents();
				exit;
				ob_end_clean();
			}

			$nonce = isset( $load_attr['theplus_nonce'] ) ? wp_unslash( $load_attr['theplus_nonce'] ) : '';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			$style  = isset( $load_attr['style'] ) ? sanitize_text_field( wp_unslash( $load_attr['style'] ) ) : '';
			$layout = isset( $load_attr['layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['layout'] ) ) : '';
			$paged  = isset( $_POST['paged'] ) && intval( $_POST['paged'] ) ? wp_unslash( $_POST['paged'] ) : '';
			$offset = isset( $_POST['offset'] ) && intval( $_POST['offset'] ) ? wp_unslash( $_POST['offset'] ) : '';

			$post_type = isset( $load_attr['post_type'] ) ? sanitize_text_field( wp_unslash( $load_attr['post_type'] ) ) : '';
			$post_load = isset( $load_attr['load'] ) ? sanitize_text_field( wp_unslash( $load_attr['load'] ) ) : '';
			$category  = isset( $load_attr['category'] ) ? wp_unslash( $load_attr['category'] ) : '';

			$display_post  = isset( $load_attr['display_post'] ) && intval( $load_attr['display_post'] ) ? wp_unslash( $load_attr['display_post'] ) : 4;
			$include_posts = isset( $load_attr['include_posts'] ) ? sanitize_text_field( wp_unslash( $load_attr['include_posts'] ) ) : '';
			$exclude_posts = isset( $load_attr['exclude_posts'] ) ? sanitize_text_field( wp_unslash( $load_attr['exclude_posts'] ) ) : '';

			$post_load_more = isset( $load_attr['post_load_more'] ) && intval( $load_attr['post_load_more'] ) ? wp_unslash( $load_attr['post_load_more'] ) : '';
			$desktop_column = isset( $load_attr['desktop-column'] ) && intval( $load_attr['desktop-column'] ) ? wp_unslash( $load_attr['desktop-column'] ) : '';
			$tablet_column  = isset( $load_attr['tablet-column'] ) && intval( $load_attr['tablet-column'] ) ? wp_unslash( $load_attr['tablet-column'] ) : '';
			$mobile_column  = isset( $load_attr['mobile-column'] ) && intval( $load_attr['mobile-column'] ) ? wp_unslash( $load_attr['mobile-column'] ) : '';

			$metro_column = isset( $load_attr['metro_column'] ) ? wp_unslash( $load_attr['metro_column'] ) : '';
			$metro_style  = isset( $load_attr['metro_style'] ) ? wp_unslash( $load_attr['metro_style'] ) : '';

			$order_by   = isset( $load_attr['order_by'] ) ? sanitize_text_field( wp_unslash( $load_attr['order_by'] ) ) : '';
			$post_order = isset( $load_attr['post_order'] ) ? sanitize_text_field( wp_unslash( $load_attr['post_order'] ) ) : '';

			$filter_category  = isset( $load_attr['filter_category'] ) ? wp_unslash( $load_attr['filter_category'] ) : '';
			$animated_columns = isset( $load_attr['animated_columns'] ) ? sanitize_text_field( wp_unslash( $load_attr['animated_columns'] ) ) : '';

			$thumbnail     = isset( $load_attr['thumbnail'] ) ? wp_unslash( $load_attr['thumbnail'] ) : '';
			$thumbnail_car = isset( $load_attr['thumbnail_car'] ) ? wp_unslash( $load_attr['thumbnail_car'] ) : '';

			$display_thumbnail = isset( $load_attr['display_thumbnail'] ) ? wp_unslash( $load_attr['display_thumbnail'] ) : '';

			$skin_template    = isset( $load_attr['skin_template'] ) ? $load_attr['skin_template'] : '';
			$dynamic_template = $skin_template;

			$featured_image_type = isset( $load_attr['featured_image_type'] ) ? wp_unslash( $load_attr['featured_image_type'] ) : '';
			$tablet_metro_column = isset( $load_attr['tablet_metro_column'] ) ? wp_unslash( $load_attr['tablet_metro_column'] ) : '';
			$tablet_metro_style  = isset( $load_attr['tablet_metro_style'] ) ? wp_unslash( $load_attr['tablet_metro_style'] ) : '';

			$responsive_tablet_metro   = isset( $load_attr['responsive_tablet_metro'] ) ? wp_unslash( $load_attr['responsive_tablet_metro'] ) : '';
			$display_theplus_quickview = isset( $load_attr['display_theplus_quickview'] ) ? wp_unslash( $load_attr['display_theplus_quickview'] ) : '';

			$display_post_title = isset( $load_attr['display_post_title'] ) ? wp_unslash( $load_attr['display_post_title'] ) : '';
			$post_title_tag     = isset( $load_attr['post_title_tag'] ) ? wp_unslash( $load_attr['post_title_tag'] ) : '';

			$button_style = isset( $load_attr['button_style'] ) ? sanitize_text_field( wp_unslash( $load_attr['button_style'] ) ) : '';
			$before_after = isset( $load_attr['before_after'] ) ? sanitize_text_field( wp_unslash( $load_attr['before_after'] ) ) : '';
			$button_text  = isset( $load_attr['button_text'] ) ? sanitize_text_field( wp_unslash( $load_attr['button_text'] ) ) : '';
			$button_icon  = isset( $load_attr['button_icon'] ) ? $load_attr['button_icon'] : '';

			$button_icon_style = isset( $load_attr['button_icon_style'] ) ? sanitize_text_field( wp_unslash( $load_attr['button_icon_style'] ) ) : '';
			$button_icons_mind = isset( $load_attr['button_icons_mind'] ) ? $load_attr['button_icons_mind'] : '';

			$ex_cat = isset( $load_attr['ex_cat'] ) ? wp_unslash( $load_attr['ex_cat'] ) : '';
			$ex_tag = isset( $load_attr['ex_tag'] ) ? wp_unslash( $load_attr['ex_tag'] ) : '';

			/** if( 'dynamiclisting' === $post_load ) {*/
				$display_post_category = isset( $load_attr['display_post_category'] ) ? wp_unslash( $load_attr['display_post_category'] ) : '';
				$post_category_style   = isset( $load_attr['post_category_style'] ) ? wp_unslash( $load_attr['post_category_style'] ) : '';
				$title_desc_word_break = isset( $load_attr['title_desc_word_break'] ) ? wp_unslash( $load_attr['title_desc_word_break'] ) : '';

				$display_button  = isset( $load_attr['display_button'] ) ? wp_unslash( $load_attr['display_button'] ) : '';
				$display_excerpt = isset( $load_attr['display_excerpt'] ) ? wp_unslash( $load_attr['display_excerpt'] ) : '';
				$author_prefix   = isset( $load_attr['author_prefix'] ) ? wp_unslash( $load_attr['author_prefix'] ) : '';

				$style_layout = isset( $load_attr['style_layout'] ) ? sanitize_text_field( wp_unslash( $load_attr['style_layout'] ) ) : '';
				$post_tags    = isset( $load_attr['post_tags'] ) ? wp_unslash( $load_attr['post_tags'] ) : '';
				$post_authors = isset( $load_attr['post_authors'] ) ? wp_unslash( $load_attr['post_authors'] ) : '';

				$texonomy_category  = isset( $load_attr['texonomy_category'] ) ? sanitize_text_field( wp_unslash( $load_attr['texonomy_category'] ) ) : '';
				$display_post_meta  = isset( $load_attr['display_post_meta'] ) ? wp_unslash( $load_attr['display_post_meta'] ) : '';
				$post_excerpt_count = isset( $load_attr['post_excerpt_count'] ) ? wp_unslash( $load_attr['post_excerpt_count'] ) : '';

				$post_meta_tag_style    = isset( $load_attr['post_meta_tag_style'] ) ? wp_unslash( $load_attr['post_meta_tag_style'] ) : '';
				$display_post_meta_date = isset( $load_attr['display_post_meta_date'] ) ? wp_unslash( $load_attr['display_post_meta_date'] ) : '';

				$display_post_meta_author     = isset( $load_attr['display_post_meta_author'] ) ? wp_unslash( $load_attr['display_post_meta_author'] ) : '';
				$display_post_meta_author_pic = isset( $load_attr['display_post_meta_author_pic'] ) ? wp_unslash( $load_attr['display_post_meta_author_pic'] ) : '';

				$dpc_all = isset( $load_attr['dpc_all'] ) ? wp_unslash( $load_attr['dpc_all'] ) : '';

				$feature_image    = isset( $load_attr['feature_image'] ) ? wp_unslash( $load_attr['feature_image'] ) : '';
				$display_title_by = isset( $load_attr['display_title_by'] ) ? wp_unslash( $load_attr['display_title_by'] ) : '';

				$display_title_limit  = isset( $load_attr['display_title_limit'] ) ? wp_unslash( $load_attr['display_title_limit'] ) : '';
				$display_title_input  = isset( $load_attr['display_title_input'] ) ? wp_unslash( $load_attr['display_title_input'] ) : '';
				$display_title_3_dots = isset( $load_attr['display_title_3_dots'] ) ? wp_unslash( $load_attr['display_title_3_dots'] ) : '';

			/**  }*/

			/** if( 'products' === $widgetName ) {*/
				$out_of_stock = isset( $load_attr['out_of_stock'] ) ? sanitize_text_field( wp_unslash( $load_attr['out_of_stock'] ) ) : '';

				$display_rating   = isset( $load_attr['display_rating'] ) ? wp_unslash( $load_attr['display_rating'] ) : '';
				$display_product  = isset( $load_attr['display_product'] ) ? wp_unslash( $load_attr['display_product'] ) : '';
				$display_catagory = isset( $load_attr['display_catagory'] ) ? wp_unslash( $load_attr['display_catagory'] ) : '';

				$b_dis_badge_switch = isset( $load_attr['badge'] ) ? sanitize_text_field( wp_unslash( $load_attr['badge'] ) ) : '';
				$variation_price_on = isset( $load_attr['variationprice'] ) ? sanitize_text_field( wp_unslash( $load_attr['variationprice'] ) ) : '';
				$hover_image_on_off = isset( $load_attr['hoverimagepro'] ) ? sanitize_text_field( wp_unslash( $load_attr['hoverimagepro'] ) ) : '';

				$display_yith_list    = isset( $load_attr['display_yith_list'] ) ? wp_unslash( $load_attr['display_yith_list'] ) : '';
				$display_yith_compare = isset( $load_attr['display_yith_compare'] ) ? wp_unslash( $load_attr['display_yith_compare'] ) : '';

				$display_yith_wishlist  = isset( $load_attr['display_yith_wishlist'] ) ? wp_unslash( $load_attr['display_yith_wishlist'] ) : '';
				$display_yith_quickview = isset( $load_attr['display_yith_quickview'] ) ? wp_unslash( $load_attr['display_yith_quickview'] ) : '';

				$display_cart_button = isset( $load_attr['cart_button'] ) ? wp_unslash( $load_attr['cart_button'] ) : '';
				$dcb_single_product  = isset( $load_attr['dcb_single_product'] ) ? wp_unslash( $load_attr['dcb_single_product'] ) : '';

				$dcb_variation_product = isset( $load_attr['dcb_variation_product'] ) ? wp_unslash( $load_attr['dcb_variation_product'] ) : '';
			/** }*/

			$desktop_class = '';
			$tablet_class  = '';
			$mobile_class  = '';

			if ( 'carousel' !== $layout && 'metro' !== $layout ) {
				$desktop_class = 'tp-col-lg-' . esc_attr( $desktop_column );
				$tablet_class  = 'tp-col-md-' . esc_attr( $tablet_column );
				$mobile_class  = 'tp-col-sm-' . esc_attr( $mobile_column );
				$mobile_class .= ' tp-col-' . esc_attr( $mobile_column );
			}

			$clientContentFrom = '';
			if ( 'clients' === $post_load ) {
				$clientContentFrom = isset( $load_attr['SourceType'] ) ? $load_attr['SourceType'] : '';
				$disable_link      = isset( $load_attr['disable_link'] ) ? $load_attr['disable_link'] : '';
			}

			$j = 1;

			$args = array(
				'post_type'        => $post_type,
				'posts_per_page'   => $post_load_more,
				$texonomy_category => $category,
				'offset'           => $offset,
				'orderby'          => $order_by,
				'post_status'      => 'publish',
				'order'            => $post_order,
			);

			if ( '' !== $ex_tag ) {
				$ex_tag              = explode( ',', $ex_tag );
				$args['tag__not_in'] = $ex_tag;
			}
			if ( '' !== $ex_cat ) {
				$ex_cat                   = explode( ',', $ex_cat );
				$args['category__not_in'] = $ex_cat;
			}

			if ( '' !== $exclude_posts ) {
				$exclude_posts        = explode( ',', $exclude_posts );
				$args['post__not_in'] = $exclude_posts;
			}
			if ( '' !== $include_posts ) {
				$include_posts    = explode( ',', $include_posts );
				$args['post__in'] = $include_posts;
			}

			if ( ( ! empty( $post_type ) && 'product' === $post_type ) ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => array( 'exclude-from-search', 'exclude-from-catalog' ),
						'operator' => 'NOT IN',
					),
				);
			}

			if ( ! empty( $display_product ) && 'featured' === $display_product ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				);
			}

			if ( ! empty( $display_product ) && 'on_sale' === $display_product ) {
				$args['meta_query'] = array(
					'relation' => 'OR',
					array( // Simple products type.
						'key'     => '_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
					array( // Variable products type.
						'key'     => '_min_variation_sale_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'numeric',
					),
				);
			}

			if ( ! empty( $display_product ) && 'top_sales' === $display_product ) {
				$args['meta_query'] = array(
					array(
						'key'     => 'total_sales',
						'value'   => 0,
						'compare' => '>',
					),
				);
			}

			if ( ! empty( $display_product ) && 'instock' === $display_product ) {
				$args['meta_query'] = array(
					array(
						'key'   => '_stock_status',
						'value' => 'instock',
					),
				);
			}

			if ( ! empty( $display_product ) && 'outofstock' === $display_product ) {
				$args['meta_query'] = array(
					array(
						'key'   => '_stock_status',
						'value' => 'outofstock',
					),
				);
			}

			if ( '' !== $post_tags && 'post' === $post_type ) {
				$post_tags         = explode( ',', $post_tags );
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy'         => 'post_tag',
						'terms'            => $post_tags,
						'field'            => 'term_id',
						'operator'         => 'IN',
						'include_children' => true,
					),
				);
			}

			if ( ! empty( $post_type ) && ( 'post' !== $post_type && 'product' !== $post_type ) ) {
				if ( ! empty( $texonomy_category ) && 'categories' === $texonomy_category && ! empty( $category ) ) {
					$category          = explode( ',', $category );
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'categories',
							'field'    => 'slug',
							'terms'    => $category,
						),
					);
				}
			}

			if ( '' !== $post_authors && 'post' === $post_type ) {
				$args['author'] = $post_authors;
			}

			$ji = ( $post_load_more * $paged ) - $post_load_more + $display_post + 1;
			$ij = '';

			$tablet_ij = '';
			$content   = '';

			$tablet_metro_class = '';

			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) {
					$loop->the_post();

					/** Read more button*/
					$the_button = '';
					if ( 'yes' === $display_button ) {

						$btn_uid = uniqid( 'btn' );

						$data_class  = $btn_uid;
						$data_class .= ' button-' . $button_style . ' ';

						$the_button = '<div class="pt-plus-button-wrapper">';

							$the_button .= '<div class="button_parallax">';

								$the_button .= '<div class="ts-button">';

									$the_button .= '<div class="pt_plus_button ' . $data_class . '">';

										$the_button .= '<div class="animted-content-inner">';

											$the_button .= '<a href="' . esc_url( get_the_permalink() ) . '" class="button-link-wrap" role="button" rel="nofollow">';
											$the_button .= include THEPLUS_WSTYLES. 'blog/post-button.php'; 
											$the_button .= '</a>';

										$the_button .= '</div>';

									$the_button .= '</div>';

								$the_button .= '</div>';

							$the_button .= '</div>';

						$the_button .= '</div>';
					}

					if ( 'blogs' === $post_load ) {
						include THEPLUS_WSTYLES . 'ajax-load-post/blog-style.php';
					}
					if ( 'clients' === $post_load ) {
						include THEPLUS_WSTYLES . 'ajax-load-post/client-style.php';
					}
					if ( 'portfolios' === $post_load ) {
						include THEPLUS_WSTYLES . 'ajax-load-post/portfolio-style.php';
					}
					if ( 'products' === $post_load || 'dynamiclisting' === $post_load ) {
						$template_id = '';
						if ( ! empty( $dynamic_template ) ) {
							$count       = count( $dynamic_template );
							$value       = $offset % $count;
							$template_id = $dynamic_template[ $value ];
						}
						if ( 'dynamiclisting' === $post_load ) {
							include THEPLUS_WSTYLES . 'ajax-load-post/dynamic-listing-style.php';
						}

						if ( 'products' === $post_load ) {
							include THEPLUS_WSTYLES . 'ajax-load-post/product-style.php';
						}

						++$offset;
					}

					++$ji;
				}

				$content = ob_get_contents();

				ob_end_clean();
				endif;

			wp_reset_postdata();

			echo $content;

			exit;
			ob_end_clean();
		}
	}

	return Tpaep_Load_More::get_instance();
}
