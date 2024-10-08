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

if ( ! class_exists( 'Tp_Wp_Bodymovin' ) ) {

	/**
	 * It is Tp_Wp_Bodymovin Main Class
	 *
	 * @since 5.4.2
	 */
	class Tp_Wp_Bodymovin {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @var animations
		 */
		public static $animations = array();

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
			add_action( 'wp_footer', array( $this, 'plus_animation_data' ), 5 );
		}

		/**
		 * Adds a new animation to the list of animations.
		 *
		 * @param array $animation An array containing animation data.
		 * It should at least contain an 'id' key to uniquely identify the animation.
		 */
		public static function plus_addAnimation( $animation = array() ) {

			if ( empty( $animation ) || empty( $animation['id'] ) ) {
				return false;
			}

			self::$animations[ $animation['container_id'] ] = $animation;
		}

		/**
		 * Retrieves the list of animations.
		 *
		 * @return array The list of animations.
		 */
		public static function plus_getAnimations() {
			return apply_filters( 'wpbdmv-animations', self::$animations );
		}

		/**
		 * Checks if there are any animations available.
		 */
		public static function plus_has_animations() {
			$animations = self::plus_getAnimations();

			return empty( $animations ) ? false : true;
		}

		/**
		 * Localizes animation data for JavaScript usage.
		 */
		public function plus_animation_data() {

			if ( ! self::plus_has_animations() ) {
				return;
			}

			wp_localize_script(
				'theplus-bodymovin',
				'wpbodymovin',
				array(
					'animations' => self::plus_getAnimations(),
					'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				)
			);
		}
	}

	return Tp_Wp_Bodymovin::get_instance();
}
