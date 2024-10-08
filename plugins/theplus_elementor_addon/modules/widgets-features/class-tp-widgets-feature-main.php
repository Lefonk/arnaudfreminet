<?php
/**
 * The file that defines the core plugin class
 *
 * @link       https://posimyth.com/
 * @since      5.6.4
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TP_Widgets_Features_main' ) ) {
	/**
	 * It is Main Class for load all widet feature.
	 *
	 * @since 5.6.4
	 */
	class TP_Widgets_Features_main {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */private static $instance;
		

		/**
		 *  Initiator
		 *
		 *  @since 5.6.4
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
		 * @since 5.6.4
		 */
		public function __construct() {
			$this->tp_get_widgets();
		}

		/**
		 * Manage Widget feature ajax.
		 *
		 * @since 5.6.4
		 */
		public function tp_get_widgets() {

            $elements = theplus_get_option( 'general', 'check_elements' );

			if ( ! empty( $elements ) ) {
				foreach ( $elements as $key => $value ) {
					
					if( 'tp_blog_listout' === $value || 'tp_clients_listout' === $value || 'tp_dynamic_listing' === $value || 'tp_product_listout' === $value || 'tp_team_member_listout' === $value || 'tp_search_bar' === $value || 'tp_social_feed' === $value || 'tp_social_reviews' === $value ){
						require_once THEPLUS_PATH . "modules/widgets-features/class-tp-load-more.php";
				    }
				}
			}

		}
	}

	return TP_Widgets_Features_main::get_instance();
}