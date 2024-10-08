<?php
/**
 * Widget Name: Number Counter
 * Description: Display style of count numbers.
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
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Number_Counter.
 */
class ThePlus_Number_Counter extends Widget_Base {

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
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-number-counter';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Number Counter', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-hashtag theplus_backend_icon';
	}

	/**
	 * Get Widget Categories.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keywords.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Number Counter', 'Counter Widget', 'Number Counter Elementor', 'Elementor Number Counter', 'Counter', 'Number Counter Addon', 'Elementor Counter', 'Elementor Plus Addons Number Counter' );
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
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Style Counter', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list( 2 ),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'devices'      => array( 'desktop', 'tablet', 'mobile' ),
				'default'      => 'center',
				'prefix_class' => 'text-%s',
				'label_block'  => false,
				'toggle'       => false,
				'condition'    => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'alignment_2',
			array(
				'label'        => esc_html__( 'Alignment', 'theplus' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'      => 'left',
				'prefix_class' => 'text-%s',
				'label_block'  => false,
				'toggle'       => false,
				'condition'    => array(
					'style' => 'style-2',
				),
			)
		);
		$this->end_controls_section();

		/** Number Counter Section Start*/
		$this->start_controls_section(
			'number_content_section',
			array(
				'label' => esc_html__( 'Number Counting', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'max_number',
			array(
				'label'       => wp_kses_post( "Number Value <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "animated-number-counter-for-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => esc_html__( '1000', 'theplus' ),
				'description' => esc_html__( 'Enter the value of number/digits you want to showcase in icon counter. E.g, 100,999,etc..', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'min_number',
			array(
				'label'       => esc_html__( 'Animation Starting Number Value', 'theplus' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => esc_html__( '0', 'theplus' ),
				'description' => esc_html__( 'Enter the digit from which you want to start the animation on scroll. E.g. 0,10,80, etc', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'increment_number',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Number Gap For Animation', 'theplus' ),
				'default'     => array(
					'unit' => '',
					'size' => 5,
				),
				'range'       => array(
					'' => array(
						'min'  => 0,
						'max'  => 5000,
						'step' => 5,
					),
				),
				'dynamic'     => array( 'active' => true ),
				'description' => esc_html__( 'Enter the value of number you want while animation.', 'theplus' ),
			)
		);
		$this->add_control(
			'delay_number',
			array(
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Time delay In Animation Gap', 'theplus' ),
				'default' => array(
					'unit' => '',
					'size' => 5,
				),
				'range'   => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 10,
					),
				),
				'dynamic' => array( 'active' => true ),
			)
		);
		$this->add_control(
			'symbol',
			array(
				'label'       => esc_html__( 'Symbol', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'You can add any value in this option which will be setup as prefix or postfix on Digits. e.g. +,%,etc.', 'theplus' ),
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'symbol_position',
			array(
				'label'       => esc_html__( 'Symbol Position', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'after',
				'options'     => array(
					'after'  => esc_html__( 'After Number', 'theplus' ),
					'before' => esc_html__( 'Before Number', 'theplus' ),
				),
				'description' => esc_html__( 'You can Select Symbol position using this option.', 'theplus' ),
			)
		);
		$this->end_controls_section();

		/** Icon Section Start*/
		$this->start_controls_section(
			'icon_content_section',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'icon_type',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'icon',
				'options'     => array(
					''       => esc_html__( 'None', 'theplus' ),
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'svg'    => esc_html__( 'Svg', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
				'description' => esc_html__( 'You can select Icon, Custom Image or SVG or Lottie using this option.', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_font_style',
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
					'icon_type' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-download',
				'condition' => array(
					'icon_type'       => 'icon',
					'icon_font_style' => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-download',
					'library' => 'solid',
				),
				'condition' => array(
					'icon_type'       => 'icon',
					'icon_font_style' => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => '',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'icon_type'       => 'icon',
					'icon_font_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'svg_icon',
			array(
				'label'     => esc_html__( 'SVG Select Option', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'img',
				'options'   => array(
					'img' => esc_html__( 'Custom Upload', 'theplus' ),
					'svg' => esc_html__( 'Pre Built SVG Icon', 'theplus' ),
				),
				'condition' => array(
					'icon_type' => 'svg',
				),
			)
		);
		$this->add_control(
			'svg_image',
			array(
				'label'       => esc_html__( 'Only SVG', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'icon_type' => 'svg',
					'svg_icon'  => 'img',
				),
			)
		);
		$this->add_control(
			'svg_d_icon',
			array(
				'label'     => esc_html__( 'Select SVG Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'app.svg',
				'options'   => theplus_svg_icons_list(),
				'condition' => array(
					'icon_type' => 'svg',
					'svg_icon'  => 'svg',
				),
			)
		);
		$this->add_control(
			'icon_image',
			array(
				'label'     => esc_html__( 'Choose Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icon_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_control(
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array( 'icon_type' => 'lottie' ),
			)
		);
		$this->add_control(
			'url_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url' => '',
				),
			)
		);
		$this->end_controls_section();

		/** SVG Style Section Start*/
		$this->start_controls_section(
			'section_svg_styling',
			array(
				'label'     => esc_html__( 'SVG', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type' => 'svg',
				),
			)
		);
		$this->add_control(
			'svg_type',
			array(
				'label'   => esc_html__( 'Select Style Image', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'delayed',
				'options' => theplus_svg_type(),
			)
		);
		$this->add_control(
			'duration',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Duration', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
			)
		);
		$this->add_control(
			'max_width',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Max Width SVG', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'condition'  => array(
					'svg_icon' => array( 'svg', 'img' ),
				),
			)
		);
		$this->add_control(
			'border_stroke_color',
			array(
				'label'   => esc_html__( 'Border/Stoke Color', 'theplus' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ff0000',
			)
		);
		$this->end_controls_section();

		/** Icon Style Section Start*/
		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'     => esc_html__( 'Icon', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type' => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_style',
			array(
				'label'   => esc_html__( 'Icon Styles', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => array(
					''              => esc_html__( 'None', 'theplus' ),
					'square'        => esc_html__( 'Square', 'theplus' ),
					'rounded'       => esc_html__( 'Rounded', 'theplus' ),
					'hexagon'       => esc_html__( 'Hexagon', 'theplus' ),
					'pentagon'      => esc_html__( 'Pentagon', 'theplus' ),
					'square-rotate' => esc_html__( 'Square Rotate', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
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
					'size' => 25,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon svg' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_control(
			'icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 50,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_color_option',
			array(
				'label'       => esc_html__( 'Icon Color', 'theplus' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',

			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'icon_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color1_control',
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
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_color2_control',
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
					'icon_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'icon_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'icon_color_option'   => 'gradient',
					'icon_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'icon_style!' => array( '', 'hexagon', 'pentagon', 'square-rotate' ),
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
					'{{WRAPPER}} .plus-number-counter .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_box_shadow',
				'selector'  => '{{WRAPPER}} .plus-number-counter .counter-icon-inner',
				'condition' => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'icon_hover_color_option',
			array(
				'label'       => esc_html__( 'Icon Hover Color', 'theplus' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_hover_color_option' => 'solid',
				),
				'separator' => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color1_control',
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
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_color2_control',
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
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'icon_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'icon_hover_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
				'separator'  => 'after',
			)
		);
		$this->add_control(
			'icon_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner .counter-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'icon_hover_color_option'   => 'gradient',
					'icon_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'icon_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'icon_style!' => array( '', 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-icon-inner',
				'condition' => array(
					'icon_style!' => array( 'hexagon', 'pentagon', 'square-rotate' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Image Styel Section Start*/
		$this->start_controls_section(
			'section_icon_image_styling',
			array(
				'label'     => esc_html__( 'Image', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);
		$this->add_responsive_control(
			'image_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Image Width', 'theplus' ),
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
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .counter-image-inner' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		/** Lottie Style Section Start*/
		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label'     => esc_html__( 'Lottie', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array( 'icon_type' => 'lottie' ),
			)
		);
		$this->add_control(
			'lottiedisplay',
			array(
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Display', 'theplus' ),
				'default' => 'inline-block',
				'options' => array(
					'block'        => esc_html__( 'Block', 'theplus' ),
					'inline-block' => esc_html__( 'Inline Block', 'theplus' ),
					'flex'         => esc_html__( 'Flex', 'theplus' ),
					'inline-flex'  => esc_html__( 'Inline Flex', 'theplus' ),
					'initial'      => esc_html__( 'Initial', 'theplus' ),
					'inherit'      => esc_html__( 'Inherit', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'lottieWidth',
			array(
				'label'   => esc_html__( 'Width', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 50,
				),
			)
		);
		$this->add_responsive_control(
			'lottieHeight',
			array(
				'label'   => esc_html__( 'Height', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 50,
				),
			)
		);
		$this->add_responsive_control(
			'lottieSpeed',
			array(
				'label'   => esc_html__( 'Speed', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 1,
				),
			)
		);
		$this->add_control(
			'lottieLoop',
			array(
				'label'     => esc_html__( 'Loop Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'lottiehover',
			array(
				'label'     => esc_html__( 'Hover Animation', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		/** Title Style Section Start*/
		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'title_color_option',
			array(
				'label'       => esc_html__( 'Title Color', 'theplus' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_color_option' => 'solid',
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
					'title_color_option' => 'gradient',
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
					'title_color_option' => 'gradient',
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
					'title_color_option' => 'gradient',
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
					'title_color_option' => 'gradient',
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
					'title_color_option' => 'gradient',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_color_option'   => 'gradient',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title a' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_color_option'   => 'gradient',
					'title_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'title_hover_color_option',
			array(
				'label'       => esc_html__( 'Title Hover Color', 'theplus' ),
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
				),
				'label_block' => false,
				'default'     => 'solid',
			)
		);
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_hover_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color1_control',
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
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_color2_control',
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
					'title_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'title_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-title a' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'title_hover_color_option'   => 'gradient',
					'title_hover_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'title_top_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Title Top Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-top : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'title_btm_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Title Bottom Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		/** Digit Style Section Start*/
		$this->start_controls_section(
			'section_digit_option',
			array(
				'label' => esc_html__( 'Digit', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'digit_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number',
			)
		);
		$this->start_controls_tabs( 'digit_gradient' );
		$this->start_controls_tab(
			'digit_gradient_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'digit_gradient_color',
			array(
				'label'       => esc_html__( 'Gradient Color', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color'    => array(
						'title' => esc_html__( 'Classic', 'theplus' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'theplus' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'color',
			)
		);
		$this->add_control(
			'digit_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'selectors' => array(
					'{{WRAPPER}} .counter-number .number-counter-inner-block .counter-number' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color1_control',
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
					'digit_gradient_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_color2_control',
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
					'digit_gradient_color' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'digit_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => '-webkit-background-clip:text !important;-webkit-text-fill-color: transparent; background: linear-gradient({{SIZE}}{{UNIT}}, {{digit_gradient_color1.VALUE}} {{digit_gradient_color1_control.SIZE}}{{digit_gradient_color1_control.UNIT}}, {{digit_gradient_color2.VALUE}} {{digit_gradient_color2_control.SIZE}}{{digit_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'digit_gradient_color' => 'gradient',
					'digit_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'normal_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{digit_gradient_color1.VALUE}} {{digit_gradient_color1_control.SIZE}}{{digit_gradient_color1_control.UNIT}}, {{digit_gradient_color2.VALUE}} {{digit_gradient_color2_control.SIZE}}{{digit_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'digit_gradient_color' => 'gradient',
					'digit_gradient_style' => array( 'radial' ),
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'style_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'digit_gradient_color' => 'color',
				),
			)
		);
		$this->add_control(
            'symbol_color',
            array(
                'label'     => esc_html__( 'Symbol Color', 'tpebl' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number .number-counter-symbol' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'digit_gradient_color' => 'color',
                ),
            )
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'gradient_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'gradient_hover_color_option',
			array(
				'label'       => esc_html__( 'Gradient Hover Color', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'color'    => array(
						'title' => esc_html__( 'Classic', 'theplus' ),
						'icon'  => 'eicon-paint-brush',
					),
					'gradient' => array(
						'title' => esc_html__( 'Gradient', 'theplus' ),
						'icon'  => 'eicon-barcode',
					),
				),
				'label_block' => false,
				'default'     => 'color',
			)
		);
		$this->add_control(
			'hover_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color1_control',
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
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_color2_control',
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
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_angle',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => '-webkit-background-clip:text !important;-webkit-text-fill-color: transparent; background: linear-gradient({{SIZE}}{{UNIT}}, {{hover_gradient_color1.VALUE}} {{hover_gradient_color1_control.SIZE}}{{hover_gradient_color1_control.UNIT}}, {{hover_gradient_color2.VALUE}} {{hover_gradient_color2_control.SIZE}}{{hover_gradient_color2_control.UNIT}})',
				),
				'condition'  => array(
					'gradient_hover_color_option' => 'gradient',
					'hover_gradient_style'        => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'hover_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number,{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{hover_gradient_color1.VALUE}} {{hover_gradient_color1_control.SIZE}}{{hover_gradient_color1_control.UNIT}}, {{hover_gradient_color2.VALUE}} {{hover_gradient_color2_control.SIZE}}{{hover_gradient_color2_control.UNIT}})',
				),
				'condition' => array(
					'gradient_hover_color_option' => 'gradient',
					'hover_gradient_style'        => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'style_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'gradient_hover_color_option' => 'color',
				),
			)
		);
		$this->add_control(
            'symbol_hover_color',
            array(
                'label'     => esc_html__( 'Symbol Hover Color', 'tpebl' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover .counter-number .number-counter-symbol' => 'color: {{VALUE}}',
                ),
                'condition' => array(
                    'gradient_hover_color_option' => 'color',
                ),
            )
        );
		$this->end_controls_tabs();
		$this->add_control(
			'number_top_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Number Top Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'step' => 2,
						'min'  => -150,
						'max'  => 150,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'separator'   => 'before',
				'selectors'   => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block .counter-number' => 'margin-top : {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		/** Background Style Section Start*/
		$this->start_controls_section(
			'section_bg_option_styling',
			array(
				'label' => esc_html__( 'Background Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => theplus_get_border_style(),
				'default'   => 'solid',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'box_border_width',
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
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-number-counter .number-counter-inner-block:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Extra Option Start*/
		$this->start_controls_section(
			'section_extra_option_styling',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'box_padding',
			array(
				'label'      => esc_html__( 'Box Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-number-counter .number-counter-inner-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'vertical_center',
			array(
				'label'     => esc_html__( 'Vertical Center', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'style' => array( 'style-2' ),
				),
			)
		);
		$this->add_control(
			'box_hover_effects',
			array(
				'label'     => esc_html__( 'Box Hover Effects', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_get_content_hover_effect_options(),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'box_hover_shadow_color',
			array(
				'label'     => esc_html__( 'Shadow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.6)',
				'condition' => array(
					'box_hover_effects' => array( 'float_shadow', 'grow_shadow', 'shadow_radial' ),
				),
			)
		);
		$this->add_control(
			'box_hover_shadow_color_note',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note : Works in Frontend.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'box_hover_effects' => array( 'float_shadow', 'grow_shadow', 'shadow_radial' ),
				),
			)
		);
		$this->end_controls_section();

		/** Adv tab Section Start*/
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
	 * Render Number Counter.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/*--Plus Extra ---*/
		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$hover_class = '';
		$hover_attr  = '';

		$style  = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';
		$symbol = ! empty( $settings['symbol'] ) ? $settings['symbol'] : '';

		$alignment  = 'text-' . $settings['alignment'];
		$min_number = isset( $settings['min_number'] ) ? $settings['min_number'] : '';
		$max_number = ! empty( $settings['max_number'] ) ? $settings['max_number'] : '';

		$delay_number = ! empty( $settings['delay_number']['size'] ) ? $settings['delay_number']['size'] : '';

		$symbol_position   = ! empty( $settings['symbol_position'] ) ? $settings['symbol_position'] : '';
		$increment_number  = ! empty( $settings['increment_number']['size'] ) ? $settings['increment_number']['size'] : '';
		$box_hover_effects = ! empty( $settings['box_hover_effects'] ) ? $settings['box_hover_effects'] : '';

		$hover_uniqid = uniqid( 'hover-effect' );
		if ( 'float_shadow' === $box_hover_effects || 'grow_shadow' === $box_hover_effects || 'shadow_radial' === $box_hover_effects ) {
			$hover_attr .= 'data-hover_uniqid="' . esc_attr( $hover_uniqid ) . '" ';
			$hover_attr .= ' data-hover_shadow="' . esc_attr( $settings['box_hover_shadow_color'] ) . '" ';
			$hover_attr .= ' data-content_hover_effects="' . esc_attr( $box_hover_effects ) . '" ';
		}

		if ( 'grow' === $box_hover_effects ) {
			$hover_class .= 'content_hover_grow';
		} elseif ( 'push' === $box_hover_effects ) {
			$hover_class .= 'content_hover_push';
		} elseif ( 'bounce-in' === $box_hover_effects ) {
			$hover_class .= 'content_hover_bounce_in';
		} elseif ( 'float' === $box_hover_effects ) {
			$hover_class .= 'content_hover_float';
		} elseif ( 'wobble_horizontal' === $box_hover_effects ) {
			$hover_class .= 'content_hover_wobble_horizontal';
		} elseif ( 'wobble_vertical' === $box_hover_effects ) {
			$hover_class .= 'content_hover_wobble_vertical';
		} elseif ( 'float_shadow' === $box_hover_effects ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_float_shadow';
		} elseif ( 'grow_shadow' === $box_hover_effects ) {
			$hover_class .= ' ' . esc_attr( $hover_uniqid ) . ' content_hover_grow_shadow';
		} elseif ( 'shadow_radial' === $box_hover_effects ) {
			$hover_class .= '' . esc_attr( $hover_uniqid ) . ' content_hover_radial';
		}

		$icon_link_a = '';

		$icon_link_a_close = '';
		if ( ! empty( $settings['url_link']['url'] ) ) {
			$this->add_render_attribute( 'url_link', 'href', esc_url( $settings['url_link']['url'] ) );
			if ( $settings['url_link']['is_external'] ) {
				$this->add_render_attribute( 'url_link', 'target', '_blank' );
			}

			if ( $settings['url_link']['nofollow'] ) {
				$this->add_render_attribute( 'url_link', 'rel', 'nofollow' );
			}

			$icon_link_a = '<a ' . $this->get_render_attribute_string( 'url_link' ) . '>';

			$icon_link_a_close = '</a>';
		}

		if ( ! empty( $symbol ) ) {
			if ( 'after' === $symbol_position ) {
				$number_symbol = '<span class="counter-number-inner numscroller" data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span><span class="number-counter-symbol">' . esc_html( $symbol ) . '</span>';
			} elseif ( 'before' === $symbol_position ) {
				$number_symbol = '<span class="number-counter-symbol">' . esc_html( $symbol ) . '</span><span class="counter-number-inner numscroller"  data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span>';
			}
		} else {
			$number_symbol = '<span class="counter-number-inner numscroller" data-min="' . esc_attr( $min_number ) . '" data-max="' . esc_attr( $max_number ) . '" data-delay="' . esc_attr( $delay_number ) . '" data-increment="' . esc_attr( $increment_number ) . '">' . esc_html( $min_number ) . '</span>';
		}

		$icon_img_ic = '';
		if ( 'image' === $settings['icon_type'] && ! empty( $settings['icon_image'] ) && ! empty( $settings['icon_image']['url'] ) ) {
			$icon_img_ic .= '<div class="counter-image-inner">';
			$icon_image   = $settings['icon_image']['id'];

			$img_src = tp_get_image_rander( $icon_image, $settings['icon_image_thumbnail_size'], array( 'class' => 'counter-icon-image' ) );

			if ( ! empty( $img_src ) && isset( $img_src ) ) {
				$icon_img_ic .= $img_src;
			} else {
				$icon_img_ic .= '<img class="counter-icon-image" src=' . Utils::get_placeholder_image_src() . ' alt="" />';
			}

			$icon_img_ic .= '</div>';

		} elseif ( 'icon' === $settings['icon_type'] ) {
			$icons = '';
			if ( 'font_awesome' === $settings['icon_font_style'] ) {
				$icons = $settings['icon_fontawesome'];
			} elseif ( 'font_awesome_5' === $settings['icon_font_style'] ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
				ob_end_clean();
			} elseif ( 'icon_mind' === $settings['icon_font_style'] ) {
				$icons = $settings['icons_mind'];
			}

			$icon_bg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['icon_background_image'], $settings['icon_hover_background_image'] ) : '';

			$icon_img_ic .= '<div class="counter-icon-inner ' . esc_attr( $icon_bg ) . ' shape-icon-' . esc_attr( $settings['icon_style'] ) . '">';

			if ( 'font_awesome_5' === $settings['icon_font_style'] ) {
				$icon_img_ic .= '<span class="counter-icon">' . $icons . '</span>';
			} else {
				$icon_img_ic .= '<span class="counter-icon ' . esc_attr( $icons ) . '"></span>';
			}

			$icon_img_ic .= '</div>';

		} elseif ( 'svg' === $settings['icon_type'] ) {

			if ( 'img' === $settings['svg_icon'] ) {
				$svg_url = $settings['svg_image']['url'];
			} else {
				$svg_url = THEPLUS_URL . 'assets/images/svg/' . esc_attr( $settings['svg_d_icon'] );
			}

			if ( ! empty( $settings['border_stroke_color'] ) ) {
				$border_stroke_color = $settings['border_stroke_color'];
			} else {
				$border_stroke_color = 'none';
			}

			$svg_uid = uniqid( 'svg' );

			$icon_img_ic = '<div class="pt_plus_animated_svg ' . esc_attr( $svg_uid ) . '" data-id="' . esc_attr( $svg_uid ) . '" data-type="' . esc_attr( $settings['svg_type'] ) . '" data-duration="' . esc_attr( $settings['duration']['size'] ) . '" data-stroke="' . esc_attr( $border_stroke_color ) . '" data-fill_color="none">';

				$icon_img_ic .= '<div class="svg_inner_block" style="max-width:' . esc_attr( $settings['max_width']['size'] ) . esc_attr( $settings['max_width']['unit'] ) . ';max-height:' . esc_attr( $settings['max_width']['size'] ) . esc_attr( $settings['max_width']['unit'] ) . ';">';

					$icon_img_ic .= '<object id="' . esc_attr( $svg_uid ) . '" type="image/svg+xml" data="' . esc_url( $svg_url ) . '" ></object>';

				$icon_img_ic .= '</div>';

			$icon_img_ic .= '</div>';
		} elseif ( ! empty( $settings['icon_type'] ) && 'lottie' === $settings['icon_type'] ) {

			$ext = pathinfo( $settings['lottieUrl']['url'], PATHINFO_EXTENSION );

			if ( 'json' !== $ext ) {
				$icon_img_ic .= '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
			} else {
				$lottie_loop = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
				$lottiehover = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';

				$lottie_width  = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 50;
				$lottie_speed  = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;
				$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 50;
				$lottiedisplay = isset( $settings['lottiedisplay'] ) ? $settings['lottiedisplay'] : 'inline-block';

				$lottie_loop_value = '';
				if ( ! empty( $settings['lottieLoop'] ) && 'yes' === $settings['lottieLoop'] ) {
					$lottie_loop_value = 'loop';
				}

				$lottie_anim = 'autoplay';
				if ( ! empty( $settings['lottiehover'] ) && 'yes' === $settings['lottiehover'] ) {
					$lottie_anim = 'hover';
				}

				$icon_img_ic .= '<lottie-player src="' . esc_url( $settings['lottieUrl']['url'] ) . '" style="display: ' . esc_attr( $lottiedisplay ) . '; width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
			}
		}

		$number_markup = '';
		if ( ! empty( $max_number ) ) {
			$number_markup = '<h5 class="counter-number">' . $number_symbol . '</h5>';
		}

		$title = '';
		if ( ! empty( $settings['title'] ) ) {
			$title = '<h6 class="counter-title">' . $icon_link_a . wp_kses_post( $settings['title'] ) . $icon_link_a_close . '</h6>';
		}
		$vertical_center = '';
		if ( 'style-2' === $style && 'yes' === $settings['vertical_center'] ) {
			$vertical_center = 'vertical-center';
		}

		$nc_bg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] ) : '';

		$counter_content = '<div class="number-counter-inner-block ' . esc_attr( $nc_bg ) . ' ' . esc_attr( $vertical_center ) . '">';
		if ( 'style-1' === $style ) {
			$counter_content .= '<div class="counter-wrap-content" >';

				$counter_content .= $icon_link_a . $icon_img_ic . $icon_link_a_close;
				$counter_content .= $number_markup;
				$counter_content .= $title;

			$counter_content .= '</div>';
		} elseif ( 'style-2' === $style ) {
			$counter_content .= '<div class="icn-header">';

				$counter_content .= $icon_link_a . $icon_img_ic . $icon_link_a_close;

			$counter_content .= '</div>';
			$counter_content .= '<div class="counter-content">';

				$counter_content .= $number_markup;
				$counter_content .= $title;

			$counter_content .= '</div>';
		} else {
			$counter_content .= '<div class="counter-wrap-content" >' . $number_markup . ' ' . $title . ' </div>';
		}

		$counter_content .= '</div>';

		$uid = uniqid( 'counter' );

		$icon_counter = '<div class=" content_hover_effect ' . esc_attr( $hover_class ) . '" ' . $hover_attr . '>';

			$icon_counter .= '<div class="plus-number-counter counter-' . esc_attr( $style ) . ' ' . esc_attr( $uid ) . ' ' . $animated_class . '" data-id="' . esc_attr( $uid ) . '" ' . $animation_attr . '>';

					$icon_counter .= $counter_content;

			$icon_counter .= '</div>';

		$icon_counter .= '</div>';

		echo $before_content . $icon_counter . $after_content;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.2.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}
