<?php

namespace AnalogPRO;

use Analog\Options;

/**
 * Main Class Plugin,
 *
 * @package AnalogPRO
 */
class Plugin {
	/**
	 * Plugin instance.
	 *
	 * @var Plugin
	 */
	private static $instance;

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'ang-pro' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'ang-pro' ), '1.0.0' );
	}

	/**
	 * AnalogWP Templates instance;
	 *
	 * @return \Analog\Analog_Templates
	 */
	public static function analog() {
		return \Analog\Analog_Templates::instance();
	}

	/**
	 * Plugin instance.
	 *
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		self::$instance->includes();
		return self::$instance;
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		if ( ! class_exists( $class ) ) {
			$filename = strtolower(
				preg_replace(
					array( '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '', '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$class
				)
			);
			$filename = ANG_PRO_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include $filename;
			}
		}
	}

	/**
	 * Plugin Hooks.
	 */
	private function setup_hooks() {
		add_action( 'init', array( $this, 'admin_includes' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_editor_scripts' ) );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_editor_scripts' ) );
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ), 10 );
	}

	/**
	 * Plugin constructor.
	 */
	private function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );
		$this->setup_hooks();
	}

	/**
	 * Include Required Files.
	 *
	 * @return void
	 */
	public function includes() {
		require_once ANG_PRO_PATH . 'inc/elementor/sections/global-colors.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/global-fonts.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/global-form.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/global-shadows.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/background-color-classes.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/shortcuts.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/page-tools.php';
		require_once ANG_PRO_PATH . 'inc/elementor/sections/custom-container-spacing.php';

		require_once ANG_PRO_PATH . 'inc/elementor/Elementor.php';

		/**
		 * Modules.
		 */
		require_once ANG_PRO_PATH . 'modules/unsplash/Unsplash.php';
	}

	/**
	 * Admin includes.
	 */
	public function admin_includes() {
		if ( ! is_admin() ) {
			return false;
		}

		if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			// load our custom updater if it doesn't already exist.
			require_once ANG_PRO_PATH . 'inc/updater/EDD_SL_Plugin_Updater.php';
		}
		require_once ANG_PRO_PATH . 'inc/settings/settings-helpers.php';
		require_once ANG_PRO_PATH . 'inc/class-licensemanager.php';
		require_once ANG_PRO_PATH . 'inc/settings/role-manager.php';
		require_once ANG_PRO_PATH . 'inc/settings/license.php';
		require_once ANG_PRO_PATH . 'inc/settings/version-control.php';
		require_once ANG_PRO_PATH . 'inc/settings/manage-sk-panels.php';
		require_once ANG_PRO_PATH . 'inc/settings/experiments.php';

		$this->setup_updater();
	}

	/**
	 * Enqueue Elementor CSS.
	 */
	public function enqueue_editor_scripts() {
		wp_enqueue_style( 'ang-pro-elementor', ANG_PRO_URL . 'assets/css/elementor.css', array( 'dashicons' ), filemtime( ANG_PRO_PATH . 'assets/css/elementor.css' ) );
	}

	/**
	 * Enqueue Admin Scripts.
	 *
	 * @param string $hook Current page hook.
	 */
	public function admin_scripts( $hook ) {
		$license_status = Options::get_instance()->get( 'ang_license_key_status' );

		$allowed = array(
			'toplevel_page_analogwp_templates',
			'style-kits_page_ang-settings',
		);

		if ( ! in_array( $hook, $allowed, true ) || 'valid' !== $license_status ) {
			return;
		}

		$helpscout = '!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});';
		wp_add_inline_script( 'jquery', $helpscout );
		wp_add_inline_script( 'jquery', "window.Beacon('init', 'a7572e82-da95-4f09-880e-5c1f071aaf07')" );

		$pro_version  = ANG_PRO_VERSION;
		$free_version = ANG_VERSION;
		$url          = home_url();
		$license      = Options::get_instance()->get( 'ang_license_key' );

		$current_user = wp_get_current_user();
		global $wp_version;

		$identify_customer = "Beacon('identify', {
			name: '{$current_user->display_name}',
			email: '{$current_user->user_email}',
			'Website': '{$url}',
			'SK Pro Version': '{$pro_version}',
			'SK Free Version': '{$free_version}',
			'WP Version': '{$wp_version}',
			'License Key': '{$license}',
			'License Status': '{$license_status}',
		});
		Beacon('prefill', {
			name: '{$current_user->display_name}',
			email: '{$current_user->user_email}',
		});";

		wp_add_inline_script( 'jquery', $identify_customer );
	}

	/**
	 * Setup plugin updater.
	 *
	 * @return void
	 */
	public function setup_updater() {
		$license     = new LicenseManager();
		$item_id     = $license->get_product_meta( 'id' );
		$store_url   = $license->get_product_meta( 'url' );
		$license_key = trim( Options::get_instance()->get( 'ang_license_key' ) );
		$beta        = Options::get_instance()->get( 'beta_tester' );

		new \EDD_SL_Plugin_Updater(
			$store_url,
			ANG_PRO__FILE__,
			array(
				'version' => ANG_PRO_VERSION,
				'license' => $license_key,
				'item_id' => $item_id,
				'author'  => 'AnalogWP',
				'beta'    => $beta,
			)
		);
	}

	/**
	 * Register Elementor widgets.
	 *
	 * @return void
	 */
	public function register_widgets() {
		$base_path = ANG_PRO_PATH . 'inc/elementor/widgets/';

		$widgets = array(
			'AnalogPro\Elementor\Widget\Kit_Switcher' => $base_path . '/kit-switcher/kit-switcher.php',
		);

		foreach ( $widgets as $widget => $file ) {
			require $file;
			$instance = new $widget();
			\Elementor\Plugin::$instance->widgets_manager->register( $instance );
		}
	}

	/**
	 * Returns plugin title.
	 *
	 * @return string
	 */
	final public static function get_title() {
		return __( 'Style Kits Pro', 'ang-pro' );
	}
}

Plugin::instance();
