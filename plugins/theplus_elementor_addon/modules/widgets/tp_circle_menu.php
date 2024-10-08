<?php
/**
 * Widget Name: Circle Menu
 * Description: Circle Menu
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
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Circle_Menu.
 */
class ThePlus_Circle_Menu extends Widget_Base {

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
		return 'tp-circle-menu';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Circle Menu', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-circle-o-notch theplus_backend_icon';
	}

	/**
	 * Get Widget Category.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keyword.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Circle Menu', 'Circular Menu', 'Round Menu', 'Circular Navigation', 'Round Navigation', 'Circular Button Menu', 'Round Button Menu', 'Circular Icon Menu', 'Round Icon Menu', 'Circle Menu Widget', 'Circular Menu Widget', 'Round Menu Widget', 'Circle Menu', 'Circular Menu', 'Round Menu' );
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
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Circle Menu', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'icon_layout_open',
			array(
				'label'   => esc_html__( 'Icon Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'circle',
				'options' => array(
					'circle'   => esc_html__( 'Circle', 'theplus' ),
					'straight' => esc_html__( 'Straight', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_circle',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-circle-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);
		$this->add_control(
			'icon_layout_straight_style',
			array(
				'label'     => esc_html__( 'Menu Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
				'condition' => array(
					'icon_layout_open' => array( 'straight' ),
				),
			)
		);

		$this->add_control(
			'icon_direction',
			array(
				'label'     => esc_html__( 'Icon Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-right',
				'options'   => array(
					'top'          => esc_html__( 'Top', 'theplus' ),
					'right'        => esc_html__( 'Right', 'theplus' ),
					'bottom'       => esc_html__( 'Bottom', 'theplus' ),
					'left'         => esc_html__( 'Left', 'theplus' ),
					'top-right'    => esc_html__( 'Top Right', 'theplus' ),
					'top-left'     => esc_html__( 'Top Left', 'theplus' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'theplus' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'theplus' ),
					'top-half'     => esc_html__( 'Top Half', 'theplus' ),
					'right-half'   => esc_html__( 'Right Half', 'theplus' ),
					'bottom-half'  => esc_html__( 'Bottom Half', 'theplus' ),
					'left-half'    => esc_html__( 'Left Half', 'theplus' ),
					'full'         => esc_html__( 'Full', 'theplus' ),
					'none'         => esc_html__( 'None', 'theplus' ),
				),
				'condition' => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);
		$this->add_control(
			'layout_straight_menu_direction',
			array(
				'label'     => esc_html__( 'Menu Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
					'left'   => esc_html__( 'Left', 'theplus' ),
				),
				'condition' => array(
					'icon_layout_open' => array( 'straight' ),
				),
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tooltip_menu_title',
			array(
				'label'   => esc_html__( 'Tooltip Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'loop_image_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''      => esc_html__( 'None', 'theplus' ),
					'icon'  => esc_html__( 'Icon', 'theplus' ),
					'image' => esc_html__( 'Image', 'theplus' ),
				),
			)
		);

		$repeater->add_control(
			'loop_select_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'condition'  => array(
					'loop_image_icon' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'loop_select_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'loop_image_icon' => 'image',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
				'condition' => array(
					'loop_image_icon' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'font_awesome_5',
				),
			)
		);
		$repeater->add_control(
			'loop_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'icon_mind',
				),
			)
		);
		$repeater->add_control(
			'loop_icon_link_type',
			array(
				'label'     => esc_html__( 'Select Link Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'url',
				'options'   => array(
					'url'    => esc_html__( 'URL', 'theplus' ),
					'email'  => esc_html__( 'Email', 'theplus' ),
					'phone'  => esc_html__( 'Phone', 'theplus' ),
					'nolink' => esc_html__( 'No Link', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'icons_url',
			array(
				'label'         => esc_html__( 'Url', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'loop_icon_link_type' => 'url',
				),
			)
		);
		$repeater->add_control(
			'email',
			array(
				'label'       => esc_html__( 'Email', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Email', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'loop_icon_link_type' => 'email',
				),
			)
		);
		$repeater->add_control(
			'phone',
			array(
				'label'       => esc_html__( 'Phone', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Phone', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'loop_icon_link_type' => 'phone',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_title_style' );
		$repeater->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$repeater->add_control(
			'icon_color',
			array(
				'label'       => esc_html__( 'Color', 'theplus' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => '#fff',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon svg,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'        => 'icon_background',
				'label'       => esc_html__( 'Background', 'theplus' ),
				'types'       => array( 'classic', 'gradient' ),
				'render_type' => 'ui',
				'selector'    => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title',
			)
		);
		$repeater->add_control(
			'icon_border_color',
			array(
				'label'       => esc_html__( 'Border Color', 'theplus' ),
				'type'        => Controls_Manager::COLOR,
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title' => 'border-color: {{VALUE}}',
				),
			)
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$repeater->add_control(
			'icon_hover_color',
			array(
				'label'       => esc_html__( 'Color', 'theplus' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => '#fff',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu_icon svg,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'        => 'icon_hover_background',
				'label'       => esc_html__( 'Background', 'theplus' ),
				'types'       => array( 'classic', 'gradient' ),
				'render_type' => 'ui',
				'selector'    => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon:hover,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title',
			)
		);
		$repeater->add_control(
			'icon_border_hover_color',
			array(
				'label'       => esc_html__( 'Border Color', 'theplus' ),
				'type'        => Controls_Manager::COLOR,
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title' => 'border-color: {{VALUE}}',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'tooltip_default_hover',
			array(
				'label'     => esc_html__( 'Tooltip Visibility', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Default', 'theplus' ),
				'label_off' => esc_html__( 'Hover', 'theplus' ),
				'default'   => 'no',
			)
		);
		$repeater->add_control(
			'tooltip_text_rotate',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Tooltip Text Rotate', 'theplus' ),
				'size_units'  => array( 'deg' ),
				'range'       => array(
					'deg' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'deg',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'transform: translateY(-50%) rotate({{SIZE}}{{UNIT}})',
				),
			)
		);
		$repeater->add_control(
			'tooltip_text_top',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Tooltip Text Top', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'top:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$repeater->add_control(
			'tooltip_text_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Tooltip Text Left', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'left:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$repeater->add_control(
			'tooltip_text_arrow',
			array(
				'label'   => esc_html__( 'Arrow Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrow-left',
				'options' => array(
					'arrow-left'   => esc_html__( 'Left', 'theplus' ),
					'arrow-right'  => esc_html__( 'Right', 'theplus' ),
					'arrow-top'    => esc_html__( 'Top', 'theplus' ),
					'arrow-bottom' => esc_html__( 'Bottom', 'theplus' ),
					'arrow-none'   => esc_html__( 'None', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'circle_menu_list',
			array(
				'label'       => esc_html__( 'Menu List', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tooltip_menu_title'    => esc_html__( 'Facebook', 'theplus' ),
						'loop_image_icon'       => 'icon',
						'loop_icon_style'       => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-facebook',
					),
					array(
						'tooltip_menu_title'    => esc_html__( 'Twitter', 'theplus' ),
						'loop_image_icon'       => 'icon',
						'loop_icon_style'       => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-twitter',
					),
					array(
						'tooltip_menu_title'    => esc_html__( 'Instagram', 'theplus' ),
						'loop_image_icon'       => 'icon',
						'loop_icon_style'       => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-instagram',
					),
					array(
						'tooltip_menu_title'    => esc_html__( 'Linkedin', 'theplus' ),
						'loop_image_icon'       => 'icon',
						'loop_icon_style'       => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-linkedin',
					),
				),
				'title_field' => '{{{ loop_image_icon }}}',
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'icon_toggle',
			array(
				'label' => esc_html__( 'Toggle Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'loop_image_main_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''      => esc_html__( 'None', 'theplus' ),
					'icon'  => esc_html__( 'Icon', 'theplus' ),
					'image' => esc_html__( 'Image', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'loop_max_main_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max Width Svg', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 100,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'loop_image_main_icon' => 'svg',
					'loop_svg_main_icon'   => array( 'img' ),
				),
			)
		);
		$this->add_control(
			'loop_select_main_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'loop_image_main_icon' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'loop_select_main_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'loop_image_main_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'loop_icon_main_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
				'condition' => array(
					'loop_image_main_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'loop_icon_main_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-home',
				'condition' => array(
					'loop_image_main_icon' => 'icon',
					'loop_icon_main_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'loop_icon_main_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'loop_image_main_icon' => 'icon',
					'loop_icon_main_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'loop_icons_main_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'loop_image_main_icon' => 'icon',
					'loop_icon_main_style' => 'icon_mind',
				),
			)
		);

		$this->add_control(
			'toggle_open_icon_style',
			array(
				'label'     => esc_html__( 'Menu Open Icon Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'style 3', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		/* Toggle Icon */

		/* Icon Position*/
		$this->start_controls_section(
			'icon_position_section',
			array(
				'label' => esc_html__( 'Icon Position', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'main_icon_position',
			array(
				'label'   => esc_html__( 'Position', 'theplus' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'absolute',
				'options' => array(
					'absolute' => esc_html__( 'Absolute', 'theplus' ),
					'fixed'    => esc_html__( 'Fixed', 'theplus' ),
				),
			)
		);
		$this->start_controls_tabs( 'circle_icon_position' );
		/*desktop  start*/
		$this->start_controls_tab(
			'normal',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);
		$this->add_control(
			'd_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);

		$this->add_control(
			'd_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 20,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_left_auto' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$this->add_control(
			'd_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 20,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_right_auto' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$this->add_control(
			'd_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 0,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_top_auto' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'd_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
			)
		);
		$this->add_control(
			'd_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => 0,
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					'd_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tablet',
			array(
				'label' => esc_html__( 'Tablet', 'theplus' ),
			)
		);
		$this->add_control(
			't_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$this->add_control(
			't_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_left_auto'  => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			't_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_right_auto' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive' => array( 'yes' ),
					't_top_auto'   => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					't_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			't_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator' => 'after',
				'condition' => array(
					't_responsive'  => array( 'yes' ),
					't_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'mobile',
			array(
				'label' => esc_html__( 'Mobile', 'theplus' ),
			)
		);
		$this->add_control(
			'm_responsive',
			array(
				'label'     => esc_html__( 'Responsive Values', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$this->add_control(
			'm_left_auto',
			array(
				'label'     => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_xposition',
			array(
				'label'     => esc_html__( 'Left', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_left_auto'  => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_right_auto',
			array(
				'label'     => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_rightposition',
			array(
				'label'     => esc_html__( 'Right', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_right_auto' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'm_top_auto',
			array(
				'label'     => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_yposition',
			array(
				'label'     => esc_html__( 'Top', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
					'm_top_auto'   => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_bottom_auto',
			array(
				'label'     => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( '%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'm_responsive' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'm_pos_bottomposition',
			array(
				'label'     => esc_html__( 'Bottom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => '%',
					'size' => '',
				),
				'range'     => array(
					'%' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'condition' => array(
					'm_responsive'  => array( 'yes' ),
					'm_bottom_auto' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		/*mobile end*/
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Icon Position*/

		/* Extra Options*/
		$this->start_controls_section(
			'extra_option_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'angle_start',
			array(
				'label'      => esc_html__( 'Angle Start', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'icon_direction'   => array( 'none' ),
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_control(
			'angle_end',
			array(
				'label'      => esc_html__( 'Angle End', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 90,
				),
				'condition'  => array(
					'icon_direction'   => array( 'none' ),
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_responsive_control(
			'circle_radius',
			array(
				'label'      => esc_html__( 'Circle Radius', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 5,
					),
				),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 150,
				),
				'condition'  => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_control(
			'icon_delay',
			array(
				'label'      => esc_html__( 'Icon Delay', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 7000,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1000,
				),
				'condition'  => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);
		$this->add_control(
			'icon_speed',
			array(
				'label'      => esc_html__( 'Menu Open Speed', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 500,
				),
				'condition'  => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_control(
			'icon_step_in',
			array(
				'label'      => esc_html__( 'Icon Step In', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -20,
				),
				'condition'  => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_control(
			'icon_step_out',
			array(
				'label'      => esc_html__( 'Icon Step Out', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'condition'  => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);

		$this->add_control(
			'layout_straight_menu_gap',
			array(
				'label'     => esc_html__( 'Menu Between Gap', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'px',
					'size' => 15,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'condition' => array(
					'icon_layout_open' => array( 'straight' ),
				),
			)
		);
		$this->add_control(
			'layout_straight_menu_transition_duration',
			array(
				'label'      => esc_html__( 'Menu Open Speed', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'ms' ),
				'range'      => array(
					'ms' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'ms',
					'size' => 1000,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'transition-duration:{{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'icon_layout_open' => array( 'straight' ),
				),
			)
		);
		$this->add_control(
			'icon_transition',
			array(
				'label'     => esc_html__( 'Icon Transition', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'ease',
				'options'   => array(
					'ease'                  => esc_html__( 'Ease', 'theplus' ),
					'linear'                => esc_html__( 'Linear', 'theplus' ),
					'ease-in'               => esc_html__( 'Ease In', 'theplus' ),
					'ease-out'              => esc_html__( 'Ease Out', 'theplus' ),
					'ease-in-out'           => esc_html__( 'Ease In Out', 'theplus' ),
					'cubic-bezier(n,n,n,n)' => esc_html__( 'Cubic Bezier', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'transition-timing-function:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_trigger',
			array(
				'label'     => esc_html__( 'Icon Trigger', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'hover',
				'options'   => array(
					'hover' => esc_html__( 'Hover', 'theplus' ),
					'click' => esc_html__( 'Click', 'theplus' ),
				),
				'condition' => array(
					'icon_layout_open' => array( 'circle' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_click',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "open-circle-menu-on-click-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'icon_trigger' => array( 'click' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Icon Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'repeater_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),

				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'repeater_circle_width',
			array(
				'label'      => esc_html__( 'Icon Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),

				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'width: calc({{SIZE}}{{UNIT}} - 5px ) !important;height: calc({{SIZE}}{{UNIT}} - 5px) !important;line-height: calc({{SIZE}}{{UNIT}} - 5px) !important;',
				),
			)
		);

		$this->add_responsive_control(
			'repeater_icon_image_width',
			array(
				'label'      => esc_html__( 'Image Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 90,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon img' => 'width: {{SIZE}}{{UNIT}};, height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'repeater_icon_border',
			array(
				'label'     => esc_html__( 'Icon Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'icon_border_radius_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'condition' => array(
					'repeater_icon_border' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'repeater_icon_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'repeater_icon_border' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_icon_border_style' );
		$this->start_controls_tab(
			'tab_icon_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'repeater_icon_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'repeater_icon_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'repeater_icon_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'repeater_icon_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'icon_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Icon Style*/
		$this->start_controls_section(
			'section_toggle_styling',
			array(
				'label' => esc_html__( 'Toggle Icon Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'toggle_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),

				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon svg' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'toggle_icon_width',
			array(
				'label'      => esc_html__( 'Toggle Icon Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),

				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_image_width',
			array(
				'label'      => esc_html__( 'Image Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'circle_menu_border_option',
			array(
				'label'     => esc_html__( 'Circle Menu Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
			)
		);
		$this->add_control(
			'toggle_icon_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'circle_menu_border_option' => array( 'yes' ),
					'repeater_icon_border'      => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'toggle_icon_border_width',
			array(
				'label'      => esc_html__( 'Icon Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),

				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'circle_menu_border_option' => array( 'yes' ),
				),
			)
		);
		$this->start_controls_tabs( 'toggle_icon_main_style' );
		$this->start_controls_tab(
			'toggle_icon_main_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3 a.main_menu_icon .close-toggle-icon,{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3 a.main_menu_icon .close-toggle-icon:before' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon',
			)
		);

		$this->add_control(
			'toggle_icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'circle_menu_border_option' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'toggle_icon_border_radius_normal',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggle_icon_box_shadow_normal',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'toggle_icon_main_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon svg,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3:hover a.main_menu_icon .close-toggle-icon,{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3:hover a.main_menu_icon .close-toggle-icon:before' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'icon_hover_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon',
			)
		);
		$this->add_control(
			'icon_hover_border',
			array(
				'label'     => esc_html__( 'Icon Hover Border', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'circle_menu_border_option' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'toggle_icon_border_radius_hover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon img,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'toggle_icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Icon Style*/
		$this->start_controls_section(
			'icon_tooltip_text_style',
			array(
				'label' => esc_html__( 'Tooltip Text', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltip_text_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title',
			)
		);
		$this->add_control(
			'straight_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'straight_text_border_option',
			array(
				'label'     => esc_html__( 'Circle Menu Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'straight_text_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'repeater_icon_border'        => 'yes',
					'icon_layout_open'            => array( 'straight' ),
					'icon_layout_straight_style'  => 'style-2',
					'straight_text_border_option' => array( 'yes' ),
				),
			)
		);
		$this->add_responsive_control(
			'straight_text_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_layout_open'            => array( 'straight' ),
					'icon_layout_straight_style'  => 'style-2',
					'straight_text_border_option' => array( 'yes' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_straight_text_style' );
		$this->start_controls_tab(
			'tab_straight_text_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'tooltip_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'straight_text_border',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'tooltip_text_normal_bgcolor',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-bottom .menu-tooltip-title:before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-top .menu-tooltip-title:before' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-left .menu-tooltip-title:before' => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-right .menu-tooltip-title:before' => 'border-left-color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltip_text_shadow',
				'selector' => '{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'straight_text_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'straight_text_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list:hover .menu-tooltip-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'straight_text_hover_border',
			array(
				'label'     => esc_html__( 'Hover Border', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_responsive_control(
			'straight_text_border_radius_hover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_control(
			'straight_text_hover_bgcolor',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list:hover .menu-tooltip-title' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'straight_text_shadow_hover',
				'selector'  => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title',
				'condition' => array(
					'icon_layout_open'           => array( 'straight' ),
					'icon_layout_straight_style' => 'style-2',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tooltip_display_desktop',
			array(
				'label'     => esc_html__( 'Visibility Desktop', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'theplus' ),
				'label_off' => esc_html__( 'Show', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tooltip_display_tablet',
			array(
				'label'     => esc_html__( 'Visibility Tablet', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'theplus' ),
				'label_off' => esc_html__( 'Show', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tooltip_display_mobile',
			array(
				'label'     => esc_html__( 'Visibility Mobile', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hide', 'theplus' ),
				'label_off' => esc_html__( 'Show', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_option_style_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'show_scroll_window_offset',
			array(
				'label'     => esc_html__( 'Show Menu Scroll Offset', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'scroll_top_offset_value',
			array(
				'label'      => esc_html__( 'Scroll Top Offset Value', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 'px',
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'condition'  => array(
					'show_scroll_window_offset' => 'yes',
				),
			)
		);
		$this->add_control(
			'show_bg_overlay_color',
			array(
				'label'      => esc_html__( 'Overlay Color', 'theplus' ),
				'type'       => \Elementor\Controls_Manager::SWITCHER,
				'label_on'   => esc_html__( 'Show', 'theplus' ),
				'label_off'  => esc_html__( 'Hide', 'theplus' ),
				'default'    => 'no',
				'separator'  => 'before',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'icon_layout_open',
									'operator' => '==',
									'value'    => 'straight',
								),
								array(
									'name'     => 'icon_layout_open',
									'operator' => '==',
									'value'    => 'circle',
									'name'     => 'icon_trigger',
									'operator' => '==',
									'value'    => 'click',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'show_bg_overlay_color_value',
			array(
				'label'      => esc_html__( 'Color', 'theplus' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => array(
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .show-bg-overlay.activebg' => 'background: {{VALUE}}',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'icon_layout_open',
									'operator' => '==',
									'value'    => 'straight',
								),
								array(
									'name'     => 'icon_layout_open',
									'operator' => '==',
									'value'    => 'circle',
									'name'     => 'icon_trigger',
									'operator' => '==',
									'value'    => 'click',
								),
							),
						),
					),
				),
				'condition'  => array(
					'show_bg_overlay_color' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		/*Extra Option Style*/

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Circle Menu Render.
	 *
	 * @since 1.3.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$icon_direction            = ! empty( $settings['icon_direction'] ) ? $settings['icon_direction'] : 'bottom-right';
		$icon_layout_open          = ! empty( $settings['icon_layout_open'] ) ? $settings['icon_layout_open'] : 'circle';
		$show_scroll_window_offset = 'yes' === $settings['show_scroll_window_offset'] ? 'scroll-view' : '';
		$scroll_top_offset_value   = 'yes' === $settings['show_scroll_window_offset'] ? 'data-scroll-view="' . esc_attr( $settings['scroll_top_offset_value']['size'] ) . '"' : '';

		$show_bg_overlay_color = 'yes' === $settings['show_bg_overlay_color'] ? 'show-bg-overlay' : '';

		$show_bg_overlay_color_value = 'yes' === $settings['show_bg_overlay_color'] ? 'data-overlay-color="' . esc_attr( $settings['show_bg_overlay_color_value'] ) . '"' : '';

		$icon_layout_straight_style     = 'straight' === $settings['icon_layout_open'] ? 'menu-' . esc_attr( $settings['icon_layout_straight_style'] ) : '';
		$layout_straight_menu_direction = 'straight' === $settings['icon_layout_open'] ? 'menu-direction-' . esc_attr( $settings['layout_straight_menu_direction'] ) : '';

		$tooltip_display_desktop = 'yes' === $settings['tooltip_display_desktop'] ? 'tooltip_desktop_hide' : '';
		$tooltip_display_tablet  = 'yes' === $settings['tooltip_display_tablet'] ? 'tooltip_tablet_hide' : '';
		$tooltip_display_mobile  = 'yes' === $settings['tooltip_display_mobile'] ? 'tooltip_mobile_hide' : '';

		if ( 'circle' === $icon_layout_open ) {
			$circle_radius        = ! empty( $settings['circle_radius']['size'] ) ? $settings['circle_radius']['size'] : 150;
			$circle_radius_tablet = ! empty( $settings['circle_radius_tablet']['size'] ) ? $settings['circle_radius_tablet']['size'] : 150;
			$circle_radius_mobile = ! empty( $settings['circle_radius_mobile']['size'] ) ? $settings['circle_radius_mobile']['size'] : 150;

			$icon_delay    = ! empty( $settings['icon_delay']['size'] ) ? $settings['icon_delay']['size'] : 1000;
			$icon_speed    = ! empty( $settings['icon_speed']['size'] ) ? $settings['icon_speed']['size'] : 500;
			$icon_step_in  = ! empty( $settings['icon_step_in']['size'] ) ? $settings['icon_step_in']['size'] : -20;
			$icon_step_out = ! empty( $settings['icon_step_out']['size'] ) ? $settings['icon_step_out']['size'] : 20;
		}

		$icon_transition = ! empty( $settings['icon_transition'] ) ? $settings['icon_transition'] : 'ease';
		$icon_trigger    = ! empty( $settings['icon_trigger'] ) ? $settings['icon_trigger'] : 'hover';

		$loop_image_main_icon = ! empty( $settings['loop_image_main_icon'] ) ? $settings['loop_image_main_icon'] : 'icon';
		$loop_icon_main_style = ! empty( $settings['loop_icon_main_style'] ) ? $settings['loop_icon_main_style'] : 'font_awesome';

		$loop_icon_main_fontawesome = ! empty( $settings['loop_icon_main_fontawesome'] ) ? $settings['loop_icon_main_fontawesome'] : 'fa fa-home';

		$loop_icons_main_mind = ! empty( $settings['loop_icons_main_mind'] ) ? $settings['loop_icons_main_mind'] : '';
		$main_icon_position   = ! empty( $settings['main_icon_position'] ) ? $settings['main_icon_position'] : 'absolute';

		$toggle_open_icon_style = ! empty( $settings['toggle_open_icon_style'] ) ? $settings['toggle_open_icon_style'] : 'style-1';

		if ( 'circle' === $icon_layout_open ) {
			if ( 'none' === $icon_direction ) {
				$angle_start = $settings['angle_start']['size'];
				$angle_end   = $settings['angle_end']['size'];
			} else {
				$angle_start = 0;
				$angle_end   = 0;
			}
		}

		if ( 'absolute' === $main_icon_position ) {
			$position_class = 'circle_menu_position_abs';
		} elseif ( 'fixed' === $main_icon_position ) {
			$position_class = 'circle_menu_position_fix';
		}

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$main_toggle_click = '';

		$uid = uniqid( 'circle_menu' );

		$circle_menu  = '<div class="plus-circle-menu-wrapper ' . esc_attr( $uid ) . ' layout-' . esc_attr( $icon_layout_open ) . ' ' . esc_attr( $show_scroll_window_offset ) . ' ' . esc_attr( $animated_class ) . ' " ' . $animation_attr . ' data-uid=' . esc_attr( $uid ) . ' ' . $scroll_top_offset_value . ' ' . $show_bg_overlay_color_value . '>';
		$circle_menu .= '<div class="plus-circle-menu-inner-wrapper ">';

		if ( ! empty( $settings['show_bg_overlay_color'] ) && 'yes' === $settings['show_bg_overlay_color'] ) {
			$circle_menu .= '<div id="show-bg-overlay" class="show-bg-overlay"></div>';
		}

		$circle_menu .= '<ul class="plus-circle-menu circleMenu-closed ' . esc_attr( $position_class ) . ' ' . $layout_straight_menu_direction . ' ' . $icon_layout_straight_style . ' ' . esc_attr( $tooltip_display_desktop ) . ' ' . esc_attr( $tooltip_display_tablet ) . ' ' . esc_attr( $tooltip_display_mobile ) . '">';

		$main_toggle_click .= '<li class="plus-circle-main-menu-list plus-circle-menu-list ' . esc_attr( $toggle_open_icon_style ) . '">';

		if ( 'icon' === $loop_image_main_icon && 'font_awesome' === $loop_icon_main_style ) {
			$icons_main = '<i class="fa ' . $loop_icon_main_fontawesome . '  toggle-icon-wrap" ></i>';
		} elseif ( 'icon' === $loop_image_main_icon && 'icon_mind' === $loop_icon_main_style ) {
			$icons_main = '<i class="' . $loop_icons_main_mind . ' toggle-icon-wrap" ></i>';
		} elseif ( 'icon' === $loop_image_main_icon && 'font_awesome_5' === $loop_icon_main_style ) {
			$loop_icon_main_fontawesome_5 = $settings['loop_icon_main_fontawesome_5'];
			ob_start();
			\Elementor\Icons_Manager::render_icon( $loop_icon_main_fontawesome_5, array( 'aria-hidden' => 'true' ) );
			$icons_main = ob_get_contents();
			ob_end_clean();
		} elseif ( ! empty( $settings['loop_select_main_image']['url'] ) && 'image' === $loop_image_main_icon ) {
			$loop_select_main_image     = $settings['loop_select_main_image']['id'];
			$loop_select_main_image_src = tp_get_image_rander( $loop_select_main_image, $settings['loop_select_main_image_thumbnail_size'], array( 'class' => 'toggle-icon-wrap' ) );

			$icons_main = $loop_select_main_image_src;
		} else {
			$icons_main = '';
		}

		$close_toggle = '';

		if ( 'style-3' === $toggle_open_icon_style ) {
			$close_toggle = '<span class="close-toggle-icon"></span>';
		}

		$icon_bg2           = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] ) : '';
		$main_toggle_click .= '<a href="#" class="main_menu_icon ' . $icon_bg2 . '" style="cursor:pointer;">' . $icons_main . wp_kses_post( $close_toggle ) . '</a>';
		$main_toggle_click .= '</li>';

		$circle_menu .= $main_toggle_click;

		$ij = 2;

		if ( $settings['circle_menu_list'] ) {
			foreach ( $settings['circle_menu_list'] as $item ) {
				$arrow_text = $item['tooltip_text_arrow'];

				$tooltip_default_hover = ( 'yes' === $item['tooltip_default_hover'] ) ? 'tooltip-default-show' : '';

				$target   = '';
				$nofollow = '';
				if ( ! empty( $item['loop_icon_link_type'] ) && 'email' === $item['loop_icon_link_type'] ) {
					$icon_url = 'mailto:' . sanitize_email( $item['email'] );
				} elseif ( ! empty( $item['loop_icon_link_type'] ) && 'phone' === $item['loop_icon_link_type'] ) {
					$icon_url = 'tel:' . esc_attr( $item['phone'] );
				} elseif ( ! empty( $item['icons_url']['url'] ) ) {
					$target   = $item['icons_url']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['icons_url']['nofollow'] ? ' rel="nofollow"' : '';
					$icon_url = $item['icons_url']['url'];
				} else {
					$target   = ' target="_blank"';
					$nofollow = ' rel="nofollow"';
					$icon_url = '#';
				}

				if ( ! empty( $item['loop_icon_link_type'] ) && 'nolink' !== $item['loop_icon_link_type'] ) {
					$nolink = ' href="' . esc_url( $icon_url ) . '" ' . $target . ' ' . $nofollow;
				} else {
					$nolink = '';
				}

				$circle_menu .= '<li class="plus-circle-menu-list elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $arrow_text ) . ' ' . esc_attr( $tooltip_default_hover ) . '">';

				if ( ! empty( $item['loop_image_icon'] ) ) {

					$tooltip_title = '';
					if ( ! empty( $item['tooltip_menu_title'] ) ) {
						$icon_bg1      = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['icon_background_image'], $item['icon_hover_background_image'] ) : '';
						$tooltip_title = '<span class="menu-tooltip-title ' . esc_attr( $icon_bg1 ) . '">' . wp_kses_post( $item['tooltip_menu_title'] ) . '</span>';
					}

					if ( isset( $item['loop_image_icon'] ) && 'image' === $item['loop_image_icon'] ) {
						$loop_img_src = '';
						if ( ! empty( $item['loop_select_image']['url'] ) ) {
							$loop_select_image = $item['loop_select_image']['id'];
							$loop_img_src      = tp_get_image_rander( $loop_select_image, $item['loop_select_image_thumbnail_size'], array( 'class' => 'img' ) );
						}

						$icon_bg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['icon_background_image'], $item['icon_hover_background_image'] ) : '';

						if ( 'straight' === $icon_layout_open && 'menu-style-2' === $icon_layout_straight_style ) {
							$circle_menu .= '<a ' . $nolink . ' class="menu_icon ' . $icon_bg . '" >' . wp_kses_post( $tooltip_title ) . '</a>';
						} else {
							$circle_menu .= '<a ' . $nolink . ' class="menu_icon ' . $icon_bg . '">' . $loop_img_src . wp_kses_post( $tooltip_title ) . '</a>';
						}
					} elseif ( isset( $item['loop_image_icon'] ) && 'icon' === $item['loop_image_icon'] ) {

						if ( ! empty( $item['loop_icon_style'] ) && 'font_awesome' === $item['loop_icon_style'] ) {
							$icons = $item['loop_icon_fontawesome'];
						} elseif ( ! empty( $item['loop_icon_style'] ) && 'icon_mind' === $item['loop_icon_style'] ) {
							$icons = $item['loop_icons_mind'];
						} elseif ( ! empty( $item['loop_icon_style'] ) && 'font_awesome_5' === $item['loop_icon_style'] ) {
							ob_start();
							\Elementor\Icons_Manager::render_icon( $item['loop_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
							$icons = ob_get_contents();
							ob_end_clean();
						} else {
							$icons = '';
						}

						if ( 'straight' === $icon_layout_open && 'menu-style-2' === $icon_layout_straight_style ) {
							$circle_menu .= '<a ' . $nolink . ' class="menu_icon" >' . $tooltip_title . '</a>';
						} else {
							$icon_bg4 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $item['icon_background_image'], $item['icon_hover_background_image'] ) : '';
							if ( ! empty( $item['loop_icon_style'] ) && 'font_awesome_5' === $item['loop_icon_style'] ) {
								$circle_menu .= '<a ' . $nolink . ' class="menu_icon ' . $icon_bg4 . '" ><span>' . $icons . '</span>' . $tooltip_title . '</a>';
							} else {
								$circle_menu .= '<a ' . $nolink . ' class="menu_icon ' . $icon_bg4 . '" ><i class=" ' . esc_attr( $icons ) . ' " ></i>' . $tooltip_title . '</a>';
							}
						}
					}
				}

				$circle_menu .= '</li>';
				++$ij;
			}
		}

		$circle_menu .= '</ul>';
		$circle_menu .= '</div>';
		$circle_menu .= '</div>';

		$circle_menu_js = '';
		if ( 'circle' === $icon_layout_open ) {
				$circle_menu_js = 'jQuery(document).ready(function(i){						
					jQuery(".' . esc_attr( $uid ) . ' .plus-circle-menu").circleMenu({			
						direction: "' . esc_attr( $icon_direction ) . '",
						angle:{start:' . esc_attr( $angle_start ) . ', end:' . esc_attr( $angle_end ) . '},
						circle_radius: ' . esc_attr( $circle_radius ) . ',
						circle_radius_tablet: ' . esc_attr( $circle_radius_tablet ) . ',
						circle_radius_mobile: ' . esc_attr( $circle_radius_mobile ) . ',
						delay:' . esc_attr( $icon_delay ) . ',			
						item_diameter:0,
						speed: ' . esc_attr( $icon_speed ) . ',
						step_in: ' . esc_attr( $icon_step_in ) . ',
						step_out: ' . esc_attr( $icon_step_out ) . ',
						transition_function: "' . esc_attr( $icon_transition ) . '",
						trigger: "' . esc_attr( $icon_trigger ) . '"
					});
				});';
			$circle_menu       .= wp_print_inline_script_tag( $circle_menu_js );
		}
		$circle_menu .= '<style>';

		$rpos = 'auto';
		$bpos = 'auto';
		$ypos = 'auto';
		$xpos = 'auto';

		if ( 'yes' === $settings['d_left_auto'] ) {
			if ( ! empty( $settings['d_pos_xposition']['size'] ) || '0' == $settings['d_pos_xposition']['size'] ) {
				$xpos = $settings['d_pos_xposition']['size'] . $settings['d_pos_xposition']['unit'];
			}
		}
		if ( 'yes' === $settings['d_top_auto'] ) {
			if ( ! empty( $settings['d_pos_yposition']['size'] ) || '0' == $settings['d_pos_yposition']['size'] ) {
				$ypos = $settings['d_pos_yposition']['size'] . $settings['d_pos_yposition']['unit'];
			}
		}
		if ( 'yes' === $settings['d_bottom_auto'] ) {
			if ( ! empty( $settings['d_pos_bottomposition']['size'] ) || '0' == $settings['d_pos_bottomposition']['size'] ) {
				$bpos = $settings['d_pos_bottomposition']['size'] . $settings['d_pos_bottomposition']['unit'];
			}
		}
		if ( 'yes' === $settings['d_right_auto'] ) {
			if ( ! empty( $settings['d_pos_rightposition']['size'] ) || '0' == $settings['d_pos_rightposition']['size'] ) {
				$rpos = $settings['d_pos_rightposition']['size'] . $settings['d_pos_rightposition']['unit'];
			}
		}

		$circle_menu .= '.' . esc_attr( $uid ) . ' .plus-circle-menu{margin: 0 auto !important;margin-top:' . esc_attr( $ypos ) . ' !important;bottom:' . esc_attr( $bpos ) . ';left:' . esc_attr( $xpos ) . ';right:' . esc_attr( $rpos ) . ';}';

		if ( ! empty( $rpos ) && '0%' === $rpos && ! empty( $xpos ) && '0%' === $xpos ) {
			$circle_menu .= '.' . esc_attr( $uid ) . '.layout-circle .plus-circle-menu{left: calc(' . esc_attr( $xpos ) . ' - ' . intval( $settings['toggle_icon_width']['size'] ) . $settings['toggle_icon_width']['unit'] . ' );}';
		}
		if ( ! empty( $ypos ) && 'auto' === $ypos ) {
			$circle_menu .= '.' . esc_attr( $uid ) . ' .plus-circle-menu{top: auto;}';
		}

		if ( ! empty( $settings['t_responsive'] ) && 'yes' === $settings['t_responsive'] ) {
			$tablet_xpos = 'auto';
			$tablet_ypos = 'auto';
			$tablet_bpos = 'auto';
			$tablet_rpos = 'auto';

			if ( 'yes' === $settings['t_left_auto'] ) {
				if ( ! empty( $settings['t_pos_xposition']['size'] ) || '0' == $settings['t_pos_xposition']['size'] ) {
					$tablet_xpos = $settings['t_pos_xposition']['size'] . $settings['t_pos_xposition']['unit'];
				}
			}

			if ( 'yes' === $settings['t_top_auto'] ) {
				if ( ! empty( $settings['t_pos_yposition']['size'] ) || '0' == $settings['t_pos_yposition']['size'] ) {
					$tablet_ypos = $settings['t_pos_yposition']['size'] . $settings['t_pos_yposition']['unit'];
				}
			}

			if ( 'yes' === $settings['t_bottom_auto'] ) {
				if ( ! empty( $settings['t_pos_bottomposition']['size'] ) || '0' == $settings['t_pos_bottomposition']['size'] ) {
					$tablet_bpos = $settings['t_pos_bottomposition']['size'] . $settings['t_pos_bottomposition']['unit'];
				}
			}

			if ( 'yes' === $settings['t_right_auto'] ) {
				if ( ! empty( $settings['t_pos_rightposition']['size'] ) || '0' == $settings['t_pos_rightposition']['size'] ) {
					$tablet_rpos = $settings['t_pos_rightposition']['size'] . $settings['t_pos_rightposition']['unit'];
				}
			}

			$circle_menu .= '@media (min-width:601px) and (max-width:990px){.' . esc_attr( $uid ) . ' .plus-circle-menu{margin: 0 auto !important;margin-top:' . esc_attr( $tablet_ypos ) . ' !important;bottom:' . esc_attr( $tablet_bpos ) . ';left:' . esc_attr( $tablet_xpos ) . ';right:' . esc_attr( $tablet_rpos ) . ';}';
			if ( ! empty( $tablet_rpos ) && '0%' === $tablet_rpos && ! empty( $tablet_xpos ) && '0%' === $tablet_xpos ) {
				$circle_menu .= '.' . esc_attr( $uid ) . '.layout-circle .plus-circle-menu{left: calc(' . esc_attr( $tablet_xpos ) . ' - ' . intval( $settings['toggle_icon_width']['size'] ) . $settings['toggle_icon_width']['unit'] . ' );}';
			}

			if ( ! empty( $tablet_ypos ) && 'auto' === $tablet_ypos ) {
				$circle_menu .= '.' . esc_attr( $uid ) . ' .plus-circle-menu{top: auto;}';
			}

			$circle_menu .= '}';
		}
		if ( ! empty( $settings['m_responsive'] ) && 'yes' === $settings['m_responsive'] ) {
			$mobile_xpos = 'auto';
			$mobile_ypos = 'auto';
			$mobile_bpos = 'auto';
			$mobile_rpos = 'auto';

			if ( 'yes' === $settings['m_left_auto'] ) {
				if ( ! empty( $settings['m_pos_xposition']['size'] ) || '0' == $settings['m_pos_xposition']['size'] ) {
					$mobile_xpos = $settings['m_pos_xposition']['size'] . $settings['m_pos_xposition']['unit'];
				}
			}

			if ( 'yes' === $settings['m_top_auto'] ) {
				if ( ! empty( $settings['m_pos_yposition']['size'] ) || '0' == $settings['m_pos_yposition']['size'] ) {
					$mobile_ypos = $settings['m_pos_yposition']['size'] . $settings['m_pos_yposition']['unit'];
				}
			}

			if ( 'yes' === $settings['m_bottom_auto'] ) {
				if ( ! empty( $settings['m_pos_bottomposition']['size'] ) || '0' == $settings['m_pos_bottomposition']['size'] ) {
					$mobile_bpos = $settings['m_pos_bottomposition']['size'] . $settings['m_pos_bottomposition']['unit'];
				}
			}

			if ( 'yes' === $settings['m_right_auto'] ) {
				if ( ! empty( $settings['m_pos_rightposition']['size'] ) || '0' == $settings['m_pos_rightposition']['size'] ) {
					$mobile_rpos = $settings['m_pos_rightposition']['size'] . $settings['m_pos_rightposition']['unit'];
				}
			}

			$circle_menu .= '@media (max-width:600px){.' . esc_attr( $uid ) . ' .plus-circle-menu{margin: 0 auto !important; margin-top:' . esc_attr( $mobile_ypos ) . ' !important;bottom:' . esc_attr( $mobile_bpos ) . ';left:' . esc_attr( $mobile_xpos ) . ';right:' . esc_attr( $mobile_rpos ) . ';}';

			if ( ! empty( $mobile_rpos ) && '0%' === $mobile_rpos && ! empty( $mobile_xpos ) && '0%' === $mobile_xpos ) {
				$circle_menu .= '.' . esc_attr( $uid ) . '.layout-circle .plus-circle-menu{left: calc(' . esc_attr( $mobile_xpos ) . ' - ' . intval( $settings['toggle_icon_width']['size'] ) . $settings['toggle_icon_width']['unit'] . ' );}';
			}

			if ( ! empty( $mobile_ypos ) && 'auto' === $mobile_ypos ) {
				$circle_menu .= '.' . esc_attr( $uid ) . ' .plus-circle-menu{top: auto;}';
			}

			$circle_menu .= '}';
		}

		if ( 'straight' === $icon_layout_open ) {
			$value = 0;

			$i = 2;
			if ( $ij > 1 ) {
				while ( $i < $ij ) {

					if ( 'right' === $settings['layout_straight_menu_direction'] ) {
						$value = $settings['layout_straight_menu_gap']['size'] + $value + $settings['toggle_icon_width']['size'];

						$circle_menu .= '.' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-right .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '), .' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-right .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '){
							left: ' . esc_attr( $value ) . 'px;
						}';
					}

					if ( 'bottom' === $settings['layout_straight_menu_direction'] ) {
						$value = $settings['layout_straight_menu_gap']['size'] + $value;

						$circle_menu .= '.' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-bottom .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '), .' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-bottom .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '){ top: ' . esc_attr( $value ) . 'px; }';
					}

					if ( 'left' === $settings['layout_straight_menu_direction'] ) {
						$value = $settings['layout_straight_menu_gap']['size'] + $value;

						$circle_menu .= '.' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-left .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '), .' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-left .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '){ right: ' . esc_attr( $value ) . 'px; }';
					}

					if ( 'top' === $settings['layout_straight_menu_direction'] ) {
						$value = $settings['layout_straight_menu_gap']['size'] + $value;

						$circle_menu .= '.' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-top .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '), .' . esc_attr( $uid ) . '.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-top .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child(' . esc_attr( $i ) . '){ bottom: ' . esc_attr( $value ) . 'px; }';
					}

					++$i;
				}
			}
		}

		$circle_menu .= '</style>';

		echo $circle_menu;
	}
}
