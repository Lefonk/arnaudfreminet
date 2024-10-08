<?php
/**
 * Widget Name: Woo Multi Step
 * Description: Woo Multi Step
 * Author: Posimyth
 * Author URI: http://posimyth.com
 *
 * @package WooMultiStep
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use TheplusAddons\Theplus_Element_Load;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Woo Multi Step Main Elementor Class
 */
class ThePlus_Woo_Multi_Step extends Widget_Base {

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
		return 'tp-woo-multi-step';
	}

	/**
	 * Widget title.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Woo Multi Step', 'theplus' );
	}

	/**
	 * Widget Icon.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_icon() {
		return 'fa fa-multistep theplus_backend_icon';
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
	 * Widget categories.
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_categories() {
		return array( 'plus-woo-builder' );
	}

	/**
	 * Widget search key words
	 *
	 * @since 5.5.4
	 * @access public
	 */
	public function get_keywords() {
		return array( 'checkout page', 'checkout', 'WooCommerce', 'woo checkout', 'multi step', 'login', 'theplus', 'tp' );
	}

	/**
	 * Register Woo Multi step.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	protected function register_controls() {

		/** Content Section Start */
		$this->start_controls_section(
			'msc_contL_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
			)
		);
		$this->add_control(
			'mscStyle',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'mscStyleLayout',
			array(
				'label'     => esc_html__( 'Layout', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'msc-stl-hzt',
				'options'   => array(
					'msc-stl-hzt' => esc_html__( 'Horizontal', 'theplus' ),
					'msc-stl-vrt' => esc_html__( 'Vertical', 'theplus' ),
				),
				'condition' => array(
					'mscStyle' => 'style-5',
				),
			)
		);
		$this->end_controls_section();

		/** Content Section End*/

		/** Navigation Section Start*/
		$this->start_controls_section(
			'msc_Nav_section',
			array(
				'label' => esc_html__( 'Navigation', 'theplus' ),
			)
		);
		$this->add_control(
			'login_switch',
			array(
				'label'     => esc_html__( 'Login Tab', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
			)
		);
		$this->add_control(
			'loginText',
			array(
				'label'     => esc_html__( 'Login', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Login', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'logedinText',
			array(
				'label'     => esc_html__( 'Logged In', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'You have already logged in', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'hide_coupon_switch',
			array(
				'label'     => esc_html__( 'Hide Coupon Tab', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
			)
		);
		$this->add_control(
			'coupnText',
			array(
				'label'     => esc_html__( 'Coupon', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Coupon', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'hide_coupon_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'bilSipText',
			array(
				'label'   => esc_html__( 'Billing', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Billing', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'paymntText',
			array(
				'label'   => esc_html__( 'Payment', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Payment', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/** Preview Section Start*/
		$this->start_controls_section(
			'msc_preview_layout',
			array(
				'label' => esc_html__( 'Preview', 'theplus' ),
			)
		);
		$this->add_control(
			'mscBackendPrevL',
			array(
				'label'     => esc_html__( 'Preview', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mscplogin',
				'options'   => array(
					'mscplogin'   => esc_html__( 'Login', 'theplus' ),
					'mscpcoupon'  => esc_html__( 'Coupon', 'theplus' ),
					'mscpbilling' => esc_html__( 'Billing', 'theplus' ),
					'mscppayment' => esc_html__( 'Payment', 'theplus' ),
				),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'mscBackendPrev',
			array(
				'label'     => esc_html__( 'Preview', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mscpcoupon',
				'options'   => array(
					'mscpcoupon'  => esc_html__( 'Coupon', 'theplus' ),
					'mscpbilling' => esc_html__( 'Billing', 'theplus' ),
					'mscppayment' => esc_html__( 'Payment', 'theplus' ),
				),
				'condition' => array(
					'login_switch!'       => 'yes',
					'hide_coupon_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'mscBackendPrevB',
			array(
				'label'     => esc_html__( 'Preview', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mscpbilling',
				'options'   => array(
					'mscpbilling' => esc_html__( 'Billing', 'theplus' ),
					'mscppayment' => esc_html__( 'Payment', 'theplus' ),
				),
				'condition' => array(
					'login_switch!'      => 'yes',
					'hide_coupon_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Login Section Start*/
		$this->start_controls_section(
			'msc_login_layout',
			array(
				'label'     => esc_html__( 'Login', 'theplus' ),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'lgnRetrnUser',
			array(
				'label'     => esc_html__( 'User', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Returning customer?', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'lgnUser',
			array(
				'label'     => esc_html__( 'User Login', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Click here to login', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'lgnMessage',
			array(
				'label'     => esc_html__( 'Login Message', 'theplus' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Billing Section Start*/
		$this->start_controls_section(
			'msc_billing_layout',
			array(
				'label' => esc_html__( 'Billing/Shipping', 'theplus' ),
			)
		);
		$this->add_control(
			'msc_billing_message',
			array(
				'label'   => esc_html__( 'Error Postfix', 'theplus' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 3,
				'default' => esc_html__( 'Is A Required Field', 'theplus' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'hide_order_notes_in_billing',
			array(
				'label'     => esc_html__( 'Hide Order Notes', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
			)
		);
		$this->end_controls_section();

		/** Payment Section Start*/
		$this->start_controls_section(
			'msc_pymnt_layout',
			array(
				'label' => esc_html__( 'Payment', 'theplus' ),
			)
		);
		$this->add_control(
			'plcOrder',
			array(
				'label'   => esc_html__( 'Place Order', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Place Order', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/**Order Section Start*/
		$this->start_controls_section(
			'msc_order_layout',
			array(
				'label' => esc_html__( 'Order', 'theplus' ),
			)
		);
		$this->add_control(
			'yrOrder',
			array(
				'label'   => esc_html__( 'Your Order', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Order', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'go_to_cart_page',
			array(
				'label'     => esc_html__( 'Cart Page Link', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'cart_page_text',
			array(
				'label'     => esc_html__( 'Cart Link Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Go to Cart Page', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'go_to_cart_page' => 'yes',
				),
			)
		);
		$this->add_control(
			'cart_icon_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'default'   => 'cart_icon_position_a',
				'options'   => array(
					'cart_icon_position_b' => esc_html__( 'Before', 'theplus' ),
					'cart_icon_position_a' => esc_html__( 'After', 'theplus' ),
				),
				'condition' => array(
					'go_to_cart_page' => 'yes',
				),
			)
		);
		$this->add_control(
			'cart_icon_select',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-cart-arrow-down',
					'library' => 'solid',
				),
				'condition' => array(
					'go_to_cart_page' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		/* Order Section End */

		/** Style Sections Start */
		/* Navigation Style Start */
		$this->start_controls_section(
			'msc_Nav_style',
			array(
				'label' => esc_html__( 'Navigation', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'NavheadHeading',
			array(
				'label'     => esc_html__( 'Heading', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'navheadTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav .tp-msc-step span',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_navhead_text' );
		$this->start_controls_tab(
			'tab_msc_navhead_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'navheadTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav .tp-msc-step' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'navheadBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'navheadBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav',
			)
		);
		$this->add_responsive_control(
			'navheadBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'navheadBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navhead_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'navheadTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav:hover .tp-msc-step' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'navheadBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'navheadBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav:hover',
			)
		);
		$this->add_responsive_control(
			'navheadBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'navheadBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'NavnumHeading',
			array(
				'label'     => esc_html__( 'Number', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'NavheadSize',
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
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before' => 'font-size:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_msc_navnum_text' );
		$this->start_controls_tab(
			'tab_msc_navnum_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'navnumClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav .tp-msc-step:before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'navnumBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav .tp-msc-step:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'navnumBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav .tp-msc-step:before',
			)
		);
		$this->add_responsive_control(
			'navnumBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav .tp-msc-step:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'navnumBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav .tp-msc-step:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navnum_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'navnumTextClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps:hover > .tp-msc-step > span:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav:hover .tp-msc-step:before' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'navnumBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps:hover > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav:hover .tp-msc-step:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'navnumBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps:hover > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav:hover .tp-msc-step:before',
			)
		);
		$this->add_responsive_control(
			'navnumBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps:hover > .tp-msc-step > span:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav:hover .tp-msc-step:before,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav:hover .tp-msc-step:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'navnumBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps:hover > .tp-msc-step > span:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav:hover .tp-msc-step:before,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav:hover .tp-msc-step:before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'NavlineHeading',
			array(
				'label'     => esc_html__( 'Line', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_msc_navline_text' );
		$this->start_controls_tab(
			'tab_msc_navline_text_n',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navlineHgtNml',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
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
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav-steps .tp-msc-step:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step:after' => 'height:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navlineClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-nav-steps .tp-msc-step:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step:after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navline_text_h',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navlineHgtHvr',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
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
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active + .tp-msc-step:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after' => 'height:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navlineClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active + .tp-msc-step:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active:after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navlineD_text_h',
			array(
				'label'     => esc_html__( 'Done', 'theplus' ),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navlineDHgtHvr',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
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
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done + .tp-msc-step:after,
					{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done:after,{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done:after' => 'height:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navlineClrDHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-1 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done + .tp-msc-step:after,{{WRAPPER}} .tp-multi-step-wrapper.style-3 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done:after,{{WRAPPER}} .tp-multi-step-wrapper.style-4 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done:after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle!' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'Navlinerect',
			array(
				'label'     => esc_html__( 'Rectangle', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_msc_navrect_text' );
		$this->start_controls_tab(
			'tab_msc_navrect_text_n',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navrectClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'navrectBgNml',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'navrectBdrNml',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step,{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navrectBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'navrectBgsdNml',
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navrect_text_h',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navrectClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-active,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-active,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-active' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'navrectBgHvr',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-active,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-active',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'navrectBdrHvr',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-active,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-active',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navrectBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-active,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'navrectBgsdHvr',
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-active,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-active',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_navrectD_text_D',
			array(
				'label'     => esc_html__( 'Done', 'theplus' ),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_control(
			'navrectClrD',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-done,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-done' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'navrectBgD',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-done',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'navrectBdrD',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-done',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_responsive_control(
			'navrectBdrsD',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-done,
					{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-done' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'navrectBgsdD',
				'selector'  => '{{WRAPPER}} .tp-multi-step-wrapper.style-2 .tp-multi-step-nav-steps .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step.tp-msc-step-done,
				{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-vrl .tp-msc-step.tp-msc-step-done',
				'condition' => array(
					'mscStyle' => array( 'style-2', 'style-5' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'Navheadarrow',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'mscStyle'       => 'style-5',
					'mscStyleLayout' => 'msc-stl-hzt',
				),
			)
		);
		$this->add_responsive_control(
			'navarrowBdrwidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step-active:after' => 'width:{{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mscStyle'       => 'style-5',
					'mscStyleLayout' => 'msc-stl-hzt',
				),
			)
		);
		$this->add_control(
			'navarrowBdrClr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper.style-5 .tp-multi-step-nav-steps.plus-hzl .tp-msc-step-active:after' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'mscStyle'       => 'style-5',
					'mscStyleLayout' => 'msc-stl-hzt',
				),
			)
		);
		$this->end_controls_section();
		/* Navigation Style End */

		/* Login Style Start */
		$this->start_controls_section(
			'msc_Login_style',
			array(
				'label'     => esc_html__( 'Login', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'login_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'lgnTxtmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content .tp-multi-step-content-left .tp-msc-login-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'lgnTxtpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content .tp-multi-step-content-left .tp-msc-login-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'lgnTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper,{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper span,{{WRAPPER}}.tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper p.lost_password a',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_lgn_text' );
		$this->start_controls_tab(
			'tab_msc_lgn_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'lgnTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper,
					{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper span,
					{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper .lost_password a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'lgnBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'lgnBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper',
			)
		);
		$this->add_responsive_control(
			'lgnBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lgnBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_lgn_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'lgnTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover,
					{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover span,
					{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover lost_password a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'lgnBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'lgnBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'lgnBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'lgnBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-login-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Billing Style Start*/
		$this->start_controls_section(
			'msc_Billing_style',
			array(
				'label' => esc_html__( 'Billing/Shipping', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'billMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-biliing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'billPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-biliing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'billHeading',
			array(
				'label'     => esc_html__( 'Heading', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'billHeadTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_billhead_text' );
		$this->start_controls_tab(
			'tab_msc_billhead_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'billheadTextClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'billheadBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'billheadBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3',
			)
		);
		$this->add_responsive_control(
			'billheadBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'billheadBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_billhead_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'billheadTextClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'billheadBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'billheadBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3:hover',
			)
		);
		$this->add_responsive_control(
			'billheadBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'billheadBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .woocommerce-billing-fields h3:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'billlabelHeading',
			array(
				'label'     => esc_html__( 'Label', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'billTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone .woocommerce-billing-fields label',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_bill_text' );
		$this->start_controls_tab(
			'tab_msc_bill_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'billTextClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone .woocommerce-billing-fields label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_bill_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'billTextClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone .woocommerce-billing-fields label:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'billboxHeading',
			array(
				'label'     => esc_html__( 'Box', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_billbox_text' );
		$this->start_controls_tab(
			'tab_msc_billbox_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'billBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'billBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->add_responsive_control(
			'billBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'billBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_billbox_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'billBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper:hover .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'billBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper:hover .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->add_responsive_control(
			'billBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper:hover .tp-msc-sets.tp-msc-biliing.viewone' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'billBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-bill-ship-wrapper:hover .tp-msc-sets.tp-msc-biliing.viewone',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Payment Style Start*/
		$this->start_controls_section(
			'msc_Pyment_style',
			array(
				'label' => esc_html__( 'Payment', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pymntTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment, {{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment #payment .wc_payment_method',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_pyment_text' );
		$this->start_controls_tab(
			'tab_msc_pyment_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'pymentTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment, {{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment #payment .wc_payment_method > .payment_box' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pymentBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pymentBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->add_responsive_control(
			'pymentBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pymentBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_pyment_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'pymentTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left:hover .tp-msc-sets.tp-msc-payment' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pymentBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left:hover .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'pymentBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left:hover .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->add_responsive_control(
			'pymentBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left:hover .tp-msc-sets.tp-msc-payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pymentBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left:hover .tp-msc-sets.tp-msc-payment',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Order Style Start*/
		$this->start_controls_section(
			'msc_Order_style',
			array(
				'label' => esc_html__( 'Order Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'orderpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'ordermargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'OrdermaintitleHeading',
			array(
				'label'     => esc_html__( 'Main Title & Content', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'orderTxtTypo',
				'label'    => esc_html__( 'Title Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order #order_review_heading',
				// {{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order .tp-msc-cart-text,{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order .shop_table.woocommerce-checkout-review-order-table
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ordertablecontentTypo',
				'label'    => esc_html__( 'Content Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order .shop_table.woocommerce-checkout-review-order-table',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_order_text' );
		$this->start_controls_tab(
			'tab_msc_order_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'orderTitleClrNml',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper #order_review_heading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'orderTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_order_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'orderTitleClrHvr',
			array(
				'label'     => esc_html__( 'Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper #order_review_heading:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'orderTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'OrderbtnHeading',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'orderbtnTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}  .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order .tp-msc-cart-text',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_orderbtn_text' );
		$this->start_controls_tab(
			'tab_msc_orderbtn_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'orderIcnNml',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back .tp-msc-cart-back-icon i,{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back .tp-msc-cart-back-icon svg' => 'font-size:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back .tp-msc-cart-back-icon svg' => 'height:{{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'orderbtnTextClrNml',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back .tp-msc-cart-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'orderIcnClrNml',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back .tp-msc-cart-back-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back .tp-msc-cart-back-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'orderbtnBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'orderbtnBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back',
			)
		);
		$this->add_responsive_control(
			'orderbtnBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'orderbtnBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_orderbtn_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'orderIcnHvr',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
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
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back:hover .tp-msc-cart-back-icon i,{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back:hover .tp-msc-cart-back-icon svg' => 'font-size:{{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'orderbtnTextClrHvr',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back:hover .tp-msc-cart-text' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'orderIcnClrHvr',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back:hover .tp-msc-cart-back-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tp-multi-step-wrapper a.tp-msc-cart-back:hover .tp-msc-cart-back-icon svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'orderbtnBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'orderbtnBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back:hover',
			)
		);
		$this->add_responsive_control(
			'orderbtnBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'orderbtnBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-msc-cart-back:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'orderboxHeading',
			array(
				'label'     => esc_html__( 'Box', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_orderbox_text' );
		$this->start_controls_tab(
			'tabs_msc_orderbox_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'orderBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'orderBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order',
			)
		);
		$this->add_responsive_control(
			'orderBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'orderBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tabs_msc_orderbox_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'orderBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'orderBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order:hover',
			)
		);
		$this->add_responsive_control(
			'orderBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right .tp-msc-sets.tp-msc-order:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'orderBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-right:hover .tp-msc-sets.tp-msc-order',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/** Previous Button Style Start*/
		$this->start_controls_section(
			'msc_previousB_style',
			array(
				'label' => esc_html__( 'Previous', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'previousBmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'previousBpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'previousBTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_previousB_text' );
		$this->start_controls_tab(
			'tab_msc_previousB_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'previousBTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'previousBBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'previousBBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev',
			)
		);
		$this->add_responsive_control(
			'previousBBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'previousBBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_previousB_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'previousBTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'previousBBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'previousBBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev:hover',
			)
		);
		$this->add_responsive_control(
			'previousBBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'previousBBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-prev.tp-msc-prev:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Next Button Style Start*/
		$this->start_controls_section(
			'msc_nextB_style',
			array(
				'label' => esc_html__( 'Next', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nextBpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'nextBmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'nextBTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_nextB_text' );
		$this->start_controls_tab(
			'tab_msc_nextB_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'nextBTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nextBBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextBBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next',
			)
		);
		$this->add_responsive_control(
			'nextBBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nextBBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_nextB_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'nextBTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nextBBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'nextBBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next:hover',
			)
		);
		$this->add_responsive_control(
			'nextBBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nextBBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-btn-next.tp-msc-next:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Place Order Button Style Start*/
		$this->start_controls_section(
			'msc_plc_orderB_style',
			array(
				'label' => esc_html__( 'Place Order Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'plcorderBpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'plcorderBmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'plcorderBTxtTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order',
			)
		);
		$this->start_controls_tabs( 'tabs_msc_plcorderB_text' );
		$this->start_controls_tab(
			'tab_msc_plcorderB_text_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'plcorderBTextClrNml',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'plcorderBBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'plcorderBBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order',
			)
		);
		$this->add_responsive_control(
			'plcorderBBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'plcorderBBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_plcorderB_text_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'plcorderBTextClrHvr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'plcorderBBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'plcorderBBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order:hover',
			)
		);
		$this->add_responsive_control(
			'plcorderBBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'plcorderBBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper .tp-multi-step-content-left .tp-msc-nxt-prv #place_order:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Box Style Start*/
		$this->start_controls_section(
			'msc_Box_style',
			array(
				'label' => esc_html__( 'Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'boxpadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'boxmargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_msc_box_bg' );
		$this->start_controls_tab(
			'tab_msc_box_bg_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgNml',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBdrNml',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper',
			)
		);
		$this->add_responsive_control(
			'boxBdrsNml',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBgsdNml',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_msc_box_bg_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHvr',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBdrHvr',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper:hover',
			)
		);
		$this->add_responsive_control(
			'boxBdrsHvr',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-multi-step-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBgsdHvr',
				'selector' => '{{WRAPPER}} .tp-multi-step-wrapper:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/** Style Sections End */
	}

	/**
	 * Render Woo Multi Step Form.
	 *
	 * @since 5.5.4
	 * @access protected
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$loginswitch = ! empty( $settings['login_switch'] ) ? $settings['login_switch'] : '';

		global $woocommerce;

		if ( class_exists( 'woocommerce' ) ) {
			if ( is_null( WC()->cart ) ) {
				include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
				include_once WC_ABSPATH . 'includes/class-wc-cart.php';
				wc_load_cart();
			}

			$checkout = $woocommerce->checkout();
			$lgnUser  = ! empty( $settings['lgnUser'] ) ? $settings['lgnUser'] : '';
			$yrOrder  = ! empty( $settings['yrOrder'] ) ? $settings['yrOrder'] : '';
			$plcOrder = ! empty( $settings['plcOrder'] ) ? $settings['plcOrder'] : '';

			$msc_style = ! empty( $settings['mscStyle'] ) ? $settings['mscStyle'] : 'style-1';
			$loginText = ! empty( $settings['loginText'] ) ? $settings['loginText'] : '';
			$coupnText = ! empty( $settings['coupnText'] ) ? $settings['coupnText'] : '';
			$retrnUser = ! empty( $settings['lgnRetrnUser'] ) ? $settings['lgnRetrnUser'] : '';

			$lgnMessage  = ! empty( $settings['lgnMessage'] ) ? $settings['lgnMessage'] : '';
			$bilSipText  = ! empty( $settings['bilSipText'] ) ? $settings['bilSipText'] : '';
			$paymntText  = ! empty( $settings['paymntText'] ) ? $settings['paymntText'] : '';
			$logedinText = ! empty( $settings['logedinText'] ) ? $settings['logedinText'] : '';

			$mscBackendPrevB  = ! empty( $settings['mscBackendPrevB'] ) ? $settings['mscBackendPrevB'] : 'mscpbilling';
			$msc_style_layout = ! empty( $settings['mscStyleLayout'] ) ? $settings['mscStyleLayout'] : 'msc-stl-hzt';
			$msc_backend_prev = ! empty( $settings['mscBackendPrev'] ) ? $settings['mscBackendPrev'] : 'mscpcoupon';

			$mscbackend_prev_l  = ! empty( $settings['mscBackendPrevL'] ) ? $settings['mscBackendPrevL'] : 'mscplogin';
			$hide_coupon_switch = ! empty( $settings['hide_coupon_switch'] ) ? $settings['hide_coupon_switch'] : 'no';

			$hide_order_notes_in_billing = isset( $settings['hide_order_notes_in_billing'] ) ? $settings['hide_order_notes_in_billing'] : '';

			$active_step = 'plus-active-step';
			$equal_step  = 'plus-equal-step';

			$mpll = '';
			$mplc = '';
			$mplb = '';
			$mplp = '';
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && ! empty( $mscbackend_prev_l ) && 'yes' === $loginswitch ) {
				if ( 'mscplogin' === $mscbackend_prev_l ) {
					$mpll = ' tp-backend-pas-login';
				} elseif ( 'mscpcoupon' === $mscbackend_prev_l ) {
					$mplc = ' tp-backend-pas-coupon';
				} elseif ( 'mscpbilling' === $mscbackend_prev_l ) {
					$mplb = ' tp-backend-pas-billing';
				} elseif ( 'mscppayment' === $mscbackend_prev_l ) {
					$mplp = ' tp-backend-pas-payment';
				}
			}

			$mpc = '';
			$mpb = '';
			$mpp = '';
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && ! empty( $msc_backend_prev ) && ! empty( $loginswitch ) && 'yes' !== $loginswitch && ( 'yes' !== $hide_coupon_switch ) ) {
				if ( 'mscpcoupon' === $msc_backend_prev ) {
					$mpc = ' tp-backend-pas-coupon';
				} elseif ( 'mscpbilling' === $msc_backend_prev ) {
					$mpb = ' tp-backend-pas-billing';
				} elseif ( 'mscppayment' === $msc_backend_prev ) {
					$mpp = ' tp-backend-pas-payment';
				}
			}

			$mpbn = '';
			$mppn = '';
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && ! empty( $msc_backend_prev ) && ! empty( $loginswitch ) && 'yes' !== $loginswitch && ( 'yes' === $hide_coupon_switch ) ) {
				if ( 'mscpbilling' === $msc_backend_prev ) {
					$mpbn = ' tp-backend-pas-billing';
				} elseif ( 'mscppayment' === $msc_backend_prev ) {
					$mppn = ' tp-backend-pas-payment';
				}
			}

			$msc_step_attr = array();

			$msc_step_attr['lgnswitch'] = $loginswitch;
			if ( 'yes' === $loginswitch ) {
				$msc_step_attr['mscbackendprevl'] = $mscbackend_prev_l;
			}
			if ( 'yes' !== $loginswitch && 'yes' !== $hide_coupon_switch ) {
				$msc_step_attr['mscbackendprev'] = $msc_backend_prev;
			}
			if ( 'yes' !== $loginswitch && 'yes' === $hide_coupon_switch ) {
				$msc_step_attr['mscbackendprevb'] = $mscBackendPrevB;
			}

			$msc_step_attr['mscstyle'] = $msc_style;

			if ( 'style-5' === $msc_style ) {
				$msc_step_attr['stylelayout'] = $msc_style_layout;
			}

			$msc_step_attr['actstep']    = $active_step;
			$msc_step_attr['copnswitch'] = $hide_coupon_switch;

			$msc_billing_message = ! empty( $settings['msc_billing_message'] ) ? $settings['msc_billing_message'] : '';

			$msc_step_attr['mscbm'] = ' ' . $msc_billing_message;

			$msc_step_attr = htmlspecialchars( wp_json_encode( $msc_step_attr ), ENT_QUOTES, 'UTF-8' );

			$nexthtml     = '<input type="button" name="next" class="tp-msc-btn-next tp-msc-next" value="Next">';
			$previoushtml = '<input type="button" name="previous" class="tp-msc-btn-prev tp-msc-prev" value="Previous">';
			$nphtmlstart  = '<div class="tp-msc-nxt-prv">';
			$mphtmlend    = '</div>';

			global $wp;
			if ( isset( $wp->query_vars['order-received'] ) ) {
				$order = false;
				wc_get_template( 'checkout/thankyou.php', array( 'order' => $order ) );
			} else {
				echo '<div class="tp-multi-step-wrapper ' . esc_attr( $msc_style ) . '" data-tp_msc_settings=\'' . esc_attr( $msc_step_attr ) . '\'>';
					echo '<div class="tp-multi-step-nav">';
						echo '<ul class="tp-multi-step-nav-steps">';

				if ( 'yes' === $loginswitch ) {
					$active = '';
					echo '<li class="tp-msc-step tp-msc-step-active"><span>' . esc_html( $loginText ) . '</span></li>';
				} else {
					$active = ' tp-msc-step-active';
				}

				if ( 'no' === $hide_coupon_switch ) {
					echo '<li class="tp-msc-step ' . esc_attr( $active ) . '"><span>' . esc_html( $coupnText ) . '</span></li>';
				}
				if ( 'yes' === $hide_coupon_switch ) {
					echo '<li class="tp-msc-step ' . esc_attr( $active ) . '"><span>' . esc_html( $bilSipText ) . '</span></li>';
				} else {
					echo '<li class="tp-msc-step"><span>' . esc_html( $bilSipText ) . '</span></li>';
				}
							echo '<li class="tp-msc-step"><span>' . esc_html( $paymntText ) . '</span></li>';
						echo '</ul>';
					echo '</div>';

					echo '<div class="tp-multi-step-content">';
						echo '<div class="tp-multi-step-content-left">';

				if ( 'yes' === $loginswitch ) {
					echo '<div class="tp-msc-login-wrapper tp-step-one ' . $equal_step . ' ' . $active_step . ' ' . $mpll . '">';
					if ( is_user_logged_in() ) {
						echo esc_html( $logedinText );
					} else {
						if ( function_exists( 'wc_print_notices ' ) && Theplus_Element_Load::elementor()->editor->is_edit_mode() ) {
							echo '<div class="woocommerce-form-login-toggle">' . wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html( $retrnUser ) ) . ' <a href="#" class="showlogin">' . esc_html( $lgnUser ) . '</a>', 'notice' ) . '</div>';
						} elseif ( function_exists( 'wc_print_notices ' ) ) {
						}
						echo '<div class="woocommerce-form-login-toggle">' . wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html( $retrnUser ) ) . ' <a href="#" class="showlogin">' . esc_html( $lgnUser ) . '</a>', 'notice' ) . '</div>';

						woocommerce_login_form(
							array(
								'message'  => esc_html( $lgnMessage ),
								'redirect' => wc_get_checkout_url(),
								'hidden'   => true,
							)
						);
					}

					if ( is_user_logged_in() && ! Theplus_Element_Load::elementor()->editor->is_edit_mode() ) {
						echo $nphtmlstart . $nexthtml . $mphtmlend;
					}

					echo '</div>';
				}

				if ( 'yes' === $loginswitch ) {
					echo '<div class="tp-msc-coupon-wrapper tp-step-two ' . $equal_step . ' ' . $mplc . ' ' . $mpc . '">';

					if ( 'yes' !== $hide_coupon_switch ) {
						if ( function_exists( 'wc_print_notices ' ) && Theplus_Element_Load::elementor()->editor->is_edit_mode() ) {
							include_once dirname( WC_PLUGIN_FILE ) . '/templates/checkout/form-coupon.php';
						} else {
							include_once dirname( WC_PLUGIN_FILE ) . '/templates/checkout/form-coupon.php';
						}
					}

						echo $nphtmlstart . $previoushtml . $nexthtml . $mphtmlend;
					echo '</div>';
				} else {

					if ( 'yes' !== $hide_coupon_switch ) {
						echo '<div class="tp-msc-coupon-wrapper tp-step-two ' . $equal_step . ' ' . $active_step . ' ' . $mplc . ' ' . $mpc . '">';
					} else {
						echo '<div class="tp-msc-coupon-wrapper tp-step-two ' . $equal_step . ' ' . $mplc . ' ' . $mpc . '">';
					}

					if ( 'yes' !== $hide_coupon_switch ) {
						if ( function_exists( 'wc_print_notices ' ) && Theplus_Element_Load::elementor()->editor->is_edit_mode() ) {
							include_once dirname( WC_PLUGIN_FILE ) . '/templates/checkout/form-coupon.php';
						} else {
							include_once dirname( WC_PLUGIN_FILE ) . '/templates/checkout/form-coupon.php';
						}
					}
							echo $nphtmlstart . $nexthtml . $mphtmlend;
						echo '</div>';
				}

					echo '<form name="checkout" method="post" class="checkout woocommerce-checkout" action="' . esc_url( wc_get_checkout_url() ) . '" enctype="multipart/form-data">';

				if ( 'yes' === $loginswitch && 'yes' === $hide_coupon_switch || ( 'yes' !== $hide_coupon_switch ) ) {
					echo '<div class="tp-msc-bill-ship-wrapper tp-step-three ' . $equal_step . ' ' . $mplb . ' ' . $mpb . '">';
				} elseif ( 'no' === $loginswitch && 'yes' !== $hide_coupon_switch || ( 'yes' === $hide_coupon_switch ) ) {
					echo '<div class="tp-msc-bill-ship-wrapper tp-step-three ' . $equal_step . ' ' . $active_step . ' ' . $mplb . ' ' . $mpb . ' ' . $mpbn . '">';
				}

				if ( isset( $hide_order_notes_in_billing ) && 'yes' === $hide_order_notes_in_billing ) {
					add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
				}

				/*billing & Shipping Form Start*/
				do_action( 'woocommerce_cart_has_errors' );
				if ( $checkout->get_checkout_fields() ) {
					echo '<fieldset class="tp-msc-sets tp-msc-biliing viewone">';
						do_action( 'woocommerce_checkout_before_customer_details' );
						do_action( 'woocommerce_checkout_billing' );
					echo '</fieldset>';
				}

				if ( $woocommerce->cart->needs_shipping_address() === true ) {
					echo '<fieldset class="tp-msc-sets tp-msc-shipping">';
						do_action( 'woocommerce_checkout_shipping' );
						do_action( 'woocommerce_checkout_after_customer_details' );
						do_action( 'woocommerce_checkout_before_order_review_heading' );
					echo '</fieldset>';
				}

				if ( 'yes' === $loginswitch && 'yes' === $hide_coupon_switch || ( 'yes' !== $hide_coupon_switch ) ) {
					echo $nphtmlstart . $previoushtml . $nexthtml . $mphtmlend;
				} elseif ( 'no' === $loginswitch && 'yes' !== $hide_coupon_switch || ( 'yes' === $hide_coupon_switch ) ) {
					echo $nphtmlstart . $nexthtml . $mphtmlend;
				}

					echo '</div>';

				/*Payment Form Start*/
				echo '<div class="tp-msc-wrapper tp-step-four ' . $equal_step . ' ' . $mplp . ' ' . $mpp . ' ' . $mppn . '">';

					echo '<fieldset class="tp-msc-sets tp-msc-payment">';

				if ( WC()->cart->needs_payment() ) {
					$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
					WC()->payment_gateways()->set_current_gateway( $available_gateways );
				} else {
					$available_gateways = array();
				}
								wc_get_template(
									'checkout/payment.php',
									array(
										'checkout' => $woocommerce->checkout(),
										'available_gateways' => $available_gateways,
										'order_button_text' => apply_filters( 'woocommerce_order_button_text', $plcOrder ),
									)
								);

								do_action( 'woocommerce_checkout_after_order_review' );

								echo $nphtmlstart . $previoushtml;
								echo '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">' . esc_html( $plcOrder ) . '</ button>';
									echo $mphtmlend;
							echo '</fieldset>';
						echo '</div>';
					echo '</form>';

					do_action( 'woocommerce_after_checkout_form', $checkout );

				echo '</div>';

				echo '<div class="tp-multi-step-content-right">';
					/* order review form */
					echo '<fieldset class="tp-msc-sets tp-msc-order">';
						echo '<h3 id="order_review_heading">' . esc_attr( $yrOrder ) . '</h3>';
						do_action( 'woocommerce_checkout_before_order_review' );
							woocommerce_order_review();
						do_action( 'woocommerce_checkout_after_order_review' );

				$go_to_cart_page = isset( $settings['go_to_cart_page'] ) ? $settings['go_to_cart_page'] : '';
				if ( 'yes' === $go_to_cart_page ) {
					$cart_icon_position = ! empty( $settings['cart_icon_position'] ) ? $settings['cart_icon_position'] : 'cart_icon_position_a';

					$cart_page_text = ! empty( $settings['cart_page_text'] ) ? $settings['cart_page_text'] : '';
					$cart_page_text = '<span class="tp-msc-cart-text">' . esc_html( $cart_page_text ) . '</span>';

					$icon = '';
					if ( ! empty( $settings['cart_icon_select'] ) ) {
						ob_start();
						\Elementor\Icons_Manager::render_icon( $settings['cart_icon_select'], array( 'aria-hidden' => 'true' ) );
						$icon = ob_get_contents();
						ob_end_clean();
					}

					$bicon = '';
					$aicon = '';
					if ( 'cart_icon_position_a' === $cart_icon_position ) {
						$aicon = '<span class="tp-msc-cart-back-icon tp-msc-cart-back-after">' . $icon . '</span>';
					} elseif ( 'cart_icon_position_b' === $cart_icon_position ) {
						$bicon = '<span class="tp-msc-cart-back-icon tp-msc-cart-back-before">' . $icon . '</span>';
					}

					echo '<a class="tp-msc-cart-back" href="' . esc_url( wc_get_cart_url() ) . '">' . $bicon . $cart_page_text . $aicon . '</a>';

				}

							echo '</fieldset>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
	}
}