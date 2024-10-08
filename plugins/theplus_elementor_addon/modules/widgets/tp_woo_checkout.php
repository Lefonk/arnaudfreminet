<?php
/**
 * Widget Name: Woo Checkout
 * Description: Woo Checkout
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
 * Class ThePlus_Woo_Checkout.
 */
class ThePlus_Woo_Checkout extends Widget_Base {

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
		return 'tp-woo-checkout';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Woo Checkout', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-credit-card theplus_backend_icon';
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
		return array( 'WooCommerce', 'checkout', 'online store', 'e-commerce', 'shopping cart', 'payment gateway', 'purchase', 'buy', 'transaction', 'order', 'customer', 'billing', 'shipping', 'checkout page', 'checkout form', 'checkout process' );
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
			'section_check_out_page',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
			)
		);
		$this->add_control(
			'co_layout',
			array(
				'label'   => wp_kses_post( "Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "edit-woocommerce-checkout-page-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_co_l_1',
				'options' => array(
					'tp_co_l_1' => esc_html__( 'Style 1', 'theplus' ),
					'tp_co_l_2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'ec_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Section Width', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 50,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper.tp_co_l_2 .woocommerce .col2-set' => 'width: {{SIZE}}%',
					'{{WRAPPER}} .tp-checkout-page-wrapper.tp_co_l_2 .woocommerce-checkout-review-order' => 'width: calc(100% - {{SIZE}}%)',
				),
				'condition'   => array(
					'co_layout' => 'tp_co_l_2',
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
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Replace default icons with another font awesome icon using below options.<a href="https://fontawesome.com/v4.7.0/icons" target="_blank">( Get Font Awesome Icon Id. )</a>',
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->add_control(
			'bh_icon',
			array(
				'label'       => esc_html__( 'Billing Heading', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields h3:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'sp_icon',
			array(
				'label'       => esc_html__( 'Shipping Heading', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields h3#ship-to-different-address span:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'yo_icon',
			array(
				'label'       => esc_html__( 'Your Order Heading', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout #tp_order_review_heading:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'ac_icon',
			array(
				'label'       => esc_html__( 'Apply Coupon', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'pl_icon',
			array(
				'label'       => esc_html__( 'Place Order', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( '\f02b', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_rc_login_styling',
			array(
				'label' => esc_html__( 'Returning Customer Login', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'rc_login_bg',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'rc_login_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info',
			)
		);
		$this->add_responsive_control(
			'rc_login_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rc_login_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info',
			)
		);
		$this->add_control(
			'rc_login_text_heading',
			array(
				'label'     => esc_html__( 'Text Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_login_text_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info a,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info:before',
			)
		);
		$this->add_control(
			'rc_login_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info a,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'rc_login_icon_heading',
			array(
				'label'     => esc_html__( 'Icon Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'rc_login_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'rc_login_link_heading',
			array(
				'label'     => esc_html__( 'Link Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_login_link_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info a',

			)
		);
		$this->start_controls_tabs( 'rc_login_tabs' );
			$this->start_controls_tab(
				'rc_login_link_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'rc_login_link_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info a' => 'color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'rc_login_link_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'rc_login_link_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login-toggle .woocommerce-info a:hover' => 'color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'rc_login_inner_area',
			array(
				'label'     => esc_html__( 'Login Inner Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'rc_login_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'rc_login_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'rc_login_inner_bg',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'rc_login_inner_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login',
			)
		);
		$this->add_responsive_control(
			'rc_login_inner_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rc_login_inner_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login,
					{{WRAPPER}} .tp-checkout-page-wrapper .login',
			)
		);
		$this->add_control(
			'rc_login_inner_text',
			array(
				'label'     => esc_html__( 'Text Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'rc_login_inner_text_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login p:not(.form-row),
					{{WRAPPER}} .tp-checkout-page-wrapper .login p:not(.form-row)',
				'separator' => 'before',

			)
		);
		$this->add_control(
			'rc_login_inner_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-login p:not(.form-row),
					{{WRAPPER}} .tp-checkout-page-wrapper .login p:not(.form-row)' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_control(
			'rc_login_lbl_text',
			array(
				'label'     => esc_html__( 'Label Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'rc_login_lbl_text_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'rc_login_lbl_text_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_login_lbl_text_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login label',
			)
		);
		$this->add_control(
			'rc_login_lbl_text_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login label' => 'color: {{VALUE}}',
					'separator' => 'after',
				),
			)
		);
		$this->add_control(
			'rc_login_lbl_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login label .required' => 'color: {{VALUE}} !important',
				),
			)
		);
		$this->add_control(
			'rc_login_rememberme_heading',
			array(
				'label'     => esc_html__( 'Remember Me Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_login_rememberme_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .woocommerce-form-login__rememberme',
			)
		);
		$this->add_control(
			'rc_login_rememberme_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .woocommerce-form-login__rememberme' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'rc_l_if_heading',
			array(
				'label'     => esc_html__( 'Input Field Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'rc_l_if_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'rc_l_if_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_l_if_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]',
			)
		);
		$this->start_controls_tabs( 'tabs_rc_l_if' );
		$this->start_controls_tab(
			'tab_rc_l_if_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'rc_l_if_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rc_l_if_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'rc_l_if_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]',
			)
		);

		$this->add_responsive_control(
			'rc_l_if_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rc_l_if_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_rc_l_if_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'rc_l_if_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rc_l_if_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'rc_l_if_focus_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]:focus',
			)
		);
		$this->add_responsive_control(
			'rc_l_if_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'rc_l_if_focus_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row input[type="password"]:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'rc_l_if_btn_heading',
			array(
				'label'     => esc_html__( 'Button Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'rc_l_if_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'rc_l_if_btn_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
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
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'rc_l_if_btn_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button',

			)
		);
		$this->start_controls_tabs( 'rc_l_if_btn_tabs' );
			$this->start_controls_tab(
				'rc_l_if_btn_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'rc_l_if_btn_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button' => 'color: {{VALUE}}',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'rc_l_if_btn_n_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'rc_l_if_btn_n_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button',
				)
			);
			$this->add_responsive_control(
				'rc_l_if_btn_n_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'rc_l_if_btn_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'rc_l_if_btn_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'rc_l_if_btn_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit:hover,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button:hover' => 'color: {{VALUE}}',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'rc_l_if_btn_h_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit:hover,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'rc_l_if_btn_h_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit:hover,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button:hover',
				)
			);
			$this->add_responsive_control(
				'rc_l_if_btn_h_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit:hover,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'rc_l_if_btn_h_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .woocommerce-form-login__submit:hover,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .form-row .button:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'rc_login_fp_text',
			array(
				'label'     => esc_html__( 'Lost your password Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'rc_login_fp_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'rc_login_fp_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'rc_login_fp_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password a',
			)
		);
		$this->add_control(
			'rc_login_fp_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password,
					{{WRAPPER}} .tp-checkout-page-wrapper .login .lost_password a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_create_account_styling',
			array(
				'label' => esc_html__( 'Create Account', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_ca_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_ca_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_ca_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_ca_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields',
			)
		);
		$this->add_responsive_control(
			'co_ca_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_ca_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields',
			)
		);
		$this->add_control(
			'co_ca_text_heading',
			array(
				'label'     => esc_html__( 'Create Account Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_ca_text_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields .create-account .checkbox,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields .create-account',

			)
		);
		$this->add_control(
			'co_ca_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields .create-account .checkbox,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-account-fields .create-account' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_apply_Coupon_styling',
			array(
				'label' => esc_html__( 'Apply Coupon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_ac_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_ac_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);
		$this->add_responsive_control(
			'co_ac_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_ac_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);
		$this->add_control(
			'co_coupon_text_heading',
			array(
				'label'     => esc_html__( 'Text Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_coupon_text_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info',
			)
		);
		$this->add_control(
			'co_coupon_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'co_coupon_icon_heading',
			array(
				'label'     => esc_html__( 'Icon Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'co_coupon_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'co_coupon_link_heading',
			array(
				'label'     => esc_html__( 'Link Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_coupon_link_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info .showcoupon',

			)
		);
		$this->start_controls_tabs( 'co_coupon_link_tabs' );
			$this->start_controls_tab(
				'co_coupon_link_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'co_coupon_link_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info .showcoupon' => 'color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'co_coupon_link_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'co_coupon_link_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-form-coupon-toggle .woocommerce-info .showcoupon:hover' => 'color: {{VALUE}};',
					),
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'co_coupon_inner_area',
			array(
				'label'     => esc_html__( 'Coupon Inner Table Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'co_coupon_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'co_coupon_inner_bg',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_coupon_inner_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon',
			)
		);
		$this->add_responsive_control(
			'co_coupon_inner_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_coupon_inner_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon',
			)
		);
		$this->add_control(
			'co_c_inner_text',
			array(
				'label'     => esc_html__( 'Text Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'co_c_inner_text_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon p:not(.form-row)',
				'separator' => 'before',

			)
		);
		$this->add_control(
			'co_c_inner_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout_coupon p:not(.form-row)' => 'color: {{VALUE}}',
				),

			)
		);
		$this->add_control(
			'co_c_inner_textfield',
			array(
				'label'     => esc_html__( 'Text Field Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_c_i_tf_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text',
			)
		);
		$this->add_responsive_control(
			'co_c_i_tf_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Input Width', 'theplus' ),
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
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'co_c_i_tf_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text::placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_c_i_tf_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_c_i_tf_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'co_c_i_tf_tabs' );
		$this->start_controls_tab(
			'co_c_i_tf_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'co_c_i_tf_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_c_i_tf_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_c_i_txtf_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text',
			)
		);
		$this->add_responsive_control(
			'co_c_i_tf_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_c_i_tf_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'co_c_i_tf_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'co_c_i_tf_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_c_i_tf_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_c_i_tf_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text:focus',
			)
		);
		$this->add_responsive_control(
			'co_c_i_tf_focus_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_c_i_tf_focus_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-first .input-text:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'co_c_i_button',
			array(
				'label'     => esc_html__( 'Apply Coupon Button Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'co_c_i_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_c_i_btn_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Button Width', 'theplus' ),
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
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_c_i_btn_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button',

			)
		);
		$this->start_controls_tabs( 'co_c_i_btn_tabs' );
			$this->start_controls_tab(
				'co_c_i_btn_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'co_c_i_btn_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button' => 'color: {{VALUE}}',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'co_c_i_btn_n_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'co_c_i_btn_n_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button',
				)
			);
			$this->add_responsive_control(
				'co_c_i_btn_n_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'co_c_i_btn_n_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'co_c_i_btn_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'co_c_i_btn_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:hover' => 'color: {{VALUE}}',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'co_c_i_btn_h_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'co_c_i_btn_h_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:hover',
				)
			);
			$this->add_responsive_control(
				'co_c_i_btn_h_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'co_c_i_btn_h_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout_coupon .form-row.form-row-last .button:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'co_billing_form_head_styling',
			array(
				'label' => esc_html__( 'Billing Form Heading', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_bf_head_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields h3,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields h3#ship-to-different-address',

			)
		);
		$this->add_control(
			'co_bf_head_color',
			array(
				'label'     => esc_html__( 'Heading Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields h3,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields h3#ship-to-different-address' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_billing_form_label_styling',
			array(
				'label' => esc_html__( 'Billing Form Label', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_bf_label_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper label,
					 {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields label,
					 {{WRAPPER}} .woocommerce-additional-fields #order_comments_field label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_bf_label_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper label,
					 {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields label,
					 {{WRAPPER}} .woocommerce-additional-fields #order_comments_field label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_bf_label_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper label,
					 {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields label,
					 {{WRAPPER}} .woocommerce-additional-fields #order_comments_field label',
			)
		);
		$this->add_control(
			'co_bf_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper label,
					 {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields label,
					 {{WRAPPER}} .woocommerce-additional-fields #order_comments_field label' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'co_bf_req_symbol_color',
			array(
				'label'     => esc_html__( 'Required Symbol', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper .required' => 'color: {{VALUE}} !important',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_billing_form_input_styling',
			array(
				'label' => esc_html__( 'Billing Form Input Field', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_bf_input_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_bf_input_inner_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_bf_input_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=tel],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=credit_card_cvc],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=phone],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=url],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=color_picker],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type=date],
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered',
			)
		);
		$this->add_control(
			'co_bf_input_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper  email::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper  number::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper  select::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields  email::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields  number::-webkit-input-placeholder,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields  select::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_co_bf_input_field_style' );
		$this->start_controls_tab(
			'tab_co_bf_input_field_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'co_bf_input_field_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_bf_input_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_bf_box_border_color',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered',
			)
		);

		$this->add_responsive_control(
			'co_bf_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_bf_box_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"],
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"],
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"],
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_co_bf_input_field_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'co_bf_input_field_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"]:focus:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_bf_input_field_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"]:focus:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_bf_box_border_hover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"]:focus:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered:focus',
			)
		);
		$this->add_responsive_control(
			'co_bf_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"]:focus:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_bf_box_active_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="url"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper input[type="date"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-billing-fields__field-wrapper select:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="text"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="email"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="number"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="tel"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="credit_card_cvc"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="phone"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="color_picker"]:focus,
					{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields input[type="date"]:focus:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-shipping-fields .select2-selection__rendered:focus,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-billing-fields__field-wrapper .select2-selection__rendered:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'co_billing_form_textarea_styling',
			array(
				'label' => esc_html__( 'Billing Form Textarea', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'cobfta_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cobfta_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cobfta_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea',
			)
		);
		$this->add_control(
			'cobfta_placeholder_color',
			array(
				'label'     => esc_html__( 'Placeholder Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cobfta_style' );
		$this->start_controls_tab(
			'tab_cobfta_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'cobfta_field_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cobfta_field_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cobfta_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea',
			)
		);
		$this->add_responsive_control(
			'cobfta_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cobfta_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cobfta_focus',
			array(
				'label' => esc_html__( 'Focus', 'theplus' ),
			)
		);
		$this->add_control(
			'cobfta_focus_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea:focus' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'cobfta_focus_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea:focus',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cobfta_hover_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea:focus',
			)
		);
		$this->add_responsive_control(
			'cobfta_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'cobfta_active_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce textarea:focus',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'co_bfmain_styling',
			array(
				'label' => esc_html__( 'Billing Form', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bfmain_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bfmain_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bfmain_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields',
			)
		);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'bfmain_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields',
				)
			);
			$this->add_responsive_control(
				'bfmain_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'bfmain_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-billing-fields',
				)
			);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_sfmain_styling',
			array(
				'label' => esc_html__( 'Shipping Form', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'sfmain_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'sfmain_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sfmain_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields',
			)
		);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'sfmain_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields',
				)
			);
			$this->add_responsive_control(
				'sfmain_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'sfmain_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-shipping-fields',
				)
			);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_onmain_styling',
			array(
				'label' => esc_html__( 'Order Notes', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'onmain_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'onmain_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'onmain_heading_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields h3',

			)
		);
		$this->add_control(
			'onmain_heading_color',
			array(
				'label'     => esc_html__( 'Heading Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields h3' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'onmain_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields',
			)
		);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'onmain_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields',
				)
			);
			$this->add_responsive_control(
				'onmain_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'onmain_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-additional-fields',
				)
			);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_yo_head_styling',
			array(
				'label' => esc_html__( 'Order Form Heading', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'co_yo_head_text',
			array(
				'label'       => esc_html__( 'Your order Heading', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Your order', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'Your order', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_yo_head_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout #tp_order_review_heading',

			)
		);
		$this->add_control(
			'co_yo_head_color',
			array(
				'label'     => esc_html__( 'Heading Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout #tp_order_review_heading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_yo_form_styling',
			array(
				'label' => esc_html__( 'Order Details Form', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_yo_f_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout-review-order-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_yo_f_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr td, .woocommerce-checkout {{WRAPPER}}  .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr th' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'btc_pn_alignment',
			array(
				'label'       => esc_html__( 'Product Name', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tbody .product-name' => 'text-align : {{VALUE}}',
				),
				'default'     => 'left',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_control(
			'btc_pn_alignment_var',
			array(
				'label'       => esc_html__( 'Variation Product Info', 'theplus' ),
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
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce td.product-name .wc-item-meta, .woocommerce td.product-name dl.variation' => 'justify-content : {{VALUE}}',
				),
				'default'     => 'flex-start',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_control(
			'btc_pp_alignment',
			array(
				'label'       => esc_html__( 'Price', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tbody .product-total' => 'text-align : {{VALUE}}',
				),
				'default'     => 'right',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btcmain_typo',
				'selector' => '{{WRAPPER}} .woocommerce table.shop_table th',
			)
		);
		$this->add_control(
			'btcmain_color',
			array(
				'label'     => esc_html__( 'Main Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce table.shop_table th' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btc',
			array(
				'label'     => esc_html__( 'Body Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tbody' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'btc_qty',
			array(
				'label'     => esc_html__( 'Qty Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tbody .product-quantity' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bt_typography',
				'label'    => esc_html__( 'Table Body Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table tbody',
			)
		);
		$this->add_control(
			'tft_color',
			array(
				'label'     => esc_html__( 'Table Footer Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ttf_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot' => 'text-align : {{VALUE}}',
				),
				'default'     => 'center',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tft_typography',
				'label'    => esc_html__( 'Table Footer Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot',
			)
		);
		$this->add_control(
			'tftt_color',
			array(
				'label'     => esc_html__( 'Total Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot .order-total' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'ttft_alignment',
			array(
				'label'       => esc_html__( 'Total Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot .order-total' => 'text-align : {{VALUE}}',
				),
				'default'     => 'center',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tftt_typography',
				'label'    => esc_html__( 'Table Footer Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table tfoot .order-total',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'co_yo_f_bg',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout-review-order-table,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout-review-order-table td,
				{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout-review-order-table th',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_yo_f_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table',
			)
		);
		$this->add_responsive_control(
			'co_yo_f_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_yo_f_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table',
			)
		);
		$this->add_control(
			'head_inner_main_heading',
			array(
				'label'     => esc_html__( 'Main Inner Border Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'head_inner_main__border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .cart-subtotal,
				.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .order-total, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .cart-subtotal, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .order-total',
			)
		);
		$this->add_responsive_control(
			'head_inner_main__border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .cart-subtotal,
				.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .order-total, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .cart-subtotal, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .order-total' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'head_inner_main__shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .cart-subtotal,
				.woocommerce-checkout {{WRAPPER}} form #order_review .woocommerce-checkout-review-order-table .order-total, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .cart-subtotal, .woocommerce-checkout {{WRAPPER}} form #order_review_heading .woocommerce-checkout-review-order-table .order-total',
			)
		);
		$this->add_control(
			'o_yo_f_in_heading',
			array(
				'label'     => esc_html__( 'Head Inner Border Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_yo_f_in_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr th,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr th',
			)
		);
		$this->add_responsive_control(
			'co_yo_f_in_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr th,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_yo_f_in_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table thead tr th,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review  .woocommerce-checkout-review-order-table tbody tr th',
			)
		);
		$this->add_control(
			'co_yo_f_in_of',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout-review-order-table' => 'overflow: hidden;',
				),
			)
		);
		$this->add_control(
			'o_byo_f_in_heading',
			array(
				'label'     => esc_html__( 'Body Inner Border Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_byo_f_in_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table  tfoot tr:not(.order-total) td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tfoot  tr:not(.order-total) th',
			)
		);
		$this->add_responsive_control(
			'co_byo_f_in_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table  tfoot tr:not(.order-total) td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table  tfoot tr:not(.order-total) th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_byo_f_in_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table  tfoot tr:not(.order-total) td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table  tfoot tr:not(.order-total) th',
			)
		);
		$this->add_control(
			'o_yo_f_in_t_heading',
			array(
				'label'     => esc_html__( 'Total Border Option', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_yo_f_in_t_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total th',
			)
		);
		$this->add_responsive_control(
			'co_yo_f_in_t_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_yo_f_in_t_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total td,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper form #order_review .woocommerce-checkout-review-order-table tr.order-total th',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'co_yo_pay_styling',
			array(
				'label' => esc_html__( 'Order Payment', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_yo_pay_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'co_yo_pay_bg',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment,{{WRAPPER}}  .tp-checkout-page-wrapper .checkout #payment',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_yo_pay_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment',
			)
		);
		$this->add_responsive_control(
			'co_yo_pay_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_yo_pay_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment',
			)
		);
		$this->add_control(
			'co_yo_pay_label_heading',
			array(
				'label'     => esc_html__( 'Payment Label', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_yo_pay_label_typography',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment label,
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_method_paypal .about_paypal',
			)
		);
		$this->add_control(
			'co_yo_pay_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment label,
				{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_method_paypal .about_paypal' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'co_yo_pay_label_desc_heading',
			array(
				'label'     => esc_html__( 'Payment Description', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'co_yop_ld_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_yop_ld_typography',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box,
				.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box p',
			)
		);
		$this->add_control(
			'co_yop_ld_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box,
					.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'co_yop_ld_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box' => 'background-color: {{VALUE}} !important;',
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box:before' => 'border-color: {{VALUE}} !important;
					border-right-color: transparent !important;border-left-color: transparent !important;border-top-color: transparent !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_yop_ld_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box',
			)
		);
		$this->add_responsive_control(
			'co_yop_ld_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_yop_ld_shadow',
				'selector' => '.woocommerce-checkout {{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box',
			)
		);
		$this->add_control(
			'arrow_switch',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'arrow_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Arrow Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .payment_box:before' => 'top: {{SIZE}}{{UNIT}} !important',
					'#add_payment_method #payment div.payment_box::before, .woocommerce-cart #payment div.payment_box::before, .woocommerce-checkout #payment div.payment_box::before' => 'content : ""',
				),
				'condition'   => array(
					'arrow_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/*
		Stripe start
		$this->start_controls_section(
			'co_stripe_styling',
			[
				'label' => esc_html__('Stripe Payment', 'theplus'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'cos_padding',
			[
				'label' => esc_html__( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'cos_margin',
			[
				'label' => esc_html__( 'Margin', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'cos__bg',
			[
				'label' => esc_html__( 'Background', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form' => 'background: {{VALUE}} !important',
				],
			]
		);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'cos__border',
					'label' => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form',
				]
			);
			$this->add_responsive_control(
				'cos__br',
				[
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cos__shadow',
				'label' => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form',
			]
		);
		$this->add_responsive_control(
			'cos_padding_o',
			[
				'label' => esc_html__( 'Input Field Row Outer Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form .form-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cos_margin_o',
			[
				'label' => esc_html__( 'Input Field Row Outer Margin', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form .form-row' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cos_label_heading',
			[
				'label' => esc_html__( 'Label Option', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cos_label_typography',
				'label' => esc_html__( 'Typography', 'theplus' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form label',

			]
		);
		$this->add_control(
			'cos_label_color',
			[
				'label' => esc_html__( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .payment_method_stripe .wc-payment-form label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cos_save_payment',
			[
				'label' => esc_html__( 'Save Payment Info Option', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'cos_save_payment_chk_size',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Checkbox Size', 'theplus'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout #payment .payment_method_stripe p:last-child input' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important',
				],
			]
		);
		$this->add_control(
			'cos_save_payment_text',
			[
				'label' => esc_html__( 'Save Payment Text Option', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cos_save_payment_text_typography',
				'label' => esc_html__( 'Typography', 'theplus' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout #payment .payment_method_stripe p:last-child label',

			]
		);
		$this->add_control(
			'cos_save_payment_text_color',
			[
				'label' => esc_html__( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout #payment .payment_method_stripe p:last-child label' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_control(
			'cos_heading_text',
			[
				'label' => esc_html__( 'Heading Text Option', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cos_heading_text_typography',
				'label' => esc_html__( 'Typography', 'theplus' ),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY
				],
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout #payment .payment_method_stripe p:first-child',

			]
		);
		$this->add_control(
			'cos_heading_text_color',
			[
				'label' => esc_html__( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout #payment .payment_method_stripe p:first-child' => 'color: {{VALUE}}',
				],

			]
		);
		$this->end_controls_section();
		stripe end*/

		/* Privacy policy start*/
		$this->start_controls_section(
			'co_privacy_policy_styling',
			array(
				'label' => esc_html__( 'Privacy Policy', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_pp_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'co_pp_typography',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text p',
			)
		);
		$this->add_control(
			'co_pp_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text,
					{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text p' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'co_pp_link_heading',
			array(
				'label'     => esc_html__( 'Privacy Policy Link', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_co_pp_wclink' );
		$this->start_controls_tab(
			'tab_co_pp_wclink_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'co_pp_link_n_color',
			array(
				'label'     => esc_html__( 'Link Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_co_pp_wclink_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'co_pp_link_h_color',
			array(
				'label'     => esc_html__( 'Link Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'co_place_order_btn_styling',
			array(
				'label' => esc_html__( 'Place Order Button', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'cp_pob_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cp_pob_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
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
					'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order' => 'width: {{SIZE}}{{UNIT}}',
				),
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cp_pob_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order',

			)
		);
		$this->start_controls_tabs( 'cp_pob_tabs' );
			$this->start_controls_tab(
				'cp_pob_normal',
				array(
					'label' => esc_html__( 'Normal', 'theplus' ),
				)
			);
			$this->add_control(
				'cp_pob_n_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order' => 'color: {{VALUE}} !important',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'cp_pob_n_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '.woocommerce-page {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout .woocommerce-checkout-payment#payment .place-order button#place_order',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'cp_pob_n_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order',
				)
			);
			$this->add_responsive_control(
				'cp_pob_n_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'cp_pob_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order',
				)
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'cp_pob_hover',
				array(
					'label' => esc_html__( 'Hover', 'theplus' ),
				)
			);
			$this->add_control(
				'cp_pob_h_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order:hover' => 'color: {{VALUE}} !important',
					),

				)
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'cp_pob_h_bg',
					'label'    => esc_html__( 'Background', 'theplus' ),
					'types'    => array( 'classic', 'gradient' ),
					'selector' => '.woocommerce-page {{WRAPPER}} .tp-checkout-page-wrapper .woocommerce .checkout .woocommerce-checkout-payment#payment .place-order button#place_order:hover',
				)
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'cp_pob_h_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order:hover',
				)
			);
			$this->add_responsive_control(
				'cp_pob_h_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'cp_pob_h_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .checkout .woocommerce-checkout-payment button#place_order:hover',
				)
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'checkout_of_styling',
			array(
				'label' => esc_html__( 'Order Form', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'of_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'of_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'of_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order',
			)
		);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'of_border',
					'label'    => esc_html__( 'Border', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order',
				)
			);
			$this->add_responsive_control(
				'of_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'of_shadow',
					'label'    => esc_html__( 'Box Shadow', 'theplus' ),
					'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order',
				)
			);
			$this->add_control(
				'of_of',
				array(
					'label'     => esc_html__( 'Overflow', 'theplus' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'selectors' => array(
						'{{WRAPPER}} .tp-checkout-page-wrapper .woocommerce-checkout .woocommerce-checkout-review-order' => 'overflow: hidden;',
					),
				)
			);
		$this->end_controls_section();
		$this->start_controls_section(
			'checkout_box_content_styling',
			array(
				'label' => esc_html__( 'Checkout Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'co_box_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'co_box_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'co_box_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'co_box_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper',
			)
		);
		$this->add_responsive_control(
			'co_box_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-checkout-page-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'co_box_shadow',
				'selector' => '{{WRAPPER}} .tp-checkout-page-wrapper',
			)
		);
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Get Short Code
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	private function get_shortcode() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'shortcode', 'woocommerce_checkout' );

		$shortcode   = array();
		$shortcode[] = sprintf( '[%s]', $this->get_render_attribute_string( 'shortcode' ) );

		return implode( '', $shortcode );
	}

	/**
	 * Woo Checkout Render
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function render() {
		$settings  = $this->get_settings_for_display();
		$co_layout = ! empty( $settings['co_layout'] ) ? $settings['co_layout'] : '';

		$tp_chkp = '<div class="tp-checkout-page-wrapper ' . esc_attr( $co_layout ) . '">';

		add_action( 'woocommerce_checkout_order_review', array( $this, 'woocommerce_checkout_order_review_cust' ), 1 );
		$tp_chkp .= do_shortcode( $this->get_shortcode() );

		$tp_chkp .= '</div>';

		echo $tp_chkp;
	}

	/**
	 * Woo Order Review
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function woocommerce_checkout_order_review_cust() {
		$settings = $this->get_settings_for_display();

		$co_yo_head_text = ! empty( $settings['co_yo_head_text'] ) ? $settings['co_yo_head_text'] : '';
		echo '<h3 id="tp_order_review_heading">' . esc_html( $co_yo_head_text ) . '</h3>';
	}
}
