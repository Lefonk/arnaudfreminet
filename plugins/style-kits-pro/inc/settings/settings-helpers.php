<?php
/**
 * Settings helpers.
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

use Analog\Options;
use Elementor\Rollback;

/**
 * Enqueue Scripts.
 */
function enqueue_scripts() {
	wp_enqueue_script( 'ang_pro_settings', ANG_PRO_URL . 'assets/js/admin-settings.js', array( 'jquery', 'wp-i18n', 'wp-api-fetch' ), filemtime( ANG_PRO_PATH . 'assets/js/admin-settings.js' ), true );

	wp_localize_script(
		'ang_pro_settings',
		'ang_pro_settings_data',
		array(
			'rollback_url' => wp_nonce_url( admin_url( 'admin-post.php?action=ang_pro_rollback&version=VERSION' ), 'ang_pro_rollback' ),
		)
	);
}
add_action( 'ang_settings_start', 'AnalogPRO\Settings\enqueue_scripts' );

/**
 * Get valid rollback versions.
 *
 * @param bool $force  Force recheck.
 * @return array|mixed
 */
function get_rollback_versions( $force = false ) {
	$key = 'ang_pro_rollback_versions_' . ANG_PRO_VERSION;

	$rollback_versions = get_transient( $key );

	if ( false === $rollback_versions || $force ) {
		$response = wp_remote_get( 'https://analogwp.com/wp-json/analogwp/v1/pro' );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		} else {
			$plugin_information = json_decode( wp_remote_retrieve_body( $response ), true );
			$versions           = $plugin_information['versions'];
			$max_versions       = 30;

			if ( empty( $versions ) || ! is_array( $versions ) ) {
				return array();
			}

			krsort( $versions, SORT_NATURAL );

			$rollback_versions = array();
			$current_index     = 0;

			foreach ( $versions as $key => $version ) {
				if ( $max_versions <= $current_index ) {
					break;
				}

				if ( preg_match( '/(trunk|beta|rc)/i', strtolower( $version ) ) ) {
					continue;
				}

				if ( version_compare( ANG_PRO_VERSION, $version, '<=' ) ) {
					continue;
				}

				$current_index++;
				$rollback_versions[] = $version;
			}

			set_transient( $key, $rollback_versions, WEEK_IN_SECONDS );
		}
	}
	return $rollback_versions;
}

/**
 * Rollback Style Kits Pro version.
 *
 * @return void
 */
function post_ang_pro_rollback() {
	check_admin_referer( 'ang_pro_rollback' );

	if ( ! current_user_can( 'update_plugins' ) ) {
		wp_die( esc_html__( 'Sorry, you are not allowed to rollback Style Kits Pro plugin for this site.', 'ang-pro' ) );
	}

	$version           = isset( $_GET['version'] ) ? wp_unslash( $_GET['version'] ) : '';
	$rollback_versions = get_rollback_versions();
	if ( empty( $version ) || ! in_array( $version, $rollback_versions, true ) ) {
		wp_die( esc_html__( 'Error occurred, the version selected is invalid. Try selecting different version.', 'ang-pro' ) );
	}

	$license = trim( Options::get_instance()->get( 'ang_license_key' ) );
	if ( empty( $license ) ) {
		wp_die( esc_html__( 'Error occurred! Please set a license key first.', 'ang-pro' ) );
	}

	$url          = home_url();
	$rollback_url = esc_url_raw(
		add_query_arg(
			array(
				'version' => $version,
				'license' => $license,
				'url'     => $url,
			),
			'https://analogwp.com/wp-json/analogwp/v1/pro/rollback'
		)
	);

	?>
	<style>
		.wrap h1 {
			position: relative;
			padding-top: 140px !important;
		}
		.wrap h1:before {
			content: '';
			position: absolute;
			width: 300px;
			height: 65px;
			color: #fff;
			top: 40px;
			background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 116 24' fill='white' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M65.3219 12.0481C65.3219 15.7023 62.3543 18.6647 58.6935 18.6647C55.0328 18.6647 52.0652 15.7023 52.0652 12.0481C52.0652 8.39391 55.0328 5.43158 58.6935 5.43158C62.3543 5.43158 65.3219 8.39391 65.3219 12.0481Z' %3E%3C/path%3E%3Cpath d='M9.59184 6.29053V7.70526C8.75667 6.51789 7.16224 6.01263 5.7956 6.01263C2.7586 6.01263 0 8.36211 0 12.1516C0 15.9411 2.7586 18.2905 5.7956 18.2905C7.11163 18.2905 8.75667 17.76 9.59184 16.5979V18.0632H12.9072V6.29053H9.59184ZM6.4283 15.2084C4.75796 15.2084 3.366 13.8695 3.366 12.1516C3.366 10.4084 4.75796 9.12 6.4283 9.12C7.97211 9.12 9.49061 10.3326 9.49061 12.1516C9.49061 13.9453 8.04803 15.2084 6.4283 15.2084Z' %3E%3C/path%3E%3Cpath d='M23.113 5.98737C21.9488 5.98737 20.076 6.66947 19.5698 8.26105V6.29053H16.2544V18.0632H19.5698V12.0253C19.5698 9.87789 21.0377 9.24632 22.2272 9.24632C23.3661 9.24632 24.4796 10.08 24.4796 11.9495V18.0632H27.795V11.5958C27.8203 8.05895 26.2006 5.98737 23.113 5.98737Z' %3E%3C/path%3E%3Cpath d='M39.8679 6.29053V7.70526C39.0327 6.51789 37.4383 6.01263 36.0716 6.01263C33.0346 6.01263 30.276 8.36211 30.276 12.1516C30.276 15.9411 33.0346 18.2905 36.0716 18.2905C37.3876 18.2905 39.0327 17.76 39.8679 16.5979V18.0632H43.1832V6.29053H39.8679ZM36.7043 15.2084C35.034 15.2084 33.642 13.8695 33.642 12.1516C33.642 10.4084 35.034 9.12 36.7043 9.12C38.2481 9.12 39.7666 10.3326 39.7666 12.1516C39.7666 13.9453 38.3241 15.2084 36.7043 15.2084Z' %3E%3C/path%3E%3Cpath d='M46.5305 18.0632H49.8458V0H46.5305V18.0632Z' %3E%3C/path%3E%3Cpath d='M58.7973 18.2905C62.1633 18.2905 65.1496 15.8653 65.1496 12.1516C65.1496 8.41263 62.1633 5.98737 58.7973 5.98737C55.4313 5.98737 52.4449 8.41263 52.4449 12.1516C52.4449 15.8653 55.4313 18.2905 58.7973 18.2905ZM58.7973 15.2084C57.1522 15.2084 55.8109 13.9705 55.8109 12.1516C55.8109 10.3074 57.1522 9.06947 58.7973 9.06947C60.4423 9.06947 61.7836 10.3074 61.7836 12.1516C61.7836 13.9705 60.4423 15.2084 58.7973 15.2084Z' %3E%3C/path%3E%3Cpath d='M76.644 6.29053V7.68C75.7835 6.54316 74.189 6.01263 72.8477 6.01263C69.8107 6.01263 67.0521 8.36211 67.0521 12.1516C67.0521 15.9411 69.8107 18.2905 72.8477 18.2905C74.1637 18.2905 75.7835 17.76 76.644 16.6232V16.8C76.644 19.8821 75.3026 21.0442 73.1767 21.0442C71.9113 21.0442 70.6965 20.2863 70.1903 19.2253L67.4317 20.4126C68.4441 22.5853 70.6459 24 73.1767 24C77.3526 24 79.9593 21.6 79.9593 16.4463V6.29053H76.644ZM73.4804 15.2084C71.8101 15.2084 70.4181 13.8695 70.4181 12.1516C70.4181 10.4084 71.8101 9.12 73.4804 9.12C75.0242 9.12 76.5427 10.3326 76.5427 12.1516C76.5427 13.9453 75.1001 15.2084 73.4804 15.2084Z' %3E%3C/path%3E%3Cpath d='M97.6574 6.29053L95.4303 13.4653L93.1779 6.29053H90.3939L88.1415 13.4653L85.9144 6.29053H82.3206L86.623 18.0632H89.4575L91.8112 10.4084L94.2408 18.0632H97.0753L101.251 6.29053H97.6574Z' %3E%3C/path%3E%3Cpath d='M110.204 5.98737C108.863 5.98737 107.243 6.51789 106.408 7.70526V6.29053H103.093V23.8484H106.408V16.5979C107.243 17.7853 108.863 18.2905 110.204 18.2905C113.241 18.2905 116 15.9411 116 12.1516C116 8.36211 113.241 5.98737 110.204 5.98737ZM109.572 15.1832C108.028 15.1832 106.509 13.9705 106.509 12.1516C106.509 10.3579 107.952 9.09474 109.572 9.09474C111.242 9.09474 112.609 10.4337 112.609 12.1516C112.609 13.8947 111.242 15.1832 109.572 15.1832Z' %3E%3C/path%3E%3C/svg%3E");
			background-repeat: no-repeat;
			transform: translate(50%);
		}
		.wrap img {
			display: none;
		}
	</style>
	<?php
	$plugin_slug = 'style-kits-pro';
	$plugin_name = 'style-kits-pro/style-kits-pro.php';
	$rollback    = new Rollback(
		array(
			'version'     => $version,
			'plugin_name' => $plugin_name,
			'plugin_slug' => $plugin_slug,
			'package_url' => $rollback_url,
		)
	);
	$rollback->run();
	wp_die(
		'',
		esc_html__( 'Rollback to Previous Version', 'ang-pro' ),
		array(
			'response' => 200,
		)
	);
}
add_action( 'admin_post_ang_pro_rollback', 'AnalogPRO\Settings\post_ang_pro_rollback' );


/**
 * Get Current User Roles.
 *
 * @return array
 * @since 1.0.3
 */
function get_user_roles() {
	if ( ! function_exists( 'get_editable_roles' ) ) {
		require_once ABSPATH . 'wp-admin/includes/user.php';
	}
	$roles = array();
	foreach ( \get_editable_roles() as $role_slug => $role_data ) {
		$roles[ $role_slug ] = $role_data['name'];
	}
	return $roles;
}

/**
 * Adds pro license data to the starterkits API request.
 *
 * @param array $api_args  API arguments.
 *
 * @return array
 * @since 2.0.3
 */
function add_pro_starterkits( $api_args ) {
	$api_args = array_merge(
		$api_args,
		array(
			'license' => Options::get_instance()->get( 'ang_license_key' ),
			'url'     => home_url(),
		)
	);

	return $api_args;
}

add_filter( 'analog/api/get_starterkits/body_args', 'AnalogPRO\Settings\add_pro_starterkits' );
