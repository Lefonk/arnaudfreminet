<?php
/**
 * Widget Name: Countdown
 * Description: Display countdown.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Countdown.
 */
class ThePlus_Countdown extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @var tp_doc of the class.
	 */
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
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-countdown';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Countdown', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-clock-o theplus_backend_icon';
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
	 * Get Widget Category.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keyword.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Coupon', 'Code', 'Discount', 'Promo', 'Voucher', 'Offer', 'Deal', 'Savings', 'Discount Code', 'Promo Code', 'Voucher Code', 'Coupon Deal', 'Coupon Offer', 'Coupon Savings', 'Discount Offer', 'Discount Deal', 'Promo Offer', 'Promo Deal', 'Voucher Offer', 'Voucher Deal' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Countdown Date', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'CDType',
			array(
				'label'   => esc_html__( 'Countdown Setup', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => array(
					'normal'   => esc_html__( 'Normal Countdown', 'theplus' ),
					'scarcity' => esc_html__( 'Scarcity Countdown (Evergreen)', 'theplus' ),
					'numbers'  => esc_html__( 'Fake Numbers Counter', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_normal',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-sticky-countdown-timer-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'CDType' => array( 'normal' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_scarcity',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "evergreen-countdown-timer-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'CDType' => array( 'scarcity' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_number',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "woocommerce-product-stock-scarcity-timer-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'CDType' => array( 'numbers' ),
				),
			)
		);
		$this->add_control(
			'CDstyle',
			array(
				'label'     => esc_html__( 'Countdown Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
				),
				'condition' => array(
					'CDType' => array( 'normal', 'scarcity' ),
				),
			)
		);
		$this->add_control(
			'counting_timer',
			array(
				'label'       => wp_kses_post( "Launch Date <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-countdown-timer-in-hello-top-bar/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::DATE_TIME,
				'label_block' => false,
				'default'     => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( esc_html__( 'Date set according to your timezone: %s.', 'theplus' ), Utils::get_timezone_string() ),
				'condition'   => array(
					'CDType'           => 'normal',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'inline_style',
			array(
				'label'     => wp_kses_post( "Inline Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "style-elementor-countdown-timer-in-block-or-inline-style/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-1',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_downcount',
			array(
				'label'     => esc_html__( 'Content Source', 'theplus' ),
				'condition' => array(
					'CDType' => array( 'normal', 'scarcity' ),
				),
			)
		);

		$this->add_control(
			'dayslabels',
			array(
				'label'     => wp_kses_post( "Days <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "hide-countdown-days-hours-mins-seconds-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'hourslabels',
			array(
				'label'     => esc_html__( 'Hours', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'minuteslabels',
			array(
				'label'     => esc_html__( 'Minutes', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);

		$this->add_control(
			'secondslabels',
			array(
				'label'     => esc_html__( 'Seconds', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'after',
			)
		);

		$this->add_control(
			'show_labels',
			array(
				'label'   => esc_html__( 'Show Labels', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_labels_tag',
			array(
				'label'     => esc_html__( 'Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h6',
				'options'   => theplus_get_tags_options(),
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_days',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Days Section Text', 'theplus' ),
				'label_block' => false,
				'default'     => esc_html__( 'Days', 'theplus' ),
				'condition'   => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_hours',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Hours Section Text', 'theplus' ),
				'label_block' => false,
				'default'     => esc_html__( 'Hours', 'theplus' ),
				'condition'   => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_minutes',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Minutes Section Text', 'theplus' ),
				'label_block' => false,
				'default'     => esc_html__( 'Minutes', 'theplus' ),
				'condition'   => array(
					'show_labels!' => '',
				),
			)
		);
		$this->add_control(
			'text_seconds',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Seconds Section Text', 'theplus' ),
				'label_block' => false,
				'default'     => esc_html__( 'Seconds', 'theplus' ),
				'condition'   => array(
					'show_labels!' => '',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extraoption_downcount',
			array(
				'label' => esc_html__( 'Extra Option', 'theplus' ),
			)
		);
		$this->add_control(
			'fliptheme',
			array(
				'label'      => esc_html__( 'Theme Color', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'dark',
				'options'    => array(
					'dark'  => esc_html__( 'Dark', 'theplus' ),
					'light' => esc_html__( 'Light', 'theplus' ),
					'mix'   => esc_html__( 'Mix', 'theplus' ),
				),
				'condition'  => array(
					'CDType' => array( 'normal', 'scarcity' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'CDstyle',
							'operator' => '===',
							'value'    => 'style-2',
						),
					),
				),
			)
		);
		$this->add_control(
			'flipMixtime',
			array(
				'label'      => esc_html__( 'Theme Change Time', 'theplus' ),
				'type'       => Controls_Manager::NUMBER,
				'min'        => 1,
				'max'        => 1000,
				'step'       => 1,
				'default'    => 3,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
								array(
									'name'     => 'CDstyle',
									'operator' => '===',
									'value'    => 'style-2',
								),
								array(
									'name'     => 'fliptheme',
									'operator' => '===',
									'value'    => 'mix',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'CDstyle',
									'operator' => '===',
									'value'    => 'style-2',
								),
								array(
									'name'     => 'fliptheme',
									'operator' => '===',
									'value'    => 'mix',
								),
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'cityminit',
			array(
				'label'       => esc_html__( 'Reset Time', 'theplus' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'step'        => 1,
				'default'     => 99,
				'description' => 'Note : Enter time in minutes when you want to reset timer data.',
				'condition'   => array(
					'CDType'           => 'scarcity',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'storetype',
			array(
				'label'       => esc_html__( 'Track User Data', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'normal',
				'options'     => array(
					'normal' => esc_html__( 'No', 'theplus' ),
					'cookie' => esc_html__( 'Yes(Local Storage Based)', 'theplus' ),
				),
				'description' => '<a rel="noopener noreferrer" target="_blank" href="https://docs.posimyth.com/tpae/countdown/">Understand this options in depth</a>',
				'condition'   => array(
					'CDType' => array( 'scarcity', 'numbers' ),
				),
			)
		);

		$this->add_control(
			'fackeLoop',
			array(
				'label'        => esc_html__( 'Enable Loop', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'numbers',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'delayminit',
			array(
				'label'     => esc_html__( 'Delay Minute', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'default'   => 0,
				'condition' => array(
					'CDType'    => 'scarcity',
					'storetype' => 'cookie',
					'fackeLoop' => 'yes',
				),
			)
		);

		$this->add_control(
			'initNum',
			array(
				'label'     => esc_html__( 'Initial Number', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'default'   => 500,
				'condition' => array(
					'CDType'           => 'numbers',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'endNum',
			array(
				'label'     => esc_html__( 'Final Number', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'step'      => 1,
				'default'   => 99,
				'condition' => array(
					'CDType'           => 'numbers',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'numRange',
			array(
				'label'     => esc_html__( 'Number Range', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1000,
				'step'      => 1,
				'default'   => 10,
				'condition' => array(
					'CDType'           => 'numbers',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'changeInterval',
			array(
				'label'     => esc_html__( 'Change Interval (In Seconds)', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 1,
				'condition' => array(
					'CDType'           => 'numbers',
					'woo_loop_switch!' => 'yes',
				),
			)
		);
		$this->add_control(
			'fackemassage',
			array(
				'label'       => __( 'Fake Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'Showing {visible_counter}', 'theplus' ),
				'placeholder' => __( 'Enter Total Message', 'theplus' ),
				'condition'   => array(
					'CDType' => 'numbers',
				),
			)
		);
		$this->add_control(
			'fackenote',
			array(
				'label'     => esc_html__( 'Note : You can include Countdown Number like {visible_counter}.', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'CDType' => 'numbers',
				),
			)
		);
		$this->add_control(
			'expirytype',
			array(
				'label'        => esc_html__( 'After Expiry Action', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Enable', 'theplus' ),
				'label_off'    => esc_html__( 'Disable', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'conditions'   => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'countdownExpiry',
			array(
				'label'      => esc_html__( 'Select Action', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'none',
				'options'    => array(
					'none'     => esc_html__( 'None', 'theplus' ),
					'showmsg'  => esc_html__( 'Message', 'theplus' ),
					'showtemp' => esc_html__( 'Template', 'theplus' ),
					'redirect' => esc_html__( 'Page Redirect', 'theplus' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
								array(
									'name'     => 'expirytype',
									'operator' => '===',
									'value'    => 'yes',
								),
							),
						),
					),
				),

			)
		);
		$this->add_control(
			'how_it_works_message',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-sticky-countdown-timer-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'countdownExpiry' => array( 'showmsg' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_pageredirect',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "redirect-to-different-page-after-elementor-countdown-ends/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'countdownExpiry' => array( 'redirect' ),
				),
			)
		);
		$this->add_control(
			'expiryMsg',
			array(
				'label'       => esc_html__( 'Expiry Message', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => esc_html__( 'Countdown Has Ended !', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showmsg',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
								array(
									'name'     => 'expirytype',
									'operator' => '===',
									'value'    => 'yes',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showmsg',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'expiryRedirect',
			array(
				'label'       => esc_html__( 'Page Redirect Url', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'http://', 'theplus' ),
				'default'     => array(
					'url'               => '',
					'is_external'       => true,
					'nofollow'          => true,
					'custom_attributes' => '',
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'redirect',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
								array(
									'name'     => 'expirytype',
									'operator' => '===',
									'value'    => 'yes',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'redirect',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'templates',
			array(
				'label'      => esc_html__( 'Template', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '0',
				'options'    => theplus_get_templates(),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showtemp',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'storetype',
									'operator' => '===',
									'value'    => 'cookie',
								),
								array(
									'name'     => 'expirytype',
									'operator' => '===',
									'value'    => 'yes',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showtemp',
								),
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'cd_classbased',
			array(
				'label'     => wp_kses_post( "Class Based Section Visibility <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "change-website-content-when-countdown-timer-ends/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
				'condition' => array(
					'CDType'   => array( 'normal', 'scarcity' ),
					'CDstyle!' => array( 'style-3' ),
				),
			)
		);
		$this->add_control(
			'cd_classbased_note',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'for more info <a href="#" target="_blank">Click Here</a>',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'CDType'        => array( 'normal', 'scarcity' ),
					'cd_classbased' => 'yes',
					'CDstyle!'      => array( 'style-3' ),
				),
			)
		);
		$this->add_control(
			'cd_class_1',
			array(
				'label'       => esc_html__( 'During Countdown Class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'During Countdown', 'theplus' ),
				'condition'   => array(
					'CDType'        => array( 'normal', 'scarcity' ),
					'cd_classbased' => 'yes',
					'CDstyle!'      => array( 'style-3' ),
				),
			)
		);
		$this->add_control(
			'cd_class_2',
			array(
				'label'       => esc_html__( 'After Expiry Class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'After Expiry', 'theplus' ),
				'condition'   => array(
					'CDType'        => array( 'normal', 'scarcity' ),
					'cd_classbased' => 'yes',
					'CDstyle!'      => array( 'style-3' ),
				),
			)
		);
		$this->end_controls_section();

		/** Woocommerce Start*/
		$this->start_controls_section(
			'woo_loop_downcount',
			array(
				'label' => esc_html__( 'WooCommerce', 'theplus' ),
			)
		);
		$this->add_control(
			'woo_loop_switch',
			array(
				'label'       => wp_kses_post( "WooCommerce Single Connect <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "sales-countdown-timer-to-a-woocommerce-product-page-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'woo_countdown_note',
			array(
				'label'     => wp_kses_post( "<p class='tp-controller-notice'><i>Note : Need to enable Woo countdown loop option from ThePlus Settings -> Extra Options <a href='" . esc_url( theplus_dashboard_url( 'theplus_api_connection_data' ) ) . "' target='_blank' rel='noopener noreferrer'> Link </a></i></p>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'woo_loop_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		/** Woocommerce End*/

		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Counter', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-1',
				),
			)
		);
		$this->add_control(
			'number_text_color',
			array(
				'label'     => esc_html__( 'Counter Font Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li > span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'numbers_typography',
				'global'    => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}}  .pt_plus_countdown li > span',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'label_typography',
				'label'     => esc_html__( 'Label Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li > .label-ref',
				'separator' => 'after',
				'condition' => array(
					'show_labels!' => '',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_days_style' );

		$this->start_controls_tab(
			'tab_day_style',
			array(
				'label' => esc_html__( 'Days', 'theplus' ),
			)
		);
		$this->add_control(
			'days_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_1 .label-ref' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'days_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_1' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'days_background',
				'label'    => esc_html__( 'Days Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_1',

			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hour_style',
			array(
				'label' => esc_html__( 'Hours', 'theplus' ),
			)
		);
		$this->add_control(
			'hours_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_2 .label-ref' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'hours_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_2' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'hours_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_2',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_minute_style',
			array(
				'label' => esc_html__( 'Minutes', 'theplus' ),
			)
		);
		$this->add_control(
			'minutes_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_3 .label-ref' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'minutes_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_3' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'minutes_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_3',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_second_style',
			array(
				'label' => esc_html__( 'Seconds', 'theplus' ),
			)
		);
		$this->add_control(
			'seconds_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_4 .label-ref' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'seconds_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li.count_4' => 'border-color:{{VALUE}};',
				),
				'condition' => array(
					'inline_style!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'seconds_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_countdown li.count_4',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'counter_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'counter_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'count_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
				),
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'count_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'count_border_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'count_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'count_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		/*style 2 start*/
		$this->start_controls_section(
			'style2text_styling',
			array(
				'label'     => esc_html__( 'Label', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'      => array( 'normal', 'scarcity' ),
					'CDstyle'     => 'style-2',
					'show_labels' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's2texttypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group .rotor-group-heading',
			)
		);
		$this->start_controls_tabs( 's32_tabs' );
		$this->start_controls_tab(
			's2_text_days',
			array(
				'label' => esc_html__( 'Days', 'theplus' ),
			)
		);
		$this->add_control(
			's2daytextdcr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextdbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextdb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextdbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextdsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(1) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_hours',
			array(
				'label' => esc_html__( 'Hours', 'theplus' ),
			)
		);
		$this->add_control(
			's2hoursnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytexttbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytexttdb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytexttbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytexttsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(2) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_minutes',
			array(
				'label' => esc_html__( 'Minutes', 'theplus' ),
			)
		);
		$this->add_control(
			's2minutesnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextmtbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextmdb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextmbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextmsd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(3) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2_text_seconds',
			array(
				'label' => esc_html__( 'Second', 'theplus' ),
			)
		);
		$this->add_control(
			's2secondnumberncr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2daytextmsbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2daytextsdb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->add_responsive_control(
			's2daytextsbrs',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 's2daytextssd',
				'selector' => '{{WRAPPER}} .tp-countdown .rotor-group:nth-of-type(4) .rotor-group-heading:before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/*counter style*/
		$this->start_controls_section(
			'style2counter_styling',
			array(
				'label'     => esc_html__( 'Counter', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'style2countertypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown .rotor',
			)
		);
		$this->end_controls_section();
		/*counter style*/

		$this->start_controls_section(
			'style2dark_styling',
			array(
				'label'     => esc_html__( 'Dark Theme', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'    => array( 'normal', 'scarcity' ),
					'CDstyle'   => 'style-2',
					'fliptheme' => array( 'dark', 'mix' ),
				),
			)
		);
		$this->start_controls_tabs( 's2dark_tabs' );
		$this->start_controls_tab(
			's2dark_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			's2haddingntop',
			array(
				'label' => esc_html__( 'Top Options', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			's2darktopncr',
			array(
				'label'     => esc_html__( 'Top Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darktopnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2bordernb',
				'label'    => esc_html__( 'Border Top', 'theplus' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor,{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2haddingnbootom',
			array(
				'label'     => esc_html__( 'Bottom Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2darkbottomncr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-rear' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darkbottomnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2borderbottomnb',
				'label'    => esc_html__( 'Border Top', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark .rotor:after',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's2dark_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			's2haddihghtop',
			array(
				'label' => esc_html__( 'Top Options', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			's2darktophcr',
			array(
				'label'     => esc_html__( 'Top Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darktophbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2darkborderhb',
				'label'    => esc_html__( 'Border Top', 'theplus' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor,{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2haddinghbootom',
			array(
				'label'     => esc_html__( 'Bottom Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2darkbottomhcr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-rear' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2darkbottomhbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-bottom, {{WRAPPER}} .flipdown.flipdown__theme-dark:hover .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'middlelinehb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-dark:hover .rotor:after',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'style2light_styling',
			array(
				'label'     => esc_html__( 'Light Theme', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'    => array( 'normal', 'scarcity' ),
					'CDstyle'   => 'style-2',
					'fliptheme' => array( 'light', 'mix' ),
				),
			)
		);

		$this->start_controls_tabs( 's2light_tabs' );
		$this->start_controls_tab(
			's2light_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			's2lighthaddingntop',
			array(
				'label' => esc_html__( 'Bottom Options', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			's2lighttopncr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-bottom,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-leaf-rear' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2lighttopnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-bottom,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2lightbordernb',
				'label'    => esc_html__( 'Border Bottom', 'theplus' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-light .rotor,{{WRAPPER}} .flipdown.flipdown__theme-light .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-light .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2lighthaddingnbootom',
			array(
				'label'     => esc_html__( 'Top Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2lighttopncrbootom',
			array(
				'label'     => esc_html__( 'Top Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2lighttopnbgbootom',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2lightbordernbotom',
				'label'    => esc_html__( 'Border Top', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light .rotor:after',
			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			's2light_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			's2lighthaddihghtop',
			array(
				'label' => esc_html__( 'Bottom Options', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			's2lighttophcr',
			array(
				'label'     => esc_html__( 'Bottom Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-bottom,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-leaf-rear' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2lighttophbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-bottom,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-leaf-rear',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2lightborderhb',
				'label'    => esc_html__( 'Border Bottom', 'theplus' ),
				'selector' => '{{WRAPPER}} .flipdown.flipdown__theme-light:hover .rotor,{{WRAPPER}} .flipdown.flipdown__theme-light:hover .rotor-top,{{WRAPPER}} .flipdown.flipdown__theme-light:hover .rotor-leaf-front',
			)
		);

		$this->add_control(
			's2lighthaddinghbootom',
			array(
				'label'     => esc_html__( 'Top Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's2lighttophcrbootom',
			array(
				'label'     => esc_html__( 'Top Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-leaf-front' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2lighttophbgbootom',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-top,{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor-leaf-front',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 's2lightborderhbotom',
				'label'    => esc_html__( 'Border Top', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown.flipdown__theme-light:hover .rotor:after',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style2dot_styling',
			array(
				'label'     => esc_html__( 'Dot', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 's2ndotbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):before,{{WRAPPER}} .tp-countdown .flipdown .rotor-group:nth-child(n+2):nth-child(-n+3):after,{{WRAPPER}}  .tp-countdown.countdown-style-2 .rotor-group:first-child::after,{{WRAPPER}}  .tp-countdown.countdown-style-2 .rotor-group:first-child::before',
			)
		);
		$this->end_controls_section();
		/*style 3 end*/

		$this->start_controls_section(
			'style3_styling',
			array(
				'label'     => esc_html__( 'Style 3', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType'  => array( 'normal', 'scarcity' ),
					'CDstyle' => 'style-3',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's3numbertypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-counter .progressbar-text .number',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 's3labeltypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-counter .progressbar-text .label',
			)
		);
		$this->add_control(
			'strokewd1',
			array(
				'label'     => esc_html__( 'Stroke Width', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5,
				'step'      => 1,
				'default'   => 5,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter svg > path:nth-of-type(2)' => 'stroke-width:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'trailwd',
			array(
				'label'     => esc_html__( 'Trail Width', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5,
				'step'      => 1,
				'default'   => 3,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter svg > path:nth-of-type(1)' => 'stroke-width:{{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 's3_tabs' );
		$this->start_controls_tab(
			's3_num_days',
			array(
				'label' => esc_html__( 'Days', 'theplus' ),
			)
		);
		$this->add_control(
			's3daynumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daytextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daystrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3daystrailnncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(1) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_hours',
			array(
				'label' => esc_html__( 'Hours', 'theplus' ),
			)
		);
		$this->add_control(
			's3hoursnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3hourstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(2) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_minutes',
			array(
				'label' => esc_html__( 'Minutes', 'theplus' ),
			)
		);
		$this->add_control(
			's3minutnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3minuttextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3miutstrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3miutstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(3) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			's3_text_seconds',
			array(
				'label' => esc_html__( 'Second', 'theplus' ),
			)
		);
		$this->add_control(
			's3secondnumberncr',
			array(
				'label'     => esc_html__( 'Counter Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondtextncr',
			array(
				'label'     => esc_html__( 'Counter Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondtrokencr',
			array(
				'label'     => esc_html__( 'Counter Stroke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3secondstrailncr',
			array(
				'label'     => esc_html__( 'Counter Trail Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:nth-of-type(4) svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			's3hoverstyle',
			array(
				'label'     => __( 'Hover style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			's3numberhcr',
			array(
				'label'     => esc_html__( 'Number Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover .progressbar-text .number' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3texthcr',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover .progressbar-text .label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3trokehcr',
			array(
				'label'     => esc_html__( 'Stroke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover svg > path:nth-of-type(1)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			's3strailhcr',
			array(
				'label'     => esc_html__( 'Trail Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-counter .counter-part:hover svg > path:nth-of-type(2)' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'expirymessage_styling',
			array(
				'label'      => esc_html__( 'Expiry Message', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'normal',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showmsg',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'CDType',
									'operator' => '===',
									'value'    => 'scarcity',
								),
								array(
									'name'     => 'expirytype',
									'operator' => '===',
									'value'    => 'yes',
								),
								array(
									'name'     => 'countdownExpiry',
									'operator' => '===',
									'value'    => 'showmsg',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'expirymessagealign',
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
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'expirymessagepad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'expirymessagemar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'expirymessagetypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry',
			)
		);
		$this->start_controls_tabs( 'expirymessag_tabs' );
		$this->start_controls_tab(
			'expirymessag_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'expirymessagncr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'expirymessagnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'expirymessagngb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry',
			)
		);
		$this->add_responsive_control(
			'expirymessagnbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'expirymessagnsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'expirymessag_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'expirymessaghcr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'expirymessaghbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'expirymessaggb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry:hover',
			)
		);
		$this->add_responsive_control(
			'expirymessaghbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-countdown-expiry:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'expirymessaghsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-countdown-expiry:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'fakemsg_styling',
			array(
				'label'     => esc_html__( 'Fake Message', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType' => 'numbers',
				),
			)
		);
		$this->add_responsive_control(
			'fakestringalign',
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
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'fakestringpad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'fakestringmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'fakestringtypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number',
			)
		);
		$this->start_controls_tabs( 'fakestring_tabs' );
		$this->start_controls_tab(
			'fakestring_Normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'fakestringncr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fakestringnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fakestringb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number',
			)
		);
		$this->add_responsive_control(
			'fakestringnbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fakestringnsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fakestring_Hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'fakestringhcr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number:hover' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fakestringhbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fakestrihgb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover',
			)
		);
		$this->add_responsive_control(
			'fakestringhbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fakestringhsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'fakenumber_styling',
			array(
				'label'     => esc_html__( 'Fake Number', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'CDType' => 'numbers',
				),
			)
		);
		$this->add_responsive_control(
			'fakenumpad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'fakenumtypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter',
			)
		);

		$this->start_controls_tabs( 'fakenumber_tabs' );
		$this->start_controls_tab(
			'fakenumber_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'fakenumberncr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fakenumbernbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fakenumberngb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter',
			)
		);
		$this->add_responsive_control(
			'fakenumbernbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fakenumbernsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number .tp-fake-visiblecounter',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'fakenumber_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'fakenumberhcr',
			array(
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number:hover .tp-fake-visiblecounter' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'fakenumberhbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover .tp-fake-visiblecounter',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'fakenumberhgb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover .tp-fake-visiblecounter',
			)
		);
		$this->add_responsive_control(
			'fakenumberhbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown .tp-fake-number:hover .tp-fake-visiblecounter' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'fakenumberhsd',
				'selector' => '{{WRAPPER}} .tp-countdown .tp-fake-number:hover .tp-fake-visiblecounter',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'background_styling',
			array(
				'label' => esc_html__( 'Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'bgpad',
			array(
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bgmar',
			array(
				'label'      => __( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'bg_tabs' );
		$this->start_controls_tab(
			'bg_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bgnbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bgnb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->add_responsive_control(
			'bgnbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bgnsd',
				'selector' => '{{WRAPPER}} .tp-countdown',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bg_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bghbg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-countdown:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'bghb',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-countdown:hover',
			)
		);
		$this->add_responsive_control(
			'bghbr',
			array(
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-countdown:hover' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'bghsd',
				'selector' => '{{WRAPPER}} .tp-countdown:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/*Adv tab*/
		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();
		/*Adv tab*/

		/*--On Scroll View Animation ---*/
			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
			include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Countdown Render.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$uid       = uniqid( 'count_down' );
		$widget_id = $this->get_id();

		$woo_loop_switch = isset( $settings['woo_loop_switch'] ) ? $settings['woo_loop_switch'] : 'no';

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';
		/*--Plus Extra ---*/
		$PlusExtra_Class = 'plus-countdown-widget';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$c_d_type = ! empty( $settings['CDType'] ) ? $settings['CDType'] : 'normal';
		$style    = ! empty( $settings['CDstyle'] ) ? $settings['CDstyle'] : 'style-1';

		$offset_time  = get_option( 'gmt_offset' );
		$off_set_time = wp_timezone_string();

		$now = new \DateTime( 'NOW', new \DateTimeZone( $off_set_time ) );

		$future = '';

		$check_category = get_option( 'theplus_api_connection_data' );
		if ( 'yes' === $woo_loop_switch && ! empty( $check_category['theplus_woo_countdown_switch'] ) ) {
			$getdate = get_post_meta( get_the_id(), 'tpc_proc_ndate', true );

			if ( ! empty( $getdate ) ) {
				$future = new \DateTime( $getdate, new \DateTimeZone( $off_set_time ) );
			}
				$now = $now->modify( '+1 second' );

			if ( ! empty( $getdate ) ) {
				$counting_timer = $getdate;
				$counting_timer = date( 'm/d/Y H:i:s', strtotime( $counting_timer ) );
			} else {
				$curr_date      = date( 'm/d/Y H:i:s' );
				$counting_timer = date( 'm/d/Y H:i:s', strtotime( $curr_date . ' +1 month' ) );
			}
		} else {
			if ( ! empty( $settings['counting_timer'] ) ) {
				$future = new \DateTime( $settings['counting_timer'], new \DateTimeZone( $off_set_time ) );
			}
				$now = $now->modify( '+1 second' );

			if ( ! empty( $settings['counting_timer'] ) ) {
				$counting_timer = $settings['counting_timer'];
				$counting_timer = gmdate( 'm/d/Y H:i:s', strtotime( $counting_timer ) );
			} else {
				$curr_date      = gmdate( 'm/d/Y H:i:s' );
				$counting_timer = gmdate( 'm/d/Y H:i:s', strtotime( $curr_date . ' +1 month' ) );
			}
		}

		$count_down_expiry = ! empty( $settings['countdownExpiry'] ) ? $settings['countdownExpiry'] : '';

		$expirymsg = '';
		if ( 'redirect' === $count_down_expiry ) {
			$expirymsg = esc_url( $settings['expiryRedirect']['url'] );
		} elseif ( 'showmsg' === $count_down_expiry ) {
			$expirymsg = ! empty( $settings['expiryMsg'] ) ? $settings['expiryMsg'] : '';
		} elseif ( 'showtemp' === $count_down_expiry ) {
			$templates = Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['templates'] );
		}

		$days_labels    = ! empty( $settings['dayslabels'] ) ? true : false;
		$hours_labels   = ! empty( $settings['hourslabels'] ) ? true : false;
		$minutes_labels = ! empty( $settings['minuteslabels'] ) ? true : false;
		$seconds_labels = ! empty( $settings['secondslabels'] ) ? true : false;

		$show_labels  = ! empty( $settings['show_labels'] ) ? true : false;
		$text_days    = ! empty( $settings['text_days'] ) ? $settings['text_days'] : esc_html__( 'Days', 'theplus' );
		$text_hours   = ! empty( $settings['text_hours'] ) ? $settings['text_hours'] : esc_html__( 'Hours', 'theplus' );
		$text_minutes = ! empty( $settings['text_minutes'] ) ? $settings['text_minutes'] : esc_html__( 'Minutes', 'theplus' );

		$text_seconds    = ! empty( $settings['text_seconds'] ) ? $settings['text_seconds'] : esc_html__( 'Seconds', 'theplus' );
		$show_labels_tag = ! empty( $settings['show_labels_tag'] ) ? $settings['show_labels_tag'] : 'h6';

		$fliptheme    = '';
		$flip_mixtime = '';
		if ( 'style-2' === $style ) {
			$fliptheme    = ! empty( $settings['fliptheme'] ) ? $settings['fliptheme'] : 'dark';
			$flip_mixtime = ! empty( $settings['flipMixtime'] ) ? $settings['flipMixtime'] : 3;
		}

		$expirytype = ! empty( $settings['expirytype'] ) ? 'expiry' : '';

		$normalexpiry = '';
		if ( $future >= $now && isset( $future ) ) {
			$normalexpiry = true;
		} else {
			$normalexpiry = false;
		}

		$style_class = '';
		if ( 'normal' === $c_d_type || 'scarcity' === $c_d_type ) {
			$style_class = 'countdown-' . $style;

			$c_d_data = array(
				'widgetid'      => $widget_id,
				'type'          => $c_d_type,
				'style'         => $style,
				'expiry'        => $count_down_expiry,
				'expirymsg'     => $expirymsg,

				'fliptheme'     => $fliptheme,
				'flipMixtime'   => $flip_mixtime,

				'days'          => $text_days,
				'hours'         => $text_hours,
				'minutes'       => $text_minutes,
				'seconds'       => $text_seconds,

				'daysenable'    => $days_labels,
				'hoursenable'   => $hours_labels,
				'minutesenable' => $minutes_labels,
				'secondsenable' => $seconds_labels,
			);
		}

		if ( 'normal' === $c_d_type ) {
			$other_dataa = array(
				'offset'       => $offset_time,
				'normalexpiry' => $normalexpiry,
				'expirytype'   => 'expiry',
				'timer'        => $counting_timer,
			);

			$c_d_data = array_merge( $c_d_data, $other_dataa );
		} elseif ( 'numbers' === $c_d_type ) {
			$store_type = ! empty( $settings['storetype'] ) ? $settings['storetype'] : 'normal';
			$fakeloop   = ! empty( $settings['fackeLoop'] ) ? true : false;

			$ginitnum  = '';
			$gendnum   = '';
			$gnumrange = '';

			$gchangeinterval = '';

			if ( 'yes' === $woo_loop_switch && ! empty( $check_category['theplus_woo_countdown_switch'] ) ) {
				$initialnumber     = get_post_meta( get_the_id(), 'tpc_proc_fn_ini_num', true );
				$finalnumber       = get_post_meta( get_the_id(), 'tpc_proc_fn_final_num', true );
				$numberrange       = get_post_meta( get_the_id(), 'tpc_proc_fn_num_range', true );
				$changeintervalsec = get_post_meta( get_the_id(), 'tpc_proc_ci_in_sec', true );

				if ( ! empty( $initialnumber ) && ! empty( $finalnumber ) && ! empty( $numberrange ) && ! empty( $changeintervalsec ) ) {
					$ginitnum        = $initialnumber;
					$gendnum         = $finalnumber;
					$gnumrange       = $numberrange;
					$gchangeinterval = $changeintervalsec;
				}
			} else {
				$ginitnum  = $settings['initNum'];
				$gendnum   = $settings['endNum'];
				$gnumrange = $settings['numRange'];

				$gchangeinterval = $settings['changeInterval'];
			}

			$c_d_data = array(
				'widgetid'      => $widget_id,
				'type'          => $c_d_type,
				'fakeinitminit' => $ginitnum,
				'fakeend'       => $gendnum,
				'fakerange'     => $gnumrange,
				'fakeinterval'  => $gchangeinterval,
				'fakeloop'      => $fakeloop,
				'fackeMassage'  => $settings['fackemassage'],
				'storetype'     => $store_type,
			);

			if ( empty( $fakeloop ) ) {
				unset( $c_d_data['fakeloop'] );
			}
		} elseif ( 'scarcity' === $c_d_type ) {
			$store_type = ! empty( $settings['storetype'] ) ? $settings['storetype'] : 'normal';

			$loop = ! empty( $settings['fackeLoop'] ) ? true : false;

			$delayminit = '';

			$scarevalue = 0;
			if ( 'yes' === $woo_loop_switch && ! empty( $check_category['theplus_woo_countdown_switch'] ) ) {
				$scarevalueget = get_post_meta( get_the_id(), 'tpc_proc_ns_days', true );
				if ( ! empty( $scarevalueget ) ) {
						$scarevalue = $scarevalueget;
				}
			} else {
				$scarevalue = ! empty( $settings['cityminit'] ) ? $settings['cityminit'] : 0;
				$delayminit = ! empty( $settings['delayminit'] ) ? $settings['delayminit'] : 0;
			}

			$other_dataa = array(
				'scarminit'  => $scarevalue,
				'storetype'  => $store_type,
				'fakeloop'   => $loop,
				'delayminit' => $delayminit,
				'expirytype' => $expirytype,
			);

			$c_d_data = array_merge( $c_d_data, $other_dataa );

			if ( ! empty( $expirytype ) ) {
				if ( 'redirect' !== $count_down_expiry && 'showmsg' !== $count_down_expiry ) {
					unset( $c_d_data['expirymsg'] );
				}
			} else {
				unset( $c_d_data['expirytype'], $c_d_data['expiry'], $c_d_data['expirymsg'] );
			}

			if ( empty( $loop ) ) {
				unset( $c_d_data['fakeloop'] );
				unset( $c_d_data['delayminit'] );
			}

			if ( 'style-2' !== $style ) {
				unset( $c_d_data['fliptheme'] );
			} elseif ( 'mix' !== $fliptheme ) {
				unset( $c_d_data['flipMixtime'] );
			}
		}

		if ( 'normal' === $c_d_type || 'scarcity' === $c_d_type ) {

			if ( 'none' === $count_down_expiry ) {
				unset( $c_d_data['expirytype'] );
				unset( $c_d_data['expirymsg'] );
			}

			if ( 'style-2' !== $style ) {
				unset( $c_d_data['fliptheme'] );
				unset( $c_d_data['flipMixtime'] );
			} elseif ( 'mix' !== $fliptheme ) {
				unset( $c_d_data['flipMixtime'] );
			}
		}

		$classdata = '';

		$cd_classbased = isset( $settings['cd_classbased'] ) ? 'yes' : 'no';

		if ( isset( $cd_classbased ) && 'yes' === $cd_classbased && ! empty( $c_d_type ) && ( 'normal' === $c_d_type || 'scarcity' === $c_d_type ) && ! empty( $settings['CDstyle'] ) && 'style-3' !== $settings['CDstyle'] ) {
			$cd_class_1 = ! empty( $settings['cd_class_1'] ) ? $settings['cd_class_1'] : '';
			$cd_class_2 = ! empty( $settings['cd_class_2'] ) ? $settings['cd_class_2'] : '';

			if ( ! empty( $cd_class_1 ) && ! empty( $cd_class_2 ) ) {
				$classbaseddata = array(
					'duringcountdownclass'   => '.' . $cd_class_1,
					'afterexpcountdownclass' => '.' . $cd_class_2,
				);

				$classdata = 'data-classlist = ' . htmlspecialchars( wp_json_encode( $classbaseddata ), ENT_QUOTES, 'UTF-8' );
			}
		}

		$c_d_data = htmlspecialchars( wp_json_encode( $c_d_data ), ENT_QUOTES, 'UTF-8' );

		$output = '';
		if ( ( 'yes' === $woo_loop_switch && ! empty( $check_category['theplus_woo_countdown_switch'] ) && ! empty( $getdate ) || ( ! empty( $scarevalueget ) && $scarevalueget > 0 ) || ( ! empty( $initialnumber ) && $initialnumber > 0 && ! empty( $finalnumber ) && $finalnumber > 0 && ! empty( $numberrange ) && $numberrange > 0 && ! empty( $changeintervalsec ) && $changeintervalsec > 0 ) ) || ( 'no' === $woo_loop_switch ) ) {

			$output = '<div class="tp-countdown tp-widget-' . esc_attr( $widget_id ) . ' ' . esc_attr( $style_class ) . '" data-basic="' . esc_attr( $c_d_data ) . '" ' . esc_attr( $classdata ) . ' >';

			if ( 'normal' === $c_d_type ) {
				if ( $future >= $now && isset( $future ) || 'none' === $count_down_expiry ) {
					if ( 'style-1' === $style ) {
						$inline_style = ( ! empty( $settings['inline_style'] ) && 'yes' === $settings['inline_style'] ) ? 'count-inline-style' : '';

						$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['days_background_image'] ) : '';
						$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['hours_background_image'] ) : '';
						$lz3 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['minutes_background_image'] ) : '';
						$lz4 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['seconds_background_image'] ) : '';

						$output .= '<ul class="pt_plus_countdown ' . esc_attr( $uid ) . ' ' . esc_attr( $inline_style ) . ' ' . $animated_class . '" ' . $animation_attr . '>';

						if ( ! empty( $days_labels ) ) {
							$output .= '<li class="count_1 ' . $lz1 . '">';

							$output .= '<span class="days">' . esc_html__( '00', 'theplus' ) . '</span>';

							if ( ! empty( $show_labels ) ) {
								$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="days_ref label-ref">' . esc_html( $text_days ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
							}

							$output .= '</li>';
						}

						if ( ! empty( $hours_labels ) ) {
							$output .= '<li class="count_2 ' . $lz2 . '">';

							$output .= '<span class="hours">' . esc_html__( '00', 'theplus' ) . '</span>';

							if ( ! empty( $show_labels ) ) {
								$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="hours_ref label-ref">' . esc_html( $text_hours ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
							}
							$output .= '</li>';
						}

						if ( ! empty( $minutes_labels ) ) {
							$output     .= '<li class="count_3 ' . $lz3 . '">';
								$output .= '<span class="minutes">' . esc_html__( '00', 'theplus' ) . '</span>';
							if ( ! empty( $show_labels ) ) {
								$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="minutes_ref label-ref">' . esc_html( $text_minutes ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
							}
							$output .= '</li>';
						}

						if ( ! empty( $seconds_labels ) ) {
							$output     .= '<li class="count_4 ' . $lz4 . '">';
								$output .= '<span class="seconds last">' . esc_html__( '00', 'theplus' ) . '</span>';
							if ( ! empty( $show_labels ) ) {
								$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="seconds_ref label-ref">' . esc_html( $text_seconds ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
							}
							$output .= '</li>';
						}

						$output .= '</ul>';
					}
				}
			} elseif ( 'scarcity' === $c_d_type ) {
				$inline_style = ! empty( $settings['inline_style'] ) && 'yes' === $settings['inline_style'] ? 'count-inline-style' : '';
				if ( 'style-1' === $style ) {
					$output .= '<ul class="pt_plus_countdown ' . esc_attr( $uid ) . ' ' . esc_attr( $inline_style ) . '">';

					if ( ! empty( $days_labels ) ) {
						$output     .= '<li class="count_1">';
							$output .= '<span class="days">' . esc_html__( '00', 'theplus' ) . '</span>';
						if ( ! empty( $show_labels ) ) {
							$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="days_ref">' . esc_html( $text_days ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
						}
							$output .= '</li>';
					}

					if ( ! empty( $hours_labels ) ) {
							$output     .= '<li class="count_2">';
								$output .= '<span class="hours">' . esc_html__( '00', 'theplus' ) . '</span>';
						if ( ! empty( $show_labels ) ) {
								$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="hours_ref">' . esc_html( $text_hours ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
						}
							$output .= '</li>';
					}

					if ( ! empty( $minutes_labels ) ) {
						$output .= '<li class="count_3">';
						$output .= '<span class="minutes">' . esc_html__( '00', 'theplus' ) . '</span>';
						if ( ! empty( $show_labels ) ) {
							$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="minutes_ref">' . esc_html( $text_minutes ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
						}
						$output .= '</li>';
					}

					if ( ! empty( $seconds_labels ) ) {
						$output .= '<li class="count_4">';
						$output .= '<span class="seconds last">' . esc_html__( '00', 'theplus' ) . '</span>';
						if ( ! empty( $show_labels ) ) {
							$output .= '<' . theplus_validate_html_tag( $show_labels_tag ) . ' class="seconds_ref">' . esc_html( $text_seconds ) . '</' . theplus_validate_html_tag( $show_labels_tag ) . '>';
						}
						$output .= '</li>';
					}

					$output .= '</ul>';
				}
			}

			if ( 'normal' === $c_d_type || 'scarcity' === $c_d_type ) {
				if ( 'showtemp' === $count_down_expiry ) {
					$output     .= "<div class='tp-expriy-template tp-hide'>";
						$output .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['templates'] );
					$output     .= '</div>';
				}
			}
			$output .= '</div>';

		}

		echo $before_content . $output . $after_content;
	}
}
