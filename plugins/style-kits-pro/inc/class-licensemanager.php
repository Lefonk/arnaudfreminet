<?php
/**
 * License manager.
 *
 * @package AnalogWP
 */

namespace AnalogPro;

use Analog\Base;
use Analog\Options;

/**
 * Class for License management.
 */
class LicenseManager extends Base {
	const TRANSIENT_LICENSE_LIMIT = 'analog_license_limit';

	/**
	 * Remote API URL to send requests against.
	 * Requires a trailing slash at the end.
	 *
	 * @var string
	 */
	protected static $remote_api_url = 'https://analogwp.com/';

	/**
	 * Settings slug to save license key.
	 *
	 * @var string
	 */
	protected $license_slug = 'ang_license_key';

	/**
	 * AnalogWP Pro download id from AnalogWP.com
	 *
	 * @var integer
	 */
	protected $item_id = 495;

	/**
	 * AnalogWP Pro download id from AnalogWP.com
	 *
	 * @var integer
	 */
	protected $download_id = 495;

	/**
	 * Holds translatable strings throughout the class.
	 * Used for error displays in API calls.
	 *
	 * @var integer
	 */
	protected $strings = null;

	/**
	 * Hold license renewal link.
	 *
	 * @var string|bool
	 */
	protected $renew_url = null;

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		$strings = array(
			'plugin-license'            => __( 'Plugin License', 'ang-pro' ),
			'enter-key'                 => __(
				'Enter your plugin license key received upon purchase from <a target="_blank" href="https://analogwp.com/account/">AnalogWP</a>.',
				'ang-pro'
			),
			'license-key'               => __( 'License Key', 'ang-pro' ),
			'license-action'            => __( 'License Action', 'ang-pro' ),
			'deactivate-license'        => __( 'Deactivate License', 'ang-pro' ),
			'activate-license'          => __( 'Activate License', 'ang-pro' ),
			'status-unknown'            => __( 'License status is unknown.', 'ang-pro' ),
			'renew'                     => __( 'Renew', 'ang-pro' ),
			'unlimited'                 => __( 'unlimited', 'ang-pro' ),
			'license-key-is-active'     => __( 'License key is active.', 'ang-pro' ),
			/* translators: %s: expiration date */
			'expires%s'                 => __( 'Expires %s.', 'ang-pro' ),
			'expires-never'             => __( 'Lifetime License.', 'ang-pro' ),
			/* translators: %1$s: active sites, %2$s: sites limit */
			'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'ang-pro' ),
			/* translators: %s: product name */
			'license-key-expired-%s'    => __( 'License key expired %s.', 'ang-pro' ),
			'license-key-expired'       => __( 'License key has expired.', 'ang-pro' ),
			'license-keys-do-not-match' => __(
				'License keys do not match. <br> Enter your plugin license key received upon purchase from <a target="_blank" href="https://analogwp.com/account/">AnalogWP</a>.',
				'ang-pro'
			),
			'license-is-inactive'       => __( 'License is inactive.', 'ang-pro' ),
			'license-key-is-disabled'   => __( 'License key is disabled.', 'ang-pro' ),
			'site-is-inactive'          => __( 'Site is inactive.', 'ang-pro' ),
			'license-status-unknown'    => __( 'License status is unknown.', 'ang-pro' ),
		);

		$this->strings = $strings;

		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
		add_action( 'admin_init', array( $this, 'get_license_message' ), 10, 2 );
	}

	/**
	 * Register license management endpoints.
	 *
	 * @return void
	 */
	public function register_endpoints() {
		register_rest_route(
			'agwp/v1',
			'/license',
			array(
				'methods'             => \WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'handle_license_request' ),
				'permission_callback' => function() {
					return current_user_can( 'manage_options' );
				},
			)
		);

		register_rest_route(
			'agwp/v1',
			'/license/status',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_license_message' ),
				'permission_callback' => function() {
					return current_user_can( 'manage_options' );
				},
			)
		);
	}

	/**
	 * Handles licenses requests:
	 * - check_license
	 * - activate_license
	 * - deactivate_license
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return \WP_REST_Response|\WP_Error
	 */
	public function handle_license_request( \WP_REST_Request $request ) {
		$action = $request->get_param( 'action' );

		if ( ! $action ) {
			return new \WP_Error( 'license_error', 'No license action defined.' );
		}

		$data = '';

		if ( 'check' === $action ) {
			$data = $this->check_license();
		} elseif ( 'activate' === $action ) {
			$data = $this->activate_license();
		} elseif ( 'deactivate' === $action ) {
			$data = $this->deactivate_license();
		}

		return new \WP_REST_Response( $data, 200 );
	}

	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	public function get_api_response( $api_params ) {

		$response = wp_remote_post(
			self::$remote_api_url,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			wp_die( $response->get_error_message(), __( 'Error', 'ang-pro' ) . $response->get_error_code() ); // @codingStandardsIgnoreLine
		}

		return $response;
	}

	/**
	 * Constructs a renewal link
	 */
	public function get_renewal_link() {
		// If a renewal link was passed in the config, use that.
		if ( null !== $this->renew_url ) {
			return $this->renew_url;
		}

		// If download_id was passed in the config, a renewal link can be constructed.
		$license_key = Options::get_instance()->get( $this->license_slug );
		if ( '' !== $this->download_id && $license_key ) {
			$url  = esc_url( self::$remote_api_url );
			$url .= 'checkout/?edd_license_key=' . $license_key . '&download_id=' . $this->download_id;
			return $url;
		}

		// Otherwise return the remote_api_url.
		return self::$remote_api_url;
	}

	/**
	 * Get latest version of plugin.
	 *
	 * @param bool $force Force check.
	 * @return string
	 */
	public static function get_latest_version( $force = false ) {
		$transient = 'analog_pro_latest_version';
		$version   = get_transient( $transient );

		if ( ! $version || $force ) {
			$api_remote = self::$remote_api_url . 'wp-json/analogwp/v1/pro';

			$response = wp_remote_get( $api_remote );

			// Make sure the response came back okay.
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				return false;
			} else {
				$data    = json_decode( wp_remote_retrieve_body( $response ) );
				$version = $data->info->new_version;
				set_transient( $transient, $version, DAY_IN_SECONDS );
			}
		}

		return get_transient( $transient );
	}

	/**
	 * Checks if an update is available.
	 *
	 * @param bool $force Force check.
	 * @return bool
	 */
	public static function is_update_available( $force = false ) {
		$latest_version = self::get_latest_version( $force );

		if ( $latest_version && version_compare( ANG_PRO_VERSION, $latest_version, '<' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @param string $license License key param (Optional).
	 * @return string $message License status message.
	 */
	public function check_license( $license = '' ) {
		return false;
		if ( '' === $license ) {
			$license = trim( Options::get_instance()->get( $this->license_slug ) );
		}

		if ( ! $license ) {
			return false;
		}

		$strings = $this->strings;

		$this->check_memory_limit();

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_id'    => $this->item_id,
			'url'        => home_url(),
		);

		$response = $this->get_api_response( $api_params );

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = $strings['license-status-unknown'];
			}
		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! isset( $license_data->license ) ) {
				$message = $strings['license-status-unknown'];
				return $message;
			}

			// We need to update the license status at the same time the message is updated.
			if ( $license_data && isset( $license_data->license ) ) {
				Options::get_instance()->set( 'ang_license_key_status', $license_data->license );
			}

			// Get expire date.
			$expires = false;
			if ( isset( $license_data->expires ) && 'lifetime' !== $license_data->expires ) {
				$expires    = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
				$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $strings['renew'] . '</a>';
			} elseif ( isset( $license_data->expires ) && 'lifetime' === $license_data->expires ) {
				$expires = 'lifetime';
			}

			// Get site counts.
			$site_count = '';
			if ( isset( $license_data->site_count ) ) {
				$site_count = $license_data->site_count;
			}

			// Get license limit.
			$license_limit = '';
			if ( isset( $license_data->license_limit ) ) {
				$license_limit = $license_data->license_limit;
			}

			// If unlimited.
			if ( 0 === $license_limit ) {
				$license_limit = $strings['unlimited'];
			}

			if ( 'valid' === $license_data->license ) {
				$message = $strings['license-key-is-active'] . ' ';
				if ( isset( $expires ) && 'lifetime' !== $expires ) {
					$message .= sprintf( $strings['expires%s'], $expires ) . ' ';
				}
				if ( isset( $expires ) && 'lifetime' === $expires ) {
					$message .= $strings['expires-never'] . ' ';
				}
				if ( $site_count && $license_limit ) {
					$message .= sprintf( $strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}
			} elseif ( 'expired' === $license_data->license ) {
				if ( $expires ) {
					$message = sprintf( $strings['license-key-expired-%s'], $expires );
				} else {
					$message = $strings['license-key-expired'];
				}
				if ( $renew_link ) {
					$message .= ' ' . $renew_link;
				}
			} elseif ( 'invalid' === $license_data->license ) {
				$message = $strings['license-keys-do-not-match'];
			} elseif ( 'inactive' === $license_data->license ) {
				$message = $strings['license-is-inactive'];
			} elseif ( 'disabled' === $license_data->license ) {
				$message = $strings['license-key-is-disabled'];
			} elseif ( 'site_inactive' === $license_data->license ) {
				// Site is inactive.
				$message = $strings['site-is-inactive'];
			} else {
				$message = $strings['license-status-unknown'];
			}
		}

		return $message;
	}

	/**
	 * Activates the license key.
	 *
	 * @param string $license License key param (Optional).
	 * @return array|mixed
	 */
	public function activate_license( $license = '' ) {
		if ( '' === $license ) {
			$license = trim( Options::get_instance()->get( $this->license_slug ) );
		};

		$message = '';

		$this->check_memory_limit();

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_id'    => $this->item_id,
			'url'        => home_url(),
		);

		$response     = $this->get_api_response( $api_params );
		$license_data = '';

		// make sure the response came back okay.
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.', 'ang-pro' );
			}
		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// We need to update the license status at the same time the message is updated.
			if ( $license_data && isset( $license_data->license ) ) {
				Options::get_instance()->set( 'ang_license_key_status', $license_data->license );
			}

			if ( false === $license_data->success ) {
				switch ( $license_data->error ) {
					case 'expired':
						$message = sprintf(
							/* translators: %s: expiration date */
							__( 'Your license key expired on %s.', 'ang-pro' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked':
						$message = __( 'Your license key has been disabled.', 'ang-pro' );
						break;

					case 'missing':
						$message = __( 'Invalid license.', 'ang-pro' );
						break;

					case 'invalid':
					case 'site_inactive':
						$message = __( 'Your license is not active for this URL.', 'ang-pro' );
						break;

					case 'item_name_mismatch':
						/* translators: %s: site name/email */
						$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'ang-pro' ), $args['name'] );
						break;

					case 'no_activations_left':
						$message = __( 'Your license key has reached its activation limit.', 'ang-pro' );
						break;

					default:
						$message = __( 'An error occurred, please try again.', 'ang-pro' );
						break;
				}

				if ( ! empty( $message ) ) {
					return new \WP_Error( 'activation_error', $message );
				}
			}
		}

		// $response->license will be either "active" or "inactive".
		if ( $license_data && isset( $license_data->license ) ) {
			Options::get_instance()->set( 'ang_license_key_status', $license_data->license );
			delete_transient( 'ang_license_message' );
		}

		return array(
			'status'  => Options::get_instance()->get( 'ang_license_key_status' ),
			'message' => $this->get_license_message( $license ),
			'action'  => 'activate',
		);
	}

	/**
	 * Get displayable license status message.
	 *
	 * @param string $license License key param (Optional).
	 * @return string|mixed
	 */
	public function get_license_message( $license = '' ) {
		if ( ! get_transient( 'ang_license_message' ) ) {
			set_transient( 'ang_license_message', $this->check_license( $license ), DAY_IN_SECONDS );
		}

		return get_transient( 'ang_license_message' );
	}

	/**
	 * Deactivates the license key.
	 *
	 * @param string $license License key param (Optional).
	 * @return array|mixed
	 */
	public function deactivate_license( $license = '' ) {
		if ( '' === $license ) {
			$license = trim( Options::get_instance()->get( $this->license_slug ) );
		};

		$this->check_memory_limit();

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_id'    => $this->item_id,
			'url'        => home_url(),
		);

		$response = $this->get_api_response( $api_params );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.', 'ang-pro' );
			}
		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			// $license_data->license will be either "deactivated" or "failed".
			if ( $license_data ) {
				Options::get_instance()->set( 'ang_license_key_status', false );
				Options::get_instance()->set( 'ang_license_key', '' );
				delete_transient( 'ang_license_message' );
			}
		}

		if ( ! empty( $message ) ) {
			return new \WP_Error( 'deactivation_error', $message );
		}

		return array(
			'status'  => Options::get_instance()->get( 'ang_license_key_status' ),
			'message' => __( 'License Removed', 'ang-pro' ),
			'action'  => 'deactivate',
		);
	}

	/**
	 * Processes protected license message strings for use externally.
	 *
	 * @return array
	 */
	public function get_strings() {
		return $this->strings;
	}

	/**
	 * Processes protected edd product details.
	 *
	 * @param string $key Meta key value to return.
	 * @return string;
	 */
	public function get_product_meta( $key ) {
		if ( 'id' !== $key ) {
			$value = self::$remote_api_url;
		} else {
			$value = $this->item_id;
		}

		return $value;
	}

	/**
	 * Check License Site limits;
	 *
	 * @param bool $force Force update flag.
	 * @return array|bool
	 */
	public function get_license_limit( $force = false ) {
		$license = trim( Options::get_instance()->get( $this->license_slug ) );

		if ( ! $license ) {
			return false;
		}

		if ( ! get_transient( self::TRANSIENT_LICENSE_LIMIT ) || $force ) {

			$strings = $this->strings;

			$this->check_memory_limit();

			$api_params = array(
				'edd_action' => 'check_license',
				'license'    => $license,
				'item_id'    => $this->item_id,
				'url'        => home_url(),
			);

			$response = $this->get_api_response( $api_params );
			$data     = array(
				'total'   => '',
				'active'  => '',
				'status'  => '',
				'message' => '',
				'error'   => false,
			);

			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				$data['error'] = true;
				if ( is_wp_error( $response ) ) {
					$data['message'] = $response->get_error_message();
				} else {
					$data['message'] = $strings['license-status-unknown'];
				}
			} else {
				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

				if ( ! isset( $license_data->license ) ) {
					$data['error']   = true;
					$data['message'] = $strings['license-status-unknown'];
					return $data;
				}

				// Get site counts.
				$site_count = '';
				if ( isset( $license_data->site_count ) ) {
					$site_count = $license_data->site_count;
				}

				// Get license limit.
				$license_limit = '';
				if ( isset( $license_data->license_limit ) ) {
					$license_limit = $license_data->license_limit;
				}

				$data['status'] = $license_data->license;
				$data['total']  = $license_limit;
				$data['active'] = $site_count;

				// If unlimited.
				if ( 0 === $license_limit ) {
					$license_limit = $strings['unlimited'];
				}

				if ( 'valid' === $license_data->license ) {
					$data['message'] = $strings['license-key-is-active'];
				} elseif ( 'expired' === $license_data->license ) {
					$data['message'] = $strings['license-key-expired'];
				} elseif ( 'invalid' === $license_data->license ) {
					$data['message'] = $strings['license-keys-do-not-match'];
				} elseif ( 'inactive' === $license_data->license ) {
					$data['message'] = $strings['license-is-inactive'];
				} elseif ( 'disabled' === $license_data->license ) {
					$data['disabled'] = $strings['license-key-is-disabled'];
				} elseif ( 'site_inactive' === $license_data->license ) {
					// Site is inactive.
					$data['message'] = $strings['site-is-inactive'];
				} else {
					$data['message'] = $strings['license-status-unknown'];
				}
			}

			set_transient( self::TRANSIENT_LICENSE_LIMIT, $data, DAY_IN_SECONDS );
		}

		return get_transient( self::TRANSIENT_LICENSE_LIMIT );
	}
}

new LicenseManager();
