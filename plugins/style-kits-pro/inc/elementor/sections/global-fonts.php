<?php
/**
 * Class AnalogPRO\Elementor\Sections\GlobalFonts
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
 * Class GlobalFonts.
 *
 * Extends original section
 *
 * @package AnalogPRO\Elementor\Sections
 */
final class GlobalFonts {

	/**
	 * GlobalFonts constructor.
	 */
	public function __construct() {
		add_action( 'analog_global_fonts_tab_end', array( $this, 'register_additional_tabs' ), 170, 2 );
	}

	/**
	 * Register additional font vars in tabs at Style Kit Fonts.
	 *
	 * @since 1.2.3
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param Repeater       $repeater Elementor repeater element.
	 * @return void
	 */
	public function register_additional_tabs( Controls_Stack $element, Repeater $repeater ) {
		$element->start_controls_tab(
			'ang_tab_global_fonts_secondary',
			array( 'label' => __( '17-32', 'ang-pro' ) )
		);

		$default_secondary_fonts_part_one = array();

		for ( $i = 17; $i <= 24; $i++ ) {
			$default_secondary_fonts_part_one[] = array(
				'_id'   => "sk_type_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Font Style %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_global_secondary_part_one_fonts',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_secondary_fonts_part_one,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
			)
		);

		$default_secondary_fonts_part_two = array();

		for ( $i = 25; $i <= 32; $i++ ) {
			$default_secondary_fonts_part_two[] = array(
				'_id'   => "sk_type_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Font Style %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_global_secondary_part_two_fonts',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_secondary_fonts_part_two,
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
			'ang_tab_global_fonts_tertiary',
			array( 'label' => __( '33-48', 'ang-pro' ) )
		);

		$default_tertiary_fonts_part_one = array();

		for ( $i = 33; $i <= 40; $i++ ) {
			$default_tertiary_fonts_part_one[] = array(
				'_id'   => "sk_type_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Font Style %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_global_tertiary_part_one_fonts',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_tertiary_fonts_part_one,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
			)
		);

		$default_tertiary_fonts_part_two = array();

		for ( $i = 41; $i <= 48; $i++ ) {
			$default_tertiary_fonts_part_two[] = array(
				'_id'   => "sk_type_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Font Style %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_global_tertiary_part_two_fonts',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_tertiary_fonts_part_two,
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

new GlobalFonts();
