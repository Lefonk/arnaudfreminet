<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      5.4.2
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_product_listout' ) ) {

	/**
	 * It is Tp_product_listout Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_product_listout {

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
		 * @since 5.4.2
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_get_product_ajax', array( $this, 'tp_get_product_info' ) );
			add_action( 'wp_ajax_nopriv_tp_get_product_ajax', array( $this, 'tp_get_product_info' ) );
		}

		/**
		 * Product listing Quickview
		 *
		 * @since 5.4.2
		 */
		public function tp_get_product_info() {
			if ( class_exists( 'woocommerce' ) ) {

				$nonce = ( isset( $_POST['security'] ) ) ? wp_unslash( $_POST['security'] ) : '';
				if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
					die( 'Security checked!' );
				}

				global $woocommerce, $post;
				$product_id      = ! empty( $_POST['product_id'] ) ? $_POST['product_id'] : '';
				$template_id     = ! empty( $_POST['template_id'] ) ? $_POST['template_id'] : '';
				$status          = ! empty( $_POST['status'] ) ? $_POST['status'] : '';
				$custom_template = ! empty( $_POST['custom_template'] ) ? $_POST['custom_template'] : '';

				if ( ctype_digit( $product_id ) && $status === 'publish' ) {
					wp( 'p=' . $product_id . '&post_status=publish&post_type=product' );

					ob_start();
					while ( have_posts() ) :
						the_post();
						?>
						<div class="tp-quickview-wrapper"> 
						<?php
						if ( ! empty( $template_id ) && ! empty( $custom_template ) && $custom_template == 'yes' ) {
							global $tp_render_loop, $wp_query, $tp_index;
							++$tp_index;

							$tp_old_query   = $wp_query;
							$new_query      = new \WP_Query( array( 'p' => get_the_ID() ) );
							$wp_query       = $new_query;
							$pid            = get_the_ID();
							$template_id    = get_current_ID( $template_id );
							$tp_render_loop = get_the_ID() . ',' . $template_id;
							if ( ! $template_id ) {
								return;
							}
							$return         = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
							$tp_render_loop = false;
							$wp_query       = $tp_old_query;
							echo $return;
						} else {
							echo '<div class="tp-qv-left">';
								echo get_the_post_thumbnail();
							echo '</div>';
							echo '<div class="tp-qv-right">';
								echo '<div class="tp-qv-title">' . get_the_title() . '</div>';
								$excerpt = explode( ' ', get_the_excerpt(), 50 );

							if ( count( $excerpt ) >= 50 ) {
								array_pop( $excerpt );
								$excerpt = implode( ' ', $excerpt ) . '...';
							} else {
								$excerpt = implode( ' ', $excerpt );
							}

								$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );
								echo '<div class="tp-qv-excerpt">' . $excerpt . '</div>';
								echo '<div class="tp-qv-button"><a href="' . get_permalink() . '">Read More</a></div>';
							echo '</div>';
						}

						echo '</div>';

					endwhile;
					echo ob_get_clean();
					exit();
				}
			}
		}
	}

	return Tp_product_listout::get_instance();
}
