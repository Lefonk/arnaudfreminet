<?php
/**
 * AnalogPro License Settings
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

use Analog\Settings\Admin_Settings;
use Analog\Settings\Settings_Page;
use Analog\Options;
use AnalogPro\LicenseManager;
use Analog\Admin\Notice;

defined( 'ABSPATH' ) || exit;

/**
 * License.
 */
class License extends Settings_Page {

	/**
	 * License manager instance.
	 *
	 * @var LicenseManager
	 */
	private $license;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id      = 'license';
		$this->label   = __( 'License', 'ang-pro' );
		$this->license = new LicenseManager();

		parent::__construct();

		add_action(
			'admin_init',
			function() {
				$this->check_pro_update();
				$this->deactivate_license();
			}
		);
		add_filter(
			'analog_admin_notices',
			function( $notices ) {
				$notices[] = $this->get_license_notices();
				return $notices;
			}
		);
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {

		$license                = trim( Options::get_instance()->get( 'ang_license_key' ) );
		$status                 = Options::get_instance()->get( 'ang_license_key_status' );
		$strings                = $this->license->get_strings();
		$license_status_message = $this->license->check_license();
		$latest_version         = LicenseManager::get_latest_version();
		$update_available       = LicenseManager::is_update_available() ? __( 'Yes', 'ang-pro' ) : __( 'No', 'ang-pro' );

		$license_status_setting = array();
		if ( $license ) {
			$license_status_setting = array(
				'title' => __( 'Status', 'ang-pro' ),
				'desc'  => $license_status_message,
				'class' => 'ang-license-status',
				'type'  => 'content',
				'id'    => 'ang_license_status',
			);
		}

		$license_action_setting = array(
			'type'  => 'action',
			'class' => 'button-secondary',
			'id'    => 'ang-license_activate',
			'value' => $strings['activate-license'],
		);

		if ( 'valid' === $status || $license ) {
			$license_action_setting = array(
				'type'  => 'action',
				'class' => 'button-secondary',
				'id'    => 'ang-license_deactivate',
				'value' => $strings['deactivate-license'],
			);
		}

		$settings = apply_filters(
			'ang_license_settings',
			array(
				array(
					'type' => 'title',
					'id'   => 'ang_license_activation_title',
				),
				array(
					'title' => __( 'License', 'ang-pro' ),
					'desc'  => 'valid' !== $status ?
						sprintf(
							/* translators: %s: link to account page. */
							__( 'To get Style Kits Pro updates, please enter your license key below. You can find your license key in your %s at AnalogWP.', 'ang-pro' ),
							'<a href="https://analogwp.com/account/" target="_blank" class="ang-link">' . __( 'account page', 'ang-pro' ) . '</a>'
						)
						: '',
					'id'    => 'ang_license_key',
					'type'  => 'license_text',
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ang_license',
				),
				$license_action_setting,
				$license_status_setting,
				array(
					'type' => 'sectionend',
					'id'   => 'ang_license_status',
				),
				array(
					'title' => __( 'Update Information', 'ang-pro' ),
					'type'  => 'title',
					'id'    => 'ang_license_update_info_title',
				),
				array(
					'title' => __( 'Current Version', 'ang-pro' ),
					'desc'  => ANG_PRO_VERSION,
					'class' => 'ang-pro-current-ver',
					'type'  => 'content',
					'id'    => 'ang_pro_current_ver',
				),
				array(
					'title' => __( 'Latest Version', 'ang-pro' ),
					'desc'  => $latest_version ? $latest_version : '',
					'class' => 'ang-pro-latest-ver',
					'type'  => 'content',
					'id'    => 'ang_pro_latest_ver',
				),
				array(
					'title' => __( 'Update Available', 'ang-pro' ),
					'desc'  => $update_available,
					'type'  => 'action',
					'class' => 'button-secondary',
					'id'    => 'ang-check_update',
					'value' => __( 'Check Again', 'ang-pro' ),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ang_license_info',
				),
			)
		);

		return apply_filters( 'ang_get_settings_' . $this->id, $settings );
	}

	/**
	 * Shows license notices.
	 *
	 * @return Notice
	 */
	public function get_license_notices() {

		$license = trim( Options::get_instance()->get( 'ang_license_key' ) );
		$status  = Options::get_instance()->get( 'ang_license_key_status' );
		$id      = $this->license->get_product_meta( 'id' );
		$url     = $this->license->get_product_meta( 'url' );
		$message = '';
		if ( ! $license ) {
			$message = sprintf(
				'<strong>%1$s</strong><br><a href="%2$s">%3$s</a>&nbsp;%4$s',
				__( 'Your Style Kits Pro License is not activated yet.', 'ang-pro' ),
				esc_url( self_admin_url( 'admin.php?page=ang-settings&tab=license' ) ),
				__( 'Activate', 'ang-pro' ),
				__( 'your Style Kits PRO license for plugin updates and unlimited access to PRO features and patterns.', 'ang-pro' )
			);
		}

		if ( $license && 'expired' === $status ) {
			$message = sprintf(
				'<strong>%1$s</strong><br><a href="%2$s" target="_blank">%3$s</a>&nbsp;%4$s',
				__( 'Your Style Kits Pro License has expired.', 'ang-pro' ),
				esc_url( $url . 'checkout/?edd_license_key=' . $license . '&download_id=' . $id ),
				__( 'Renew', 'ang-pro' ),
				__( 'to continue having access to plugin updates and unlimited access to PRO features and patterns.', 'ang-pro' )
			);
		}

		return new Notice(
			'license-notice',
			array(
				'content'         => $message,
				'dismissible'     => true,
				'type'            => Notice::TYPE_WARNING,
				'active_callback' => function() {
					return current_user_can( 'manage_options' );
				},
			)
		);
	}

	/**
	 * Output the settings.
	 */
	public function output() {
		$settings = $this->get_settings();

		Admin_Settings::output_fields( $settings );
	}

	/**
	 * Activate license.
	 */
	public function activate_license() {
		if ( isset( $_POST['ang-license_activate'] ) && isset( $_POST['ang_license_key'] ) ) {
			if ( check_admin_referer( 'ang_nonce', 'ang_nonce' ) ) {
				$activate = $this->license->activate_license( sanitize_key( $_POST['ang_license_key'] ) );
				if ( is_wp_error( $activate ) ) {
					Admin_Settings::add_error( $activate->get_error_message() );
				} elseif ( ! empty( $activate['message'] ) ) {
					Admin_Settings::add_message( $activate['message'] );
				}
			}
		}
	}

	/**
	 * Deactivates license.
	 */
	public function deactivate_license() {
		if ( isset( $_POST['ang-license_deactivate'] ) ) {
			if ( check_admin_referer( 'ang_nonce', 'ang_nonce' ) ) {
				$deactivate = $this->license->deactivate_license();
				if ( is_wp_error( $deactivate ) ) {
					Admin_Settings::add_error( $deactivate->get_error_message() );
				} elseif ( ! empty( $deactivate['message'] ) ) {
					Admin_Settings::add_message( $deactivate['message'] );
				}
			}
		}
	}

	/**
	 * Checks if an update is available.
	 *
	 * @return void
	 */
	public function check_pro_update() {
		if ( isset( $_POST['ang-check_update'] ) && check_admin_referer( 'ang_nonce', 'ang_nonce' ) ) {
			LicenseManager::is_update_available( true );
		}
	}

	/**
	 * Save settings.
	 */
	public function save() {
		$this->activate_license();
		$settings = $this->get_settings();
		$status   = Options::get_instance()->get( 'ang_license_key_status' );

		if ( 'valid' !== $status ) {
			return false;
		}

		Admin_Settings::save_fields( $settings );
	}
}

return new License();
