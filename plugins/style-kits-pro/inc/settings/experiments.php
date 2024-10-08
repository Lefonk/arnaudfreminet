<?php
/**
 * AnalogPro Experiments Settings.
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Analog\Settings\Admin_Settings' ) && ! class_exists( '\Analog\Settings\Experiments' ) ) {
	return;
}

/**
 * Class Experiments_PRO.
 */
class Experiments_PRO {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'ang_get_settings_experiments', array( $this, 'get_settings' ) );
	}

	/**
	 * Get settings array.
	 *
	 * @param array $settings Parent object settings.
	 * @return array
	 */
	public function get_settings( $settings ) {

		$options = array(
			'active'   => __( 'Active', 'ang-pro' ),
			'inactive' => __( 'Inactive', 'ang-pro' ),
		);

		$settings_pro = apply_filters(
			'ang_experiments_pro_settings',
			array()
		);
		array_splice( $settings, 3, 0, $settings_pro );

		return $settings;
	}

}

new Experiments_PRO();
