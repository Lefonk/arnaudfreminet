<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link        https://posimyth.com/
 * @since       5.5.3
 *
 * @package    ThePlus
 */

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Wp_Login_Register' ) ) {

	/**
	 * It is Tp_Wp_Login_Register Main Class
	 *
	 * @since 5.5.3
	 */
	class Tp_Wp_Login_Register {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Google Api Variable
		 *
		 * @var google_api
		 */
		private $google_api = 'https://oauth2.googleapis.com/tokeninfo?id_token=';

		/**
		 * Animations Variable
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
		 * @since 5.5.3
		 */
		public function __construct() {

			add_action( 'wp_ajax_nopriv_theplus_google_ajax_register', array( $this, 'theplus_google_ajax_register' ) );
			add_action( 'wp_ajax_theplus_google_ajax_register', array( $this, 'theplus_google_ajax_register' ) );
		}

		/**
		 * Verigy google data of user.
		 *
		 * @since 5.5.3
		 *
		 * @param string $token     The value for the token parameter.
		 * @param string $client_id     The value for the client_id parameter.
		 */
		public function tp_verify_google_data_user( $token, $client_id ) {
			require_once THEPLUS_INCLUDES_URL . 'vendor/autoload.php';

			$client_data = new \Google_Client( array( 'client_id' => $client_id ) );

			$verified = $client_data->verifyIdToken( $token );

			if ( $verified ) {
				return $verified;
			} else {
				echo wp_json_encode(
					array(
						'loggedin' => false,
						'message'  => esc_html__( 'Unauthorized access', 'theplus' ),
					)
				);
				wp_die();
			}
		}

		/**
		 * Google Ajax register.
		 *
		 * @since 5.5.3
		 */
		public function theplus_google_ajax_register() {

			$post_security = ! empty( $_POST['security'] ) ? sanitize_text_field( wp_unslash( $_POST['security'] ) ) : '';

			if ( ! isset( $post_security ) || empty( $post_security ) || ! wp_verify_nonce( $post_security, 'ajax-login-nonce' ) ) {
				die( 'Security checked!' );
			}

			/**Security checked wp nonce */
			check_ajax_referer( 'ajax-login-nonce', 'security' );

			$credential  = '';
			$guclient_id = '';

			if ( isset( $_POST['googleCre'] ) && ! empty( $_POST['googleCre'] ) ) {
				$credential = sanitize_text_field( wp_unslash( $_POST['googleCre'] ) );
			} else {
				echo wp_json_encode(
					array(
						'login'   => false,
						'message' => esc_html__( 'Unauthorized access', 'theplus' ),
					)
				);
				wp_die();
			}

			if ( isset( $_POST['clientId'] ) && ! empty( $_POST['clientId'] ) ) {
				$guclient_id = sanitize_text_field( wp_unslash( $_POST['clientId'] ) );
			} else {
				echo wp_json_encode(
					array(
						'login'   => false,
						'message' => esc_html__( 'clientId Not Set', 'theplus' ),
					)
				);
				wp_die();
			}

			$verified = $this->tp_verify_google_data_user( $credential, $guclient_id );

			if ( empty( $verified ) ) {
				echo wp_json_encode(
					array(
						'login'   => false,
						'message' => esc_html__( 'User not verified by Google', 'theplus' ),
					)
				);

				wp_die();
			}

			if ( ! empty( $verified ) && isset( $verified['aud'] ) && ! empty( $verified['aud'] ) && $verified['aud'] === $guclient_id ) {

				$url = wp_remote_post(
					$this->google_api . $credential,
					array(
						'headers' => array(
							'Content-Type' => 'application/json',
						),
					)
				);

				$status_code  = wp_remote_retrieve_response_code( $url );
				$get_data_one = wp_remote_retrieve_body( $url );

				$response = json_decode( $get_data_one, true );

				if ( isset( $response->error ) ) {
					echo wp_json_encode(
						array(
							'login'   => false,
							'message' => $response->error_description,
						)
					);
				} else {
					tp_login_social_app( $response['name'], $response['email'], 'google' );
				}

				wp_die();
			}
		}
	}

	return Tp_Wp_Login_Register::get_instance();
}
