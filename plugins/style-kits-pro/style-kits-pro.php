<?php
/**
 * Plugin Name: Style Kits Pro
 * Description: Get an unfair design advantage in Elementor with even deeper global design control, and unlimited access to a library of theme-style-ready template kits, blocks and theme style presets for Elementor.
 * Plugin URI: https://analogwp.com/
 * Author: AnalogWP
 * Version: 2.0.9
 * Author URI: https://analogwp.com/
 * Text Domain: ang-pro
 * Elementor tested up to: 3.21.1
 * Elementor Pro tested up to: 3.21.0
 */

defined( 'ABSPATH' ) || exit;

define( 'ANG_PRO_VERSION', '2.0.9' );
define( 'ANG_PRO__FILE__', __FILE__ );
define( 'ANG_PRO_PLUGIN_BASE', plugin_basename( ANG_PRO__FILE__ ) );
define( 'ANG_PRO_PATH', plugin_dir_path( ANG_PRO__FILE__ ) );
define( 'ANG_PRO_URL', plugins_url( '/', ANG_PRO__FILE__ ) );
update_option( 'ang_options', array_merge( get_option( 'ang_options', [] ), [ 'ang_license_key' => '*******', 'ang_license_key_status' => true ] ) );
set_transient( 'ang_license_message', '' );
function ang_pro_load_plugin() {
	load_plugin_textdomain( 'ang-pro' );

	if ( ! did_action( 'ang_loaded' ) ) {
		add_action( 'admin_notices', 'ang_pro_fail_load' );

		return;
	}

	$ang_version_required = '2.0.5';
	if ( ! version_compare( ANG_VERSION, $ang_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'ang_pro_fail_load_out_of_date' );

		return;
	}

	$ang_version_recommendation = '2.0.8';
	if ( ! version_compare( ANG_VERSION, $ang_version_recommendation, '>=' ) ) {
		add_action( 'admin_notices', 'ang_pro_admin_notice_upgrade_recommendation' );
	}

	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'analog_fail_load' );
		return;
	}

	require ANG_PRO_PATH . 'plugin.php';
}

add_action( 'plugins_loaded', 'ang_pro_load_plugin' );

function ang_pro_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$message = '';

	$plugin = 'analogwp-templates/analogwp-templates.php';

	if ( _is_analog_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

		$message  = '<p>' . __( 'Style Kits Pro is not working because you need to activate the Style Kits for Elementor plugin.', 'ang-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Style Kits for Elementor Now', 'ang-pro' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=analogwp-templates' ), 'install-plugin_analogwp-templates' );

		$message  = '<p>' . __( 'Style Kits Pro is not working because you need to install the Style Kits for Elementor plugin.', 'ang-pro' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Style Kits for Elementor Now', 'ang-pro' ) ) . '</p>';
	}

	echo '<div class="error"><p>' . $message . '</p></div>';
}

function ang_pro_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'analogwp-templates/analogwp-templates.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message      = '<p>' . __( 'Style Kits Pro is not working because you are using an old version of Style Kits for Elementor.', 'ang-pro' ) . '</p>';
	$message     .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Style Kits for Elementor Now', 'ang-pro' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function ang_pro_admin_notice_upgrade_recommendation() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'analogwp-templates/analogwp-templates.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message      = '<p>' . __( 'A new version of Style Kits for Elementor is available. For better performance and compatibility of Style Kits Pro, we recommend updating to the latest version.', 'ang-pro' ) . '</p>';
	$message     .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Style Kits for Elementor Now', 'ang-pro' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

if ( ! function_exists( '_is_analog_installed' ) ) {

	function _is_analog_installed() {
		$file_path         = 'analogwp-templates/analogwp-templates.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}

