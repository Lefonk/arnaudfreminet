<?php
/**
 * Analog Unsplash Extension
 *
 * @package   Analog Unsplash
 * @author    Analog
 * @license   GPL-3.0
 * @link      https://analogwp.com
 * @copyright 2017 Analog (Pty) Ltd
 */

namespace Analog\Modules\Unsplash\Core;

use Analog\Options;

/**
 * Init class for Media Popup.
 */
class Init {
	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Holds key for Uploaded photos user meta.
	 *
	 * @var string
	 */
	public static $user_meta_uploads = 'ang_up_library_uploads';

	/**
	 * Plugin slug.
	 *
	 * @var string
	 */
	private $plugin_slug;

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	private $version;


	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Init ) ) {
			self::$instance = new self();

			self::$instance->do_hooks();
		}
	}

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		$this->plugin_slug = 'ang-unsplash-photos';
		$this->version     = ANG_UP_VERSION;
	}


	/**
	 * Handle WP actions and filters.
	 *
	 * @since   1.0.0
	 */
	private function do_hooks() {
		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 100 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 100 );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_admin_scripts' ), 100 );
	}

	/**
	 * Register and enqueue admin-specific javascript
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		$script_suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		if ( did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_script( $this->plugin_slug . '-tab', ANG_UP_URL . "includes/core/js/media-tab{$script_suffix}.js", array( 'wp-i18n', 'jquery' ), filemtime( ANG_UP_DIR . "includes/core/js/media-tab{$script_suffix}.js" ), true );

			wp_enqueue_script(
				$this->plugin_slug . '-admin-script',
				ANG_UP_URL . "assets/js/admin{$script_suffix}.js",
				array( 'wp-i18n', 'wp-components', 'jquery', 'react', 'react-dom' ),
				filemtime( ANG_UP_DIR . "assets/js/admin{$script_suffix}.js" ),
				true
			);

			wp_enqueue_style( 'wp-components' );

			wp_set_script_translations( $this->plugin_slug . '-tab', 'ang-pro' );
			wp_set_script_translations( $this->plugin_slug . '-admin-script', 'ang-pro' );

			$uploads = get_user_meta( get_current_user_id(), self::$user_meta_uploads, true );
			if ( ! $uploads ) {
				$uploads = array();
			}
			$api_key = Options::get_instance()->get( 'ang_unsplash_key' );
			if ( ! $api_key ) {
				$api_key = ANG_UP_KEY;
			}
			$unsplash_username = Options::get_instance()->get( 'ang_default_username' );
			if ( ! $unsplash_username ) {
				$unsplash_username = 'analogwp';
			}

			$i10n = array(
				'ajaxurl'          => admin_url( 'admin-ajax.php' ),
				'uploads'          => $uploads,
				'version'          => ANG_UP_VERSION,
				'apiKey'           => $api_key,
				'unsplashUsername' => $unsplash_username,
				'rest'             => esc_url_raw( rest_url() ),
				'nonce'            => wp_create_nonce( 'wp_rest' ),
				'error_msg_upload' => __( 'Unable to download image to server, please check your server permissions.', 'ang-pro' ),
				'importing'        => __( 'Downloading...', 'ang-pro' ),
				'resizing'         => __( 'Resizing...', 'ang-pro' ),
				'uploaded'         => __( 'Done', 'ang-pro' ),
			);

			wp_localize_script(
				$this->plugin_slug . '-admin-script',
				'ANG_UP',
				$i10n
			);
		}
	}
}

Init::get_instance();
