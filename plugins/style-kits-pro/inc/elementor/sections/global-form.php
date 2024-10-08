<?php

namespace AnalogPRO\Elementor;

use Analog\Elementor\Reset_Default_Style_Trait;
use Analog\Options;
use Analog\Utils;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Class Global_Form,
 *
 * @package AnalogPRO\Elementor
 */
final class Global_Form {
	use Reset_Default_Style_Trait;

	/**
	 * Global_Form constructor.
	 */
	public function __construct() {
		$this->reset_default_style_for_widget( 'form', 'section_field_style', 'field_background_color' );
		$this->reset_default_style_for_widget( 'form', 'section_form_style', 'label_spacing', array() );
		$this->reset_default_style_for_widget( 'form', 'section_form_style', 'column_gap', array() );
		$this->reset_default_style_for_widget( 'form', 'section_form_style', 'row_gap', array() );

		add_action( 'elementor/element/kit/section_buttons/after_section_end', array( $this, 'register_form_controls' ), 45, 2 );
	}

	/**
	 * Get module name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'ang-global-forms';
	}

	/**
	 * Register Global Form controls.
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param string         $section_id Section ID.
	 */
	public function register_form_controls( Controls_Stack $element, $section_id ) {
		$element->start_controls_section(
			'ang_form',
			array(
				'label' => __( 'Elementor Forms', 'ang-pro' ),
				'tab'   => Utils::get_kit_settings_tab(),
			)
		);

		$element->start_controls_tabs( 'ang_form_sizes' );

		$element->start_controls_tab(
			'ang_form_fields_gaps',
			array(
				'label' => __( 'Gaps', 'ang-pro' ),
			)
		);

		$element->add_control(
			'ang_form_field_gaps_desc',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <a href="https://analogwp.com/docs/elementor-forms/" target="_blank">%2$s</a>',
					__( 'These controls apply globally, and are not specific to input sizes.', 'ang-pro' ),
					__( 'Learn more', 'ang-pro' ),
				),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_form_columns_gap',
			array(
				'label'     => __( 'Columns Gap', 'ang-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-field-group' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .elementor-form-fields-wrapper' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				),
			)
		);

		$element->add_control(
			'ang_form_rows_gap',
			array(
				'label'     => __( 'Rows Gap', 'ang-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-field-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-field-group.recaptcha_v3-bottomleft, {{WRAPPER}} .elementor-field-group.recaptcha_v3-bottomright' => 'margin-bottom: 0;',
					'{{WRAPPER}} .elementor-form-fields-wrapper' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'ang_form_fields_labels',
			array(
				'label' => __( 'Labels', 'ang-pro' ),
			)
		);

		$element->add_control(
			'ang_form_field_labels_desc',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <a href="https://analogwp.com/docs/elementor-forms/" target="_blank">%2$s</a>',
					__( 'These controls apply globally, and are not specific to input sizes.', 'ang-pro' ),
					__( 'Learn more', 'ang-pro' ),
				),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_control(
			'ang_form_label_spacing',
			array(
				'label'     => __( 'Spacing', 'ang-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}.rtl .elementor-labels-inline .elementor-field-group > label' => 'padding-left: {{SIZE}}{{UNIT}};',
					// for the label position = inline option.
					'{{WRAPPER}}:not(.rtl) .elementor-labels-inline .elementor-field-group > label' => 'padding-right: {{SIZE}}{{UNIT}};',
					// for the label position = inline option.
					'{{WRAPPER}} .elementor-labels-above .elementor-field-group > label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					// for the label position = above option.
				),
			)
		);

		$element->add_control(
			'ang_form_mark_required_color',
			array(
				'label'     => __( 'Mark Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-mark-required .elementor-field-label:after' => 'color: {{COLOR}};',
				),
			)
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'ang_form_fields_messages',
			array(
				'label' => __( 'Messages', 'ang-pro' ),
			)
		);

		$element->add_control(
			'ang_form_field_messages_desc',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(
					'%1$s <a href="https://analogwp.com/docs/elementor-forms/" target="_blank">%2$s</a>',
					__( 'These controls apply globally, and are not specific to input sizes.', 'ang-pro' ),
					__( 'Learn more', 'ang-pro' ),
				),
				'content_classes' => 'elementor-descriptor',
			)
		);

		$element->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ang_form_message_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .elementor-message',
			)
		);

		$element->add_control(
			'ang_form_success_message_color',
			array(
				'label'     => __( 'Success Message Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-message.elementor-message-success' => 'color: {{COLOR}};',
				),
			)
		);

		$element->add_control(
			'ang_form_error_message_color',
			array(
				'label'     => __( 'Error Message Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-message.elementor-message-danger' => 'color: {{COLOR}};',
				),
			)
		);

		$element->add_control(
			'ang_form_inline_message_color',
			array(
				'label'     => __( 'Inline Message Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-message.elementor-help-inline' => 'color: {{COLOR}};',
				),
			)
		);

		$element->end_controls_tab();
		$element->end_controls_tabs();

		if ( true === Options::get_instance()->get( 'beta_tester' ) ) {
			$this->register_field_sizes_controls( $element );
		}

		$element->end_controls_section();
	}

	/**
	 * Register Form field sizes controls.
	 *
	 * @since n.e.x.t
	 *
	 * @param Controls_Stack $element Controls object.
	 * @return void
	 */
	private function register_field_sizes_controls( Controls_Stack $element ) {
		$element->add_control(
			'ang_form_field_sizes_heading',
			array(
				'label'     => __( 'Field Sizes', 'ang-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$element->add_control(
			'ang_form__field_sizes_description',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
				'raw'             => __( 'Customize the styling of each of the five form field size presets.', 'ang-pro' ),
			)
		);

		$sizes = array(
			'xs' => __( 'XS', 'ang-pro' ),
			'sm' => __( 'S', 'ang-pro' ),
			'md' => __( 'M', 'ang-pro' ),
			'lg' => __( 'L', 'ang-pro' ),
			'xl' => __( 'XL', 'ang-pro' ),
		);

		$element->start_controls_tabs( 'ang_form_field_sizes' );

		foreach ( $sizes as $key => $label ) {
			$id = 'ang_form_fields_' . $key;

			$input_selectors = array(
				"{{WRAPPER}} input:not([type='button']):not([type='submit']).elementor-size-{$key}",
				"{{WRAPPER}} textarea.elementor-size-{$key}",
				"{{WRAPPER}} .elementor-field-textual.elementor-size-{$key}",
			);

			$input_focus_selectors = array(
				"{{WRAPPER}} input:focus:not([type='button']):not([type='submit']).elementor-size-{$key}",
				"{{WRAPPER}} textarea:focus.elementor-size-{$key}",
				"{{WRAPPER}} .elementor-field-textual:focus.elementor-size-{$key}",
			);

			$input_selector       = implode( ',', $input_selectors );
			$input_focus_selector = implode( ',', $input_focus_selectors );

			$element->start_controls_tab(
				$id,
				array(
					'label' => $label,
				)
			);

			$element->add_responsive_control(
				$id . '_field_padding',
				array(
					'label'      => __( 'Padding', 'ang-pro' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%', 'rem', 'vw', 'custom' ),
					'selectors'  => array(
						$input_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'separator'  => 'after',
				)
			);

			$element->add_control(
				$id . '_fields',
				array(
					'type'  => Controls_Manager::HEADING,
					'label' => __( 'Fields', 'ang-pro' ),
				)
			);

			$element->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'label'    => __( 'Typography', 'ang-pro' ),
					'name'     => $id . '_field_typography',
					'selector' => $input_selector,
				)
			);

			$element->add_control(
				$id . '_fields_normal_heading',
				array(
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Normal', 'ang-pro' ),
					'separator' => 'before',
				)
			);

			$this->add_form_field_state_tab_controls( $element, $id . '_form_field', $input_selector );

			$element->add_control(
				$id . '_fields_focus_heading',
				array(
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Focus', 'ang-pro' ),
					'separator' => 'before',
				)
			);

			$this->add_form_field_state_tab_controls( $element, $id . '_form_field_focus', $input_focus_selector );

			$element->add_control(
				$id . '_focus_transition_duration',
				array(
					'label'     => __( 'Transition Duration', 'ang-pro' ) . ' (ms)',
					'type'      => Controls_Manager::SLIDER,
					'selectors' => array(
						$input_selector => 'transition: {{SIZE}}ms',
					),
					'range'     => array(
						'px' => array(
							'min' => 0,
							'max' => 3000,
						),
					),
				)
			);

			$element->end_controls_tab();
		}

		$element->end_controls_tabs();
	}

	/**
	 * Add form state controls.
	 *
	 * @param Controls_Stack $element Control object.
	 * @param string         $prefix Settings ID prefix.
	 * @param string         $selector Selector value.
	 *
	 * @return void
	 */
	private function add_form_field_state_tab_controls( $element, $prefix, $selector ) {
		$element->add_control(
			$prefix . '_text_color',
			array(
				'label'     => __( 'Text Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector => 'color: {{VALUE}};',
				),
			)
		);

		$element->add_control(
			$prefix . '_background_color',
			array(
				'label'     => __( 'Background Color', 'ang-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					$selector => 'background-color: {{VALUE}};',
				),
			)
		);

		$element->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => $prefix . '_box_shadow',
				'selector' => $selector,
			)
		);

		$element->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => $prefix . '_border',
				'selector' => $selector,
			)
		);

		$element->add_control(
			$prefix . '_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ang-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem', 'custom' ),
				'selectors'  => array(
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}
}

new Global_Form();
