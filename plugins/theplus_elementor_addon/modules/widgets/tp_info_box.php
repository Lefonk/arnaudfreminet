<?php
/**
 * Widget Name: Info Box
 * Description: Display Infobox.
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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

/**
 * Exit if accessed directly
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ThePlus_Info_Box
 */
class ThePlus_Info_Box extends Widget_Base {

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
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-info-box';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Info Box', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-info-circle theplus_backend_icon';
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Info Box', 'Information Box', 'Content Box', 'Text Box', 'Feature Box', 'Icon Box', 'Callout Box', 'Highlight Box', 'Notification Box', 'Alert Box', 'Message Box', 'Card Box', 'Box Widget', 'Box Element', 'Box Container' );
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

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'info_box_layout',
			array(
				'label'   => esc_html__( 'Select Layout', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'single_layout',
				'options' => array(
					'single_layout'   => esc_html__( 'Listing', 'theplus' ),
					'carousel_layout' => esc_html__( 'Carousel', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_single_layout',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "show-services-box-in-wordpress-using-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'info_box_layout' => array( 'single_layout' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_carousel_layout',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-an-infobox-service-box-carousel-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'info_box_layout' => array( 'carousel_layout' ),
				),
			)
		);
		$this->add_control(
			'main_style',
			array(
				'label'   => esc_html__( 'Info Box Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1'  => esc_html__( 'Style-1', 'theplus' ),
					'style_2'  => esc_html__( 'Style-2', 'theplus' ),
					'style_3'  => esc_html__( 'Style-3', 'theplus' ),
					'style_4'  => esc_html__( 'Style-4', 'theplus' ),
					'style_7'  => esc_html__( 'Style-5', 'theplus' ),
					'style_11' => esc_html__( 'Style-6', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'loop_select_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image or SVG using this option.', 'theplus' ),
				'default'     => '',
				'options'     => array(
					''       => esc_html__( 'None', 'theplus' ),
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'svg'    => esc_html__( 'Svg', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'loop_display_button',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'loop_button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'theplus' ),
				'default'   => 'style-7',
				'options'   => array(
					'style-7' => esc_html__( 'Style 1', 'theplus' ),
					'style-8' => esc_html__( 'Style 2', 'theplus' ),
					'style-9' => esc_html__( 'Style 3', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout'     => 'carousel_layout',
					'loop_display_button' => 'yes',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_title',
			array(
				'label'   => esc_html__( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'The Plus', 'theplus' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'loop_content_desc',
			array(
				'label'   => esc_html__( 'Description', 'theplus' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'theplus' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'loop_url_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'dynamic'       => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'loop_image_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image or SVG using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''       => esc_html__( 'None', 'theplus' ),
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'svg'    => esc_html__( 'Svg', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'loop_svg_icon',
			array(
				'label'     => esc_html__( 'Svg Select Option', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'img',
				'options'   => array(
					'img' => esc_html__( 'Custom Upload', 'theplus' ),
					'svg' => esc_html__( 'Pre Built SVG Icon', 'theplus' ),
				),
				'condition' => array(
					'loop_image_icon' => 'svg',
				),
			)
		);
		$repeater->add_control(
			'loop_svg_image',
			array(
				'label'       => esc_html__( 'Only Svg', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'loop_image_icon' => 'svg',
					'loop_svg_icon'   => 'img',
				),
			)
		);
		$repeater->add_control(
			'loop_svg_d_icon',
			array(
				'label'     => esc_html__( 'Select Svg Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'app.svg',
				'options'   => theplus_svg_icons_list(),
				'condition' => array(
					'loop_image_icon' => 'svg',
					'loop_svg_icon'   => 'svg',
				),
			)
		);
		$repeater->add_control(
			'loop_max_width',
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
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box {{CURRENT_ITEM}}.info-box-inner .info_box_svg svg' => 'max-width: {{SIZE}}{{UNIT}};max-height: {{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'loop_image_icon' => 'svg',
					'loop_svg_icon'   => array( 'svg', 'img' ),
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
				'dynamic'    => array(
					'active' => true,
				),
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
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'loop_image_icon' => 'lottie',
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
			'loop_button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'theplus' ),
				'placeholder' => esc_html__( 'Read More', 'theplus' ),
			)
		);
		$repeater->add_control(
			'loop_button_link',
			array(
				'label'       => esc_html__( 'Button Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
			)
		);
		$repeater->add_control(
			'loopbgimageheading',
			array(
				'label'     => esc_html__( 'Background Image Normal & Hover', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loopbgimage',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box {{CURRENT_ITEM}}.info-box-inner .info-box-bg-box',
			)
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'loopbgimagehover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .pt_plus_info_box.hover_normal {{CURRENT_ITEM}}.info-box-inner:hover .info-box-bg-box, {{WRAPPER}} .pt_plus_info_box.hover_normal {{CURRENT_ITEM}}.info-box-inner.tp-info-active .info-box-bg-box, {{WRAPPER}} .pt_plus_info_box.hover_fadein .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_left .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_right .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_top .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_bottom .infobox-overlay-color',
			)
		);
		$repeater->add_control(
			'r_full_infobox_switch',
			array(
				'label'     => esc_html__( 'Full Infobox Link', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'r_full_infobox_link',
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
					'r_full_infobox_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'loop_content',
			array(
				'label'       => esc_html__( 'Carousel InfoBox', 'theplus' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'loop_title' => 'The Plus',
					),
					array(
						'loop_title' => 'The Plus 2',
					),
					array(
						'loop_title' => 'The Plus 3',
					),
					array(
						'loop_title' => 'The Plus 4',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ loop_title }}}',
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'loop_title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h6',
				'options'   => theplus_get_tags_options(),
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'connection_switch',
			array(
				'label'     => esc_html__( 'Carousel Anything Connection', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'connection_unique_id',
			array(
				'label'     => esc_html__( 'Connection Carousel ID', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array(
					'info_box_layout'   => 'carousel_layout',
					'connection_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'default_active',
			array(
				'label'     => esc_html__( 'Default Active', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '50',
				'options'   => array(
					'0'  => esc_html__( '1', 'theplus' ),
					'1'  => esc_html__( '2', 'theplus' ),
					'2'  => esc_html__( '3', 'theplus' ),
					'3'  => esc_html__( '4', 'theplus' ),
					'4'  => esc_html__( '5', 'theplus' ),
					'5'  => esc_html__( '6', 'theplus' ),
					'6'  => esc_html__( '7', 'theplus' ),
					'7'  => esc_html__( '8', 'theplus' ),
					'8'  => esc_html__( '9', 'theplus' ),
					'9'  => esc_html__( '10', 'theplus' ),
					'10' => esc_html__( '11', 'theplus' ),
					'11' => esc_html__( '12', 'theplus' ),
					'12' => esc_html__( '13', 'theplus' ),
					'13' => esc_html__( '14', 'theplus' ),
					'14' => esc_html__( '15', 'theplus' ),
					'15' => esc_html__( '16', 'theplus' ),
					'16' => esc_html__( '17', 'theplus' ),
					'17' => esc_html__( '18', 'theplus' ),
					'18' => esc_html__( '19', 'theplus' ),
					'19' => esc_html__( '20', 'theplus' ),
					'50' => esc_html__( 'None', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout'   => 'carousel_layout',
					'connection_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'connection_hover_click',
			array(
				'label'     => esc_html__( 'Effect on', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'con_pro_hover',
				'options'   => array(
					'con_pro_hover' => esc_html__( 'Hover', 'theplus' ),
					'con_pro_click' => esc_html__( 'Click', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout'   => 'carousel_layout',
					'connection_switch' => 'yes',
				),
			)
		);
		$this->add_control(
			'title',
			array(
				'label'     => esc_html__( 'Title Of Info Box', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'The Plus', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'content_desc',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'placeholder' => esc_html__( 'Type your description here', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Info Box Alignment', 'theplus' ),
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
				'default'   => 'center',
				'toggle'    => true,
				'separator' => 'before',
				'condition' => array(
					'main_style' => 'style_3',
				),
			)
		);
		$this->add_control(
			'url_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default'       => array(
					'url' => '',
				),
				'dynamic'       => array(
					'active' => true,
				),
				'condition'     => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'image_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon, Custom Image or SVG using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''       => esc_html__( 'None', 'theplus' ),
					'icon'   => esc_html__( 'Icon', 'theplus' ),
					'image'  => esc_html__( 'Image', 'theplus' ),
					'svg'    => esc_html__( 'Svg', 'theplus' ),
					'lottie' => esc_html__( 'Lottie', 'theplus' ),
				),
				'separator'   => 'before',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'how_it_works_image',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "create-elementor-image-box/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'image_icon' => array( 'image' ),
				),
			)
		);
		$this->add_control(
			'how_it_works_lottie',
			array(
				'label'     => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "lottie-animation-in-infobox-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> How it works <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'image_icon' => array( 'lottie' ),
				),
			)
		);
		$this->add_control(
			'svg_icon',
			array(
				'label'     => esc_html__( 'Svg Select Option', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'img',
				'options'   => array(
					'img' => esc_html__( 'Custom Upload', 'theplus' ),
					'svg' => esc_html__( 'Pre Built SVG Icon', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'svg',
				),
			)
		);
		$this->add_control(
			'svg_image',
			array(
				'label'       => esc_html__( 'Only Svg', 'theplus' ),
				'type'        => Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select Only .svg File from media library.', 'theplus' ),
				'default'     => array(
					'url' => '',
				),
				'media_type'  => 'image',
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'svg',
					'svg_icon'        => 'img',
				),
			)
		);
		$this->add_control(
			'svg_d_icon',
			array(
				'label'     => esc_html__( 'Select Svg Icon', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'app.svg',
				'options'   => theplus_svg_icons_list(),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'svg',
					'svg_icon'        => 'svg',
				),
			)
		);

		$this->add_control(
			'select_image',
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
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'select_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'image',
				),
			)
		);
		$this->add_control(
			'lottieUrl',
			array(
				'label'       => esc_html__( 'Lottie URL', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'lottie',
				),
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
					'icon_image'     => esc_html__( 'Icon Image', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
				),
			)
		);
		$this->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
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
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
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
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
					'icon_font_style' => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'icons_image',
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
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
					'icon_font_style' => 'icon_image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icons_image_thumbnail',
				'default'   => 'full',
				'separator' => 'after',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'image_icon'      => 'icon',
					'icon_font_style' => 'icon_image',
				),
			)
		);
		$this->add_control(
			'display_button',
			array(
				'label'     => esc_html__( 'Button', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'theplus' ),
				'default'   => 'style-7',
				'options'   => array(
					'style-7' => esc_html__( 'Style 1', 'theplus' ),
					'style-8' => esc_html__( 'Style 2', 'theplus' ),
					'style-9' => esc_html__( 'Style 3', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
				),
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => esc_html__( 'Read More', 'theplus' ),
				'placeholder' => esc_html__( 'Read More', 'theplus' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
				),
			)
		);
		$this->add_control(
			'button_link',
			array(
				'label'       => esc_html__( 'Button Link', 'theplus' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'theplus' ),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
				),
			)
		);
		$this->add_control(
			'button_icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					''               => esc_html__( 'None', 'theplus' ),
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
				),
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style!'   => array( 'style-7', 'style-9' ),
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
					'info_box_layout'   => 'single_layout',
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
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
					'info_box_layout'   => 'single_layout',
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
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
					'info_box_layout'   => 'single_layout',
					'display_button'    => 'yes',
					'button_style!'     => array( 'style-7', 'style-9' ),
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
					'info_box_layout'    => 'single_layout',
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => '',
				),
			)
		);
		$this->add_control(
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
					'info_box_layout'    => 'single_layout',
					'display_button'     => 'yes',
					'button_style!'      => array( 'style-7', 'style-9' ),
					'button_icon_style!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .button-link-wrap .button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap .button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'hover_info_button',
			array(
				'label'     => esc_html__( 'Hover Button InfoBox', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'display_button'  => 'yes',
					'button_style'    => array( 'style-8' ),
				),
			)
		);
		$this->add_control(
			'display_pin_text',
			array(
				'label'     => esc_html__( 'Display Pin Text', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => 'style_3',
				),
			)
		);
		$this->add_control(
			'pin_text_title',
			array(
				'label'     => esc_html__( 'Pin Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'New', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'info_box_layout'  => 'single_layout',
					'main_style'       => 'style_3',
					'display_pin_text' => 'yes',
				),
			)
		);
		$this->add_control(
			'title_tag',
			array(
				'label'     => esc_html__( 'Title Tag', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'div',
				'options'   => theplus_get_tags_options(),
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'full_infobox_switch',
			array(
				'label'       => wp_kses_post( "Full Infobox Link <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-link-to-the-info-box-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Enable', 'theplus' ),
				'label_off'   => esc_html__( 'Disable', 'theplus' ),
				'default'     => 'no',
				'separator'   => 'before',
				'description' => esc_html__( 'Note : If you enable this option, There will be only one link for whole infobox. Rest links will be removed.', 'theplus' ),
				'condition'   => array(
					'info_box_layout' => 'single_layout',
				),
			)
		);
		$this->add_control(
			'full_infobox_link',
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
					'info_box_layout'     => 'single_layout',
					'full_infobox_switch' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_styling',
			array(
				'label' => esc_html__( 'Title Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-title,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_4 .info-box-inner .service-media,{{WRAPPER}} .pt_plus_info_box.info-box-style_7 .info-box-inner .service-title' => 'margin-top : {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .service-title,{{WRAPPER}} .pt_plus_info_box.info-box-style_4 .info-box-inner .service-media,{{WRAPPER}} .pt_plus_info_box.info-box-style_7 .info-box-inner .service-title' => 'margin-bottom : {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_border_styling',
			array(
				'label' => esc_html__( 'Bottom Border Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'border_check',
			array(
				'label'       => esc_html__( 'Display Border', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Show', 'theplus' ),
				'label_off'   => esc_html__( 'Hide', 'theplus' ),
				'default'     => 'yes',
				'description' => esc_html__( 'By checking up this option you can turn on underline/border under the title.', 'theplus' ),
			)
		);
		$this->add_control(
			'border_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Width', 'theplus' ),
				'size_units'  => array( '%' ),
				'range'       => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => '%',
					'size' => 20,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'border_check' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'border_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Border Height', 'theplus' ),
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
					'size' => 1,
				),
				'render_type' => 'ui',
				'condition'   => array(
					'border_check' => 'yes',
				),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'title_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-border' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'border_check' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Description Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Desc Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-desc p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'desc_hover_color',
			array(
				'label'     => esc_html__( 'Desc Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-desc p,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-desc,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-desc p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'desc_padding',
			array(
				'label'      => esc_html__( 'Description Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .info-box-inner  .info-box-bg-box .service-desc ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

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
				'condition' => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
				),
			)
		);
		$this->add_control(
			'box_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'condition' => array(
					'box_border' => 'yes',
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-style: {{VALUE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
					'box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'boxborder_hover_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box:hover .info-box-inner .info-box-bg-box' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .infobox-overlay-color,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .infobox-overlay-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'main_style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_7', 'style_11' ),
					'box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'border_check_right',
			array(
				'label'     => esc_html__( 'Side image Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'main_style' => array( 'style_1', 'style_2' ),
				),
			)
		);
		$this->add_control(
			'border_right_color',
			array(
				'label'     => esc_html__( 'Border Right Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'condition' => array(
					'main_style'         => array( 'style_1', 'style_2' ),
					'border_check_right' => 'yes',
				),
			)
		);
		$this->add_control(
			'background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'bg_hover_animation',
			array(
				'label'   => esc_html__( 'Background Hover Animation', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover_normal',
				'options' => array(
					'hover_normal'       => esc_html__( 'Select Hover Bg Animation', 'theplus' ),
					'hover_fadein'       => esc_html__( 'FadeIn', 'theplus' ),
					'hover_slide_left'   => esc_html__( 'SlideInLeft', 'theplus' ),
					'hover_slide_right'  => esc_html__( 'SlideInRight', 'theplus' ),
					'hover_slide_top'    => esc_html__( 'SlideInTop', 'theplus' ),
					'hover_slide_bottom' => esc_html__( 'SlideInBotton', 'theplus' ),
				),
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
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',
			)
		);
		$this->add_control(
			'box_overlay_bg_color',
			array(
				'label'     => esc_html__( 'Overlay Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .infobox-overlay-color' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'bg_hover_animation' => 'hover_normal',
				),
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
				'selector' => '{{WRAPPER}} .pt_plus_info_box.hover_normal .info-box-inner:hover .info-box-bg-box, {{WRAPPER}} .pt_plus_info_box.hover_normal .info-box-inner.tp-info-active .info-box-bg-box, {{WRAPPER}} .pt_plus_info_box.hover_fadein .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_left .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_right .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_top .infobox-overlay-color, {{WRAPPER}} .pt_plus_info_box.hover_slide_bottom .infobox-overlay-color',
			)
		);
		$this->add_control(
			'box_hover_overlay_bg_color',
			array(
				'label'     => esc_html__( 'Overlay Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .infobox-overlay-color,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .infobox-overlay-color' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'bg_hover_animation' => 'hover_normal',
				),
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
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box',
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
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-box-bg-box,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-box-bg-box',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'box_bg_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'box_bg_bf_blur',
			array(
				'label'      => esc_html__( 'Blur', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'condition'  => array(
					'box_bg_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'box_bg_bf_grayscale',
			array(
				'label'      => esc_html__( 'Grayscale', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => '-webkit-backdrop-filter:grayscale({{box_bg_bf_grayscale.SIZE}})  blur({{box_bg_bf_blur.SIZE}}{{box_bg_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{box_bg_bf_grayscale.SIZE}})  blur({{box_bg_bf_blur.SIZE}}{{box_bg_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'box_bg_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_styling',
			array(
				'label'      => esc_html__( 'Button Style', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'display_button',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'loop_display_button',
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
			'button_top_space',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Button Above Space', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 2,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
				'conditions'  => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'display_button',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'loop_display_button',
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
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_responsive_control(
			'button_icon_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'button_background',
				'types'      => array( 'classic', 'gradient' ),
				'selector'   => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'separator'  => 'after',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'      => esc_html__( 'Border Style', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'solid',
				'options'    => array(
					'none'   => esc_html__( 'None', 'theplus' ),
					'solid'  => esc_html__( 'Solid', 'theplus' ),
					'dotted' => esc_html__( 'Dotted', 'theplus' ),
					'dashed' => esc_html__( 'Dashed', 'theplus' ),
					'groove' => esc_html__( 'Groove', 'theplus' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'      => esc_html__( 'Border Color', 'theplus' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#313131',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'button_shadow',
				'selector'   => '
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
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
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button,
					{{WRAPPER}} .info-box-inner.tp-info-active .pt_plus_button .button-link-wrap,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button svg,
					{{WRAPPER}} .info-box-inner.tp-info-active .pt_plus_button .button-link-wrap svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button svg,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'       => 'button_hover_background',
				'types'      => array( 'classic', 'gradient' ),
				'selector'   => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap',
				'separator'  => 'after',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'      => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#313131',
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'       => 'button_hover_shadow',
				'selector'   => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_button .hover_box_button,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_button .hover_box_button,{{WRAPPER}} .info-box-inner:hover .pt_plus_button .button-link-wrap',
				'conditions' => array(
					'terms' => array(
						array(
							'relation' => 'or',
							'terms'    => array(
								array(
									'name'     => 'button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
								array(
									'name'     => 'loop_button_style',
									'operator' => '==',
									'value'    => 'style-8',
								),
							),
						),
					),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_svg_styling',
			array(
				'label'      => esc_html__( 'Svg Style', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
				),
			)
		);
		$this->add_control(
			'svg_icon_style',
			array(
				'label'      => esc_html__( 'SVG Icon Styles', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => array(
					''              => esc_html__( 'None', 'theplus' ),
					'square'        => esc_html__( 'Square', 'theplus' ),
					'rounded'       => esc_html__( 'Rounded', 'theplus' ),
					'hexagon'       => esc_html__( 'Hexagon', 'theplus' ),
					'pentagon'      => esc_html__( 'Pentagon', 'theplus' ),
					'square-rotate' => esc_html__( 'Square Rotate', 'theplus' ),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'svg_icon_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Background Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg .svg_inner_block' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
				),
			)
		);
		$this->add_control(
			'svg_stroke_none',
			array(
				'label'     => esc_html__( 'SVG Stroke None', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info_box_svg svg' => 'stroke: none;',
				),
			)
		);
		$this->add_control(
			'svg_fill_color',
			array(
				'label'     => esc_html__( 'SVG Fill Color', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
				'separator' => 'after',
			)
		);
		$this->start_controls_tabs( 'svg_icon_n_h' );
		$this->start_controls_tab(
			'svg_icn_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'border_stroke_color',
			array(
				'label'     => esc_html__( 'Border/Stoke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff0000',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info_box_svg svg' => 'stroke: {{VALUE}}',
				),
				'condition' => array(
					'svg_stroke_none!' => 'yes',
				),
			)
		);
		$this->add_control(
			'svg_fill_color_f',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info_box_svg svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner .info_box_svg svg *:not(g)' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'svg_fill_color' => 'yes',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'svg_icon_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg .svg_inner_block',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'svg_icon_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg .svg_inner_block',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'svg_icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg .svg_inner_block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'svg_icon_n_shadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg .svg_inner_block',
				'condition' => array(
					'svg_icon_style' => array( '', 'square', 'rounded' ),
				),
			)
		);
		$this->add_control(
			'svg_icon_rn_shadow',
			array(
				'label'       => esc_html__( 'Box Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .pt_plus_animated_svg' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'condition'   => array(
					'svg_icon_style!' => array( '', 'square', 'rounded' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'svg_icn_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'border_stroke_color_hover',
			array(
				'label'     => esc_html__( 'Border/Stoke Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info_box_svg svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info_box_svg svg' => 'stroke: {{VALUE}}',
				),
				'condition' => array(
					'svg_stroke_none!' => 'yes',
				),
			)
		);
		$this->add_control(
			'svg_fill_color_hover',
			array(
				'label'     => esc_html__( 'Fill Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info_box_svg svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info_box_svg svg *:not(g),{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info_box_svg svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info_box_svg svg *:not(g)' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'svg_fill_color' => 'yes',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'svg_icon_background_h',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_animated_svg .svg_inner_block,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_animated_svg .svg_inner_block',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'svg_icon_border_h',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_animated_svg .svg_inner_block,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_animated_svg .svg_inner_block',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'svg_icon_border_radius_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_animated_svg .svg_inner_block,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_animated_svg .svg_inner_block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'svg_icon_h_shadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_animated_svg .svg_inner_block,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_animated_svg .svg_inner_block',
				'condition' => array(
					'svg_icon_style' => array( '', 'square', 'rounded' ),
				),
			)
		);
		$this->add_control(
			'svg_icon_rh_shadow',
			array(
				'label'       => esc_html__( 'Box Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .pt_plus_animated_svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .pt_plus_animated_svg' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'condition'   => array(
					'svg_icon_style!' => array( '', 'square', 'rounded' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'svg_type',
			array(
				'label'      => esc_html__( 'Select Style Image', 'theplus' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'delayed',
				'options'    => theplus_svg_type(),
				'separator'  => 'before',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
				),
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
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'max_width',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Max Width Svg', 'theplus' ),
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
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info_box_svg svg' => 'max-width: {{SIZE}}{{UNIT}};max-height: {{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'image_icon' => 'svg',
					'svg_icon'   => array( 'svg', 'img' ),
				),
			)
		);
		$this->add_control(
			'draw_animated_svg',
			array(
				'label'      => esc_html__( 'Disable Draw SVG', 'theplus' ),
				'type'       => Controls_Manager::SWITCHER,
				'label_on'   => esc_html__( 'Yes', 'theplus' ),
				'label_off'  => esc_html__( 'No', 'theplus' ),
				'default'    => 'no',
				'separator'  => 'before',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'svg',
						),
					),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_lottie_styling',
			array(
				'label'      => esc_html__( 'Lottie Style', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'lottie',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'lottie',
						),
					),
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

		$this->start_controls_section(
			'section_icon_styling',
			array(
				'label'      => esc_html__( 'Icon Style', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'icon',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'icon',
						),
					),
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
		$this->add_responsive_control(
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner i.service-icon,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'width:{{SIZE}}{{UNIT}} !important;height:{{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon .icon-image-set' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon, {{WRAPPER}} .post-inner-loop .info-box-inner .info-box-bg-box .info-icon-content .service-icon i' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon svg' => 'fill: {{VALUE}};stroke: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon:before,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}});-webkit-transition: all 0.3s linear;-moz-transition: all 0.3s linear;-o-transition: all 0.3s linear;-ms-transition: all 0.3s linear;transition: all 0.3s linear;',
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
				{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_style_n',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_get_border_style_with_none(),
				'condition' => array(
					'icon_style' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'border-style: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_border_width_n',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_style' => '',
				),
			)
		);
		$this->add_control(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
					{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon,
				{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon i',
			)
		);
		$this->add_control(
			'icon_rn_shadow',
			array(
				'label'       => esc_html__( 'Box Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-icon-wrap' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'condition'   => array(
					'icon_style!' => array( '', 'square', 'rounded' ),
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'color: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon svg,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon svg' => 'fill: {{VALUE}};background: transparent;-webkit-background-clip: unset;-webkit-text-fill-color: initial;',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon:before,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i:before' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
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
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'icon_border_style_h',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => theplus_get_border_style_with_none(),
				'condition' => array(
					'icon_style' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon' => 'border-style: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'icon_border_width_h',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_style' => '',
				),
			)
		);
		$this->add_control(
			'icon_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon i,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon i',
			)
		);
		$this->add_control(
			'icon_rh_shadow',
			array(
				'label'       => esc_html__( 'Box Shadow', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => esc_html__( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-icon-wrap,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-icon-wrap' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				),
				'condition'   => array(
					'icon_style!' => array( '', 'square', 'rounded' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'icon_overlay',
			array(
				'label'     => esc_html__( 'Icon Overlay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_2', 'style_3' ),
				),
			)
		);
		$this->add_control(
			'icon_overlay_adjust',
			array(
				'label'      => esc_html__( 'Icon Adjust', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -400,
						'max'  => 400,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .icon-overlay .m-r-16,{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .icon-overlay .m-l-16' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'info_box_layout' => 'single_layout',
					'main_style'      => array( 'style_1', 'style_2' ),
					'icon_overlay'    => 'yes',
				),
			)
		);
		$this->add_control(
			'icon_shine_effect',
			array(
				'label'     => esc_html__( 'Icon Shine Effect', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_styling',
			array(
				'label'      => esc_html__( 'Image Style', 'theplus' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'loop_select_icon',
							'operator' => '==',
							'value'    => 'image',
						),
						array(
							'name'     => 'image_icon',
							'operator' => '==',
							'value'    => 'image',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'img_max_width',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Max Width', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .service-img,{{WRAPPER}} .pt_plus_info_box.list-carousel-slick .ts-icon-img.icon-img-b img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_image_style' );
		$this->start_controls_tab(
			'tab_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .service-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner  .service-img',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'image_hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .service-img,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .service-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover  .service-img,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active  .service-img',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_pin_text_styling',
			array(
				'label'     => esc_html__( 'Pin Text Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'info_box_layout'  => 'single_layout',
					'main_style'       => 'style_3',
					'display_pin_text' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pin_text_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text',
			)
		);
		$this->add_responsive_control(
			'pin_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pin_text_border',
			array(
				'label'     => esc_html__( 'Pin Text Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'pin_text_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'condition' => array(
					'pin_text_border' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'border-style: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_pin_text_style' );
		$this->start_controls_tab(
			'tab_pin_text_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_text_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'pin_text_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pin_text_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'pin_text_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'pin_text_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'pin_text_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'pin_text_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pin_text_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_pin_text_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_text_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'pin_text_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pin_text_hover_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'pin_text_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'pin_text_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text' => 'border-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'pin_text_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'pin_text_hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'pin_text_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_info_box .info-box-inner:hover .info-pin-text,{{WRAPPER}} .pt_plus_info_box .info-box-inner.tp-info-active .info-pin-text',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'square_pin',
			array(
				'label'     => esc_html__( 'Square Pin', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'pin_width',
			array(
				'label'      => esc_html__( 'Pin Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 42,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text.square-pin' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'square_pin' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'pin_height',
			array(
				'label'      => esc_html__( 'Pin Height', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 42,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text.square-pin' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'square_pin' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'pin_horiz_adjust',
			array(
				'label'      => esc_html__( 'Pin Horizontal Adjust', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -150,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 45,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text.square-pin' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'square_pin' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'pin_vertical_adjust',
			array(
				'label'      => esc_html__( 'Pin Vertical Adjust', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => -150,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-pin-text.square-pin' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'square_pin' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_options_styling',
			array(
				'label'     => esc_html__( 'Carousel Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'carousel_unique_id',
			array(
				'label'       => wp_kses_post( "Unique Carousel ID <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "connect-elementor-infobox-with-carousel-remote/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'separator'   => 'after',
				'description' => esc_html__( 'Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_direction',
			array(
				'label'   => esc_html__( 'Slider Mode', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'theplus' ),
					'vertical'   => esc_html__( 'Vertical', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'carousel_direction',
			array(
				'label'   => esc_html__( 'Slide Direction', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => array(
					'rtl' => esc_html__( 'Right to Left', 'theplus' ),
					'ltr' => esc_html__( 'Left to Right', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slide_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Slide Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
			)
		);
		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_desktop_column',
			array(
				'label'   => esc_html__( 'Desktop Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_carousel_desktop_columns(),
			)
		);
		$this->add_control(
			'steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'slider_padding',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Slide Padding', 'theplus' ),
				'size_units'  => array( 'px' ),

				'range'       => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .list-carousel-slick:not(.multi-row) .slick-initialized .slick-slide' => 'margin: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .list-carousel-slick.multi-row .slick-initialized .slick-slide' => 'margin: 0 {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .list-carousel-slick.multi-row .slick-initialized .slick-slide > div' => 'margin: {{SIZE}}{{UNIT}} 0',
				),
			)
		);
		$this->add_control(
			'slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'multi_drag',
			array(
				'label'     => esc_html__( 'Multi Drag', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_draggable' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'slider_pause_hover',
			array(
				'label'     => esc_html__( 'Pause On Hover', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slider_adaptive_height',
			array(
				'label'     => esc_html__( 'Adaptive Height', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'slide_fade_inout',
			array(
				'label'     => esc_html__( 'Slide Animation', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => array(
					'none'      => esc_html__( 'Default', 'theplus' ),
					'fadeinout' => esc_html__( 'Fade in/Fade out', 'theplus' ),
				),
				'condition' => array(
					'slider_direction' => 'horizontal',
				),
			)
		);
		$this->add_control(
			'slide_fade_inout_notice',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => 'Note : Just for single column layout.',
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'slider_direction' => 'horizontal',
					'slide_fade_inout' => 'fadeinout',
				),
			)
		);
		$this->add_control(
			'slider_animation',
			array(
				'label'   => esc_html__( 'Animation Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => array(
					'ease'   => esc_html__( 'With Hold', 'theplus' ),
					'linear' => esc_html__( 'Continuous', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
			)
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 3000,
				),
				'condition'  => array(
					'slider_autoplay' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_dots_style',
			array(
				'label'     => esc_html__( 'Dots Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
					'style-7' => esc_html__( 'Style 7', 'theplus' ),
				),
				'condition' => array(
					'slider_dots' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'dots_size_123',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Size', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-dots.style-1 li,{{WRAPPER}}  .slick-dots.style-2 li,{{WRAPPER}}  .slick-dots.style-3 li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots'       => 'yes',
					'slider_dots_style' => array( 'style-1', 'style-2', 'style-3' ),
				),
			)
		);
		$this->add_control(
			'dots_size_57',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Width', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-dots.style-5 button,{{WRAPPER}} .slick-dots.style-7 button' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots'       => 'yes',
					'slider_dots_style' => array( 'style-5', 'style-7' ),
				),
			)
		);
		$this->add_control(
			'dots_size_57_height',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Height', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-dots.style-5 button,{{WRAPPER}} .slick-dots.style-7 button' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots'       => 'yes',
					'slider_dots_style' => array( 'style-5', 'style-7' ),
				),
			)
		);
		$this->add_control(
			'dots_size_57_active',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Active Width', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .slick-dots.style-5 .slick-active button,{{WRAPPER}} .slick-dots.style-5 li:hover button' => 'width: {{SIZE}}{{UNIT}} !important;',
				),
				'condition'  => array(
					'slider_dots'       => 'yes',
					'slider_dots_style' => array( 'style-5' ),
				),
			)
		);
		$this->add_control(
			'dots_border_color',
			array(
				'label'     => esc_html__( 'Dots Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-1', 'style-2', 'style-3', 'style-5' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_bg_color',
			array(
				'label'     => esc_html__( 'Dots Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button,{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-3', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_border_color',
			array(
				'label'     => esc_html__( 'Dots Active Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-6' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_active_bg_color',
			array(
				'label'     => esc_html__( 'Dots Active Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 .slick-active button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_dots_style' => array( 'style-2', 'style-4', 'style-5', 'style-7' ),
					'slider_dots'       => 'yes',
				),
			)
		);
		$this->add_control(
			'dots_top_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Dots Top Padding', 'theplus' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'hover_show_dots',
			array(
				'label'     => esc_html__( 'On Hover Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_dots' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slider_arrows_style',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'style-1',
				'options'   => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
					'style-3' => esc_html__( 'Style 3', 'theplus' ),
					'style-4' => esc_html__( 'Style 4', 'theplus' ),
					'style-5' => esc_html__( 'Style 5', 'theplus' ),
					'style-6' => esc_html__( 'Style 6', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'arrows_position',
			array(
				'label'     => esc_html__( 'Arrows Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top-right',
				'options'   => array(
					'top-right'     => esc_html__( 'Top-Right', 'theplus' ),
					'bottm-left'    => esc_html__( 'Bottom-Left', 'theplus' ),
					'bottom-center' => esc_html__( 'Bottom-Center', 'theplus' ),
					'bottom-right'  => esc_html__( 'Bottom-Right', 'theplus' ),
				),
				'condition' => array(
					'slider_arrows'       => array( 'yes' ),
					'slider_arrows_style' => array( 'style-3', 'style-4' ),
				),
			)
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-6:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-6:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-3', 'style-4', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_bg_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'arrow_hover_icon_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#c44d48',
				'selectors' => array(
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6' ),
					'slider_arrows'       => 'yes',
				),
			)
		);
		$this->add_control(
			'outer_section_arrow',
			array(
				'label'     => esc_html__( 'Outer Content Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows'       => 'yes',
					'slider_arrows_style' => array( 'style-1', 'style-2', 'style-5', 'style-6' ),
				),
			)
		);
		$this->add_control(
			'hover_show_arrow',
			array(
				'label'     => esc_html__( 'On Hover Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_arrows' => 'yes',
				),
			)
		);
		$this->add_control(
			'slider_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'slider_center_effects',
			array(
				'label'     => esc_html__( 'Center Slide Effects', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => theplus_carousel_center_effects(),
				'condition' => array(
					'slider_center_mode' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'scale_center_slide',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Slide Scale', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center,
					{{WRAPPER}} .list-carousel-slick .slick-slide.scc-animate' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});opacity:1;',
				),
				'condition'  => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_control(
			'scale_normal_slide',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Normal Slide Scale', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.3,
						'max'  => 2,
						'step' => 0.02,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0.8,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});',
				),
				'condition'  => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'scale',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'shadow_active_slide',
				'selector'  => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .info-box-bg-box',
				'condition' => array(
					'slider_center_mode'    => 'yes',
					'slider_center_effects' => 'shadow',
				),
			)
		);
		$this->add_control(
			'opacity_normal_slide',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Normal Slide Opacity', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0.7,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => 'opacity:{{SIZE}}',
				),
				'condition'  => array(
					'slider_center_mode'     => 'yes',
					'slider_center_effects!' => 'none',
				),
			)
		);
		$this->add_control(
			'slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'slide_row_top_space',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Row Top Space', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .list-carousel-slick[data-slider_rows="2"] .slick-slide > div:last-child,{{WRAPPER}} .list-carousel-slick[data-slider_rows="3"] .slick-slide > div:nth-last-child(-n+2)' => 'padding-top:{{SIZE}}px',
				),
				'condition'  => array(
					'slider_rows' => array( '2', '3' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			array(
				'label' => esc_html__( 'Tablet', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_tablet_column',
			array(
				'label'   => esc_html__( 'Tablet Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_carousel_tablet_columns(),
			)
		);
		$this->add_control(
			'tablet_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_responsive_tablet',
			array(
				'label'     => esc_html__( 'Responsive Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'tablet_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_tablet' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_tablet' => 'yes',
					'tablet_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			array(
				'label' => esc_html__( 'Mobile', 'theplus' ),
			)
		);
		$this->add_control(
			'slider_mobile_column',
			array(
				'label'   => esc_html__( 'Mobile Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => theplus_carousel_mobile_columns(),
			)
		);
		$this->add_control(
			'mobile_steps_slide',
			array(
				'label'       => esc_html__( 'Next Previous', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '1',
				'description' => esc_html__( 'Select option of column scroll on previous or next in carousel.', 'theplus' ),
				'options'     => array(
					'1' => esc_html__( 'One Column', 'theplus' ),
					'2' => esc_html__( 'All Visible Columns', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'slider_responsive_mobile',
			array(
				'label'     => esc_html__( 'Responsive Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'mobile_slider_draggable',
			array(
				'label'     => esc_html__( 'Draggable', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_infinite',
			array(
				'label'     => esc_html__( 'Infinite Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_autoplay',
			array(
				'label'     => esc_html__( 'Autoplay', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_autoplay_speed',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Autoplay Speed', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 500,
						'max'  => 10000,
						'step' => 200,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 1500,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_slider_autoplay'   => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_dots',
			array(
				'label'     => esc_html__( 'Show Dots', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_arrows',
			array(
				'label'     => esc_html__( 'Show Arrows', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_slider_rows',
			array(
				'label'     => esc_html__( 'Number Of Rows', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => esc_html__( '1 Row', 'theplus' ),
					'2' => esc_html__( '2 Rows', 'theplus' ),
					'3' => esc_html__( '3 Rows', 'theplus' ),
				),
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_mode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
				'condition' => array(
					'slider_responsive_mobile' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_center_padding',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Center Padding', 'theplus' ),
				'size_units' => '',
				'range'      => array(
					'' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => '',
					'size' => 0,
				),
				'condition'  => array(
					'slider_responsive_mobile' => 'yes',
					'mobile_center_mode'       => array( 'yes' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/** Extra Option*/
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
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .icon-overlay ' => 'top: calc(0% - {{TOP}}{{UNIT}});',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_1 .icon-overlay .m-r-16' => 'left: calc(0% - {{LEFT}}{{UNIT}});',
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .icon-overlay .m-l-16' => 'right: calc(0% - {{RIGHT}}{{UNIT}});',
				),
			)
		);
		$this->add_control(
			'vertical_center',
			array(
				'label'     => esc_html__( 'Vertical Center', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'main_style' => array( 'style_1', 'style_2', 'style_4' ),
				),
			)
		);
		$this->add_control(
			'tilt_parallax',
			array(
				'label'       => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Yes', 'theplus' ),
				'label_off'   => esc_html__( 'No', 'theplus' ),
				'render_type' => 'template',
				'separator'   => 'before',
				'condition'   => array(
					'main_style' => array( 'style_3' ),
				),
			)
		);
		$this->add_group_control(
			\Theplus_Tilt_Parallax_Group::get_type(),
			array(
				'label'       => esc_html__( 'Tilt Options', 'theplus' ),
				'name'        => 'tilt_opt',
				'render_type' => 'template',
				'condition'   => array(
					'main_style'    => array( 'style_3' ),
					'tilt_parallax' => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'messy_column',
			array(
				'label'     => esc_html__( 'Messy Columns', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'info_box_layout' => 'carousel_layout',
				),
			)
		);
		$this->add_control(
			'messy_column_even',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Even Columns', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 0,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .slick-initialized .slick-slide.info-box-inner:nth-child(2n+1)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
					'messy_column'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'messy_column_odd',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Odd Columns', 'theplus' ),
				'size_units'  => array( 'px', '%' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 70,
						'max'  => 70,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 70,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .slick-initialized .slick-slide.info-box-inner:nth-child(2n+2)' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'info_box_layout' => 'carousel_layout',
					'messy_column'    => array( 'yes' ),
				),
			)
		);
		$this->add_control(
			'min_height_section',
			array(
				'label'     => esc_html__( 'Minimum Height Section', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'minimum_height',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Minimum Height', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 40,
						'max'  => 700,
						'step' => 5,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 350,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .pt_plus_info_box .info-box-inner .info-box-bg-box' => 'min-height: {{SIZE}}{{UNIT}};display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-align-items: center;-ms-align-items: center;align-items: center;',
				),
				'condition'   => array(
					'min_height_section' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'minimum_height_align_st3',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'condition' => array(
					'main_style'         => 'style_3',
					'min_height_section' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_3 .info-box-inner .info-box-bg-box' => '-webkit-justify-content: {{VALUE}};-moz-justify-content: {{VALUE}};-ms-justify-content: {{VALUE}};justify-content: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'minimum_height_align_st2',
			array(
				'label'     => esc_html__( 'Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'flex-end',
				'condition' => array(
					'main_style'         => 'style_2',
					'min_height_section' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_info_box.info-box-style_2 .info-box-inner .info-box-bg-box' => '-webkit-justify-content: {{VALUE}};-moz-justify-content: {{VALUE}};-ms-justify-content: {{VALUE}};justify-content: {{VALUE}};',
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
		$this->add_control(
			'responsive_visible_opt',
			array(
				'label'     => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'desktop_opt',
			array(
				'label'     => esc_html__( 'Desktop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'tablet_opt',
			array(
				'label'     => esc_html__( 'Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->add_control(
			'mobile_opt',
			array(
				'label'     => esc_html__( 'Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'condition' => array(
					'responsive_visible_opt' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		/** Plus Extra*/
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
	 * Render Info Box
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$main_style   = ! empty( $settings['main_style'] ) ? $settings['main_style'] : 'style_1';
		$text_align   = ! empty( $settings['text_align'] ) ? $settings['text_align'] : 'center';
		$icon_overlay = ! empty( $settings['icon_overlay'] ) ? $settings['icon_overlay'] : 'no';

		$info_box_layout   = ! empty( $settings['info_box_layout'] ) ? $settings['info_box_layout'] : 'single_layout';
		$full_infobox_link = ! empty( $settings['full_infobox_link']['url'] ) ? $settings['full_infobox_link']['url'] : '#';
		$icon_shine_effect = ! empty( $settings['icon_shine_effect'] ) ? $settings['icon_shine_effect'] : 'no';
		$box_hover_effects = ! empty( $settings['box_hover_effects'] ) ? $settings['box_hover_effects'] : '';

		$full_infobox_blank  = ! empty( $settings['full_infobox_link']['is_external'] ) ? '_blank' : '';
		$full_infobox_switch = ! empty( $settings['full_infobox_switch'] ) ? $settings['full_infobox_switch'] : 'no';

		$fc_load_class = '';
		// r_full_infobox_switch.
		if ( 'yes' === $full_infobox_switch ) {
			$fc_load_class = 'tp-info-fbc';
		} else {
			$fc_load_class = 'tp-info-nc';
		}

		$icon_shine = '';
		if ( 'yes' === $icon_shine_effect ) {
			$icon_shine = 'icon_shine_show';
		}

		$hover_attr   = '';
		$hover_class  = '';
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

		/**--OnScroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/**--Plus Extra ---*/
		$PlusExtra_Class = '';

		$wname = 'tpinfobox';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';

		$output    = '';
		$title_css = '';

		$description  = '';
		$service_img  = '';
		$subtitle_css = '';
		$imge_content = '';

		$service_title  = '';
		$service_align  = '';
		$service_space  = '';
		$service_center = '';
		$service_border = '';

		$border_right_css   = '';
		$serice_box_border  = '';
		$serice_img_border  = '';
		$service_icon_style = '';

		if ( 'left' === $text_align ) {
			$service_align = 'text-left';
		}
		if ( 'center' === $text_align ) {
			$service_align = 'text-center';
		}
		if ( 'right' === $text_align ) {
			$service_align = 'text-right';
		}
		if ( 'yes' === $settings['box_border'] ) {
			$serice_box_border = 'service-border-box';
		}
		if ( 'yes' === $settings['vertical_center'] ) {
			$service_center = 'vertical-center';
		}

		if ( ! empty( $settings['url_link']['url'] ) ) {
			$this->add_link_attributes( 'box_link', $settings['url_link'] );
		}

		/** Image*/
		$image_icon = ! empty( $settings['image_icon'] ) ? $settings['image_icon'] : 'icon';
		if ( 'lottie' === $image_icon ) {
			$ext = pathinfo( $settings['lottieUrl']['url'], PATHINFO_EXTENSION );
			if ( 'json' !== $ext ) {
				$service_img = '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
			} else {
				$lottie_width  = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 50;
				$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 50;
				$lottie_speed  = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;
				$lottie_loop   = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
				$lottiehover   = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';

				$lottie_loop_value = '';

				if ( 'yes' === $lottie_loop ) {
					$lottie_loop_value = 'loop';
				}

				$lottie_anim = 'autoplay';
				if ( 'yes' === $lottiehover ) {
					$lottie_anim = 'hover';
				}

				$service_img = '<lottie-player src="' . esc_url( $settings['lottieUrl']['url'] ) . '" style="width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
			}
		}
		if ( 'image' === $image_icon ) {
			$image_alt = '';
			$img_src   = '';
			if ( ! empty( $settings['select_image']['url'] ) ) {
				$image_id = $settings['select_image']['id'];
				$img_src  = tp_get_image_rander( $image_id, $settings['select_image_thumbnail_size'], array( 'class' => 'service-img' ) );
			}
			$service_a_start = '';
			$service_a_end   = '';
			if ( ! empty( $settings['url_link']['url'] ) ) {
				$service_a_start = '<a ' . $this->get_render_attribute_string( 'box_link' ) . ' >';
				$service_a_end   = '</a>';
			}
			$service_img = wp_kses_post( $service_a_start ) . $img_src . wp_kses_post( $service_a_end );
		}

		/** Font Icon*/
		$icon_style       = ! empty( $settings['icon_style'] ) ? $settings['icon_style'] : '';
		$svg_icon_style   = ! empty( $settings['svg_icon_style'] ) ? $settings['svg_icon_style'] : '';
		$icon_font_style  = ! empty( $settings['icon_font_style'] ) ? $settings['icon_font_style'] : 'font_awesome';
		$loop_select_icon = ! empty( $settings['loop_select_icon'] ) ? $settings['loop_select_icon'] : '';

		if ( ( 'square' === $icon_style && ( 'icon' === $image_icon || 'icon' === $loop_select_icon ) ) || ( 'square' === $svg_icon_style && ( 'svg' === $image_icon || 'svg' === $loop_select_icon ) ) ) {
			$service_icon_style = 'icon-squre';
		}
		if ( ( 'rounded' === $icon_style && ( 'icon' === $image_icon || 'icon' === $loop_select_icon ) ) || ( 'rounded' === $svg_icon_style && ( 'svg' === $image_icon || 'svg' === $loop_select_icon ) ) ) {
			$service_icon_style = 'icon-rounded';
		}
		if ( ( 'hexagon' === $icon_style && ( 'icon' === $image_icon || 'icon' === $loop_select_icon ) ) || ( 'hexagon' === $svg_icon_style && ( 'svg' === $image_icon || 'svg' === $loop_select_icon ) ) ) {
			$service_icon_style = 'icon-hexagon';
		}
		if ( ( 'pentagon' === $icon_style && ( 'icon' === $image_icon || 'icon' === $loop_select_icon ) ) || ( 'pentagon' === $svg_icon_style && ( 'svg' === $image_icon || 'svg' === $loop_select_icon ) ) ) {
			$service_icon_style = 'icon-pentagon';
		}
		if ( ( 'square-rotate' === $icon_style && ( 'icon' === $image_icon || 'icon' === $loop_select_icon ) ) || ( 'square-rotate' === $svg_icon_style && ( 'svg' === $image_icon || 'svg' === $loop_select_icon ) ) ) {
			$service_icon_style = 'icon-square-rotate';
		}

		if ( 'icon' === $image_icon ) {
			if ( 'font_awesome' === $icon_font_style ) {
				$icons = $settings['icon_fontawesome'];
			} elseif ( 'icon_mind' === $icon_font_style ) {
				$icons = $settings['icons_mind'];
			} elseif ( 'font_awesome_5' === $icon_font_style ) {
				ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
				ob_end_clean();
			} elseif ( 'icon_image' === $icon_font_style && ! empty( $settings['icons_image']['url'] ) ) {
				$image_id        = $settings['icons_image']['id'];
				$icons_image_src = tp_get_image_rander( $image_id, $settings['icons_image_thumbnail_size'], array( 'class' => 'icon-image-set' ) );

				$icons_image = '<div class="service-icon-image ' . esc_attr( $icon_shine ) . ' service-icon ' . esc_attr( $service_icon_style ) . '">' . $icons_image_src . '</div>';
			} else {
				$icons       = '';
				$icons_image = '';
			}
			if ( ! empty( $icons ) ) {
				if ( 'font_awesome_5' === $icon_font_style ) {
					$service_img = '<div class="service-icon-wrap"><span class=" service-icon ' . esc_attr( $icon_shine ) . ' ' . esc_attr( $service_icon_style ) . '">' . $icons . '</span></div>';
				} else {
					$service_img = '<div class="service-icon-wrap"><i class=" ' . esc_attr( $icons ) . ' service-icon ' . esc_attr( $icon_shine ) . ' ' . esc_attr( $service_icon_style ) . '"></i></div>';
				}
			}
			if ( ! empty( $icons_image ) ) {
				$service_img = $icons_image;
			}
		}

		/** Svg Icon*/
		if ( ! empty( $settings['border_stroke_color'] ) ) {
			$border_stroke_color = $settings['border_stroke_color'];
		} else {
			$border_stroke_color = 'none';
		}

		if ( ! empty( $settings['border_stroke_color_hover'] ) ) {
			$border_stroke_color_hover = $settings['border_stroke_color_hover'];
		} else {
			$border_stroke_color_hover = '';
		}

		if ( ! empty( $settings['svg_stroke_none'] ) && 'yes' === $settings['svg_stroke_none'] ) {
			$border_stroke_color       = 'none';
			$border_stroke_color_hover = 'none';
		}

		if ( ! empty( $settings['draw_animated_svg'] ) && 'yes' === $settings['draw_animated_svg'] ) {
			$duration = 1;
		} else {
			$duration = ( ! empty( $settings['duration']['size'] ) ) ? $settings['duration']['size'] : 30;
		}
		if ( 'yes' === $settings['svg_fill_color'] ) {
			$svg_fill_color       = $settings['svg_fill_color_f'];
			$svg_fill_color_hover = $settings['svg_fill_color_hover'];
		} else {
			$svg_fill_color       = 'none';
			$svg_fill_color_hover = '';
		}
		if ( 'svg' === $image_icon ) {
			$svg_type = ! empty( $settings['svg_type'] ) ? $settings['svg_type'] : 'delayed';
			if ( 'img' === $settings['svg_icon'] ) {
				$svg_url = $settings['svg_image']['url'];
			} else {
				$svg_url = THEPLUS_URL . 'assets/images/svg/' . esc_attr( $settings['svg_d_icon'] );
			}
			$rand_no = wp_rand( 1000000, 1500000 );

			$service_img      = '<div class="pt_plus_animated_svg  svg-' . esc_attr( $rand_no ) . '" data-id="svg-' . esc_attr( $rand_no ) . '" data-type="' . esc_attr( $svg_type ) . '" data-duration="' . esc_attr( $duration ) . '" data-stroke="' . esc_attr( $border_stroke_color ) . '" data-fill_color="' . esc_attr( $svg_fill_color ) . '" data-fillhover="' . esc_attr( $svg_fill_color_hover ) . '" data-strokehover="' . esc_attr( $border_stroke_color_hover ) . '">';
				$service_img .= '<div class="info_box_svg svg_inner_block ' . esc_attr( $service_icon_style ) . '">';
					// @since 4.1.9
					$svg_url_pass = '';
					$ext          = pathinfo( $svg_url, PATHINFO_EXTENSION );
			if ( ! empty( $svg_url ) && 'svg' === $ext ) {
				$svg_url_pass = $svg_url;
			}
					$service_img .= '<object aria-label="' . wp_kses_post( $settings['title'] ) . '" id="svg-' . esc_attr( $rand_no ) . '" type="image/svg+xml" data="' . esc_url( $svg_url_pass ) . '" style="max-width:' . $settings['max_width']['size'] . $settings['max_width']['unit'] . ';max-height:' . $settings['max_width']['size'] . $settings['max_width']['unit'] . ';margin: 0 auto;" ></object>';
				$service_img     .= '</div>';
			$service_img         .= '</div>';
		}
		if ( 'yes' === $settings['border_check_right'] ) {
			$serice_img_border = 'service-img-border';
			$border_right_css  = ' style="';
			if ( ! empty( $settings['border_right_color'] ) ) {
				$border_right_css .= 'border-color: ' . esc_attr( $settings['border_right_color'] ) . ';';
			}
			$border_right_css .= '"';
		}

		$title_tag = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'div';
		if ( ! empty( $settings['title'] ) ) {
			if ( ( ! empty( $settings['url_link']['url'] ) ) && ( 'yes' !== $full_infobox_switch ) ) {
				$service_title = '<a ' . $this->get_render_attribute_string( 'box_link' ) . ' ><' . theplus_validate_html_tag( $title_tag ) . ' class="service-title "> ' . wp_kses_post( $settings['title'] ) . ' </' . theplus_validate_html_tag( $title_tag ) . '></a>';
			} else {
				$service_title = '<' . theplus_validate_html_tag( $title_tag ) . ' class="service-title "> ' . wp_kses_post( $settings['title'] ) . ' </' . theplus_validate_html_tag( $title_tag ) . '>';
			}
		}

		$border_check = $settings['border_check'];
		if ( 'yes' === $border_check ) {
			$service_border = '<div class="service-border"> </div>';
		}

		$content_desc = $settings['content_desc'];
		if ( ! empty( $content_desc ) ) {
			$description = '<div class="service-desc"> ' . wp_kses_post( $content_desc ) . ' </div>';
		}

		/** Carousel Option*/
		$isotope = '';

		$data_slider   = '';
		$arrow_class   = '';
		$data_carousel = '';

		$carousel_slider    = '';
		$carousel_direction = '';

		if ( 'carousel_layout' === $info_box_layout ) {

			$slider_direction = 'vertical' === $settings['slider_direction'] ? 'true' : 'false';
			$data_slider     .= ' data-slider_direction="' . esc_attr( $slider_direction ) . '"';
			$data_slider     .= ' data-slide_speed="' . ( isset( $settings['slide_speed']['size'] ) ? esc_attr( $settings['slide_speed']['size'] ) : 1500 ) . '"';

			$data_slider .= ' data-slider_desktop_column="' . ( isset( $settings['slider_desktop_column'] ) ? esc_attr( $settings['slider_desktop_column'] ) : 4 ) . '"';
			$data_slider .= ' data-steps_slide="' . ( isset( $settings['steps_slide'] ) ? esc_attr( $settings['steps_slide'] ) : 1 ) . '"';

			$slider_draggable = 'yes' === $settings['slider_draggable'] ? 'true' : 'false';

			$multi_drag = 'yes' === $settings['multi_drag'] ? 'true' : 'false';

			$data_slider .= ' data-slider_draggable="' . esc_attr( $slider_draggable ) . '"';
			$data_slider .= ' data-multi_drag="' . esc_attr( $multi_drag ) . '"';

			$slider_infinite = 'yes' === $settings['slider_infinite'] ? 'true' : 'false';
			$data_slider    .= ' data-slider_infinite="' . esc_attr( $slider_infinite ) . '"';

			$slider_pause_hover = 'yes' === $settings['slider_pause_hover'] ? 'true' : 'false';
			$data_slider       .= ' data-slider_pause_hover="' . esc_attr( $slider_pause_hover ) . '"';

			$slider_adaptive_height = $settings['slider_adaptive_height'] ? 'true' : 'false';

			$data_slider .= ' data-slider_adaptive_height="' . esc_attr( $slider_adaptive_height ) . '"';

			$slide_fade_inout = ( 'horizontal' === $settings['slider_direction'] && 'fadeinout' === $settings['slide_fade_inout'] ) ? 'true' : 'false';
			$data_slider     .= ' data-slide_fade_inout="' . esc_attr( $slide_fade_inout ) . '"';
			$slider_animation = ( isset( $settings['slider_animation'] ) ? $settings['slider_animation'] : 'ease' );

			$data_slider    .= ' data-slider_animation="' . esc_attr( $slider_animation ) . '"';
			$slider_autoplay = 'yes' === $settings['slider_autoplay'] ? 'true' : 'false';
			$data_slider    .= ' data-slider_autoplay="' . esc_attr( $slider_autoplay ) . '"';
			$data_slider    .= ' data-autoplay_speed="' . ( isset( $settings['autoplay_speed']['size'] ) ? esc_attr( $settings['autoplay_speed']['size'] ) : 3000 ) . '"';

			/** Tablet*/
			$data_slider .= ' data-slider_tablet_column="' . ( isset( $settings['slider_tablet_column'] ) ? esc_attr( $settings['slider_tablet_column'] ) : 3 ) . '"';
			$data_slider .= ' data-tablet_steps_slide="' . ( isset( $settings['tablet_steps_slide'] ) ? esc_attr( $settings['tablet_steps_slide'] ) : 1 ) . '"';

			$slider_responsive_tablet = ! empty( $settings['slider_responsive_tablet'] ) ? $settings['slider_responsive_tablet'] : '';
			$data_slider             .= ' data-slider_responsive_tablet="' . esc_attr( $slider_responsive_tablet ) . '"';
			if ( 'yes' === $slider_responsive_tablet ) {
				$tablet_slider_draggable = 'yes' === $settings['tablet_slider_draggable'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_slider_draggable="' . esc_attr( $tablet_slider_draggable ) . '"';

				$tablet_slider_infinite = 'yes' === $settings['tablet_slider_infinite'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_slider_infinite="' . esc_attr( $tablet_slider_infinite ) . '"';

				$tablet_slider_autoplay = 'yes' === $settings['tablet_slider_autoplay'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_slider_autoplay="' . esc_attr( $tablet_slider_autoplay ) . '"';
				$data_slider .= ' data-tablet_autoplay_speed="' . ( isset( $settings['tablet_autoplay_speed']['size'] ) ? esc_attr( $settings['tablet_autoplay_speed']['size'] ) : 1500 ) . '"';

				$tablet_slider_dots = 'yes' === $settings['tablet_slider_dots'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_slider_dots="' . esc_attr( $tablet_slider_dots ) . '"';

				$tablet_slider_arrows = 'yes' === $settings['tablet_slider_arrows'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_slider_arrows="' . esc_attr( $tablet_slider_arrows ) . '"';
				$data_slider .= ' data-tablet_slider_rows="' . ( isset( $settings['tablet_slider_rows'] ) ? esc_attr( $settings['tablet_slider_rows'] ) : 1 ) . '"';

				$tablet_center_mode = 'yes' === $settings['tablet_center_mode'] ? 'true' : 'false';

				$data_slider .= ' data-tablet_center_mode="' . esc_attr( $tablet_center_mode ) . '" ';
				$data_slider .= ' data-tablet_center_padding="' . ( isset( $settings['tablet_center_padding']['size'] ) ? esc_attr( $settings['tablet_center_padding']['size'] ) : 0 ) . '" ';
			}

			/** Mobile*/
			$data_slider .= ' data-slider_mobile_column="' . ( isset( $settings['slider_mobile_column'] ) ? esc_attr( $settings['slider_mobile_column'] ) : 2 ) . '"';
			$data_slider .= ' data-mobile_steps_slide="' . ( isset( $settings['mobile_steps_slide'] ) ? esc_attr( $settings['mobile_steps_slide'] ) : 1 ) . '"';

			$slider_responsive_mobile = ! empty( $settings['slider_responsive_mobile'] ) ? $settings['slider_responsive_mobile'] : '';

			$data_slider .= ' data-slider_responsive_mobile="' . esc_attr( $slider_responsive_mobile ) . '"';
			if ( 'yes' === $slider_responsive_mobile ) {
				$mobile_slider_draggable = ( 'yes' === $settings['mobile_slider_draggable'] ) ? 'true' : 'false';

				$data_slider .= ' data-mobile_slider_draggable="' . esc_attr( $mobile_slider_draggable ) . '"';

				$mobile_slider_infinite = ( 'yes' === $settings['mobile_slider_infinite'] ) ? 'true' : 'false';

				$data_slider .= ' data-mobile_slider_infinite="' . esc_attr( $mobile_slider_infinite ) . '"';

				$mobile_slider_autoplay = 'yes' === $settings['mobile_slider_autoplay'] ? 'true' : 'false';

				$data_slider .= ' data-mobile_slider_autoplay="' . esc_attr( $mobile_slider_autoplay ) . '"';
				$data_slider .= ' data-mobile_autoplay_speed="' . ( isset( $settings['mobile_autoplay_speed']['size'] ) ? esc_attr( $settings['mobile_autoplay_speed']['size'] ) : 1500 ) . '"';

				$mobile_slider_dots = 'yes' === $settings['mobile_slider_dots'] ? 'true' : 'false';

				$data_slider .= ' data-mobile_slider_dots="' . esc_attr( $mobile_slider_dots ) . '"';

				$mobile_slider_arrows = 'yes' === $settings['mobile_slider_arrows'] ? 'true' : 'false';

				$data_slider .= ' data-mobile_slider_arrows="' . esc_attr( $mobile_slider_arrows ) . '"';
				$data_slider .= ' data-mobile_slider_rows="' . ( isset( $settings['mobile_slider_rows'] ) ? esc_attr( $settings['mobile_slider_rows'] ) : 1 ) . '"';

				$mobile_center_mode = 'yes' === $settings['mobile_center_mode'] ? 'true' : 'false';

				$data_slider .= ' data-mobile_center_mode="' . esc_attr( $mobile_center_mode ) . '" ';
				$data_slider .= ' data-mobile_center_padding="' . ( isset( $settings['mobile_center_padding']['size'] ) ? esc_attr( $settings['mobile_center_padding']['size'] ) : 0 ) . '"';
			}

			$slider_dots   = 'yes' === $settings['slider_dots'] ? 'true' : 'false';
			$data_slider  .= ' data-slider_dots="' . esc_attr( $slider_dots ) . '"';
			$data_slider  .= ' data-slider_dots_style="slick-dots ' . ( isset( $settings['slider_dots_style'] ) ? esc_attr( $settings['slider_dots_style'] ) : 'style-1' ) . '" ';
			$slider_arrows = 'yes' === $settings['slider_arrows'] ? 'true' : 'false';

			$data_slider .= ' data-slider_arrows="' . esc_attr( $slider_arrows ) . '"';
			$data_slider .= ' data-slider_arrows_style="' . ( isset( $settings['slider_arrows_style'] ) ? esc_attr( $settings['slider_arrows_style'] ) : 'style-1' ) . '" ';
			$data_slider .= ' data-arrows_position="' . ( isset( $settings['arrows_position'] ) ? esc_attr( $settings['arrows_position'] ) : 'top-right' ) . '" ';
			$data_slider .= ' data-arrow_bg_color="' . ( isset( $settings['arrow_bg_color'] ) ? esc_attr( $settings['arrow_bg_color'] ) : '#c44d48' ) . '" ';
			$data_slider .= ' data-arrow_icon_color="' . ( isset( $settings['arrow_icon_color'] ) ? esc_attr( $settings['arrow_icon_color'] ) : '#fff' ) . '" ';
			$data_slider .= ' data-arrow_hover_bg_color="' . ( isset( $settings['arrow_hover_bg_color'] ) ? esc_attr( $settings['arrow_hover_bg_color'] ) : '#fff' ) . '" ';
			$data_slider .= ' data-arrow_hover_icon_color="' . ( isset( $settings['arrow_hover_icon_color'] ) ? esc_attr( $settings['arrow_hover_icon_color'] ) : '#c44d48' ) . '" ';

			$slider_center_mode = 'yes' === $settings['slider_center_mode'] ? 'true' : 'false';

			$data_slider .= ' data-slider_center_mode="' . esc_attr( $slider_center_mode ) . '" ';
			$data_slider .= ' data-center_padding="' . ( isset( $settings['center_padding']['size'] ) ? esc_attr( $settings['center_padding']['size'] ) : 0 ) . '" ';
			$data_slider .= ' data-scale_center_slide="' . ( isset( $settings['scale_center_slide']['size'] ) ? esc_attr( $settings['scale_center_slide']['size'] ) : 1 ) . '" ';
			$data_slider .= ' data-scale_normal_slide="' . ( isset( $settings['scale_normal_slide']['size'] ) ? esc_attr( $settings['scale_normal_slide']['size'] ) : 0.8 ) . '" ';
			$data_slider .= ' data-opacity_normal_slide="' . ( isset( $settings['opacity_normal_slide']['size'] ) ? esc_attr( $settings['opacity_normal_slide']['size'] ) : 0.7 ) . '" ';
			$data_slider .= ' data-slider_rows="' . ( isset( $settings['slider_rows'] ) ? esc_attr( $settings['slider_rows'] ) : 1 ) . '" ';
			$isotope      = 'list-carousel-slick';

			$slider_arrows_style = ! empty( $settings['slider_arrows_style'] ) ? $settings['slider_arrows_style'] : 'style-1';
			if ( 'style-3' === $slider_arrows_style || 'style-4' === $slider_arrows_style ) {
				$arrow_class = $settings['arrows_position'];
			}
			if ( ( $settings['slider_rows'] > 1 ) || ( $settings['tablet_slider_rows'] > 1 ) || ( $settings['mobile_slider_rows'] > 1 ) ) {
				$arrow_class .= ' multi-row';
			}
			if ( ! empty( $settings['hover_show_dots'] ) && 'yes' === $settings['hover_show_dots'] ) {
				$data_carousel .= ' hover-slider-dots';
			}
			if ( ! empty( $settings['hover_show_arrow'] ) && 'yes' === $settings['hover_show_arrow'] ) {
				$data_carousel .= ' hover-slider-arrow';
			}
			if ( ! empty( $settings['outer_section_arrow'] ) && 'yes' === $settings['outer_section_arrow'] && ( 'style-1' === $slider_arrows_style || 'style-2' === $slider_arrows_style || 'style-5' === $slider_arrows_style || 'style-6' === $slider_arrows_style ) ) {
				$data_carousel .= ' outer-slider-arrow';
			}

			$carousel_direction = ! empty( $settings['carousel_direction'] ) ? $settings['carousel_direction'] : 'ltr';
			if ( ! empty( $carousel_direction ) ) {
				$carousel_data = array(
					'carousel_direction' => $carousel_direction,
				);

				$carousel_slider = 'data-result="' . htmlspecialchars( wp_json_encode( $carousel_data, true ), ENT_QUOTES, 'UTF-8' ) . '"';
			}
		}

		$the_button = '';
		if ( 'yes' === $settings['display_button'] ) {
			if ( ! empty( $settings['button_link']['url'] ) ) {
				$this->add_link_attributes( 'button', $settings['button_link'] );
			}
			$this->add_render_attribute( 'button', 'class', 'button-link-wrap' );
			$hover_box_class = ( ! empty( $settings['hover_info_button'] ) && 'yes' === $settings['hover_info_button'] ) ? ' hover_box_button' : '';
			$this->add_render_attribute( 'button', 'class', $hover_box_class );
			$this->add_render_attribute( 'button', 'role', 'button' );

			$button_style = $settings['button_style'];
			$button_text  = $settings['button_text'];
			$btn_uid      = uniqid( 'btn' );
			$data_class   = $btn_uid;
			$data_class  .= ' button-' . esc_attr( $button_style ) . ' ';

			$the_button = '<div class="pt-plus-button-wrapper">';

			$the_button .= '<div class="button_parallax">';

				$the_button .= '<div class="ts-button">';

					$the_button .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . '">';

						$the_button .= '<div class="animted-content-inner">';

			if ( 'yes' === $full_infobox_switch ) {
				$the_button .= '<div class="button-link-wrap">';
			} else {
				$the_button .= '<a ' . $this->get_render_attribute_string( 'button' ) . '>';
			}

			$the_button .= $this->render_text();

			if ( 'yes' === $full_infobox_switch ) {
				$the_button .= '</div>';
			} else {
				$the_button .= '</a>';
			}

						$the_button .= '</div>';

					$the_button .= '</div>';

				$the_button .= '</div>';

			$the_button .= '</div>';
			$the_button .= '</div>';
		}

		if ( 'carousel_layout' === $info_box_layout ) {
			if ( ! empty( $settings['loop_content'] ) ) {
				$index = 0;
				foreach ( $settings['loop_content'] as $item ) {

					$r_full_infobox_switch = ! empty( $item['r_full_infobox_switch'] ) ? $item['r_full_infobox_switch'] : '';

					$tp_infobox_count = $index;

					$on_load_class  = '';
					$default_active = $settings['default_active'];

					if ( $tp_infobox_count === $default_active && 'yes' === $settings['connection_switch'] ) {
						$on_load_class = 'tp-info-active';
					}

					if ( ( 'yes' === $full_infobox_switch ) || ( 'yes' === $r_full_infobox_switch ) ) {
						$fc_load_class = 'tp-info-fbc';
					} else {
						$fc_load_class = 'tp-info-nc';
					}

					$list_img  = '';
					$svg_type  = '';
					$svg_image = '';

					$loop_title  = '';
					$list_title  = '';
					$description = '';

					$list_subtitle   = '';
					$loop_btn_text   = '';
					$loop_max_width  = '';
					$loop_svg_d_icon = '';
					$loop_image_icon = '';

					if ( ! empty( $item['loop_url_link']['url'] ) ) {
						$this->add_link_attributes( 'loop_box_link' . $index, $item['loop_url_link'] );
					}

					if ( ! empty( $item['loop_title'] ) ) {
						$loop_title     = $item['loop_title'];
						$loop_title_tag = ! empty( $settings['loop_title_tag'] ) ? $settings['loop_title_tag'] : 'h6';

						if ( ( ! empty( $item['loop_url_link']['url'] ) ) && ( 'yes' !== $r_full_infobox_switch ) ) {
							$list_title = '<a ' . $this->get_render_attribute_string( 'loop_box_link' . $index ) . '><' . theplus_validate_html_tag( $loop_title_tag ) . ' class="service-title ">' . wp_kses_post( $loop_title ) . '</' . theplus_validate_html_tag( $loop_title_tag ) . '></a>';
						} else {
							$list_title = '<' . theplus_validate_html_tag( $loop_title_tag ) . ' class="service-title">' . wp_kses_post( $loop_title ) . '</' . theplus_validate_html_tag( $loop_title_tag ) . '>';
						}
					}

					$loop_content_desc = ! empty( $item['loop_content_desc'] ) ? $item['loop_content_desc'] : '';
					$loop_image_icon   = ! empty( $item['loop_image_icon'] ) ? $item['loop_image_icon'] : '';

					if ( ! empty( $loop_content_desc ) ) {
						$description = '<div class="service-desc"> ' . wp_kses_post( $loop_content_desc ) . ' </div>';
					}

					/** Icon style*/
					if ( ! empty( $loop_image_icon ) ) {

						$loop_svg_d_icon     = $item['loop_svg_d_icon'];
						$loop_max_width_size = '';
						$loop_max_width_unit = '';
						$loop_max_width_size = ! empty( $item['loop_max_width']['size'] ) ? $item['loop_max_width']['size'] : 100;
						$loop_max_width_unit = ! empty( $item['loop_max_width']['unit'] ) ? $item['loop_max_width']['unit'] : 'px';

						$loop_max_width = $loop_max_width_size . $loop_max_width_unit;

						/** Icon Image*/
						if ( 'image' === $loop_image_icon ) {
							$loop_img_src = '';
							if ( ! empty( $item['loop_select_image']['url'] ) ) {
								$image_id     = $item['loop_select_image']['id'];
								$loop_img_src = tp_get_image_rander( $image_id, $item['loop_select_image_thumbnail_size'] );
							}
							$list_img      = '<div class="ts-icon-img icon-img-b " >';
								$list_img .= $loop_img_src;
							$list_img     .= '</div>';
						} elseif ( 'lottie' === $loop_image_icon ) {
							$ext = pathinfo( $item['lottieUrl']['url'], PATHINFO_EXTENSION );
							if ( 'json' !== $ext ) {
								$list_img = '<h3 class="theplus-posts-not-found">' . esc_html__( 'Opps!! Please Enter Only JSON File Extension.', 'theplus' ) . '</h3>';
							} else {
								$lottie_width  = isset( $settings['lottieWidth']['size'] ) ? $settings['lottieWidth']['size'] : 50;
								$lottie_height = isset( $settings['lottieHeight']['size'] ) ? $settings['lottieHeight']['size'] : 50;
								$lottie_speed  = isset( $settings['lottieSpeed']['size'] ) ? $settings['lottieSpeed']['size'] : 1;
								$lottie_loop   = isset( $settings['lottieLoop'] ) ? $settings['lottieLoop'] : 'no';
								$lottiehover   = isset( $settings['lottiehover'] ) ? $settings['lottiehover'] : 'no';

								$lottie_loop_value = '';

								if ( 'yes' === $lottie_loop ) {
									$lottie_loop_value = 'loop';
								}

								$lottie_anim = 'autoplay';
								if ( 'yes' === $lottiehover ) {
									$lottie_anim = 'hover';
								}

								$list_img = '<lottie-player src="' . esc_url( $item['lottieUrl']['url'] ) . '" style="width: ' . esc_attr( $lottie_width ) . 'px; height: ' . esc_attr( $lottie_height ) . 'px;" ' . esc_attr( $lottie_loop_value ) . '  speed="' . esc_attr( $lottie_speed ) . '" ' . esc_attr( $lottie_anim ) . '></lottie-player>';
							}
						} elseif ( 'icon' === $loop_image_icon ) {
							$icons = '';

							$loop_icon_style = ! empty( $item['loop_icon_style'] ) ? $item['loop_icon_style'] : '';
							if ( 'font_awesome' === $loop_icon_style ) {
								$icons = $item['loop_icon_fontawesome'];
							} elseif ( 'icon_mind' === $loop_icon_style ) {
								$icons = $item['loop_icons_mind'];
							} elseif ( 'font_awesome_5' === $loop_icon_style ) {
								ob_start();
									\Elementor\Icons_Manager::render_icon( $item['loop_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
									$icons = ob_get_contents();
								ob_end_clean();
							}

							if ( 'font_awesome_5' === $loop_icon_style ) {
								$list_img = '<span class=" service-icon ' . esc_attr( $icon_shine ) . ' ' . esc_attr( $service_icon_style ) . '" >' . $icons . '</span>';
							} else {
								$list_img = '<i class=" ' . esc_attr( $icons ) . ' service-icon ' . esc_attr( $icon_shine ) . ' ' . esc_attr( $service_icon_style ) . '" ></i>';
							}
						} elseif ( 'svg' === $loop_image_icon ) {
							$loop_svg_url = '';
							if ( 'img' === $item['loop_svg_icon'] ) {
								if ( ! empty( $item['loop_svg_image']['url'] ) ) {
									$loop_svg_url = $item['loop_svg_image']['url'];
								}
							} else {
								$loop_svg_url = THEPLUS_URL . 'assets/images/svg/' . esc_attr( $loop_svg_d_icon );
							}

							$rand_no = wp_rand( 1000000, 1500000 );

							$list_img                  = '<div class="pt_plus_animated_svg svg-' . esc_attr( $rand_no ) . ' " data-id="svg-' . esc_attr( $rand_no ) . '" data-type="' . esc_attr( $settings['svg_type'] ) . '" data-duration="' . esc_attr( $duration ) . '" data-stroke="' . esc_attr( $border_stroke_color ) . '" data-fill_color="' . esc_attr( $svg_fill_color ) . '" data-fillhover="' . esc_attr( $svg_fill_color_hover ) . '" data-strokehover="' . esc_attr( $border_stroke_color_hover ) . '">';
								$list_img             .= '<div class="info_box_svg svg_inner_block ' . esc_attr( $service_icon_style ) . '">';
									$svg_loop_url_pass = '';
									$ext               = pathinfo( $loop_svg_url, PATHINFO_EXTENSION );
							if ( ! empty( $loop_svg_url ) && 'svg' === $ext ) {
								$svg_loop_url_pass = $loop_svg_url;
							}
									$list_img .= '<object id="svg-' . esc_attr( $rand_no ) . '" type="image/svg+xml" data="' . esc_url( $svg_loop_url_pass ) . '"  style="max-width:' . esc_attr( $loop_max_width ) . ';max-height:' . esc_attr( $loop_max_width ) . ';margin:0 auto;"></object>';
								$list_img     .= '</div>';
							$list_img         .= '</div>';

						}
					}

					$loop_button = '';
					if ( 'yes' === $settings['loop_display_button'] ) {
						$link_key = 'link_' . $index;

						if ( ! empty( $item['loop_button_link']['url'] ) ) {
							$this->add_link_attributes( $link_key, $item['loop_button_link'] );
						}

						$this->add_render_attribute( $link_key, 'class', 'button-link-wrap' );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						$button_style = ! empty( $settings['loop_button_style'] ) ? $settings['loop_button_style'] : 'style-7';
						$button_text  = $item['loop_button_text'];

						$btn_uid     = uniqid( 'btn' );
						$data_class  = $btn_uid;
						$data_class .= ' button-' . esc_attr( $button_style ) . ' ';

						if ( 'style-7' === $button_style ) {
							$button_text = wp_kses_post( $button_text ) . '<span class="btn-arrow"></span>';
						}

						if ( 'style-8' === $button_style ) {
							$button_text = wp_kses_post( $button_text );
						}

						if ( 'style-9' === $button_style ) {
							$button_text = wp_kses_post( $button_text ) . '<span class="btn-arrow"><i class="fa-show fa fa-chevron-right" aria-hidden="true"></i><i class="fa-hide fa fa-chevron-right" aria-hidden="true"></i></span>';
						}

						$loop_button = '<div class="pt-plus-button-wrapper">';

							$loop_button .= '<div class="button_parallax">';

								$loop_button .= '<div class="ts-button">';

									$loop_button     .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . '">';
										$loop_button .= '<div class="animted-content-inner">';

						if ( 'yes' === $r_full_infobox_switch ) {
							$loop_button .= '<div class="button-link-wrap">';
						} else {
							$loop_button .= '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						}

						$loop_button .= $button_text;
						if ( 'yes' === $r_full_infobox_switch ) {
							$loop_button .= '</div>';
						} else {
							$loop_button .= '</a>';
						}

										$loop_button .= '</div>';

									$loop_button .= '</div>';

								$loop_button .= '</div>';

							$loop_button .= '</div>';

						$loop_button .= '</div>';
					}

					$full_infobox_linkr = ! empty( $item['r_full_infobox_link']['is_external'] ) ? '_blank' : '';

					if ( ( 'yes' === $r_full_infobox_switch ) && ! empty( $item['r_full_infobox_link'] ) ) {
						$output .= '<div class="info-box-inner elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $on_load_class ) . ' ' . esc_attr( $fc_load_class ) . '"><a href="' . esc_url( $item['r_full_infobox_link']['url'] ) . '" target="' . esc_attr( $full_infobox_linkr ) . '">';
					} else {
						$output .= '<div class="info-box-inner elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . esc_attr( $on_load_class ) . ' ' . esc_attr( $fc_load_class ) . '">';
					}

					if ( 'style_1' === $main_style ) {
						$output .= '<div class="info-box-bg-box ' . esc_attr( $serice_box_border ) . ' content_hover_effect ' . esc_attr( $hover_class ) . '">';

							$output .= '<div class="service-media text-left ' . esc_attr( $service_center ) . ' ">';

						if ( ! empty( $list_img ) ) {
							$output .= '<div class="m-r-16 ' . esc_attr( $serice_img_border ) . '" ' . $border_right_css . '> ' . $list_img . ' </div>';
						}

								$output .= '<div class="service-content ">';

									$output .= $list_title;
									$output .= $service_border;
									$output .= $description;
									$output .= $loop_button;

								$output .= '</div>';

							$output .= '</div>';
							$output .= '<div class="infobox-overlay-color"></div>';
						$output     .= '</div>';
					}

					if ( 'style_2' === $main_style ) {
						$output .= '<div class="info-box-bg-box ' . esc_attr( $serice_box_border ) . ' content_hover_effect ' . esc_attr( $hover_class ) . '">';

							$output .= '<div class="service-media text-right ' . esc_attr( $service_center ) . ' ">';

								$output     .= '<div class="service-content">';
									$output .= $list_title;
									$output .= $service_border;
									$output .= $description;
									$output .= $loop_button;
								$output     .= '</div>';

						if ( ! empty( $list_img ) ) {
							$output .= '<div class="m-l-16 serice_img_border" ' . $border_right_css . '>' . $list_img . '</div>';
						}
							$output .= '</div>';
							$output .= '<div class="infobox-overlay-color"></div>';
						$output     .= '</div>';
					}

					if ( 'style_3' === $main_style ) {
						$output             .= '<div class="info-box-bg-box ' . esc_attr( $serice_box_border ) . ' content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $inner_js_tilt ) . '" ' . $this->get_render_attribute_string( 'tilt_parallax' ) . '>';
							$output         .= '<div class="' . esc_attr( $service_align ) . '">';
								$output     .= '<div class="service-center  ">';
									$output .= $list_img;
									$output .= $list_title;
									$output .= $service_border;
									$output .= $description;
									$output .= $loop_button;
								$output     .= '</div>';
							$output         .= '</div>';
							$output         .= '<div class="infobox-overlay-color"></div>';
						$output             .= '</div>';
					}

					if ( 'style_4' === $main_style ) {
						$output                 .= '<div class="info-box-bg-box content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $serice_box_border ) . '" >';
							$output             .= '<div class="">';
								$output         .= '<div class="service-media service-left ' . esc_attr( $service_center ) . '">';
									$output     .= $list_img;
									$output     .= '<div class="service-content">';
										$output .= $list_title;
									$output     .= '</div>';
								$output         .= '</div>';
									$output     .= $service_border;
									$output     .= $description;
									$output     .= $loop_button;
							$output             .= '</div>';
							$output             .= '<div class="infobox-overlay-color"></div>';
						$output                 .= '</div>';
					}

					if ( 'style_7' === $main_style ) {
						$output     .= '<div class="info-box-bg-box">';
							$output .= '<div class="service-media text-left ' . esc_attr( $service_center ) . ' ">';
						if ( ! empty( $list_img ) ) {
							$output .= '<div class="m-r-16 service-bg-7 ' . esc_attr( $serice_img_border ) . '" ' . $border_right_css . '> ' . $list_img . ' </div>';
						}
								$output     .= '<div class="service-content ">';
									$output .= $list_title;
									$output .= $service_border;
									$output .= $description;
									$output .= $the_button;
								$output     .= '</div>';
							$output         .= '</div>';
							$output         .= '<div class="infobox-overlay-color"></div>';
						$output             .= '</div>';
					}

					if ( 'style_11' === $main_style ) {
						$output                         .= '<div class="info-box-bg-box content_hover_effect ' . esc_attr( $hover_class ) . '">';
							$output                     .= '<div class="info-box style-11 text-center">';
								$output                 .= '<div class="info-box-all">';
									$output             .= '<div class="info-box-wrapper ">';
										$output         .= '<div class="info-box-conetnt">';
											$output     .= '<div class="info-box-icon-img">';
												$output .= $list_img;
											$output     .= '</div>';
											$output     .= $list_title;
											$output     .= '<div class="info-box-title-hide">' . wp_kses_post( $item['loop_title'] ) . ' </div>';
											$output     .= $service_border;
											$output     .= $description;
											$output     .= $loop_button;
										$output         .= '</div>';
									$output             .= '</div>';
								$output                 .= '</div>';
								$output                 .= '</div>';
							$output                     .= '<div class="infobox-overlay-color"></div>';
						$output                         .= '</div>';
					}

					if ( ( 'yes' === $r_full_infobox_switch ) && ! empty( $item['r_full_infobox_link'] ) ) {
						$output .= '</a></div>';
					} else {
						$output .= '</div>';
					}

					++$index;
				}
			}
		}

		if ( 'single_layout' === $info_box_layout ) {
			if ( ( 'yes' === $full_infobox_switch ) && ! empty( $full_infobox_link ) ) {
				$output = '<a href="' . esc_url( $full_infobox_link ) . '" target="' . esc_attr( $full_infobox_blank ) . '"> <div class="info-box-inner content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $fc_load_class ) . '"  ' . $hover_attr . ' >';
			} else {
				$output = '<div class="info-box-inner content_hover_effect ' . esc_attr( $hover_class ) . ' ' . esc_attr( $fc_load_class ) . '"  ' . $hover_attr . ' >';
			}

			$lazy_bg    = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_background_image'], $settings['box_hover_background_image'] ) : '';
			$lazy_ol_bg = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['box_hover_background_image'] ) : '';

			if ( 'style_1' === $main_style ) {
				$icon_overlay_style = '';
				if ( 'yes' === $icon_overlay ) {
					$icon_overlay_style = 'icon-overlay';
				}

				$output     .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . ' ' . esc_attr( $icon_overlay_style ) . ' ' . esc_attr( $serice_box_border ) . '">';
					$output .= '<div class="service-media text-left ' . esc_attr( $service_center ) . ' ">';

				if ( ! empty( $service_img ) ) {
					$output .= '<div class="m-r-16  ' . esc_attr( $serice_img_border ) . '" ' . $border_right_css . '> ' . $service_img . ' </div>';
				}

						$output     .= '<div class="service-content ">';
							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
						$output     .= '</div>';

					$output .= '</div>';
					$output .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output     .= '</div>';
			}

			if ( 'style_2' === $main_style ) {
				$icon_overlay_style = '';
				if ( 'yes' === $icon_overlay ) {
					$icon_overlay_style = 'icon-overlay';
				}
				$output             .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . ' ' . esc_attr( $icon_overlay_style ) . ' ' . esc_attr( $serice_box_border ) . '">';
					$output         .= '<div class="service-media text-right ' . esc_attr( $service_center ) . ' ">';
						$output     .= '<div class="service-content">';
							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
						$output     .= '</div>';
				if ( ! empty( $service_img ) ) {
					$output .= '<div class="m-l-16 ' . esc_attr( $serice_img_border ) . ' " ' . $border_right_css . '>' . $service_img . '</div>';
				}
					$output .= '</div>';
					$output .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output     .= '</div>';
			}

			if ( 'style_3' === $main_style ) {
				$pin_text   = '';
				$square_pin = '';
				if ( ! empty( $settings['display_pin_text'] ) && 'yes' === $settings['display_pin_text'] ) {
					if ( ! empty( $settings['square_pin'] ) && 'yes' === $settings['square_pin'] ) {
						$square_pin = 'square-pin';
					}
					$pin_text = '<div class="info-pin-text ' . esc_attr( $square_pin ) . '">' . wp_kses_post( $settings['pin_text_title'] ) . '</div>';
				}

				$icon_overlay_style = '';
				if ( 'yes' === $icon_overlay ) {
					$icon_overlay_style = 'icon-overlay';
				}

				$output             .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . ' ' . esc_attr( $icon_overlay_style ) . ' ' . esc_attr( $serice_box_border ) . '  ' . esc_attr( $inner_js_tilt ) . '" ' . $this->get_render_attribute_string( 'tilt_parallax' ) . '>';
					$output         .= '<div class="' . esc_attr( $service_align ) . '">';
						$output     .= '<div class="service-center  ">';
							$output .= '<div class="info-icon-content">' . $pin_text . $service_img . '</div>';
							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
							$output .= '</div>';
					$output         .= '</div>';
					$output         .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output             .= '</div>';
			}

			if ( 'style_4' === $main_style ) {
				$output                 .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . ' ' . esc_attr( $serice_box_border ) . '">';
					$output             .= '<div class="">';
						$output         .= '<div class="service-media service-left ' . esc_attr( $service_center ) . '">';
							$output     .= $service_img;
							$output     .= '<div class="service-content">';
								$output .= $service_title;
							$output     .= '</div>';
						$output         .= '</div>';
							$output     .= $service_border;
							$output     .= $description;
							$output     .= $the_button;
					$output             .= '</div>';
					$output             .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output                 .= '</div>';
			}

			if ( 'style_7' === $main_style ) {
				$output     .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . '">';
					$output .= '<div class="service-media text-left ' . esc_attr( $service_center ) . ' ">';
				if ( ! empty( $service_img ) ) {
					$output .= '<div class="m-r-16 service-bg-7 ' . esc_attr( $serice_img_border ) . '" ' . $border_right_css . '> ' . $service_img . ' </div>';
				}

						$output .= '<div class="service-content ">';

							$output .= $service_title;
							$output .= $service_border;
							$output .= $description;
							$output .= $the_button;
						$output     .= '</div>';

					$output .= '</div>';

					$output .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';

				$output .= '</div>';
			}

			if ( 'style_11' === $main_style ) {
				$output .= '<div class="info-box-bg-box ' . esc_attr( $lazy_bg ) . '">';

					$output .= '<div class="info-box style-11 text-center">';

						$output .= '<div class="info-box-all">';

							$output .= '<div class="info-box-wrapper ">';

								$output .= '<div class="info-box-conetnt">';

									$output     .= '<div class="info-box-icon-img">';
										$output .= $service_img;
									$output     .= '</div>';

									$output .= $service_title;
									$output .= '<div class="info-box-title-hide"> ' . wp_kses_post( $settings['title'] ) . ' </div>';
									$output .= $service_border;
									$output .= $description;
									$output .= $the_button;

								$output .= '</div>';

							$output .= '</div>';

						$output .= '</div>';

					$output .= '</div>';

					$output .= '<div class="infobox-overlay-color ' . esc_attr( $lazy_ol_bg ) . '"></div>';
				$output     .= '</div>';
			}

			$output .= '</div>';

			if ( ( 'yes' === $full_infobox_switch ) && ! empty( $full_infobox_link ) ) {
				$output .= '</a>';
			}
		}

		$visiblity_hide = '';
		if ( ! empty( $settings['responsive_visible_opt'] ) && 'yes' === $settings['responsive_visible_opt'] ) {
			$visiblity_hide .= ( 'yes' !== $settings['desktop_opt'] && empty( $settings['desktop_opt'] ) ) ? 'hide-desktop ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['tablet_opt'] && empty( $settings['tablet_opt'] ) ) ? 'hide-tablet ' : '';
			$visiblity_hide .= ( 'yes' !== $settings['mobile_opt'] && empty( $settings['mobile_opt'] ) ) ? 'hide-mobile ' : '';
		}

		$uid = uniqid( 'info_box' );

		$carousel_bg = '';
		if ( ! empty( $settings['carousel_unique_id'] ) ) {
			$uid = 'tpca_' . $settings['carousel_unique_id'];

			$carousel_bg = ' data-carousel-bg-conn="bgcarousel' . esc_attr( $settings['carousel_unique_id'] ) . '"';
		}

		$connect_carousel       = '';
		$connection_hover_click = '';
		if ( ! empty( $settings['connection_unique_id'] ) ) {
			$connect_carousel = 'tpca_' . $settings['connection_unique_id'];

			$uid = 'tptab_' . $settings['connection_unique_id'];

			$connection_hover_click = $settings['connection_hover_click'];
		}

		$info_box = '<div id="' . esc_attr( $uid ) . '" class="pt_plus_info_box ' . esc_attr( $settings['bg_hover_animation'] ) . ' ' . esc_attr( $isotope ) . ' ' . esc_attr( $arrow_class ) . ' ' . esc_attr( $data_carousel ) . ' ' . esc_attr( $uid ) . ' info-box-' . esc_attr( $main_style ) . ' ' . esc_attr( $animated_class ) . '  ' . esc_attr( $service_space ) . ' ' . esc_attr( $tilt_hover_class ) . ' ' . $visiblity_hide . ' "  data-id="' . esc_attr( $uid ) . '" ' . $animation_attr . ' ' . $data_slider . ' ' . $carousel_slider . ' dir=' . esc_attr( $carousel_direction ) . ' data-connection="' . esc_attr( $connect_carousel ) . '" data-eventtype="' . esc_attr( $connection_hover_click ) . '" ' . $carousel_bg . '>';

			$info_box     .= '<div class="post-inner-loop ">';
				$info_box .= $output;
			$info_box     .= '</div>';

		$info_box .= '</div>';

		echo $before_content . $info_box . $after_content;
	}

	/**
	 * Render Text
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render_text() {
		$icons_after  = '';
		$icons_before = '';
		$settings     = $this->get_settings_for_display();
		$button_style = $settings['button_style'];
		$before_after = $settings['before_after'];
		$button_text  = $settings['button_text'];

		if ( 'font_awesome' === $settings['button_icon_style'] ) {
			$icons = $settings['button_icon'];
		} elseif ( 'icon_mind' === $settings['button_icon_style'] ) {
			$icons = $settings['button_icons_mind'];
		} elseif ( 'font_awesome_5' === $settings['button_icon_style'] ) {
			ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['button_icon_5'], array( 'aria-hidden' => 'true' ) );
				$icons = ob_get_contents();
			ob_end_clean();
		} else {
			$icons = '';
		}

		if ( 'before' === $before_after && ! empty( $icons ) ) {
			if ( ! empty( $settings['button_icon_style'] ) && 'font_awesome_5' === $settings['button_icon_style'] ) {
				$icons_before = '<span class="btn-icon button-before">' . $icons . '</span>';
			} else {
				$icons_before = '<i class="btn-icon button-before ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'after' === $before_after && ! empty( $icons ) ) {
			if ( ! empty( $settings['button_icon_style'] ) && 'font_awesome_5' === $settings['button_icon_style'] ) {
				$icons_after = '<span class="btn-icon button-after">' . $icons . '</span>';
			} else {
				$icons_after = '<i class="btn-icon button-after ' . esc_attr( $icons ) . '"></i>';
			}
		}

		if ( 'style-8' === $button_style ) {
			$button_text = $icons_before . $button_text . $icons_after;
		}

		if ( 'style-7' === $button_style ) {
			$button_text = $button_text . '<span class="btn-arrow"></span>';
		}

		if ( 'style-9' === $button_style ) {
			$button_text = $button_text . '<span class="btn-arrow"><i class="fa-show fa fa-chevron-right" aria-hidden="true"></i><i class="fa-hide fa fa-chevron-right" aria-hidden="true"></i></span>';
		}
		return $button_text;
	}

	/**
	 * Render content_template
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}