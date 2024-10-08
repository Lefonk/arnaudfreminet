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

if ( ! class_exists( 'Tp_Widget_Manager' ) ) {

	/**
	 * It is Tp_Widget_Manager Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Widget_Manager {

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
		 */
		public function __construct() {
			$this->tp_get_widgets();
		}

		/**
		 * Get lus WIdget Atbs Widget list
		 *
		 * @since 5.5.6
		 * @version 5.6.0
		 */
		public function tp_get_widgets() {
			$elements = theplus_get_option( 'general', 'check_elements' );

			if ( ! empty( $elements ) ) {
				foreach ( $elements as $key => $value ) {
					$fielname = str_replace( '_', '-', $value );

					$array_list = array(
						'tp_dynamic_listing',
						'tp_product_listout',
						'tp_search_bar',
						'tp_search_filter',
						'tp_social_feed',
						'tp_social_reviews',
						'tp_wp_bodymovin',
						'tp_wp_login_register',
						'tp_woo_compare',
						'tp_woo_wishlist',
						'tp_wp_quickview'
					);

					$file_path = THEPLUS_PATH . "modules/widget-manager/class-{$fielname}.php";

					if ( in_array( $value, $array_list, true ) && file_exists( $file_path ) ) {
						require_once $file_path;
					}

					if( 'tp_product_listout' === $value || 'tp_dynamic_listing' === $value ){
						require_once THEPLUS_PATH . "modules/widget-manager/class-tp-woo-listing.php";
						require_once THEPLUS_PATH . "modules/widget-manager/class-tp-recently-view.php";
					}

				}
			}
			
		}
	}

	return Tp_Widget_Manager::get_instance();
}