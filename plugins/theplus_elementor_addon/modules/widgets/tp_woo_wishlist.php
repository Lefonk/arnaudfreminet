<?php
/**
 * Wiget Name: Woo Wishlist
 * Description: Woo Wishlist
 * Author: Posimyth
 * Author URI: http://posimyth.com
 *
 * @package WooMultiCompare
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo WishList Main Elementor Class
 *
 * @since 5.5.4
 */
class ThePlus_Woo_Wishlist extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Widget Name.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_name() {
		return 'tp-woo-wishlist';
	}

	/**
	 * Widget Title.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Woo Wishlist', 'theplus' );
	}

	/**
	 * Widget Icon.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_icon() {
		return 'fa- tp-icon-woo-wishlist theplus_backend_icon';
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
	 * Widget Categories.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Widget Search Key word
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_keywords() {
		return array( 'wishlist', 'woo', 'woo wishlist', 'match' );
	}

	/**
	 * Register Woo WishList
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	protected function register_controls() {
		/*content start*/
		$this->start_controls_section(
			'section_wwlist_layout',
			array(
				'label' => esc_html__( 'Woo Wishlist', 'theplus' ),
			)
		);
		$this->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_wl_button',
				'options' => array(
					'tp_wl_button' => esc_html__( 'Button', 'theplus' ),
					'tp_wl_count'  => esc_html__( 'Count', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'query',
			array(
				'label'   => esc_html__( 'Post Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'product',
				'options' => theplus_get_post_type(),
			)
		);
		$this->add_control(
			'uniquename',
			array(
				'label'     => esc_html__( 'Unique Name', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'tpwishlist',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'query!' => 'product',
				),
			)
		);
		$this->add_responsive_control(
			'btnalign',
			array(
				'label'     => __( 'Alignment', 'theplus' ),
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
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Woo Wishlist Button Section*/
		$this->start_controls_section(
			'section_wwishbtn_layout',
			array(
				'label'     => esc_html__( 'Woo WishList Button', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wl_button',
				),
			)
		);
		$this->add_control(
			'wishtype',
			array(
				'label'     => esc_html__( 'Wish Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp_wl_texti',
				'options'   => array(
					'tp_wl_icon'  => esc_html__( 'Icon', 'theplus' ),
					'tp_wl_text'  => esc_html__( 'Text', 'theplus' ),
					'tp_wl_texti' => esc_html__( 'Text/Icon', 'theplus' ),
				),
				'condition' => array(
					'type' => 'tp_wl_button',
				),
			)
		);
		$this->add_control(
			'wishlist_ttl',
			array(
				'label'     => esc_html__( 'Add Wishlist', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Add to wishlist', 'theplus' ),
				'condition' => array(
					'type'      => 'tp_wl_button',
					'wishtype!' => 'tp_wl_icon',
				),
			)
		);
		$this->add_control(
			'wishlist_Rttl',
			array(
				'label'     => esc_html__( 'Remove Wishlist', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Remove From Wishlist', 'theplus' ),
				'condition' => array(
					'type'      => 'tp_wl_button',
					'wishtype!' => 'tp_wl_icon',
				),
			)
		);
		$this->add_control(
			'wishlist_Alttl',
			array(
				'label'     => esc_html__( 'Already Wishlist', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Already in wishlist', 'theplus' ),
				'condition' => array(
					'type'      => 'tp_wl_button',
					'wishtype!' => 'tp_wl_icon',
				),
			)
		);
		$this->add_control(
			'wishlist_icon_a',
			array(
				'label'     => esc_html__( 'Add Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-heart',
					'library' => 'solid',
				),
				'condition' => array(
					'type'      => 'tp_wl_button',
					'wishtype!' => 'tp_wl_text',
				),
			)
		);
		$this->add_control(
			'wishlist_icon_r',
			array(
				'label'     => esc_html__( 'Remove Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-heart',
					'library' => 'solid',
				),
				'condition' => array(
					'type'      => 'tp_wl_button',
					'wishtype!' => 'tp_wl_text',
				),
			)
		);

		$this->end_controls_section();

		/** Woo Wishlist Count Button Section*/
		$this->start_controls_section(
			'section_wwishcountbtn_layout',
			array(
				'label'     => esc_html__( 'Woo WishList Count Button', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->add_control(
			'wishlist_Cnt',
			array(
				'label'     => esc_html__( 'Wishlist Count', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Woo Wishlist Count', 'theplus' ),
				'condition' => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->add_control(
			'count_number',
			array(
				'label'     => esc_html__( 'Count', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 10,
				'step'      => 1,
				'default'   => 0,
				'condition' => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->add_control(
			'cnt_btn_icon',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-recycle',
					'library' => 'solid',
				),
				'condition' => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->add_control(
			'cnt_btn_url',
			array(
				'label'       => esc_html__( 'URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->end_controls_section();

		/** Icon Start*/
		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wl_button',
				),
			)
		);
		$this->add_responsive_control(
			'wl_icon_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wl_icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'wl_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_wl_icon_tab' );
		$this->start_controls_tab(
			'tab_wl_icon_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_icon_ad,{{WRAPPER}} .tp_icon_rm' => 'color:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_wl_icon_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_icon_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_wl_button:hover .tp_icon_ad,{{WRAPPER}} .tp_wl_button:hover .tp_icon_rm' => 'color:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Spinner Start*/
		$this->start_controls_section(
			'section_spinner_styling',
			array(
				'label'     => esc_html__( 'Spinner', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wl_button',
				),
			)
		);
		$this->add_responsive_control(
			'wl_spin_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading, {{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading::after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wl_spin_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading, {{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading::after',
			)
		);
		$this->add_control(
			'wl_spin_fill_clr',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading, {{WRAPPER}} .tp-woo-wishlist .tp-wl-button-loading::after' => 'border-top-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		/** Button Start*/
		$this->start_controls_section(
			'section_Button_styling',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wl_button',
				),
			)
		);
		$this->add_responsive_control(
			'wl_btn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_wishlist_addr,{{WRAPPER}} .tp_wishlist_addrs,{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wl_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_wishlist_addr,{{WRAPPER}} .tp_wishlist_addrs,{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wl_button_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp_wishlist_addr,{{WRAPPER}} .tp_wishlist_addrs,{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp_wishlist_remove' => 'min-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'Ratingalign',
			array(
				'label'     => __( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justify', 'tpebl' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp_wishlist_addr,{{WRAPPER}} .tp-woo-wishlist .tp_wishlist_addrs,{{WRAPPER}} .tp-woo-wishlist .tp_wishlist_button,{{WRAPPER}} .tp-woo-wishlist .tp-wl-active.tp_wishlist_remove' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'wl_btn_typography',
				'selector'  => '{{WRAPPER}} .tp_wishlist_addr .tp_wish_extra,{{WRAPPER}} .tp_wishlist_addrs .tp_wish_extra,{{WRAPPER}} .tp_wishlist_button .tp_wish_extra,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove .tp_wish_extra',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_wl_btn_tab' );
		$this->start_controls_tab(
			'tab_wl_btn_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_btn_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_wishlist_addr,{{WRAPPER}} .tp_wishlist_addrs,{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wl_btn_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wl_btn_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove',
			)
		);
		$this->add_responsive_control(
			'wl_btn_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wl_btn_shadow',
				'selector' => '{{WRAPPER}} .tp_wishlist_button,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_wl_btn_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_btn_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_wishlist_addr:hover,{{WRAPPER}} .tp_wishlist_addrs:hover,{{WRAPPER}} .tp_wishlist_button:hover,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove:hover' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wl_btn_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp_wishlist_button:hover,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wl_btn_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp_wishlist_button:hover,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove:hover',
			)
		);
		$this->add_responsive_control(
			'wl_btn_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp_wishlist_button:hover,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wl_btn_shadow_h',
				'selector' => '{{WRAPPER}} .tp_wishlist_button:hover,{{WRAPPER}} .tp-wl-active.tp_wishlist_remove:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Count Style Start*/
		$this->start_controls_section(
			'section_count_styling',
			array(
				'label'     => esc_html__( 'Count', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'tp_wl_count',
				),
			)
		);
		$this->add_responsive_control(
			'wl_cnt_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'wl_cnt_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'wl_cnt_typography',
				'selector'  => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper a',
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_wl_cnt_tab' );
		$this->start_controls_tab(
			'tab_wl_cnt_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cnt_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper a' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wl_cnt_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wl_cnt_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper',
			)
		);
		$this->add_responsive_control(
			'wl_cnt_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wl_cnt_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_wl_cnt_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cnt_color_h',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper:hover a' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'wl_cnt_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wl_cnt_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'wl_cnt_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wl_cnt_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'wl_cntNum_head',
			array(
				'label'     => esc_html__( 'Number', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'wl_cntNum_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper .tp-wishlist-count' => 'font-size:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_wl_cntNum' );
		$this->start_controls_tab(
			'tab_wl_cntNum_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cntNumClr_Nml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper .tp-wishlist-count' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_wl_cntNum_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cntNumClr_Hvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-wishlist .tp-woo-wishlist-count-wrapper .tp-wishlist-count:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'wl_cntIcon_head',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'wl_cntIcon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp_wl_count .tp-woo-wishlist-count-wrapper > a > i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp_wl_count .tp-woo-wishlist-count-wrapper > a > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_wl_cntIcon' );
		$this->start_controls_tab(
			'tab_wl_cntIcon_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cntIconClr_n',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_wl_count .tp-woo-wishlist-count-wrapper > a > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp_wl_count .tp-woo-wishlist-count-wrapper > a > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_wl_cntIcon_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'wl_cntIconClr_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp_wl_count:hover .tp-woo-wishlist-count-wrapper > a > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp_wl_count:hover .tp-woo-wishlist-count-wrapper > a > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Woo WishList widget load.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$type = ! empty( $settings['type'] ) ? $settings['type'] : 'tp_wl_button';

		$wishtype     = ! empty( $settings['wishtype'] ) ? $settings['wishtype'] : 'tp_wl_texti';
		$wishlist_cnt = ! empty( $settings['wishlist_Cnt'] ) ? $settings['wishlist_Cnt'] : 0;
		$count_number = ! empty( $settings['count_number'] ) ? $settings['count_number'] : 0;

		$wishlist_ttl   = ! empty( $settings['wishlist_ttl'] ) ? $settings['wishlist_ttl'] : '';
		$wishlist_rttl  = ! empty( $settings['wishlist_Rttl'] ) ? $settings['wishlist_Rttl'] : '';
		$wishlist_alttl = ! empty( $settings['wishlist_Alttl'] ) ? $settings['wishlist_Alttl'] : '';

		$wishlist_icon_a = ! empty( $settings['wishlist_icon_a']['value'] ) ? $settings['wishlist_icon_a']['value'] : 'fas fa-heart';
		$wishlist_icon_r = ! empty( $settings['wishlist_icon_r']['value'] ) ? $settings['wishlist_icon_r']['value'] : 'far fa-heart';

		global $product;
		$post_id = get_the_ID();

		$wishlist_attr = array();

		$wishlist_attr['type'] = $type;
		if ( 'tp_wl_text' === $wishtype || 'tp_wl_texti' === $wishtype ) {
			$wishlist_attr['addtext']     = $wishlist_ttl;
			$wishlist_attr['removetext']  = $wishlist_rttl;
			$wishlist_attr['alreadytext'] = $wishlist_alttl;
		}
		$wishlist_attr['wishtype'] = $wishtype;
		$wishlist_attr['addicon']  = $wishlist_icon_a;

		$wishlist_attr['removeicon'] = $wishlist_icon_r;

		$wishlist_attr = htmlspecialchars( wp_json_encode( $wishlist_attr ), ENT_QUOTES, 'UTF-8' );

		$query = ! empty( $settings['query'] ) ? $settings['query'] : 'product';

		$uniquename = 'tpwishlist';
		if ( ! empty( $query ) && 'product' !== $query && ! empty( $settings['uniquename'] ) ) {
			$uniquename = $settings['uniquename'];
		}

		$output = '<div class="tp-woo-wishlist ' . esc_attr( $type ) . ' " data-type="' . esc_attr( $type ) . '" data-wid=' . esc_attr( $uniquename ) . ' data-query=' . esc_attr( $query ) . '>';
		if ( 'tp_wl_button' === $type ) {
			$output .= '<a class="tp_wishlist_button " data-product="' . esc_attr( $post_id ) . '" data-wish="' . esc_attr( $wishlist_attr ) . '" href="#" title="' . esc_attr( $wishlist_ttl ) . '">';
			if ( ! empty( $wishtype ) ) {
				$output .= '<button class="tp_wishlist_addr">';

				if ( 'tp_wl_text' === $wishtype || 'tp_wl_texti' === $wishtype ) {
					$output .= '<span class="tp_wish_extra">' . esc_html( $wishlist_ttl ) . '</span>';
				}
				if ( 'tp_wl_icon' === $wishtype || 'tp_wl_texti' === $wishtype ) {
					$output .= '<i class="tp_icon_rm ' . esc_attr( $wishlist_icon_r ) . '"></i>';
				}

				$output .= '</button>';
			}
			$output .= '</a>';
		} elseif ( 'tp_wl_count' === $type ) {
			$icon = '';
			if ( ! empty( $settings['cnt_btn_icon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['cnt_btn_icon'], array( 'aria-hidden' => 'true' ) );
				$icon = ob_get_contents();
				ob_end_clean();
			}
			if ( ! empty( $settings['cnt_btn_url']['url'] ) ) {
				$this->add_link_attributes( 'button', $settings['cnt_btn_url'] );
			}
			$output .= '<div class="tp-woo-wishlist-count-wrapper">';

			if ( ! empty( $settings['cnt_btn_url']['url'] ) ) {
				$output .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';
			} else {
				$output .= '<a href="#" > ';
			}
					$output .= $icon;
					$output .= esc_attr( $wishlist_cnt ) . '<div class="tp-wishlist-count">' . esc_html( $count_number ) . '</div>';

				$output .= '</a>';

			$output .= '</div>';
		}
		$output .= '</div>';

		echo $output;
	}
}


/**
 * $output .= ''.esc_attr($wishlist_cnt).'<div class="tp-wishlist-count">'.esc_html($count_number).'</div>';
 * $output .= '<div class="tp-woo-compare-count-wrapper tp_wc_count_button" data-count-type="tp_wc_count_button"><a href="#"><i aria-hidden="true" class="fas fa-recycle"></i>Woo Compare Count<div class="tp-woo-compare-count">0</div></a></div>';
*/
