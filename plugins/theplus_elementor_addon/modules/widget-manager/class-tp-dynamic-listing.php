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

if ( ! class_exists( 'Tp_Dynamic_Listing' ) ) {

	/**
	 * It is Tp_Dynamic_Listing Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Dynamic_Listing {

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
			add_action( 'wp_ajax_tp_get_dl_post_info_ajax', array( $this, 'tp_get_dl_post_info' ) );
			add_action( 'wp_ajax_nopriv_tp_get_dl_post_info_ajax', array( $this, 'tp_get_dl_post_info' ) );
		}

		/**
		 * Dynamic listing Quickview
		 *
		 * @since 5.4.2
		 */
		public function tp_get_dl_post_info() {

			$nonce = isset( $_POST['security'] ) ? wp_unslash( $_POST['security'] ) : '';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			global $woocommerce, $post;
			$template_id     = ! empty( $_POST['template_id'] ) ? $_POST['template_id'] : '';
			$custom_template = ! empty( $_POST['custom_template'] ) ? $_POST['custom_template'] : '';

			$args = array();
			if ( isset( $_POST['product_id'], $_POST['qvquery'] ) && ctype_digit( $_POST['product_id'] ) ) {
				$args = array(
					'post_type'   => ! empty( $_POST['qvquery'] ) ? $_POST['qvquery'] : 'post',
					'post_status' => 'publish',
					'p'           => ! empty( $_POST['product_id'] ) ? $_POST['product_id'] : '',
				);
			} else {
				exit();
			}

			$loop = new WP_Query( $args );

			if ( $loop->have_posts() ) {
				if ( ctype_digit( $loop->query['p'] ) && 'publish' === $loop->query['post_status'] && ! empty( $loop->query['post_type'] ) ) {

					ob_start();
					while ( $loop->have_posts() ) :
						$loop->the_post();

						echo '<div class="tp-quickview-wrapper">';

						if ( ! empty( $template_id ) && ! empty( $custom_template ) && 'yes' === $custom_template ) {
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

	return Tp_Dynamic_Listing::get_instance();
}
