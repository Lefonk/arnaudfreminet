<?php
/**
 * Widget Name: Mobile Menu
 * Description: Mobile Menu
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

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Mobile_Menu
 */
class ThePlus_Mobile_Menu extends Widget_Base {

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
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-mobile-menu';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Mobile Menu', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-mobile theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-header' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Mobile Menu', 'Hamburger Menu', 'Responsive Menu', 'Navigation Menu', 'Menu Widget', 'Elementor Menu', 'Elementor Navigation', 'Elementor Mobile Menu' );
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
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'section_advanced_buttons',
			array(
				'label' => esc_html__( 'Mobile Menu', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'mm_style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => esc_html__( 'Style 1', 'theplus' ),
					'style_2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_style2',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-split-mobile-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mm_style' => array( 'style_2' ),
				),
			)
		);
		$this->add_control(
			'mobile_menu_pos',
			array(
				'label'   => esc_html__( 'Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fixed',
				'options' => array(
					'absolute' => esc_html__( 'Absolute', 'theplus' ),
					'fixed'    => esc_html__( 'Fixed', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'mobile_menu_pos_po',
			array(
				'label'     => esc_html__( 'Fixed Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'mobile_menu_pos' => 'fixed',
				),
			)
		);
		$this->add_control(
			'how_it_works_bottom',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-sticky-bottom-mobile-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mobile_menu_pos_po' => array( 'bottom' ),
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
				'separator'  => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_mm_st1',
			array(
				'label' => esc_html__( 'Menu 1', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'mm_st1_icon_image',
			array(
				'label'   => esc_html__( 'Select Icon', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mm_st1_icon',
				'options' => array(
					'mm_st1_icon'  => esc_html__( 'Icon', 'theplus' ),
					'mm_st1_image' => esc_html__( 'Image', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'mm_st1_custom_icon',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-calendar-alt',
					'library' => 'solid',
				),
				'condition' => array(
					'mm_st1_icon_image' => 'mm_st1_icon',
				),
			)
		);
		$repeater->add_control(
			'mm_st1_custom_image',
			array(
				'label'      => esc_html__( 'Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'mm_st1_icon_image' => 'mm_st1_image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'mmst1_ci_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'mm_st1_icon_image' => 'mm_st1_image',
				),
			)
		);
		$repeater->add_control(
			'mm_st1_text',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The', 'theplus' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'mm_st1_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'separator'     => 'before',
				'dynamic'       => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'mm_st1_pin_text',
			array(
				'label'     => esc_html__( 'Pin Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-loop-inner:after' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'mm_st1_content',
			array(
				'label'       => esc_html__( 'Menu 1', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'separator'   => 'before',
				'default'     => array(
					array(
						'mm_st1_text' => '1',
					),
					array(
						'mm_st1_text' => '2',
					),
					array(
						'mm_st1_text' => '3',
					),
					array(
						'mm_st1_text' => '4',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ mm_st1_text }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_mm_st2_r',
			array(
				'label'     => esc_html__( 'Menu 2', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'mm_style' => 'style_2',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'mm_st2_icon_image_r',
			array(
				'label'   => esc_html__( 'Select Icon', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mm_st2_icon_r',
				'options' => array(
					'mm_st2_icon_r'  => esc_html__( 'Icon', 'theplus' ),
					'mm_st2_image_r' => esc_html__( 'Image', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'mm_st2_custom_icon_r',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-calendar-alt',
					'library' => 'solid',
				),
				'condition' => array(
					'mm_st2_icon_image_r' => 'mm_st2_icon_r',
				),
			)
		);
		$repeater->add_control(
			'mm_st2_custom_image_r',
			array(
				'label'      => esc_html__( 'Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'mm_st2_icon_image_r' => 'mm_st2_image_r',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'mmst2_cir_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'mm_st2_icon_image_r' => 'mm_st2_image_r',
				),
			)
		);
		$repeater->add_control(
			'mm_st2_text_r',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Plus', 'theplus' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'mm_st2_link_r',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'separator'     => 'before',
				'dynamic'       => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'mm_st2_pin_text_r',
			array(
				'label'     => esc_html__( 'Pin Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .tp-loop-inner:after' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_control(
			'mm_st2_content_r',
			array(
				'label'       => esc_html__( 'Menu 2', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'separator'   => 'before',
				'default'     => array(
					array(
						'mm_st2_text_r' => '3',
					),
					array(
						'mm_st2_text_r' => '4',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ mm_st2_text_r }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_mm_extra_toggle',
			array(
				'label' => esc_html__( 'Extra Toggle', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'mm_extra_toggle_switch',
			array(
				'label'     => esc_html__( 'Extra Toggle', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'mm_extra_toggle_icon_image',
			array(
				'label'     => esc_html__( 'Select Toggle Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mm_ext_tgl_icon',
				'options'   => array(
					'mm_ext_tgl_icon'  => esc_html__( 'Icon', 'theplus' ),
					'mm_ext_tgl_image' => esc_html__( 'Image', 'theplus' ),
				),
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_custom_icon',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'far fa-calendar-check',
					'library' => 'solid',
				),
				'condition' => array(
					'mm_extra_toggle_switch'     => 'yes',
					'mm_extra_toggle_icon_image' => 'mm_ext_tgl_icon',
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_custom_image',
			array(
				'label'      => esc_html__( 'Image', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'mm_extra_toggle_switch'     => 'yes',
					'mm_extra_toggle_icon_image' => 'mm_ext_tgl_image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'mm_et_ci_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'mm_extra_toggle_switch'     => 'yes',
					'mm_extra_toggle_icon_image' => 'mm_ext_tgl_image',
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_text',
			array(
				'label'     => esc_html__( 'Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'TP', 'theplus' ),
				'separator' => 'before',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_link_template',
			array(
				'label'     => esc_html__( 'Content', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'et_link',
				'options'   => array(
					'et_link'     => esc_html__( 'Link', 'theplus' ),
					'et_template' => esc_html__( 'Template', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'how_it_works_template',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-popup-mobile-menu-with-elementor-template/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mm_extra_toggle_link_template' => array( 'et_template' ),
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_link',
			array(
				'label'       => esc_html__( 'Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_link',
				),
			)
		);
		$this->add_control(
			'extra_content_template_et',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
				),
			)
		);
		$this->add_control(
			'extra_toggle_bar_direction',
			array(
				'label'     => esc_html__( 'Open Content Direction', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => array(
					'right'  => esc_html__( 'Right', 'theplus' ),
					'left'   => esc_html__( 'Left', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
				),
			)
		);
		$this->add_control(
			'extra_toggle_style',
			array(
				'label'     => esc_html__( 'Open Content Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'mm-ett-style-1',
				'options'   => array(
					'mm-ett-style-1' => esc_html__( 'Style 1', 'theplus' ),
					'mm-ett-style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
				'separator' => 'before',
				'condition' => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
				),
			)
		);
		$this->add_control(
			'extra_content_width_option',
			array(
				'label'     => esc_html__( 'Content Width', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom',
				'options'   => array(
					'custom'    => esc_html__( 'Custom Width/Height', 'theplus' ),
					'fullwidth' => esc_html__( 'Full-Width/Height', 'theplus' ),
				),
				'condition' => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
				),
			)
		);
		$this->add_responsive_control(
			'extra_content_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.full-width-content.open' => 'width:calc(100% - {{SIZE}}%);height:calc(100% -  {{SIZE}}%); max-width:calc(100% - {{SIZE}}%);max-height:calc(100% - {{SIZE}}%);
					align-items: center;justify-content: center;vertical-align: middle;right: 0;left: 0;margin: 0 auto;top: 50%;transform: translateY(-50%);',
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.full-width-content' => 'transition: all 0.3s ease-in-out;',
				),
				'condition'  => array(
					'extra_content_width_option' => 'fullwidth',
				),
			)
		);
		$this->add_responsive_control(
			'extra_content_width',
			array(
				'label'      => esc_html__( 'Custom Content Width/Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 400,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.left,{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.right' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.top,{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.bottom' => 'max-height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
					'extra_content_width_option'    => 'custom',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mm_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'mm_extra_display_mode',
			array(
				'label'   => esc_html__( 'Display', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'swiper',
				'options' => array(
					'swiper'  => esc_html__( 'Swiper', 'theplus' ),
					'columns' => esc_html__( 'Columns', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_swiper',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-a-swiper-mobile-menu-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'mm_extra_display_mode' => array( 'swiper' ),
				),
			)
		);
		$this->add_control(
			'mm_extra_indicator_switch',
			array(
				'label'     => esc_html__( 'Active Page Indicator', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'mm_extra_indicator_type',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'line',
				'options'   => array(
					'line' => esc_html__( 'Line', 'theplus' ),
					'dot'  => esc_html__( 'Dot', 'theplus' ),
				),
				'condition' => array(
					'mm_extra_indicator_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'mm_extra_indicator',
			array(
				'label'     => esc_html__( 'Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''            => esc_html__( 'Select', 'theplus' ),
					'indi-top'    => esc_html__( 'Top', 'theplus' ),
					'indi-bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'line',
				),
			)
		);
		$this->add_responsive_control(
			'mm_extra_indicator_dot_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.dot.active .tp-menu-link:after' => 'bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'dot',
				),
			)
		);
		$this->add_control(
			'pin_text_overflow',
			array(
				'label'     => esc_html__( 'Pin Text Overflow', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hidden',
				'options'   => array(
					'hidden'  => esc_html__( 'Hidden', 'theplus' ),
					'visible' => esc_html__( 'Visible', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-l-wrapper .tp-mm-li,
					{{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-r-wrapper .tp-mm-li,
					{{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-c-wrapper .tp-mm-c-et-li' => ' overflow:{{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_icon_image_styling',
			array(
				'label' => esc_html__( 'Icon/Image Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'mm_icon_head',
			array(
				'label' => esc_html__( 'Icon Style', 'theplus' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'mm_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li i,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link i,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-menu-link i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li svg,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link svg,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mm_icon' );
		$this->start_controls_tab(
			'tab_mm_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'mm_icon_color_n',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li i,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link i,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-menu-link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li svg,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link svg,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mm_icon_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'mm_icon_color_a',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active i,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link i,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-menu-link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active svg,{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link svg,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'mm_image_head',
			array(
				'label'     => esc_html__( 'Image Style', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mm_image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mm_image' );
		$this->start_controls_tab(
			'tab_mm_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mm_image_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img',
			)
		);
		$this->add_responsive_control(
			'mm_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_image_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mm_image_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mm_image_border_a',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner .tp-mm-img',
			)
		);
		$this->add_responsive_control(
			'mm_image_radius_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner .tp-mm-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_image_shadow_a',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner .tp-mm-img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_et_icon_image_styling',
			array(
				'label'     => esc_html__( 'Extra Toggle Icon/Image Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'mm_et_icon_head',
			array(
				'label' => esc_html__( 'Icon Style', 'theplus' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_responsive_control(
			'mm_et_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link i,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-menu-link i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link svg,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'mm_et_icon_color_n',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link i,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-menu-link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-mm-c-wrapper .tp-menu-link svg,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'mm_et_image_head',
			array(
				'label'     => esc_html__( 'Image Style', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mm_et_image_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img.tp-mm-et-img' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mm_et_image_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img.tp-mm-et-img',
			)
		);
		$this->add_responsive_control(
			'mm_et_image_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img.tp-mm-et-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_et_image_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner .tp-mm-img.tp-mm-et-img',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_indicator_styling',
			array(
				'label'     => esc_html__( 'Active Page Indicator Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'mm_extra_indicator_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'mm_indicator_line_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active:before,{{WRAPPER}}  .tp-mobile-menu .tp-mm-li.active:after' => 'width: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'line',
				),
			)
		);
		$this->add_responsive_control(
			'mm_indicator_line_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active:before,{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active:after' => 'border-width: {{SIZE}}{{UNIT}} !important',
				),
				'condition'   => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'line',
				),
			)
		);
		$this->add_control(
			'mm_indicator_line_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active:before,{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active:after' => 'border-color: {{VALUE}} !important;',
				),
				'condition' => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'line',
				),

			)
		);
		$this->add_responsive_control(
			'mm_indicator_dot_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Size', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'after',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.dot.active .tp-menu-link:after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'dot',
				),
			)
		);
		$this->add_control(
			'mm_indicator_dot_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.dot.active .tp-menu-link:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'mm_extra_indicator_switch' => 'yes',
					'mm_extra_indicator_type'   => 'dot',
				),

			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_main_menu_styling',
			array(
				'label' => esc_html__( 'Menu Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'mm_main_menu_margin',
			array(
				'label'      => esc_html__( 'Outer Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mm-wrapper .tp-mm-wrapper-inner .tp-mm-li,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-ul .tp-mm-et-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-l-wrapper .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-r-wrapper .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-mm-li, {{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-c-wrapper .tp-mm-c-et-li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'max_width_loop',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Menu Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mm-wrapper .tp-mm-wrapper-inner .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-l-wrapper .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-r-wrapper .tp-mm-li' => 'max-width:{{SIZE}}{{UNIT}} !important;min-width:{{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'mm_extra_display_mode' => 'swiper',
				),
			)
		);
		$this->add_responsive_control(
			'max_height_loop',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Menu Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 70,
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mm-wrapper .tp-mm-wrapper-inner .tp-mm-li,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-ul .tp-mm-et-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-l-wrapper .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-r-wrapper .tp-mm-li,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-mm-li, {{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-c-wrapper .tp-mm-c-et-li' => 'max-height:{{SIZE}}{{UNIT}} !important;min-height:{{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'mm_extra_display_mode' => 'swiper',
				),
			)
		);
		$this->add_control(
			'n_title_head',
			array(
				'label'     => esc_html__( 'Title Typography', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'n_title',
				'selector' => '{{WRAPPER}} .tp-mm-wrapper .tp-mm-wrapper-inner .tp-mm-li .tp-mm-st1-title,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-mm-extra-toggle,{{WRAPPER}}  .tp-mobile-menu.style_2 .tp-mm-st1-title, {{WRAPPER}}  .tp-mobile-menu.style_2 .tp-mm-extra-toggle',
			)
		);
		$this->start_controls_tabs( 'tabs_mm_main_menu' );
		$this->start_controls_tab(
			'tab_mm_main_menu_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'n_title_color',
			array(
				'label'     => esc_html__( 'Normal Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mm-wrapper .tp-mm-wrapper-inner .tp-mm-li .tp-mm-st1-title,{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-mm-extra-toggle,{{WRAPPER}}  .tp-mobile-menu.style_2 .tp-mm-st1-title, {{WRAPPER}}  .tp-mobile-menu.style_2 .tp-mm-extra-toggle' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'et_title_color',
			array(
				'label'     => esc_html__( 'Extra Toggle Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mm-et-wrapper .tp-mm-et-li .tp-mm-extra-toggle,{{WRAPPER}} .tp-mobile-menu.style_2 .tp-mm-extra-toggle' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mm_main_menu_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'mm_main_menu_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mm_main_menu_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_main_menu_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mm_main_menu_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'n_title_color_a',
			array(
				'label'     => esc_html__( 'Active Title Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-mm-st1-title' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mm_main_menu_background_a',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'mm_main_menu_border_a',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mm_main_menu_radius_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_main_menu_shadow_a',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li.active .tp-loop-inner',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_extra_toggle_styling',
			array(
				'label'     => esc_html__( 'Extra Toggle Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'extra_toggle_equal_height',
			array(
				'label'     => esc_html__( 'Extra Toggle Equal Height/Width', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'extra_toggle_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Extra Toggle Width', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu.style_1.tpet-on .tp-mm-et-wrapper,{{WRAPPER}} .tp-mobile-menu.style_2.tpet-on .tp-mm-c-wrapper' => 'width:{{SIZE}}%;',
					'{{WRAPPER}} .tp-mobile-menu.style_2.tpet-on .tp-mm-l-wrapper,{{WRAPPER}} .tp-mobile-menu.style_2.tpet-on .tp-mm-r-wrapper' => 'width:calc((100% - {{SIZE}}%)/2);',
					'{{WRAPPER}} .tp-mobile-menu.style_1.tpet-on .tp-mm-wrapper' => 'width:calc(100% - {{SIZE}}%);',
				),
				'condition'   => array(
					'mm_extra_toggle_switch'     => 'yes',
					'extra_toggle_equal_height!' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'extra_toggle_width_eq',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Extra Toggle Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,
					 {{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,
					 {{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper' => 'width:{{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;max-height: {{SIZE}}{{UNIT}} !important;min-height :{{SIZE}}{{UNIT}} !important;max-width:{{SIZE}}{{UNIT}} !important;min-width:{{SIZE}}{{UNIT}} !important;',
				),
				'condition'   => array(
					'mm_extra_toggle_switch'    => 'yes',
					'extra_toggle_equal_height' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'extra_toggle_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Toggle Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper,{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper' => 'margin-top:{{SIZE}}{{UNIT}};max-height: {{max_height_loop.SIZE}}px;',
				),
				'condition'   => array(
					'mm_extra_toggle_switch' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'mm_extra_toggle_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'mm_extra_toggle_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'mm_extra_toggle_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_extra_toggle_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-c-wrapper .tp-loop-inner,
				{{WRAPPER}} .tp-mobile-menu .tp-mm-et-wrapper',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_extra_toggle_temp_styling',
			array(
				'label'     => esc_html__( 'Extra Toggle Template Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'mm_extra_toggle_switch'        => 'yes',
					'mm_extra_toggle_link_template' => 'et_template',
				),
			)
		);
		$this->add_control(
			'mm_extra_toggle_temp_heading',
			array(
				'label' => esc_html__( 'Template', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'mm_extra_toggle_temp_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'tp-of-h',
				'options'   => array(
					'tp-of-v' => esc_html__( 'Visible', 'theplus' ),
					'tp-of-h' => esc_html__( 'Hidden', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'content_inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'extra_toggle_content_background',
				'label'    => esc_html__( 'Content Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.mm-ett-style-1,
				{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.mm-ett-style-2:after',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'extra_toggle_content_fw_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.full-width-content.open',
				'condition' => array(
					'extra_content_width_option' => 'fullwidth',
				),
			)
		);
		$this->add_responsive_control(
			'extra_toggle_content_fw_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.full-width-content.open' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'extra_content_width_option' => 'fullwidth',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'extra_toggle_content_fw_shadow',
				'selector'  => '{{WRAPPER}} .tp-mobile-menu.tpet-on .header-extra-toggle-content.full-width-content.open',
				'condition' => array(
					'extra_content_width_option' => 'fullwidth',
				),
			)
		);
		$this->add_control(
			'extra_toggle_close_heading_options',
			array(
				'label'     => esc_html__( 'Close Icon Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tab_extra_toggle_close_position',
			array(
				'label'   => esc_html__( 'Close Icon Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mm-ci-top-right',
				'options' => array(
					'mm-ci-top-left'      => esc_html__( 'Top Left', 'theplus' ),
					'mm-ci-top-center'    => esc_html__( 'Top Center', 'theplus' ),
					'mm-ci-top-right'     => esc_html__( 'Top Right', 'theplus' ),
					'mm-ci-bottom-left'   => esc_html__( 'Bottom Left', 'theplus' ),
					'mm-ci-bottom-center' => esc_html__( 'Bottom Center', 'theplus' ),
					'mm-ci-bottom-right'  => esc_html__( 'Bottom Right', 'theplus' ),
					'mm-ci-auto'          => esc_html__( 'Auto', 'theplus' ),

				),
			)
		);
		$this->start_controls_tabs( 'tabs_extra_toggle_close_style' );
		$this->start_controls_tab(
			'tab_extra_toggle_close_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_color',
			array(
				'label'     => esc_html__( 'Close Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}}  .tp-mobile-menu.tpet-on .extra-toggle-close-menu:before,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:after,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu-auto.tp-mm-ca:before,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu-auto.tp-mm-ca:after' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_bg',
			array(
				'label'     => esc_html__( 'Close Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'extra_toggle_icon_close_box_shadow',
				'label'     => esc_html__( 'Hover Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu',
				'condition' => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_extra_toggle_close_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_color_hover',
			array(
				'label'     => esc_html__( 'Close Icon Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff5a6e',
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:hover:before,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:hover:after,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu-auto.tp-mm-ca:hover:before,{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu-auto.tp-mm-ca:hover:after' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_bg_hover',
			array(
				'label'     => esc_html__( 'Close Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:hover' => 'background: {{VALUE}}',
				),
				'condition' => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->add_control(
			'extra_toggle_icon_close_border_radius_hover',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'extra_toggle_icon_close_box_shadow_hover',
				'label'     => esc_html__( 'Hover Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-close-menu:hover',
				'condition' => array(
					'tab_extra_toggle_close_position!' => 'mm-ci-auto',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'extra_toggle_overlay_heading_options',
			array(
				'label'     => esc_html__( 'Overlay Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'extra_toggle_overlay_background',
				'label'    => esc_html__( 'Overlay Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu.tpet-on .extra-toggle-content-overlay',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'mm_cb_styling',
			array(
				'label' => esc_html__( 'Content Background Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'mm_cb__padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} tp-mobile-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mm_cb_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mm_cb_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu',
			)
		);
		$this->add_responsive_control(
			'mm_cb_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
				),
			)
		);
		$this->add_control(
			'mm_cb_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hidden',
				'options'   => array(
					'hidden'  => esc_html__( 'Hidden', 'theplus' ),
					'visible' => esc_html__( 'Visible', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu' => 'overflow: {{VALUE}} !important;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'mm_cb_box_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pin_text_style_section',
			array(
				'label' => esc_html__( 'Pin Text Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'pin_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};line-height: 1;',
				),
			)
		);
		$this->add_responsive_control(
			'pin_text_top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -400,
						'max'  => 400,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'pin_text_right_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -400,
						'max'  => 400,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'pin_text_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Text Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'pin_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'pin_text_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pin_text_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'pin_text_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pin_text_shadow',
				'selector' => '{{WRAPPER}} .tp-mobile-menu .tp-mm-li .tp-loop-inner:after',
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
				'label'     => esc_html__( 'Show Mobile Menu Scroll Offset', 'theplus' ),
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
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Mobile Menu
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		global $wp;

		$uid = uniqid( 'mm' );

		$scroll_top_offset_value   = ! empty( $settings['scroll_top_offset_value']['size'] ) && 'yes' === $settings['show_scroll_window_offset'] ? 'data-scroll-view="' . esc_attr( $settings['scroll_top_offset_value']['size'] ) . '"' : 'data-scroll-view=""';
		$show_scroll_window_offset = ( 'yes' === $settings['show_scroll_window_offset'] ) ? 'scroll-view' : '';

		$mm_extra_toggle_switch = ! empty( $settings['mm_extra_toggle_switch'] ) ? $settings['mm_extra_toggle_switch'] : 'no';
		$mm_extra_display_mode  = ! empty( $settings['mm_extra_display_mode'] ) ? $settings['mm_extra_display_mode'] : 'swiper';

		$mobile_menu_pos  = ! empty( $settings['mobile_menu_pos'] ) ? $settings['mobile_menu_pos'] : 'fixed';
		$current_page_url = home_url( $wp->request );

		$mm_style       = ! empty( $settings['mm_style'] ) ? $settings['mm_style'] : 'style_1';
		$close_position = ! empty( $settings['tab_extra_toggle_close_position'] ) ? $settings['tab_extra_toggle_close_position'] : 'mm-ci-top-right';
		$position_class = '';
		if ( 'absolute' === $mobile_menu_pos ) {
			$position_class = 'tp-mm-absolute';
		} elseif ( 'fixed' === $mobile_menu_pos ) {
			$position_class = 'tp-mm-fix';
		}

		$extra_toggle = '';

		/** Extra toggle Start*/
		if ( 'yes' === $mm_extra_toggle_switch ) {
			$mm_extra_toggle_icon_image    = ! empty( $settings['mm_extra_toggle_icon_image'] ) ? $settings['mm_extra_toggle_icon_image'] : 'mm_ext_tgl_icon';
			$mm_extra_toggle_link_template = ! empty( $settings['mm_extra_toggle_link_template'] ) ? $settings['mm_extra_toggle_link_template'] : 'et_link';

			$mm_extra_toggle_text = ! empty( $settings['mm_extra_toggle_text'] ) ? $settings['mm_extra_toggle_text'] : '';

			/** Extra toggle icon image Start*/
			$image_alt = '';
			if ( 'mm_ext_tgl_image' === $mm_extra_toggle_icon_image ) {
				$mm_extra_toggle_custom_image = $settings['mm_extra_toggle_custom_image']['id'];

				$img = wp_get_attachment_image_src( $mm_extra_toggle_custom_image, $settings['mm_et_ci_thumbnail_size'] );

				$mm_et_ci_src = isset( $img[0] ) ? $img[0] : '';
				$image_alt    = get_post_meta( $mm_extra_toggle_custom_image, '_wp_attachment_image_alt', true );
				if ( ! $image_alt ) {
					$image_alt = get_the_title( $mm_extra_toggle_custom_image );
				}
				$extra_toggle_ii = '<img class="tp-mm-img tp-mm-et-img" src=' . esc_url( $mm_et_ci_src ) . ' alt="' . esc_attr( $image_alt ) . '" />';
			} elseif ( 'mm_ext_tgl_icon' === $mm_extra_toggle_icon_image ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['mm_extra_toggle_custom_icon'], array( 'aria-hidden' => 'true' ) );
					$extra_toggle_ii = ob_get_contents();
				ob_end_clean();
			} else {
				$extra_toggle_ii = '';
			}

			/** Extra toggle link template Start*/
			if ( ( 'et_link' === $mm_extra_toggle_link_template && ! empty( $extra_toggle_ii ) ) || ( 'et_link' === $mm_extra_toggle_link_template && ! empty( $mm_extra_toggle_text ) ) ) {
				if ( ! empty( $settings['mm_extra_toggle_link']['url'] ) ) {
					$et_a_start = '<a class="tp-menu-link tp-mm-et-link" href="' . esc_url( $settings['mm_extra_toggle_link']['url'] ) . '">';
					$et_a_end   = '</a>';
				}

				$extra_toggle .= wp_kses_post( $et_a_start ) . $extra_toggle_ii . '<span class="tp-mm-extra-toggle">' . wp_kses_post( $mm_extra_toggle_text ) . '</span>' . wp_kses_post( $et_a_end );
			} elseif ( ( 'et_template' === $mm_extra_toggle_link_template && ! empty( $extra_toggle_ii ) ) || ( 'et_template' === $mm_extra_toggle_link_template && ! empty( $mm_extra_toggle_text ) ) ) {
				$open_direction = $settings['extra_toggle_bar_direction'];

				$fullwidth_content  = 'fullwidth' === $settings['extra_content_width_option'] ? 'full-width-content' : '';
				$extra_toggle_style = ! empty( $settings['extra_toggle_style'] ) ? $settings['extra_toggle_style'] : 'mm-ett-style-1';

				$mm_extra_toggle_temp_overflow = $settings['mm_extra_toggle_temp_overflow'];

				$extra_toggle .= '<a class="tp-menu-link tp-mm-et-link" >' . $extra_toggle_ii . '<span class="tp-mm-extra-toggle">' . wp_kses_post( $mm_extra_toggle_text ) . '</span></a>';
				if ( 'mm-ci-auto' === $close_position ) {
					$extra_toggle .= '<div class="extra-toggle-close-menu-auto"></div>';
				}

				$extra_toggle .= '<div class="header-extra-toggle-content ' . esc_attr( $extra_toggle_style ) . ' ' . esc_attr( $fullwidth_content ) . ' ' . esc_attr( $open_direction ) . ' ' . esc_attr( $mm_extra_toggle_temp_overflow ) . '">';
				if ( 'mm-ett-style-2' === $extra_toggle_style ) {
					$extra_toggle .= '<div class="tp-con-open-st2">';
				}

				$extra_toggle .= '<div class="extra-toggle-close-menu ' . esc_attr( $close_position ) . '"></div>';
				$extra_toggle .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['extra_content_template_et'] );
				if ( 'mm-ett-style-2' === $extra_toggle_style ) {
					$extra_toggle .= '</div>';
				}

				$extra_toggle .= '</div>';
				$extra_toggle .= '<div class="extra-toggle-content-overlay"></div>';
			}
		}

		$loop  = '';
		$loop2 = '';

		$indi_class = '';
		if ( 'dot' === $settings['mm_extra_indicator_type'] ) {
			$indi_class = 'dot';
		}

		if ( ! empty( $settings['mm_st1_content'] ) ) {
			$i = 0;

			foreach ( $settings['mm_st1_content'] as $item ) {
				$mm_st1_icon_image  = $item['mm_st1_icon_image'];
				$mm_st1_custom_icon = $item['mm_st1_custom_icon'];

				$mm_st1_custom_image = '';
				if ( ! empty( $item['mm_st1_custom_image'] ) ) {
					$mm_st1_custom_image = $item['mm_st1_custom_image']['id'];

					$img = wp_get_attachment_image_src( $mm_st1_custom_image, $item['mmst1_ci_thumbnail_size'] );

					$mm_st1_custom_image = isset( $img[0] ) ? $img[0] : '';
				}

				$mm_st1_text = $item['mm_st1_text'];
				$mm_st1_link = $item['mm_st1_link'];

				$title_a_start = '';
				$title_a_end   = '';
				/** St1 custom icon Start*/
				if ( 'mm_st1_icon' === $mm_st1_icon_image ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $mm_st1_custom_icon, array( 'aria-hidden' => 'true' ) );
					$mm_st1_custom_icon = ob_get_contents();
					ob_end_clean();
				}

				$mobile_menu = '';
				/** St1 title & link start*/
				if ( ! empty( $item['mm_st1_link']['url'] ) ) {
					$mm_st1_link = $item['mm_st1_link']['url'];
				}

				if ( ! empty( $item['mm_st1_text'] ) ) {
					$mobile_menu .= '<span class="tp-mm-st1-title">' . wp_kses_post( $item['mm_st1_text'] ) . '</span>';
				}
				++$i;

				/** Display st1 start*/
				if ( ! empty( $item['mm_st1_link']['url'] ) ) {
					$title_a_start = '<a class="tp-menu-link tp-mm-normal" href="' . esc_url( $mm_st1_link ) . '">';
					$title_a_end   = '</a>';
				} else {
					$title_a_start = '<a class="tp-menu-link tp-mm-normal">';
					$title_a_end   = '</a>';
				}

				$inner_class_loop = '';
				if ( 'columns' === $mm_extra_display_mode ) {
					$inner_class_loop .= 'grid-item tp-mm-eq-col';
				}

				$loop .= '<li class="tp-mm-li elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $inner_class_loop ) . ' ' . esc_attr( $settings['mm_extra_indicator'] ) . ' ' . esc_attr( $indi_class ) . '"><div class="tp-loop-inner">' . $title_a_start . '';
				if ( ! empty( $mm_st1_custom_icon ) ) {
					$loop .= $mm_st1_custom_icon;
				}

				if ( ! empty( $mm_st1_custom_image ) ) {
					$loop .= '<img class="tp-mm-img tp-mm-st1-img" src=' . esc_url( $mm_st1_custom_image ) . ' />';
				}

				$loop .= $mobile_menu;
				$loop .= '' . $title_a_end . '</div></li>';
			}
		}

		if ( ! empty( $settings['mm_st2_content_r'] ) ) {
			$j = 0;
			foreach ( $settings['mm_st2_content_r'] as $item ) {
				$mm_st2_icon_image_r  = $item['mm_st2_icon_image_r'];
				$mm_st2_custom_icon_r = $item['mm_st2_custom_icon_r'];

				$mm_st2_custom_image_r = '';
				if ( ! empty( $item['mm_st2_custom_image_r'] ) ) {
					$mm_st2_custom_image_r = $item['mm_st2_custom_image_r']['id'];

					$img = wp_get_attachment_image_src( $mm_st2_custom_image_r, $item['mmst2_cir_thumbnail_size'] );

					$mm_st2_custom_image_r = isset( $img[0] ) ? $img[0] : '';
				}

				$mm_st2_text_r = $item['mm_st2_text_r'];
				$mm_st2_link_r = $item['mm_st2_link_r'];
				$title_a_start = '';
				$title_a_end   = '';

				/** St2 custom icon start*/
				if ( 'mm_st2_icon_r' === $mm_st2_icon_image_r ) {
					ob_start();
						\Elementor\Icons_Manager::render_icon( $mm_st2_custom_icon_r, array( 'aria-hidden' => 'true' ) );
						$mm_st2_custom_icon_r = ob_get_contents();
					ob_end_clean();
				}

				$mobile_menu = '';
				/** St2 title & link start*/
				if ( ! empty( $item['mm_st2_link_r']['url'] ) ) {
					$mm_st2_link_r = $item['mm_st2_link_r']['url'];
				}
				if ( ! empty( $item['mm_st2_text_r'] ) ) {
					$mobile_menu .= '<span class="tp-mm-st1-title">' . wp_kses_post( $item['mm_st2_text_r'] ) . '</span>';
				}
				++$j;

				/** Display st2 start*/
				if ( ! empty( $item['mm_st2_link_r']['url'] ) ) {
					$title_a_start = '<a class="tp-menu-link tp-mm-normal" href="' . esc_url( $mm_st2_link_r ) . '">';
					$title_a_end   = '</a>';
				} else {
					$title_a_start = '<a class="tp-menu-link tp-mm-normal">';
					$title_a_end   = '</a>';
				}

				$inner_class_loop = '';
				if ( 'columns' === $mm_extra_display_mode ) {
					$inner_class_loop .= 'grid-item tp-mm-eq-col';
				}

				$loop2 .= '<li class="tp-mm-li elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $inner_class_loop ) . ' ' . esc_attr( $settings['mm_extra_indicator'] ) . ' ' . esc_attr( $indi_class ) . '"><div class="tp-loop-inner">' . $title_a_start . '';
				if ( ! empty( $mm_st2_custom_icon_r ) ) {
					$loop2 .= $mm_st2_custom_icon_r;
				}

				if ( ! empty( $mm_st2_custom_image_r ) ) {
					$loop2 .= '<img class="tp-mm-img tp-mm-st1-img" src=' . esc_url( $mm_st2_custom_image_r ) . ' />';
				}

				$loop2 .= $mobile_menu;
				$loop2 .= '' . $title_a_end . '</div></li>';
			}
		}

		$et_class   = '';
		$main_class = '';

		$inner_class   = '';
		$wrapper_class = '';

		$close_auto_class   = '';
		$wrapper_main_class = '';
		if ( 'swiper' === $mm_extra_display_mode ) {
			$wrapper_main_class .= ' swiper-container';

			$wrapper_class .= ' swiper-wrapper';
			$inner_class   .= ' swiper-slide swiper-slide-active';
		} elseif ( 'columns' === $mm_extra_display_mode ) {
			$inner_class .= 'tp-row';
			$main_class  .= 'tp-column-base';
		}

		if ( 'yes' === $mm_extra_toggle_switch ) {
			$et_class .= ' tpet-on';
		}

		if ( 'mm-ci-auto' === $close_position ) {
			$close_auto_class .= ' tp-mm-ca';
		}

		$mobile_menu_load = '<div class="tp-mobile-menu ' . esc_attr( $uid ) . ' ' . esc_attr( $mm_style ) . ' ' . esc_attr( $et_class ) . ' ' . esc_attr( $main_class ) . ' ' . esc_attr( $position_class ) . ' ' . esc_attr( $settings['mobile_menu_pos_po'] ) . ' ' . esc_attr( $show_scroll_window_offset ) . ' ' . esc_attr( $close_auto_class ) . '" ' . $scroll_top_offset_value . ' data-uid=' . esc_attr( $uid ) . ' >';
		if ( 'style_1' === $mm_style ) {
			$mobile_menu_load .= '<div class="tp-mm-wrapper  ' . esc_attr( $wrapper_main_class ) . '">';

				$mobile_menu_load .= '<div class="tp-mm-wrapper-inner ' . esc_attr( $wrapper_class ) . '">';

					$mobile_menu_load .= '<ul class="tp-mm-ul ' . esc_attr( $inner_class ) . '">';

						$mobile_menu_load .= $loop;

					$mobile_menu_load .= '</ul>';

				$mobile_menu_load .= '</div>';

			$mobile_menu_load .= '</div>';

			if ( 'yes' === $mm_extra_toggle_switch ) {
				$mobile_menu_load .= '<div class="tp-mm-et-wrapper">';

					$mobile_menu_load .= '<ul class="tp-mm-et-ul"><li class="tp-mm-et-li"><div class="tp-loop-inner">' . $extra_toggle . '</div></li></ul>';

				$mobile_menu_load .= '</div>';
			}
		} elseif ( 'style_2' === $mm_style ) {
			$mobile_menu_load .= '<div class="tp-mm-l-wrapper ' . esc_attr( $wrapper_main_class ) . '">';

				$mobile_menu_load .= '<div class="tp-mm-l-wrapper-inner ' . esc_attr( $wrapper_class ) . '">';

					$mobile_menu_load .= '<ul class="tp-mm-l-ul ' . esc_attr( $inner_class ) . '">';

						$mobile_menu_load .= $loop;

					$mobile_menu_load .= '</ul>';

				$mobile_menu_load .= '</div>';

			$mobile_menu_load .= '</div>';

			if ( 'yes' === $mm_extra_toggle_switch ) {
				$mobile_menu_load .= '<div class="tp-mm-c-wrapper">';

					$mobile_menu_load .= '<ul class="tp-mm-c-et-ul"><li class="tp-mm-c-et-li"><div class="tp-loop-inner">' . $extra_toggle . '</div></li></ul>';

				$mobile_menu_load .= '</div>';
			}
			$mobile_menu_load .= '<div class="tp-mm-r-wrapper ' . esc_attr( $wrapper_main_class ) . '">';

				$mobile_menu_load .= '<div class="tp-mm-r-wrapper-inner ' . esc_attr( $wrapper_class ) . '">';

					$mobile_menu_load .= '<ul class="tp-mm-r-ul ' . esc_attr( $inner_class ) . '">';

						$mobile_menu_load .= $loop2;

					$mobile_menu_load .= '</ul>';

				$mobile_menu_load .= '</div>';

			$mobile_menu_load .= '</div>';
		}

		$mobile_menu_load .= '</div>';

		if ( ! empty( $settings['open_mobile_menu']['size'] ) ) {
			$open_mobile_menu  = ( $settings['open_mobile_menu']['size'] ) . $settings['open_mobile_menu']['unit'];
			$close_mobile_menu = ( $settings['open_mobile_menu']['size'] + 1 ) . $settings['open_mobile_menu']['unit'];

			$css_rule  = '@media (min-width:' . esc_attr( $close_mobile_menu ) . '){.tp-mobile-menu.' . esc_attr( $uid ) . '{display:none !important;}}';
			$css_rule .= '@media (max-width:' . esc_attr( $open_mobile_menu ) . '){{.tp-mobile-menu.' . esc_attr( $uid ) . '{display:flex;}}';

			echo '<style>' . esc_attr( $css_rule ) . '</style>';
		}

		echo $mobile_menu_load;
	}

	/**
	 * Render content_template
	 *
	 * @since 3.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
