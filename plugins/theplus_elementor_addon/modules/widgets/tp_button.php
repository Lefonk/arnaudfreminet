<?php
/**
 * Widget Name: Button
 * Description: creative of button style.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ThePlus_Button
 */
class ThePlus_Button extends Widget_Base {

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
		return 'tp-button';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'TP Button', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-link theplus_backend_icon';
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
		return array( 'Buttons', 'Button widget', 'Elementor buttons', ' Elementor button widget', 'Button elementor addon', 'Elementor plus addon buttons', 'Elementor plus buttons', 'Button', 'Button elementor element', 'Button elementor module', 'Elementor button module', 'Elementor button element', 'Button elementor extension', 'Elementor button extension', 'Button elementor plugin', 'Elementor button plugin' );
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
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Button Style', 'theplus' ),
				'default' => 'style-1',
				'options' => array(
					'style-1'  => esc_html__( 'Style 1', 'theplus' ),
					'style-2'  => esc_html__( 'Style 2', 'theplus' ),
					'style-3'  => esc_html__( 'Style 3', 'theplus' ),
					'style-4'  => esc_html__( 'Style 4', 'theplus' ),
					'style-5'  => esc_html__( 'Style 5', 'theplus' ),
					'style-6'  => esc_html__( 'Style 6', 'theplus' ),
					'style-7'  => esc_html__( 'Style 7', 'theplus' ),
					'style-8'  => esc_html__( 'Style 8', 'theplus' ),
					'style-9'  => esc_html__( 'Style 9', 'theplus' ),
					'style-10' => esc_html__( 'Style 10', 'theplus' ),
					'style-11' => esc_html__( 'Style 11', 'theplus' ),
					'style-12' => esc_html__( 'Style 12', 'theplus' ),
					'style-13' => esc_html__( 'Style 13', 'theplus' ),
					'style-14' => esc_html__( 'Style 14', 'theplus' ),
					'style-15' => esc_html__( 'Style 15', 'theplus' ),
					'style-16' => esc_html__( 'Style 16', 'theplus' ),
					'style-17' => esc_html__( 'Style 17', 'theplus' ),
					'style-18' => esc_html__( 'Style 18', 'theplus' ),
					'style-19' => esc_html__( 'Style 19', 'theplus' ),
					'style-20' => esc_html__( 'Style 20', 'theplus' ),
					'style-21' => esc_html__( 'Style 21', 'theplus' ),
					'style-22' => esc_html__( 'Style 22', 'theplus' ),
					'style-24' => esc_html__( 'Style 23', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'theplus' ),
				'placeholder' => esc_html__( 'Read More', 'theplus' ),
			)
		);
		$this->add_control(
			'button_24_text',
			array(
				'label'       => esc_html__( 'Button Tag Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Click Here', 'theplus' ),
				'placeholder' => esc_html__( 'Click Here', 'theplus' ),
				'condition'   => array(
					'button_style' => array( 'style-24' ),
				),
			)
		);
		$this->add_control(
			'button_hover_text',
			array(
				'label'       => wp_kses_post( "Hover Text <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "button-text-on-hover-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Click Here', 'theplus' ),
				'placeholder' => esc_html__( 'Click Here', 'theplus' ),
				'condition'   => array(
					'button_style' => array( 'style-4', 'style-11', 'style-14' ),
				),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'separator'   => 'before',
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);
		$this->add_control(
			'button_custom_attributes',
			array(
				'label'     => __( 'Add Custom Attributes', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'custom_attributes',
			array(
				'label'       => __( 'Custom Attributes', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'key=value', 'theplus' ),
				'condition'   => array(
					'button_custom_attributes' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_responsive_control(
			'button_align',
			array(
				'label'   => esc_html__( 'Alignment', 'theplus' ),
				'type'    => Controls_Manager::CHOOSE,
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
			)
		);

		$this->add_control(
			'btn_hover_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'theplus' ),
				'default'   => 'hover-left',
				'options'   => array(
					'hover-left'   => esc_html__( 'On Left', 'theplus' ),
					'hover-right'  => esc_html__( 'On Right', 'theplus' ),
					'hover-top'    => esc_html__( 'On Top', 'theplus' ),
					'hover-bottom' => esc_html__( 'On Bottom', 'theplus' ),
				),
				'condition' => array(
					'button_style' => array( 'style-11', 'style-13' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_button_icon_styling',
			array(
				'label'     => esc_html__( 'Icon Settings', 'theplus' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'button_style!' => array( 'style-3', 'style-6', 'style-7', 'style-9' ),
				),

			)
		);
		$this->add_control(
			'icon_hover_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Icon Hover Style', 'theplus' ),
				'default'   => 'hover-top',
				'options'   => array(
					'hover-top'    => esc_html__( 'On Top', 'theplus' ),
					'hover-bottom' => esc_html__( 'On Bottom', 'theplus' ),
				),
				'condition' => array(
					'button_style' => array( 'style-17' ),
				),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'   => esc_html__( 'Icon Font', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Icon', 'theplus' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-chevron-right',
				'condition'   => array(
					'button_icon_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'button_icon_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'button_icon_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'button_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'button_icon_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'before_after',
			array(
				'label'     => esc_html__( 'Icon Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => esc_html__( 'After', 'theplus' ),
					'before' => esc_html__( 'Before', 'theplus' ),
				),
				'condition' => array(
					'button_style!'      => array( 'style-17' ),
					'button_icon_style!' => '',
				),
			)
		);
		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'button_style!'      => array( 'style-17' ),
					'button_icon_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-before' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon.button-after' => 'padding-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 200,
					),
				),
				'separator' => 'before',
				'condition' => array(
					'button_style!'      => array( 'style-17' ),
					'button_icon_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'vertical_button_align_24',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'start'  => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'end'    => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap ' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'button_style' => array( 'style-24' ),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_extra_styling',
			array(
				'label' => esc_html__( 'Extra', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'button_css_id',
			array(
				'label'       => esc_html__( 'Button ID', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'theplus' ),
				'label_block' => false,
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_styling',
			array(
				'label' => esc_html__( 'Typography and Cosmetics', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button:not(.button-style-11):not(.button-style-17) .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap > span,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button:not(.button-style-11):not(.button-style-17) .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap > span,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
			)
		);
		$this->add_control(
			'button_svg_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Svg Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap .arrow *' => 'fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-6 .button-link-wrap::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap span.btn-arrow' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-9 a.button-link-wrap .btn-arrow' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap i,
								{{WRAPPER}} .pt_plus_button.button-style-3 a.button-link-wrap:before,
								{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,
								{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap',
				'condition' => array(
					'button_style!' => array( 'style-1', 'style-6', 'style-7', 'style-9', 'style-12', 'style-13' ),
				),
			)
		);
		$this->add_control(
			'button_border_style',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_style' => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_border_width',
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
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-4', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_responsive_control(
			'button_radius_18',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::after,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => 'style-18',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap i,
							   {{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap,
							   {{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap',
				'condition' => array(
					'button_style' => array( 'style-2', 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-15', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_control(
			'btn_bottom_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_style' => 'style-1',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'background: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'bottom_border_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'default'     => array(
					'unit' => 'px',
					'size' => 1,
				),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'button_style' => 'style-1',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap .button_line' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap .btn-icon,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover svg,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap .btn-icon svg,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap .btn-icon svg,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap svg,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap:hover .arrow-1 *' => 'fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap:hover i,
								{{WRAPPER}} .pt_plus_button.button-style-3 .button-link-wrap:hover:before,
								{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:before,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap::after,
								{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap:hover::after,
								{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap::before,
								{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::after,
								{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:after,
								{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
								{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover',
				'condition' => array(
					'button_style!' => array( 'style-1', 'style-6', 'style-7', 'style-9' ),
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap::before,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap::before' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
				'condition' => array(
					'button_style'         => array( 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
					'button_border_style!' => 'none',
				),
			)
		);
		$this->add_responsive_control(
			'button_radius_hover_18',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::after,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover::before,{{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => 'style-18',
				),
			)
		);
		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'button_style' => array( 'style-4', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-16', 'style-17', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-2 .button-link-wrap:hover i,
							   {{WRAPPER}} .pt_plus_button.button-style-4 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-5 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-10 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-11 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-12 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-13 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-14 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-15 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-16 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-17 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-18 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-19 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-20 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-21 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-22 .button-link-wrap:hover,
							   {{WRAPPER}} .pt_plus_button.button-style-24 .button-link-wrap:hover',
				'condition' => array(
					'button_style' => array( 'style-2', 'style-4', 'style-5', 'style-8', 'style-10', 'style-11', 'style-12', 'style-13', 'style-14', 'style-15', 'style-16', 'style-17', 'style-18', 'style-19', 'style-20', 'style-21', 'style-22', 'style-24' ),
				),
			)
		);
		$this->add_control(
			'btn_bottom_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'button_style' => 'style-1',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover .button_line' => 'background: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'button_tag_24_heading',
			array(
				'label'     => esc_html__( 'Button Tag Text', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_style' => array( 'style-24' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_tag_typography',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-24 .button-tag-hint',
				'condition' => array(
					'button_style' => 'style-24',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_effect_styling',
			array(
				'label' => esc_html__( 'Special', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'btn_magic_scroll',
			array(
				'label'       => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Scroll Options', 'theplus' ),
				'name'        => 'scroll_option',
				'render_type' => 'template',
				'condition'   => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->start_controls_tabs( 'tabs_magic_scroll' );
		$this->start_controls_tab(
			'tab_scroll_from',
			array(
				'label'     => esc_html__( 'Initial', 'theplus' ),
				'condition' => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Initial Position', 'theplus' ),
				'name'      => 'scroll_from',
				'condition' => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scroll_to',
			array(
				'label'     => esc_html__( 'Final', 'theplus' ),
				'condition' => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label'     => esc_html__( 'Final Position', 'theplus' ),
				'name'      => 'scroll_to',
				'condition' => array(
					'btn_magic_scroll' => array( 'yes' ),
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'plus_tooltip',
			array(
				'label'       => wp_kses_post( "Tooltip <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "tooltip-text-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);

		$this->start_controls_tabs( 'plus_tooltip_tabs' );

		$this->start_controls_tab(
			'plus_tooltip_content_tab',
			array(
				'label'       => esc_html__( 'Content', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_type',
			array(
				'label'       => esc_html__( 'Content Type', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'normal_desc',
				'options'     => array(
					'normal_desc'     => esc_html__( 'Content Text', 'theplus' ),
					'content_wysiwyg' => esc_html__( 'Content WYSIWYG', 'theplus' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_desc',
			array(
				'label'     => esc_html__( 'Description', 'theplus' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => esc_html__( 'Luctus nec ullamcorper mattis', 'theplus' ),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_wysiwyg',
			array(
				'label'       => esc_html__( 'Tooltip Content', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip_content_type' => 'content_wysiwyg',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_tooltip_content_align',
			array(
				'label'     => esc_html__( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
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
				'selectors' => array(
					'{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'plus_tooltip_content_typography',
				'selector'  => '{{WRAPPER}} .tippy-tooltip .tippy-content',
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);

		$this->add_control(
			'plus_tooltip_content_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tippy-tooltip .tippy-content,{{WRAPPER}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'plus_tooltip_content_type' => array( 'normal_desc', 'content_wysiwyg' ),
					'plus_tooltip'              => 'yes',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'plus_tooltip_styles_tab',
			array(
				'label'     => esc_html__( 'Style', 'theplus' ),
				'condition' => array(
					'plus_tooltip' => 'yes',
				),
			)
		);
		$this->add_group_control(
			\Theplus_Tooltips_Option_Group::get_type(),
			array(
				'label'       => esc_html__( 'Tooltip Options', 'theplus' ),
				'name'        => 'tooltip_opt',
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Tooltips_Option_Style_Group::get_type(),
			array(
				'label'       => esc_html__( 'Style Options', 'theplus' ),
				'name'        => 'tooltip_style',
				'render_type' => 'template',
				'condition'   => array(
					'plus_tooltip' => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'btn_special_effect',
			array(
				'label'     => esc_html__( 'Special Effect', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Overlay_Special_Effect_Group::get_type(),
			array(
				'label'     => esc_html__( 'Overlay Color', 'theplus' ),
				'name'      => 'plus_overlay_spcial',
				'condition' => array(
					'btn_special_effect' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_mouse_move_parallax',
			array(
				'label'       => esc_html__( 'Mouse Move Parallax', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_group_control(
			\Theplus_Mouse_Move_Parallax_Group::get_type(),
			array(
				'label'       => esc_html__( 'Parallax Options', 'theplus' ),
				'name'        => 'plus_mouse_parallax',
				'render_type' => 'template',
				'condition'   => array(
					'plus_mouse_move_parallax' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'plus_continuous_animation',
			array(
				'label'       => wp_kses_post( "Continuous Animation <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "continuous-animation-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'plus_animation_effect',
			array(
				'label'       => esc_html__( 'Animation Effect', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'pulse',
				'options'     => array(
					'pulse'    => esc_html__( 'Pulse', 'theplus' ),
					'floating' => esc_html__( 'Floating', 'theplus' ),
					'tossing'  => esc_html__( 'Tossing', 'theplus' ),
					'rotating' => esc_html__( 'Rotating', 'theplus' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_animation_hover',
			array(
				'label'       => esc_html__( 'Hover Animation', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_animation_duration',
			array(
				'label'      => esc_html__( 'Duration Time', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => 's',
				'range'      => array(
					's' => array(
						'min'  => 0.5,
						'max'  => 50,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 's',
					'size' => 2.5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .animted-content-inner' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'plus_continuous_animation' => 'yes',
				),
			)
		);
		$this->add_control(
			'plus_transform_origin',
			array(
				'label'       => esc_html__( 'Transform Origin', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center center',
				'options'     => array(
					'top left'      => esc_html__( 'Top Left', 'theplus' ),
					'top center"'   => esc_html__( 'Top Center', 'theplus' ),
					'top right'     => esc_html__( 'Top Right', 'theplus' ),
					'center left'   => esc_html__( 'Center Left', 'theplus' ),
					'center center' => esc_html__( 'Center Center', 'theplus' ),
					'center right'  => esc_html__( 'Center Right', 'theplus' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'theplus' ),
					'bottom center' => esc_html__( 'Bottom Center', 'theplus' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'theplus' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .animted-content-inner' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				),
				'render_type' => 'template',
				'condition'   => array(
					'plus_continuous_animation' => 'yes',
					'plus_animation_effect'     => 'rotating',
				),
			)
		);
		$this->add_control(
			'full_width_btn',
			array(
				'label'     => wp_kses_post( "Full-Width Button<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "full-width-button-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'btn_hover_effects',
			array(
				'label'     => wp_kses_post( "Button Hover Effects <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "button-hover-animation-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'separator' => 'before',
				'options'   => theplus_get_content_hover_effect_options(),
			)
		);
		$this->add_control(
			'hover_shadow_color',
			array(
				'label'     => esc_html__( 'Shadow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.6)',
				'condition' => array(
					'btn_hover_effects' => array( 'float_shadow', 'grow_shadow', 'shadow_radial' ),
				),
			)
		);
		$this->add_control(
			'shake_animate',
			array(
				'label'     => wp_kses_post( "Interval Shake Animate' <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "interval-shake-animation-in-button-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'shake_animate_duration',
			array(
				'label'     => esc_html__( 'Interval Shake Duration', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 5,
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-button-wrapper .button-link-wrap.shake_animate' => ' animation-duration: {{VALUE}}s;-o-animation-duration: {{VALUE}}s;
					-ms-animation-duration: {{VALUE}}s;-moz-animation-duration: {{VALUE}}s;-webkit-animation-duration: {{VALUE}}s;',
				),
				'condition' => array(
					'shake_animate' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_plus_extra_adv_hs',
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
	 * Render button.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings    = $this->get_settings_for_display();
		$hover_class = '';

		$full_button_width = '';

		$hover_attr        = '';
		$data_class        = '';
		$button_hover_text = '';

		$magic_class = '';
		$magic_attr  = '';

		$parallax_scroll = '';

		$btn_magic_scroll = ! empty( $settings['btn_magic_scroll'] ) ? $settings['btn_magic_scroll'] : '';

		// Not use.
		if ( 'yes' === $btn_magic_scroll ) {
			if ( empty( $settings['scroll_option_popover_toggle'] ) ) {
				$scroll_offset   = 0;
				$scroll_duration = 300;
			} else {
				$scroll_offset   = ( isset( $settings['scroll_option_scroll_offset'] ) ? $settings['scroll_option_scroll_offset'] : 0 );
				$scroll_duration = ( isset( $settings['scroll_option_scroll_duration'] ) ? $settings['scroll_option_scroll_duration'] : 300 );
			}

			if ( empty( $settings['scroll_from_popover_toggle'] ) ) {
				$scroll_x_from       = 0;
				$scroll_y_from       = 0;
				$scroll_opacity_from = 1;
				$scroll_scale_from   = 1;
				$scroll_rotate_from  = 0;
			} else {
				$scroll_x_from       = ( isset( $settings['scroll_from_scroll_x_from'] ) ? $settings['scroll_from_scroll_x_from'] : 0 );
				$scroll_y_from       = ( isset( $settings['scroll_from_scroll_y_from'] ) ? $settings['scroll_from_scroll_y_from'] : 0 );
				$scroll_opacity_from = ( isset( $settings['scroll_from_scroll_opacity_from'] ) ? $settings['scroll_from_scroll_opacity_from'] : 1 );
				$scroll_scale_from   = ( isset( $settings['scroll_from_scroll_scale_from'] ) ? $settings['scroll_from_scroll_scale_from'] : 1 );
				$scroll_rotate_from  = ( isset( $settings['scroll_from_scroll_rotate_from'] ) ? $settings['scroll_from_scroll_rotate_from'] : 0 );
			}

			if ( empty( $settings['scroll_to_popover_toggle'] ) ) {
				$scroll_x_to       = 0;
				$scroll_y_to       = -50;
				$scroll_opacity_to = 1;
				$scroll_scale_to   = 1;
				$scroll_rotate_to  = 0;
			} else {
				$scroll_x_to       = ( isset( $settings['scroll_to_scroll_x_to'] ) ? $settings['scroll_to_scroll_x_to'] : 0 );
				$scroll_y_to       = ( isset( $settings['scroll_to_scroll_y_to'] ) ? $settings['scroll_to_scroll_y_to'] : -50 );
				$scroll_opacity_to = ( isset( $settings['scroll_to_scroll_opacity_to'] ) ? $settings['scroll_to_scroll_opacity_to'] : 1 );
				$scroll_scale_to   = ( isset( $settings['scroll_to_scroll_scale_to'] ) ? $settings['scroll_to_scroll_scale_to'] : 1 );
				$scroll_rotate_to  = ( isset( $settings['scroll_to_scroll_rotate_to'] ) ? $settings['scroll_to_scroll_rotate_to'] : 0 );
			}

			$magic_attr .= ' data-scroll_type="position" ';
			$magic_attr .= ' data-scroll_offset="' . esc_attr( $scroll_offset ) . '" ';
			$magic_attr .= ' data-scroll_duration="' . esc_attr( $scroll_duration ) . '" ';

			$magic_attr .= ' data-scroll_x_from="' . esc_attr( $scroll_x_from ) . '" ';
			$magic_attr .= ' data-scroll_x_to="' . esc_attr( $scroll_x_to ) . '" ';
			$magic_attr .= ' data-scroll_y_from="' . esc_attr( $scroll_y_from ) . '" ';
			$magic_attr .= ' data-scroll_y_to="' . esc_attr( $scroll_y_to ) . '" ';
			$magic_attr .= ' data-scroll_opacity_from="' . esc_attr( $scroll_opacity_from ) . '" ';
			$magic_attr .= ' data-scroll_opacity_to="' . esc_attr( $scroll_opacity_to ) . '" ';
			$magic_attr .= ' data-scroll_scale_from="' . esc_attr( $scroll_scale_from ) . '" ';
			$magic_attr .= ' data-scroll_scale_to="' . esc_attr( $scroll_scale_to ) . '" ';
			$magic_attr .= ' data-scroll_rotate_from="' . esc_attr( $scroll_rotate_from ) . '" ';
			$magic_attr .= ' data-scroll_rotate_to="' . esc_attr( $scroll_rotate_to ) . '" ';

			$parallax_scroll .= ' parallax-scroll ';

			$magic_class .= ' magic-scroll ';
		}
		// Not use.

		$reveal_btn_effects = '';
		$effect_attr    = '';

		$btn_special_effect = ! empty( $settings['btn_special_effect'] ) ? $settings['btn_special_effect'] : '';

		if ( 'yes' === $btn_special_effect ) {
			$effect_rand_no = uniqid( 'reveal' );
			$color_1        = ! empty( $settings['plus_overlay_spcial_effect_color_1'] ) ? $settings['plus_overlay_spcial_effect_color_1'] : '#313131';
			$color_2        = ! empty( $settings['plus_overlay_spcial_effect_color_2'] ) ? $settings['plus_overlay_spcial_effect_color_2'] : '#ff214f';

			$effect_attr   .= ' data-reveal-id="' . esc_attr( $effect_rand_no ) . '" ';
			$effect_attr   .= ' data-effect-color-1="' . esc_attr( $color_1 ) . '" ';
			$effect_attr   .= ' data-effect-color-2="' . esc_attr( $color_2 ) . '" ';
			$reveal_btn_effects = ' pt-plus-reveal ' . esc_attr( $effect_rand_no ) . ' ';
		}
		
		$move_parallax = '';
		$parallax_move = '';

		$move_parallax_attr = '';

		$plus_mm_parallax = ! empty( $settings['plus_mouse_move_parallax'] ) ? $settings['plus_mouse_move_parallax'] : '';

		if ( 'yes' === $plus_mm_parallax ) {
			$move_parallax = 'pt-plus-move-parallax';
			$parallax_move = 'parallax-move';

			$parallax_speed_x    = isset( $settings['plus_mouse_parallax_speed_x']['size'] ) ? $settings['plus_mouse_parallax_speed_x']['size'] : 30;
			$parallax_speed_y    = isset( $settings['plus_mouse_parallax_speed_y']['size'] ) ? $settings['plus_mouse_parallax_speed_y']['size'] : 30;
			$move_parallax_attr .= ' data-move_speed_x="' . esc_attr( $parallax_speed_x ) . '" ';
			$move_parallax_attr .= ' data-move_speed_y="' . esc_attr( $parallax_speed_y ) . '" ';
		}

		$hover_class = '';
		$hover_attr  = '';

		$hover_uniqid = uniqid( 'hover-effect' );
		$btn_hover_ef = ! empty( $settings['btn_hover_effects'] ) ? $settings['btn_hover_effects'] : '';

		if ( 'float_shadow' === $btn_hover_ef || 'grow_shadow' === $btn_hover_ef || 'shadow_radial' === $btn_hover_ef ) {

			$hover_attr .= 'data-hover_uniqid="' . esc_attr( $hover_uniqid ) . '" ';
			$hover_attr .= ' data-hover_shadow="' . esc_attr( $settings['hover_shadow_color'] ) . '" ';
			$hover_attr .= ' data-content_hover_effects="' . esc_attr( $settings['btn_hover_effects'] ) . '" ';
		}

		$btn_hover_effects = $btn_hover_ef;

		if ( 'grow' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_grow';
		} elseif ( 'push' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_push';
		} elseif ( 'bounce-in' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_bounce_in';
		} elseif ( 'float' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_float';
		} elseif ( 'wobble_horizontal' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_wobble_horizontal';
		} elseif ( 'wobble_vertical' === $btn_hover_effects ) {
			$hover_class .= 'content_hover_wobble_vertical';
		} elseif ( 'float_shadow' === $btn_hover_effects ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_float_shadow';
		} elseif ( 'grow_shadow' === $btn_hover_effects ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_grow_shadow';
		} elseif ( 'shadow_radial' === $btn_hover_effects ) {
			$hover_class .= '' . esc_attr( $hover_uniqid ) . ' content_hover_radial';
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['button_link'] );
		}

		$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] ) : '';

		$shake_animate = ! empty( $settings['shake_animate'] ) ? $settings['shake_animate'] : '';

		if ( 'yes' === $shake_animate ) {
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap shake_animate ' . $lz1 );
		} else {
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap ' . $lz1 );
		}

		$this->add_render_attribute( 'button', 'role', 'button' );

		$btn_cssid = ! empty( $settings['button_css_id'] ) ? $settings['button_css_id'] : '';

		if ( ! empty( $btn_cssid ) ) {
			$this->add_render_attribute( 'button', 'id', $btn_cssid );
		}

		$btn_hover_txt = ! empty( $settings['button_hover_text'] ) ? $settings['button_hover_text'] : '';

		if ( ! empty( $btn_hover_txt ) ) {
			$this->add_render_attribute( 'button', 'data-hover', $btn_hover_txt );
		} else {
			$this->add_render_attribute( 'button', 'data-hover', $settings['button_text'] );
		}
		$button_style  = $settings['button_style'];
		$button_align  = ' text-' . ( ! empty( $settings['button_align'] ) ? $settings['button_align'] : '' );
		$button_align .= ! empty( $settings['button_align_tablet'] ) ? ' text--tablet' . $settings['button_align_tablet'] : '';
		$button_align .= ! empty( $settings['button_align_mobile'] ) ? ' text--mobile' . $settings['button_align_mobile'] : '';

		$btn_hover_style  = ! empty( $settings['btn_hover_style'] ) ? $settings['btn_hover_style'] : 'hover-left';
		$icon_hover_style = ! empty( $settings['icon_hover_style'] ) ? $settings['icon_hover_style'] : 'hover-top';

		$button_text = $settings['button_text'];

		$button_hover_text = $btn_hover_txt;

		$uid         = uniqid( 'btn' );
		$data_class  = $uid;
		$data_class .= ' button-' . $button_style . ' ';

		if ( 'style-11' === $button_style || 'style-13' === $button_style ) {
			$data_class .= ' ' . $btn_hover_style . ' ';
		}

		if ( 'style-17' === $button_style ) {
			$data_class .= ' ' . $icon_hover_style . ' ';
		}

		$full_wbtn = ! empty( $settings['full_width_btn'] ) ? $settings['full_width_btn'] : '';

		if ( 'yes' === $full_wbtn ) {
			$data_class       .= ' full-button ';
			$full_button_width = ' full-button ';
		}

		if ( ! empty( $settings['transition_hover'] ) && 'yes' === $settings['transition_hover'] ) {
			$data_class .= ' trnasition_hover ';
		}

		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';
		
		$PlusExtra_Class = 'plus-adv-text-widget';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$plus_tooltips = ! empty( $settings['plus_tooltip'] ) ? $settings['plus_tooltip'] : '';

		if ( 'yes' === $plus_tooltips ) {

			$this->add_render_attribute( '_tooltip', 'data-tippy', '', true );

			$plus_tooltip_cont = ! empty( $settings['plus_tooltip_content_type'] ) ? $settings['plus_tooltip_content_type'] : '';

			$tooltip_desc = ! empty( $settings['plus_tooltip_content_desc'] ) ? wp_kses_post( $settings['plus_tooltip_content_desc'] ) : '';
			if ( 'normal_desc' === $plus_tooltip_cont ) {
				$this->add_render_attribute( '_tooltip', 'title', $tooltip_desc, true );

			} elseif ( 'content_wysiwyg' === $plus_tooltip_cont ) {

				$tooltip_content = $settings['plus_tooltip_content_wysiwyg'];
				$this->add_render_attribute( '_tooltip', 'title', $tooltip_content, true );
			}

			// Not use.
			$plus_tooltip_position = ( ! empty( $settings['tooltip_opt_plus_tooltip_position'] ) ) ? $settings['tooltip_opt_plus_tooltip_position'] : 'top';
			$this->add_render_attribute( '_tooltip', 'data-tippy-placement', $plus_tooltip_position, true );

			$tooltip_interactive = ( isset( $settings['tooltip_opt_plus_tooltip_interactive'] ) && 'yes' === $settings['tooltip_opt_plus_tooltip_interactive'] ? 'true' : 'false' );
			$this->add_render_attribute( '_tooltip', 'data-tippy-interactive', $tooltip_interactive, true );

			$plus_tooltip_theme = ( ! empty( $settings['tooltip_opt_plus_tooltip_theme'] ) ) ? $settings['tooltip_opt_plus_tooltip_theme'] : 'dark';
			$this->add_render_attribute( '_tooltip', 'data-tippy-theme', $plus_tooltip_theme, true );

			$tooltip_arrow = ( 'none' !== $settings['tooltip_opt_plus_tooltip_arrow'] || empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ) ? 'true' : 'false';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrow', $tooltip_arrow, true );

			$plus_tooltip_arrow = ( ! empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ) ? $settings['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrowtype', $plus_tooltip_arrow, true );

			$plus_tooltip_animation = ( ! empty( $settings['tooltip_opt_plus_tooltip_animation'] ) ) ? $settings['tooltip_opt_plus_tooltip_animation'] : 'shift-toward';
			$this->add_render_attribute( '_tooltip', 'data-tippy-animation', $plus_tooltip_animation, true );

			$plus_tooltip_x_offset = ( isset( $settings['tooltip_opt_plus_tooltip_x_offset'] ) ) ? $settings['tooltip_opt_plus_tooltip_x_offset'] : 0;
			$plus_tooltip_y_offset = ( isset( $settings['tooltip_opt_plus_tooltip_y_offset'] ) ) ? $settings['tooltip_opt_plus_tooltip_y_offset'] : 0;
			$this->add_render_attribute( '_tooltip', 'data-tippy-offset', $plus_tooltip_x_offset . ',' . $plus_tooltip_y_offset, true );

			$tooltip_duration_in  = ( isset( $settings['tooltip_opt_plus_tooltip_duration_in'] ) ) ? $settings['tooltip_opt_plus_tooltip_duration_in'] : 250;
			$tooltip_duration_out = ( isset( $settings['tooltip_opt_plus_tooltip_duration_out'] ) ) ? $settings['tooltip_opt_plus_tooltip_duration_out'] : 200;
			$tooltip_trigger      = ( ! empty( $settings['tooltip_opt_plus_tooltip_triggger'] ) ) ? $settings['tooltip_opt_plus_tooltip_triggger'] : 'mouseenter';
			$tooltip_arrowtype    = ( ! empty( $settings['tooltip_opt_plus_tooltip_arrow'] ) ) ? $settings['tooltip_opt_plus_tooltip_arrow'] : 'sharp';
			// Not use.
		}

		$continuous_animation = '';

		$plus_continuous  = ! empty( $settings['plus_continuous_animation'] ) ? $settings['plus_continuous_animation'] : '';
		$plus_animation_h = ! empty( $settings['plus_animation_hover'] ) ? $settings['plus_animation_hover'] : '';

		if ( 'yes' === $plus_continuous ) {
			if ( 'yes' === $plus_animation_h ) {
				$animation_class = 'hover_';
			} else {
				$animation_class = 'image-';
			}

			$continuous_animation = $animation_class . $settings['plus_animation_effect'];
		}

		$uid_button = uniqid( 'button' );

		$button_custom_attributes = ! empty( $settings['button_custom_attributes'] ) ? $settings['button_custom_attributes'] : '';
		$custom_attributes        = ! empty( $settings['custom_attributes'] ) ? $settings['custom_attributes'] : '';

		$cst_att = '';
		if ( 'yes' === $button_custom_attributes && ! empty( $custom_attributes ) ) {
			$cst_att = $custom_attributes;
		}

		$the_button      = '<div class="pt-plus-button-wrapper  ' . esc_attr( $button_align ) . ' ' . esc_attr( $magic_class ) . '  ">';
			$the_button .= '<div class="button_parallax ' . esc_attr( $parallax_scroll ) . ' ' . esc_attr( $move_parallax ) . ' ' . esc_attr( $full_button_width ) . '" ' . $magic_attr . '>';
		if ( 'yes' === $plus_mm_parallax ) {
			$the_button .= '<div class="' . esc_attr( $parallax_move ) . '" ' . $move_parallax_attr . '>';
		}
		
		$the_button .= '<div id="' . esc_attr( $uid_button ) . '"  class="' . esc_attr( $button_align ) . ' ts-button content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $full_button_width ) . ' ' . $this->get_render_attribute_string( '_tooltip' ) . '" ' . $hover_attr . '>';

			$the_button .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . ' ' . $animated_class . ' ' . esc_attr( $reveal_btn_effects ) . '" ' . $effect_attr . ' ' . $animation_attr . '>';

				$the_button .= '<div class="animted-content-inner ' . esc_attr( $continuous_animation ) . '">';

					$the_button .= '<a ' . $this->get_render_attribute_string( 'button' ) . ' ' . theplus_senitize_js_input( $cst_att ) . ' >';

					$the_button .= $this->render_text();

					$the_button .= '</a>';

				$the_button .= '</div>';

			$the_button .= '</div>';

		$the_button .= '</div>';

		if ( 'yes' === $plus_mm_parallax ) {
			$the_button .= '</div>';
		}

		$the_button .= '</div>';
		$the_button .= '</div>';

		$inline_tippy_js = '';

		if ( 'yes' === $plus_tooltips ) {
			$inline_tippy_js = 'jQuery( document ).ready(function() {
			"use strict";
				if(typeof tippy === "function"){
					tippy( "#' . esc_attr( $uid_button ) . '" , {
						arrowType : "' . esc_attr( $tooltip_arrowtype ) . '",
						duration : [' . esc_attr( $tooltip_duration_in ) . ',' . esc_attr( $tooltip_duration_out ) . '],
						trigger : "' . esc_attr( $tooltip_trigger ) . '",
						appendTo: document.querySelector("#' . esc_attr( $uid_button ) . '")
					});
				}
			});';

			$the_button .= wp_print_inline_script_tag( $inline_tippy_js );
		}

		echo $before_content . $the_button . $after_content;
	}

	/**
	 * Render Text.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render_text() {
		$icons_after   = '';
		$icons_before  = '';
		$button_text   = '';
		$style_content = '';

		$settings = $this->get_settings_for_display();

		$button_style   = ! empty( $settings['button_style'] ) ? $settings['button_style'] : 'style-1';
		$before_after   = ! empty( $settings['before_after'] ) ? $settings['before_after'] : 'after';
		$button_text    = ! empty( $settings['button_text'] ) ? $settings['button_text'] : '';
		$btn_icon_style = ! empty( $settings['button_icon_style'] ) ? $settings['button_icon_style'] : 'font_awesome';

		$icons = '';

		if ( 'font_awesome' === $btn_icon_style ) {
			$icons = $settings['button_icon'];
		} elseif ( 'icon_mind' === $btn_icon_style ) {
			$icons = $settings['button_icons_mind'];
		} elseif ( 'font_awesome_5' === $btn_icon_style ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
			$icons = ob_get_contents();
			ob_end_clean();
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {

			if ( 'font_awesome_5' === $btn_icon_style ) {
				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}
		if ( 'after' === $before_after && ! empty( $icons ) ) {
			if ( 'font_awesome_5' === $btn_icon_style ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'style-1' === $button_style ) {
			$button_text   = $icons_before . esc_html( $button_text ) . $icons_after;
			$style_content = '<div class="button_line"></div>';
		}
		if ( 'style-2' === $button_style || 'style-5' === $button_style || 'style-8' === $button_style || 'style-10' === $button_style ) {
			$button_text = $icons_before . esc_html( $button_text ) . $icons_after;
		}
		if ( 'style-3' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<svg class="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="48" height="9" viewBox="0 0 48 9"><path d="M48.000,4.243 L43.757,8.485 L43.757,5.000 L0.000,5.000 L0.000,4.000 L43.757,4.000 L43.757,0.000 L48.000,4.243 Z" class="cls-1"></path></svg><svg class="arrow-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="48" height="9" viewBox="0 0 48 9"><path d="M48.000,4.243 L43.757,8.485 L43.757,5.000 L0.000,5.000 L0.000,4.000 L43.757,4.000 L43.757,0.000 L48.000,4.243 Z" class="cls-1"></path></svg>';
		}
		if ( 'style-4' === $button_style ) {
			$button_text = $icons_before . esc_html( $button_text ) . $icons_after;
		}
		if ( 'style-6' === $button_style ) {
			$button_text = esc_html( $button_text );
		}
		if ( 'style-7' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<span class="btn-arrow"></span>';
		}
		if ( 'style-9' === $button_style ) {
			$button_text = esc_html( $button_text ) . '<span class="btn-arrow"><i class="fa-show fas fa-chevron-right" aria-hidden="true"></i><i class="fa-hide fas fa-chevron-right" aria-hidden="true"></i></span>';
		}
		if ( 'style-11' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}
		if ( 'style-12' === $button_style || 'style-15' === $button_style || 'style-16' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}
		if ( 'style-13' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}
		if ( 'style-14' === $button_style ) {
			$button_text = '<span>' . $icons_before . esc_html( $button_text ) . $icons_after . '</span>';
		}
		if ( 'style-17' === $button_style ) {
			if ( 'font_awesome_5' === $btn_icon_style ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
				ob_end_clean();
				$icons_before = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
			$button_text = $icons_before . '<span>' . esc_html( $button_text ) . '</span>';
		}
		if ( 'style-18' === $button_style || 'style-19' === $button_style || 'style-20' === $button_style || 'style-21' === $button_style || 'style-22' === $button_style ) {
			$button_text = $icons_before . '<span>' . esc_html( $button_text ) . '</span>' . $icons_after;
		}
		if ( 'style-24' === $button_style ) {
			$button_24_tag = '';
			$btn_24txt     = ! empty( $settings['button_24_text'] ) ? $settings['button_24_text'] : '';

			if ( ! empty( $btn_24txt ) ) {
				$button_24_tag = '<span class="button-tag-hint">' . wp_kses_post( $btn_24txt ) . '</span>';
			}
			$button_text = $icons_before . '<span>' . $button_24_tag . wp_kses_post( $button_text ) . '</span>' . $icons_after;
		}

		return $button_text . $style_content;
	}
}
