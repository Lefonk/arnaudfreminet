<?php
/**
 * AnalogPro Version Control Settings.
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Analog\Settings\Admin_Settings' ) && ! class_exists( '\Analog\Settings\Version_Control' ) ) {
	return;
}

/**
 * Class Version_Control_PRO.
 */
class Version_Control_PRO {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'ang_get_settings_version-control', array( $this, 'get_settings' ) );
	}

	/**
	 * Get settings array.
	 *
	 * @param array $settings Parent object settings.
	 * @return array
	 */
	public function get_settings( $settings ) {
		if ( current_user_can( 'update_plugins' ) ) {
			$settings_pro = apply_filters(
				'ang_version_control_pro_settings',
				array(
					array(
						'title'     => __( 'Rollback Style Kits Pro', 'ang-pro' ),
						'id'        => 'ang_pro_rollback_version_select_option',
						'type'      => 'select',
						'class'     => 'ang-enhanced-select',
						'desc_tip'  => true,
						'options'   => $this->get_rollback_versions(),
						'is_option' => false,
					),
					array(
						'id'    => 'ang_pro_rollback_version_button',
						'type'  => 'button',
						'class' => 'ang-pro-rollback-version-button ang-button button-secondary',
						'value' => __( 'Reinstall this version', 'ang-pro' ),
					),
				)
			);
			array_splice( $settings, 3, 0, $settings_pro );
		}

		return $settings;
	}

	/**
	 * Get rollback versions.
	 *
	 * @return array
	 */
	public function get_rollback_versions() {
		$keys = get_rollback_versions();
		$data = array();
		foreach ( $keys as $key => $value ) {
			$data[ $value ] = $value;
		}
		return $data;
	}

}

new Version_Control_PRO();
