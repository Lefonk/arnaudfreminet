<?php
/**
 * Class AnalogPRO\Elementor\Sections\CustomContainerSpacing
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Sections;

use Analog\Options;
use Analog\Utils;
use Analog\Plugin;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

/**
 * Class CustomContainerSpacing.
 *
 * Extends original section
 *
 * @package AnalogPRO\Elementor\Sections
 */
final class CustomContainerSpacing {
	/**
	 * CustomContainerSpacing constructor.
	 */
	public function __construct() {
		if ( Utils::is_container() ) {
			add_action( 'analog_container_spacing_section_end', array( $this, 'register_container_custom_spacing' ), 170, 2 );
			add_action( 'analog_container_spacing_tabs_end', array( $this, 'register_additional_container_spacing_tabs' ), 170, 2 );
		}
	}

	/**
	 * Register Custom Container Spacing control.
	 *
	 * @since 1.2.2
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param Repeater       $repeater Elementor repeater element.
	 * @return void
	 */
	public function register_container_custom_spacing( Controls_Stack $element, Repeater $repeater ) {
		$global_kit = Plugin::elementor()->kits_manager->get_active_kit_for_frontend();

		// Custom hack for getting the active kit on page.
		$current_page_id = Options::get_instance()->get( 'ang_current_page_id' );
		$kit             = false;
		if ( $current_page_id ) {
			$kit = Utils::get_document_kit( $current_page_id );
		}

		// Fallback to global kit.
		if ( ! $kit ) {
			$kit = $global_kit;
		}

		$options = array();

		if ( $kit ) {
			// Use raw settings that doesn't have default values.
			$kit_raw_settings = $kit->get_data( 'settings' );

			$padding_items = array();
			// Get SK Container padding preset labels.
			if ( isset( $kit_raw_settings['ang_custom_container_padding'] ) ) {
				$padding_items = $kit_raw_settings['ang_custom_container_padding'];
			}

			foreach ( $padding_items as $padding ) {
				// For some reason elementor repeater control adds a numeric id default
				// when there is no saved control.
				if ( ! isset( $padding['_id'] ) || is_numeric( $padding['_id'] ) ) {
					continue;
				}

				$options[ $padding['_id'] ] = $padding['title'];
			}
		}

		if ( ! empty( $options ) ) {
			/**
			 * Custom spacing.
			 */
			$element->add_control(
				'ang_custom_container_padding_heading',
				array(
					'type'  => Controls_Manager::HEADING,
					'label' => esc_html__( 'Custom Presets (Deprecated)', 'ang-pro' ),
				)
			);

			$element->add_control(
				'ang_custom_container_padding',
				array(
					'type'         => Global_Style_Repeater::CONTROL_TYPE,
					'fields'       => $repeater->get_controls(),
					'item_actions' => array(
						'sort'      => false,
						'add'       => false,
						'duplicate' => false,
					),
				)
			);
		}
	}


	/**
	 * Register additional Container Spacing tabs.
	 *
	 * @since 1.2.3
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param Repeater       $repeater Elementor repeater element.
	 * @return void
	 */
	public function register_additional_container_spacing_tabs( Controls_Stack $element, Repeater $repeater ) {
		$element->start_controls_tab(
			'ang_tab_container_spacing_secondary',
			array( 'label' => __( '9-16', 'ang-pro' ) )
		);

		$default_secondary_container_padding = array();
		for ( $i = 9; $i <= 16; $i++ ) {
			$default_secondary_container_padding[] = array(
				'_id'   => "ang_container_padding_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Padding %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_container_padding_secondary',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_secondary_container_padding,
				'item_actions' => array(
					'add'       => false,
					'remove'    => false,
					'sort'      => false,
					'duplicate' => false,
				),
				'separator'    => 'after',
			)
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'ang_tab_container_spacing_tertiary',
			array( 'label' => __( '17-24', 'ang-pro' ) )
		);

		$default_tertiary_container_padding = array();
		for ( $i = 17; $i <= 24; $i++ ) {
			$default_tertiary_container_padding[] = array(
				'_id'   => "ang_container_padding_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Padding %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_container_padding_tertiary',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_tertiary_container_padding,
				'item_actions' => array(
					'add'       => false,
					'remove'    => false,
					'sort'      => false,
					'duplicate' => false,
				),
				'separator'    => 'after',
			)
		);

		$element->end_controls_tab();
	}
}

new CustomContainerSpacing();
