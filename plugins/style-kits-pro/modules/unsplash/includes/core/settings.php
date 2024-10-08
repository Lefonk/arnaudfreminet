<?php
/**
 * Settings Tab.
 *
 * @package   Analog Unsplash
 * @author    Analog
 * @license   GPL-3.0
 * @link      https://analogwp.com
 * @copyright 2017 Analog (Pty) Ltd
 */

namespace Analog\Modules\Unsplash\Core;

use Analog\Options;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Analog\Settings\Admin_Settings' ) && ! class_exists( '\Analog\Settings\Extensions' ) ) {
	return;
}

/**
 * Unsplash Settings.
 */
class Settings {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'ang_get_sections_extensions', array( $this, 'update_sections' ) );
		add_filter( 'ang_get_settings_extensions', array( $this, 'get_settings' ) );
	}

	/**
	 * Update sections array.
	 *
	 * @param array $sections Sections array data.
	 * @return array
	 */
	public function update_sections( $sections ) {
		$sections['unsplash'] = __( 'Unsplash', 'ang-pro' );
		return $sections;
	}

	/**
	 * Get settings array.
	 *
	 * @param string $current_section Current section id.
	 * @return array
	 */
	public function get_settings( $current_section = '' ) {
		global $current_section;
		$settings        = array();
		$unsplash_active = Options::get_instance()->get( 'ang_unsplash' );

		if ( 'unsplash' === $current_section ) {
			$api_key          = array();
			$default_username = array();
			if ( $unsplash_active ) {
				$api_key = array(
					'title'   => __( 'Unsplash API Key', 'ang-pro' ),
					'desc'    => __( 'You can use a custom Unsplash API key of your own in case of higher request limits/out of request limits. ', 'ang-pro' ) . '<a class="ang-link" href="https://unsplash.com/documentation#registering-your-application" target="_blank">' . __( 'More Info', 'ang-pro' ) . '</a>',
					'id'      => 'ang_unsplash_key',
					'default' => '',
					'type'    => 'text',
				);

				$default_username = array(
					'title'   => __( 'Default Username', 'ang-pro' ),
					'desc'    => __( 'You can set a default username here for Unsplash collections. If this is not set, the default collections data will be from AnalogWP\'s profile. &nbsp;', 'ang-pro' ) . '<a class="ang-link" href="https://unsplash.com/@analogwp/collections" target="_blank">' . __( 'More Info', 'ang-pro' ) . '</a>',
					'id'      => 'ang_default_username',
					'default' => 'analogwp',
					'type'    => 'text',
				);
			}

			$settings = apply_filters(
				'ang_unsplash_extension_settings',
				array(
					array(
						'type' => 'title',
						'id'   => 'ang_unsplash',
					),
					array(
						'title'         => __( 'Enable Unsplash', 'ang-pro' ),
						'desc'          => __( 'Activate or de-activate the Unsplash Collections library.', 'ang-pro' ),
						'id'            => 'ang_unsplash',
						'default'       => false,
						'type'          => 'checkbox',
						'checkboxgroup' => 'start',
					),
					$api_key,
					$default_username,
					array(
						'type' => 'sectionend',
						'id'   => 'ang_unsplash',
					),
				)
			);
		}

		return $settings;
	}
}

new Settings();
