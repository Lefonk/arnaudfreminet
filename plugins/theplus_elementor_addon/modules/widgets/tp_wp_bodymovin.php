<?php
/**
 * Widget Name: Bodymovin Animations
 * Description: json parse animation moving
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Bodymovin_Animations.
 */
class ThePlus_Bodymovin_Animations extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;

	/**
	 * Get Widget Name.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-wp-bodymovin';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'LottieFiles Animation', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-scissors theplus_backend_icon';
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
	 * Get Widget categories.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Lottiefiles', 'Lottie animation', 'Lottie widget', 'Elementor Lottie', 'Lottie Elementor', 'Lottie animation Elementor', 'Lottie animation widget', 'Lottie animation plugin', 'Lottie animation addon', 'Lottie animation for Elementor', 'On Scroll', 'Scroll Animation', 'Animated Scroll', 'Animation Widget', 'JSON Animation' );
	}

	/**
	 * Register controls.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Lottie Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'json_code_url',
			array(
				'label'       => esc_html__( 'JSON Input', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'code',
				'description' => 'Note : Download JSON file <a href="https://lottiefiles.com/14288-surfing-waveboard" class="theplus-btn" target="_blank">(example link)</a> and import It’s code/url/file at space below.',
				'options'     => array(
					'code' => esc_html__( 'Code', 'theplus' ),
					'url'  => esc_html__( 'URL', 'theplus' ),
					'file' => esc_html__( 'File', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'content_parse_json_url',
			array(
				'label'       => esc_html__( 'JSON URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'json_code_url' => 'url',
				),
			)
		);
		$this->add_control(
			'content_parse_json_file',
			array(
				'label'              => esc_html__( 'File', 'theplus' ),
				'type'               => Controls_Manager::MEDIA,
				'media_type'         => 'application/json',
				'frontend_available' => true,
				'condition'          => array(
					'json_code_url' => 'file',
				),
			)
		);
		$this->add_control(
			'bm_load_backend',
			array(
				'label'   => esc_html__( 'Load in Backend', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'popup',
			array(
				'label'   => esc_html__( 'Elementor Popup', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);
		$this->add_control(
			'content_parse_json',
			array(
				'label'     => esc_html__( 'JSON Code', 'theplus' ),
				'type'      => Controls_Manager::CODE,
				'language'  => 'json',
				'rows'      => 20,
				'condition' => array(
					'json_code_url' => 'code',
				),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_bm_extra_option',
			array(
				'label' => esc_html__( 'Main Settings', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'play_action_on',
			array(
				'label'   => __( 'Play on', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'autoplay',
				'options' => array(
					''            => __( 'Default', 'theplus' ),
					'autoplay'    => __( 'Auto Play', 'theplus' ),
					'hover'       => __( 'On Hover', 'theplus' ),
					'click'       => __( 'On Click', 'theplus' ),
					'column'      => __( 'Column Hover', 'theplus' ),
					'section'     => __( 'Section Hover', 'theplus' ),
					'mouseinout'  => __( 'Mouse In-Out Effect', 'theplus' ),
					'mousescroll' => __( 'Scroll Parallax', 'theplus' ),
					'viewport'    => __( 'View Port Based', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'loop',
			array(
				'label'        => esc_html__( 'Loop Animation', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'ON', 'theplus' ),
				'label_off'    => esc_html__( 'OFF', 'theplus' ),
				'return_value' => 'true',
				'default'      => 'true',
				'separator'    => 'before',
				'condition'    => array(
					'play_action_on!' => '',
				),
			)
		);
		$this->add_control(
			'loop_time',
			array(
				'label'     => esc_html__( 'Total Loops', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 10,
				'step'      => 1,
				'condition' => array(
					'loop' => 'true',
				),
			)
		);
		$this->add_control(
			'speed',
			array(
				'label'     => esc_html__( 'Animation Play Speed', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0.5,
				),
				'condition' => array(
					'play_action_on!' => array( '', 'mousescroll', 'mouseinout', 'hover', 'click', 'column', 'section' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'bm_scrollbased',
			array(
				'label'       => __( 'On Scroll Animation Height', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'bm_custom',
				'options'     => array(
					'bm_custom'   => __( 'Custom Height', 'theplus' ),
					'bm_document' => __( 'Document Height', 'theplus' ),
				),
				'description' => __( 'Note : If you select "Document height", Animation will start and end based on whole page\'s height. In Custom height, You will be able to select offset and total height for animation.', 'theplus' ),
				'separator'   => 'before',
				'condition'   => array(
					'play_action_on' => 'mousescroll',
				),
			)
		);

		$this->add_control(
			'bm_section_duration',
			array(
				'label'     => __( 'Duration', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 50,
						'max'  => 2000,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 500,
				),
				'condition' => array(
					'play_action_on' => 'mousescroll',
					'bm_scrollbased' => 'bm_custom',
				),
			)
		);
		$this->add_control(
			'bm_section_offset',
			array(
				'label'     => __( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'condition' => array(
					'play_action_on' => 'mousescroll',
					'bm_scrollbased' => 'bm_custom',
				),
			)
		);
		$this->add_control(
			'bm_start_custom',
			array(
				'label'     => esc_html__( 'Custom Animation Start Time', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'ON', 'theplus' ),
				'label_off' => esc_html__( 'OFF', 'theplus' ),
				'condition' => array(
					'play_action_on' => array( 'autoplay', 'hover', 'click', 'column', 'section', 'mouseinout', 'mousescroll', 'viewport' ),
				),
			)
		);
		$this->add_control(
			'bm_start_time',
			array(
				'label'     => esc_html__( 'Animation Start Time', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5000,
				'step'      => 1,
				'condition' => array(
					'play_action_on'  => array( 'autoplay', 'hover', 'click', 'column', 'section', 'mouseinout', 'mousescroll', 'viewport' ),
					'bm_start_custom' => 'yes',
				),
			)
		);
		$this->add_control(
			'bm_end_custom',
			array(
				'label'     => esc_html__( 'Custom Animation End Time', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'ON', 'theplus' ),
				'label_off' => esc_html__( 'OFF', 'theplus' ),
				'condition' => array(
					'play_action_on' => array( 'autoplay', 'hover', 'click', 'column', 'section', 'mouseinout', 'mousescroll', 'viewport' ),
				),
			)
		);
		$this->add_control(
			'bm_end_time',
			array(
				'label'     => esc_html__( 'Animation End Time', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 5000,
				'step'      => 1,
				'condition' => array(
					'play_action_on' => array( 'autoplay', 'hover', 'click', 'column', 'section', 'mouseinout', 'mousescroll', 'viewport' ),
					'bm_end_custom'  => 'yes',
				),
			)
		);
		$this->add_control(
			'bm_start_end_note',
			array(
				'label'      => ( 'Note : You need to enter Custom Start Time and End Time from Lottiefiles Web Player. You need to use same format e.g. 30,239, 699 etc.' ),
				'type'       => Controls_Manager::HEADING,
				'condition'  => array(
					'play_action_on' => array( 'mouseinout', 'mousescroll' ),
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'bm_start_custom',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'bm_end_custom',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'tp_bm_link',
			array(
				'label'     => esc_html__( 'URL', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'false',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_bm_link_type',
			array(
				'label'     => esc_html__( 'Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'normal',
				'options'   => array(
					'normal'  => esc_html__( 'Normal', 'theplus' ),
					'dynamic' => esc_html__( 'Dynamic', 'theplus' ),
				),
				'condition' => array(
					'tp_bm_link' => 'yes',
				),
			)
		);
		$this->add_control(
			'tp_bm_link_url',
			array(
				'label'       => esc_html__( 'URL', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => '#',
				'condition'   => array(
					'tp_bm_link'      => 'yes',
					'tp_bm_link_type' => 'normal',
				),
			)
		);
		$this->add_control(
			'tp_bm_link_url_dynamic',
			array(
				'label'         => esc_html__( 'URL', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'dynamic'       => array(
					'active' => true,
				),
				'placeholder'   => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'condition'     => array(
					'tp_bm_link'      => 'yes',
					'tp_bm_link_type' => 'dynamic',
				),
			)
		);
		$this->add_control(
			'tp_bm_link_delay',
			array(
				'label'     => esc_html__( 'Click Delay', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 1000,
				),
				'condition' => array(
					'tp_bm_link' => 'yes',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_bm_link_delay_note',
			array(
				'label' => ( 'Note : We have added option of Delay in Click for Style “On Click”, You can add delay to finish your animation and after that link will be open.' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		/*
		$this->add_control(
			'autoplay_viewport',
			[
				'label' => esc_html__( 'Autoplay when in Viewport', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'theplus' ),
				'label_off' => esc_html__( 'OFF', 'theplus' ),
				'return_value' => 'true',
				'default' => 'false',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'autostop_viewport',
			[
				'label' => esc_html__( 'Autostop when out of Viewport', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'theplus' ),
				'label_off' => esc_html__( 'OFF', 'theplus' ),
				'return_value' => 'true',
				'default' => 'false',
				'separator' => 'before',
			]
		);*/
		$this->add_control(
			'tp_bm_head',
			array(
				'label'     => esc_html__( 'Animation Heading', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'false',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_bm_head_text',
			array(
				'label'       => esc_html__( 'Heading', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => esc_html__( 'Heading', 'theplus' ),
				'placeholder' => esc_html__( 'Type your heading here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'tp_bm_head' => 'yes',
				),
			)
		);
		$this->add_control(
			'tp_bm_description',
			array(
				'label'     => esc_html__( 'Animation Description', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'false',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tp_bm_description_text',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => esc_html__( 'Lorem Ipsum is simply dummy text for the LottieFiles Animation. ', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'tp_bm_description' => 'yes',
				),
			)
		);
		$this->add_control(
			'anim_renderer',
			array(
				'label'     => esc_html__( 'Animation Renderer', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'svg',
				'options'   => array(
					'svg'    => esc_html__( 'SVG', 'theplus' ),
					'canvas' => esc_html__( 'Canvas', 'theplus' ),
					'html'   => esc_html__( 'HTML', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_layout_option',
			array(
				'label' => esc_html__( 'Layout Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'content_align',
			array(
				'label'         => esc_html__( 'Alignment', 'theplus' ),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => array(
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
				'default'       => 'center',
				'prefix_ class' => 'text-%s',
				'separator'     => 'before',
			)
		);
		$this->add_responsive_control(
			'max_width',
			array(
				'label'       => esc_html__( 'Maximum Width', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 100,
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-bodymovin' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'minimum_height',
			array(
				'label'       => esc_html__( 'Minimum Height', 'theplus' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-bodymovin' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'bm_heading_style',
			array(
				'label'     => esc_html__( 'Heading Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tp_bm_head' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'bm_head_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-heading' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'bm_heading_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'bm_heading_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bm_heading_typography',
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-heading',
			)
		);
		$this->start_controls_tabs( 'bm_head_tabs' );
		$this->start_controls_tab(
			'bm_head_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'bm_heading_color',
			array(
				'label'     => esc_html__( 'Heading Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-heading' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bm_head_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'bm_heading_color_h',
			array(
				'label'     => esc_html__( 'Heading Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd:hover .theplus-bodymovin-heading' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'bm_description_style',
			array(
				'label'     => esc_html__( 'Description Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tp_bm_description' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'bm_description_align',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
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
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-description' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'bm_description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'bm_description_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bm_description_typography',
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-description',
			)
		);
		$this->start_controls_tabs( 'bm_desc_tabs' );
		$this->start_controls_tab(
			'bm_desc_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'bm_description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd .theplus-bodymovin-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bm_desc_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'bm_description_color_h',
			array(
				'label'     => esc_html__( 'Description Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd:hover .theplus-bodymovin-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_c_bg_style',
			array(
				'label'      => esc_html__( 'Content Background', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'tp_bm_head',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'tp_bm_description',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'bmc_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'bmc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->start_controls_tabs( 'bmc_tabs' );
		$this->start_controls_tab(
			'bmc_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bmc_bg',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'bmc_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-bodymovin-hd',
				'separator' => 'before',
			)
		);
			$this->add_responsive_control(
				'bmc_border_radius',
				array(
					'label'      => esc_html__( 'Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .theplus-bodymovin-hd' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'bmc_bg_shadow',
					'label'     => esc_html__( 'Box Shadow', 'theplus' ),
					'selector'  => '{{WRAPPER}} .theplus-bodymovin-hd',
					'separator' => 'before',
				)
			);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'bmc_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bmc_bg_h',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'bmc_border_h',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-bodymovin-hd:hover',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'bmc_border_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-bodymovin-hd:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'bmc_bg_shadow_h',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-bodymovin-hd:hover',
				'separator' => 'before',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label' => esc_html__( 'Lottie Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs( 'lottie__tabs' );
		$this->start_controls_tab(
			'lottie__normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'lottie__css_n',
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd,{{WRAPPER}} .pt-plus-bodymovin',
			)
		);
		$this->add_control(
			'lottie__opacity_n',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1,
				'step'      => 0.1,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd,{{WRAPPER}} .pt-plus-bodymovin' => 'opacity: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'lottie__transition',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Transition Duration', 'theplus' ),
				'range'     => array(
					'px' => array(
						'max'  => 5,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd,{{WRAPPER}} .pt-plus-bodymovin' => 'transition : {{SIZE}}s',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'lottie__hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'lottie__css_h',
				'selector' => '{{WRAPPER}} .theplus-bodymovin-hd:hover,{{WRAPPER}} .pt-plus-bodymovin:hover',
			)
		);
		$this->add_control(
			'lottie__opacity_h',
			array(
				'label'     => esc_html__( 'Opacity', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 1,
				'step'      => 0.1,
				'selectors' => array(
					'{{WRAPPER}} .theplus-bodymovin-hd:hover,{{WRAPPER}} .pt-plus-bodymovin:hover' => 'opacity: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

			include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';

		$this->start_controls_section(
			'section_plus_extra_adv',
			array(
				'label' => esc_html__( 'Plus Extras', 'theplus' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Json Validator.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 * @param array $data Json Decode.
	 */
	protected function tp_json_validator( $data = null ) {
		if ( ! empty( $data ) ) {
			@json_decode( $data );
			return ( json_last_error() === JSON_ERROR_NONE );
		}
		return false;
	}

	/**
	 * Render Bodymovin.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings   = $this->get_settings_for_display();
		$style_atts = '';
		$classes    = '';

		$bm_start_time = '';
		$bm_end_time   = '';

		$cust_ani_start = ! empty( $settings['bm_start_custom'] ) ? $settings['bm_start_custom'] : '';
		$ll_start_time  = ! empty( $settings['bm_start_time'] ) ? $settings['bm_start_time'] : 1;

		if ( 'yes' === $cust_ani_start ) {
			$bm_start_time = $ll_start_time;
		}

		if ( ! empty( $settings['bm_end_custom'] ) && 'yes' === $settings['bm_end_custom'] ) {
			$bm_end_time = ( '' !== $settings['bm_end_time'] ) ? $settings['bm_end_time'] : 100;
		}
		$bm_scrollbased      = ! empty( $settings['bm_scrollbased'] ) ? $settings['bm_scrollbased'] : 'bm_custom';
		$bm_section_duration = 500;

		if ( ! empty( $settings['bm_section_duration']['size'] ) ) {
			$bm_section_duration = $settings['bm_section_duration']['size'];
		}

		$bm_section_offset = 0;
		if ( ! empty( $settings['bm_section_offset']['size'] ) ) {
			$bm_section_offset = $settings['bm_section_offset']['size'];
		}

		$options = array();

		$anim_renderer = $settings['anim_renderer'];
		$content_align = $settings['content_align'];
		$loop          = ( ! empty( $settings['loop'] ) && 'true' === $settings['loop'] ) ? true : false;

		if ( ( ! empty( $settings['loop'] ) && 'true' === $settings['loop'] ) && ! empty( $settings['loop_time'] ) ) {
			$loop = $settings['loop_time'] - 1;
		}

		$max_width      = ! empty( $settings['max_width']['size'] ) ? $settings['max_width']['size'] . $settings['max_width']['unit'] : '100%';
		$minimum_height = ! empty( $settings['minimum_height']['size'] ) ? $settings['minimum_height']['size'] . $settings['minimum_height']['unit'] : '';
		$speed          = ! empty( $settings['speed'] ) ? $settings['speed'] : '0.5';

		$autoplay_viewport = false;
		$autostop_viewport = false;

		$lotti_play_on = ! empty( $settings['play_action_on'] ) ? $settings['play_action_on'] : 'autoplay';

		if ( 'viewport' === $lotti_play_on ) {
			$autoplay_viewport = true;
			$autostop_viewport = true;
		}

		$play_action_on = '';
		if ( ! empty( $lotti_play_on ) ) {
			$play_action_on = $lotti_play_on;
		}

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$id  = uniqid( 'movin' );
		$uid = uniqid();

		$options = array(
			'id'                  => $uid,
			'container_id'        => $id,
			'autoplay_viewport'   => $autoplay_viewport,
			'autostop_viewport'   => $autostop_viewport,
			'loop'                => $loop,
			'width'               => $max_width,
			'height'              => $minimum_height,
			'lazyload'            => false,
			'playSpeed'           => $speed,
			'play_action'         => $play_action_on,
			'bm_scrollbased'      => $bm_scrollbased,
			'bm_section_duration' => $bm_section_duration,
			'bm_section_offset'   => $bm_section_offset,
			'bm_start_time'       => $bm_start_time,
			'bm_end_time'         => $bm_end_time,
		);

		if ( ! empty( $settings['content_parse_json'] ) ) {
			$options['animation_data'] = $this->tp_json_validator( $settings['content_parse_json'] ) ? $settings['content_parse_json'] : 'Invalid';
		}

		if ( ! empty( $settings['content_parse_json_url']['url'] ) ) {
			$ext = pathinfo( $settings['content_parse_json_url']['url'], PATHINFO_EXTENSION );
			if ( 'json' !== $ext ) {
				echo '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
				return false;
			} else {
				$get_json        = wp_remote_get( $settings['content_parse_json_url']['url'] );
				$url_status_code = wp_remote_retrieve_response_code( $get_json );
				if ( 200 === $url_status_code ) {
					$json_code                 = wp_remote_retrieve_body( $get_json );
					$options['animation_data'] = $this->tp_json_validator( $json_code ) ? $json_code : 'Invalid';
				}
			}
		}

		if ( ! empty( $settings['content_parse_json_file']['url'] ) ) {
			$ext = pathinfo( $settings['content_parse_json_file']['url'], PATHINFO_EXTENSION );
			if ( 'json' !== $ext ) {
				echo '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
				return false;
			} else {
				$get_json        = wp_remote_get( $settings['content_parse_json_file']['url'] );
				$url_status_code = wp_remote_retrieve_response_code( $get_json );
				if ( 200 === $url_status_code ) {
					$json_code                 = wp_remote_retrieve_body( $get_json );
					$options['animation_data'] = $this->tp_json_validator( $json_code ) ? $json_code : 'Invalid';
				}
			}
		}

		if ( ! isset( $options['autoplay_onload'] ) ) {
			$options['autoplay_onload'] = true;
		}
		if ( $settings['anim_renderer'] ) {
			$options['renderer'] = esc_attr( $settings['anim_renderer'] );
		}

		if ( $content_align ) {
			$classes .= ' align-' . $content_align;
		}
		if ( ! empty( $anim_renderer ) ) {
			$classes .= ' renderer-' . $anim_renderer;
		}

		if ( ! empty( $anim_renderer ) && 'html' === $anim_renderer ) {
			$style_atts .= 'position: relative;';
		}
		if ( ! empty( $content_align ) && 'right' === $content_align ) {
			$style_atts .= 'margin-left: auto;';
		} elseif ( ! empty( $content_align ) && 'center' === $content_align ) {
			$style_atts .= 'margin-right: auto;';
			$style_atts .= 'margin-left: auto;';
		}

		$settings_opt = '';
		$ani_heading  = ! empty( $settings['tp_bm_head'] ) ? $settings['tp_bm_head'] : '';
		$ani_desc     = ! empty( $settings['tp_bm_description'] ) ? $settings['tp_bm_description'] : '';
		$e_popup      = ! empty( $settings['popup'] ) ? $settings['popup'] : '';

		if ( ! empty( $settings['content_parse_json'] ) || ! empty( $settings['content_parse_json_url']['url'] ) || ! empty( $settings['content_parse_json_file']['url'] ) ) {
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || 'yes' === $e_popup ) {
				if ( ( ! empty( $settings['bm_load_backend'] ) && 'yes' === $settings['bm_load_backend'] ) || 'yes' === $e_popup ) {
					$settings_opt  = 'data-settings=\'' . htmlspecialchars( wp_json_encode( $options ), ENT_QUOTES, 'UTF-8' ) . '\'';
					$settings_opt .= 'data-editor-load="yes"';

					if ( 'yes' === $e_popup ) {
						$settings_opt .= 'data-popup-load="yes"';
					}
					$theplus_conn_opt = get_option( 'theplus_api_connection_data' );

					if ( ! empty( $theplus_conn_opt ) && ! array_key_exists( 'bodymovin_load_js_check', $theplus_conn_opt ) ) {
						echo '<h3 class="theplus-posts-not-found">' . esc_html__( "Make sure, Your Backend load is enabled from 'ThePlus Addons Settings -> Extra Options' as well.", 'theplus' ) . '</h3>';
					}
					if ( 'yes' === $e_popup ) {
						wp_enqueue_script( 'theplus-bodymovin' );
					}
				} else {
					$settings_opt  = 'data-editor-load="no"';
					$settings_opt .= 'data-popup-load="no"';
				}
			} else {
				wp_enqueue_script( 'theplus-bodymovin' );
			}

			$this->render_text( $options );

			$output = '';

			$tp_bm_url = ! empty( $settings['tp_bm_link'] ) ? $settings['tp_bm_link'] : '';

			if ( 'yes' === $tp_bm_url && ( ( ! empty( $settings['tp_bm_link_url'] ) ) || ( ! empty( $settings['tp_bm_link_url_dynamic']['url'] ) ) ) && ! empty( $settings['tp_bm_link_delay'] ) ) {

				if ( ! empty( $settings['tp_bm_link_url_dynamic']['url'] ) ) {
					$this->add_link_attributes( 'buttondynamic', $settings['tp_bm_link_url_dynamic'] );
					$this->add_render_attribute( 'buttondynamic', 'class', 'theplus-bodymovin-link' );
					$output .= '<a ' . $this->get_render_attribute_string( 'buttondynamic' ) . '>';
				} else {
					$inline_bm_delay_js = '(function($){
						"use strict";
							$( document ).ready(function() {
								$("a.theplus-bodymovin-link").click(function (e) {
								e.preventDefault();
								var storeurl = this.getAttribute("href");
								setTimeout(function(){
									 window.location = storeurl;
								}, ' . esc_attr( $settings['tp_bm_link_delay']['size'] ) . ');
							}); 
						});
					})(jQuery);';

					$output .= wp_print_inline_script_tag( $inline_bm_delay_js );
					$output .= '<a class="theplus-bodymovin-link" href="' . esc_url( $settings['tp_bm_link_url'] ) . '">';
				}
			}

			if ( 'yes' === $ani_heading || 'yes' === $ani_desc ) {
				$lz1     = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['bmc_bg_image'], $settings['bmc_bg_h_image'] ) : '';
				$output .= '<div class="theplus-bodymovin-hd ' . esc_attr( $lz1 ) . '">';
			}

			$output .= '<div id="' . esc_attr( $id ) . '" class="pt-plus-bodymovin ' . esc_attr( $classes ) . ' ' . esc_attr( $animated_class ) . '" ' . $animation_attr . ' style="' . esc_attr( $style_atts ) . '" ' . $settings_opt . '>';
			$output .= '</div>';

			if ( 'yes' === $ani_heading || 'yes' === $ani_desc ) {

				$lotti_title = ! empty( $settings['tp_bm_head_text'] ) ? $settings['tp_bm_head_text'] : '';
				$lotti_desc  = ! empty( $settings['tp_bm_description_text'] ) ? $settings['tp_bm_description_text'] : '';

				if ( 'yes' === $ani_heading ) {

					$output .= '<div class="theplus-bodymovin-heading">' . wp_kses_post( $lotti_title ) . '</div>';
				}

				if ( 'yes' === $ani_desc ) {
					$output .= '<div class="theplus-bodymovin-description">' . wp_kses_post( $lotti_desc ) . '</div>';
				}

				$output .= '</div>';
			}

			if ( 'yes' === $tp_bm_url ) {
				$output .= '</a>';
			}
		} else {
			$output = '<h3 class="theplus-posts-not-found">' . esc_html__( 'JSON Parse Not Working', 'theplus' ) . '</h3>';
		}

		echo $before_content . $output . $after_content;
		if ( 'yes' === $ani_heading || 'yes' === $ani_desc ) {
			echo '<style>.theplus-bodymovin-hd{position: relative;display: block;width: 100%;-webkit-transition:all 0.5s linear;moz-transition:all 0.5s linear;-o-transition:all 0.5s linear;-ms-transition:all 0.5s linear;transition:all 0.5s linear;overflow:hidden}.theplus-bodymovin-hd .theplus-bodymovin-heading,.theplus-bodymovin-hd .theplus-bodymovin-description {position: relative;display: block;width: 100%;}.theplus-bodymovin-hd .theplus-bodymovin-heading {margin-bottom: 15px;}</style>';
		}
	}

	/**
	 * Render Text Bodymovin.
	 *
	 * @since 2.0.0
	 * @version 5.4.2
	 * @param array $options Optional. Additional options for rendering the text.
	 */
	protected function render_text( $options = array() ) {
		$settings = $this->get_settings_for_display();

		if ( $options ) {
			\tp_wp_bodymovin::plus_addAnimation( $options );
		} else {
			return;
		}
	}
}
