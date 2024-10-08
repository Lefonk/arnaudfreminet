<?php

namespace AnalogPRO\Elementor\Sections;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

defined( 'ABSPATH' ) || exit;

class Page_Tools {
	public function __construct() {
		add_action( 'elementor/element/after_section_end', array( $this, 'register_controls' ), 999, 2 );
	}

	public function register_controls( Controls_Stack $element, $section_id ) {
		if ( 'document_settings' !== $section_id ) {
			return;
		}

		$element->start_controls_section(
			'ang_page_tools',
			array(
				'label' => __( 'Layout Tools', 'ang-pro' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$element->add_control(
			'ang_action_reset_styles',
			array(
				'label'       => __( 'Reset All Styles', 'ang-pro' ),
				'type'        => Controls_Manager::BUTTON,
				'text'        => __( 'Reset', 'ang-pro' ),
				'description' => __( 'This will reset customs styles from each element on the page.', 'ang-pro' ),
				'event'       => 'analog:resetAllStyles',
			)
		);

		$element->add_control(
			'ang_action_reset_color_typography',
			array(
				'label'       => __( 'Reset Color And Typography', 'ang-pro' ),
				'type'        => Controls_Manager::BUTTON,
				'text'        => __( 'Reset', 'ang-pro' ),
				'event'       => 'analog:resetColorTypography',
				'description' => __( 'All elements styles with Color and Typography will be removed.', 'ang-pro' ),
				'separator'   => 'after',
			)
		);

		$element->add_control(
			'ang_highlight_classes',
			array(
				'label' => __( 'Highlight Elements with Classes', 'ang-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$element->add_control(
			'ang_highlight_css',
			array(
				'label' => __( 'Highlight Elements with Custom CSS', 'ang-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$element->end_controls_section();
	}
}

new Page_Tools();
