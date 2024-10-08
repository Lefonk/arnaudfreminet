<?php
/**
 * Widget Name: Switcher
 * Description: Content of toggle switcher.
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
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Switcher.
 */
class ThePlus_Switcher extends Widget_Base {

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
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-switcher';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Switcher', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-toggle-on theplus_backend_icon';
	}

	/**
	 * Get Custom url.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-tabbed' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Switcher', 'Elementor switcher', 'switcher', 'switcher addon', 'switcher plugin', 'switcher elementor addon', 'switcher', 'switcher plus addons', 'switcher plus addons for elementor', 'switcher the plus addons for elementor' );
	}

	/**
	 * Get Custom url.
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
			'content_one_section',
			array(
				'label' => esc_html__( 'Content 1', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'switch_a_title',
			array(
				'label'   => esc_html__( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Switch A', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'content_a_source',
			array(
				'label'   => esc_html__( 'Select Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => array(
					'content'  => esc_html__( 'Custom Content', 'theplus' ),
					'template' => esc_html__( 'Template', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'content_a_desc',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'content_a_source' => array( 'content' ),
				),
			)
		);
		$this->add_control(
			'content_template_type',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dropdown',
				'options'   => array(
					'dropdown' => esc_html__( 'Template', 'theplus' ),
					'manually' => esc_html__( 'Shortcode', 'theplus' ),
				),
				'condition' => array(
					'content_a_source' => 'template',
				),
			)
		);
		$this->add_control(
			'content_a_template',
			array(
				'label'       => wp_kses_post( "Elementor Templates <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "pricing-table-in-elementor-switcher/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'content_a_source'      => 'template',
					'content_template_type' => 'dropdown',
				),
			)
		);
		$this->add_control(
			'content_template_id',
			array(
				'label'       => esc_html__( 'Enter Elementor Template Shortcode', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_a_source'      => 'template',
					'content_template_type' => 'manually',
				),
			)
		);
		$this->add_control(
			'switch_a_icon',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$this->add_control(
			'con1_hashid',
			array(
				'label'       => wp_kses_post( "Unique ID<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "anchor-link-to-elementor-switcher-template/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'title'       => __( 'Add custom ID WITHOUT the Pound key. e.g: tab-id', 'theplus' ),
				'description' => 'Note : Use this option to give anchor id to individual switcher.',
				'label_block' => false,
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_b_section',
			array(
				'label' => esc_html__( 'Content 2', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'switch_b_title',
			array(
				'label'   => esc_html__( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Switch B', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'content_b_source',
			array(
				'label'   => esc_html__( 'Select Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => array(
					'content'  => esc_html__( 'Custom Content', 'theplus' ),
					'template' => esc_html__( 'Template', 'theplus' ),
				),
			)
		);

		$this->add_control(
			'content_b_desc',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'content_b_source' => array( 'content' ),
				),
			)
		);
		$this->add_control(
			'content_b_template_type',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dropdown',
				'options'   => array(
					'dropdown' => esc_html__( 'Template', 'theplus' ),
					'manually' => esc_html__( 'Shortcode', 'theplus' ),
				),
				'condition' => array(
					'content_b_source' => 'template',
				),
			)
		);
		$this->add_control(
			'content_b_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'content_b_source'        => 'template',
					'content_b_template_type' => 'dropdown',
				),
			)
		);
		$this->add_control(
			'content_b_template_id',
			array(
				'label'       => esc_html__( 'Enter Elementor Template Shortcode', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_b_source'        => 'template',
					'content_b_template_type' => 'manually',
				),
			)
		);
		$this->add_control(
			'switch_b_icon',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$this->add_control(
			'con2_hashid',
			array(
				'label'       => esc_html__( 'Unique ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'title'       => __( 'Add custom ID WITHOUT the Pound key. e.g: tab-id', 'theplus' ),
				'description' => 'Note : Use this option to give anchor id to individual switcher.',
				'label_block' => false,
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_switcher_section',
			array(
				'label' => esc_html__( 'Switch/Toggle', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'switcher_unique_id',
			array(
				'label'       => wp_kses_post( "Unique Switcher ID <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "connect-carousel-remote-with-elementor-switcher/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'after',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for switcher which you can use with "Carousel Remote" widget.', 'theplus' ),
			)
		);
		$this->add_control(
			'show_switcher_button',
			array(
				'label'        => esc_html__( 'Display Switcher Toggle', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'show_switcher_label',
			array(
				'label'        => esc_html__( 'Switcher Label', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'theplus' ),
				'label_off'    => esc_html__( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'switcher_style',
			array(
				'label'   => esc_html__( 'Switcher Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'show_tooltip',
			array(
				'label'     => esc_html__( 'Tooltip', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'switcher_style!' => 'style-4',
				),
			)
		);
		$this->add_control(
			'tooltip_con_1',
			array(
				'label'     => esc_html__( 'Content 1', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Switch A', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'switcher_style!' => 'style-4',
					'show_tooltip'    => 'yes',
				),
			)
		);
		$this->add_control(
			'tooltip_con_2',
			array(
				'label'     => esc_html__( 'Content 2', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Switch B', 'theplus' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'switcher_style!' => 'style-4',
					'show_tooltip'    => 'yes',
				),
			)
		);
		$this->add_control(
			'switcher_title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h5',
				'options'   => theplus_get_tags_options(),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'switch-align',
			array(
				'label'   => esc_html__( 'Alignment', 'theplus' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
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
				'default' => 'center',
				'toggle'  => true,
			)
		);
		$this->add_control(
			'switch_label_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Label Spacing', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-switcher .switch-1' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-switcher  .switch-2' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'switcher_style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'switch_toggle_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Switch/Toggle Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 14,
				),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-switcher .switcher-button' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'switcher_style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->add_control(
			'switch_4_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Switch Max-Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 280,
				),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 2,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.style-3,{{WRAPPER}} .theplus-switcher .switcher-toggle.style-4' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'switcher_style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_styling',
			array(
				'label' => esc_html__( 'Switcher Cosmetics', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'switch_color',
			array(
				'label'     => esc_html__( 'Switch Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .switch-slider.style-1:before,{{WRAPPER}} .switch-slider.style-2:before' => 'background:{{VALUE}};',
				),
				'condition' => array(
					'switcher_style!' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_switcher_style' );
		$this->start_controls_tab(
			'tab_normal_switcher',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'normal_bg_color',
			array(
				'label'     => esc_html__( 'Toggle Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .switcher-toggle.style-4' => 'background:{{VALUE}};',
				),
				'condition' => array(
					'switcher_style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'normal_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'normal_label_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'normal_label_bg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'normal_label_border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->add_responsive_control(
			'normal_label_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'normal_label_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_active_switcher',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'active_bg_color',
			array(
				'label'     => esc_html__( 'Toggle Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f0112b',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle:checked + .switch-slider,{{WRAPPER}} .switcher-toggle.style-4:before' => 'background:{{VALUE}};',
				),
				'condition' => array(
					'switcher_style!' => 'style-3',
				),
			)
		);
		$this->add_control(
			'active_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'separator' => 'after',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'normal_label_padding_a',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'normal_label_bg_a',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'normal_label_border_a',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->add_responsive_control(
			'normal_label_br_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'normal_label_shadow_a',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .switch-toggle + .switch-slider,{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'switch_box_shadow',
				'label'     => esc_html__( 'Toggle Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-switcher .switch-slider.style-1:before,{{WRAPPER}} .theplus-switcher .switch-slider.style-2:before,{{WRAPPER}}  .theplus-switcher .switcher-toggle.style-4',
				'condition' => array(
					'switcher_style!' => 'style-3',
				),
			)
		);
		$this->add_responsive_control(
			'label_max_width',
			array(
				'label'      => esc_html__( 'Label Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 250,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switch-label-text' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_control(
			'label_word_break',
			array(
				'label'     => esc_html__( 'Word Break', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'keep-all',
				'options'   => array(
					'keep-all'  => esc_html__( 'keep-all', 'theplus' ),
					'break-all' => esc_html__( 'break-all', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-switcher .switch-label-text' => 'word-break: {{VALUE}};text-align:center;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_typography_styling',
			array(
				'label' => esc_html__( 'Switcher Typography', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'typho_a_label',
				'label'     => esc_html__( 'Label 1 Typography', 'theplus' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .theplus-switcher .switch-label-text.switch-label-1',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typho_b_label',
				'label'    => esc_html__( 'Label 2 Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-switcher .switch-label-text.switch-label-2',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_icon_styling',
			array(
				'label' => esc_html__( 'Switcher Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'switcher_iconsize',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switch-label-text i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-switcher .switch-label-text svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'switcher_iconA_gap',
			array(
				'label'      => esc_html__( 'Content 1 Icon Gap', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switch-label-1 i,{{WRAPPER}} .theplus-switcher .switch-label-1 svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'switcher_iconB_gap',
			array(
				'label'      => esc_html__( 'Content 2 Icon Gap', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switch-label-2 i,{{WRAPPER}} .theplus-switcher .switch-label-2 svg' => 'margin-right:{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_switcher_icons' );
		$this->start_controls_tab(
			'tab_normal_icons',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'normal_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider i' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2 i,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1 i,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text i' => 'color:{{VALUE}};',
					'{{WRAPPER}} .switch-toggle + .switch-slider svg' => 'fill:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2 svg,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1 svg,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text svg' => 'fill:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_active_icons',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'active_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .switch-toggle + .switch-slider i' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1 i,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2 i,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text i' => 'color:{{VALUE}};',
					'{{WRAPPER}} .switch-toggle + .switch-slider svg' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1 svg,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2 svg,{{WRAPPER}} .switcher-toggle.style-4 .switch-label-text svg' => 'color:{{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_underline_styling',
			array(
				'label'     => esc_html__( 'Switcher Underline', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style' => 'style-3',
				),
			)
		);
		$this->add_control(
			'underline_color',
			array(
				'label'     => esc_html__( 'Underline Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.style-3 .st-pricing-underlines .st-pricing-underlines-2' => 'background: linear-gradient(to right,rgba(0,227,246,.04) 0%,{{VALUE}} 50%,rgba(255,255,255,.1) 100%)',
				),
			)
		);
		$this->add_control(
			'line_bottom_offset',
			array(
				'label'      => esc_html__( 'Bottom Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 70,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.style-3 .st-pricing-underlines .st-pricing-underlines-2' => 'bottom: -{{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'underline_height',
			array(
				'label'      => esc_html__( 'Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.style-3 .st-pricing-underlines-2' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'content_underline_position',
			array(
				'label'     => esc_html__( 'Content Position', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_underline_position' );
		$this->start_controls_tab(
			'tab_underline_content_1',
			array(
				'label' => esc_html__( 'Content 1', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'underline_pos_content1',
			array(
				'label'      => esc_html__( 'Position', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .fieldset .switcher-toggle.style-3.inactive .st-pricing-underlines-2' => 'left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_underline_content_2',
			array(
				'label' => esc_html__( 'Content 2', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'underline_pos_content2',
			array(
				'label'      => esc_html__( 'Position', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-switcher .fieldset .switcher-toggle.style-3.active .st-pricing-underlines-2' => 'left: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_1_tt_styling',
			array(
				'label'     => esc_html__( 'Content 1 Tooltip', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style!' => 'style-4',
					'show_tooltip'    => 'yes',
					'tooltip_con_1!'  => '',
				),
			)
		);
		$this->add_responsive_control(
			'tt1Padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tt1Typo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1',
			)
		);
		$this->add_responsive_control(
			'tt1Left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'tt1top',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tt1' );
		$this->start_controls_tab(
			'tab_tt1_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tt1Color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'tt1Arrow',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1:after' => 'border-color:{{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_control(
			'tt1Bg',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'background:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tt1Border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1',
			)
		);
		$this->add_responsive_control(
			'tt1Br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tt1Shadow',
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-1 .tp-switch-tooltip1',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tt1_a',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'tt1ColorA',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'tt1ArrowA',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1:after' => 'border-color:{{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_control(
			'tt1BgA',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1' => 'background:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tt1BorderA',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1',
			)
		);
		$this->add_responsive_control(
			'tt1BrA',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tt1ShadowA',
				'selector' => '{{WRAPPER}} .switcher-toggle.active .switch-1 .tp-switch-tooltip1',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_2_tt_styling',
			array(
				'label'     => esc_html__( 'Content 2 Tooltip', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'switcher_style!' => 'style-4',
					'show_tooltip'    => 'yes',
					'tooltip_con_2!'  => '',
				),
			)
		);
		$this->add_responsive_control(
			'tt2Padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tt2Typo',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2',
			)
		);
		$this->add_responsive_control(
			'tt2Left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'tt2top',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -200,
						'max'  => 200,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_tt2' );
		$this->start_controls_tab(
			'tab_tt2_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'tt2Color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'tt2Arrow',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2:after' => 'border-color:{{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_control(
			'tt2Bg',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'background:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tt2Border',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2',
			)
		);
		$this->add_responsive_control(
			'tt2Br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tt2Shadow',
				'selector' => '{{WRAPPER}} .switcher-toggle .switch-2 .tp-switch-tooltip2',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tt2_a',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'tt2ColorA',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2' => 'color:{{VALUE}};',
				),
			)
		);
		$this->add_control(
			'tt2ArrowA',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2:after' => 'border-color:{{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_control(
			'tt2BgA',
			array(
				'label'     => esc_html__( 'Background', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2' => 'background:{{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tt2BorderA',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2',
			)
		);
		$this->add_responsive_control(
			'tt2BrA',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tt2ShadowA',
				'selector' => '{{WRAPPER}} .switcher-toggle.active .switch-2 .tp-switch-tooltip2',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_1_styling',
			array(
				'label'     => esc_html__( 'WYSIWYG Content 1', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'content_a_source' => 'content',
				),
			)
		);
		$this->add_control(
			'content_section_a_color',
			array(
				'label'     => esc_html__( 'Content 1 Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1,{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1 p' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'content_a_source' => 'content',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_section_a',
				'label'     => esc_html__( 'Content Section 1 Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1',
				'condition' => array(
					'content_a_source' => 'content',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_2_styling',
			array(
				'label'     => esc_html__( 'WYSIWYG Content 2', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'content_b_source' => 'content',
				),
			)
		);
		$this->add_control(
			'content_section_b_color',
			array(
				'label'     => esc_html__( 'Content 2 Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2,{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2 p' => 'color:{{VALUE}};',
				),
				'condition' => array(
					'content_b_source' => 'content',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_section_b',
				'label'     => esc_html__( 'Content Section 2 Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2',
				'condition' => array(
					'content_b_source' => 'content',
				),
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

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation.php';
		include THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings       = $this->get_settings_for_display();
		$switch_a_title = $settings['switch_a_title'];
		$switch_a_icon  = isset( $settings['switch_a_icon'] ) ? $settings['switch_a_icon'] : '';

		$switch_b_title = $settings['switch_b_title'];
		$switch_b_icon  = isset( $settings['switch_b_icon'] ) ? $settings['switch_b_icon'] : '';

		$switcher_style = $settings['switcher_style'];
		$switch_align   = $settings['switch-align'];
		$show_tooltip   = isset( $settings['show_tooltip'] ) ? $settings['show_tooltip'] : 'no';

		$tooltip_con_1 = ! empty( $settings['tooltip_con_1'] ) ? $settings['tooltip_con_1'] : '';
		$tooltip_con_2 = ! empty( $settings['tooltip_con_2'] ) ? $settings['tooltip_con_2'] : '';

		$switcher_title_tag = ! empty( $settings['switcher_title_tag'] ) ? $settings['switcher_title_tag'] : 'h5';

		$content_a_desc   = ! empty( $settings['content_a_desc'] ) ? $settings['content_a_desc'] : '';
		$content_a_source = ! empty( $settings['content_a_source'] ) ? $settings['content_a_source'] : 'content';

		$content_a_template = ! empty( $settings['content_a_template'] ) ? $settings['content_a_template'] : '0';

		$content_template_id   = ! empty( $settings['content_template_id'] ) ? $settings['content_template_id'] : '';
		$content_template_type = ! empty( $settings['content_template_type'] ) ? $settings['content_template_type'] : 'dropdown';

		$content_b_desc   = ! empty( $settings['content_b_desc'] ) ? $settings['content_b_desc'] : '';
		$content_b_source = ! empty( $settings['content_b_source'] ) ? $settings['content_b_source'] : 'content';

		$content_b_template = ! empty( $settings['content_b_template'] ) ? $settings['content_b_template'] : '0';

		$content_b_template_id   = ! empty( $settings['content_b_template_id'] ) ? $settings['content_b_template_id'] : '';
		$content_b_template_type = ! empty( $settings['content_b_template_type'] ) ? $settings['content_b_template_type'] : 'dropdown';

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/*--Plus Extra ---*/
		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';
		/*--Plus Extra ---*/

		$uid = uniqid( 'switch' );
		if ( ! empty( $settings['switcher_unique_id'] ) ) {
			$uid = 'tpca_' . esc_attr( $settings['switcher_unique_id'] );
		}

		$switcher = '<div id="' . esc_attr( $uid ) . '" class="theplus-switcher switch-1 ' . esc_attr( $animated_class ) . '" ' . $animation_attr . ' data-id="' . esc_attr( $uid ) . '" >';

			$switcher .= '<div class="switcher-toggle inactive ' . esc_attr( $switch_align ) . ' ' . esc_attr( $switcher_style ) . '">';

		if ( 'style-1' === $switcher_style || 'style-2' === $switcher_style || 'style-3' === $switcher_style || 'style-4' === $switcher_style ) {

			$con1_hashidin = '';
			if ( ! empty( $settings['con1_hashid'] ) ) {
				$con1_hashidin = 'id="' . esc_attr( $settings['con1_hashid'] ) . '"';
			}

			$switcher .= '<div class="switch-1" ' . $con1_hashidin . '>';

			if ( 'yes' === $show_tooltip && ! empty( $tooltip_con_1 ) && 'style-4' !== $switcher_style ) {
					$switcher .= '<span class="tp-switch-tooltip1">' . esc_html( $tooltip_con_1 ) . '</span>';
			}

			$sicon1 = '';
			if ( ! empty( $switch_a_icon ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $switch_a_icon, array( 'aria-hidden' => 'true' ) );
				$sicon1 = ob_get_contents();
				ob_end_clean();
			}

			$switcher .= '<' . theplus_validate_html_tag( $switcher_title_tag ) . ' class="switch-label-text switch-label-1">' . $sicon1 . esc_html( $switch_a_title ) . '</' . theplus_validate_html_tag( $switcher_title_tag ) . '>
						
			</div>';

			$switcher .= '<div class="switcher-button" data-type="' . esc_attr( $switcher_style ) . '"><label class="switch-label-btn"><input class="switch-toggle round-' . esc_attr( $switcher_style ) . '" type="checkbox"><span class="switch-slider ' . esc_attr( $switcher_style ) . ' switch-round"></span></label></div>';

			$con2_hashidin = '';
			if ( ! empty( $settings['con2_hashid'] ) ) {
				$con2_hashidin = 'id="' . esc_attr( $settings['con2_hashid'] ) . '"';
			}

			$switcher .= '<div class="switch-2" ' . $con2_hashidin . '>';

			if ( 'yes' === $show_tooltip && ! empty( $tooltip_con_2 ) && 'style-4' !== $switcher_style ) {
				$switcher .= '<span class="tp-switch-tooltip2">' . esc_html( $tooltip_con_2 ) . '</span>';
			}

			$sicon2 = '';
			if ( ! empty( $switch_b_icon ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $switch_b_icon, array( 'aria-hidden' => 'true' ) );
				$sicon2 = ob_get_contents();
				ob_end_clean();
			}

			$switcher .= '<' . theplus_validate_html_tag( $switcher_title_tag ) . ' class="switch-label-text switch-label-2">' . $sicon2 . esc_html( $switch_b_title ) . '</' . theplus_validate_html_tag( $switcher_title_tag ) . '>
			
			</div>';

			if ( 'style-3' === $switcher_style ) {
				$switcher .= '<div class="st-pricing-underlines"><div class="st-pricing-underlines-2"></div></div>';
			}
		}

		$switcher .= '</div>';

		$switcher .= '<div class="switcher-toggle-sections">';

			$switcher .= '<div class="switcher-section-1" style="display: block;">';

		if ( 'content' === $content_a_source && ! empty( $content_a_desc ) ) {
			$switcher .= '<div class="content-1">' . wp_kses_post( $content_a_desc ) . '</div>';
		}

		if ( 'template' === $content_a_source && 'manually' === $content_template_type && ! empty( $content_template_id ) ) {
			$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $content_template_id, 24, -2 ) );
		} elseif ( 'template' === $content_a_source && ! empty( $content_a_template ) ) {
				$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_a_template );
		}

			$switcher .= '</div>';

			$switcher .= '<div class="switcher-section-2" style="display:none;">';

		if ( 'content' === $content_b_source && ! empty( $content_b_desc ) ) {
			$switcher .= '<div class="content-2">' . wp_kses_post( $content_b_desc ) . '</div>';
		}

		if ( 'template' === $content_b_source && 'manually' === $content_b_template_type && ! empty( $content_b_template_id ) ) {
			$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $content_b_template_id, 24, -2 ) );
		} elseif ( 'template' === $content_b_source ) {
				$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $content_b_template );
		}

				$switcher .= '</div>';

			$switcher .= '</div>';

		$switcher .= '</div>';

		$show_switcher_button = ! empty( $settings['show_switcher_button'] ) ? $settings['show_switcher_button'] : '';
		$show_switcher_label  = ! empty( $settings['show_switcher_label'] ) ? $settings['show_switcher_label'] : '';

		$css_rule = '';
		if ( 'yes' !== $show_switcher_button || 'yes' !== $show_switcher_label ) {
			$css_rule .= '<style>';
		}

		if ( 'yes' !== $show_switcher_button ) {
			$css_rule .= '#' . esc_attr( $uid ) . ' .switcher-toggle .switcher-button{display:none;}';
		}

		if ( 'yes' !== $show_switcher_label ) {
			$css_rule .= '#' . esc_attr( $uid ) . '.theplus-switcher .switch-1,#' . esc_attr( $uid ) . '.theplus-switcher .switch-2,#' . esc_attr( $uid ) . '.theplus-switcher .st-pricing-underlines{display:none;}';
		}

		if ( 'yes' !== $show_switcher_button || 'yes' !== $show_switcher_label ) {
			$css_rule .= '</style>';
		}

		echo $css_rule . $before_content . $switcher . $after_content;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
