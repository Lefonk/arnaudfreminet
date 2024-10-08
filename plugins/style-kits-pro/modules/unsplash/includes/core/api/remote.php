<?php
/**
 * Analog-Unsplash-Photos
 *
 * @package   Analog Unsplash
 * @author    Analog
 * @license   GPL-3.0
 * @link      https://analogwp.com
 * @copyright 2017 Analog (Pty) Ltd
 */

namespace Analog\Modules\Unsplash\Core\Api;

use Analog\Options;

/**
 * Handle Remote API requests.
 *
 * @subpackage Analog-Unsplash-Photos
 */
class Remote {
	const TRANSIENT_KEY = 'ang_unsplash_photos_';
	const ENDPOINT      = 'https://api.unsplash.com';

	/**
	 * Collections key..
	 *
	 * @var string
	 */
	public static $collections_key = '';
	/**
	 * Common API call args.
	 *
	 * @var array
	 */
	public static $api_call_args = array();

	/**
	 * Access key for Unsplash API.
	 *
	 * @var string
	 */
	public static $access_key = ANG_UP_KEY;

	/**
	 * Default username for Unsplash data.
	 *
	 * @var string
	 */
	public static $unsplash_username = 'analogwp';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'ang_unsplash_loaded_photos', array( $this, 'set_loaded_photos' ) );
		self::$api_call_args = array(
			'theme_version' => '1.0',
			'url'           => home_url(),
		);

		$default_username = Options::get_instance()->get( 'ang_default_username' );
		if ( $default_username ) {
			self::$unsplash_username = $default_username;
		}
		self::$collections_key = self::TRANSIENT_KEY . self::$unsplash_username;
	}

	/**
	 * Get REST Request Endpoint.
	 *
	 * @return string
	 */
	private static function get_request_endpoint() {
		$api_key = Options::get_instance()->get( 'ang_unsplash_key' );
		if ( $api_key ) {
			self::$access_key = $api_key;
		}

		$data_endpoint = add_query_arg(
			array( 'client_id' => self::$access_key ),
			self::ENDPOINT . '/users/' . self::$unsplash_username . '/collections'
		);
		return $data_endpoint;
	}

	/**
	 * Retrieve photos and save as a transient.
	 *
	 * @param boolean $force_update Force new info from remote API.
	 * @return void
	 */
	public static function set_loaded_photos( $force_update = false ) {
		$transient = get_transient( self::$collections_key );
		if ( ! $transient || $force_update ) {
			$info = self::request_remote_photos();
			if ( ! empty( $info ) ) {
				set_transient( self::$collections_key, $info, WEEK_IN_SECONDS );
			}
		}
	}
	/**
	 * Get loaded photos.
	 *
	 * @param boolean $force_update Force new info from remote API.
	 *
	 * @return array
	 */
	public static function get_loaded_photos( $force_update = false ) {
		if ( ! get_transient( self::$collections_key ) || $force_update ) {
			self::set_loaded_photos( $force_update );
		}
		return get_transient( self::$collections_key );
	}
	/**
	 * Fetch remote photos info.
	 *
	 * @return array $response Unsplash photos.
	 */
	public static function request_remote_photos() {
		global $wp_version;
		$body_args = apply_filters( 'ang_unsplash_photos/api/get_unsplash_photos/body_args', self::$api_call_args ); // @codingStandardsIgnoreLine
		$data_endpoint = self::get_request_endpoint();
		$response_code = wp_remote_retrieve_response_code( wp_remote_get( $data_endpoint ) );
		if ( 200 === $response_code ) {
			$request  = wp_remote_get(
				$data_endpoint,
				array(
					'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url(),
					'body'       => $body_args,
				)
			);
			$response = json_decode( wp_remote_retrieve_body( $request ), true );
		} else {
			$response = false;
		}

		if ( ! $response ) {
			$response = array();
		}
		return $response;
	}
}

new Remote();
