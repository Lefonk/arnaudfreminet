<?php
/**
 * Class AnalogPRO\Elementor\Sections\GlobalShadows
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Sections;

use Analog\Options;
use Analog\Utils;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

/**
 * Class GlobalShadows.
 *
 * Extends original section
 *
 * @package AnalogPRO\Elementor\Sections
 */
final class GlobalShadows {

	/**
	 * Holds Shadow keys and strings.
	 *
	 * @since
	 * @var array
	 */
	protected $shadows;

	/**
	 * BackgroundColorClasses constructor.
	 */
	public function __construct() {
		add_action(
			'analog_box_shadows_tab_end',
			array(
				$this,
				'register_additional_container_spacing_tabs',
			),
			170,
			2
		);
	}

	/**
	 * Register additional Container Spacing tabs.
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param Repeater       $repeater Elementor repeater element.
	 */
	public function register_additional_container_spacing_tabs( Controls_Stack $element, $repeater ) {
		$element->start_controls_tab(
			'ang_tab_shadows_secondary',
			array(
				'label' => __( '9-16', 'ang-pro' ),
			)
		);

		$default_shadows_secondary = array();

		for ( $i = 9; $i <= 16; $i++ ) {
			$default_shadows_secondary[] = array(
				'_id'   => "shadow_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Shadow %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_box_shadows_secondary',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_shadows_secondary,
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
			'ang_tab_shadows_tertiary',
			array(
				'label' => __( '17-24', 'ang-pro' ),
			)
		);

		$default_shadows_tertiary = array();

		for ( $i = 17; $i <= 24; $i++ ) {
			$default_shadows_tertiary[] = array(
				'_id'   => "shadow_$i",
				'title' => sprintf(
				// translators: %d: style key.
					esc_html__( 'Shadow %d', 'ang-pro' ),
					$i
				),
			);
		}

		$element->add_control(
			'ang_box_shadows_tertiary',
			array(
				'type'         => Global_Style_Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $default_shadows_tertiary,
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

new GlobalShadows();
