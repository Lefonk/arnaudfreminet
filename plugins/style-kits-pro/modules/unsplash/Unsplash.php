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

namespace Analog\Modules\Unsplash;

use Analog\Options;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ANG_UP_VERSION', '1.0.1' );
define( 'ANG_UP_DIR', ANG_PRO_PATH . 'modules/unsplash/' );
define( 'ANG_UP_URL', ANG_PRO_URL . 'modules/unsplash/' );
$upload_dir = wp_upload_dir();
define( 'ANG_UP_UPLOAD_PATH', $upload_dir['basedir'] . '/ang-up' );
define( 'ANG_UP_UPLOAD_URL', $upload_dir['baseurl'] . '/ang-up/' );
define( 'ANG_UP_KEY', 'dc4bc16186cf59e7a7a8e56580d3619bf37c0ecc586c9d7532a390532f6f8694' );


/**
 * Main ANG_Unsplash Class.
 */
class Unsplash {
	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Setup instance attributes
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		$this->plugin_version = ANG_UP_VERSION;
		add_action( 'init', array( $this, 'settings' ), 45 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Unsplash ) ) {
			self::$instance = new Unsplash();
			self::$instance->includes();
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {
		$unsplash_active = Options::get_instance()->get( 'ang_unsplash' );
		if ( $unsplash_active ) {
			require_once ANG_UP_DIR . 'includes/endpoint/base.php';
			require_once ANG_UP_DIR . 'includes/core/api/remote.php';
			require_once ANG_UP_DIR . 'includes/core/init.php';
		}
	}

	/**
	 * Include Settings Files.
	 *
	 * @return void
	 */
	public function settings() {
		require_once ANG_UP_DIR . 'includes/core/settings.php';
	}
}

Unsplash::get_instance();
