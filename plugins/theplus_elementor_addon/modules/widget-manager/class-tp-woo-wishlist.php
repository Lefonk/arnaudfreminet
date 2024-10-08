<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://posimyth.com/
 * @since      5.5.4
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Woo_Wishlist' ) ) {

	/**
	 * It is Tp_Woo_Wishlist Main Class
	 *
	 * @since 5.5.4
	 */
	class Tp_Woo_Wishlist {

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
		 * @since 5.5.4
		 */
		public function __construct() {
			add_action( 'wp_ajax_tp_wl_get_user_data', array( $this, 'tp_wl_get_user_data' ) );
			add_action( 'wp_ajax_nopriv_tp_wl_get_user_data', array( $this, 'tp_wl_get_user_data' ) );

			add_action( 'admin_post_nopriv_user_wishlist_update', array( $this, 'update_tp_wl_ajax' ) );
			add_action( 'admin_post_user_wishlist_update', array( $this, 'update_tp_wl_ajax' ) );

			add_action( 'admin_post_nopriv_tp_user_wishlist_remove', array( $this, 'remove_tp_wl_ajax' ) );
			add_action( 'admin_post_tp_user_wishlist_remove', array( $this, 'remove_tp_wl_ajax' ) );
		}

		/**
		 * Get User Data & Check Login or not - Wishlist
		 *
		 * @since 5.5.4
		 */
		public function tp_wl_get_user_data() {
			$nonce = isset( $_POST['security'] ) ? wp_unslash( $_POST['security'] ) : '';
			$query = ! empty( $_POST['query'] ) ? wp_unslash( $_POST['query'] ) : 'product';

			$wishlistdynname = ! empty( $_POST['shopname'] ) ? wp_unslash( $_POST['shopname'] ) : 'wishlist';

			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}
			if ( is_user_logged_in() ) {
				$user = wp_get_current_user();

				$user_wishlist = get_user_meta( $user->ID, $wishlistdynname, true );

				$uwl = array();
				if ( $user_wishlist ) {
					$uwl = $user_wishlist;
				}

				echo wp_json_encode(
					array(
						'user_id'  => $user->ID,
						'wishlist' => $uwl,
						'count'    => count( $uwl ),
					)
				);
			}
			die();
		}

		/**
		 * Update WishList
		 *
		 * @since 5.5.4
		 */
		public function update_tp_wl_ajax() {
			$nonce = isset( $_POST['security'] ) ? wp_unslash( $_POST['security'] ) : '';
			$query = ! empty( $_POST['query'] ) ? wp_unslash( $_POST['query'] ) : 'product';

			$wishlistdynname = ! empty( $_POST['shopname'] ) ? wp_unslash( $_POST['shopname'] ) : 'wishlist';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			$user_wishlist = get_user_meta( get_current_user_id(), $wishlistdynname, true );
			if ( $user_wishlist == '' ) {
				$wl = explode( ' ', wp_unslash( $_POST['wishlist'] ) );
			} else {
				$wl = array_unique( array_merge( $user_wishlist, explode( ' ', wp_unslash( $_POST['wishlist'] ) ) ) );
			}
			update_user_meta( get_current_user_id(), $wishlistdynname, $wl );
			die();
		}

		/**
		 * Remove From WishList
		 *
		 * @since 5.5.4
		 */
		public function remove_tp_wl_ajax() {
			$nonce = isset( $_POST['security'] ) ? wp_unslash( $_POST['security'] ) : '';
			$query = ! empty( $_POST['query'] ) ? wp_unslash( $_POST['query'] ) : 'product';

			$wishlistdynname = ! empty( $_POST['shopname'] ) ? wp_unslash( $_POST['shopname'] ) : 'wishlist';
			if ( ! wp_verify_nonce( $nonce, 'theplus-addons' ) ) {
				die( 'Security checked!' );
			}

			if ( isset( $_POST['user_id'] ) && ! empty( $_POST['user_id'] ) ) {
				$user_id  = wp_unslash( $_POST['user_id'] );
				$user_obj = get_user_by( 'id', $user_id );
				if ( ! is_wp_error( $user_obj ) && is_object( $user_obj ) ) {
					$user = wp_get_current_user();

					$user_wishlist = get_user_meta( wp_unslash( $_POST['user_id'] ), $wishlistdynname, true );

					$uwl = array();
					if ( $user_wishlist ) {
						$uwl = $user_wishlist;
					}
					$wlaj = ! empty( $_POST['wishlist'] ) ? explode( ' ', wp_unslash( $_POST['wishlist'] ) ) : array();
					$far  = array_diff( $uwl, $wlaj );

					update_user_meta( get_current_user_id(), $wishlistdynname, $far );
				}
			}
			die();
		}
	}

	return Tp_Woo_Wishlist::get_instance();
}