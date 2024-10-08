<?php
/**
 * Widget Name: TP Navigation Menu
 * Description: Style of header navigation bar menu
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Navigation_Menu
 */
class ThePlus_Navigation_Menu extends Widget_Base {

	public $tp_doc = THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-navigation-menu';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Navigation Menu', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-bars theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-header' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Navigation', 'Menu', 'Nav', 'Navbar', 'Navigation bar', 'Navigation menu', 'Menu widget', 'Navigation widget', 'Horizontal Mega Menu', 'Horizontal Menu', 'Elementor Menu Widget', 'Vertical Mega Menu', 'Vertical Menu', 'Mega Menu', 'Elementor Menu', 'Elementor Mega Menu', 'Elementor Vertical Menu', 'Vertical Navigation', 'Vertical Navigation Menu', 'Vertical Toggle Menu', 'Vertical Accordion Menu', 'Vertical Collapsible Menu', 'Vertical Expandable Menu', 'Vertical Dropdown Menu', 'Vertical Toggle Navigation', 'Vertical Toggle Menu Widget', 'Elementor Vertical Toggle Menu', 'Elementor Vertical Accordion Menu', 'Elementor Vertical Collapsible Menu', 'Elementor Vertical Expandable Menu', 'Elementor Vertical Dropdown Menu', 'Elementor Vertical Navigation Menu', 'Elementor Vertical Toggle Navigation', 'Sticky navigation', 'Fixed navigation', 'Floating navigation', 'Persistent navigation', 'Scrollable navigation', 'Header navigation', 'Menu bar', 'Sticky menu' );
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
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'navbar_sections',
			array(
				'label' => esc_html__( 'Navigation Bar', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'TypeMenu',
			array(
				'label'   => esc_html__( 'Menu Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'options' => array(
					'standard' => esc_html__( 'Default', 'theplus' ),
					'custom'   => esc_html__( 'Repeater', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_repeater',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-menu-with-repeater-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'TypeMenu' => array( 'custom' ),
				),
			)
		);
		$this->add_control(
			'navbar_menu_type',
			array(
				'label'   => esc_html__( 'Menu Direction', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal'    => esc_html__( 'Horizontal Menu', 'theplus' ),
					'vertical'      => esc_html__( 'Vertical Menu', 'theplus' ),
					'vertical-side' => esc_html__( 'Vertical Side Menu', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_horizontal',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-mega-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'navbar_menu_type' => array( 'horizontal' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_vertical',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-vertical-mega-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'navbar_menu_type' => array( 'vertical' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_sidemenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-side-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'navbar_menu_type' => array( 'vertical-side' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'depth',
			array(
				'label'   => esc_html__( 'Menu Level', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array(
					'0' => esc_html__( '0 Level', 'theplus' ),
					'1' => esc_html__( '1 Level', 'theplus' ),
					'2' => esc_html__( '2 Level', 'theplus' ),
					'3' => esc_html__( '3 Level', 'theplus' ),
					'4' => esc_html__( '4 Level', 'theplus' ),
					'5' => esc_html__( '5 Level', 'theplus' ),
					'6' => esc_html__( '6 Level', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'SmenuType',
			array(
				'label'     => esc_html__( 'Sub Menu Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'link',
				'options'   => array(
					'link'      => esc_html__( 'Link', 'theplus' ),
					'mega-menu' => esc_html__( 'Mega Menu', 'theplus' ),
				),
				'condition' => array(
					'depth' => '1',
				),
			)
		);
		$repeater->add_control(
			'LinkFilter',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array( 'active' => true ),
				'conditions'    => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '!=',
									'value'    => '1',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '==',
									'value'    => '1',
								),
								array(
									'name'     => 'SmenuType',
									'operator' => '==',
									'value'    => 'link',
								),
							),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'filterlabel',
			array(
				'label'       => esc_html__( 'Menu Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '!=',
									'value'    => '1',
								),
							),
						),
						array(
							'terms' => array(
								array(
									'name'     => 'depth',
									'operator' => '==',
									'value'    => '1',
								),
								array(
									'name'     => 'SmenuType',
									'operator' => '==',
									'value'    => 'link',
								),
							),
						),
					),
				),
			)
		);
		$repeater->add_control(
			'blockTemp',
			array(
				'label'       => esc_html__( 'Template', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'depth'     => '1',
					'SmenuType' => 'mega-menu',
				),
			)
		);
		$repeater->add_control(
			'megaMType',
			array(
				'label'     => esc_html__( 'Mega Menu Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'    => esc_html__( 'Default', 'theplus' ),
					'container'  => esc_html__( 'Container', 'theplus' ),
					'full-width' => esc_html__( 'Full Width', 'theplus' ),
				),
				'condition' => array(
					'depth'     => '1',
					'SmenuType' => 'mega-menu',
				),
			)
		);
		$repeater->add_control(
			'megaMwid',
			array(
				'label'      => esc_html__( 'Container Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner .navbar-nav li{{CURRENT_ITEM}} > ul.dropdown-menu' => 'max-width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};right: auto;',
				),
				'condition'  => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'megaMAlign',
			array(
				'label'     => esc_html__( 'Dropdown Menu Alignment', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'Default', 'theplus' ),
					'center'  => esc_html__( 'Center', 'theplus' ),
				),
				'condition' => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'moblieMmenu',
			array(
				'label'     => esc_html__( 'Moblie Mega Menu Link', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$repeater->add_control(
			'MLinkFilter',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array( 'active' => true ),
				'condition'     => array(
					'moblieMmenu' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'Mfilterlabel',
			array(
				'label'       => esc_html__( 'Menu Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'moblieMmenu' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'minWidth',
			array(
				'label'      => esc_html__( 'Submenu Minimum Width (Px)', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 100,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} > ul.dropdown-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'megaMType' => 'default',
				),
			)
		);
		$repeater->add_control(
			'showlabel',
			array(
				'label'     => esc_html__( 'Label', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$repeater->add_control(
			'labeltxt',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'New', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'labelcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text,{{WRAPPER}} .plus-mobile-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'labelBgcolor',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text,{{WRAPPER}} .plus-mobile-menu .navbar-nav li{{CURRENT_ITEM}} a .plus-nav-label-text' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'showlabel' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'menuiconTy',
			array(
				'label'   => esc_html__( 'Menu Icon Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => esc_html__( 'None', 'theplus' ),
					'icon' => esc_html__( 'Icon', 'theplus' ),
					'img'  => esc_html__( 'Image', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'preicon',
			array(
				'label'     => esc_html__( 'Select Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-home',
					'library' => 'solid',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'menuImg',
			array(
				'label'     => esc_html__( 'Upload Icon Image', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'menuiconTy' => 'img',
				),
			)
		);
		$repeater->start_controls_tabs( 'tab_mega_menu_rep' );
		$repeater->start_controls_tab(
			'tab_mega_menu_Nml',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}} >a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconborcolor',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}} >a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}} >a>span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_mega_menu_Hvr',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconHvrPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>span.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconHvrcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>span.plus-navicon-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconHvrBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconhvrborcolor',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}:hover>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}:hover>a>.plus-navicon-wrap .plus-nav-icon-menu',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_mega_menu_Act',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'iconActPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap .plus-nav-icon-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'iconActcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menuiconTy' => 'icon',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'iconActBg',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-menu .navbar-nav li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap,{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'iconActborcolor',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .plus-navigation-inner .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu li{{CURRENT_ITEM}}.active>a span.plus-navicon-wrap .plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav>li{{CURRENT_ITEM}}.active>a>.plus-navicon-wrap .plus-nav-icon-menu',
				'condition' => array(
					'menuiconTy!' => '',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'navDesc',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Description', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'classTxt',
			array(
				'label'       => esc_html__( 'Custom Class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Class Name', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'ItemMenu',
			array(
				'label'       => esc_html__( 'Navigation Menu', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'depth' => '0',
					),
				),
				'title_field' => 'Level {{{ depth }}}',
				'condition'   => array(
					'TypeMenu' => 'custom',
				),
			)
		);
		$this->add_control(
			'vertical_side_open_right',
			array(
				'label'     => esc_html__( 'Open Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'vso_left',
				'options'   => array(
					'vso_left'  => esc_html__( 'Left', 'theplus' ),
					'vso_right' => esc_html__( 'Right', 'theplus' ),
				),
				'condition' => array(
					'navbar_menu_type' => 'vertical-side',
				),
			)
		);
		$this->add_control(
			'navbar',
			array(
				'label'     => wp_kses_post( "Select Menu <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-side-mega-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_navigation_menulist(),
				'condition' => array(
					'TypeMenu' => 'standard',
				),
			)
		);
		$this->add_control(
			'menu_hover_click',
			array(
				'label'   => esc_html__( 'Menu Hover/Click', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => array(
					'hover' => esc_html__( 'Hover Sub-Menu', 'theplus' ),
					'click' => esc_html__( 'Click Sub-Menu', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_hovermenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-dropdown-on-hover-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'menu_hover_click' => array( 'hover' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_clickmenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-dropdown-on-click-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'menu_hover_click' => array( 'click' ),
				),
			)
		);
		$this->add_control(
			'menu_transition',
			array(
				'label'   => esc_html__( 'Menu Effects', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Slide Up/Down (Js)', 'theplus' ),
					'style-2' => esc_html__( 'Fade In/Out (Js)', 'theplus' ),
					'style-3' => esc_html__( 'Fade Up/Down', 'theplus' ),
					'style-4' => esc_html__( 'Fade In/Out', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'vertical_side_title_bar',
			array(
				'label'     => esc_html__( 'Vertical Side Title Bar', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'navbar_menu_type' => 'vertical-side',
				),
			)
		);
		$this->add_control(
			'vertical_side_type',
			array(
				'label'     => esc_html__( 'Title Bar Hover/Click', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => array(
					'normal' => esc_html__( 'Normal', 'theplus' ),
					'hover'  => esc_html__( 'Hover', 'theplus' ),
					'click'  => esc_html__( 'Click', 'theplus' ),
				),
				'condition' => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'vertical_side_click_open',
			array(
				'label'     => esc_html__( 'Default Open Click', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'navbar_menu_type'   => 'vertical-side',
					'vertical_side_type' => 'click',
				),
			)
		);
		$this->add_control(
			'vertical_side_title_text',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Navigation Menu', 'theplus' ),
				'placeholder' => esc_html__( 'Navigation Menu', 'theplus' ),
				'condition'   => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'vertical_side_title_link',
			array(
				'label'       => esc_html__( 'Title Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'before',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
					'vertical_side_type!'     => 'click',
				),
			)
		);
		$this->add_control(
			'loop_icon_prefix',
			array(
				'label'     => esc_html__( 'Prefix Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-bars',
					'library' => 'solid',
				),
				'condition' => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'loop_icon_postfix',
			array(
				'label'     => esc_html__( 'Postfix Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-angle-down',
					'library' => 'solid',
				),
				'condition' => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'nav_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'text-center',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_control(
			'enable_sticky_menu',
			array(
				'label'     => wp_kses_post( "Sticky Menu <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-sticky-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'enable_sticky_osup_menu',
			array(
				'label'     => esc_html__( 'On Mouse Scroll Up Sticky', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'enable_sticky_menu' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_mobile_menu_options',
			array(
				'label' => esc_html__( 'Mobile Menu', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'show_mobile_menu',
			array(
				'label'     => esc_html__( 'Responsive Mobile Menu', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'mobile_menu_type',
			array(
				'label'     => esc_html__( 'Menu Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'toggle',
				'options'   => array(
					'toggle'     => esc_html__( 'Toggle', 'theplus' ),
					'swiper'     => esc_html__( 'Swiper', 'theplus' ),
					'off-canvas' => esc_html__( 'Off Canvas', 'theplus' ),
				),
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'how_it_works_offcanvas',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-an-off-canvas-mobile-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mobile_menu_type' => array( 'off-canvas' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_swiper',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-swiper-menu-for-mobile-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mobile_menu_type' => array( 'swiper' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_toggle',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-toggle-menu-for-mobile-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mobile_menu_type' => array( 'toggle' ),
				),
			)
		);
		$this->add_control(
			'menuWidth',
			array(
				'label'      => esc_html__( 'Custom Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 750,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu.plus-menu-off-canvas,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu.plus-menu-off-canvas .navbar-nav' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu.mobile-plus-toggle-menu,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu.mobile-plus-toggle-menu .navbar-nav' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_mobile_menu' => 'yes',
					'mobile_menu_type' => 'off-canvas',
				),
			)
		);
		$this->add_control(
			'open_mobile_menu',
			array(
				'label'      => esc_html__( 'Open Mobile Menu', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1500,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 991,
				),
				'condition'  => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_menu_toggle_style',
			array(
				'label'     => esc_html__( 'Toggle Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Custom', 'theplus' ),
				),
				'condition' => array(
					'show_mobile_menu' => 'yes',
					'mobile_menu_type' => 'toggle',
				),
			)
		);
		$this->add_control(
			'mmts_custom',
			array(
				'label'     => esc_html__( 'Custom', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom_icon',
				'options'   => array(
					'custom_icon' => esc_html__( 'Icon', 'theplus' ),
					'custom_img'  => esc_html__( 'Image', 'theplus' ),
				),
				'condition' => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
				),
			)
		);
		$this->add_control(
			'mmts_custom_icon',
			array(
				'label'     => esc_html__( 'Open Custom Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-searchengin',
					'library' => 'solid',
				),
				'condition' => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
					'mmts_custom'              => 'custom_icon',
				),
			)
		);
		$this->add_control(
			'mmts_custom_icon_c',
			array(
				'label'     => esc_html__( 'Close Custom Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fab fa-searchengin',
					'library' => 'solid',
				),
				'condition' => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
					'mmts_custom'              => 'custom_icon',
				),
			)
		);
		$this->add_control(
			'mmts_custom_image',
			array(
				'label'      => esc_html__( 'Open Custom Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
					'mmts_custom'              => 'custom_img',
				),
			)
		);
		$this->add_control(
			'mmts_custom_image_c',
			array(
				'label'      => esc_html__( 'Close Custom Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
					'mmts_custom'              => 'custom_img',
				),
			)
		);
		$this->add_control(
			'mobile_toggle_alignment',
			array(
				'label'       => esc_html__( 'Toggle Alignment', 'theplus' ),
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
				'separator'   => 'before',
				'default'     => 'flex-end',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle.mobile-toggle' => 'justify-content: {{VALUE}}',
				),
				'condition'   => array(
					'show_mobile_menu' => 'yes',
					'mobile_menu_type' => 'toggle',
				),
			)
		);
		$this->add_control(
			'mobile_nav_alignment',
			array(
				'label'       => esc_html__( 'Navigation Alignment', 'theplus' ),
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
				'separator'   => 'before',
				'default'     => 'flex-start',
				'toggle'      => true,
				'label_block' => false,
				'selectors'   => array(
					'{{WRAPPER}} .plus-mobile-menu-content .nav li a' => 'text-align: {{VALUE}}',
				),
				'condition'   => array(
					'show_mobile_menu'    => 'yes',
					'mobile_menu_content' => 'normal-menu',
				),
			)
		);
		$this->add_control(
			'mobile_menu_content',
			array(
				'label'     => esc_html__( 'Menu Content', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal-menu',
				'options'   => array(
					'normal-menu'   => esc_html__( 'Normal Menu', 'theplus' ),
					'template-menu' => esc_html__( 'Template Menu', 'theplus' ),
				),
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'how_it_works_templatemenu',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-hamburger-mobile-menu-with-elementor-template/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mobile_menu_content' => array( 'template-menu' ),
				),
			)
		);
		$this->add_control(
			'mobile_navbar',
			array(
				'label'     => esc_html__( 'Select Menu', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_navigation_menulist(),
				'condition' => array(
					'show_mobile_menu'    => 'yes',
					'mobile_menu_content' => 'normal-menu',
				),
			)
		);
		$this->add_control(
			'mobile_navbar_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'show_mobile_menu'    => 'yes',
					'mobile_menu_content' => 'template-menu',
					'mobile_menu_type!'   => 'off-canvas',
				),
			)
		);
		$this->add_control(
			'mobile_navbar_outer_click',
			array(
				'label'     => esc_html__( 'Mobile Click Close Menu', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_navbar_outer_click_note',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : By Enabling, Mobile Menu will close on click anywhere on web page.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'outer_nav_styling',
			array(
				'label'     => esc_html__( 'Outer Navigation', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navbar_menu_type' => 'vertical-side',
				),
			)
		);
		$this->add_responsive_control(
			'outer_nav_min_width',
			array(
				'label'      => esc_html__( 'Navigation Minimum Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 150,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 240,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav,{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle' => 'max-width: {{SIZE}}{{UNIT}};',

				),
			)
		);
		$this->add_responsive_control(
			'outer_nav_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'outer_nav_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav',
			)
		);
		$this->add_responsive_control(
			'outer_nav_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'outer_nav_bg_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'outer_nav_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav',

			)
		);
		$this->add_control(
			'outer_nav_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'outer_nav_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu.menu-vertical-side .navbar-nav',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'vertical_side_title_bar_styling',
			array(
				'label'     => esc_html__( 'Vertical Side Title Bar', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'navbar_menu_type'        => 'vertical-side',
					'vertical_side_title_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'vertical_side_title_heading',
			array(
				'label' => esc_html__( 'Title Options', 'theplus' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'vs_title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle',
			)
		);
		$this->start_controls_tabs( 'tabs_vs_title' );
		$this->start_controls_tab(
			'tab_vs_title_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_title_color_n',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_vs_title_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_title_color_h',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'vertical_side_prefix_icn_heading',
			array(
				'label'     => esc_html__( 'Prefix Icon Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'vs_prefix_icn_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle span > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle span > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_vs_prefix' );
		$this->start_controls_tab(
			'tab_vs_prefix_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_prefix_color_n',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle span > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle span > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_vs_prefix_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_prefix_color_h',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover span > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover span > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'vertical_side_postfix_icn_heading',
			array(
				'label'     => esc_html__( 'Postfix Icon Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'vs_postfix_icn_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_vs_postfix' );
		$this->start_controls_tab(
			'tab_vs_postfix_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_postfix_color_n',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_vs_postfix_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_vs_postfix_color_h',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover > svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'vertical_side_whole_heading',
			array(
				'label'     => esc_html__( 'Title Bar Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'vertical_side_whole_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_vs_whole' );
		$this->start_controls_tab(
			'tab_vs_whole_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'vs_whole_background_n',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_vs_whole_border_n',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle',
			)
		);
		$this->add_responsive_control(
			'tab_vs_whole_border_radius_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_vs_whole_shadow_n',
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_vs_whole_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'tab_vs_whole_background_h',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_vs_whole_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover',
			)
		);
		$this->add_responsive_control(
			'tab_vs_whole_border_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tab_vs_whole_shadow_h',
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-vertical-side-toggle:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'main_menu_styling',
			array(
				'label' => esc_html__( 'Main Menu', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'main_menu_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->add_responsive_control(
			'main_menu_outer_padding',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'main_menu_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '5',
					'bottom'   => '10',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-2 .plus-navigation-menu .navbar-nav > li.dropdown > a:before' => 'right: calc({{RIGHT}}{{UNIT}} + 3px);',
					'[dir="rtl"] {{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-2 .plus-navigation-menu .navbar-nav > li.dropdown > a:before' => 'left: calc({{Left}}{{UNIT}} + 3px);right:auto;',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu.menu-vertical-side .navbar-nav>li.dropdown>a:after' => 'right: calc({{RIGHT}}{{UNIT}} + 3px);',
					'[dir="rtl"] {{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu.menu-vertical-side .navbar-nav>li.dropdown>a:after' => 'left: calc({{LEFT}}{{UNIT}} + 3px);right:auto;',
				),
			)
		);
		$this->add_control(
			'main_menu_indicator_style',
			array(
				'label'     => esc_html__( 'Main Menu Indicator Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'    => esc_html__( 'None', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'mm_triangle_shape',
			array(
				'label'     => esc_html__( 'Dropdown Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.menu-item.menu-item-has-children:hover a:before' => 'content: "";',
				),
			)
		);
		$this->add_control(
			'mm_triangle_shape_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'condition' => array(
					'mm_triangle_shape' => 'yes',
				),
			)
		);
		$this->add_control(
			'mm_triangle_shape_size',
			array(
				'label'      => esc_html__( 'Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 15,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 7,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.menu-item.menu-item-has-children:hover a:before' => 'border-left: {{SIZE}}{{UNIT}} solid transparent;border-right: {{SIZE}}{{UNIT}} solid transparent;border-bottom: {{SIZE}}{{UNIT}} solid {{mm_triangle_shape_color.VALUE}};',

				),
				'condition'  => array(
					'mm_triangle_shape' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_main_menu_style' );
		$this->start_controls_tab(
			'tab_main_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'main_menu_normal_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_icon_cls_color',
			array(
				'label'     => esc_html__( 'Normal Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu.icon-img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_icon_color',
			array(
				'label'     => esc_html__( 'Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'main_menu_normal_border_style',
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
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_normal_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_normal_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_normal_bg_options',
			array(
				'label'     => esc_html__( 'Normal Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',

			)
		);
		$this->add_control(
			'main_menu_normal_shadow_options',
			array(
				'label'     => esc_html__( 'Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_normal_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_main_menu_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'main_menu_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_icon_cls_color',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_icon_color',
			array(
				'label'     => esc_html__( 'Hover Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:hover > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_border_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_bg_options',
			array(
				'label'     => esc_html__( 'Hover Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a',

			)
		);
		$this->add_control(
			'main_menu_hover_shadow_options',
			array(
				'label'     => esc_html__( 'Hover Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:hover > a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_main_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'main_menu_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_active_icon_cls_color',
			array(
				'label'     => esc_html__( 'Active Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a >.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a>.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'main_menu_active_icon_color',
			array(
				'label'     => esc_html__( 'Hover Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.current_page_item > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'main_menu_active_border_color',
			array(
				'label'     => esc_html__( 'Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'main_menu_active_radius',
			array(
				'label'      => esc_html__( 'Active Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_active_bg_options',
			array(
				'label'     => esc_html__( 'Active Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',

			)
		);
		$this->add_control(
			'main_menu_active_shadow_options',
			array(
				'label'     => esc_html__( 'Active Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'main_menu_active_shadow',
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'smain_menu_styling',
			array(
				'label'     => esc_html__( 'Sticky Main Menu', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'enable_sticky_menu' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'smain_menu_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->add_responsive_control(
			'smain_menu_outer_padding',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}}  .plus-navigation-menu .navbar-nav>li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'smain_menu_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '5',
					'bottom'   => '10',
					'left'     => '5',
					'isLinked' => false,
				),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-2 .plus-navigation-menu .navbar-nav > li.dropdown > a:before' => 'right: calc({{RIGHT}}{{UNIT}} + 3px);',
					'[dir="rtl"] .plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-2 .plus-navigation-menu .navbar-nav > li.dropdown > a:before' => 'left: calc({{Left}}{{UNIT}} + 3px);right:auto;',
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}}  .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu.menu-vertical-side .navbar-nav>li.dropdown>a:after' => 'right: calc({{RIGHT}}{{UNIT}} + 3px);',
					'[dir="rtl"] .plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}}  .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu.menu-vertical-side .navbar-nav>li.dropdown>a:after' => 'left: calc({{LEFT}}{{UNIT}} + 3px);right:auto;',
				),
			)
		);
		$this->add_control(
			'smain_menu_indicator_style',
			array(
				'label'     => esc_html__( 'Main Menu Indicator Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'    => esc_html__( 'None', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
				),
				'separator' => 'after',
			)
		);

		$this->start_controls_tabs( 'tabs_smain_menu_style' );
		$this->start_controls_tab(
			'tab_smain_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'smain_menu_normal_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}}  .plus-navigation-menu .navbar-nav>li>a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_normal_icon_cls_color',
			array(
				'label'     => esc_html__( 'Normal Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'font-size: {{SIZE}}{{UNIT}};',
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}}  .plus-navigation-menu .navbar-nav>li>a>.plus-nav-icon-menu.icon-img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'smain_menu_normal_icon_color',
			array(
				'label'     => esc_html__( 'Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'smain_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'smain_menu_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'smain_menu_normal_border_style',
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
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'smain_menu_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'smain_menu_normal_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'smain_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'smain_menu_normal_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'smain_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'smain_menu_normal_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'smain_menu_normal_bg_options',
			array(
				'label'     => esc_html__( 'Normal Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'smain_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a',

			)
		);
		$this->add_control(
			'smain_menu_normal_shadow_options',
			array(
				'label'     => esc_html__( 'Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'smain_menu_normal_shadow',
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav>li>a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_smain_menu_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'smain_menu_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_hover_icon_cls_color',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_hover_icon_color',
			array(
				'label'     => esc_html__( 'Hover Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:hover > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'smain_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'smain_menu_hover_border_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'smain_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'smain_menu_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'smain_menu_hover_bg_options',
			array(
				'label'     => esc_html__( 'Hover Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'smain_menu_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a',

			)
		);
		$this->add_control(
			'smain_menu_hover_shadow_options',
			array(
				'label'     => esc_html__( 'Hover Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'smain_menu_hover_shadow',
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:hover > a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_smain_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'smain_menu_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element.elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_active_icon_cls_color',
			array(
				'label'     => esc_html__( 'Active Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a >.plus-nav-icon-menu,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a>.plus-nav-icon-menu,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'smain_menu_active_icon_color',
			array(
				'label'     => esc_html__( 'Hover Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.active > a:after,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}}  .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown:focus > a:after,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-wrap .plus-navigation-inner.main-menu-indicator-style-1 .plus-navigation-menu .navbar-nav > li.dropdown.current_page_item > a:after' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'smain_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'smain_menu_active_border_color',
			array(
				'label'     => esc_html__( 'Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'smain_menu_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'smain_menu_active_radius',
			array(
				'label'      => esc_html__( 'Active Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'smain_menu_active_bg_options',
			array(
				'label'     => esc_html__( 'Active Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'smain_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',

			)
		);
		$this->add_control(
			'smain_menu_active_shadow_options',
			array(
				'label'     => esc_html__( 'Active Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'smain_menu_active_shadow',
				'selector' => '.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.active > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li:focus > a,.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .plus-navigation-menu .navbar-nav > li.current_page_item > a',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'smain_bg_options',
			array(
				'label'     => esc_html__( 'Section Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_smain_bg_style' );
		$this->start_controls_tab(
			'tab_smain_bg_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'smain_bg_n',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.elementor-element.plus-nav-sticky-sec',

			)
		);
		$this->add_control(
			'secbackdropshadown',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'secbackdropshadown_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'secbackdropshadown' => 'yes',
				),
			)
		);
		$this->add_control(
			'secbackdropshadown_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'.elementor-element.plus-nav-sticky-sec' => '-webkit-backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;backdrop-filter:grayscale({{secbackdropshadown_grayscale.SIZE}})  blur({{secbackdropshadown_blur.SIZE}}{{secbackdropshadown_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'secbackdropshadown' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_smain_bg_sticky',
			array(
				'label' => esc_html__( 'Sticky', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'smain_bg_s',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.elementor-element.plus-nav-sticky-sec.plus-fixed-sticky',

			)
		);
		$this->add_control(
			'secbackdropshadowh',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->start_popover();
		$this->add_control(
			'secbackdropshadowh_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'secbackdropshadowh' => 'yes',
				),
			)
		);
		$this->add_control(
			'secbackdropshadowh_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'.elementor-element.plus-nav-sticky-sec.plus-fixed-sticky' => '-webkit-backdrop-filter:grayscale({{secbackdropshadowh_grayscale.SIZE}})  blur({{secbackdropshadowh_blur.SIZE}}{{secbackdropshadowh_blur.UNIT}}) !important;backdrop-filter:grayscale({{secbackdropshadowh_grayscale.SIZE}})  blur({{secbackdropshadowh_blur.SIZE}}{{secbackdropshadowh_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'secbackdropshadowh' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'sticky_outer_padding_options',
			array(
				'label'     => esc_html__( 'Padding', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'so_whole_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-column-gap-default>.elementor-column>.elementor-element-populated' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'smain_height_options',
			array(
				'label'     => esc_html__( 'Header Height Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'smain_height_size',
			array(
				'label'      => esc_html__( 'Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'sub_menu_styling',
			array(
				'label' => esc_html__( 'Sub Menu', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_menu_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a',
			)
		);
		$this->add_control(
			'sub_menu_outer_options',
			array(
				'label'     => esc_html__( 'Sub-Menu Outer Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_padding',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu .dropdown-menu' => 'margin-top: {{TOP}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu .dropdown-menu' => 'left: calc(100% + {{RIGHT}}{{UNIT}});',
					'[dir="rtl"] {{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu .dropdown-menu' => 'right: calc(100% + {{LEFT}}{{UNIT}});',
				),
			)
		);
		$this->add_control(
			'sub_menu_outer_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'sub_menu_outer_border_style',
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
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'sub_menu_outer_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'sub_menu_outer_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'sub_menu_outer_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_outer_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu',

			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'sub_menu_outer_shadow',
				'selector'  => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'sub_menu_inner_options',
			array(
				'label'     => esc_html__( 'Sub-Menu Inner Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'sub_menu_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '15',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu:not(.menu-vertical) .nav li.dropdown:not(.plus-fw) .dropdown-menu > li,{{WRAPPER}} .plus-navigation-menu.menu-vertical .nav li.dropdown:not(.plus-fw) .dropdown-menu > li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
				),
			)
		);
		$this->add_control(
			'sub_menu_indicator_style',
			array(
				'label'     => esc_html__( 'Sub Menu Indicator Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'    => esc_html__( 'None', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'tabs_sub_menu_style' );
		$this->start_controls_tab(
			'tab_sub_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'sub_menu_normal_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_normal_icon_cls_color',
			array(
				'label'     => esc_html__( 'Normal Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu.icon-img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'sub_menu_normal_icon_color',
			array(
				'label'     => esc_html__( 'Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_normal_bg_options',
			array(
				'label'     => esc_html__( 'Normal Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sub_menu_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'sub_menu_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li:hover > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_icon_cls_color',
			array(
				'label'     => esc_html__( 'Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li:hover > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_icon_color',
			array(
				'label'     => esc_html__( 'Hover Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:hover > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_bg_options',
			array(
				'label'     => esc_html__( 'Hover Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .nav li.dropdown .dropdown-menu > li:hover',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sub_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'sub_menu_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_active_icon_cls_color',
			array(
				'label'     => esc_html__( 'Active Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a>.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a>.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'sub_menu_active_icon_color',
			array(
				'label'     => esc_html__( 'Active Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-1 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:before,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}}  .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'background: {{VALUE}}',
					'{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:before,{{WRAPPER}} .plus-navigation-wrap .plus-navigation-inner.sub-menu-indicator-style-2 .plus-navigation-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:before' => 'border-color: {{VALUE}};background: 0 0;',
				),
				'condition' => array(
					'sub_menu_indicator_style!' => 'none',
				),
			)
		);
		$this->add_control(
			'sub_menu_active_bg_options',
			array(
				'label'     => esc_html__( 'Active Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.active,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li:focus,{{WRAPPER}} .plus-navigation-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'description_styling',
			array(
				'label' => esc_html__( 'Description', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'description_alignment',
			array(
				'label'       => esc_html__( 'Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => esc_html__( 'Middle', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .plus-navigation-menu .nav>li' => 'vertical-align: {{value}};',
				),
				'default'     => 'middle',
				'toggle'      => true,
				'label_block' => false,
			)
		);
		$this->add_responsive_control(
			'description_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .tp-navigation-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-wrap .tp-navigation-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .tp-navigation-description',
			)
		);
		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .tp-navigation-description' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mobile_nav_options_styling',
			array(
				'label'     => esc_html__( 'Mobile Menu', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_nav_toggle_options',
			array(
				'label'     => esc_html__( 'Toggle Navigation Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mobile_nav_toggle_height',
			array(
				'label'      => esc_html__( 'Toggle Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle.mobile-toggle' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_nav_toggle_icon_st5',
			array(
				'label'      => esc_html__( 'Mobile Toggle Open Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .et_icon_img_st5 i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .et_icon_img_st5 svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .tp-icon-img,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
				),

			)
		);
		$this->add_control(
			'mobile_nav_toggle_icon_st5_c',
			array(
				'label'      => esc_html__( 'Mobile Toggle Close Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .et_icon_img_st5_c i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .et_icon_img_st5_c svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5 .tp-icon-img_c,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_mobile_menu'         => 'yes',
					'mobile_menu_toggle_style' => 'style-5',
				),

			)
		);
		$this->add_control(
			'mobile_nav_size_open',
			array(
				'label'     => esc_html__( 'Navigation Width', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'full',
				'options'   => array(
					'full'   => esc_html__( 'Full Width', 'theplus' ),
					'custom' => esc_html__( 'Column Based', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_nav_cust_heading',
			array(
				'label'     => esc_html__( 'Column Based Border and Shadow', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => array(
					'show_mobile_menu'     => 'yes',
					'mobile_nav_size_open' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'mobile_nav_cust_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .plus-mobile-menu-content.nav-cust-width',
				'condition' => array(
					'show_mobile_menu'     => 'yes',
					'mobile_nav_size_open' => 'custom',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_nav_cust_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu-content.nav-cust-width' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_mobile_menu'     => 'yes',
					'mobile_nav_size_open' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'mobile_nav_cust_shadow',
				'selector'  => '{{WRAPPER}} .plus-mobile-menu-content.nav-cust-width',
				'condition' => array(
					'show_mobile_menu'     => 'yes',
					'mobile_nav_size_open' => 'custom',
				),
			)
		);
		$this->start_controls_tabs( 'tab_toggle_nav_style' );
		$this->start_controls_tab(
			'tab_toggle_nav_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'toggle_nav_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu ul.toggle-lines li.toggle-line,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2::before,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2::after,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3::before,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3::after,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-4 span' => 'background: {{VALUE}}',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5.clin.plus-collapsed i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5.clin.plus-collapsed svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_toggle_nav_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'toggle_nav_active_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .mobile-plus-toggle-menu:not(.plus-collapsed) ul.toggle-lines li.toggle-line,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h::before,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h::after,
					{{WRAPPER}} .mobile-plus-toggle-menu:not(.plus-collapsed).toggle-style-3 .mobile-plus-toggle-menu-st3:before,
					{{WRAPPER}} .mobile-plus-toggle-menu:not(.plus-collapsed).toggle-style-3 .mobile-plus-toggle-menu-st3:after,
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-4:not(.plus-collapsed) span:nth-last-child(3),
					{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-4:not(.plus-collapsed) span:nth-last-child(1)' => 'background: {{VALUE}} !important',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5.clin i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mobile-plus-toggle-menu.toggle-style-5.clin svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mobile_main_menu_options',
			array(
				'label'     => esc_html__( 'Mobile Main Menu Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_main_menu_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a',
			)
		);
		$this->add_responsive_control(
			'mobile_main_menu_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_main_menu_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mobile_main_menu_style' );
		$this->start_controls_tab(
			'tab_mobile_main_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a,
					{{WRAPPER}} .plus-mobile-menu .navbar-nav>li.plus-dropdown-container.plus-fw>a.dropdown-toggle' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_icon_cls_color',
			array(
				'label'     => esc_html__( 'Normal Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a>.plus-nav-icon-menu' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-mobile-menu .navbar-nav>li>a>.plus-nav-icon-menu.icon-img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_icon_color',
			array(
				'label'     => esc_html__( 'Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_normal_bg_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_main_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav>li>a',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mobile_main_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li:focus > a,{{WRAPPER}} .plus-mobile-menu .navbar-nav > li.current_page_item > a,
					{{WRAPPER}} .plus-mobile-menu .plus-mobile-menu-content .navbar-nav>li.plus-fw.open>a,
					{{WRAPPER}} .plus-mobile-menu .navbar-nav>li.open>a,
					{{WRAPPER}} .plus-mobile-menu .navbar-nav>li.plus-dropdown-container.plus-fw.open>a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_icon_cls_color',
			array(
				'label'     => esc_html__( 'Active Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.active > a>.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li:focus > a>.plus-nav-icon-menu,{{WRAPPER}} .plus-mobile-menu .navbar-nav > li.current_page_item > a>.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_icon_color',
			array(
				'label'     => esc_html__( 'Active Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.current_page_item > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_active_bg_options',
			array(
				'label'     => esc_html__( 'Active Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_main_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav > li.dropdown.current_page_item > a',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'mobile_menu_border_main',
			array(
				'label'      => esc_html__( 'Border Bottom Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'separator'  => array( 'before', 'after' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle .plus-mobile-menu .navbar-nav li a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li a' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_menu_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => array( 'before', 'after' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-nav-toggle .plus-mobile-menu .navbar-nav li a,
					{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li a' => 'border-bottom-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_options',
			array(
				'label'     => esc_html__( 'Mobile Sub Menu Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_sub_menu_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a',
			)
		);
		$this->add_responsive_control(
			'mobile_sub_menu_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_sub_menu_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '15',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mobile_sub_menu_style' );
		$this->start_controls_tab(
			'tab__mobile_sub_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_color',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_icon_cls_color',
			array(
				'label'     => esc_html__( 'Normal Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a >.plus-nav-icon-menu.icon-img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_icon_color',
			array(
				'label'     => esc_html__( 'Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_normal_bg_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_normal_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .nav li.dropdown .dropdown-menu > li > a',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mobile_sub_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_icon_cls_color',
			array(
				'label'     => esc_html__( 'Active Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a >.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a >.plus-nav-icon-menu,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a >.plus-nav-icon-menu' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_icon_color',
			array(
				'label'     => esc_html__( 'Active Indicator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.active > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu:focus > a:after,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav ul.dropdown-menu > li.dropdown-submenu.current_page_item > a:after' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_active_bg_options',
			array(
				'label'     => esc_html__( 'Active Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_active_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.active > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li:focus > a,{{WRAPPER}} .plus-navigation-wrap .plus-mobile-menu .navbar-nav li.dropdown .dropdown-menu > li.current_page_item > a',

			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'smobile_menu_styling',
			array(
				'label'     => esc_html__( 'Sticky Mobile Menu', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'enable_sticky_menu' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tab_smobile_menu_style' );
		$this->start_controls_tab(
			'tab_smobile_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'smobile_menu_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu ul.toggle-lines li.toggle-line,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2::before,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2::after,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3::before,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-3 .mobile-plus-toggle-menu-st3::after,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-4 span' => 'background: {{VALUE}}',
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-5.clin.plus-collapsed i' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_smobile_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'smobile_menu_active_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu:not(.plus-collapsed) ul.toggle-lines li.toggle-line,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h::before,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-2 .mobile-plus-toggle-menu-st2-h::after,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu:not(.plus-collapsed).toggle-style-3 .mobile-plus-toggle-menu-st3:before,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu:not(.plus-collapsed).toggle-style-3 .mobile-plus-toggle-menu-st3:after,
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-4:not(.plus-collapsed) span:nth-last-child(3),
					.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-4:not(.plus-collapsed) span:nth-last-child(1)' => 'background: {{VALUE}} !important',
					'.plus-nav-sticky-sec.plus-fixed-sticky .elementor-element .elementor-element-{{ID}} .mobile-plus-toggle-menu.toggle-style-5.clin i' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tp_mob_scroll_overflow',
			array(
				'label'     => esc_html__( 'Scroll Overflow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'enable_sticky_menu' => 'yes',
					'show_mobile_menu'   => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'main_sub_label_styling',
			array(
				'label' => esc_html__( 'Main & Sub Menu Label', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'main_menu_label_text_options',
			array(
				'label'     => esc_html__( 'Main Menu Label Text Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'main_menu_label_typography',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'main_menu_label_right',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text' => 'right: {{SIZE}}{{UNIT}};',
					'[dir="rtl"] {{WRAPPER}} .plus-navigation-menu .plus-nav-label-text' => 'left: {{SIZE}}{{UNIT}};right:auto;',
				),
			)
		);
		$this->add_control(
			'main_menu_label_top',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'main_menu_label_padd',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'main_menu_label_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'main_menu_label_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'main_menu_label_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'sub_menu_label_text_options',
			array(
				'label'     => esc_html__( 'Label Text Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_menu_label_typography',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'sub_menu_label_right',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -12,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text' => 'right: {{SIZE}}{{UNIT}};',
					'[dir="rtl"] {{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text' => 'left: {{SIZE}}{{UNIT}};right:auto;',
				),
			)
		);
		$this->add_control(
			'sub_menu_label_top',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'sub_menu_label_padd',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sub_menu_label_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'sub_menu_label_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_label_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-navigation-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mobile_label_styling',
			array(
				'label' => esc_html__( 'Mobile Menu Label', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'mobile_main_menu_label_text_options',
			array(
				'label'     => esc_html__( 'Main Menu Label Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_main_menu_label_typography',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'mobile_main_menu_label_right',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 45,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text' => 'right: {{SIZE}}{{UNIT}};',
					'[dir="rtl"] {{WRAPPER}} .plus-mobile-menu .plus-nav-label-text' => 'left: {{SIZE}}{{UNIT}};right:auto;',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_label_top',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_main_menu_label_padd',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_main_menu_label_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'mobile_main_menu_label_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_main_menu_label_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .plus-nav-label-text',
			)
		);

		$this->add_control(
			'mobile_sub_menu_label_text_options',
			array(
				'label'     => esc_html__( 'SubMenu Label Text Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_sub_menu_label_typography',
				'label'    => esc_html__( 'Label Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'mobile_sub_menu_label_right',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 45,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text' => 'right: {{SIZE}}{{UNIT}};',
					'[dir="rtl"] {{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text' => 'left: {{SIZE}}{{UNIT}};right:auto;',
				),
			)
		);

		$this->add_control(
			'mobile_sub_menu_label_top',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mobile_sub_menu_label_padd',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_sub_menu_label_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->add_control(
			'mobile_sub_menu_label_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_label_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-mobile-menu .dropdown-menu .plus-nav-label-text',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'extra_options_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'main_menu_hover_style',
			array(
				'label'   => esc_html__( 'Main Menu Hover Effects', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'    => esc_html__( 'None', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'border-height',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'alignment-border-adjust',
			array(
				'label'      => esc_html__( 'Alignment Border Adjust', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'bottom : {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_1_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-1 > li > a:before,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:before' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_hover_style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_2_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:hover:after,{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-2 > li > a:hover:before' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'main_menu_hover_style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'main_menu_hover_style_1_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.menu-hover-style-1 > li > a:before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'main_menu_hover_style' => 'style-1',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_inverse',
			array(
				'label'     => esc_html__( 'On Hover Inverse Effect Main Menu', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'main_menu_hover_selected_opacity',
			array(
				'label'      => esc_html__( 'Selected Menu Opacity', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.hover-inverse-effect > li > a.is-hover' => 'opacity: {{SIZE}};',
				),
				'condition'  => array(
					'main_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'main_menu_hover_remaining_opacity',
			array(
				'label'     => esc_html__( 'Remaining Menus Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 0.2,
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.is-hover-inverse > li > a' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'main_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_inverse',
			array(
				'label'     => esc_html__( 'On Hover Inverse Effect Sub Menu', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'sub_menu_hover_selected_opacity',
			array(
				'label'      => esc_html__( 'Selected Menu Opacity', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.submenu-hover-inverse-effect li.dropdown .dropdown-menu > li > a.is-hover' => 'opacity: {{SIZE}};',
				),
				'condition'  => array(
					'sub_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'sub_menu_hover_remaining_opacity',
			array(
				'label'     => esc_html__( 'Remaining Menus Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 0.2,
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-navigation-menu .navbar-nav.is-submenu-hover-inverse li.dropdown .dropdown-menu > li > a' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'sub_menu_hover_inverse' => 'yes',
				),
			)
		);
		$this->add_control(
			'main_menu_last_open_sub_menu',
			array(
				'label'     => esc_html__( 'Main Menu Last Open Sub-menu Left', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'main_menu_last_open_sub_menu_item',
			array(
				'label'     => esc_html__( 'Open Last Menu Left Side', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 10,
				'step'      => 1,
				'default'   => 0,
				'condition' => array(
					'main_menu_last_open_sub_menu' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render TP Navigation Menu
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$menu_attr = '';
		$type_menu = ! empty( $settings['TypeMenu'] ) ? $settings['TypeMenu'] : 'standard';

		$mmts_custom   = ! empty( $settings['mmts_custom'] ) ? $settings['mmts_custom'] : 'custom_icon';
		$nav_alignment = ! empty( $settings['nav_alignment'] ) ? $settings['nav_alignment'] : 'text-center';

		$menu_hover_click = 'menu-' . $settings['menu_hover_click'];
		$navbar_menu_type = 'menu-' . $settings['navbar_menu_type'];
		$show_mobile_menu = ! empty( $settings['show_mobile_menu'] ) ? $settings['show_mobile_menu'] : 'yes';

		$enable_sticky_menu    = ! empty( $settings['enable_sticky_menu'] ) ? $settings['enable_sticky_menu'] : '';
		$mmts_custom_image_url = ! empty( $settings['mmts_custom_image']['url'] ) ? $settings['mmts_custom_image']['url'] : '';

		$mmts_custom_image_url_c  = ! empty( $settings['mmts_custom_image_c']['url'] ) ? $settings['mmts_custom_image_c']['url'] : '';
		$mobile_menu_toggle_style = ! empty( $settings['mobile_menu_toggle_style'] ) ? $settings['mobile_menu_toggle_style'] : 'style-1';

		if ( 'yes' === $show_mobile_menu && 'style-5' === $mobile_menu_toggle_style && 'custom_icon' === $mmts_custom ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['mmts_custom_icon'], array( 'aria-hidden' => 'true' ) );
			$mmts_custom_icon = ob_get_contents();
			ob_end_clean();
		}

		if ( 'yes' === $show_mobile_menu && 'style-5' === $mobile_menu_toggle_style && 'custom_icon' === $mmts_custom ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['mmts_custom_icon_c'], array( 'aria-hidden' => 'true' ) );
			$mmts_custom_icon_c = ob_get_contents();
			ob_end_clean();
		}

		if ( 'menu-vertical' !== $navbar_menu_type ) {
			$menu_effect = ! empty( $settings['menu_transition'] ) ? 'plus-menu-' . $settings['menu_transition'] : 'plus-menu-style-1';
			$menu_attr  .= ' data-menu_transition="' . esc_attr( $settings['menu_transition'] ) . '"';
		} elseif ( 'menu-vertical' === $navbar_menu_type ) {
			$menu_effect = ( 'style-1' === $settings['menu_transition'] || 'style-2' === $settings['menu_transition'] ) ? 'plus-menu-' . esc_attr( $settings['menu_transition'] ) : 'plus-menu-style-1';
			$menu_attr  .= ( 'style-1' === $settings['menu_transition'] || 'style-2' === $settings['menu_transition'] ) ? ' data-menu_transition="' . esc_attr( $settings['menu_transition'] ) . '"' : ' data-menu_transition="style-1"';
		}

		$menu_attr .= 'yes' === $enable_sticky_menu ? ' data-wid="tp-nav-sticky" data-nav-sticky="' . esc_attr( $enable_sticky_menu ) . '"' : '';
		$menu_attr .= ! empty( $settings['enable_sticky_osup_menu'] ) && 'yes' === $settings['enable_sticky_osup_menu'] ? ' data-wid="tp-nav-sticky" data-nav-sticky-osup="' . esc_attr( $settings['enable_sticky_osup_menu'] ) . '"' : '';

		$main_menu_hover_style = 'menu-hover-' . esc_attr( $settings['main_menu_hover_style'] );

		$nav_menu      = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;
		$mobile_navbar = ! empty( $settings['mobile_navbar'] ) ? wp_get_nav_menu_object( $settings['mobile_navbar'] ) : false;

		$main_menu_last_open_sub_menu = 'yes' === $settings['main_menu_last_open_sub_menu'] ? 'open-sub-menu-left' : '';

		$main_menu_hover_inverse  = 'yes' === $settings['main_menu_hover_inverse'] ? 'hover-inverse-effect' : '';
		$main_menu_hover_inverse .= 'yes' === $settings['sub_menu_hover_inverse'] ? ' submenu-hover-inverse-effect' : '';

		$main_menu_indicator_style = 'main-menu-indicator-' . esc_attr( $settings['main_menu_indicator_style'] );
		$sub_menu_indicator_style  = 'sub-menu-indicator-' . esc_attr( $settings['sub_menu_indicator_style'] );

		$mobile_menu_content = ! empty( $settings['mobile_menu_content'] ) ? $settings['mobile_menu_content'] : 'normal-menu';
		$mobile_menu_type    = ! empty( $settings['mobile_menu_type'] ) ? $settings['mobile_menu_type'] : 'toggle';

		$nav_menu_args = array(
			'menu'            => $nav_menu,
			'theme_location'  => 'default_navmenu',
			'depth'           => 8,
			'container'       => '',
			'container_class' => '',
			'menu_class'      => 'nav navbar-nav yamm ' . $main_menu_hover_style . ' ' . $main_menu_last_open_sub_menu . ' ' . $main_menu_hover_inverse,
			'fallback_cb'     => false,
			'walker'          => new Theplus_Navigation_NavWalker(),
		);

		if ( 'yes' === $show_mobile_menu && 'normal-menu' === $mobile_menu_content && ! empty( $settings['mobile_navbar'] ) ) {
			$mobile_nav_menu_args = array(
				'menu'            => $mobile_navbar,
				'theme_location'  => 'mobile_navmenu',
				'depth'           => '5',
				'container'       => 'div',
				'container_class' => 'plus-mobile-menu',
				'menu_class'      => 'nav navbar-nav',
				'fallback_cb'     => false,
				'walker'          => new Theplus_Navigation_NavWalker(),
			);
		}

		if ( 'yes' === $show_mobile_menu && 'normal-menu' === $mobile_menu_content && ! empty( $settings['mobile_navbar'] ) && 'swiper' === $mobile_menu_type ) {
			$mobile_swiper_menu_args = array(
				'menu'            => $mobile_navbar,
				'theme_location'  => 'mobile_navmenu',
				'depth'           => '1',
				'container'       => 'div',
				'container_class' => 'plus-mobile-menu swiper-wrapper',
				'menu_class'      => 'nav navbar-nav swiper-slide swiper-slide-active',
				'fallback_cb'     => false,
				'walker'          => new Theplus_Navigation_NavWalker(),
			);
		}

		$uid = uniqid( 'nav-menu' ) . $this->get_id();

		$hamburger = '';
		if ( 'off-canvas' === $mobile_menu_type ) {
			$hamburger .= 'hamburger-off-canvas';
		}

		$vertical_toggle_title_bar = '';

		$toggle_type = '';
		if ( 'menu-vertical-side' === $navbar_menu_type && ! empty( $settings['vertical_side_title_bar'] ) && 'yes' === $settings['vertical_side_title_bar'] ) {

			if ( ! empty( $settings['vertical_side_title_link']['url'] ) ) {
				$this->add_render_attribute( 'button', 'href', esc_url( $settings['vertical_side_title_link']['url'] ) );
				if ( $settings['vertical_side_title_link']['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
				if ( $settings['vertical_side_title_link']['nofollow'] ) {
					$this->add_render_attribute( 'button', 'rel', 'nofollow' );
				}
			}

			$this->add_render_attribute( 'button', 'class', 'plus-vertical-side-toggle' );

			if ( ! empty( $settings['loop_icon_prefix'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['loop_icon_prefix'], array( 'aria-hidden' => 'true' ) );
				$prefix_icon = ob_get_contents();
				ob_end_clean();
			}

			if ( ! empty( $settings['loop_icon_postfix'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['loop_icon_postfix'], array( 'aria-hidden' => 'true' ) );
				$postfix_icon = ob_get_contents();
				ob_end_clean();
			}

			$vertical_toggle_title_bar .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';

				$vertical_toggle_title_bar .= '<span>' . $prefix_icon . ' ' . esc_html( $settings['vertical_side_title_text'] ) . '</span>';
				$vertical_toggle_title_bar .= $postfix_icon;

			$vertical_toggle_title_bar .= '</a>';

			if ( ! empty( $settings['vertical_side_type'] ) ) {
				$toggle_type = 'toggle-type-' . esc_attr( $settings['vertical_side_type'] );
				if ( ! empty( $settings['vertical_side_click_open'] ) && 'yes' === $settings['vertical_side_click_open'] ) {
					$toggle_type .= ' tp-click';
				}
			}
		}

		if ( ! empty( $settings['mobile_navbar_outer_click'] ) && 'yes' === $settings['mobile_navbar_outer_click'] ) {
			$menu_attr .= ' data-mobile-menu-click="yes"';
		} else {
			$menu_attr .= ' data-mobile-menu-click="no"';
		}

		$ver_slide_right_class = '';
		if ( ! empty( $settings['vertical_side_open_right'] ) && 'vso_right' === $settings['vertical_side_open_right'] ) {
			$ver_slide_right_class = 'tp-vso-right';
		}

		?>
		<div class="plus-navigation-wrap <?php echo esc_attr( $nav_alignment ) . ' ' . esc_attr( $uid ); ?>">
			<div class="plus-navigation-inner <?php echo esc_attr( $menu_hover_click ) . ' ' . esc_attr( $main_menu_indicator_style ) . ' ' . esc_attr( $sub_menu_indicator_style ) . ' ' . esc_attr( $menu_effect ); ?>" <?php echo $menu_attr; ?>>
				<div id="theplus-navigation-normal-menu" class="collapse navbar-collapse navbar-ex1-collapse">
				
					<div class="plus-navigation-menu <?php echo esc_attr( $navbar_menu_type ) . ' ' . esc_attr( $ver_slide_right_class ) . ' ' . esc_attr( $toggle_type ); ?>">
						<?php
						echo $vertical_toggle_title_bar;

						if ( defined( 'JUPITERX_VERSION' ) ) {
							wp_nav_menu( $nav_menu_args );
						} elseif ( 'custom' === $type_menu ) {
							echo $this->tp_mega_menu( $settings );
						} else {
							wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) );
						}
						?>
												
					</div>
					
				</div>
				
				<?php
				if ( 'yes' === $show_mobile_menu ) {
					if ( 'swiper' !== $mobile_menu_type ) {
						?>
					<div class="plus-mobile-nav-toggle navbar-header mobile-toggle">
						<?php
						$st5_cust_cls = '';
						if ( 'style-5' === $mobile_menu_toggle_style && ( 'custom_icon' === $mmts_custom || 'custom_img' === $mmts_custom ) ) {
							if ( ! empty( $mmts_custom_image_url_c ) || ! empty( $mmts_custom_icon_c ) ) {
								$st5_cust_cls = ' clin';
							}
						}
						?>
						<div class="mobile-plus-toggle-menu <?php echo esc_attr( $hamburger ); ?> plus-collapsed toggle-<?php echo esc_attr( $mobile_menu_toggle_style ) . $st5_cust_cls; ?>"  data-target="#plus-mobile-nav-toggle-<?php echo esc_attr( $uid ); ?>">
							<?php if ( ( ! empty( $mobile_menu_type ) && 'off-canvas' === $mobile_menu_type ) || 'style-1' === $mobile_menu_toggle_style ) { ?>

								<ul class="toggle-lines"><li class="toggle-line"></li><li class="toggle-line"></li></ul>

							<?php } elseif ( 'style-2' === $mobile_menu_toggle_style ) { ?>

								<div class="mobile-plus-toggle-menu-st2"></div><div class="mobile-plus-toggle-menu-st2-h"></div>

							<?php } elseif ( 'style-3' === $mobile_menu_toggle_style ) { ?>

								<div class="mobile-plus-toggle-menu-st3"></div>

							<?php } elseif ( 'style-4' === $mobile_menu_toggle_style ) { ?>

								<span></span><span></span><span></span>
								<?php
							} elseif ( 'style-5' === $mobile_menu_toggle_style ) {

								if ( 'custom_icon' === $mmts_custom && ! empty( $mmts_custom_icon ) ) {
									echo '<span class="extra_toggle_open et_icon_img_st5">' . $mmts_custom_icon . '</span>';
									if ( 'custom_icon' === $mmts_custom && ! empty( $mmts_custom_icon_c ) ) {
										echo '<span class="extra_toggle_open et_icon_img_st5_c">' . $mmts_custom_icon_c . '</span>';
									}
								} elseif ( 'custom_img' === $mmts_custom ) {

									$mmts_custom_image = '';
									if ( ! empty( $mmts_custom_image_url ) ) {
										$mmts_custom_image = $mmts_custom_image_url;
										if ( ! empty( $mmts_custom_image_url_c ) ) {
											$mmts_custom_image_c = $mmts_custom_image_url_c;
										} else {
											$mmts_custom_image_c = '';
										}
									}

									echo '<img class="tp-icon-img" src=' . esc_url( $mmts_custom_image ) . ' />';
									if ( ! empty( $mmts_custom_image_url_c ) ) {
										echo '<img class="tp-icon-img-close" src=' . esc_url( $mmts_custom_image_c ) . ' />';
									}
								}
							}
							?>
						</div>
					</div>
						<?php
					}

					$swiper_class = '';
					if ( 'swiper' === $mobile_menu_type ) {
						$swiper_class = ' swiper-container swiper-free-mode';
					}

					$mobile_nav_custom_class = '';
					if ( 'custom' === $settings['mobile_nav_size_open'] ) {
						$mobile_nav_custom_class = 'nav-cust-width';
					}

					$offcanvasclass = '';
					if ( 'off-canvas' === $mobile_menu_type ) {
						$offcanvasclass = ' plus-menu-off-canvas';
					}
					?>

					<div id="plus-mobile-nav-toggle-<?php echo esc_attr( $uid ); ?>" class="plus-mobile-menu  <?php echo esc_attr( $offcanvasclass ); ?> collapse navbar-collapse navbar-ex1-collapse plus-mobile-menu-content <?php echo esc_attr( $mobile_nav_custom_class ) . esc_attr( $swiper_class ); ?>">
						<?php
						if ( 'off-canvas' === $mobile_menu_type ) {
							echo '<a href="javascript:void(0);" class="close-menu"><i class="fas fa-times"></i></a>';
						}
						if ( 'normal-menu' === $mobile_menu_content && ! empty( $settings['mobile_navbar'] ) && 'swiper' === $mobile_menu_type ) {
							if ( defined( 'JUPITERX_VERSION' ) ) {
								wp_nav_menu( $mobile_swiper_menu_args );
							} else {
								wp_nav_menu( apply_filters( 'widget_nav_menu_args', $mobile_swiper_menu_args, $nav_menu, $settings ) );
							}
						} elseif ( 'normal-menu' === $mobile_menu_content && ! empty( $settings['mobile_navbar'] ) ) {
							if ( defined( 'JUPITERX_VERSION' ) ) {
								wp_nav_menu( $mobile_nav_menu_args );
							} else {
								wp_nav_menu( apply_filters( 'widget_nav_menu_args', $mobile_nav_menu_args, $nav_menu, $settings ) );
							}
						} elseif ( 'custom' === $type_menu ) {
							echo $this->tp_mega_menu( $settings );
						}

						if ( 'template-menu' === $mobile_menu_content && ! empty( $settings['mobile_navbar_template'] ) ) {
							echo '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['mobile_navbar_template'] ) . '</div>';
						}
						?>
					</div>
				<?php } ?>
				
			</div>
		</div>
		 
		<?php
		$css_rule = '';
		if ( 'yes' === $settings['main_menu_last_open_sub_menu'] ) {
			$menu_item = ! empty( $settings['main_menu_last_open_sub_menu_item'] ) ? $settings['main_menu_last_open_sub_menu_item'] : '';
			if ( is_rtl() ) {
				$css_rule .= '[dir="rtl"] .' . esc_attr( $uid ) . ' .plus-navigation-menu:not(.menu-vertical) .navbar-nav.open-sub-menu-left > li:nth-last-child(-n+' . esc_attr( $menu_item ) . ') > ul.dropdown-menu ul.dropdown-menu{right: auto;left: 100% !important;}';
			} else {
				$css_rule .= '.' . esc_attr( $uid ) . ' .plus-navigation-menu:not(.menu-vertical) .navbar-nav.open-sub-menu-left > li:nth-last-child(-n+' . esc_attr( $menu_item ) . ') > ul.dropdown-menu ul.dropdown-menu{left: auto !important;right: 100%;}.' . esc_attr( $uid ) . ' .plus-navigation-menu:not(.menu-vertical) .navbar-nav.open-sub-menu-left > li:nth-last-child(-n+' . esc_attr( $menu_item ) . ') > ul.dropdown-menu {left: 0;}';
			}
		}

		if ( 'yes' === $show_mobile_menu && ! empty( $settings['open_mobile_menu']['size'] ) ) {
			$open_mobile_menu  = ( $settings['open_mobile_menu']['size'] ) . $settings['open_mobile_menu']['unit'];
			$close_mobile_menu = ( $settings['open_mobile_menu']['size'] + 1 ) . $settings['open_mobile_menu']['unit'];

			$css_rule .= '@media (min-width:' . esc_attr( $close_mobile_menu ) . '){.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display: block!important;}.plus-navigation-wrap.' . esc_attr( $uid ) . ' #plus-mobile-nav-toggle-' . esc_attr( $uid ) . '.collapse.in{display:none;}}';

			if ( ( 'yes' === $enable_sticky_menu ) && ( ! empty( $settings['tp_mob_scroll_overflow'] ) && 'yes' === $settings['tp_mob_scroll_overflow'] ) ) {
				$css_rule .= '@media (max-width:' . esc_attr( $open_mobile_menu ) . '){.elementor-section.plus-nav-sticky-sec.plus-fixed-sticky,.elementor-element.e-container.plus-nav-sticky-sec.plus-fixed-sticky,.elementor-element.e-con.plus-nav-sticky-sec.plus-fixed-sticky{overflow:scroll;height: 100%}}';
			}

			$css_rule .= '@media (max-width:' . esc_attr( $open_mobile_menu ) . '){.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display:none !important;}.plus-navigation-wrap.' . esc_attr( $uid ) . ' .plus-mobile-nav-toggle.mobile-toggle{display: -webkit-flex;display: -moz-flex;display: -ms-flex;display: flex;-webkit-align-items: center;-moz-align-items: center;-ms-align-items: center;align-items: center;-webkit-justify-content: flex-end;-moz-justify-content: flex-end;-ms-justify-content: flex-end;justify-content: flex-end;}.plus-navigation-wrap .plus-mobile-menu-content.collapse.swiper-container{display: block;}}';
		} else {
			$css_rule .= '.plus-navigation-wrap.' . esc_attr( $uid ) . ' #theplus-navigation-normal-menu{display: block!important;}';
		}

		$smain_height_size = ! empty( $settings['smain_height_size']['size'] ) ? $settings['smain_height_size']['size'] : '100';
		if ( ( 'yes' === $enable_sticky_menu ) && ( ! empty( $smain_height_size ) ) && ( ! empty( $settings['enable_sticky_osup_menu'] ) && 'yes' !== $settings['enable_sticky_osup_menu'] ) ) {
			$css_rule .= '.plus-nav-sticky{min-height:max-content !important;}
			.elementor-section.plus-nav-sticky-sec.plus-fixed-sticky,.elementor-element.e-container.plus-nav-sticky-sec.plus-fixed-sticky,.elementor-element.e-con.plus-nav-sticky-sec.plus-fixed-sticky{top: -' . esc_attr( $smain_height_size ) . 'px !important;-webkit-transform: translate3d(0,' . esc_attr( $smain_height_size ) . 'px,0);transform: translateY(' . esc_attr( $smain_height_size ) . 'px) !important;transition: all .3s linear !important;}';

			$css_rule .= '.admin-bar .elementor-section.plus-nav-sticky-sec.plus-fixed-sticky,.admin-bar .elementor-element.e-container.plus-nav-sticky-sec.plus-fixed-sticky,.admin-bar .elementor-element.e-con.plus-nav-sticky-sec.plus-fixed-sticky{top: calc(-' . esc_attr( $smain_height_size ) . 'px + 32px) !important;-webkit-transform: translate3d(0,' . esc_attr( $smain_height_size ) . 'px,0);transform: translateY(' . esc_attr( $smain_height_size ) . 'px) !important;transition: all .3s linear !important;}';
		}

		echo '<style>' . $css_rule . '</style>';
	}

	/**
	 * Render Mega-menu
	 *
	 * @since 2.0.0
	 *
	 * @param string $settings The attribute slug for .
	 * @param string $sett The attribute slug for .
	 *
	 * @version 5.4.2
	 */
	protected function tp_mega_menu( $settings, $sett = '' ) {
		$custom_menu = '';
		$stylecss    = '';
		if ( ! empty( $settings['ItemMenu'] ) ) {
			$custom_menu .= '<ul class="nav navbar-nav ' . ( 'swiper' === $settings['mobile_menu_type'] ? 'swiper-slide' : '' ) . ' ' . ( 'style-1' === $settings['main_menu_hover_style'] ? 'menu-hover-style-1' : ( 'style-2' === $settings['main_menu_hover_style'] ? 'menu-hover-style-2' : '' ) ) . ' ' . ( ( 'yes' === $settings['main_menu_hover_inverse'] ) ? 'hover-inverse-effect' : '' ) . ' ' . ( ( 'yes' === $settings['sub_menu_hover_inverse'] ) ? 'submenu-hover-inverse-effect' : '' ) . '  ' . ( ( 'yes' === $settings['main_menu_last_open_sub_menu'] ) ? ' open-sub-menu-left' : '' ) . ' ">';

			$menu_array = $settings['ItemMenu'];

			$level = 0;
			foreach ( $settings['ItemMenu'] as $index => $item ) {
				$depth = $item['depth'];

				$nextdepth = ! empty( $menu_array[ intval( $index + 1 ) ] ) ? intval( $menu_array[ $index + 1 ]['depth'] ) : '';
				$prevdepth = ! empty( $menu_array[ intval( $index - 1 ) ] ) ? intval( $menu_array[ $index - 1 ]['depth'] ) : '';

				$st_child_li = '';
				if ( $depth > 0 ) {
					if ( ( $nextdepth == $depth || $nextdepth > $depth || $nextdepth < $depth ) && $prevdepth != $depth && $prevdepth < $depth ) {
						$level = $level + 1;

						$st_child_li = '<ul role="menu" class="dropdown-menu">';
					}
				}

				$st_end_child_li = '';
				$end_child_li    = '';
				if ( $nextdepth < $depth ) {
					$diff = ( (int) $depth - (int) $nextdepth );
					if ( $diff >= 1 ) {
						for ( $i = 0;$i < $diff;$i++ ) {
							$end_child_li .= '</ul></li>';
						}
					} elseif ( 0 === $diff ) {
						$end_child_li .= '</li>';
					}
				}

				$name    = '';
				$itemurl = '';
				$preicon = '';

				$menuname = '';
				$indiIcon = '';

				$subindiIcon = '';
				$menuiconty  = ! empty( $item['menuiconTy'] ) ? $item['menuiconTy'] : '';
				if ( 'icon' === $menuiconty ) {
					$preicon .= '<span class="plus-navicon-wrap"><i class="' . esc_attr( $item['preicon']['value'] ) . ' plus-nav-icon-menu"> </i></span>';
				} elseif ( 'img' === $menuiconty ) {
					if ( ! empty( $item['menuImg'] ) && ! empty( $item['menuImg']['id'] ) ) {
						$preicon .= '<span class="plus-navicon-wrap">' . wp_get_attachment_image( $item['menuImg']['id'], 'full', true, array( 'class' => 'plus-nav-icon-menu' ) ) . '</span>';
					} elseif ( ! empty( $item['menuImg']['url'] ) ) {
						$preicon .= '<span class="plus-navicon-wrap"><img src="' . esc_url( $item['menuImg']['url'] ) . '" class="plus-nav-icon-menu icon-img" alt="' . esc_attr__( 'icon_img', 'theplus' ) . '" /></span>';
					}
				}

				$txtlabel = '';
				if ( ! empty( $item['showlabel'] ) && ! empty( $item['labeltxt'] ) ) {
					$txtlabel .= '<span class="plus-nav-label-text">' . esc_html( $item['labeltxt'] ) . '</span>';
				}

				$navdesc = '';
				if ( ! empty( $item['navDesc'] ) ) {
					$navdesc .= '<span class="tp-navigation-description">' . wp_kses_post( $item['navDesc'] ) . '</span>';
				}

				$linkfilter = ! empty( $item['LinkFilter']['url'] ) ? $item['LinkFilter']['url'] : '#';
				$menuname   = ! empty( $linkfilter ) && ! empty( $item['filterlabel'] ) ? $item['filterlabel'] : '';

				$current_active = '';
				if ( ! empty( $item['LinkFilter']['url'] ) ) {
					$itemurl = $item['LinkFilter']['url'];

					$item_target   = ! empty( $item['LinkFilter']['is_external'] ) ? ' target="_blank"' : '';
					$item_nofollow = ! empty( $item['LinkFilter']['nofollow'] ) ? ' rel="nofollow"' : '';

					if ( $item['filterlabel'] === get_the_ID() ) {
						$current_active = ' active';
					}
				} else {
					$itemurl = '#';
				}

				if ( ( '1' !== $depth ) || ! empty( $item['SmenuType'] ) && 'mega-menu' !== $item['SmenuType'] && 'link' === $item['SmenuType'] ) {
					$name = '<a href="' . esc_attr( $itemurl ) . '" ' . $item_target . $item_nofollow . ' title="' . esc_attr( $menuname ) . '" data-text="' . esc_attr( $menuname ) . '" >' . $preicon . '<span class="plus-title-wrap">' . esc_html( $menuname ) . '' . $txtlabel . '' . $navdesc . '</span></a>';
				}

				$dropdownclass = ( $nextdepth >= 2 && ( $nextdepth > $depth ) ) ? 'dropdown-submenu menu-item-has-children' : ( ( $nextdepth > $depth ) ? 'dropdown menu-item-has-children' : '' );

				$megamenu_class = '';
				if ( 1 === $nextdepth ) {
					$next_menu = ! empty( $menu_array[ $index + 1 ] ) ? $menu_array[ $index + 1 ] : '';
					if ( ! empty( $next_menu ) && 'mega-menu' === $next_menu['SmenuType'] ) {
						$megamenu_class .= ' plus-fw';

						if ( ! empty( $next_menu['megaMType'] ) ) {
							$megamenu_class .= ' plus-dropdown-' . esc_attr( $next_menu['megaMType'] );
						}

						if ( 'default' === $next_menu['megaMType'] ) {
							$unit = isset( $next_menu['megaMwid']['unit'] ) && ! empty( $next_menu['megaMwid']['unit'] ) ? $next_menu['megaMwid']['unit'] : '';

							/** Desktop*/
							if ( isset( $next_menu['megaMwid']['size'] ) && ! empty( $next_menu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (min-width: 1024px) { .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . esc_attr( $item['_id'] ) . '.plus-dropdown-default>ul.dropdown-menu{max-width: ' . $next_menu['megaMwid']['size'] . $unit . ' !important;min-width: ' . $next_menu['megaMwid']['size'] . $unit . '!important; ' . ( isset( $next_menu['megaMAlign'] ) && 'default' === $next_menu['megaMAlign'] ? 'right: auto;' : '' ) . '} } ';
							}
							/** Tablet*/
							if ( isset( $next_menu['megaMwid']['size'] ) && ! empty( $next_menu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (max-width: 1024px) and (min-width:768px){ .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . esc_attr( $item['_id'] ) . '.plus-dropdown-default>ul.dropdown-menu{ max-width: ' . $next_menu['megaMwid']['size'] . $unit . ' !important; min-width: ' . $next_menu['megaMwid']['size'] . $unit . ' !important; ' . ( isset( $next_menu['megaMAlign'] ) && 'default' === $next_menu['megaMAlign'] ? 'right: auto;' : '' ) . '} } ';
							}
							/** Mobile*/
							if ( isset( $next_menu['megaMwid']['size'] ) && ! empty( $next_menu['megaMwid']['size'] ) ) {
								$stylecss .= '@media (max-width: 767px) { .plus-navigation-wrap .plus-navigation-inner .navbar-nav>li.elementor-repeater-item-' . esc_attr( $item['_id'] ) . '.plus-dropdown-default>ul.dropdown-menu{ max-width: ' . $next_menu['megaMwid']['size'] . $unit . ' !important; min-width: ' . $next_menu['megaMwid']['size'] . $unit . ' !important; ' . ( isset( $next_menu['megaMAlign'] ) && 'default' === $next_menu['megaMAlign'] ? 'right: auto;' : '' ) . '} } ';
							}
						}
					}
					if ( ! empty( $next_menu ) && 'default' === $next_menu['megaMType'] && isset( $next_menu['megaMAlign'] ) && 'center' === $next_menu['megaMAlign'] ) {
						$megamenu_class .= ' plus-dropdown-' . esc_attr( $next_menu['megaMAlign'] );
					}
				}

				$start_li = "<li class='menu-item depth-" . esc_attr( $depth ) . ' ' . esc_attr( $dropdownclass ) . ' ' . esc_attr( $megamenu_class ) . ' ' . ( ! empty( $item['classTxt'] ) ? $item['classTxt'] : '' ) . ' elementor-repeater-item-' . esc_attr( $item['_id'] ) . $current_active . "' >";

				if ( '1' === $depth && 'mega-menu' === $item['SmenuType'] ) {
					$moblie_mmenu = ! empty( $item['moblieMmenu'] ) && 'yes' === $item['moblieMmenu'] ? $item['moblieMmenu'] : '';

					if ( ! empty( $sett ) && 'yes' === $moblie_mmenu ) {
						$mlink_filter = (array) $item['MLinkFilter']['url'];

						$target   = ! empty( $item['MLinkFilter']['is_external'] ) ? ' target="_blank"' : '';
						$nofollow = ! empty( $item['MLinkFilter']['nofollow'] ) ? ' rel="nofollow"' : '';

						$mitem_url  = ! empty( $item['MLinkFilter']['url'] ) ? $item['MLinkFilter']['url'] : '#';
						$mmenu_name = ! empty( $mlink_filter ) && ! empty( $item['Mfilterlabel'] ) ? $item['Mfilterlabel'] : '';
						$start_li  .= '<a href="' . esc_attr( $mitem_url ) . '" ' . $target . $nofollow . ' title="' . esc_attr( $mmenu_name ) . '" data-text="' . esc_attr( $mmenu_name ) . '" >' . $preicon . '' . esc_html( $mmenu_name ) . '' . $txtlabel . '</a>';
					} else {
						$start_li .= '<div class="plus-megamenu-content">';
						if ( ! empty( $item['blockTemp'] ) && '0' !== $item['blockTemp'] ) {
							$start_li .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['blockTemp'] ) . '</div>';
						}
						$start_li .= '</div>';
					}
				}

				$end_li = '';
				if ( $nextdepth == $depth && '0' === $depth && $nextdepth == $prevdepth ) {
					$end_li = '</li>';
				}

				$custom_menu .= $st_end_child_li . $st_child_li . $start_li . $name . $end_li . $end_child_li;
			}

			$custom_menu .= '</ul>';
			if ( ! empty( $stylecss ) ) {
				$custom_menu .= '<style>' . $stylecss . '</style>';
			}
		}

		return $custom_menu;
	}

	/**
	 * Render content_template
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
