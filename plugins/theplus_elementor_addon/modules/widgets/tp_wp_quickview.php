<?php
/**
 * Widget Name: WP Quick View
 * Description: WP Quick View
 * Author: Posimyth
 * Author URI: http://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Wp_Quickview
 */
class ThePlus_Wp_Quickview extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Get Widget Name.
	 *
	 * @since 5.6.0
	 */
	public function get_name() {
		return 'tp-wp-quickview';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 5.6.0
	 */
	public function get_title() {
		return esc_html__( 'WP Quick View', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 5.6.0
	 */
	public function get_icon() {
		return 'fa- tp-icon-quick-view theplus_backend_icon';
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
	 * Get Widget categories.
	 *
	 * @since 5.6.0
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 5.6.0
	 */
	public function get_keywords() {
		return array( 'quickview', 'view', 'quick view', 'wp quick view' );
	}

	/**
	 * Register controls.
	 *
	 * @since 5.6.0
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_qv_layout',
			array(
				'label' => esc_html__( 'Quick View', 'theplus' ),
			)
		);
		$this->add_control(
			'query',
			array(
				'label'   => esc_html__( 'Post Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => theplus_get_post_type(),
			)
		);
		$this->add_control(
			'tpqc',
			array(
				'label'   => esc_html__( 'Quickview', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'         => esc_html__( 'Default', 'theplus' ),
					'custom_template' => esc_html__( 'Custom Template', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'custom_template_select',
			array(
				'label'       => esc_html__( 'Template', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => theplus_get_templates(),
				'condition'   => array(
					'tpqc' => 'custom_template',
				),
				'separator'   => 'after',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_styling',
			array(
				'label' => esc_html__( 'Quick View Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'qv_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .tp-wp-quickview-wrapper' => 'justify-content:{{VALUE}};',
				),
				'toggle'    => true,
			)
		);
		$this->add_responsive_control(
			'qv_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-wp-quickview-wrapper .tp-quick-view-click' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_qv_style' );
		$this->start_controls_tab(
			'tab_qv_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'qv_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} a.tp-quick-view-click' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'qv_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} a.tp-quick-view-click',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'qv_b',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} a.tp-quick-view-click',
			)
		);
		$this->add_responsive_control(
			'qv_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} a.tp-quick-view-click' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'qv_Shadow',
				'selector' => '{{WRAPPER}} a.tp-quick-view-click',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_qv_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'qv_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} a.tp-quick-view-click:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'qv_bg_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} a.tp-quick-view-click:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'qv_b_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} a.tp-quick-view-click:hover',
			)
		);
		$this->add_responsive_control(
			'qv_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} a.tp-quick-view-click:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'qv_Shadow_h',
				'selector' => '{{WRAPPER}} a.tp-quick-view-click:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_spinner_styling',
			array(
				'label' => esc_html__( 'Quick View Loader', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'qv_l_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 140,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-wp-quickview-wrapper .tp-quick-view-click .tp-pro-view-spinner' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'qv_l_border',
				'label'    => esc_html__( 'Border Style', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-wp-quickview-wrapper .tp-quick-view-click .tp-pro-view-spinner',
			)
		);
		$this->add_control(
			'qv_l_fill_color',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-wp-quickview-wrapper .tp-quick-view-click .tp-pro-view-spinner' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_content_title_styling',
			array(
				'label'     => esc_html__( 'Quick View Title', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tpqc' => 'default',
				),
			)
		);
		$this->add_responsive_control(
			'qvct_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'qvct_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-title',
			)
		);
		$this->add_control(
			'qvct_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_content_desc_styling',
			array(
				'label'     => esc_html__( 'Quick View Description', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tpqc' => 'default',
				),
			)
		);
		$this->add_responsive_control(
			'qvcd_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'qvcd_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-excerpt',
			)
		);
		$this->add_control(
			'qvcd_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-wp-quickview-wrapper .tp-qv-right .tp-qv-excerpt' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_content_button_styling',
			array(
				'label'     => esc_html__( 'Quick View Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tpqc' => 'default',
				),
			)
		);
		$this->add_responsive_control(
			'qvcb_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'qvcb_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'qvcb_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'scheme'    => Typography::TYPOGRAPHY_1,
				'separator' => 'before',
				'selector'  => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a',

			)
		);
		$this->start_controls_tabs( 'qvcb_tabs' );
		$this->start_controls_tab(
			'qvcb_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'qvcb_n_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'qvcb_n_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'qvcb_n_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a',
			)
		);
		$this->add_responsive_control(
			'qvcb_n_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'qvcb_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'qvcb_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'qvcb_h_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'qvcb_h_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'qvcb_h_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a:hover',
			)
		);
		$this->add_responsive_control(
			'qvcb_h_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'qvcb_h_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.tp-wp-quickview-wrapper.fancybox-content .tp-qv-right .tp-qv-button a:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_qv_fb_styling',
			array(
				'label' => esc_html__( 'Quick View Fancy Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'qv_fb_box_heading',
			array(
				'label' => esc_html__( 'Box', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->start_controls_tabs( 'tabs_fb_box' );
		$this->start_controls_tab(
			'tab_fb_box_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fb_box_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content',
			)
		);
		$this->add_responsive_control(
			'fb_box_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fb_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_fb_box_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fb_box_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content:hover',
			)
		);
		$this->add_responsive_control(
			'fb_box_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fb_box_shadow_h',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'qv_fb_overlay_heading',
			array(
				'label'     => esc_html__( 'Overlay', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'fb_overlay_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-is-open .fancybox-bg' => 'background: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'fb_overlay_opacity',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1,
				'step'      => 0.1,
				'selectors' => array(
					'.fancybox-is-open .fancybox-bg' => 'opacity: {{VALUE}} !important',
				),
			)
		);
		$this->add_control(
			'qv_fb_close_heading',
			array(
				'label'     => esc_html__( 'Close Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'fb_close_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'fb_close_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.fancybox-button' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'fb_close_top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.fancybox-button' => 'top: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'fb_close_right_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.fancybox-button' => 'right: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_fb_close' );
		$this->start_controls_tab(
			'tab_fb_close_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'fb_close_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fb_close_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fb_close_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button',
			)
		);
		$this->add_responsive_control(
			'fb_close_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fb_close_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_fb_close_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'fb_close_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button:hover' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fb_close_bg_h',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fb_close_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button:hover',
			)
		);
		$this->add_responsive_control(
			'fb_close_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fb_close_shadow_h',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.fancybox-container .tp-wp-quickview-wrapper.fancybox-content .fancybox-button:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}


	/**
	 * Render Quickview.
	 *
	 * @since 5.6.0
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$post_id = get_the_ID();

		$query = ! empty( $settings['query'] ) ? $settings['query'] : '';
		$tpqc  = ! empty( $settings['tpqc'] ) ? $settings['tpqc'] : '';

		$postattr = array();

		$postattr['query'] = $query;

		if ( 'custom_template' === $tpqc ) {
			$custom_template = ! empty( $settings['custom_template_select'] ) ? $settings['custom_template_select'] : '';

			$postattr['customtemplateqcw'] = 'yes';
			$postattr['templateqcw']       = $custom_template;
		}

		$postattr = ' data-quickview= \'' . wp_json_encode( $postattr ) . '\' ';

		$output = '<div class="tp-wp-quickview-wrapper" ' . esc_attr( $postattr ) . '>';

			$output .= '<a href="#" class="tp-quick-view-click" data-postid="' . esc_attr( $post_id ) . '">';

				$output .= '<i aria-hidden="true" class="fas fa-eye"></i>';

			$output .= '</a>';

		$output .= '</div>';

		echo $output;
	}
}