<?php
/**
 * Widget Name: Woo Single Pricing
 * Description: Woo Single Pricing
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use TheplusAddons\Theplus_Element_Load;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Woo_Single_Pricing
 */
class ThePlus_Woo_Single_Pricing extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	
	
	/**
	 * Get Widget Name
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-woo-single-pricing';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Woo Single Pricing', 'theplus' );
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
	 * Get Widget Categories
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Single pricing, woocomerce', 'post', 'product', 'cart', 'add to cart', 'add cart', 'price', 'sale price', 'stock', 'woo stock', 'Sold', 'attributes', 'woo attributes', 'product attributes' );
	}

	/**
	 * Register controls
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Start*/
		$this->start_controls_section(
			'section_woo_single_pricing',
			array(
				'label' => esc_html__( 'Woo Single Pricing', 'theplus' ),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'select',
			array(
				'label'   => esc_html__( 'Select', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'add_to_cart',
				'options' => array(
					'add_to_cart' => esc_html__( 'Add to Cart', 'theplus' ),
					'price'       => esc_html__( 'Price', 'theplus' ),
					'stock'       => esc_html__( 'Stock', 'theplus' ),
					'sold'        => esc_html__( 'Sold', 'theplus' ),
					'attributes'  => esc_html__( 'Attributes', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'display_cart__oty',
			array(
				'label'     => esc_html__( 'Quantity Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout-1',
				'options'   => array(
					'layout-1' => esc_html__( 'Layout 1', 'theplus' ),
					'layout-2' => esc_html__( 'Layout 2', 'theplus' ),
				),
				'condition' => array(
					'select'          => 'add_to_cart',
					'stock_progress!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'dis_before',
			array(
				'label'       => esc_html__( 'Stock Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Availability : ', 'theplus' ),
				'condition'   => array(
					'select'          => 'stock',
					'stock_progress!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'dis_after',
			array(
				'label'       => esc_html__( 'Stock Postfix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( ' In stock', 'theplus' ),
				'condition'   => array(
					'select'          => 'stock',
					'stock_progress!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'stockout',
			array(
				'label'       => esc_html__( 'Out of Stock Notice', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( ' Out of stock', 'theplus' ),
				'condition'   => array(
					'select' => 'stock',
				),
			)
		);
		$repeater->add_control(
			'stockbackorderallow',
			array(
				'label'       => esc_html__( 'Backorders Allowed Notice', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Available on backorder', 'theplus' ),
				'condition'   => array(
					'select' => 'stock',
				),
			)
		);
		$repeater->add_control(
			'stock_progress',
			array(
				'label'     => esc_html__( 'Progress Bar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'select' => 'stock',
				),
			)
		);
		$repeater->add_control(
			'stock_progress_layout',
			array(
				'label'     => esc_html__( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout-1',
				'options'   => array(
					'layout-1' => esc_html__( 'Layout 1', 'theplus' ),
					'layout-2' => esc_html__( 'Layout 2', 'theplus' ),
					'layout-3' => esc_html__( 'Layout 3', 'theplus' ),
					'layout-4' => esc_html__( 'Layout 4', 'theplus' ),
				),
				'condition' => array(
					'select'         => 'stock',
					'stock_progress' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'show_total_count',
			array(
				'label'     => esc_html__( 'Show Total Count', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'select' => 'stock',
					'stock_progress' => 'yes',
					'stock_progress_layout' => array( 'layout-1', 'layout-2' ),
				),
			)
		);
		$repeater->add_control(
			'show_stock_count',
			array(
				'label'     => esc_html__( 'Show Stock Count', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'select' => 'stock',
					'stock_progress' => 'yes',
					'stock_progress_layout' => array( 'layout-1', 'layout-2' ),
				),
			)
		);
		$repeater->add_control(
			'stock_progress_septext',
			array(
				'label'       => esc_html__( 'Separator Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( ' off ', 'theplus' ),
				'condition'   => array(
					'select'                 => 'stock',
					'stock_progress'         => 'yes',
					'stock_progress_layout!' => array( 'layout-3', 'layout-4' ),
				),
			)
		);
		$repeater->add_control(
			'stock_progress_aftertext',
			array(
				'label'       => esc_html__( 'Postfix Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( ' Product is available now.', 'theplus' ),
				'condition'   => array(
					'select'                 => 'stock',
					'stock_progress'         => 'yes',
					'stock_progress_layout!' => array( 'layout-3', 'layout-4' ),
				),
			)
		);
		$repeater->add_control(
			'stock_progress_3_order',
			array(
				'label'       => esc_html__( 'Order Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Ordered : ', 'theplus' ),
				'condition'   => array(
					'select'                => 'stock',
					'stock_progress'        => 'yes',
					'stock_progress_layout' => array( 'layout-3', 'layout-4' ),
				),
			)
		);
		$repeater->add_control(
			'stock_progress_3_available',
			array(
				'label'       => esc_html__( 'Available Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Items available : ', 'theplus' ),
				'condition'   => array(
					'select'                => 'stock',
					'stock_progress'        => 'yes',
					'stock_progress_layout' => array( 'layout-3', 'layout-4' ),
				),
			)
		);
		$repeater->add_control(
			'dis_before_price',
			array(
				'label'       => esc_html__( 'Price Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Price : ', 'theplus' ),
				'condition'   => array(
					'select' => 'price',
				),
			)
		);
		$repeater->add_control(
			'dis_after_price',
			array(
				'label'       => esc_html__( 'Price Postfix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'condition'   => array(
					'select' => 'price',
				),
			)
		);

		$repeater->add_control(
			'sold_before',
			array(
				'label'       => esc_html__( 'Sold Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Sold ', 'theplus' ),
				'condition'   => array(
					'select' => 'sold',
				),
			)
		);
		$repeater->add_control(
			'sold_after',
			array(
				'label'       => esc_html__( 'Sold Postfix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( ' in last hours', 'theplus' ),
				'condition'   => array(
					'select' => 'sold',
				),
			)
		);
		$repeater->add_control(
			'select_attributes_type',
			array(
				'label'     => esc_html__( 'Display', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp_inline_att',
				'options'   => array(
					'tp_inline_att'  => esc_html__( 'Inline', 'theplus' ),
					'tp_newline_att' => esc_html__( 'Block', 'theplus' ),
				),
				'condition' => array(
					'select' => 'attributes',
				),
			)
		);
		$repeater->add_responsive_control(
			'select_attributes_inline_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Label Minimum Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-single-meta.tp_newline_att .tp-woo-sm .tp-woo-sm-label' => 'width: {{SIZE}}{{UNIT}};display: inline-flex;',
				),
				'condition'   => array(
					'select'                 => 'attributes',
					'select_attributes_type' => 'tp_newline_att',
				),
			)
		);
		$repeater->add_control(
			'cattext',
			array(
				'label'       => esc_html__( 'Category Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Category : ', 'theplus' ),
				'condition'   => array(
					'select' => 'attributes',
				),
			)
		);
		$repeater->add_control(
			'tagtext',
			array(
				'label'       => esc_html__( 'Tag Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Tag : ', 'theplus' ),
				'condition'   => array(
					'select' => 'attributes',
				),
			)
		);
		$repeater->add_control(
			'skutext',
			array(
				'label'       => esc_html__( 'SKU Prefix', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'SKU : ', 'theplus' ),
				'condition'   => array(
					'select' => 'attributes',
				),
			)
		);
		$this->add_control(
			'loop_content',
			array(
				'label'       => esc_html__( 'Woo Single Pricing', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'select' => 'add_to_cart',
					),
					array(
						'select' => 'price',
					),
					array(
						'select' => 'stock',
					),
					array(
						'select' => 'sold',
					),
					array(
						'select' => 'attributes',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ select }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
			)
		);
		$this->add_control(
			'display_instock_status',
			array(
				'label'     => esc_html__( 'Add to Cart : Instock Status', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .stock' => 'display: block;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_buttonstyle',
			array(
				'label' => esc_html__( 'Add to Cart : Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'atc_button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'atc_button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'atc_button_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Button Size', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_button_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button',
			)
		);
		$this->start_controls_tabs( 'tabs_atc_button_style' );
		$this->start_controls_tab(
			'tab_atc_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'atcb_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atcb_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atcb_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button',
			)
		);
		$this->add_responsive_control(
			'atcb_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atcb_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_atc_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'atcb_h_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atcb_h_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atcb_h_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button:hover',
			)
		);
		$this->add_responsive_control(
			'atcb_h_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atcb_h_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .single_add_to_cart_button:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_add_to_cart_style',
			array(
				'label' => esc_html__( 'Add to Cart : Simple Product', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'atc_qty',
			array(
				'label' => esc_html__( 'Quantity', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'atc_qty_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.woocommerce  {{WRAPPER}}  .tp-woo-add-to-cart .quantity .qty,
					{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .cart .quantity' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_qty_typography',
				'selector' => '.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty',
			)
		);
		$this->add_control(
			'atc_qty_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atc_qty_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atc_qty_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty',
			)
		);
		$this->add_responsive_control(
			'atc_qty_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atc_qty_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.woocommerce  {{WRAPPER}} .tp-woo-add-to-cart .quantity .qty',
			)
		);

		$this->add_control(
			'product_qty_pm_heading',
			array(
				'label'     => esc_html__( 'Quantity Plus Minus Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'display_cart__oty' => 'layout-2',
				),
			)
		);
		$this->add_responsive_control(
			'product_qty_pm_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 30,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity .tp-quantity-arrow' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'display_cart__oty' => 'layout-2',
				),
			)
		);
		$this->add_control(
			'product_qty_pm_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity .tp-quantity-arrow' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'display_cart__oty' => 'layout-2',
				),
			)
		);
		$this->add_control(
			'product_qty_w_heading',
			array(
				'label'     => esc_html__( 'Quantity Box Options (Layout 2)', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'p_qty_w_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'p_qty_w_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'p_qty_w_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity',
			)
		);
		$this->add_responsive_control(
			'p_qty_w_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'p_qty_w_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing.layout-2 .tp-woo-add-to-cart .cart .quantity',
			)
		);

		$this->add_control(
			'atc_stock',
			array(
				'label'     => esc_html__( 'Stock', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_stock_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .stock',
			)
		);
		$this->add_control(
			'atc_stock_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .stock' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'atc_ostock',
			array(
				'label'     => esc_html__( 'Out of Stock', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_ostock_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .stock.out-of-stock',
			)
		);
		$this->add_control(
			'atc_ostock_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-add-to-cart .stock.out-of-stock' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_varation_style',
			array(
				'label' => esc_html__( 'Add to Cart : Variations Product', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'atc_gp_variations_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'atc_gp_variations_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'atc_gp_variations_bg',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart',
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atc_gp_variations_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart',
			)
		);
		$this->add_responsive_control(
			'atc_gp_variations_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atc_gp_variations_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart',
			)
		);
		$this->add_control(
			'atc_gp_var_label',
			array(
				'label'     => esc_html__( 'Variations Product Label', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_gp_var_label_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.label,{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations th.label',
			)
		);
		$this->add_control(
			'atc_gp_var_label_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.label,{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations th.label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'atc_gp_var_option',
			array(
				'label'     => esc_html__( 'Variations Product Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_gp_var_option_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value select',
			)
		);
		$this->add_control(
			'atc_gp_var_option_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value select' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atc_gp_var_option_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value select',
			)
		);
		$this->add_control(
			'atc_gp_var_reset',
			array(
				'label'     => esc_html__( 'Variations Product Reset', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'atc_gp_var_reset_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations',
			)
		);
		$this->start_controls_tabs( 'tabs_atc_gp_var_reset_style' );
		$this->start_controls_tab(
			'tab_atc_gp_var_reset_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'atc_gp_var_reset_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations',
			)
		);
		$this->add_responsive_control(
			'atc_gp_var_reset_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_atc_gp_var_reset_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'atc_gp_var_reset_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_bg_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations:hover',
			)
		);
		$this->add_responsive_control(
			'atc_gp_var_reset_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'atc_gp_var_reset_shadow_h',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .variations td.value .reset_variations:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'atc_gp_var_price',
			array(
				'label'     => esc_html__( 'Variations Product Price', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_gp_var_price_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .single_variation_wrap .woocommerce-variation-price span',
			)
		);
		$this->add_control(
			'atc_gp_var_price_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .single_variation_wrap .woocommerce-variation-price span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'atc_gp_var_description',
			array(
				'label'     => esc_html__( 'Variations Product Description', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'atc_gp_var_description_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .single_variation_wrap .woocommerce-variation-description',
			)
		);
		$this->add_control(
			'atc_gp_var_description_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .variations_form.cart .single_variation_wrap .woocommerce-variation-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_swatches_style',
			array(
				'label' => esc_html__( 'Add to Cart : Swatches Product', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'swatchesloop',
			array(
				'label'       => esc_html__( 'Custom Loop Skin', 'theplus' ),
				'description' => esc_html__( 'Note : If this option enabled, You can use this in Custom Loop Skip feature and It will load required js and CSS related to WooCommerce for that.', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
			)
		);
		$this->add_control(
			'swatcheslayout',
			array(
				'label'   => esc_html__( 'Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => array(
					'default' => esc_html__( 'Default', 'theplus' ),
					'inline'  => esc_html__( 'Inline', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'swatchesstyle',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'   => esc_html__( 'Default', 'theplus' ),
					'withtitle' => esc_html__( 'With Title', 'theplus' ),
					'tooltip'   => esc_html__( 'Tooltip', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'swatches_title_style',
			array(
				'label'     => esc_html__( 'Title Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'swatchesstyle' => 'withtitle',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'swatches_title_typography',
				'selector'  => '{{WRAPPER}} .tp-woo-swatches .tp-swatches-tooltip',
				'condition' => array(
					'swatchesstyle' => 'withtitle',
				),
			)
		);
		$this->add_control(
			'swatches_title_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000ad',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches-tooltip' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'swatchesstyle' => 'withtitle',
				),
			)
		);
		$this->add_control(
			'swatches_tooltip_style',
			array(
				'label'     => esc_html__( 'Tooltip Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'swatchesstyle' => 'tooltip',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'swatches_tooltip_typography',
				'selector'  => '{{WRAPPER}} .swatchesstyletooltip .tp-woo-swatches .tp-swatches-tooltip',
				'condition' => array(
					'swatchesstyle' => 'tooltip',
				),
			)
		);
		$this->add_control(
			'swatches_tooltip_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swatchesstyletooltip .tp-woo-swatches .tp-swatches-tooltip' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'swatchesstyle' => 'tooltip',
				),
			)
		);
		$this->add_control(
			'swatches_tooltip_bg',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .swatchesstyletooltip .tp-woo-swatches .tp-swatches-tooltip,
				{{WRAPPER}} .swatchesstyletooltip .tp-woo-swatches .tp-swatches-tooltip:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'swatchesstyle' => 'tooltip',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_tooltip_border',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Radius', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .swatchesstyletooltip .tp-woo-swatches .tp-swatches-tooltip' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'swatchesstyle' => 'tooltip',
				),
			)
		);
		$this->add_control(
			'swatches_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'swatches_color_size',
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
					'{{WRAPPER}}  .tp-woo-swatches .tp-swatches.tp-swatches-color' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_color_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Right', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_color_space_bottom',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Bottom', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_swatches_color_style' );
		$this->start_controls_tab(
			'tab_swatches_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_color_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color',
			)
		);
		$this->add_responsive_control(
			'swatches_color_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_color_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_swatches_color_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_color_border_a',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color.selected',
			)
		);
		$this->add_responsive_control(
			'swatches_color_br_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color.selected' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_color_shadow_a',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-color.selected',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'swatches_image',
			array(
				'label'     => esc_html__( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'swatches_image_size',
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
					'{{WRAPPER}}  .tp-woo-swatches .tp-swatches.tp-swatches-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_image_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Right', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_image_space_bottom',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Bottom', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_swatches_image_style' );
		$this->start_controls_tab(
			'tab_swatches_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_image_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image img',
			)
		);
		$this->add_responsive_control(
			'swatches_image_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_image_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_swatches_image_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_image_border_a',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image.selected img',
			)
		);
		$this->add_responsive_control(
			'swatches_image_br_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image.selected img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_image_shadow_a',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-image.selected img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'swatches_button',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'swatches_button_typography',
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button',
			)
		);
		$this->add_responsive_control(
			'swatches_button_size',
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
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_button_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Right', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'swatches_button_space_bottom',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset Bottom', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_swatches_button_style' );
		$this->start_controls_tab(
			'tab_swatches_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'swatches_button_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'swatches_button_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_button_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button',
			)
		);
		$this->add_responsive_control(
			'swatches_button_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_button_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_swatches_button_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'swatches_button_color_a',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button.selected' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'swatches_button_bg_a',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button.selected',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swatches_button_border_a',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button.selected',
			)
		);
		$this->add_responsive_control(
			'swatches_button_br_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button.selected' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swatches_button_shadow_a',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-swatches .tp-swatches.tp-swatches-button.selected',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_grouped_style',
			array(
				'label' => esc_html__( 'Add to Cart : Grouped Product', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'atc_grouped_pro_name',
			array(
				'label' => esc_html__( 'Product Name', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'grouped_pro_name_typography',
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item__label a',
			)
		);
		$this->add_control(
			'grouped_pro_name_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item__label a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'grouped_pro_price',
			array(
				'label'     => esc_html__( 'Price', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'grouped_pro_price_typography',
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item__price',
			)
		);
		$this->add_control(
			'grouped_pro_price_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item__price' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'grouped_pro_button',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'grouped_pro_button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'grouped_pro_button_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'grouped_pro_button_typography',
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable',
			)
		);
		$this->start_controls_tabs( 'tabs_gpb_button_style' );
		$this->start_controls_tab(
			'tab_gpb_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'gpb_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'gpb_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'gpb_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable',
			)
		);
		$this->add_responsive_control(
			'gpb_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'gpb_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_gpb_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'gpb_h_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'gpb_h_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'gpb_h_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable:hover',
			)
		);
		$this->add_responsive_control(
			'gpb_h_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'gpb_h_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-add-to-cart.grouped .woocommerce-grouped-product-list-item .woocommerce-grouped-product-list-item__quantity .product_type_variable:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			array(
				'label' => esc_html__( 'Price', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'price_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price' => 'justify-content : {{VALUE}}',
				),
				'default'     => 'left',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_responsive_control(
			'price_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Space', 'theplus' ),
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
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price del>.woocommerce-Price-amount.amount:nth-child(1),
					{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price .woocommerce-Price-amount.amount:nth-child(1) bdi' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price .woocommerce-Price-amount.amount:nth-child(2) bdi' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'sale_price',
			array(
				'label'     => esc_html__( 'Sale Price', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sale_price_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price ins .woocommerce-Price-amount,
				{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price .woocommerce-Price-amount',
			)
		);
		$this->add_control(
			'sale_price_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price ins,{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price ins .woocommerce-Price-amount,{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price,{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price .woocommerce-Price-amount' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'previous_price',
			array(
				'label'     => esc_html__( 'Previous Price', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'previous_price_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price del .woocommerce-Price-amount',
			)
		);
		$this->add_control(
			'previous_price_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price del,{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'ba_text_price',
			array(
				'label'     => esc_html__( 'Prefix/Postfix Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'ba_text_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .tp-woo-price-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ba_text_price_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .tp-woo-price-text',
			)
		);
		$this->add_control(
			'ba_text_price_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-price .tp-woo-price-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_stock_style',
			array(
				'label' => esc_html__( 'Stock', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'stock_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'stock_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'stock_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock',
			)
		);
		$this->add_control(
			'stock_color',
			array(
				'label'     => esc_html__( 'Stock Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'stock_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'stock_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock',
			)
		);
		$this->add_responsive_control(
			'stock_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'stock_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock',
			)
		);
		$this->add_control(
			'out_of_stock_opt',
			array(
				'label'     => esc_html__( 'Out Of Stock', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'outofstock_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'outofstock_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'outofstock_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out',
			)
		);
		$this->add_control(
			'outofstock_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'outofstock_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'outofstock_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out',
			)
		);
		$this->add_responsive_control(
			'outofstock_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'outofstock_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-stock.tp-woo-stock-out',
			)
		);
		$this->end_controls_section();

		/* Stock-Progress Style Start */
		$this->start_controls_section(
			'section_stock_progress_style',
			array(
				'label' => esc_html__( 'Stock Progress', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'sp_text_heading',
			array(
				'label' => esc_html__( 'Text', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sp_text_typography',
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar-ab-text',
			)
		);
		$this->add_control(
			'sp_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar-ab-text' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_responsive_control(
			'sp_text_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar-ab-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'sp_text_postfix_heading',
			array(
				'label'     => esc_html__( 'Postfix Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'sp_text_postfix_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar-ab-text .tp-progress-bar-ab-text-qty' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_control(
			'sp_text_progress_heading',
			array(
				'label'     => esc_html__( 'Progress', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'spt_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 25,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'spt_fill_color',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar .tp-progress-bar-inner' => 'background: {{VALUE}}',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'spt_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'spt_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar',
			)
		);
		$this->add_responsive_control(
			'spt_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'spt_br_iiner',
			array(
				'label'      => esc_html__( 'Inner Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar .tp-progress-bar-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'spt_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress .tp-progress-bar',
			)
		);
		$this->add_control(
			'sp_box_heading',
			array(
				'label'     => esc_html__( 'Box', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'sp_box_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-stock-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sp_box_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sp_box_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress',
			)
		);
		$this->add_responsive_control(
			'sp_box_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-stock-progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sp_box_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-stock-progress',
			)
		);
		$this->end_controls_section();
		/* Stock-Progress Style End */

		$this->start_controls_section(
			'section_sold_style',
			array(
				'label' => esc_html__( 'Sold', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'sold_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'sold_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sold_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product',
			)
		);
		$this->add_control(
			'sold_color',
			array(
				'label'     => esc_html__( 'Sold Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sold_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sold_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product',
			)
		);
		$this->add_responsive_control(
			'sold_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'sold_shadow',
				'selector' => '{{WRAPPER}} .tp-woo-single-pricing .tp-woo-sold-product',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_attributes_style',
			array(
				'label' => esc_html__( 'Attributes', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'attributes_label',
			array(
				'label' => esc_html__( 'Label', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'attributes_label_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-label',
			)
		);
		$this->add_control(
			'attributes_label_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'attributes_value',
			array(
				'label'     => esc_html__( 'Value', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'attributes_value_typography',
				'selector' => '{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-value',
			)
		);
		$this->start_controls_tabs( 'tabs_attributes_value_style' );
		$this->start_controls_tab(
			'tab_attributes_value_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'attributes_value_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-value,{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-value a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_attributes_value_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'attributes_value_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-value:hover,{{WRAPPER}} .tp-woo-single-meta .tp-woo-sm .tp-woo-sm-value:hover a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Woo Single Pricing
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$loop_content = $settings['loop_content'];
		if ( class_exists( 'woocommerce' ) ) {
			global $product;
			$product = wc_get_product();

			if ( empty( $product ) ) {
				return;
			}

			if ( ! empty( $loop_content ) ) {
				foreach ( $loop_content as $item ) {
					$select = ! empty( $item['select'] ) ? $item['select'] : 'add_to_cart';

					/** Add-to-cart Start*/
					$swatcheslayout = ! empty( $settings['swatcheslayout'] ) ? $settings['swatcheslayout'] : 'inline';
					$swatchesstyle  = ! empty( $settings['swatchesstyle'] ) ? $settings['swatchesstyle'] : 'default';

					if ( ! empty( $select ) && 'add_to_cart' === $select ) {
						$display_cart__oty = ! empty( $item['display_cart__oty'] ) ? $item['display_cart__oty'] : 'layout-1'; ?>

						<div class="tp-woo-single-pricing <?php echo esc_attr( $display_cart__oty ); ?>">
							<div class="tp-woo-add-to-cart <?php echo esc_attr( wc_get_product()->get_type() ); ?> swatcheslayout<?php echo esc_attr( $swatcheslayout ); ?> swatchesstyle<?php echo esc_attr( $swatchesstyle ); ?>">
								<?php woocommerce_template_single_add_to_cart(); ?>
							</div>
						</div> 
						<?php
					}

					/** Stock Start*/
					if ( ! empty( $select ) && 'stock' === $select ) {
						if ( 'simple' === $product->get_type() && $product->get_stock_quantity() > 0 && ! empty( $product->managing_stock() ) && $product->managing_stock() == 1 ) {

							$stock_progress             = isset( $item['stock_progress'] ) ? $item['stock_progress'] : '';
							$stock_progress_layout      = ! empty( $item['stock_progress_layout'] ) ? $item['stock_progress_layout'] : 'layout-1';
							$stock_progress_septext     = ! empty( $item['stock_progress_septext'] ) ? $item['stock_progress_septext'] : '';
							$stock_progress_aftertext   = ! empty( $item['stock_progress_aftertext'] ) ? $item['stock_progress_aftertext'] : '';
							$stock_progress_3_order     = ! empty( $item['stock_progress_3_order'] ) ? $item['stock_progress_3_order'] : '';
							$stock_progress_3_available = ! empty( $item['stock_progress_3_available'] ) ? $item['stock_progress_3_available'] : '';
							$show_total_count = ! empty( $item['show_total_count'] ) ? $item['show_total_count'] : '';
							$show_stock_count = ! empty( $item['show_stock_count'] ) ? $item['show_stock_count'] : '';

							if ( $stock_progress ) {
								$units_sold_qty = $product->get_total_sales();
								$settotalquant     = $units_sold_qty + $product->get_stock_quantity();

								$totalquant = '';
								$stockquant = '';
								if( $show_total_count ){
									$totalquant = $units_sold_qty + $product->get_stock_quantity();
								}
								if( $show_stock_count ){
									$stockquant = $product->get_stock_quantity();
								}

								if ( $units_sold_qty > 0 && ! empty( $product->get_stock_quantity() ) && ! empty( $stock_progress_layout ) ) {
									?>
									<div class="tp-woo-stock-progress <?php echo $stock_progress_layout; ?>"> 
										<?php
										if ( 'layout-1' === $stock_progress_layout || 'layout-2' === $stock_progress_layout ) {
										?>
											<div class="tp-progress-bar-ab-text">
												<?php echo '<span class="tp-progress-bar-ab-text-qty">' . $totalquant . esc_html( $stock_progress_septext ) . $stockquant . '</span>' . $stock_progress_aftertext; ?>
											</div>
											<div class="tp-progress-bar" data-total-qty="<?php echo $settotalquant; ?>" data-total-sale="<?php echo $units_sold_qty; ?>">
												<div class="tp-progress-bar-inner"></div>
											</div>
										<?php
										} elseif ( 'layout-3' === $stock_progress_layout || 'layout-4' === $stock_progress_layout ) {
										?>
											<div class="tp-progress-bar-ab-text">
												<?php echo '<div class="tp-progress-bar-ab-text-wrap1">' . esc_html( $stock_progress_3_order ) . '<span class="tp-progress-bar-ab-text-qty">' . $units_sold_qty . '</span></div> <div class="tp-progress-bar-ab-text-wrap2">' . esc_html( $stock_progress_3_available ) . '<span class="tp-progress-bar-ab-text-qty">' . $product->get_stock_quantity() . '</span></div>'; ?>
											</div>
											<div class="tp-progress-bar" data-total-qty="<?php echo $settotalquant; ?>" data-total-sale="<?php echo $units_sold_qty; ?>">
												<div class="tp-progress-bar-inner"></div>
											</div>
										<?php
										}
										?>
									</div>
									<?php
								}
							} else {
								?>
								<div class="tp-woo-single-pricing">
									<div class="tp-woo-stock">
										<?php
											$dis_before = ! empty( $item['dis_before'] ) ? $item['dis_before'] : 'Availability';
											$dis_after  = ! empty( $item['dis_after'] ) ? $item['dis_after'] : ' In stock';

											echo esc_attr( $dis_before ) . $product->get_stock_quantity() . esc_attr( $dis_after );
										?>
									</div>
								</div>
								<?php
							}
						} elseif ( 'simple' === $product->get_type() && $product->get_stock_quantity() === 0 && ! empty( $product->get_stock_status() ) && ( 'outofstock' === $product->get_stock_status() || 'onbackorder' === $product->get_stock_status() ) ) {
							?>
							<div class="tp-woo-single-pricing">
								<div class="tp-woo-stock tp-woo-stock-out">
									<?php
										$stockout = ! empty( $item['stockout'] ) ? $item['stockout'] : ' Out of stock';

									if ( $product->backorders_allowed() ) {
										$stockout = ! empty( $item['stockbackorderallow'] ) ? $item['stockbackorderallow'] : 'Available on backorder';
									}
										echo esc_attr( $stockout );
									?>
								</div>
							</div>
							<?php
						} elseif ( 'variable' === $product->get_type() && $product->get_stock_quantity() > 0 ) {
							?>
							<div class="tp-woo-single-pricing">
								<div class="tp-woo-stock">
									<?php
										$dis_before = ! empty( $item['dis_before'] ) ? $item['dis_before'] : '';
										$dis_after  = ! empty( $item['dis_after'] ) ? $item['dis_after'] : '';

										echo esc_attr( $dis_before ) . $product->get_stock_quantity() . esc_attr( $dis_after );
									?>
								</div>
							</div> 
							<?php
						}
					}

					/** Sold Start*/
					if ( ! empty( $select ) && 'sold' === $select ) {
						$units_sold = $product->get_total_sales();
						if ( $units_sold ) {
							?>
							<div class="tp-woo-single-pricing">
								<div class="tp-woo-sold-product"> 
								<?php
									$sold_before = ! empty( $item['sold_before'] ) ? $item['sold_before'] : '';
									$sold_after  = ! empty( $item['sold_after'] ) ? $item['sold_after'] : '';

									echo '<div>' . sprintf( __( '' . esc_attr( $sold_before ) . ' %s ' . esc_attr( $sold_after ) . '', 'theplus' ), $units_sold ) . '</div>';
								?>
								</div>
							</div> 
							<?php
						}
					}

					/** Price Start*/
					if ( ! empty( $select ) && 'price' === $select ) {
						$dis_before_price = ! empty( $item['dis_before_price'] ) ? $item['dis_before_price'] : '';
						$dis_after_price  = ! empty( $item['dis_after_price'] ) ? $item['dis_after_price'] : '';
						?>
						<div class="tp-woo-single-pricing">
							<div class="tp-woo-price"> 
								<?php
								if ( ! empty( $dis_before_price ) ) {
									?>
										<span class="tp-woo-price-text">
										<?php echo wp_kses_post( $dis_before_price ); ?></span> 
													<?php
								}
								?>
									 

								<?php
									woocommerce_template_single_price();

								if ( ! empty( $dis_after_price ) ) {
									?>
										<span class="tp-woo-price-text">
											<?php echo wp_kses_post( $dis_after_price ); ?>
										</span> 
										<?php
								}
								?>
							</div>
						</div> 
						<?php
					}

					/** Attributes Start*/
					if ( ! empty( $select ) && 'attributes' === $select ) {
						echo '<div class="tp-woo-single-meta ' . esc_attr( $item['select_attributes_type'] ) . '">';
						/** SKU Start*/
						if ( ! empty( $product->get_sku() ) ) {
							echo '<div class="tp-woo-sm tp-woo-sm-sku">';

							if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
								echo '<span class="tp-woo-sm-label tp-woo-sm-sku-label">' . esc_html( $item['skutext'] ) . '</span>';
								echo '<span class="tp-woo-sm-value tp-woo-sm-sku-value">' . $sku = $product->get_sku() . '</span>';
							}

							echo '</div>';
						}

						/** Category Start*/
						if ( ! empty( wc_get_product_category_list( $product->get_id() ) ) ) {
							echo '<div class="tp-woo-sm tp-woo-sm-category">';
								echo '<span class="tp-woo-sm-label tp-woo-sm-category-label">' . esc_html( $item['cattext'] ) . '</span>';
								echo '<span class="tp-woo-sm-value tp-woo-sm-category-value">' . wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"></span>' ) . '</span>';
							echo '</div>';
						}

						/* Tag Start*/
						if ( ! empty( wc_get_product_tag_list( $product->get_id() ) ) ) {
							echo '<div class="tp-woo-sm tp-woo-sm-tag">';
								echo '<span class="tp-woo-sm-label tp-woo-sm-tag-label">' . esc_html( $item['tagtext'] ) . '</span>';
								echo '<span class="tp-woo-sm-value tp-woo-sm-tag-value">' . wc_get_product_tag_list( $product->get_id(), ', ' ) . '</span>';
							echo '</div>';
						}
						echo '</div>';
					}
				}
			}
		}
	}
}
