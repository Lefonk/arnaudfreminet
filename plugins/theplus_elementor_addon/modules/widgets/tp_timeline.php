<?php
/**
 * Widget Name: Timeline
 * Description: Timeline.
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
 * Class ThePlus_TimeLine
 */
class ThePlus_TimeLine extends Widget_Base {

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = THEPLUS_HELP;	

	/**
	 * Get Widget Name
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-timeline';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Timeline', 'theplus' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-ellipsis-v theplus_backend_icon';
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
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-creatives' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Time', 'Line', 'Timeline', 'Chronology', 'Events', 'History', 'Progress', 'Schedule', 'Chronological', 'Sequential' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.4.0
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
			'style',
			array(
				'label'   => esc_html__( 'Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list( 2 ),
			)
		);
		$this->add_control(
			'timeline_inline_masonry',
			array(
				'label'        => esc_html__( 'Masonry Layout', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'timeline_content_align',
			array(
				'label'   => esc_html__( 'Content Alignment', 'theplus' ),
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
				'toggle'  => false,
			)
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_pin_select_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon or Custom Image using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''      => esc_html__( 'None', 'theplus' ),
					'icon'  => esc_html__( 'Icon', 'theplus' ),
					'image' => esc_html__( 'Image', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'pin_icon_style',
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
					'loop_pin_select_icon' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'pin_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-download',
				'condition' => array(
					'loop_pin_select_icon' => 'icon',
					'pin_icon_style'       => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'pin_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-download',
					'library' => 'solid',
				),
				'separator' => 'before',
				'condition' => array(
					'loop_pin_select_icon' => 'icon',
					'pin_icon_style'       => 'font_awesome_5',
				),
			)
		);
		$repeater->add_control(
			'pin_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => 'iconsmind-Download-2',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'loop_pin_select_icon' => 'icon',
					'pin_icon_style'       => 'icon_mind',
				),
			)
		);
		$repeater->add_control(
			'loop_pin_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'dynamic'    => array( 'active' => true ),
				'media_type' => 'image',
				'condition'  => array(
					'loop_pin_select_icon' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'loop_pin_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'loop_pin_select_icon' => 'image',
				),
			)
		);
		$repeater->add_control(
			'pin_title',
			array(
				'label'   => esc_html__( 'Pin Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '26-06-2018', 'theplus' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$repeater->add_control(
			'pin_title_position',
			array(
				'label'     => esc_html__( 'Pin Position', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'theplus' ),
					'right'  => esc_html__( 'Right', 'theplus' ),
					'top'    => esc_html__( 'Top', 'theplus' ),
					'bottom' => esc_html__( 'Bottom', 'theplus' ),
				),
				'condition' => array(
					'pin_title!' => '',
				),
			)
		);
		$repeater->start_controls_tabs( 'loop_tabs_content' );
		$repeater->start_controls_tab(
			'tab_loop_content',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
			)
		);
		$repeater->add_control(
			'loop_content_title',
			array(
				'label'   => esc_html__( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ThePlus Addons', 'theplus' ),
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
				'default' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet.', 'theplus' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'loop_content_options',
			array(
				'label'     => esc_html__( 'Content Type', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'image',
				'options'   => array(
					'image'    => esc_html__( 'Image', 'theplus' ),
					'iframe'   => esc_html__( 'Iframe/HTML', 'theplus' ),
					'template' => esc_html__( 'Template', 'theplus' ),
				),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'loop_featured_image',
			array(
				'label'     => esc_html__( 'Featured Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'default'   => array(
					'url' => '',
				),
				'condition' => array(
					'loop_content_options' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'loop_featured_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'loop_content_options' => 'image',
				),
			)
		);
		$repeater->add_control(
			'loop_featured_iframe',
			array(
				'label'     => esc_html__( 'Custom HTML/Iframe Code', 'theplus' ),
				'type'      => Controls_Manager::CODE,
				'language'  => 'html',
				'rows'      => 10,
				'condition' => array(
					'loop_content_options' => 'iframe',
				),
			)
		);
		$repeater->add_control(
			'loop_content_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'loop_content_options' => 'template',
				),
			)
		);
		$repeater->add_control(
			'loop_link',
			array(
				'label'         => esc_html__( 'Link', 'theplus' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url' => '',
				),
				'separator'     => 'before',
			)
		);
		$repeater->add_control(
			'loop_display_button',
			array(
				'label'        => esc_html__( 'Display Button', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$repeater->add_control(
			'loop_button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'loop_display_button' => 'yes',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_loop_advance',
			array(
				'label' => esc_html__( 'Advance', 'theplus' ),
			)
		);
		$repeater->add_control(
			'loop_content_alignment',
			array(
				'label'   => esc_html__( 'Content Alignment', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text-left',
				'options' => array(
					'text-left'   => esc_html__( 'Left', 'theplus' ),
					'text-center' => esc_html__( 'Center', 'theplus' ),
					'text-right'  => esc_html__( 'Right', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'loop_alignment_section',
			array(
				'label'       => esc_html__( 'Section Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'left',
				'toggle'      => false,
				'label_block' => false,
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'loop_animation_effects',
			array(
				'label'     => esc_html__( 'In Animation Effect', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'no-animation',
				'options'   => theplus_get_animation_options(),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'loop_animation_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Delay', 'theplus' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'loop_animation_effects!' => 'no-animation',
				),
			)
		);
		$repeater->add_responsive_control(
			'loop_top_offset',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Top Offset Space', 'theplus' ),
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list {{CURRENT_ITEM}}.timeline-item-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->add_control(
			'content_loop_section',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'loop_content_title'     => esc_html__( 'ThePlus Addons', 'theplus' ),
						'tab_content'            => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'theplus' ),
						'pin_title_position'     => 'right',
						'loop_alignment_section' => 'left',
						'loop_content_alignment' => 'text-right',
					),
					array(
						'loop_content_title'     => esc_html__( 'ThePlus Addons', 'theplus' ),
						'tab_content'            => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'theplus' ),
						'pin_title_position'     => 'left',
						'loop_alignment_section' => 'right',
						'loop_content_alignment' => 'text-left',
					),
				),
				'title_field' => '{{{ loop_content_title }}}',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_timeline_start_end_section',
			array(
				'label' => esc_html__( 'Start / End Pin', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'pin_center_style',
			array(
				'label'   => esc_html__( 'Pin Center Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list( 2 ),
			)
		);
		$this->add_control(
			'pin_start_end_options',
			array(
				'label'     => esc_html__( 'Pin Start/End Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_pin_start_end' );
		$this->start_controls_tab(
			'tab_pin_start',
			array(
				'label' => esc_html__( 'Start Pin', 'theplus' ),
			)
		);
		$this->add_control(
			'start_pin_select_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon or Custom Image using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''      => esc_html__( 'None', 'theplus' ),
					'icon'  => esc_html__( 'Icon', 'theplus' ),
					'image' => esc_html__( 'Image', 'theplus' ),
					'text'  => esc_html__( 'Text', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'start_pin_icon_style',
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
					'start_pin_select_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'start_pin_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-angle-double-down',
				'condition' => array(
					'start_pin_select_icon' => 'icon',
					'start_pin_icon_style'  => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'start_pin_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-angle-double-down',
					'library' => 'solid',
				),
				'condition' => array(
					'start_pin_select_icon' => 'icon',
					'start_pin_icon_style'  => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'start_pin_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => 'iconsmind-Download-2',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'start_pin_select_icon' => 'icon',
					'start_pin_icon_style'  => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'start_pin_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'start_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'start_pin_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'start_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'start_pin_title',
			array(
				'label'     => esc_html__( 'Start Pin Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'START', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_pin_end',
			array(
				'label' => esc_html__( 'End Pin', 'theplus' ),
			)
		);
		$this->add_control(
			'end_pin_select_icon',
			array(
				'label'       => esc_html__( 'Select Icon', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'description' => esc_html__( 'You can select Icon or Custom Image using this option.', 'theplus' ),
				'default'     => 'icon',
				'options'     => array(
					''      => esc_html__( 'None', 'theplus' ),
					'icon'  => esc_html__( 'Icon', 'theplus' ),
					'image' => esc_html__( 'Image', 'theplus' ),
					'text'  => esc_html__( 'Text', 'theplus' ),
				),
			)
		);
		$this->add_control(
			'end_pin_icon_style',
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
					'end_pin_select_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'end_pin_icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-stop-circle',
				'condition' => array(
					'end_pin_select_icon' => 'icon',
					'end_pin_icon_style'  => 'font_awesome',
				),
			)
		);
		$this->add_control(
			'end_pin_icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-stop-circle',
					'library' => 'solid',
				),
				'condition' => array(
					'end_pin_select_icon' => 'icon',
					'end_pin_icon_style'  => 'font_awesome_5',
				),
			)
		);
		$this->add_control(
			'end_pin_icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => 'iconsmind-Download-2',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'end_pin_select_icon' => 'icon',
					'end_pin_icon_style'  => 'icon_mind',
				),
			)
		);
		$this->add_control(
			'end_pin_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'theplus' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'end_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'end_pin_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'end_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'end_pin_title',
			array(
				'label'     => esc_html__( 'End Pin Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'END', 'theplus' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'loop_pin_style_section',
			array(
				'label' => esc_html__( 'Loop Pin Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'pin_title_heading_style',
			array(
				'label'     => esc_html__( 'Pin Title Style', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pin_title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-text-tooltip',
			)
		);
		$this->start_controls_tabs( 'tabs_pin_title_style' );
		$this->start_controls_tab(
			'tab_pin_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_title_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-text-tooltip' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_title_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dddddd',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-text-tooltip' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-text-tooltip .tooltip-arrow' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_title_radius',
			array(
				'label'      => esc_html__( 'Pin Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-text-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_pin_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-text-tooltip' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_title_hover_bg_color',
			array(
				'label'     => esc_html__( 'Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dddddd',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-text-tooltip' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-text-tooltip .tooltip-arrow' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'pin_icon_heading_style',
			array(
				'label'     => esc_html__( 'Pin Icon Style', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'pin_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-pin-icon i.point-icon-inner' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-pin-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-pin-icon img.point-icon-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'pin_icon_bg_cir_size',
			array(
				'label'      => esc_html__( 'Icon Background Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .point-icon.style-2 .timeline-tooltip-wrap' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pin_text_center_switch',
			array(
				'label'     => esc_html__( 'Pin Text Center Align', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'selectors' => array(
					'{{WRAPPER}} .point-icon .timeline-text-tooltip' => 'top:50%;transform:translateY(-50%) !important;margin: 0 !important;',
				),
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'tabs_pin_icon_style' );
		$this->start_controls_tab(
			'tab_pin_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .point-icon .timeline-tooltip-wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .point-icon .timeline-tooltip-wrap svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_icon_bg_color',
			array(
				'label'     => esc_html__( 'Icon Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2e2e2',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .point-icon .timeline-tooltip-wrap' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_icon_border_color',
			array(
				'label'     => esc_html__( 'Icon Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .point-icon .timeline-tooltip-wrap' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_icon_radius',
			array(
				'label'      => esc_html__( 'Icon Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .point-icon .timeline-tooltip-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_pin_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_icon_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .point-icon .timeline-tooltip-wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .point-icon .timeline-tooltip-wrap svg' => 'fill: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_icon_hover_bg_color',
			array(
				'label'     => esc_html__( 'Hover Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2e2e2',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .point-icon .timeline-tooltip-wrap' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'pin_icon_hover_border_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .point-icon .timeline-tooltip-wrap' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
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
				'selector' => '{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-item-heading',
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
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-item-heading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-1 .timeline-item-wrap .timeline-item .timeline-tl-before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .border-bottom hr' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => array( 'style-1', 'style-2' ),
				),
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
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-item-heading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-1 .timeline-item-wrap:hover .timeline-item .timeline-tl-before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .border-bottom hr' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'style' => array( 'style-1', 'style-2' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'content_desc_style_section',
			array(
				'label' => esc_html__( 'Description/Content Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-item-description',
			)
		);
		$this->start_controls_tabs( 'tabs_desc_style' );
		$this->start_controls_tab(
			'tab_desc_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-item-description,{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap .timeline-item-description p' => 'color: {{VALUE}};-webkit-transition: all .55s;-moz-transition: all .55s;-o-transition: all .55s;-ms-transition: all .55s;transition: all .55s;',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_desc_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'desc_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-item-description,{{WRAPPER}} .pt-plus-timeline-list .timeline-item-wrap:hover .timeline-item-description p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'timeline_button_option_section',
			array(
				'label' => esc_html__( 'Button Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'display_button',
			array(
				'label'        => esc_html__( 'Display Button', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read More', 'theplus' ),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Button Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '10',
					'right'    => '20',
					'bottom'   => '10',
					'left'     => '20',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'selector'  => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'button_top_offset',
			array(
				'label'      => esc_html__( 'Button Top Offset', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'display_button' => 'yes',
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
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'display_button' => 'yes',
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
				'condition'  => array(
					'display_button'       => 'yes',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'separator' => 'after',
				'condition' => array(
					'display_button'       => 'yes',
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
				'default'    => array(
					'top'      => 3,
					'right'    => 3,
					'bottom'   => 3,
					'left'     => 3,
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				// 'separator' => 'after',	
				'condition' => array(
					'display_button' => 'yes',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'after',
				'condition' => array(
					'display_button'       => 'yes',
					'button_border_style!' => 'none',
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => array(
					'display_button' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'loop_content_style_section',
			array(
				'label'     => esc_html__( 'Loop Content Background Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_loop_content_bg_style' );
		$this->start_controls_tab(
			'tab_loop_content_bg_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loop_content_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content',
			)
		);
		$this->add_control(
			'loop_content_border',
			array(
				'label'        => esc_html__( 'Border', 'theplus' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'theplus' ),
				'label_off'    => esc_html__( 'Off', 'theplus' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'loop_content_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content' => 'border-style: {{VALUE}}',
				),
				'condition' => array(
					'loop_content_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'loop_content_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'loop_content_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'loop_content_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'loop_content_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'loop_content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'loop_content_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-inner-block .timeline-item .timeline-item-content',

			)
		);
		$this->add_control(
			'loop_content_arrow_color',
			array(
				'label'     => esc_html__( 'Arrow Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap .timeline-tl-before' => 'border-left-color: {{VALUE}};border-right-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'loop_content_arrow_style',
			array(
				'label'   => esc_html__( 'Arrow Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'theplus' ),
					'style-2' => esc_html__( 'Style 2', 'theplus' ),
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_loop_content_hover_background',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'loop_content_hover_background',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .timeline-inner-block .timeline-item .timeline-item-content',
			)
		);
		$this->add_control(
			'loop_content_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .timeline-inner-block .timeline-item .timeline-item-content' => 'border-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'loop_content_hover_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .timeline-inner-block .timeline-item .timeline-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'loop_content_hover_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .timeline-inner-block .timeline-item .timeline-item-content',

			)
		);
		$this->add_control(
			'loop_content_arrow_hover_color',
			array(
				'label'     => esc_html__( 'Arrow Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .timeline-style-2 .timeline-item-wrap:hover .timeline-tl-before' => 'border-left-color: {{VALUE}};border-right-color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'pin_start_end_style_section',
			array(
				'label' => esc_html__( 'Pin Start/End Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'divide_line_border_color',
			array(
				'label'     => esc_html__( 'Divide Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-track' => 'background: {{VALUE}}',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_pin_start_end_style' );
		$this->start_controls_tab(
			'tab_pin_start_style',
			array(
				'label' => esc_html__( 'Pin Start', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_start_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-beginning-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-beginning-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'start_pin_select_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'pin_start_image_size',
			array(
				'label'      => esc_html__( 'Image Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-beginning-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'start_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'pin_start_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'pin_start_text_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start',
				'condition' => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_start_text_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-beginning-icon,{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-beginning-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'start_pin_select_icon' => array( 'icon', 'text' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'pin_start_text_background',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start',
				'condition' => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_start_text_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_start_text_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pin_start_text_box_shadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-start',
				'condition' => array(
					'start_pin_select_icon' => 'text',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_pin_end_style',
			array(
				'label' => esc_html__( 'Pin End', 'theplus' ),
			)
		);
		$this->add_control(
			'pin_end_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-end-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-end-icon svg' => 'width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'end_pin_select_icon' => 'icon',
				),
			)
		);
		$this->add_control(
			'pin_end_image_size',
			array(
				'label'      => esc_html__( 'Image Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 250,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-end-icon img' => 'max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'end_pin_select_icon' => 'image',
				),
			)
		);
		$this->add_control(
			'pin_end_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'pin_end_text_typography',
				'label'     => esc_html__( 'Typography', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end',
				'condition' => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_end_text_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-end-icon,{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-end-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'end_pin_select_icon' => array( 'icon', 'text' ),
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'pin_end_text_background',
				'label'     => esc_html__( 'Background', 'theplus' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end',
				'condition' => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_end_text_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_control(
			'pin_end_text_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'pin_end_text_box_shadow',
				'label'     => esc_html__( 'Box Shadow', 'theplus' ),
				'selector'  => '{{WRAPPER}} .pt-plus-timeline-list .timeline-text.timeline-text-end',
				'condition' => array(
					'end_pin_select_icon' => 'text',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'timeline_extra_option_section',
			array(
				'label'     => esc_html__( 'Extra Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-1',
				),
			)
		);
		$this->add_responsive_control(
			'content_gap_between',
			array(
				'label'      => esc_html__( 'Divider Gap Content', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
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
					'size' => 120,
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render Timeline
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$data_class     = '';
		$timeline_start = '';
		$timeline_loop  = '';
		$timeline_end   = '';

		$timeline_inline_masonry = 'yes' === $settings['timeline_inline_masonry'] ? 'data-masonry-type="yes" data-enable-isotope="1" data-layout-type="masonry"' : 'data-masonry-type="no"';
		$timeline_masonry_class  = 'yes' === $settings['timeline_inline_masonry'] ? 'list-isotope' : '';

		$style = ! empty( $settings['style'] ) ? $settings['style'] : 'style-1';

		$uid = uniqid( 'timeline' );
		$ij  = 0;

		$arrow_style = ( 'style-2' === $style && ! empty( $settings['loop_content_arrow_style'] ) ) ? 'arrow-' . $settings['loop_content_arrow_style'] : '';
		$data_class  = $uid;
		$data_class .= ' timeline-' . esc_attr( $style ) . ' ';

		if ( ! empty( $settings['content_loop_section'] ) ) {
			foreach ( $settings['content_loop_section'] as $item ) {

				$pin_title    = '';
				$style_border = '';
				$content_desc = '';

				$content_image = '';
				$content_title = '';

				$timeline_pin_icon   = '';
				$section_alignment   = '';
				$pin_title_position  = '';
				$title_border_bottom = '';

				/** Pin Position*/
				$pin_title_pos = ! empty( $item['pin_title_position'] ) ? $item['pin_title_position'] : 'top';
				if ( ! empty( $pin_title_pos ) ) {
					$pin_title_position = 'position-' . $pin_title_pos;
				} else {
					$pin_title_position = 'position-top';
				}

				/** Pin Title*/
				$pin_title_text = ! empty( $item['pin_title'] ) ? $item['pin_title'] : '';
				if ( ! empty( $pin_title_text ) ) {
					$pin_title = '<div class="timeline-text-tooltip ' . esc_attr( $pin_title_position ) . ' timeline-transition" style="opacity: 1;">' . esc_html( $pin_title_text ) . '<div class="tooltip-arrow timeline-transition"></div></div>';
				}

				/** Pin Icons*/
				$loop_icon_type = ! empty( $item['loop_pin_select_icon'] ) ? $item['loop_pin_select_icon'] : '';
				$pin_icon_style = ! empty( $item['pin_icon_style'] ) ? $item['pin_icon_style'] : 'font_awesome';
				if ( ! empty( $loop_icon_type ) ) {
					if ( 'image' === $loop_icon_type ) {
						$loop_img_src = '';
						if ( ! empty( $item['loop_pin_image']['url'] ) ) {
							$loop_pin_image = $item['loop_pin_image']['id'];
							$loop_img_src   = tp_get_image_rander( $loop_pin_image, $item['loop_pin_image_thumbnail_size'], array( 'class' => 'point-icon-inner' ) );
						}

						$list_img = $loop_img_src;
					} elseif ( 'icon' === $loop_icon_type ) {
						if ( 'font_awesome' === $pin_icon_style ) {
							$icons = $item['pin_icon_fontawesome'];
						} elseif ( 'icon_mind' === $pin_icon_style ) {
							$icons = $item['pin_icons_mind'];
						} else {
							$icons = '';
						}

						if ( 'font_awesome_5' === $pin_icon_style ) {
							ob_start();
							\Elementor\Icons_Manager::render_icon( $item['pin_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
							$list_img = ob_get_contents();
							ob_end_clean();
						} else {
							$list_img = '<i class=" ' . esc_attr( $icons ) . ' point-icon-inner " ></i>';
						}
					}

					$timeline_pin_icon = '<div class="timeline-pin-icon">' . $list_img . '</div>';
				}

				/** Loop Content Title*/
				$loop_content_title = ! empty( $item['loop_content_title'] ) ? $item['loop_content_title'] : '';
				if ( ! empty( $loop_content_title ) ) {
					if ( ! empty( $item['loop_link']['url'] ) ) {
						$loop_link = $item['loop_link']['url'];
						$target    = $item['loop_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow  = $item['loop_link']['nofollow'] ? ' rel="nofollow"' : '';

						$content_title = '<a class="timeline-item-heading timeline-transition" href="' . esc_url( $loop_link ) . '" ' . $target . ' ' . $nofollow . '>' . wp_kses_post( $loop_content_title ) . '</a>';
					} else {
						$content_title = '<h3 class="timeline-item-heading timeline-transition">' . esc_html( $loop_content_title ) . '</h3>';
					}
				}

				/** Loop Content Image*/
				$loop_content_options = ! empty( $item['loop_content_options'] ) ? $item['loop_content_options'] : 'image';
				if ( ! empty( $item['loop_featured_image']['url'] ) && 'image' === $loop_content_options ) {
					$image_id = $item['loop_featured_image']['id'];

					$loop_featured_image_src = tp_get_image_rander( $image_id, $item['loop_featured_image_thumbnail_size'], array( 'class' => 'hover__img' ) );

					$content_image = $loop_featured_image_src;
				}

				if ( ! empty( $item['loop_featured_iframe'] ) && 'iframe' === $loop_content_options ) {
					$content_image = $item['loop_featured_iframe'];
				}

				if ( ! empty( $item['loop_content_template'] ) && 'template' === $loop_content_options ) {
					$content_image = Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['loop_content_template'] );
				}

				/** Loop Content Description*/
				if ( ! empty( $item['loop_content_desc'] ) ) {
					$content_desc = '<div class="timeline-item-description timeline-transition">' . wp_kses_post( $item['loop_content_desc'] ) . '</div>';
				}

				/** Section Content Alignment*/
				if ( ! empty( $item['loop_alignment_section'] ) ) {
					$section_alignment = $item['loop_alignment_section'];
				}

				/** Section Text Alignment*/
				if ( ! empty( $item['loop_content_alignment'] ) ) {
					$align_text = $item['loop_content_alignment'];
				}

				/** Content Button*/
				$button = '';
				if ( ! empty( $settings['display_button'] ) && 'yes' === $settings['display_button'] ) {
					if ( ! empty( $item['loop_display_button'] ) && 'yes' === $item['loop_display_button'] ) {
						$link_key = 'link_' . $ij;
						if ( ! empty( $item['loop_link']['url'] ) ) {
							$this->add_render_attribute( $link_key, 'href', esc_url( $item['loop_link']['url'] ) );
							if ( $item['loop_link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}
							if ( $item['loop_link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}
						}

						$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['button_background_image'], $settings['button_hover_background_image'] ) : '';
						$this->add_render_attribute( $link_key, 'class', 'button-link-wrap ' . $lz1 );
						$this->add_render_attribute( $link_key, 'role', 'button' );

						$button_style = 'style-8';

						$button_text = ! empty( $item['loop_button_text'] ) ? $item['loop_button_text'] : $settings['button_text'];

						$btn_uid = uniqid( 'btn' );

						$btn_class  = $btn_uid;
						$btn_class .= ' button-' . $button_style . ' ';

						$button .= '<div class="pt_plus_button ' . $btn_class . '">';

							$button .= '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
							$button .= wp_kses_post( $button_text );
							$button .= '</a>';

						$button .= '</div>';
					}
				}

				/** Loop Animation*/
				$loop_animation_effects = $item['loop_animation_effects'];
				$loop_animation_delay   = isset( $item['loop_animation_delay']['size'] ) ? $item['loop_animation_delay']['size'] : '';
				if ( 'no-animation' === $loop_animation_effects ) {
					$loop_animated_class = '';
					$loop_animation_attr = '';
				} else {
					$animate_offset       = theplus_scroll_animation();
					$loop_animated_class  = 'animate-general';
					$loop_animation_attr  = ' data-animate-type="' . esc_attr( $loop_animation_effects ) . '" data-animate-delay="' . esc_attr( $loop_animation_delay ) . '"';
					$loop_animation_attr .= ' data-animate-offset="' . esc_attr( $animate_offset ) . '"';
				}

				/** Timeline Style 1*/
				if ( 'style-1' === $style ) {
					$style_border = '<div class="timeline-tl-before timeline-transition"></div>';
				}

				/** Timeline Style 2*/
				if ( 'style-2' === $style ) {
					$style_border        = '<div class="timeline-tl-before timeline-transition"></div>';
					$title_border_bottom = '<div class="border-bottom ' . esc_attr( $align_text ) . '"><hr/></div>';
				}

				/** Loop Content*/
				$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['loop_content_background_image'], $settings['loop_content_hover_background_image'] ) : '';

				$timeline_loop .= '<div class="grid-item timeline-item-wrap elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' timeline-' . esc_attr( $section_alignment ) . '-content  text-pin-' . esc_attr( $pin_title_position ) . '"  >
						<div class="timeline-inner-block timeline-transition">
							<div class="timeline-item ' . esc_attr( $align_text ) . ' ' . esc_attr( $loop_animated_class ) . '" ' . $loop_animation_attr . '>
								<div class="timeline-item-content timeline-transition ' . esc_attr( $align_text ) . ' ' . esc_attr( $lz2 ) . '">';

				$timeline_loop .= $style_border;
				if ( ! empty( $item['loop_content_template'] ) && 'template' === $loop_content_options ) {
					$timeline_loop .= $content_image;
				} else {
					$timeline_loop .= $content_title;
					$timeline_loop .= $title_border_bottom;
					$timeline_loop .= '<div class="timeline-content-image">' . $content_image . '</div>';
					$timeline_loop .= $content_desc;
					$timeline_loop .= $button;
				}

				$timeline_loop .= '</div></div><div class="point-icon ' . esc_attr( $settings['pin_center_style'] ) . '"> <div class="timeline-tooltip-wrap"><div class="timeline-point-icon"> ' . $timeline_pin_icon . '</div></div> ' . $pin_title . ' </div> </div> </div>';
				++$ij;
			}
		}

		/** Start Pin Content*/
		$timeline_start = '';

		$start_pin_select_icon = ! empty( $settings['start_pin_select_icon'] ) ? $settings['start_pin_select_icon'] : 'icon';
		$start_pin_icon_style  = ! empty( $settings['start_pin_icon_style'] ) ? $settings['start_pin_icon_style'] : 'font_awesome';
		if ( ! empty( $start_pin_select_icon ) ) {
			if ( 'image' === $start_pin_select_icon ) {
				$loop_img_src = '';
				if ( ! empty( $settings['start_pin_image']['url'] ) ) {
					$image_id     = $settings['start_pin_image']['id'];
					$loop_img_src = tp_get_image_rander( $image_id, $settings['start_pin_image_thumbnail_size'], array( 'class' => '' ) );
				}

				$timeline_start = '<div class="timeline-beginning-icon">' . $loop_img_src . '</div>';
			} elseif ( 'icon' === $start_pin_select_icon ) {
				$icons = '';
				if ( 'font_awesome' === $start_pin_icon_style ) {
					$icons = $settings['start_pin_icon_fontawesome'];
				} elseif ( 'font_awesome_5' === $start_pin_icon_style ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['start_pin_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
					ob_end_clean();
				} elseif ( 'icon_mind' === $start_pin_icon_style ) {
					$icons = $settings['start_pin_icons_mind'];
				}

				if ( 'font_awesome_5' === $start_pin_icon_style && ! empty( $settings['start_pin_icon_fontawesome_5'] ) ) {
					$timeline_start = '<div class="timeline-beginning-icon"><span>' . $icons . '</span></div>';
				} else {
					$timeline_start = '<div class="timeline-beginning-icon"><i class=" ' . esc_attr( $icons ) . '" ></i></div>';
				}
			} elseif ( 'text' === $start_pin_select_icon ) {
				$text_start = $settings['start_pin_title'];
				$lz3        = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['pin_start_text_background_image'] ) : '';

				$timeline_start = '<div class="timeline-text timeline-text-start ' . esc_attr( $lz3 ) . '"><div class="beginning-text">' . esc_html( $text_start ) . '</div></div>';
			}
		}

		$start_pin_none = '';
		if ( empty( $timeline_start ) ) {
			$start_pin_none = 'start-pin-none';
		}

		$timeline_end = '';

		$end_pin_select_icon = ! empty( $settings['end_pin_select_icon'] ) ? $settings['end_pin_select_icon'] : 'icon';
		$end_pin_icon_style  = ! empty( $settings['end_pin_icon_style'] ) ? $settings['end_pin_icon_style'] : 'font_awesome';
		if ( ! empty( $end_pin_select_icon ) ) {
			if ( 'image' === $end_pin_select_icon ) {
				$loop_img_src = '';
				if ( ! empty( $settings['end_pin_image']['url'] ) ) {
					$image_id     = $settings['end_pin_image']['id'];
					$loop_img_src = tp_get_image_rander( $image_id, $settings['end_pin_image_thumbnail_size'] );
				}

				$timeline_end = '<div class="timeline-end-icon">' . $loop_img_src . '</div>';
			} elseif ( 'icon' === $end_pin_select_icon ) {
				$icons = '';
				if ( 'font_awesome' === $end_pin_icon_style ) {
					$icons = $settings['end_pin_icon_fontawesome'];
				} elseif ( 'font_awesome_5' === $end_pin_icon_style ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $settings['end_pin_icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
					$icons = ob_get_contents();
					ob_end_clean();
				} elseif ( 'icon_mind' === $end_pin_icon_style ) {
					$icons = $settings['end_pin_icons_mind'];
				}

				if ( 'font_awesome_5' === $end_pin_icon_style && ! empty( $settings['end_pin_icon_fontawesome_5'] ) ) {
					$timeline_end = '<div class="timeline-end-icon"><span>' . $icons . '</span></div>';
				} else {
					$timeline_end = '<div class="timeline-end-icon"><i class=" ' . esc_attr( $icons ) . '" ></i></div>';
				}
			} elseif ( 'text' === $end_pin_select_icon ) {
				$text_end = $settings['end_pin_title'];
				$lz4      = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['pin_end_text_background_image'] ) : '';

				$timeline_end = '<div class="timeline-text timeline-text-end ' . esc_attr( $lz4 ) . '"><div class="end-text">' . esc_html( $text_end ) . '</div></div>';
			}
		}

		$end_pin_none = '';
		if ( empty( $timeline_end ) ) {
			$end_pin_none = 'end-pin-none';
		}

		$timeline_layout = $settings['timeline_content_align'] ? 'timeline-' . esc_attr( $settings['timeline_content_align'] ) . '-align' : 'timeline-center-align';

		$timeline = '<div id="pt_plus_timeline" class="pt-plus-timeline-list ' . esc_attr( $timeline_masonry_class ) . ' layout-both ' . esc_attr( $start_pin_none ) . ' ' . esc_attr( $end_pin_none ) . ' ' . esc_attr( $timeline_layout ) . ' ' . $data_class . '" data-id="' . esc_attr( $uid ) . '" ' . $timeline_inline_masonry . '>';

			$timeline .= '<div class="post-inner-loop ' . esc_attr( $arrow_style ) . '">';

				$timeline .= '<div class="timeline-track ' . esc_attr( $start_pin_none ) . ' ' . esc_attr( $end_pin_none ) . '"></div>';
				$timeline .= '<div class="timeline-track timeline-track-draw ' . esc_attr( $start_pin_none ) . ' ' . esc_attr( $end_pin_none ) . '"></div>';
				$timeline .= '<div class="timeline--icon">' . $timeline_start . '</div>';
				$timeline .= $timeline_loop;
				$timeline .= '<div class="timeline--icon">' . $timeline_end . '</div>';

			$timeline .= '</div>';

		$timeline .= '</div>';

		$css_rule = '';
		if ( 'style-1' === $style ) {
			$css_rule .= '<style>';
			if ( ! empty( $settings['content_gap_between']['size'] ) ) {
				$gap = $settings['content_gap_between']['size'] . $settings['content_gap_between']['unit'];

				$css_rule .= '@media (min-width:731px){';

					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1 .timeline-item-wrap .timeline-item .timeline-tl-before{width:' . $gap . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-left-content{padding-right:' . esc_attr( $gap ) . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-right-content{padding-left:' . esc_attr( $gap ) . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-left-align .timeline-item-wrap{padding-right:' . esc_attr( $gap ) . ' !important;}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-left-content,.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-right-content{padding-left:' . esc_attr( $gap ) . ' !important;}';

				$css_rule .= '}';
			}

			if ( ! empty( $settings['content_gap_between_tablet']['size'] ) ) {
				$gap = $settings['content_gap_between_tablet']['size'] . $settings['content_gap_between_tablet']['unit'];

				$css_rule .= '@media (min-width:731px) and (max-width:1024px){';

					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1 .timeline-item-wrap .timeline-item .timeline-tl-before{width:' . $gap . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-left-content{padding-right:' . esc_attr( $gap ) . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-right-content{padding-left:' . esc_attr( $gap ) . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-left-align .timeline-item-wrap{padding-right:' . esc_attr( $gap ) . ' !important;}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-left-content,.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-right-content{padding-left:' . esc_attr( $gap ) . ' !important;}';

				$css_rule .= '}';
			}

			if ( ! empty( $settings['content_gap_between_mobile']['size'] ) ) {
				$gap = $settings['content_gap_between_mobile']['size'] . $settings['content_gap_between_mobile']['unit'];

				$css_rule .= '@media (max-width:730px){';

					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1 .timeline-item-wrap .timeline-item .timeline-tl-before{width:' . esc_attr( $gap ) . '}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-item-wrap.timeline-left-content{padding-left:' . esc_attr( $gap ) . ' !important;}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-center-align .timeline-item-wrap.timeline-right-content{padding-left:' . esc_attr( $gap ) . ' !important;}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-left-align .timeline-item-wrap{padding-right:' . esc_attr( $gap ) . ' !important;}';
					$css_rule .= '.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-left-content,.' . esc_attr( $uid ) . '.timeline-style-1.timeline-right-align .timeline-item-wrap.timeline-right-content{padding-left:' . $gap . ' !important;}';

				$css_rule .= '}';

			}

			$css_rule .= '</style>';
		}

		echo $timeline . $css_rule;
	}

	/**
	 * Render content_template
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}