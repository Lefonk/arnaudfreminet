<?php
/**
 * Analog General >> Manage SK Panels Subtab.
 *
 * @package AnalogPro/Admin
 * @subpackage Analog/Admin
 */

namespace AnalogPRO\Settings;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( '\Analog\Settings\Admin_Settings' ) && ! class_exists( '\Analog\Settings\General' ) ) {
	return;
}

/**
 * Manage SK Panels Subtab Settings.
 */
class Manage_SK_Panels {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'ang_get_sections_general', array( $this, 'update_sections' ) );
		add_filter( 'ang_get_settings_general', array( $this, 'get_settings' ) );
	}

	/**
	 * Update sections array.
	 *
	 * @param array $sections Sections array data.
	 * @return array
	 */
	public function update_sections( $sections ) {
		$sections['manage_sk_panels'] = __( 'Deactivate SK Panels', 'ang-pro' );
		return $sections;
	}

	/**
	 * Get settings array.
	 *
	 * @param array $settings Settings.
	 * @return array
	 */
	public function get_settings( $settings = array() ) {
		global $current_section;

		if ( 'manage_sk_panels' === $current_section ) {
			$settings = array(
				array(
					'title' => __( 'Deactivate Style Kits panels', 'ang-pro' ),
					'desc'  => sprintf(
						'%1$s <a href="https://analogwp.com/docs/selectively-deactivate-disable-style-kit-panels/" target="_blank">%2$s</a>',
						__( 'Below you can manage the visibility of each Style Kits panel individually. Any existing values in a disabled Style Kit panel will lose its values.', 'ang-pro' ),
						__( 'Learn more', 'ang-pro' ),
					),
					'class' => 'ang-manage-sk-heading',
					'type'  => 'content',
					'id'    => 'ang-manage-sk',
				),
				array(
					'type' => 'title',
					'id'   => 'ang_sk_panels',
				),
				array(
					'title'   => '',
					'id'      => 'manage_sk_panels',
					'default' => true,
					'type'    => 'multi-checkbox',
					'options' => array(
						'global_colors'         => __( 'Style Kit Colors', 'ang-pro' ),
						'global_fonts'          => __( 'Style Kit Fonts', 'ang-pro' ),
						'bg_color_classes'      => __( 'Background Color Classes', 'ang-pro' ),
						'heading_sizes'         => __( 'Typographic Sizes', 'ang-pro' ),
						'forms'                 => __( 'Elementor Forms', 'ang-pro' ),
						'shadows'               => __( 'Shadows', 'ang-pro' ),
						'container_spacing'     => __( 'Container Spacing', 'ang-pro' ),
						'tools'                 => __( 'Manage Style Kit', 'ang-pro' ),
						// Legacy features - to be removed.
						'button_sizes'          => __( 'Button Sizes (Legacy)', 'ang-pro' ),
						'column_gaps'           => __( 'Column Gaps (Legacy)', 'ang-pro' ),
						'outer_section_padding' => __( 'Outer Section Padding (Legacy)', 'ang-pro' ),
						'accent_colors'         => __( 'Accent Colors (Legacy)', 'ang-pro' ),

					),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ang_sk_panels',
				),
				array(
					'desc'  => sprintf( __( 'If you are looking to hide Style Kits for your clients, you can also make use of the %1$sUser Roles Management%2$s.', 'ang-pro' ), '<a href="' . admin_url( 'admin.php?page=ang-settings&tab=uroles' ) . '">', '</a>' ),
					'class' => 'ang-manage-sk-notice',
					'type'  => 'content',
					'id'    => 'ang-manage-sk-notice',
				),
			);
		}
		return $settings;
	}
}

new Manage_SK_Panels();
