<?php
/*
Widget Name: TP Hover card
Description: Hover Card
Author: Theplus
Author URI: https://posimyth.com
*/

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ThePlus_Hovercard extends Widget_Base {

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
	 * @version 5.6.5
	 */
	public function get_name() {
		return 'tp-hovercard';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_title() {
		return esc_html__( 'Hover Card', 'theplus' );
	}

    /**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.6.52
	 */
	public function get_icon() {
		return 'fa fa-square theplus_backend_icon';
	}

	/**
	 * Get Widget Category.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
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
	 * Get Widget Keywords.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	public function get_keywords() {
		return array( 'Hover card', 'Card hover', 'Card on hover', 'Elementor hover card', 'Elementor card hover', 'Elementor card on hover' );
	}


	/**
	 * Hover Card Render.
	 *
	 * @since 1.0.0
	 * @version 5.6.5
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Hover Card', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->start_controls_tabs( 'tabs_tag_open_close' );

		$repeater->start_controls_tab(
			'tab_open_tag',
			array(
				'label' => esc_html__( 'Open', 'theplus' ),
			)
		);
		$repeater->add_control(
			'open_tag',
			array(
				'label'   => esc_html__( 'Open Tag', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'div',
				'options' => array(
					'div'  => esc_html__( 'Div', 'theplus' ),
					'span' => esc_html__( 'Span', 'theplus' ),
					'h1'   => esc_html__( 'H1', 'theplus' ),
					'h2'   => esc_html__( 'H2', 'theplus' ),
					'h3'   => esc_html__( 'H3', 'theplus' ),
					'h4'   => esc_html__( 'H4', 'theplus' ),
					'h5'   => esc_html__( 'H5', 'theplus' ),
					'h6'   => esc_html__( 'H6', 'theplus' ),
					'h6'   => esc_html__( 'H6', 'theplus' ),
					'p'    => esc_html__( 'p', 'theplus' ),
					'a'    => esc_html__( 'a', 'theplus' ),
					'none' => esc_html__( 'None', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'a_link',
			array(
				'label'       => esc_html__( 'Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'after',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'open_tag' => 'a',
				),
			)
		);
		$repeater->add_control(
			'open_tag_class',
			array(
				'label'     => esc_html__( 'Enter Class', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_close_tag',
			array(
				'label' => esc_html__( 'Close', 'theplus' ),
			)
		);
		$repeater->add_control(
			'close_tag',
			array(
				'label'   => esc_html__( 'Close Tag', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'close',
				'options' => array(
					'close' => esc_html__( 'Default', 'theplus' ),
					'div'   => esc_html__( 'Div', 'theplus' ),
					'span'  => esc_html__( 'Span', 'theplus' ),
					'h1'    => esc_html__( 'H1', 'theplus' ),
					'h2'    => esc_html__( 'H2', 'theplus' ),
					'h3'    => esc_html__( 'H3', 'theplus' ),
					'h4'    => esc_html__( 'H4', 'theplus' ),
					'h5'    => esc_html__( 'H5', 'theplus' ),
					'h6'    => esc_html__( 'H6', 'theplus' ),
					'h6'    => esc_html__( 'H6', 'theplus' ),
					'p'     => esc_html__( 'p', 'theplus' ),
					'a'     => esc_html__( 'a', 'theplus' ),
					'none'  => esc_html__( 'None', 'theplus' ),
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'content_tag',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Content', 'theplus' ),
				'default'   => 'none',
				'options'   => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'text'   => esc_html__( 'Text', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'html'   => esc_html__( 'HTML', 'theplus' ),
					'style'  => esc_html__( 'Style', 'theplus' ),
					'script' => esc_html__( 'Script', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'text_content',
			array(
				'label'     => wp_kses_post( "Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-text-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'The Plus', 'theplus' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'content_tag_image_opt',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Image As', 'theplus' ),
				'default'   => 'default',
				'options'   => array(
					'default'    => esc_html__( 'Default', 'theplus' ),
					'background' => esc_html__( 'Background', 'theplus' ),
				),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'media_content',
			array(
				'type'      => Controls_Manager::MEDIA,
				'label'     => wp_kses_post( "Media <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-image-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'html_content',
			array(
				'label'     => wp_kses_post( "HTML Content <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-html-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'I am text block. Click edit button to change this text.', 'tptheplusebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'content_tag' => 'html',
				),
			)
		);
		$repeater->add_control(
			'style_content',
			array(
				'label'     => wp_kses_post( "Custom Style <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-style-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array( 'active' => true ),
				'default'   => '',
				'condition' => array(
					'content_tag' => 'style',
				),
			)
		);
		$repeater->add_control(
			'script_content',
			array(
				'label'     => wp_kses_post( "Custom Script <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "use-script-content-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array( 'active' => true ),
				'default'   => '',
				'condition' => array(
					'content_tag' => 'script',
				),
			)
		);
		$repeater->add_control(
			'style_heading',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'default'   => 'relative',
				'options'   => array(
					'relative' => esc_html__( 'Relative', 'theplus' ),
					'absolute' => esc_html__( 'Absolute', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'position: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'display',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Display', 'theplus' ),
				'default'   => 'initial',
				'options'   => array(
					'block'        => esc_html__( 'Block', 'theplus' ),
					'inline-block' => esc_html__( 'Inline Block', 'theplus' ),
					'flex'         => esc_html__( 'Flex', 'theplus' ),
					'inline-flex'  => esc_html__( 'Inline Flex', 'theplus' ),
					'initial'      => esc_html__( 'Initial', 'theplus' ),
					'inherit'      => esc_html__( 'Inherit', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'display: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'flex_direction',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Flex Direction', 'theplus' ),
				'default'   => 'unset',
				'options'   => array(
					'column'         => esc_html__( 'column', 'theplus' ),
					'column-reverse' => esc_html__( 'column-reverse', 'theplus' ),
					'row'            => esc_html__( 'row', 'theplus' ),
					'unset'          => esc_html__( 'unset', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'flex-direction: {{VALUE}}',
				),
				'condition' => array(
					'open_tag!' => 'none',
					'display'   => array( 'flex', 'inline-flex' ),
				),
			)
		);
		$repeater->add_control(
			'display_alignmet_opt',
			array(
				'label'     => esc_html__( 'Alignment CSS Options', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Text Align', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'center' => esc_html__( 'Center', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'text-align:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'align_items',
			array(
				'label'     => esc_html__( 'Align Items', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'flex-start' => esc_html__( 'Flex Start', 'theplus' ),
					'center'     => esc_html__( 'Center', 'theplus' ),
					'flex-end'   => esc_html__( 'Flex End', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'align-items:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'justify_content',
			array(
				'label'     => esc_html__( 'Justify Content', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => array(
					'flex-start'    => esc_html__( 'Flex Start', 'theplus' ),
					'center'        => esc_html__( 'Center', 'theplus' ),
					'flex-end'      => esc_html__( 'Flex End', 'theplus' ),
					'space-around'  => esc_html__( 'Space Around', 'theplus' ),
					'space-between' => esc_html__( 'Space Between', 'theplus' ),
					'space-evenly'  => esc_html__( 'Space Evenly', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'justify-content:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'vertical_align',
			array(
				'label'     => esc_html__( 'Vertical Align', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'middle',
				'options'   => array(
					'top'    => esc_html__( 'Top', 'theplus' ),
					'middle' => esc_html__( 'Middle', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'vertical-align:{{VALUE}};',
				),
				'condition' => array(
					'open_tag!'            => 'none',
					'display'              => array( 'flex', 'inline-flex' ),
					'display_alignmet_opt' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'top_offset_switch',
			array(
				'label'     => esc_html__( 'Top (Auto / PX)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX/%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'top_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top Offset', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'         => 'none',
					'position'          => 'absolute',
					'top_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'bottom_offset_switch',
			array(
				'label'     => esc_html__( 'Bottom (Auto / PX)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX/%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'bottom_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Bottom Offset', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'            => 'none',
					'position'             => 'absolute',
					'bottom_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'left_offset_switch',
			array(
				'label'     => esc_html__( 'Left (Auto / PX)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX/%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'left_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left Offset', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'          => 'none',
					'position'           => 'absolute',
					'left_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'right_offset_switch',
			array(
				'label'     => esc_html__( 'Right (Auto / PX)', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'PX/%', 'theplus' ),
				'label_off' => esc_html__( 'Auto', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
					'position'  => 'absolute',
				),
			)
		);
		$repeater->add_control(
			'right_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right Offset', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'open_tag!'           => 'none',
					'position'            => 'absolute',
					'right_offset_switch' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'width_height',
			array(
				'label'     => esc_html__( 'Width/Height Options', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_responsive_control(
			'width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'min_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Width', 'theplus' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'min-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'min_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Min. Height', 'theplus' ),
				'size_units'  => array( 'px', '%', 'vh' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 700,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'min-height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'open_tag!'    => 'none',
					'width_height' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'z_index',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Z-Index', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'z-index: {{SIZE}};',
				),
				'condition'   => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'visible',
				'options'   => array(
					'hidden'  => esc_html__( 'Hidden', 'theplus' ),
					'visible' => esc_html__( 'Visible', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'overflow:{{VALUE}} !important;',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'visibility',
			array(
				'label'     => esc_html__( 'Visibility', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'unset',
				'options'   => array(
					'unset'   => esc_html__( 'Unset', 'theplus' ),
					'hidden'  => esc_html__( 'Hidden', 'theplus' ),
					'visible' => esc_html__( 'Visible', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'visibility:{{VALUE}} !important;',
				),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'bg_opt_heading',
			array(
				'label'     => esc_html__( 'Background Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->add_control(
			'bg_opt',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'open_tag!' => 'none',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_background_options' );
			$repeater->start_controls_tab(
				'bg_opt_normal',
				array(
					'label'     => esc_html__( 'Normal', 'theplus' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'bg_opt_bg',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'      => 'bg_opt_border',
					'label'     => esc_html__( 'Border', 'theplus' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'bg_opt_br',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'bg_opt_shadow',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'transition',
				array(
					'label'       => esc_html__( 'Transition css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'theplus' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transition: {{VALUE}};-moz-transition: {{VALUE}};-o-transition: {{VALUE}};-ms-transition: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform',
				array(
					'label'       => esc_html__( 'Transform css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'theplus' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Css_Filter::get_type(),
				array(
					'name'      => 'css_filters',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'opacity',
				array(
					'label'     => esc_html__( 'Opacity', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->end_controls_tab();
			$repeater->start_controls_tab(
				'bg_opt_hover',
				array(
					'label'     => esc_html__( 'Hover', 'theplus' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'cst_hover',
				array(
					'label'     => wp_kses_post( "Custom Hover <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-hover-effect-with-custom-hover-class-in-elementor-hover-card/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'label_on'  => esc_html__( 'Enable', 'theplus' ),
					'label_off' => esc_html__( 'Disable', 'theplus' ),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
					),
				)
			);
			$repeater->add_control(
				'cst_hover_class',
				array(
					'label'       => esc_html__( 'Enter Class', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => '',
					'dynamic'     => array( 'active' => true ),
					'label_block' => true,
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'      => 'bg_opt_bg_hover',
					'types'     => array( 'classic', 'gradient' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'      => 'bg_opt_border_hover',
					'label'     => esc_html__( 'Border', 'theplus' ),
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'bg_opt_br_hover',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'bg_opt_shadow_hover',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'transition_hover',
				array(
					'label'       => esc_html__( 'Transition css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'theplus' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => '-webkit-transition: {{VALUE}};-moz-transition: {{VALUE}};-o-transition: {{VALUE}};-ms-transition: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform_hover',
				array(
					'label'       => esc_html__( 'Transform css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'theplus' ),
					'selectors'   => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};',
					),
					'condition'   => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_group_control(
				Group_Control_Css_Filter::get_type(),
				array(
					'name'      => 'css_filters_hover',
					'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'opacity_hover',
				array(
					'label'     => esc_html__( 'Opacity', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
					),
					'condition' => array(
						'open_tag!'  => 'none',
						'bg_opt'     => 'yes',
						'cst_hover!' => 'yes',
					),
				)
			);
			/*hover custom background start*/
			$repeater->add_control(
				'b_color_option',
				array(
					'label'       => esc_html__( 'Background', 'theplus' ),
					'type'        => Controls_Manager::CHOOSE,
					'options'     => array(
						'solid'    => array(
							'title' => esc_html__( 'Classic', 'theplus' ),
							'icon'  => 'eicon-paint-brush',
						),
						'gradient' => array(
							'title' => esc_html__( 'Gradient', 'theplus' ),
							'icon'  => 'eicon-barcode',
						),
						'image'    => array(
							'title' => esc_html__( 'Image', 'theplus' ),
							'icon'  => 'eicon-slideshow',
						),
					),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
					'label_block' => false,
					'default'     => 'solid',
				)
			);
			$repeater->add_control(
				'b_color_solid',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'solid',
					),
				)
			);
			$repeater->add_control(
				'b_gradient_color1',
				array(
					'label'     => esc_html__( 'Color 1', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'orange',
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color1_control',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Color 1 Location', 'theplus' ),
					'size_units'  => array( '%' ),
					'default'     => array(
						'unit' => '%',
						'size' => 0,
					),
					'render_type' => 'ui',
					'condition'   => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'     => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color2',
				array(
					'label'     => esc_html__( 'Color 2', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'cyan',
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_color2_control',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Color 2 Location', 'theplus' ),
					'size_units'  => array( '%' ),
					'default'     => array(
						'unit' => '%',
						'size' => 100,
					),
					'render_type' => 'ui',
					'condition'   => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'     => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_style',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Gradient Style', 'theplus' ),
					'default'   => 'linear',
					'options'   => theplus_get_gradient_styles(),
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'gradient',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_angle',
				array(
					'type'       => Controls_Manager::SLIDER,
					'label'      => esc_html__( 'Gradient Angle', 'theplus' ),
					'size_units' => array( 'deg' ),
					'default'    => array(
						'unit' => 'deg',
						'size' => 180,
					),
					'range'      => array(
						'deg' => array(
							'step' => 10,
						),
					),
					'condition'  => array(
						'open_tag!'        => 'none',
						'bg_opt'           => 'yes',
						'cst_hover'        => 'yes',
						'b_color_option'   => 'gradient',
						'b_gradient_style' => array( 'linear' ),
					),
					'of_type'    => 'gradient',
				)
			);
			$repeater->add_control(
				'b_gradient_position',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Position', 'theplus' ),
					'options'   => theplus_get_position_options(),
					'default'   => 'center center',
					'condition' => array(
						'open_tag!'        => 'none',
						'bg_opt'           => 'yes',
						'cst_hover'        => 'yes',
						'b_color_option'   => 'gradient',
						'b_gradient_style' => 'radial',
					),
					'of_type'   => 'gradient',
				)
			);
			$repeater->add_control(
				'b_h_image',
				array(
					'type'      => Controls_Manager::MEDIA,
					'label'     => esc_html__( 'Background Image', 'theplus' ),
					'dynamic'   => array( 'active' => true ),
					'condition' => array(
						'open_tag!'      => 'none',
						'bg_opt'         => 'yes',
						'cst_hover'      => 'yes',
						'b_color_option' => 'image',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_position',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Image Position', 'theplus' ),
					'default'   => 'center center',
					'options'   => array(
						''              => esc_html__( 'Default', 'theplus' ),
						'top left'      => esc_html__( 'Top Left', 'theplus' ),
						'top center'    => esc_html__( 'Top Center', 'theplus' ),
						'top right'     => esc_html__( 'Top Right', 'theplus' ),
						'center left'   => esc_html__( 'Center Left', 'theplus' ),
						'center center' => esc_html__( 'Center Center', 'theplus' ),
						'center right'  => esc_html__( 'Center Right', 'theplus' ),
						'bottom left'   => esc_html__( 'Bottom Left', 'theplus' ),
						'bottom center' => esc_html__( 'Bottom Center', 'theplus' ),
						'bottom right'  => esc_html__( 'Bottom Right', 'theplus' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_attach',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Attachment', 'theplus' ),
					'default'   => 'scroll',
					'options'   => array(
						''       => esc_html__( 'Default', 'theplus' ),
						'scroll' => esc_html__( 'Scroll', 'theplus' ),
						'fixed'  => esc_html__( 'Fixed', 'theplus' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_repeat',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Repeat', 'theplus' ),
					'default'   => 'repeat',
					'options'   => array(
						''          => esc_html__( 'Default', 'theplus' ),
						'no-repeat' => esc_html__( 'No-repeat', 'theplus' ),
						'repeat'    => esc_html__( 'Repeat', 'theplus' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'theplus' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'theplus' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_image_size',
				array(
					'type'      => Controls_Manager::SELECT,
					'label'     => esc_html__( 'Background Size', 'theplus' ),
					'default'   => 'cover',
					'options'   => array(
						''        => esc_html__( 'Default', 'theplus' ),
						'auto'    => esc_html__( 'Auto', 'theplus' ),
						'cover'   => esc_html__( 'Cover', 'theplus' ),
						'contain' => esc_html__( 'Contain', 'theplus' ),
					),
					'condition' => array(
						'open_tag!'       => 'none',
						'bg_opt'          => 'yes',
						'cst_hover'       => 'yes',
						'b_color_option'  => 'image',
						'b_h_image[url]!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_border_style',
				array(
					'label'     => esc_html__( 'Border Style', 'theplus' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => array(
						''       => esc_html__( 'None', 'theplus' ),
						'solid'  => esc_html__( 'Solid', 'theplus' ),
						'dashed' => esc_html__( 'Dashed', 'theplus' ),
						'dotted' => esc_html__( 'Dotted', 'theplus' ),
						'groove' => esc_html__( 'Groove', 'theplus' ),
						'inset'  => esc_html__( 'Inset', 'theplus' ),
						'outset' => esc_html__( 'Outset', 'theplus' ),
						'ridge'  => esc_html__( 'Ridge', 'theplus' ),
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_responsive_control(
				'b_h_border_width',
				array(
					'label'      => esc_html__( 'Border Width', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'condition'  => array(
						'open_tag!'         => 'none',
						'bg_opt'            => 'yes',
						'cst_hover'         => 'yes',
						'b_h_border_style!' => '',
					),
				)
			);
			$repeater->add_control(
				'b_h_border_color',
				array(
					'label'     => esc_html__( 'Border Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'open_tag!'         => 'none',
						'bg_opt'            => 'yes',
						'cst_hover'         => 'yes',
						'b_h_border_style!' => '',
					),
				)
			);
			$repeater->add_responsive_control(
				'b_h_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'condition'  => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_hover_cst',
				array(
					'label'        => esc_html__( 'Box Shadow', 'theplus' ),
					'type'         => Controls_Manager::POPOVER_TOGGLE,
					'label_off'    => __( 'Default', 'theplus' ),
					'label_on'     => __( 'Custom', 'theplus' ),
					'return_value' => 'yes',
					'condition'    => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->start_popover();
			$repeater->add_control(
				'box_shadow_color',
				array(
					'label'     => esc_html__( 'Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'rgba(0,0,0,0.5)',
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_horizontal',
				array(
					'label'      => esc_html__( 'Horizontal', 'theplus' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_vertical',
				array(
					'label'      => esc_html__( 'Vertical', 'theplus' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_blur',
				array(
					'label'      => esc_html__( 'Blur', 'theplus' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => 0,
							'min'  => 100,
							'step' => 1,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 10,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'box_shadow_spread',
				array(
					'label'      => esc_html__( 'Spread', 'theplus' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'max'  => -100,
							'min'  => 100,
							'step' => 2,
						),
					),
					'default'    => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition'  => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'box_shadow_hover_cst' => 'yes',
					),
				)
			);
			$repeater->end_popover();

			$repeater->add_control(
				'transition_hover_cst',
				array(
					'label'       => esc_html__( 'Transition css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'all .3s linear', 'theplus' ),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
					'separator'   => 'before',
				)
			);
			$repeater->add_control(
				'transform_hover_cst',
				array(
					'label'       => esc_html__( 'Transform css', 'theplus' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'rotate(10deg) scale(1.1)', 'theplus' ),
					'condition'   => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);

			$repeater->add_control(
				'css_filter_hover_cst',
				array(
					'label'        => esc_html__( 'CSS Filter', 'theplus' ),
					'type'         => Controls_Manager::POPOVER_TOGGLE,
					'label_off'    => __( 'Default', 'theplus' ),
					'label_on'     => __( 'Custom', 'theplus' ),
					'return_value' => 'yes',
					'condition'    => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			$repeater->start_popover();
			$repeater->add_control(
				'css_filter_blur',
				array(
					'label'     => esc_html__( 'Blur', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 10,
							'min'  => 0,
							'step' => 0.1,
						),
					),
					'default'   => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_brightness',
				array(
					'label'     => esc_html__( 'Brightness', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_contrast',
				array(
					'label'     => esc_html__( 'Contrast', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_saturation',
				array(
					'label'     => esc_html__( 'Saturation', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 200,
							'min'  => 0,
							'step' => 2,
						),
					),
					'default'   => array(
						'unit' => '%',
						'size' => 100,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->add_control(
				'css_filter_hue',
				array(
					'label'     => esc_html__( 'Hue', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 360,
							'min'  => 0,
							'step' => 5,
						),
					),
					'default'   => array(
						'unit' => 'px',
						'size' => 0,
					),
					'condition' => array(
						'open_tag!'            => 'none',
						'bg_opt'               => 'yes',
						'cst_hover'            => 'yes',
						'css_filter_hover_cst' => 'yes',
					),
				)
			);
			$repeater->end_popover();

			$repeater->add_control(
				'opacity_hover_cst',
				array(
					'label'     => esc_html__( 'Opacity', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max'  => 1,
							'min'  => 0,
							'step' => 0.01,
						),
					),
					'condition' => array(
						'open_tag!' => 'none',
						'bg_opt'    => 'yes',
						'cst_hover' => 'yes',
					),
				)
			);
			/*hover custom background end*/
			$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'text_heading',
			array(
				'label'     => esc_html__( 'Text Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typography',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_text_style' );
		$repeater->start_controls_tab(
			'tab_text_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow',
				'label'     => esc_html__( 'Text Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_text_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'cst_text_hover',
			array(
				'label'     => esc_html__( 'Custom Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'content_tag' => 'text',
				),
			)
		);
		$repeater->add_control(
			'text_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'content_tag'     => 'text',
					'cst_text_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow_h',
				'label'     => esc_html__( 'Text Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'     => 'text',
					'cst_text_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'cst_text_hover_class',
			array(
				'label'       => esc_html__( 'Enter Class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'text_color_h_cst',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'text_shadow_hover_cst',
			array(
				'label'        => esc_html__( 'Text Shadow', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'    => 'text',
					'cst_text_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'ts_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_horizontal',
			array(
				'label'      => esc_html__( 'Horizontal', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_vertical',
			array(
				'label'      => esc_html__( 'Vertical', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'ts_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 0,
						'min'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'content_tag'           => 'text',
					'cst_text_hover'        => 'yes',
					'text_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$repeater->add_control(
			'image_heading',
			array(
				'label'     => esc_html__( 'Image Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'image_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'content_tag' => 'image',
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->add_control(
			'image_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max. Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'content_tag' => 'image',
				),
				'selectors'   => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater->start_controls_tabs( 'tabs_image' );
		$repeater->start_controls_tab(
			'tab_image',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_shadow',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'image_opacity',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'image_css_filters',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'cst_image_hover',
			array(
				'label'     => esc_html__( 'Custom Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'content_tag' => 'image',
				),
			)
		);
		$repeater->add_control(
			'cst_image_hover_class',
			array(
				'label'       => esc_html__( 'Enter Class', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'condition'   => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border_h',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_shadow_h',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_opacity_h',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
				),
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'      => 'image_css_filters_h',
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
				'condition' => array(
					'content_tag'      => 'image',
					'cst_image_hover!' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_h_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => array(
					''       => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
					'inset'  => esc_html__( 'Inset', 'theplus' ),
					'outset' => esc_html__( 'Outset', 'theplus' ),
					'ridge'  => esc_html__( 'Ridge', 'theplus' ),
				),
				'condition' => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_h_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'content_tag'           => 'image',
					'cst_image_hover'       => 'yes',
					'image_h_border_style!' => '',
				),
			)
		);
		$repeater->add_control(
			'image_h_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'content_tag'           => 'image',
					'cst_image_hover'       => 'yes',
					'image_h_border_style!' => '',
				),
			)
		);
		$repeater->add_responsive_control(
			'image_h_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_hover_cst',
			array(
				'label'        => esc_html__( 'Box Shadow', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'image_box_shadow_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_horizontal',
			array(
				'label'      => esc_html__( 'Horizontal', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_vertical',
			array(
				'label'      => esc_html__( 'Vertical', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 0,
						'min'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_box_shadow_spread',
			array(
				'label'      => esc_html__( 'Spread', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => -100,
						'min'  => 100,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition'  => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_box_shadow_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->add_control(
			'image_opacity_hover_cst',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					),
				),
				'condition' => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_hover_cst',
			array(
				'label'        => esc_html__( 'CSS Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
				'condition'    => array(
					'content_tag'     => 'image',
					'cst_image_hover' => 'yes',
				),
			)
		);
		$repeater->start_popover();
		$repeater->add_control(
			'image_css_filter_blur',
			array(
				'label'     => esc_html__( 'Blur', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 10,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_brightness',
			array(
				'label'     => esc_html__( 'Brightness', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_contrast',
			array(
				'label'     => esc_html__( 'Contrast', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_saturation',
			array(
				'label'     => esc_html__( 'Saturation', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 200,
						'min'  => 0,
						'step' => 2,
					),
				),
				'default'   => array(
					'unit' => '%',
					'size' => 100,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'image_css_filter_hue',
			array(
				'label'     => esc_html__( 'Hue', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 360,
						'min'  => 0,
						'step' => 5,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'content_tag'                => 'image',
					'cst_image_hover'            => 'yes',
					'image_css_filter_hover_cst' => 'yes',
				),
			)
		);
		$repeater->end_popover();
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->add_control(
			'how_it_works',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-custom-layout-with-hover-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->add_control(
			'hover_card_content',
			array(
				'label'       => esc_html__( 'Content [ Start Tag -- End Tag ]', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{content_tag}} [ {{open_tag }} -- {{close_tag}} ]',
			)
		);
		$this->end_controls_section();
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}
	private $post_id;
	protected function render() {
		$settings = $this->get_settings_for_display();

		$loopitem       = $loopcss = '';
			$i          = 1;
			$hover_card = '<div class="tp-hover-card-wrapper">';

		foreach ( $settings['hover_card_content'] as $item ) {

			$open_tag = '';
			if ( ! empty( $item['open_tag'] ) && $item['open_tag'] != 'none' ) {
				$open_tag = theplus_validate_html_tag( $item['open_tag'] );

				$this->add_render_attribute( 'loop_attr' . $i, 'class', 'elementor-repeater-item-' . $item['_id'] );
			}

			$class = '';

			if ( ! empty( $item['open_tag_class'] ) ) {
				$this->add_render_attribute( 'loop_attr' . $i, 'class', $item['open_tag_class'] );
			}
			if ( $item['content_tag'] == 'image' && ! empty( $item['media_content']['url'] ) ) {
				$img_bg_cls = '';
				if ( ! empty( $item['content_tag_image_opt'] ) && $item['content_tag_image_opt'] == 'background' ) {
					$img_bg_cls = ' image-tag-hide';
				}
				$this->add_render_attribute( 'loop_attr_img' . $i, 'class', 'elementor-repeater-item-' . $item['_id'] . '.loop-inner' . $img_bg_cls );
			}

			$close_tag = '';

			if ( ! empty( $item['close_tag'] ) && $item['close_tag'] == 'close' ) {
				$close_tag = theplus_validate_html_tag( $open_tag );
			} elseif ( ! empty( $item['close_tag'] ) && $item['close_tag'] != 'close' && $item['close_tag'] != 'none' ) {
				$close_tag = theplus_validate_html_tag( $item['close_tag'] );
			}

			/*a link*/
			if ( ! empty( $item['open_tag'] ) && $item['open_tag'] == 'a' ) {
				if ( ! empty( $item['a_link']['url'] ) ) {
					$this->add_render_attribute( 'loop_attr' . $i, 'href', esc_url( $item['a_link']['url'] ) );
					if ( $item['a_link']['is_external'] ) {
						$this->add_render_attribute( 'loop_attr' . $i, 'target', '_blank' );
					}
					if ( $item['a_link']['nofollow'] ) {
						$this->add_render_attribute( 'loop_attr' . $i, 'rel', 'nofollow' );
					}
				}
			}

			/*Open Tag start*/
			if ( ! empty( $open_tag ) ) {
				$loopitem .= '<' . theplus_validate_html_tag( $open_tag ) . ' ' . $this->get_render_attribute_string( 'loop_attr' . $i ) . '>';
			}
			/*Open Tag end*/

			/*content start*/
			if ( ! empty( $item['content_tag'] ) && $item['content_tag'] != 'none' ) {
				if ( $item['content_tag'] == 'text' && ! empty( $item['text_content'] ) ) {
					$loopitem .= wp_kses_post( $item['text_content'] );
				}

				if ( $item['content_tag'] == 'image' && ! empty( $item['media_content']['url'] ) ) {
					if ( ! empty( $item['content_tag_image_opt'] ) && $item['content_tag_image_opt'] == 'background' ) {
						$loopitem .= '<div class="tp-image-as-background" style="background-image:url(' . esc_url( $item['media_content']['url'] ) . ')"></div>';
					} else {
						$loopitem .= '<img ' . $this->get_render_attribute_string( 'loop_attr_img' . $i ) . ' src="' . esc_url( $item['media_content']['url'] ) . '" />';
					}
				}

				if ( $item['content_tag'] == 'html' && ! empty( $item['html_content'] ) ) {
					$loopitem .= wp_kses_post( $item['html_content'] );
				}
				if ( $item['content_tag'] == 'style' && ! empty( $item['style_content'] ) ) {
					$loopitem .= '<style>' . esc_attr( $item['style_content'] ) . '</style>';
				}
				if ( $item['content_tag'] == 'script' && ! empty( $item['script_content'] ) ) {
					$loopitem .= wp_print_inline_script_tag( $item['script_content'] );
				}
			}

			/*content start*/

			/*Close Tag start*/
			if ( ! empty( $item['close_tag'] ) && $item['close_tag'] != 'none' ) {
				$loopitem .= '</' . theplus_validate_html_tag( $close_tag ) . '>';
			}
			/*Close Tag end*/

			/*style for absolute start*/
			if ( ! empty( $item['position'] ) && $item['position'] == 'absolute' ) {

				$tov = $bov = $lov = $rov = 'auto';
				if ( ! empty( $item['top_offset_switch'] ) && $item['top_offset_switch'] == 'yes' ) {
					if ( ! empty( $item['top_offset']['size'] ) ) {
						$tov = $item['top_offset']['size'] . $item['top_offset']['unit'];
					} else {
						$tov = 0;
					}
				}
				if ( ! empty( $item['bottom_offset_switch'] ) && $item['bottom_offset_switch'] == 'yes' ) {
					if ( ! empty( $item['bottom_offset']['size'] ) ) {
						$bov = $item['bottom_offset']['size'] . $item['bottom_offset']['unit'];
					} else {
						$bov = 0;
					}
				}
				if ( ! empty( $item['left_offset_switch'] ) && $item['left_offset_switch'] == 'yes' ) {
					if ( ! empty( $item['left_offset']['size'] ) ) {
						$lov = $item['left_offset']['size'] . $item['left_offset']['unit'];
					} else {
						$lov = 0;
					}
				}
				if ( ! empty( $item['right_offset_switch'] ) && $item['right_offset_switch'] == 'yes' ) {
					if ( ! empty( $item['right_offset']['size'] ) ) {
						$rov = $item['right_offset']['size'] . $item['right_offset']['unit'];
					} else {
						$rov = 0;
					}
				}

				$loopcss .= '.elementor-element' . $this->get_unique_selector() . '  .elementor-repeater-item-' . esc_attr( $item['_id'] ) . '{top: ' . esc_attr( $tov ) . ';bottom: ' . esc_attr( $bov ) . ';left: ' . esc_attr( $lov ) . ';right: ' . esc_attr( $rov ) . ';}';
			}
			/*style for absolute end*/

			/*style tag for hover start*/
			$get_ele_pre = '';
			if ( ( ! empty( $item['cst_hover'] ) && $item['cst_hover'] == 'yes' ) || ( ! empty( $item['cst_text_hover'] ) && $item['cst_text_hover'] == 'yes' ) || ( ! empty( $item['cst_image_hover'] ) && $item['cst_image_hover'] == 'yes' ) ) {

				$get_ele_pre = '.elementor-element' . $this->get_unique_selector() . ' ' . esc_attr( $item['cst_hover_class'] ) . ':hover .elementor-repeater-item-' . esc_attr( $item['_id'] );

				if ( ! empty( $item['cst_hover_class'] ) ) {
					if ( ! empty( $item['b_color_option'] ) && $item['b_color_option'] == 'solid' ) {
						if ( ! empty( $item['b_color_solid'] ) ) {
							$loopcss .= esc_attr( $get_ele_pre ) . '{background-color:' . esc_attr( $item['b_color_solid'] ) . ' !important;}';
						}
					} elseif ( ! empty( $item['b_color_option'] ) && $item['b_color_option'] == 'gradient' ) {
						if ( ! empty( $item['b_gradient_style'] ) && $item['b_gradient_style'] == 'linear' ) {
							if ( ! empty( $item['b_gradient_color1'] ) && ! empty( $item['b_gradient_color2'] ) ) {
								$loopcss .= esc_attr( $get_ele_pre ) . '{background-image: linear-gradient(' . esc_attr( $item['b_gradient_angle']['size'] ) . esc_attr( $item['b_gradient_angle']['unit'] ) . ', ' . esc_attr( $item['b_gradient_color1'] ) . ' ' . esc_attr( $item['b_gradient_color1_control']['size'] ) . esc_attr( $item['b_gradient_color1_control']['unit'] ) . ', ' . esc_attr( $item['b_gradient_color2'] ) . ' ' . esc_attr( $item['b_gradient_color2_control']['size'] ) . esc_attr( $item['b_gradient_color2_control']['unit'] ) . ') !important}';
							}
						} elseif ( ! empty( $item['b_gradient_style'] ) && $item['b_gradient_style'] == 'radial' ) {
							if ( ! empty( $item['b_gradient_color1'] ) && ! empty( $item['b_gradient_color2'] ) ) {
								$loopcss .= esc_attr( $get_ele_pre ) . '{background-image: radial-gradient(at ' . esc_attr( $item['b_gradient_position'] ) . ', ' . esc_attr( $item['b_gradient_color1'] ) . ' ' . esc_attr( $item['b_gradient_color1_control']['size'] ) . esc_attr( $item['b_gradient_color1_control']['unit'] ) . ', ' . esc_attr( $item['b_gradient_color2'] ) . ' ' . esc_attr( $item['b_gradient_color2_control']['size'] ) . esc_attr( $item['b_gradient_color2_control']['unit'] ) . ') !important}';
							}
						}
					} elseif ( ! empty( $item['b_color_option'] ) && $item['b_color_option'] == 'image' ) {
						if ( ! empty( $item['b_h_image']['url'] ) ) {
							$loopcss .= esc_attr( $get_ele_pre ) . '{background-image:url(' . esc_url( $item['b_h_image']['url'] ) . ') !important;background-position:' . esc_attr( $item['b_h_image_position'] ) . ' !important;background-attachment:' . esc_attr( $item['b_h_image_attach'] ) . ' !important;background-repeat:' . esc_attr( $item['b_h_image_repeat'] ) . ' !important;background-size:' . esc_attr( $item['b_h_image_size'] ) . ' !important;}';
						}
					}

					if ( ! empty( $item['b_h_border_style'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{border-style:' . esc_attr( $item['b_h_border_style'] ) . ' !important;border-width: ' . esc_attr( $item['b_h_border_width']['top'] ) . esc_attr( $item['b_h_border_width']['unit'] ) . ' ' . esc_attr( $item['b_h_border_width']['right'] ) . esc_attr( $item['b_h_border_width']['unit'] ) . ' ' . esc_attr( $item['b_h_border_width']['bottom'] ) . esc_attr( $item['b_h_border_width']['unit'] ) . ' ' . esc_attr( $item['b_h_border_width']['left'] ) . esc_attr( $item['b_h_border_width']['unit'] ) . ' !important;border-color:' . esc_attr( $item['b_h_border_color'] ) . ' !important;}';
					}

					if ( ! empty( $item['b_h_border_radius'] ) ) {
						if ( ! empty( $item['b_h_border_radius']['top'] ) || ! empty( $item['b_h_border_radius']['right'] ) || ! empty( $item['b_h_border_radius']['bottom'] ) || ! empty( $item['b_h_border_radius']['left'] ) ) {
							$loopcss .= esc_attr( $get_ele_pre ) . '{border-radius: ' . esc_attr( $item['b_h_border_radius']['top'] ) . esc_attr( $item['b_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['b_h_border_radius']['right'] ) . esc_attr( $item['b_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['b_h_border_radius']['bottom'] ) . esc_attr( $item['b_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['b_h_border_radius']['left'] ) . esc_attr( $item['b_h_border_radius']['unit'] ) . ' !important;}';
						}
					}

					if ( ! empty( $item['box_shadow_hover_cst'] ) && $item['box_shadow_hover_cst'] == 'yes' ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{box-shadow: ' . esc_attr( $item['box_shadow_horizontal']['size'] ) . 'px ' . esc_attr( $item['box_shadow_vertical']['size'] ) . 'px ' . esc_attr( $item['box_shadow_blur']['size'] ) . 'px ' . esc_attr( $item['box_shadow_spread']['size'] ) . 'px ' . esc_attr( $item['box_shadow_color'] ) . ' !important;}';
					}

					if ( ! empty( $item['transition_hover_cst'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{ -webkit-transition: ' . esc_attr( $item['transition_hover_cst'] ) . ' !important;-moz-transition: ' . esc_attr( $item['transition_hover_cst'] ) . ' !important;-o-transition:' . esc_attr( $item['transition_hover_cst'] ) . ' !important;-ms-transition: ' . esc_attr( $item['transition_hover_cst'] ) . ' !important;}';
					}
					if ( ! empty( $item['transform_hover_cst'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{ transform: ' . esc_attr( $item['transform_hover_cst'] ) . ' !important;-ms-transform: ' . esc_attr( $item['transform_hover_cst'] ) . ' !important;-moz-transform:' . esc_attr( $item['transform_hover_cst'] ) . ' !important;-webkit-transform: ' . esc_attr( $item['transform_hover_cst'] ) . ' !important;}';
					}
					if ( ! empty( $item['css_filter_hover_cst'] ) && $item['css_filter_hover_cst'] == 'yes' ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{filter:brightness( ' . esc_attr( $item['css_filter_brightness']['size'] ) . '% ) contrast( ' . esc_attr( $item['css_filter_contrast']['size'] ) . '% ) saturate( ' . esc_attr( $item['css_filter_saturation']['size'] ) . '% ) blur( ' . esc_attr( $item['css_filter_blur']['size'] ) . 'px ) hue-rotate( ' . esc_attr( $item['css_filter_hue']['size'] ) . 'deg ) !important}';
					}
					if ( ! empty( $item['opacity_hover_cst']['size'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{ opacity: ' . esc_attr( $item['opacity_hover_cst']['size'] ) . ' !important;}';
					}
				}

				if ( ! empty( $item['cst_text_hover_class'] ) ) {
					if ( ! empty( $item['text_color_h_cst'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{ color: ' . esc_attr( $item['text_color_h_cst'] ) . ' !important;}';
					}

					if ( ! empty( $item['ts_color'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . '{ text-shadow : ' . esc_attr( $item['ts_horizontal']['size'] ) . 'px ' . esc_attr( $item['ts_vertical']['size'] ) . 'px ' . esc_attr( $item['ts_blur']['size'] ) . 'px ' . esc_attr( $item['ts_color'] ) . ' !important;}';
					}
				}

				if ( ! empty( $item['cst_image_hover_class'] ) ) {
					if ( ! empty( $item['image_h_border_style'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . ' img{border-style:' . esc_attr( $item['image_h_border_style'] ) . ' !important;border-width: ' . esc_attr( $item['image_h_border_width']['top'] ) . esc_attr( $item['image_h_border_width']['unit'] ) . ' ' . esc_attr( $item['image_h_border_width']['right'] ) . esc_attr( $item['image_h_border_width']['unit'] ) . ' ' . esc_attr( $item['image_h_border_width']['bottom'] ) . esc_attr( $item['image_h_border_width']['unit'] ) . ' ' . esc_attr( $item['image_h_border_width']['left'] ) . esc_attr( $item['image_h_border_width']['unit'] ) . ' !important;border-color:' . esc_attr( $item['image_h_border_color'] ) . ' !important;}';
					}
					if ( ! empty( $item['image_h_border_radius'] ) ) {
						if ( ! empty( $item['image_h_border_radius']['top'] ) || ! empty( $item['image_h_border_radius']['right'] ) || ! empty( $item['image_h_border_radius']['bottom'] ) || ! empty( $item['image_h_border_radius']['left'] ) ) {
							$loopcss .= esc_attr( $get_ele_pre ) . ' img{border-radius: ' . esc_attr( $item['image_h_border_radius']['top'] ) . esc_attr( $item['image_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['image_h_border_radius']['right'] ) . esc_attr( $item['image_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['image_h_border_radius']['bottom'] ) . esc_attr( $item['image_h_border_radius']['unit'] ) . ' ' . esc_attr( $item['image_h_border_radius']['left'] ) . esc_attr( $item['image_h_border_radius']['unit'] ) . ' !important;}';
						}
					}
					if ( ! empty( $item['image_box_shadow_hover_cst'] ) && $item['image_box_shadow_hover_cst'] == 'yes' ) {
						$loopcss .= esc_attr( $get_ele_pre ) . ' img{box-shadow: ' . esc_attr( $item['image_box_shadow_horizontal']['size'] ) . 'px ' . esc_attr( $item['image_box_shadow_vertical']['size'] ) . 'px ' . esc_attr( $item['image_box_shadow_blur']['size'] ) . 'px ' . esc_attr( $item['image_box_shadow_spread']['size'] ) . 'px ' . esc_attr( $item['image_box_shadow_color'] ) . ' !important;}';
					}
					if ( ! empty( $item['image_opacity_hover_cst']['size'] ) ) {
						$loopcss .= esc_attr( $get_ele_pre ) . ' img{ opacity: ' . esc_attr( $item['image_opacity_hover_cst']['size'] ) . ' !important;}';
					}
					if ( ! empty( $item['image_css_filter_hover_cst'] ) && $item['image_css_filter_hover_cst'] == 'yes' ) {
						$loopcss .= esc_attr( $get_ele_pre ) . ' img{filter:brightness( ' . esc_attr( $item['image_css_filter_brightness']['size'] ) . '% ) contrast( ' . esc_attr( $item['image_css_filter_contrast']['size'] ) . '% ) saturate( ' . esc_attr( $item['image_css_filter_saturation']['size'] ) . '% ) blur( ' . esc_attr( $item['image_css_filter_blur']['size'] ) . 'px ) hue-rotate( ' . esc_attr( $item['image_css_filter_hue']['size'] ) . 'deg ) !important}';
					}
				}
			}

			/*style tag for hover end*/
			if ( ! empty( $item['content_tag_image_opt'] ) && $item['content_tag_image_opt'] == 'background' ) {
				$loopcss .= '.tp-image-as-background{position:absolute;display:block;width:100%;height:100%;background-size:cover;}';
			}

			++$i;
		}

			$hover_card  .= $loopitem;
			$hover_card  .= '</div>';
				$loopcss .= '.tp-hover-card-wrapper{position:relative;display:block;width:100%;height:100%;} .tp-hover-card-wrapper * {transition:all 0.3s linear}';
		if ( ! empty( $loopcss ) ) {
			$hover_card .= '<style>' . esc_attr( $loopcss ) . '</style>';
		}

		echo $hover_card;
	}

	protected function content_template() {
	}
}
