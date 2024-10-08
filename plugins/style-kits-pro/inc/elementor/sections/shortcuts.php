<?php
/**
 * Class AnalogPRO\Elementor\Sections\Shortcuts
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Sections;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

defined( 'ABSPATH' ) || exit;

/**
 * Class Shortcuts.
 *
 * @package AnalogPRO
 */
final class Shortcuts {
	/**
	 * Global_Form constructor.
	 */
	public function __construct() {
		add_action( 'elementor/element/after_section_end', array( $this, 'register_controls' ), 250, 2 );
	}

	/**
	 * Get module name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'ang-pro-shortcuts';
	}

	/**
	 * Register Heading Colors panel.
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param string         $section_id Section ID.
	 */
	public function register_controls( Controls_Stack $element, $section_id ) {
		if ( 'document_settings' !== $section_id ) {
			return;
		}

		$element->start_controls_section(
			'ang_shortcuts',
			array(
				'label' => _x( 'Shortcuts', 'Section Title', 'ang-pro' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$element->add_control(
			'ang_shortcuts_desc',
			array(
				'raw'             => __( 'Keyboard shortcuts for helper functions.', 'ang-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_shortcuts_heading_classes',
			array(
				'label' => __( 'Custom Classes', 'ang-pro' ),
				'type' => Controls_Manager::HEADING,
			)
		);

		$element->add_control(
			'ang_shortcuts_heading_classes_desc',
			array(
				'raw'             => __( 'CMD/CTRL + SHIFT + 2', 'ang-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_shortcuts_classes_border',
			array(
				'label' => __( 'Border Color', 'ang-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(79, 122, 233, 0.58)',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang-classes-border: {{VALUE}};',
				),
			)
		);

		$element->add_control(
			'ang_shortcuts_classes_label',
			array(
				'label' => __( 'Class Labels Color', 'ang-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#406DE1',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang-classes-label: {{VALUE}};',
				),
			)
		);

		$element->add_control(
			'ang_shortcuts_heading_css',
			array(
				'label' => __( 'Custom CSS', 'ang-pro' ),
				'type' => Controls_Manager::HEADING,
			)
		);

		$element->add_control(
			'ang_shortcuts_heading_css_desc',
			array(
				'raw'             => __( 'CMD/CTRL + SHIFT + 1', 'ang-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_shortcuts_css_border',
			array(
				'label' => __( 'Border Color', 'ang-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(211, 0, 0, 0.35)',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang-css-border: {{VALUE}};',
				),
			)
		);


		$element->end_controls_section();
	}

}

new Shortcuts();
