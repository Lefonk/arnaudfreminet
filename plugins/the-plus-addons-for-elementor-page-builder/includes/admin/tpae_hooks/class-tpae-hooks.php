<?php
/**
 * The file store Database Default Entry
 *
 * @link       https://posimyth.com/
 * @since      5.6.7
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

/**Exit if accessed directly.*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Hooks' ) ) {

	/**
	 * Tpae_Hooks
	 *
	 * @since 1.0.0
	 */
	class Tpae_Hooks {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var global_setting
		 */
		public $global_setting = array();

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

			if ( is_admin() ) {
				add_action( 'tpae_db_widget_default', array( $this, 'tpae_db_widget_default' ), 10 );
				// add_filter( 'tpae_global_settings', array( $this, 'tpae_global_settings' ), 10, 1 );
			}
		}

		/**
		 * Create Default widget entry
		 *
		 * @since 1.0.0
		 */
		public function tpae_db_widget_default() {

			$default_load = get_option( 'theplus_options' );

			if ( empty( $default_load ) ) {
				$theplus_options['check_elements'] = array( 'tp_accordion', 'tp_adv_text_block', 'tp_blockquote', 'tp_blog_listout', 'tp_button', 'tp_contact_form_7', 'tp_countdown', 'tp_clients_listout', 'tp_gallery_listout', 'tp_flip_box', 'tp_heading_animation', 'tp_header_extras', 'tp_heading_title', 'tp_info_box', 'tp_navigation_menu_lite', 'tp_page_scroll', 'tp_progress_bar', 'tp_number_counter', 'tp_pricing_table', 'tp_scroll_navigation', 'tp_social_icon', 'tp_tabs_tours', 'tp_team_member_listout', 'tp_testimonial_listout', 'tp_video_player' );

				add_option( 'theplus_options', $theplus_options, '', 'no' );
			}
		}

		/**
		 * Create Default widget entry
		 *
		 * @since 1.0.0
		 */
		public function tpae_global_settings( $type ) {

			if ( 'set' === $type ){

				$this->global_setting['white_label'] = false;

				return $this->global_setting;
			} else if( 'get' === $type ){

				return $this->global_setting;
			}

		}
	}

	Tpae_Hooks::get_instance();
}
