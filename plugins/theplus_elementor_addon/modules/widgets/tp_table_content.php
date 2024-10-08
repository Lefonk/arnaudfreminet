<?php
/**
 * Widget Name: Table of content
 * Description: Table of content.
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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Table_Content
 */
class ThePlus_Table_Content extends Widget_Base {

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
		return 'tp-table-content';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Table Of Content', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-table theplus_backend_icon';
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
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Table Of Contents', 'TOC', 'Contents Table', 'Navigation', 'Index', 'Menu', 'Links', 'Anchor Links', 'Scroll', 'Scrollspy', 'Elementor Table Of Contents', 'Elementor TOC' );
	}

	/**
	 * Register controls.
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'table_content_option_section',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'Style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'    => esc_html__( 'None', 'theplus' ),
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'typeList',
			array(
				'label'     => esc_html__( 'List Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'OL',
				'options'   => array(
					'UL' => esc_html__( 'UL', 'theplus' ),
					'OL' => esc_html__( 'OL', 'theplus' ),
				),
				'condition' => array(
					'Style' => 'none',
				),
			)
		);
		$this->add_control(
			'selectorHeading',
			array(
				'label'       => __( 'Select Tags', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => array(
					'h1' => __( 'H1', 'theplus' ),
					'h2' => __( 'H2', 'theplus' ),
					'h3' => __( 'H3', 'theplus' ),
					'h4' => __( 'H4', 'theplus' ),
					'h5' => __( 'H5', 'theplus' ),
					'h6' => __( 'H6', 'theplus' ),
				),
				'default'     => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
				'separator'   => 'before',
				'label_block' => true,
			)
		);
		$this->add_control(
			'ChildToggle',
			array(
				'label'     => esc_html__( 'Child Collapsed', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'showText',
			array(
				'label'     => esc_html__( 'Content', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'contentText',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Table Of Content', 'theplus' ),
				'placeholder' => esc_html__( 'Enter Title', 'theplus' ),
				'label_block' => true,
				'condition'   => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_control(
			'TableDescText',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Description', 'theplus' ),
				'condition'   => array(
					'showText' => 'yes',
				),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'showIcon',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_control(
			'PrefixIcon',
			array(
				'label'     => esc_html__( 'Select Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fa fa-exclamation-circle',
					'library' => 'solid',
				),
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_extra_option_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'ToggleIcon',
			array(
				'label'     => esc_html__( 'Toggle', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'DefaultToggle',
			array(
				'label'     => esc_html__( 'Default On', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'toggle_open_close' );
		$this->start_controls_tab(
			'Ticon_opn',
			array(
				'label'     => esc_html__( 'Open', 'theplus' ),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'openIcon',
			array(
				'label'     => esc_html__( 'Select Open Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-angle-up',
					'library' => 'solid',
				),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Ticon_close',
			array(
				'label'     => esc_html__( 'Close', 'theplus' ),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'closeIcon',
			array(
				'label'     => esc_html__( 'Select Close Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-angle-down',
					'library' => 'solid',
				),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'smoothScroll',
			array(
				'label'     => esc_html__( 'Smooth Scroll', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'smoothDuration',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Smooth Duration', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 420,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'smoothScroll' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scrollOffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Scroll Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'smoothScroll' => 'yes',
				),
			)
		);
		$this->add_control(
			'fixedPosition',
			array(
				'label'     => esc_html__( 'Fixed', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'fixedOffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Fixed Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'fixedPosition' => 'yes',
				),
			)
		);
		$this->add_control(
			'hashtag',
			array(
				'label'     => esc_html__( 'Hash Tag', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'hashtagtext',
			array(
				'label'       => esc_html__( 'Tag', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '#',
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'hashtag' => 'yes',
				),
			)
		);
		$this->add_control(
			'copyText',
			array(
				'label'     => esc_html__( 'Copy Text', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'hashtag' => 'yes',
				),
			)
		);
		$this->add_control(
			'hashtaghover',
			array(
				'label'     => esc_html__( 'Hash Tag On Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'hashtag' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'headingsOffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Heading Active Offset ', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'description' => esc_html__( 'Note : Value to make Heading of TOC active by reaching to It\'s page location.', 'theplus' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'separator'   => 'before',
				'render_type' => 'ui',
			)
		);
		$this->add_control(
			'contentSelector',
			array(
				'label'       => esc_html__( 'Restricted Container Area', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'description' => esc_html__( 'Note : You can add class name of container to restrict TOC rendering. ', 'theplus' ),
				'label_block' => true,
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'excludecontentSelector',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'How to exclude any title?', 'theplus' ),
				'content_classes' => 'tp-widget-description-toc',
				'separator'       => 'before',
			)
		);
		$this->add_control(
			'excludecontentSelector1',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Use class ".tp-toc-ignore" in heading to exclude that heading from TOC.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_heading_textbg_styling',
			array(
				'label'     => esc_html__( 'Heading', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TextMargin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TextPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_control(
			'tct_HeadOPt',
			array(
				'label'     => esc_html__( 'Heading Option ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'TextTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'table_textbg_color' );
		$this->start_controls_tab(
			'Nml_Textbg_color',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Textbg_color',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_control(
			'TextHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tct_DescOPt',
			array(
				'label'     => esc_html__( 'Description Option ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'DescTextTypo',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap .tp-toc-heading .tp-table-desc',
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
			)
		);
		$this->start_controls_tabs( 'table_desctext_color' );
		$this->start_controls_tab(
			'Nml_Desctext_color',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
			)
		);
		$this->add_control(
			'DescTextNormalColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading .tp-table-desc' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Desctext_color',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
			)
		);
		$this->add_control(
			'DescTextHoverColor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'showText'       => 'yes',
					'TableDescText!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading .tp-table-desc' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tct_IcnOPt',
			array(
				'label'     => esc_html__( 'Icon Option ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'IconSize',
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
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-toc-heading .table-prefix-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-toc-heading .table-prefix-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'table_icon_color' );
		$this->start_controls_tab(
			'Nml_Icon_color',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'IconNormalColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-heading .table-prefix-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-toc-heading .table-prefix-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Icon_color',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'IconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'showText' => 'yes',
					'showIcon' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading .table-prefix-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading .table-prefix-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tct_TgIcnOPt',
			array(
				'label'     => esc_html__( 'Toggle Icon Option ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'ToggleIconSize',
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
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'table_toggleicon_color' );
		$this->start_controls_tab(
			'Nml_TglIcon_color',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'ToggleIconNormalColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .table-toggle-wrap .table-toggle-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_TglIcon_color',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->add_control(
			'ToggleIconHoverColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .table-toggle-wrap.tp-toc-wrap:hover .table-toggle-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .table-toggle-wrap.tp-toc-wrap:hover .table-toggle-icon svg' => 'fill: {{VALUE}};',
				),
				'condition' => array(
					'showText'   => 'yes',
					'ToggleIcon' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tct_BgOPt',
			array(
				'label'     => esc_html__( 'Background Option ', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'Nml_hvr_border' );
		$this->start_controls_tab(
			'Nml_Border',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TextBg',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'TextBorder',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TextBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'TextBoxShadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_Border',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'TextBgHover',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'TextBorderHover',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'TextBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'showText' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'TextBoxShadowHover',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-toc-wrap:hover .tp-toc-heading',
				'condition' => array(
					'showText' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_heading_styling',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'leftOffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 20,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .toc-list,
					{{WRAPPER}} .table-style-2 .toc-list li,
					{{WRAPPER}} .table-style-3 .tp-toc .toc-list .toc-list li,
					{{WRAPPER}} .table-style-4 .tp-toc .toc-list .toc-list li' => 'padding-left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'bottomOffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Bottom Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 10,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-table-content .toc-list li,{{WRAPPER}} .tp-table-content .toc-list li.is-active-li a' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list,{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list.is-collapsible' => 'margin-top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list .toc-list-item:last-child,
					{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list.is-collapsible .toc-list-item:last-child' => 'margin-bottom: 0 !important;',
					'{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list .toc-list,{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list.is-collapsible .toc-list,{{WRAPPER}} .tp-toc-wrap .toc-list-item .toc-list.is-collapsible.is-collapsed' => 'margin-top: 0 !important;',
				),
				'condition'   => array(
					'Style' => array( 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_responsive_control(
			'contentPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'outerMargin',
			array(
				'label'      => esc_html__( 'Outer Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'condition'  => array(
					'showText' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'Style4Padding',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Child Padding', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 5,
				),
				'render_type' => 'ui',
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'condition'   => array(
					'Style' => 'style-4',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc > .toc-list > li .toc-list' => 'padding-left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'TableSetMinHeight',
			array(
				'label'     => esc_html__( 'Height', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'TableMinHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Minimum Height', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 5,
				),
				'render_type' => 'ui',
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'condition'   => array(
					'TableSetMinHeight' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'TableMaxHeight',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Maximum Height', 'theplus' ),
				'size_units'  => array( 'px', 'em', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'devices'     => array( 'desktop', 'tablet', 'mobile' ),
				'condition'   => array(
					'TableSetMinHeight' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc' => 'max-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'ScrollBarWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'ScrollBar Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 5,
				),
				'render_type' => 'ui',

				'condition'   => array(
					'TableSetMinHeight' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'ScrollBarThumb',
			array(
				'label'     => esc_html__( 'ScrollBar Thumb Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'TableSetMinHeight' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc::-webkit-scrollbar-thumb' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'ScrollBarTrack',
			array(
				'label'     => esc_html__( 'ScrollBar Track Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'TableSetMinHeight' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-toc-wrap .tp-toc::-webkit-scrollbar-track' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_styling_section',
			array(
				'label'     => esc_html__( 'Content Line', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'Style!'   => 'none',
					'typeList' => array( 'UL', 'OL' ),
				),
			)
		);
		$this->add_responsive_control(
			'LineWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Line Width', 'theplus' ),
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
					'{{WRAPPER}} .table-style-1 .toc-link::before,
					{{WRAPPER}} .table-style-3 .tp-toc > .toc-list .toc-list li:before,
					{{WRAPPER}} .table-style-4 .tp-toc > .toc-list .toc-list li:before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .table-style-2 .toc-list li' => 'border-left-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .table-style-4 .tp-toc > .toc-list .toc-list li.is-active-li:before' => 'left: calc({{SIZE}} / 2 * 1px)',
				),
			)
		);
		$this->add_responsive_control(
			'Line2Width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Active Line Width', 'theplus' ),
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
					'{{WRAPPER}} .table-style-2 .toc-list li.is-active-li' => 'border-left-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .table-style-3 .tp-toc > .toc-list .toc-list li.is-active-li:before,
					{{WRAPPER}} .table-style-4 .tp-toc > .toc-list .toc-list li.is-active-li:before' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'   => array(
					'Style' => array( 'style-2', 'style-3', 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'Nml_Act_color' );
		$this->start_controls_tab(
			'Nml_color',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'LineColor',
			array(
				'label'     => esc_html__( 'Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .table-style-1 .toc-link::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .table-style-2 .toc-list li' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .table-style-3 .tp-toc > .toc-list .toc-list li:before,
					{{WRAPPER}} .table-style-4 .tp-toc > .toc-list .toc-list li:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Act_color',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'LineActiveColor',
			array(
				'label'     => esc_html__( 'Line Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .table-style-1 .toc-link.is-active-link::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .table-style-2 .toc-list li.is-active-li' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .table-style-3 .tp-toc > .toc-list .toc-list li.is-active-li:before,
					{{WRAPPER}} .table-style-4 .tp-toc > .toc-list .toc-list li.is-active-li:before' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_L1section_styling',
			array(
				'label' => esc_html__( 'Level 1 Typography', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'Level1Typo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .tp-toc .toc-list > li > a',
			)
		);
		$this->start_controls_tabs( 'table_L1_color' );
		$this->start_controls_tab(
			'Nml_L1_color',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'Level1NormalColor',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc .toc-list > li > a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Act_L1_color',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'Level1ActiveColor',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc .toc-list > li:hover > a, {{WRAPPER}} .tp-toc > .toc-list > li.is-active-li > a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_sublevel_styling',
			array(
				'label' => esc_html__( 'Sub-Level Typography', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'LevelSubTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .tp-toc .toc-list .toc-list > li > a,
				{{WRAPPER}} .tp-toc .toc-list .toc-listis-collapsible > li > a',
			)
		);
		$this->start_controls_tabs( 'table_sl_color' );
		$this->start_controls_tab(
			'Nml_Sl_color',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'LevelSubNormalColor',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc .toc-list .toc-list > li > a,
				{{WRAPPER}} .tp-toc .toc-list .toc-listis-collapsible > li > a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Act_Sl_color',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'LevelSubActiveColor',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-toc .toc-list .toc-list > li:hover > a, {{WRAPPER}} .tp-toc .toc-list .toc-list > li.is-active-li > a,{{WRAPPER}} .tp-toc .toc-list .toc-listis-collapsible > li:hover > a, {{WRAPPER}} .tp-toc .toc-list .toc-listis-collapsible > li.is-active-li > a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'table_hashtag_styling',
			array(
				'label'     => esc_html__( 'Hash Tag', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'hashtag' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hashTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '.tp-toc-hash-tag',
			)
		);
		$this->start_controls_tabs( 'table_hash' );
		$this->start_controls_tab(
			'hashn',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'hashcolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-toc-hash-tag' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'hashh',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'hashcolorh',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'h1:hover .tp-toc-hash-tag,h2:hover .tp-toc-hash-tag,h3:hover .tp-toc-hash-tag,
					h4:hover .tp-toc-hash-tag,h5:hover .tp-toc-hash-tag,h6:hover .tp-toc-hash-tag' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tct_Hashcopyhead',
			array(
				'label'     => esc_html__( 'Copied Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'HashcopyTypo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '.tp-copy-hash',
			)
		);
		$this->add_control(
			'Hashcopycolor',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp-copy-hash' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'table_content_boxbg_styling',
			array(
				'label' => esc_html__( 'Box', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'boxPadding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'Nml_hvr_Boxborder' );
		$this->start_controls_tab(
			'Nml_BoxBorder',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'Hvr_BoxBorder',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-toc-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-toc-wrap:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Table Content
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$style       = ! empty( $settings['Style'] ) ? $settings['Style'] : 'none';
		$toggle_icon = ! empty( $settings['ToggleIcon'] ) ? $settings['ToggleIcon'] : false;
		$prefix_icon = ! empty( $settings['PrefixIcon'] ) ? $settings['PrefixIcon'] : '';

		$uid_tblcontent  = uniqid( 'tp-tbl' );
		$table_desc_text = ! empty( $settings['TableDescText'] ) ? $settings['TableDescText'] : '';

		$default_toggle['md'] = ! empty( $settings['DefaultToggle'] ) && 'yes' === $settings['DefaultToggle'] ? true : false;
		$default_toggle['sm'] = ! empty( $settings['DefaultToggle_tablet'] ) && 'yes' === $settings['DefaultToggle_tablet'] ? true : false;
		$default_toggle['xs'] = ! empty( $settings['DefaultToggle_mobile'] ) && 'yes' === $settings['DefaultToggle_mobile'] ? true : false;

		$option = array();

		$option['tocSelector']     = '.tp-toc';
		$option['contentSelector'] = ! empty( $settings['contentSelector'] ) ? $settings['contentSelector'] : '.elementor-page';
		$option['headingSelector'] = is_array( $settings['selectorHeading'] ) ? implode( ',', $settings['selectorHeading'] ) : $settings['selectorHeading'];

		if ( ! empty( $settings['hashtag'] ) && 'yes' === $settings['hashtag'] ) {
			$option['hashtagtext'] = ! empty( $settings['hashtagtext'] ) ? $settings['hashtagtext'] : '#';
			$option['copyText']    = ! empty( $settings['copyText'] ) ? 1 : 0;
		}

		$option['isCollapsedClass'] = '';
		if ( ! empty( $settings['ChildToggle'] ) && 'yes' === $settings['ChildToggle'] ) {
			$option['isCollapsedClass'] = 'is-collapsed';
		}

		$option['orderedList']    = ! empty( $settings['typeList'] ) && 'OL' === $settings['typeList'] ? true : false;
		$option['scrollSmooth']   = ! empty( $settings['smoothScroll'] ) ? true : false;
		$option['headingsOffset'] = ! empty( $settings['headingsOffset']['size'] ) ? $settings['headingsOffset']['size'] : 1;

		$option['scrollSmoothOffset']    = ! empty( $settings['scrollOffset']['size'] ) ? (int) $settings['scrollOffset']['size'] : 0;
		$option['scrollSmoothDuration']  = ! empty( $settings['smoothDuration']['size'] ) ? (int) $settings['smoothDuration']['size'] : 420;
		$option['positionFixedSelector'] = null;

		if ( ! empty( $settings['fixedPosition'] ) && 'yes' === $settings['fixedPosition'] ) {
			$option['positionFixedSelector'] = '.tp-table-content';
		}

		$option['fixedSidebarOffset'] = ( ! empty( $settings['fixedPosition'] ) && ! empty( $settings['fixedOffset']['size'] ) ) ? (int) $settings['fixedOffset']['size'] : 'auto';
		$option['hasInnerContainers'] = true;

		$open_icon  = '';
		$close_icon = '';
		if ( ! empty( $settings['openIcon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['openIcon'], array( 'aria-hidden' => 'true' ) );
			$open_icon = ob_get_contents();
			ob_end_clean();
		}

		if ( ! empty( $settings['closeIcon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['closeIcon'], array( 'aria-hidden' => 'true' ) );
			$close_icon = ob_get_contents();
			ob_end_clean();
		}

		$toggle_class = '';
		$toggle_attr  = '';
		if ( 'yes' === $toggle_icon ) {
			$toggle_class = 'table-toggle-wrap';

				$toggle_attr .= ' data-open="' . esc_html( $open_icon ) . '"';
				$toggle_attr .= ' data-close="' . esc_html( $close_icon ) . '"';

			$toggle_attr .= ' data-default-toggle="' . htmlspecialchars( wp_json_encode( $default_toggle ), ENT_QUOTES, 'UTF-8' ) . '"';
		}

		$toggle_active = ' active';
		if ( ! empty( $settings['PrefixIcon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['PrefixIcon'], array( 'aria-hidden' => 'true' ) );
			$prefix_icon = ob_get_contents();
			ob_end_clean();
		}

		$hashtag      = isset( $settings['hashtag'] ) ? $settings['hashtag'] : 'no';
		$hashtaghover = isset( $settings['hashtaghover'] ) ? $settings['hashtaghover'] : 'yes';

		$hashtagclass      = '';
		$hashtaghoverclass = '';
		if ( 'yes' === $hashtag ) {
			$hashtagclass = 'tp-toc-hash-tag';
			if ( 'yes' === $hashtaghover ) {
				$hashtaghoverclass = 'tp-toc-hash-tag-hover';
			}
		}

		$output = '<div class="tp-table-content ' . esc_attr( $hashtagclass ) . ' ' . esc_attr( $hashtaghoverclass ) . ' tp-widget-' . esc_attr( $uid_tblcontent ) . ' table-' . esc_attr( $style ) . '" data-settings="' . htmlspecialchars( wp_json_encode( $option ), ENT_QUOTES, 'UTF-8' ) . '" >';

			$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['boxBg_image'], $settings['boxBgHover_image'] ) : '';

			$output .= '<div class="tp-toc-wrap ' . esc_attr( $toggle_class ) . $toggle_active . ' ' . esc_attr( $lz2 ) . '" ' . $toggle_attr . ' >';

		if ( ( ! empty( $settings['showText'] ) && 'yes' === $settings['showText'] ) && ! empty( $settings['contentText'] ) ) {

			$table_desc = '';
			if ( ! empty( $table_desc_text ) ) {
				$table_desc = '<div class="tp-table-desc">' . wp_kses_post( $table_desc_text ) . '</div>';
			}

			$icon = ( ( ! empty( $settings['showIcon'] ) && 'yes' === $settings['showIcon'] ) && ! empty( $prefix_icon ) ) ? $prefix_icon : '';

			$lz1     = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['TextBg_image'], $settings['TextBgHover_image'] ) : '';
			$output .= '<div class="tp-toc-heading ' . esc_attr( $lz1 ) . '"><span class="table-prefix-icon">' . $icon . '<span>' . wp_kses_post( $settings['contentText'] ) . $table_desc . '</span></span>';

			if ( 'yes' === $toggle_icon ) {
				if ( ( ! empty( $settings['DefaultToggle'] ) && 'yes' === $settings['DefaultToggle'] ) ) {
					$output .= '<span class="table-toggle-icon">' . $open_icon . '</span>';
				} else {
					$output .= '<span class="table-toggle-icon">' . $close_icon . '</span>';
				}
			}
			$output .= '</div>';
		}

				$output .= '<div class="tp-toc toc"></div>';

			$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render content_template
	 *
	 * @since 5.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
