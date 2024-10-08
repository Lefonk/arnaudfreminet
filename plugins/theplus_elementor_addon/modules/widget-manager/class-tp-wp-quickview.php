<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://posimyth.com/
 * @since      5.6.0
 *
 * @package    ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Tp_Wp_Quickview' ) ) {

	/**
	 * Tp_Wp_Quickview
	 *
	 * @since 5.6.0
	 */
	class Tp_Wp_Quickview {

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
		 * @since 5.6.0
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_get_qv_post_info', array( $this, 'tp_get_qv_post_info_ajax' ) );
			add_action( 'wp_ajax_nopriv_tp_get_qv_post_info', array( $this, 'tp_get_qv_post_info_ajax' ) );
		}

		/**
		 * Quickview View Product
		 *
		 * @since 5.6.0
		 */
		public function tp_get_qv_post_info_ajax() {

			check_ajax_referer( 'theplus-addons', 'security' );

			global $woocommerce, $post;

			$template_id     = ! empty( $_POST['template_id'] ) ? wp_unslash( $_POST['template_id'] ) : '';
			$custom_template = ! empty( $_POST['custom_template'] ) ? wp_unslash( $_POST['custom_template'] ) : '';

			$args = array();
			if ( isset( $_POST['product_id'], $_POST['qvquery'] ) && ctype_digit( $_POST['product_id'] ) ) {
				$args = array(
					'post_type'   => ! empty( $_POST['qvquery'] ) ? wp_unslash( $_POST['qvquery'] ) : 'post',
					'post_status' => 'publish',
					'p'           => ! empty( $_POST['product_id'] ) ? wp_unslash( $_POST['product_id'] ) : '',
				);
			} else {
				wp_die();
			}

			$loop = new WP_Query( $args );

			if ( $loop->have_posts() ) {
				if ( ctype_digit( $loop->query['p'] ) && 'publish' === $loop->query['post_status'] && ! empty( $loop->query['post_type'] ) ) {

					ob_start();

					while ( $loop->have_posts() ) {
						$loop->the_post();

						?> <div class="tp-wp-quickview-wrapper"> 
						<?php

						if ( ! empty( $template_id ) && 'yes' === $custom_template ) {

							global $tp_render_loop, $wpquery, $tp_index;
							++$tp_index;

							$tp_old_query = $wpquery;

							$new_query = new \WP_Query( array( 'p' => get_the_ID() ) );

							$wpquery = $new_query;
							$pid     = get_the_ID();

							$template_id = get_current_ID( $template_id );

							$tp_render_loop = get_the_ID() . ',' . $template_id;

							$return = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );

							$tp_render_loop = false;

							$wpquery = $tp_old_query;
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
					}

					echo ob_get_clean();

					wp_die();

				}
			}
		}
	}
	return Tp_Wp_Quickview::get_instance();
}