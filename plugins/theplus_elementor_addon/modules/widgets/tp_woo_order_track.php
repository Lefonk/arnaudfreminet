<?php
/**
 * Widget Name: Woo Order Track
 * Description: Woo Order Track
 * Author: Posimyth
 * Author URI: http://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Woo_Order_Track.
 */
class ThePlus_Woo_Order_Track extends Widget_Base {

	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-woo-order-track';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Woo Order Track', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-truck theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Order Track', 'Order Tracking', 'Track Order', 'Tracking Order', 'Order Status', 'Order Progress', 'Order Updates', 'Order Locator', 'Order Finder' );
	}

	/**
	 * Get Custom URL.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_order_track_page',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
			)
		);
		$this->add_control(
			'ot_layout',
			array(
				'label'   => wp_kses_post( "Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-woocommerce-order-tracking-page-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_ot_l1',
				'options' => array(
					'tp_ot_l1' => esc_html__( 'Style 1', 'theplus' ),
					'tp_ot_l2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'separator' => 'before',
				'condition' => array(
					'ot_layout' => 'tp_ot_l2',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order,
					{{WRAPPER}} .tp-order-track-page-wrapper .track_order,
					{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'text-align:{{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_opt',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
			)
		);
		$this->add_control(
			'updateIcons',
			array(
				'label' => esc_html__( 'Update Icons', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'updateIconsnote',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Replace default icons with another font awesome icon using below options.<a href="https://fontawesome.com/v4.7.0/icons" target="_blank">( Get Font Awesome Icon Id. )</a>',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'ot_icon',
			array(
				'label'       => esc_html__( 'Order Track', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'checkout_box_content_styling',
			array(
				'label' => esc_html__( 'Order Track Form', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'ot_box_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ot_box_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'ot_box_bg',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-order-track-page-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ot_box_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper',
			)
		);
		$this->add_responsive_control(
			'ot_box_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ot_box_shadow',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ot_head_desc_styling',
			array(
				'label' => esc_html__( 'Heading/Description', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ot_head_desc_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p:not(.form-row)',
			)
		);
		$this->add_control(
			'ot_head_desc_color',
			array(
				'label'     => esc_html__( 'Heading/Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p:not(.form-row)' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ot_label_styling',
			array(
				'label' => esc_html__( 'Label', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ot_label_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p.form-row.form-row-first,
				{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p.form-row.form-row-last',
			)
		);
		$this->add_control(
			'ot_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p.form-row.form-row-first,
				{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order p.form-row.form-row-last' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ot_input_styling',
			array(
				'label' => esc_html__( 'Input Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'ot_input_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ot_input_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ot_input_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'ot_input_typography',
				'selector'  => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ot_input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_ot_input_field_style' );
		$this->start_controls_tab(
			'tab_ot_input_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'ot_input_field_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ot_input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ot_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]',
			)
		);

		$this->add_responsive_control(
			'ot_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ot_box_norml_shadow',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ot_input_field_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'ot_input_field_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ot_input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'ot_box_border_hover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]:focus',
			)
		);
		$this->add_responsive_control(
			'ot_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ot_box_active_shadow',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row input[type="text"]:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'tb_btn_styling',
			array(
				'label' => esc_html__( 'Track Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'ot_track_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ot_track_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ot_track_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'ot_track_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button',

			)
		);
		$this->start_controls_tabs( 'ot_track_tabs' );
			$this->start_controls_tab(
				'ot_track_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'ot_track_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button' => 'color: {{VALUE}}',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'ot_track_n_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'ot_track_n_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button',
				)
			);
			$this->add_responsive_control(
				'ot_track_n_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'ot_track_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'ot_track_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'ot_track_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:hover' => 'color: {{VALUE}}',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'ot_track_h_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'ot_track_h_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:hover',
				)
			);
			$this->add_responsive_control(
				'ot_track_h_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'ot_track_h_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-form-track-order .form-row .button:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'ot_od_info_styling',
			array(
				'label' => esc_html__( 'Order Info', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ot_od_info_typography',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .order-info,{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark',
			)
		);
		$this->add_control(
			'ot_od_info_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .order-info,{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'ot_od_info_highlight_heading',
			array(
				'label'     => esc_html__( 'Highlight Text Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'ot_od_info_ht_in_gap',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Inner Gap', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'ot_od_info_ht_gap',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Outer Gap', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'ot_od_info_ht_color',
			array(
				'label'     => esc_html__( 'Highlight Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ot_od_info_ht_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark',
			)
		);
		$this->add_responsive_control(
			'ot_od_info_ht_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .order-info mark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'oi_ht_styling',
			array(
				'label' => esc_html__( 'Order Info Heading Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'oi_ht_typography',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details .woocommerce-column__title,{{WRAPPER}}  .tp-order-track-page-wrapper .woocommerce-order-details__title',
			)
		);
		$this->add_control(
			'oi_ht_color',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details .woocommerce-column__title,{{WRAPPER}}  .tp-order-track-page-wrapper .woocommerce-order-details__title' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'oi_pbi_styling',
			array(
				'label' => esc_html__( 'Product list and Billing', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'oi_pbi_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-table--order-details,
					{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'oi_pbi_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table td,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table td a',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'oi_pbi_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table td,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table td a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'oi_pbi_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-table--order-details,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'oi_pbi_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-table--order-details,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table',
			)
		);
		$this->add_responsive_control(
			'oi_pbi_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-table--order-details,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'oi_pbi_shadow',
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-table--order-details,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table',
			)
		);
		$this->add_control(
			'oi_pbin_border_heading',
			array(
				'label'     => esc_html__( 'Inner Border', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'oi_pbin_border',
				'label'    => esc_html__( 'Inner Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table thead tr th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table thead tr td,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tbody tr th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tbody tr td,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tfoot tr:not(:last-child) th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tfoot tr:not(:last-child) td',
			)
		);
		$this->add_control(
			'oi_pbin_tot_border_heading',
			array(
				'label'     => esc_html__( 'Total Border', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'oi_pbin_tot_border',
				'label'    => esc_html__( 'Total Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tfoot tr:last-child th,{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce table.shop_table tfoot tr:last-child td',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'oi_bas_add_styling',
			array(
				'label' => esc_html__( 'Billing & Shipping address', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'oi_bas_add_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address',
			)
		);
		$this->add_control(
			'oi_bas_add_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address' => 'color: {{VALUE}}',
				),
			)
		);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'oi_bas_add_n_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'oi_bas_add_n_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address',
				)
			);
			$this->add_responsive_control(
				'oi_bas_add_n_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'oi_bas_add_n_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-order-track-page-wrapper .woocommerce-customer-details address',
				)
			);
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Get Short-Code
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	private function get_shortcode() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'shortcode', 'woocommerce_order_tracking' );

		$shortcode   = array();
		$shortcode[] = sprintf( '[%s]', $this->get_render_attribute_string( 'shortcode' ) );

		return implode( '', $shortcode );
	}

	/**
	 * Woo Order Render
	 *
	 * @since 1.0.0
	 * @version 5.4.1
	 */
	public function render() {
		$settings  = $this->get_settings_for_display();
		$ot_layout = ! empty( $settings['ot_layout'] ) ? $settings['ot_layout'] : 'tp_ot_l1';

		$output = '<div class="tp-order-track-page-wrapper ' . esc_attr( $ot_layout ) . '">';

			$output .= do_shortcode( $this->get_shortcode() );

		$output .= '</div>';

		echo $output;
	}
}
