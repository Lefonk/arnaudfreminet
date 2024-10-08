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

if ( ! class_exists( 'Tp_recently_view' ) ) {

	/**
	 * Tp_recently_view
	 *
	 * @since 5.6.0
	 */
	class Tp_recently_view {

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
			$this->tp_check_elements();
		}

		/**
		 * Check extra options switcher
		 *
		 * @since 5.6.0
		 */
		public function tp_check_elements() {
			$recently_viewed_switch = get_option( 'theplus_api_connection_data' );

			$product = get_option( 'theplus_options' );
			if ( ! empty( $product['check_elements'] ) && isset( $product['check_elements'] ) && isset( $recently_viewed_switch['theplus_woo_recently_viewed_switch'] ) && 'on' === $recently_viewed_switch['theplus_woo_recently_viewed_switch'] ) {
				if ( in_array( 'tp_product_listout', $product['check_elements'] ) ) {
					add_action( 'wp', array( $this, 'tp_pro_recent_view' ) );
				}
			}
		}

		/**
		 * Recent View Product
		 *
		 * @since 5.6.0
		 */
		public function tp_pro_recent_view() {

			if ( class_exists( 'Woocommerce' ) ) {

				if ( is_user_logged_in() && is_product() ) {
					$id                  = get_the_ID();
					$user_recentviewlist = get_user_meta( get_current_user_id(), 'tpwoorpvlist', true );

					if ( empty( $user_recentviewlist ) ) {
						$final = explode( ' ', $id );
					} else {
						$final = array_unique( array_merge( $user_recentviewlist, explode( ' ', $id ) ) );
					}
					update_user_meta( get_current_user_id(), 'tpwoorpvlist', $final );
				} elseif ( ! is_user_logged_in() && is_product() ) {
					$id           = get_the_ID();
					$cookie_store = 86400;

					if ( ! isset( $_COOKIE['tpwoorplnonlogin'] ) ) {
						$proid = $id;
						setcookie( 'tpwoorplnonlogin', $proid, time() + $cookie_store, '/', COOKIE_DOMAIN );
					} else {
						$get_cookie = $_COOKIE['tpwoorplnonlogin'];

						$check = explode( '|', $get_cookie );
						$val   = '';
						if ( ! in_array( $id, $check ) ) {
							$val = $get_cookie . '|' . $id;
						} else {
							$val = $get_cookie;
						}

						setcookie( 'tpwoorplnonlogin', $val, time() + $cookie_store, '/', COOKIE_DOMAIN );
					}
				}
			}
		}
	}

	return Tp_recently_view::get_instance();
}