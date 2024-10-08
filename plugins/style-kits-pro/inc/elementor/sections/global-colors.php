<?php
/**
 * Class AnalogPRO\Elementor\Sections\GlobalColors
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Sections;

use Analog\Options;
use Elementor\Controls_Stack;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

/**
 * Class GlobalColors.
 *
 * Extends original section
 *
 * @package AnalogPRO\Elementor\Sections
 */
final class GlobalColors {

	/**
	 * GlobalColors constructor.
	 */
	public function __construct() {
		add_action( 'analog_global_colors_tab_end', array( $this, 'register_additional_tabs' ), 170, 2 );
	}

	/**
	 * Register additional color vars in tabs at Style Kit Colors.
	 *
	 * @since 1.2.3
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param Repeater       $repeater Elementor repeater element.
	 * @return void
	 */
	public function register_additional_tabs( Controls_Stack $element, Repeater $repeater ) {
		$element->start_controls_tab(
			'ang_tab_global_colors_secondary',
			array( 'label' => __( '17-32', 'ang-pro' ) )
		);

		$default_secondary_colors_part_one = array();

		for ( $i = 17; $i <= 24; $i++ ) {
			$default_secondary_colors_part_one[] = array(
				'_id'   => "sk_color_$i",
				'title' => sprintf(
					// translators: %d: style key.
					esc_html__( 'Color Style %d', 'ang-pro' ),
					$i
				),
				'color' => '',
			);
		}

		$element->add_control(
			'ang_global_secondary_part_one_colors',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_secondary_colors_part_one,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
				'separator'    => 'after',
			)
		);

		$default_secondary_colors_part_two = array();

		for ( $i = 25; $i <= 32; $i++ ) {
			$default_secondary_colors_part_two[] = array(
				'_id'   => "sk_color_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Color Style %d', 'ang-pro' ),
					$i
				),
				'color' => '',
			);
		}

		$element->add_control(
			'ang_global_secondary_part_two_colors',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_secondary_colors_part_two,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
				'separator'    => 'before',
			)
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'ang_tab_global_colors_tertiary',
			array( 'label' => __( '33-48', 'ang-pro' ) )
		);

		$default_tertiary_colors_part_one = array();

		for ( $i = 33; $i <= 40; $i++ ) {
			$default_tertiary_colors_part_one[] = array(
				'_id'   => "sk_color_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Color Style %d', 'ang-pro' ),
					$i
				),
				'color' => '',
			);
		}

		$element->add_control(
			'ang_global_tertiary_part_one_colors',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_tertiary_colors_part_one,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
				'separator'    => 'after',
			)
		);

		$default_tertiary_colors_part_two = array();

		for ( $i = 41; $i <= 48; $i++ ) {
			$default_tertiary_colors_part_two[] = array(
				'_id'   => "sk_color_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Color Style %d', 'ang-pro' ),
					$i
				),
				'color' => '',
			);
		}

		$element->add_control(
			'ang_global_tertiary_part_two_colors',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_tertiary_colors_part_two,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
				'separator'    => 'before',
			)
		);

		$element->end_controls_tab();
	}
}

new GlobalColors();
