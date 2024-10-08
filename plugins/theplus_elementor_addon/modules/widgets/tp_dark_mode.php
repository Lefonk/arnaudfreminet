<?php
/**
 * Widget Name: Dark Mode
 * Description: Dark Mode.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Settings\Manager as SettingsManager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Dark_Mode
 */
class ThePlus_Dark_Mode extends Widget_Base {

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
	 */
	public function get_name() {
		return 'tp-dark-mode';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Dark Mode', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-adjust theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return array( 'Dark mode', 'Night mode', 'Dark theme', 'Night theme', 'Dark widget', 'Night widget', 'Elementor dark mode', 'Elementor night mode' );
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
	 * @version 5.3.4
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Dark Mode', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'dm_type',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Type', 'theplus' ),
				'default' => 'dm_type_mb',
				'options' => array(
					'dm_type_mb' => esc_html__( 'Mix Blend', 'theplus' ),
					'dm_type_gc' => esc_html__( 'Global Color', 'theplus' ),

				),
			)
		);
		$this->add_control(
			'how_it_works_mixblend',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "mix-blend-dark-mode-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'dm_type' => array( 'dm_type_mb' ),
				),
			)
		);
		$this->add_control(
			'dm_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Style', 'theplus' ),
				'default' => 'tp_dm_style2',
				'options' => array(
					'tp_dm_style2' => esc_html__( 'Style 1', 'theplus' ),
					'tp_dm_style1' => esc_html__( 'Style 2', 'theplus' ),

				),
			)
		);
		$this->add_control(
			'dm_backgroundcolor_activate',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'condition' => array(
					'dm_type!' => 'dm_type_gc',
				),
			)
		);
		$this->add_control(
			'dm_mix_blend_mode',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Mix Blend Mode', 'theplus' ),
				'default'   => 'difference',
				'options'   => array(
					'difference'  => esc_html__( 'Difference', 'theplus' ),
					'multiply'    => esc_html__( 'multiply', 'theplus' ),
					'screen'      => esc_html__( 'screen', 'theplus' ),
					'overlay'     => esc_html__( 'overlay', 'theplus' ),
					'darken'      => esc_html__( 'darken', 'theplus' ),
					'lighten'     => esc_html__( 'lighten', 'theplus' ),
					'color-dodge' => esc_html__( 'color-dodge', 'theplus' ),
					'color-burn'  => esc_html__( 'color-burn', 'theplus' ),
					'exclusion'   => esc_html__( 'exclusion', 'theplus' ),
					'hue'         => esc_html__( 'hue', 'theplus' ),
					'saturation'  => esc_html__( 'saturation', 'theplus' ),
				),
				'condition' => array(
					'dm_type!' => 'dm_type_gc',
					'dm_style' => 'tp_dm_style2',
				),
				'selectors' => array(
					'body .darkmode-layer' => 'mix-blend-mode: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'dm_time',
			array(
				'label'     => esc_html__( 'Animation Time', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'separator' => 'before',
				'condition' => array(
					'dm_type!' => 'dm_type_gc',
					'dm_style' => 'tp_dm_style1',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_position_option',
			array(
				'label' => esc_html__( 'Position', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'dm_right',
			array(
				'label'     => esc_html__( 'Right Offset', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'dm_right_offset',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Right', 'theplus' ),
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'.elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'right: {{SIZE}}{{UNIT}};',
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 45,
				),
				'condition'  => array(
					'dm_right' => 'yes',
				),
			)
		);
		$this->add_control(
			'dm_bottom',
			array(
				'label'     => esc_html__( 'Bottom Offset', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'dm_bottom_offset',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Bottom', 'theplus' ),
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 32,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 150,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'.elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'dm_bottom' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_global_color_option',
			array(
				'label'     => esc_html__( 'Global Color', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'dm_type' => 'dm_type_gc',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_label',
			array(
				'label'   => esc_html__( 'Label', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Label', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'loop_color',
			array(
				'label' => esc_html__( 'Color', 'theplus' ),
				'type'  => Controls_Manager::COLOR,
			)
		);
		$this->add_control(
			'loop_content',
			array(
				'label'       => esc_html__( 'Global Color', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'loop_label' => 'primary',
					),
					array(
						'loop_label' => 'secondary',
					),
					array(
						'loop_label' => 'text',
					),
					array(
						'loop_label' => 'accent',
					),
				),
				'separator'   => 'before',
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ loop_label }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_extra_option',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'dm_save_in_cookies',
			array(
				'label'       => esc_html__( 'Save in Cookies', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'description' => esc_html__( 'If enabled, It will remember choice of user and load accordingly on next website visit.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'dm_auto_match_os_theme',
			array(
				'label'       => esc_html__( 'Auto Match OS Theme', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'yes',
				'description' => esc_html__( 'If enabled, It will automatically apply based on Mode of Visitor device settings.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'dm_ignore_class',
			array(
				'label'     => wp_kses_post( "Ignore Dark Mode <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "exclude-elements-from-dark-mode-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'dm_ignore',
			array(
				'label'       => __( 'Ignore Dark Mode Classes', 'theplus' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'placeholder' => __( 'Enter All Classes with Comma to ignore those in Dark Mode', 'theplus' ),
				'condition'   => array(
					'dm_ignore_class' => 'yes',
				),
			)
		);
		$this->add_control(
			'dm_ignore_pre_class',
			array(
				'label'     => esc_html__( 'The Plus Ignore Class Default', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'true',
				'condition' => array(
					'dm_ignore_class' => 'yes',
				),
			)
		);
		$this->add_control(
			'dm_ignore_pre_class_note',
			array(
				'label'     => ( 'Note : You can Ignore classes you want from Dark Mode using above options.' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'dm_ignore_class' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_styling',
			array(
				'label'     => esc_html__( 'Switcher', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dm_style!' => 'tp_dm_style1',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_overall_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Switcher Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 10,
						'max'  => 50,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle' => 'width: calc(10px + {{SIZE}}{{UNIT}}) !important;height: calc(-20px + {{SIZE}}{{UNIT}}) !important;',
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider:before' => 'height: calc(26px + {{SIZE}}{{UNIT}}) !important;width: calc(26px + {{SIZE}}{{UNIT}}) !important;',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_overall_size_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Switcher Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 10,
						'max'  => 50,
						'step' => 1,
					),
				),
				'separator'   => 'before',
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle' => 'height: {{SIZE}}{{UNIT}} !important;',
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider:before' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_dot_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Dot Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider:before' => 'height: {{SIZE}}{{UNIT}} !important;width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_dot_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Dot Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider:before' => 'left: -{{SIZE}}{{UNIT}} !important;',
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-checkbox:checked + .tp-dark-mode-slider:before' => 'transform: translateX(calc(26px + {{SIZE}}{{UNIT}}))translateY(-50%) !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_si_style' );
		$this->start_controls_tab(
			'tab_si_normal',
			array(
				'label' => esc_html__( 'Light', 'theplus' ),
			)
		);
		$this->add_control(
			'si_normal_dot',
			array(
				'label' => esc_html__( 'Dot Background', 'theplus' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'si_normal_dot_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider:before',
			)
		);
		$this->add_control(
			'si_normal_switch',
			array(
				'label'     => esc_html__( 'Switcher Background', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'si_normal_switch_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'si_switch_n_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider',
			)
		);
		$this->add_control(
			'si_switch_normal_border_color',
			array(
				'label'     => esc_html__( 'Box Shadow color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-slider' => 'box-shadow:0 0 1px {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_si_active',
			array(
				'label' => esc_html__( 'Dark', 'theplus' ),
			)
		);
		$this->add_control(
			'si_active_dot',
			array(
				'label' => esc_html__( 'Dot Background', 'theplus' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'si_active_dot_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp_dm_style2.darkmode--activated .darkmode-toggle .tp-dark-mode-slider:before',
			)
		);
		$this->add_control(
			'si_active_switch',
			array(
				'label'     => esc_html__( 'Switcher Background', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'si_switch_active_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '.tp_dm_style2.darkmode--activated .darkmode-toggle .tp-dark-mode-slider',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'si_switch_active_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.tp_dm_style2.darkmode--activated .darkmode-toggle .tp-dark-mode-slider',
			)
		);
		$this->add_control(
			'si_switch_active_border_color_n',
			array(
				'label'     => esc_html__( 'Box Shadow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp_dm_style2 .darkmode-toggle .tp-dark-mode-checkbox:focus + .tp-dark-mode-slider' => 'box-shadow:0 0 1px {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_st2_styling',
			array(
				'label'     => esc_html__( 'Switcher', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dm_style' => 'tp_dm_style1',
				),
			)
		);
		$this->add_responsive_control(
			'st2_size_d',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'.darkmode-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'st2_bg_size_d',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Background Size', 'theplus' ),
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
					'.darkmode-toggle, .darkmode-layer:not(.darkmode-layer--expanded)' => 'height: {{SIZE}}{{UNIT}} !important;width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_si2_style' );
		$this->start_controls_tab(
			'tab_si2_light',
			array(
				'label' => esc_html__( 'Light', 'theplus' ),
			)
		);
		$this->add_control(
			'st2_bg',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'.darkmode-toggle' => 'background-color: {{VALUE}} !important',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'st2_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.darkmode-toggle',
			)
		);
		$this->add_responsive_control(
			'st2_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.darkmode-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'st2_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.darkmode-toggle',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_si2_dark',
			array(
				'label' => esc_html__( 'Dark', 'theplus' ),
			)
		);
		$this->add_control(
			'st2_bg_d',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'.darkmode-toggle.darkmode-toggle--white' => 'background-color: {{VALUE}} !important',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'st2_border_d',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '.darkmode-toggle.darkmode-toggle--white',
			)
		);
		$this->add_responsive_control(
			'st2_br_d',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'.darkmode-toggle.darkmode-toggle--white' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'st2_shadow_d',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '.darkmode-toggle.darkmode-toggle--white',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_text_styling',
			array(
				'label'     => esc_html__( 'Switcher Text', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'dm_style!' => 'tp_dm_style1',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_s_b_a_style' );
		$this->start_controls_tab(
			'tab_s_b_a_before',
			array(
				'label' => esc_html__( 'Before', 'theplus' ),
			)
		);
		$this->add_control(
			'switcher_before_text',
			array(
				'label'       => esc_html__( 'Switcher Before Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => __( 'Normal', 'theplus' ),
				'placeholder' => esc_html__( 'Before Text', 'theplus' ),
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle:before' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_before_text_offset',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Offset', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -200,
						'max'  => 0,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -65,
				),
				'selectors'  => array(
					'.tp_dm_style2 .darkmode-toggle:before' => 'left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_s_b_a_after',
			array(
				'label' => esc_html__( 'After', 'theplus' ),
			)
		);
		$this->add_control(
			'switcher_after_text',
			array(
				'label'       => esc_html__( 'Switcher After Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => __( 'Dark', 'theplus' ),
				'placeholder' => esc_html__( 'After Text', 'theplus' ),
				'selectors'   => array(
					'.tp_dm_style2 .darkmode-toggle:after' => ' content:"{{VALUE}}";',
				),
			)
		);
		$this->add_responsive_control(
			'switcher_after_text_offset',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Offset', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -200,
						'max'  => 0,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => -45,
				),
				'selectors'  => array(
					'.tp_dm_style2 .darkmode-toggle:after' => 'right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'switcher_b_a_text_typ',
				'selector' => '.tp_dm_style2 .darkmode-toggle:before,.tp_dm_style2 .darkmode-toggle:after',
			)
		);
		$this->add_control(
			'switcher_b_a_text_typ_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'.tp_dm_style2 .darkmode-toggle:before,.tp_dm_style2 .darkmode-toggle:after' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Progress Bar
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 * @version 5.3.4
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$loop_content = ! empty( $settings['loop_content'] ) ? $settings['loop_content'] : '';

		$dm_type = ! empty( $settings['dm_type'] ) ? $settings['dm_type'] : 'dm_type_mb';

		if ( 'dm_type_gc' === $dm_type ) {
			$kit   = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
			$kitid = $kit->get_id();

			if ( ! empty( intval( $kitid ) ) ) {
				$system_items = $kit->get_settings_for_display( 'system_colors' );
				$custom_items = $kit->get_settings_for_display( 'custom_colors' );

				if ( ! $system_items ) {
					$system_items = array();
				}

				if ( ! $custom_items ) {
					$custom_items = array();
				}

				$items = array_merge( $system_items, $custom_items );
				$index = 0;

				$itemsname = array();
				foreach ( $items as $index => $item11 ) {
					$itemsname[] = $item11['_id'];
				}

				$itemscolor = array();
				foreach ( $loop_content as $index => $item ) {
					if ( ! empty( $item['loop_color'] ) ) {
						$itemscolor[] = $item['loop_color'];
					}

					++$index;
				}

				$firstarray  = array_values( $itemsname );
				$secondarray = array_values( $itemscolor );
				if ( isset( $firstarray ) && ! empty( $firstarray ) && isset( $secondarray ) && ! empty( $secondarray ) ) {
					echo '<style>.darkmode-background,.darkmode-layer{background:transparent !important;}.elementor-kit-' . intval( $kitid ) . '.darkmode--activated{';

					foreach ( $firstarray as $index => $item1 ) {
						if ( ! empty( $item1 ) && isset( $secondarray[ $index ] ) && ! empty( $secondarray[ $index ] ) ) {
							echo '--e-global-color-' . $item1 . ' : ' . $secondarray[ $index ] . ';';
						}
					}

					echo '}</style>';
				}
			}
		}

		$dm_style  = ! empty( $settings['dm_style'] ) ? $settings['dm_style'] : 'tp_dm_style2';
		$dm_time   = ! empty( $settings['dm_time'] ) ? $settings['dm_time'] : '5';
		$dm_ingnor = ! empty( $settings['dm_ignore'] ) ? $settings['dm_ignore'] : '';

		$dm_save_in_cookies = ! empty( $settings['dm_save_in_cookies'] ) ? 'true' : 'false';
		$dm_backgroundcolor = ! empty( $settings['dm_backgroundcolor_activate'] ) ? $settings['dm_backgroundcolor_activate'] : '#fff';

		$dm_auto_match_os_theme = ! empty( $settings['dm_auto_match_os_theme'] ) ? 'true' : 'false';

		$ignore_class = ! empty( $settings['dm_ignore_pre_class'] ) ? $settings['dm_ignore_pre_class'] : '';

		echo '<div class="tp-dark-mode-wrapper" data-time="0.' . esc_attr( $dm_time ) . 's" data-dm_mixcolor="#fff" data-bgcolor="' . esc_attr( $dm_backgroundcolor ) . '" data-save-cookies="' . esc_attr( $dm_save_in_cookies ) . '" data-auto-match-os-theme="' . esc_attr( $dm_auto_match_os_theme ) . '" data-style="' . esc_attr( $dm_style ) . '">';

		$dm_ignore_js = '';
		if ( ! empty( $dm_ingnor ) ) {
			$dm_ignore_js = 'jQuery(document).ready(function() { jQuery( "' . esc_js( $settings['dm_ignore'] ) . '" ).addClass( "theplus-darkmode-ignore" ); });';
			echo wp_print_inline_script_tag( $dm_ignore_js );
		}

		$dm_ignore_pre_class_js = '';
		if ( 'yes' === ! empty( $ignore_class ) ) {
			$dm_ignore_pre_class_js = 'jQuery(document).ready(function() { jQuery( ".theplus-hotspot,.pt-plus-animated-image-wrapper .pt_plus_animated_image,.elementor-image img,.elementor-widget-image img,.elementor-image, .animated-image-parallax,.pt_plus_before_after,.pt_plus_animated_image,.team-list-content .post-content-image,.product-list .product-content-image,.gallery-list .gallery-list-content,.bss-list,.blog-list.list-isotope-metro,.blog-list .post-content-image,.blog-list-content:hover .post-content-image,.blog-list.blog-style-1 .grid-item" ).addClass( "theplus-darkmode-ignore" ); });';
			echo wp_print_inline_script_tag( $dm_ignore_pre_class_js );
		}

		echo '</div>';
	}
}
