<?php
/**
 * Widget Name: Heading Title
 * Description: Creative Heading Options.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Theplus_Ele_Heading_Title.
 */
class Theplus_Ele_Heading_Title extends Widget_Base {

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
		return 'tp-heading-title';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Heading Title', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-header theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Heading', 'Title', 'Heading Title', 'Heading Widget', 'Title Widget' );
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
			'heading_title_layout_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'heading_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Style', 'theplus' ),
				'default' => 'style_1',
				'options' => array(
					'style_1'  => esc_html__( 'Modern', 'theplus' ),
					'style_2'  => esc_html__( 'Simple', 'theplus' ),
					'style_4'  => esc_html__( 'Classic', 'theplus' ),
					'style_5'  => esc_html__( 'Double Border', 'theplus' ),
					'style_6'  => esc_html__( 'Vertical Border', 'theplus' ),
					'style_7'  => esc_html__( 'Dashing Dots', 'theplus' ),
					'style_8'  => esc_html__( 'Unique', 'theplus' ),
					'style_9'  => esc_html__( 'Stylish', 'theplus' ),
					'style_10' => esc_html__( 'Animated Split', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_animated_split',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "animated-headings-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'heading_style' => array( 'style_10' ),
				),
			)
		);
		$this->add_control(
			'ani_split_type',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Type', 'theplus' ),
				'default'   => 'words',
				'options'   => array(
					'words' => esc_html__( 'Word', 'theplus' ),
					'chars' => esc_html__( 'Character', 'theplus' ),
					'lines' => esc_html__( 'Line', 'theplus' ),
				),
				'condition' => array(
					'heading_style' => 'style_10',
				),
			)
		);
		$this->add_control(
			'select_heading',
			array(
				'label'     => esc_html__( 'Select Heading', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'    => esc_html__( 'Default', 'theplus' ),
					'page_title' => esc_html__( 'Page Title', 'theplus' ),
				),
				'condition' => array(
					'heading_style!' => 'style_10',
				),
			)
		);
		$this->add_control(
			'how_it_works_page_title',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "slide-out-discount-code-card-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'select_heading' => array( 'page_title' ),
				),
			)
		);
		$this->add_control(
			'title',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Heading Title', 'theplus' ),
				'label_block' => true,
				'default'     => esc_html__( 'Heading', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'select_heading' => 'default',
				),
			)
		);
		$this->add_control(
			'sub_title',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Sub Title', 'theplus' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Sub Title', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'heading_style!' => 'style_10',
				),
			)
		);
		$this->add_control(
			'title_s',
			array(
				'type'        => Controls_Manager::TEXT,
				'label'       => esc_html__( 'Extra Title', 'theplus' ),
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Title', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'heading_style' => 'style_1',
				),
			)
		);
		$this->add_control(
			'heading_s_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Extra Title Position', 'theplus' ),
				'default'   => 'text_after',
				'options'   => array(
					'text_after'  => esc_html__( 'Postfix', 'theplus' ),
					'text_before' => esc_html__( 'Prefix', 'theplus' ),
				),
				'condition' => array(
					'heading_style' => 'style_1',
				),
			)
		);
		$this->add_responsive_control(
			'sub_title_align',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
						'title' => esc_html__( 'Justify', 'theplus' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'prefix_class' => 'text-%s',
				'default'      => 'center',
				'separator'    => 'before',
				'condition'    => array(
					'heading_style!' => 'style_6',
				),
			)
		);
		$this->add_control(
			'heading_title_subtitle_limit',
			array(
				'label'     => wp_kses_post( "Heading Title & Sub Title Limit <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-word-count-in-heading-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style!' => 'style_10',
				),
			)
		);
		$this->add_control(
			'display_heading_title_limit',
			array(
				'label'     => esc_html__( 'Heading Title Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_heading_title_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'theplus' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);
		$this->add_control(
			'display_heading_title_input',
			array(
				'label'     => esc_html__( 'Heading Title Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);
		$this->add_control(
			'display_title_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_heading_title_limit'  => 'yes',
				),
			)
		);

		$this->add_control(
			'display_sub_title_limit',
			array(
				'label'     => esc_html__( 'Sub Title Limit', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_by',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Limit on', 'theplus' ),
				'default'   => 'char',
				'options'   => array(
					'char' => esc_html__( 'Character', 'theplus' ),
					'word' => esc_html__( 'Word', 'theplus' ),
				),
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_input',
			array(
				'label'     => esc_html__( 'Sub Title Count', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 1000,
				'step'      => 1,
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->add_control(
			'display_sub_title_3_dots',
			array(
				'label'     => esc_html__( 'Display Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'heading_style!'               => 'style_10',
					'heading_title_subtitle_limit' => 'yes',
					'display_sub_title_limit'      => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'heading_title_animation_section',
			array(
				'label'     => esc_html__( 'Animated Split Text Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'heading_style' => 'style_10',
				),
			)
		);
		$this->add_control(
			'hst_animation_type',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Animation Effect', 'theplus' ),
				'default' => 'default',
				'options' => array(
					'default'           => esc_html__( 'Default', 'theplus' ),
					'Power0.easeNone'   => esc_html__( 'Power 0 easeNone', 'theplus' ),
					'Power1.easeInOut'  => esc_html__( 'Power 1 easeInOut', 'theplus' ),
					'Power1.easeIn'     => esc_html__( 'Power 1 easeIn', 'theplus' ),
					'Power1.easeOut'    => esc_html__( 'Power 1 easeOut', 'theplus' ),
					'Power2.easeInOut'  => esc_html__( 'Power 2 easeInOut', 'theplus' ),
					'Power2.easeIn'     => esc_html__( 'Power 2 easeIn', 'theplus' ),
					'Power2.easeOut'    => esc_html__( 'Power 2 easeOut', 'theplus' ),
					'Power3.easeInOut'  => esc_html__( 'Power 3 easeInOut', 'theplus' ),
					'Power3.easeIn'     => esc_html__( 'Power 3 easeIn', 'theplus' ),
					'Power3.easeOut'    => esc_html__( 'Power3 easeOut', 'theplus' ),
					'Power4.easeInOut'  => esc_html__( 'Power 4 easeInOut', 'theplus' ),
					'Power4.easeIn'     => esc_html__( 'Power 4 easeIn', 'theplus' ),
					'Power4.easeOut'    => esc_html__( 'Power 4 easeOut', 'theplus' ),
					'Back.easeOut'      => esc_html__( 'Back easeOut', 'theplus' ),
					'Elastic.easeInOut' => esc_html__( 'Elastic easeInOut', 'theplus' ),
					'Elastic.easeIn'    => esc_html__( 'Elastic easeIn', 'theplus' ),
					'Elastic.easeOut'   => esc_html__( 'Elastic easeOut', 'theplus' ),
					'Bounce.easeInOut'  => esc_html__( 'Bounce easeInOut', 'theplus' ),
					'Bounce.easeIn'     => esc_html__( 'Bounce easeIn', 'theplus' ),
					'Bounce.easeOut'    => esc_html__( 'Bounce easeOut', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'hst_animation_x',
			array(
				'label'   => esc_html__( 'X', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'   => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 10,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_y',
			array(
				'label'   => esc_html__( 'Y', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 100,
				),
				'range'   => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 10,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_z',
			array(
				'label'   => esc_html__( 'Z', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'   => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 10,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_scale',
			array(
				'label'   => esc_html__( 'Scale', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_rotation',
			array(
				'label'   => esc_html__( 'Rotate', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'   => array(
					'px' => array(
						'min'  => -700,
						'max'  => 700,
						'step' => 10,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_speed',
			array(
				'label'   => esc_html__( 'Speed', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 1,
				),
				'range'   => array(
					'px' => array(
						'min'  => 0.01,
						'max'  => 3,
						'step' => 0.01,
					),
				),
			)
		);
		$this->add_control(
			'hst_animation_delay',
			array(
				'label'   => esc_html__( 'Delay', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'unit' => 'px',
					'size' => 0.02,
				),
				'range'   => array(
					'px' => array(
						'min'  => 0.01,
						'max'  => 1,
						'step' => 0.01,
					),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_animatedtextstyling',
			array(
				'label'     => esc_html__( 'Animated Split Text', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style' => 'style_10',
				),
			)
		);
		$this->add_control(
			'ast_title',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Title Tag', 'theplus' ),
				'default' => 'div',
				'options' => theplus_get_tags_options( 'a' ),
			)
		);
		$this->add_control(
			'ast_title_link',
			array(
				'label'       => esc_html__( 'Heading Title Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'after',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'ast_title' => 'a',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'anitext_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .heading.style-10 .sub-style',
			)
		);
		$this->add_control(
			'title_anitext_n',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading.style-10 .sub-style' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label'     => esc_html__( 'Separator Settings', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style!' => array( 'style_1', 'style_2', 'style_8', 'style_10' ),
				),
			)
		);
		$this->add_control(
			'input_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .seprator ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'double_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4d4d4d',
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:before,{{WRAPPER}} .heading.style-5 .heading-title:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => 'style_5',
				),
			)
		);
		$this->add_control(
			'double_top',
			array(
				'label'     => esc_html__( 'Top Separator Height', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -50,
				'step'      => 1,
				'default'   => 6,
				'condition' => array(
					'heading_style' => 'style_5',
				),
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:before' => 'height: {{VALUE}}px;',
				),

			)
		);
		$this->add_control(
			'double_bottom',
			array(
				'label'     => esc_html__( 'Bottom Separator Height', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -50,
				'step'      => 1,
				'default'   => 2,
				'condition' => array(
					'heading_style' => 'style_5',
				),
				'selectors' => array(
					'{{WRAPPER}} .heading.style-5 .heading-title:after' => 'height: {{VALUE}}px;',
				),

			)
		);
		$this->add_control(
			'sep_img',
			array(
				'label'     => esc_html__( 'Separator With Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => '',
				),
				'condition' => array(
					'heading_style' => 'style_4',
				),
			)
		);
		$this->add_control(
			'sep_clr',
			array(
				'label'     => esc_html__( 'Separator Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4099c3',
				'selectors' => array(
					'{{WRAPPER}} .heading .title-sep' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => array( 'style_4', 'style_9' ),
				),
			)
		);
		$this->add_responsive_control(
			'sep_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator Width', 'theplus' ),
				'size_units'  => array( '%', 'px' ),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'range'       => array(
					'' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .heading .title-sep,{{WRAPPER}} .heading .seprator' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'heading_style' => array( 'style_4', 'style_9' ),
				),
			)
		);
		$this->add_control(
			'dot_color',
			array(
				'label'     => esc_html__( 'Separator Dot Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ca2b2b',
				'selectors' => array(
					'{{WRAPPER}} .heading .sep-dot' => 'color: {{VALUE}};',
					'{{WRAPPER}} .heading.style-7 .head-title:after' => 'color: {{VALUE}}; text-shadow: 15px 0 {{VALUE}}, -15px 0 {{VALUE}};',
				),
				'condition' => array(
					'heading_style' => array( 'style_7', 'style_9' ),
				),
			)
		);
		$this->add_control(
			'seprator_dot_offfset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -500,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'heading_style' => array( 'style_7', 'style_9' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .heading.style-7 .head-title:after,{{WRAPPER}} .heading.style-9 .sep-dot' => 'top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'sep_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Separator Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 2,
				),
				'range'       => array(
					'' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .heading .title-sep' => 'border-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'heading_style' => 'style_4',
				),
			)
		);
		$this->add_control(
			'top_clr_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 2,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'heading_style' => 'style_6',
				),
				'selectors'   => array(
					'{{WRAPPER}} .heading .vertical-divider' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'top_clr_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 30,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'heading_style' => 'style_6',
				),
				'selectors'   => array(
					'{{WRAPPER}} .heading .vertical-divider' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'top_clr',
			array(
				'label'     => esc_html__( 'Separator Vertical Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1e73be',
				'selectors' => array(
					'{{WRAPPER}} .heading .vertical-divider' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'heading_style'     => 'style_6',
					'top_clr_bg_color!' => 'yes',
				),
			)
		);
		$this->add_control(
			'top_clr_bg_color',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style' => 'style_6',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'top_clr_bg_color_select',
				'label'     => esc_html__( 'Color', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .heading .vertical-divider',
				'condition' => array(
					'heading_style'    => 'style_6',
					'top_clr_bg_color' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label'     => esc_html__( 'Main Title', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style!' => 'style_10',
					'title!'         => '',
				),
			)
		);
		$this->add_control(
			'title_h',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Title Tag', 'theplus' ),
				'default' => 'h2',
				'options' => theplus_get_tags_options( 'a' ),
			)
		);
		$this->add_control(
			'title_link',
			array(
				'label'       => esc_html__( 'Heading Title Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'after',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'title_h' => 'a',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .heading .heading-title',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'       => esc_html__( 'Title Color', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'theplus' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'theplus' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-title' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'title_color' => array( 'solid' ),
				),
			)
		);
		$this->add_control(
			'title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color1_control',
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
					'title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_color2_control',
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
					'title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_color'          => array( 'gradient' ),
					'title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_color'          => array( 'gradient' ),
					'title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'title_shadow',
				'selectors' => '{{WRAPPER}} .heading .heading-title',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			's_maintitle_pg',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'heading_style' => array( 'style_1', 'style_2' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .heading_style .head-title .heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'special_effect',
			array(
				'label'     => esc_html__( 'Special Effect', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'heading_style' => array( 'style_1', 'style_2', 'style_8' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Overlay_Special_Effect_Group::get_type(),
			array(
				'label'     => esc_html__( 'Overlay Color', 'theplus' ),
				'name'      => 'overlay_spcial',
				'condition' => array(
					'special_effect' => 'yes',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_sub_title_styling',
			array(
				'label'     => esc_html__( 'Sub Title', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style!' => 'style_10',
					'sub_title!'     => '',
				),
			)
		);
		$this->add_control(
			'sub_title_tag',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Subtitle Tag', 'theplus' ),
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .heading .heading-sub-title',
			)
		);
		$this->add_control(
			'sub_title_color',
			array(
				'label'       => esc_html__( 'Subtitle Title Color', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'theplus' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'theplus' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'sub_title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-sub-title' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'sub_title_color' => array( 'solid' ),
				),
			)
		);
		$this->add_control(
			'sub_title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color1_control',
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
					'sub_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_color2_control',
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
					'sub_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'sub_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'sub_title_color'          => array( 'gradient' ),
					'sub_title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'sub_title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .heading .heading-sub-title' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{sub_title_gradient_color1.VALUE}} {{sub_title_gradient_color1_control.SIZE}}{{sub_title_gradient_color1_control.UNIT}}, {{sub_title_gradient_color2.VALUE}} {{sub_title_gradient_color2_control.SIZE}}{{sub_title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'sub_title_color'          => array( 'gradient' ),
					'sub_title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_responsive_control(
			's_subtitle_pg',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'heading_style' => array( 'style_1', 'style_2' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .heading_style .heading-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_extra_title_styling',
			array(
				'label'     => esc_html__( 'Extra Title', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style' => 'style_1',
					'title_s!'      => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ex_title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .heading .title-s',
			)
		);
		$this->add_control(
			'ex_title_color',
			array(
				'label'       => esc_html__( 'Extra Title Color', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'solid'    => array(
						'title' => esc_html__( 'Solid', 'theplus' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'theplus' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'solid',
				'toggle'      => true,
			)
		);
		$this->add_control(
			'ex_title_solid_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .heading .title-s' => 'color: {{VALUE}};',
				),
				'default'   => '#313131',
				'condition' => array(
					'ex_title_color' => array( 'solid' ),
				),
			)
		);
		$this->add_control(
			'ex_title_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color1_control',
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
					'ex_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_color2_control',
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
					'ex_title_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'ex_title_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_angle',
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
				'selectors'  => array(
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'ex_title_color'          => array( 'gradient' ),
					'ex_title_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'ex_title_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .heading .title-s' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{ex_title_gradient_color1.VALUE}} {{ex_title_gradient_color1_control.SIZE}}{{ex_title_gradient_color1_control.UNIT}}, {{ex_title_gradient_color2.VALUE}} {{ex_title_gradient_color2_control.SIZE}}{{ex_title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'ex_title_color'          => array( 'gradient' ),
					'ex_title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_settings_option_styling',
			array(
				'label'     => esc_html__( 'Advanced', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_style!' => 'style_10',
				),
			)
		);

		$this->add_control(
			'position',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Title Position', 'theplus' ),
				'default' => 'after',
				'options' => array(
					'before' => esc_html__( 'Before Title', 'theplus' ),
					'after'  => esc_html__( 'After Title', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'mobile_center_align',
			array(
				'type'    => Controls_Manager::SWITCHER,
				'label'   => esc_html__( 'Center Alignment In Mobile', 'theplus' ),
				'default' => 'no',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();

			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
			include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Load Widget limit Words
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 *
	 * @param string $text The string to limit the words for.
	 * @param int    $word_limit The maximum number of words to keep in the string.
	 * @return string The modified string with the limited number of words.
	 */
	protected function limit_words( $text, $word_limit ) {
		$words = explode( ' ', $text );

		return implode( ' ', array_splice( $words, 0, $word_limit ) );
	}

	/**
	 * Render Heading Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$heading_style      = ! empty( $settings['heading_style'] ) ? $settings['heading_style'] : 'style_1';
		$heading_title_text = '';

		$select_hd   = ! empty( $settings['select_heading'] ) ? $settings['select_heading'] : 'default';
		$hd_title    = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$title_input = ! empty( $settings['display_heading_title_input'] ) ? $settings['display_heading_title_input'] : '';

		if ( 'page_title' === $select_hd ) {
			$heading_title_text = get_the_title();
		} elseif ( ! empty( $hd_title ) ) {

				$dis_hdlimit = ! empty( $settings['display_heading_title_limit'] ) ? $settings['display_heading_title_limit'] : '';
				$dis_titleby = ! empty( $settings['display_heading_title_by'] ) ? $settings['display_heading_title_by'] : 'char';
				$three_dots  = ! empty( $settings['display_title_3_dots'] ) ? $settings['display_title_3_dots'] : '';

			if ( 'yes' === $dis_hdlimit && ! empty( $title_input ) ) {

				if ( ! empty( $dis_titleby ) ) {

					if ( 'char' === $dis_titleby ) {
						$heading_title_text = substr( $hd_title, 0, $title_input );

						if ( strlen( $hd_title ) > $title_input ) {

							if ( 'yes' === $three_dots ) {
								$heading_title_text .= '...';
							}
						}
					} elseif ( 'word' === $dis_titleby ) {
						$heading_title_text = $this->limit_words( $hd_title, $title_input );
						if ( str_word_count( $hd_title ) > $title_input ) {

							if ( 'yes' === $three_dots ) {
								$heading_title_text .= '...';
							}
						}
					}
				}
			} else {
				$heading_title_text = wp_kses_post( $hd_title );
			}
		}

		$img_src = '';

		$sub_gradient_cass     = '';
		$title_s_gradient_cass = '';
		$title_gradient_cass   = '';

		if ( ! empty( $settings['sep_img']['url'] ) ) {
			$image_id = $settings['sep_img']['id'];
			$img_src  = tp_get_image_rander( $image_id, 'full' );
		}

		$txt_color     = ! empty( $settings['title_color'] ) ? $settings['title_color'] : 'solid';
		$ex_txt_color  = ! empty( $settings['ex_title_color'] ) ? $settings['ex_title_color'] : 'solid';
		$sub_txt_color = ! empty( $settings['sub_title_color'] ) ? $settings['sub_title_color'] : 'solid';

		if ( 'gradient' === $txt_color ) {
			$title_gradient_cass = 'heading-title-gradient';
		}
		if ( 'gradient' === $ex_txt_color ) {
			$title_s_gradient_cass = 'heading-title-gradient';
		}
		if ( 'gradient' === $sub_txt_color ) {
			$sub_gradient_cass = 'heading-title-gradient';
		}

		$style_class = '';
		if ( 'style_1' === $heading_style ) {
			$style_class = 'style-1';
		} elseif ( 'style_2' === $heading_style ) {
			$style_class = 'style-2';
		} elseif ( 'style_4' === $heading_style ) {
			$style_class = 'style-4';
		} elseif ( 'style_5' === $heading_style ) {
			$style_class = 'style-5';
		} elseif ( 'style_6' === $heading_style ) {
			$style_class = 'style-6';
		} elseif ( 'style_7' === $heading_style ) {
			$style_class = 'style-7';
		} elseif ( 'style_8' === $heading_style ) {
			$style_class = 'style-8';
		} elseif ( 'style_9' === $heading_style ) {
			$style_class = 'style-9';
		} elseif ( 'style_10' === $heading_style ) {
			$style_class = 'style-10';
		} elseif ( 'style_11' === $heading_style ) {
			$style_class = 'style-11';
		}

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$uid     = uniqid( 'heading_style' );
		$heading = '<div class="heading heading_style ' . esc_attr( $uid ) . ' ' . esc_attr( $style_class ) . ' ' . $animated_class . '" ' . $animation_attr . '>';

		$mobile_center = '';

		$mo_center_align = ! empty( $settings['mobile_center_align'] ) ? $settings['mobile_center_align'] : '';

		if ( 'yes' === $mo_center_align ) {

			if ( 'style_1' === $heading_style || 'style_2' === $heading_style || 'style_4' === $heading_style || 'style_5' === $heading_style || 'style_7' === $heading_style || 'style_9' === $heading_style ) {
				$mobile_center = 'heading-mobile-center';
			}
		}

		$ani_split_type = ! empty( $settings['ani_split_type'] ) ? $settings['ani_split_type'] : 'words';

		$annimtypedtaattr = '';
		$htaattrbunch     = '';

		$cls = '';

		if ( 'style_10' === $heading_style && ! empty( $ani_split_type ) ) {
			$ani_split_typesel = $ani_split_type;

			if ( 'lines' === $ani_split_type ) {
				$ani_split_typesel = 'lines,chars';
			}

			$annimtypedtaattr .= ' data-animsplit-type="' . esc_attr( $ani_split_typesel ) . '"';

			$cls = $ani_split_type;

			$hst_animation_x = ! empty( $settings['hst_animation_x'] ) ? $settings['hst_animation_x']['size'] : 0;
			$hst_animation_y = ! empty( $settings['hst_animation_y'] ) ? $settings['hst_animation_y']['size'] : 100;
			$hst_animation_z = ! empty( $settings['hst_animation_z'] ) ? $settings['hst_animation_z']['size'] : 0;

			$hst_animation_type  = ! empty( $settings['hst_animation_type'] ) ? $settings['hst_animation_type'] : 'default';
			$hst_animation_scale = ! empty( $settings['hst_animation_scale'] ) ? $settings['hst_animation_scale']['size'] : 0;
			$hst_animation_speed = ! empty( $settings['hst_animation_speed'] ) ? $settings['hst_animation_speed']['size'] : 1;
			$hst_animation_delay = ! empty( $settings['hst_animation_delay'] ) ? $settings['hst_animation_delay']['size'] : 0.02;

			$hst_animation_rotation = ! empty( $settings['hst_animation_rotation'] ) ? $settings['hst_animation_rotation']['size'] : 0;

			$htaattr = array(
				'effect'   => sanitize_text_field($hst_animation_type),
				'x'        => strval( floatval ( $hst_animation_x ) ),
				'y'        => strval( floatval ( $hst_animation_y ) ),
				'z'        => strval( floatval ( $hst_animation_z ) ),
				'scale'    => strval( floatval ( $hst_animation_scale ) ),
				'rotation' => strval( floatval ( $hst_animation_rotation ) ),
				'speed'    => strval( floatval ( $hst_animation_speed ) ),
				'delay'    => strval( floatval ( $hst_animation_delay ) ),
			);

			$htaattr = wp_json_encode( $htaattr );
			$htaattrbunch = 'data-aniattrht = ' . esc_attr( $htaattr );
		}

		$ast_title = ! empty( $settings['ast_title'] ) ? $settings['ast_title'] : 'div';

		if ( 'style_10' === $heading_style && ! empty( $heading_title_text ) ) {

			$ast_title_link = ! empty( $settings['ast_title_link'] ) ? $settings['ast_title_link'] : '';

			if ( ! empty( $ast_title_link['url'] ) ) {

				$this->add_render_attribute( 'ast_ani_link', 'href', esc_url( $ast_title_link['url'] ) );
				if ( $ast_title_link['is_external'] ) {
					$this->add_render_attribute( 'ast_ani_link', 'target', '_blank' );
				}

				if ( $ast_title_link['nofollow'] ) {
					$this->add_render_attribute( 'ast_ani_link', 'rel', 'nofollow' );
				}
			}

			$heading .= '<' . esc_attr( theplus_validate_html_tag( $ast_title ) ) . ' ' . $this->get_render_attribute_string( 'ast_ani_link' ) . ' class="sub-style ' . esc_attr( $cls ) . '" ' . $annimtypedtaattr . ' ' . esc_attr( $htaattrbunch ) . '>';
			$heading .= $heading_title_text;
		} else {
			$heading .= '<div class="sub-style ' . esc_attr( $cls ) . '" ' . $annimtypedtaattr . ' ' . $htaattrbunch . '>';
		}

		if ( 'style_6' === $heading_style ) {
			$heading .= '<div class="vertical-divider top"> </div>';
		}

		$title_con   = '';
		$s_title_con = '';

		$title_s_before = '';

		if ( 'style_1' === $heading_style ) {
			$title_s_before .= '<span class="title-s ' . esc_attr( $title_s_gradient_cass ) . '"> ' . wp_kses_post( $settings['title_s'] ) . ' </span>';
		}

		if ( ! empty( $heading_title_text ) ) {
			$reveal_effects = $effect_attr = '';
			if ( 'style_1' === $heading_style || 'style_2' === $heading_style || 'style_8' === $heading_style ) {

				$spi_effect = ! empty( $settings['special_effect'] ) ? $settings['special_effect'] : '';

				if ( 'yes' === $spi_effect ) {
					$effect_rand_no = uniqid( 'reveal' );

					$color_1 = ! empty( $settings['overlay_spcial_effect_color_1'] ) ? $settings['overlay_spcial_effect_color_1'] : '#313131';
					$color_2 = ! empty( $settings['overlay_spcial_effect_color_2'] ) ? $settings['overlay_spcial_effect_color_2'] : '#ff214f';

					$effect_attr   .= ' data-reveal-id="' . esc_attr( $effect_rand_no ) . '" ';
					$effect_attr   .= ' data-effect-color-1="' . esc_attr( $color_1 ) . '" ';
					$effect_attr   .= ' data-effect-color-2="' . esc_attr( $color_2 ) . '" ';
					$reveal_effects = ' pt-plus-reveal ' . esc_attr( $effect_rand_no ) . ' ';
				}
			}

			$txt_link = ! empty( $settings['title_link'] ) ? $settings['title_link'] : '';
			$title_h  = ! empty( $settings['title_h'] ) ? $settings['title_h'] : 'h2';

			if ( ! empty( $txt_link['url'] ) && 'a' === $title_h ) {
					$this->add_render_attribute( 'titlehref', 'href', esc_url( $txt_link['url'] ) );

				if ( $txt_link['is_external'] ) {
					$this->add_render_attribute( 'titlehref', 'target', '_blank' );
				}

				if ( $txt_link['nofollow'] ) {
					$this->add_render_attribute( 'titlehref', 'rel', 'nofollow' );
				}
			}

			$title_con = '<div class="head-title ' . esc_attr( $mobile_center ) . '" > ';

				$title_con .= '<' . esc_attr( theplus_validate_html_tag( $title_h ) ) . ' ' . $this->get_render_attribute_string( 'titlehref' ) . ' class="heading-title ' . esc_attr( $mobile_center ) . ' ' . esc_attr( $reveal_effects ) . ' ' . esc_attr( $title_gradient_cass ) . '" ' . $effect_attr . '  data-hover="' . esc_attr( $heading_title_text ) . '">';

			if ( 'text_before' === $settings['heading_s_style'] ) {
				$title_con .= $title_s_before . $heading_title_text;
			} else {
				$title_con .= $heading_title_text . $title_s_before;
			}

				$title_con .= '</' . esc_attr( theplus_validate_html_tag( $title_h ) ) . '>';

			if ( 'style_4' === $heading_style || 'style_9' === $heading_style ) {
				$title_con .= '<div class="seprator sep-l" >';

				$title_con .= '<span class="title-sep sep-l"></span>';

				if ( 'style_9' === $heading_style ) {
					$title_con .= '<div class="sep-dot">.</div>';
				} elseif ( ! empty( $img_src ) ) {
					$title_con .= '<div class="sep-mg">' . wp_kses_post( $img_src ) . '</div>';
				}

				$title_con .= '<span class="title-sep sep-r" ></span>';
				$title_con .= '</div>';
			}

			$title_con .= '</div>';
		}

		$sub_title_dis = '';

		$sub_txt = ! empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';

		if ( ! empty( $sub_txt ) ) {

			$dis_limit_sub = ! empty( $settings['display_sub_title_limit'] ) ? $settings['display_sub_title_limit'] : '';
			$sub_input_txt = ! empty( $settings['display_sub_title_input'] ) ? $settings['display_sub_title_input'] : '';

			$sub_txtby = ! empty( $settings['display_sub_title_by'] ) ? $settings['display_sub_title_by'] : '';
			$sub_dots  = ! empty( $settings['display_sub_title_3_dots'] ) ? $settings['display_sub_title_3_dots'] : '';

			if ( 'yes' === $dis_limit_sub && ! empty( $sub_input_txt ) ) {

				if ( ! empty( $sub_txtby ) ) {

					if ( 'char' === $sub_txtby ) {

						$sub_title_dis = substr( $sub_txt, 0, $sub_input_txt );

						if ( strlen( $sub_txt ) > $title_input ) {

							if ( 'yes' === $sub_dots ) {
								$sub_title_dis .= '...';
							}
						}
					} elseif ( 'word' === $sub_txtby ) {
						$sub_title_dis = $this->limit_words( $sub_txt, $sub_input_txt );

						if ( str_word_count( $sub_txt ) > $title_input ) {

							if ( 'yes' === $sub_dots ) {
								$sub_title_dis .= '...';
							}
						}
					}
				}
			} else {
				$sub_title_dis = $sub_txt;
			}

			$s_title_con = '<div class="sub-heading">';

				$s_title_con .= '<' . esc_attr( theplus_validate_html_tag( $settings['sub_title_tag'] ) ) . ' class="heading-sub-title ' . esc_attr( $mobile_center ) . ' ' . esc_attr( $sub_gradient_cass ) . '"> ' . wp_kses_post( $sub_title_dis ) . ' </' . esc_attr( theplus_validate_html_tag( $settings['sub_title_tag'] ) ) . '>';

			$s_title_con .= '</div>';
		}

		$txt_pos = ! empty( $settings['position'] ) ? $settings['position'] : '';

		if( 'style_10' !== $heading_style ) {

			if ( 'before' === $txt_pos ) {
				$heading .= $s_title_con . $title_con;
			}
	
			if ( 'after' === $txt_pos ) {
				$heading .= $title_con . $s_title_con;
			}

		}

		if ( 'style_6' === $heading_style ) {
			$heading .= '<div class="vertical-divider bottom"> </div>';
		}

		if ( 'style_10' === $heading_style && ! empty( $heading_title_text ) ) {
			$heading .= '</' . esc_attr( theplus_validate_html_tag( $ast_title ) ) . '>';
		} else {
			$heading .= '</div>';
		}

		$heading .= '</div>';

		echo $before_content . $heading . $after_content;
	}
}