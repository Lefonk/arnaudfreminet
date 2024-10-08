<?php
/**
 * Class AnalogPRO\Elementor\Sections\BackgroundColorClasses
 *
 * @package AnalogPRO
 */

namespace AnalogPRO\Elementor\Sections;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

defined( 'ABSPATH' ) || exit;

/**
 * Class BackgroundColorClasses.
 *
 * Extends original section
 *
 * @package AnalogPRO\Elementor\Sections
 */
final class BackgroundColorClasses {
	/**
	 * BackgroundColorClasses constructor.
	 */
	public function __construct() {
		add_action( 'analog_background_colors_tab_end', array( $this, 'modify_background_tabs' ), 170, 1 );
		add_action( 'elementor/element/after_section_end', array( $this, 'tweak_original_classes' ), 170, 2 );
	}

	/**
	 * Modify original "Background Color Classes" controls.
	 *
	 * @hook analog_background_colors_tab_end
	 *
	 * @param Controls_Stack $element Elementor element.
	 */
	public function modify_background_tabs( Controls_Stack $element ) {
		$element->start_controls_tab(
			'ang_tab_background_accent',
			array( 'label' => __( 'Accent', 'ang-pro' ) )
		);

		$element->add_control(
			'ang_tab_background_accent_desc',
			array(
				'type'    => Controls_Manager::RAW_HTML,
				'raw'     => __( 'Add the class <strong>sk-accent-bg</strong> to a section or column to apply these colors.', 'ang-pro' ),
				'classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_background_accent_background',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'variable'  => 'ang_background_accent_background',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang_background_accent_background: {{VALUE}};',
					'{{WRAPPER}} .sk-accent-bg:not(.elementor-column)' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .sk-accent-bg .elementor-counter-title, {{WRAPPER}} .sk-accent-bg .elementor-counter-number-wrapper' => 'color: currentColor',
					'{{WRAPPER}} .sk-accent-bg.elementor-column > .elementor-element-populated' => 'background-color: {{VALUE}};',
				),
			)
		);
		$element->add_control(
			'ang_background_accent_text',
			array(
				'label'     => __( 'Text Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'variable'  => 'ang_background_accent_text',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang_background_accent_text: {{VALUE}};',
					'{{WRAPPER}} .sk-accent-bg'   => 'color: {{VALUE}};',
					'{{WRAPPER}}, {{WRAPPER}} .sk-text-accent' => '--ang_color_text_accent: {{VALUE}}',
					'{{WRAPPER}} .sk-text-accent' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sk-text-accent .elementor-heading-title' => 'color: {{VALUE}}',
				),
			)
		);
		$element->add_control(
			'ang_background_accent_heading',
			array(
				'label'     => __( 'Headings Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'variable'  => 'ang_background_accent_heading',
				'selectors' => array(
					'{{WRAPPER}}' => '--ang_background_accent_heading: {{VALUE}};',
					'{{WRAPPER}} .sk-accent-bg h1,' .
					'{{WRAPPER}} .sk-accent-bg h2,' .
					'{{WRAPPER}} .sk-accent-bg h3,' .
					'{{WRAPPER}} .sk-accent-bg h4,' .
					'{{WRAPPER}} .sk-accent-bg h5,' .
					'{{WRAPPER}} .sk-accent-bg h6' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h1,' .
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h2,' .
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h3,' .
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h4,' .
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h5,' .
					'{{WRAPPER}} .sk-light-bg .sk-accent-bg h6' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h1,' .
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h2,' .
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h3,' .
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h4,' .
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h5,' .
					'{{WRAPPER}} .sk-dark-bg .sk-accent-bg h6' => 'color: {{VALUE}};',
				),
			)
		);

		$element->end_controls_tab();
	}

	/**
	 * Tweak "Background Color Classes controls".
	 *
	 * Includes extra selectors for .sk-accent-bg class inheritance.
	 *
	 * @param Controls_Stack $element Elementor element.
	 * @param string         $section_id Section ID.
	 */
	public function tweak_original_classes( Controls_Stack $element, $section_id ) {
		$control = $element->get_controls( 'ang_background_light_heading' );

		if ( isset( $control['selectors'] ) ) {
			$control['selectors'] += array(
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h1,' .
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h2,' .
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h3,' .
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h4,' .
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h5,' .
				'{{WRAPPER}} .sk-accent-bg .sk-light-bg h6' => 'color: {{VALUE}};',
			);

			$element->update_control( 'ang_background_light_heading', $control );
		}

		$control = $element->get_controls( 'ang_background_dark_heading' );

		if ( isset( $control['selectors'] ) ) {
			$control['selectors'] += array(
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h1,' .
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h2,' .
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h3,' .
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h4,' .
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h5,' .
				'{{WRAPPER}} .sk-accent-bg .sk-dark-bg h6' => 'color: {{VALUE}};',
			);

			$element->update_control( 'ang_background_dark_heading', $control );
		}
	}
}

new BackgroundColorClasses();
