<?php
/**
 * Widget Name: Tabs And Tours
 * Description: Toggle of a tabs and tours content.
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
 * Class ThePlus_Tabs_Tours.
 */
class ThePlus_Tabs_Tours extends Widget_Base {

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
		return 'tp-tabs-tours';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Tabs/Tours', 'theplus' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-th-list theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
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
		return array( 'Tabs', 'Tours', 'Tabs widget', 'Tours widget', 'Elementor Tabs', 'Elementor Tours', 'Elementor Tabs widget', 'Elementor Tours widget', 'Tabs addon', 'Tours addon', 'Elementor Tabs addon', 'Elementor Tours addon' );
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

		/** Content Section Start*/
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'how_it_works',
			array(
				'label' => wp_kses_post( "<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "tabs-tours-elementor-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn How it works  <i class='eicon-help-o'></i> </a>" ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => esc_html__( 'Title', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'theplus' ),
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'content_source',
			array(
				'label'   => esc_html__( 'Content Source', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => array(
					'content'       => esc_html__( 'Content', 'theplus' ),
					'page_template' => esc_html__( 'Page Template', 'theplus' ),
				),
			)
		);
		$repeater->add_control(
			'tab_content',
			array(
				'label'      => esc_html__( 'Content', 'theplus' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => esc_html__( 'Content', 'theplus' ),
				'show_label' => false,
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'content_source' => array( 'content' ),
				),
			)
		);
		$repeater->add_control(
			'content_template_type',
			array(
				'label'     => wp_kses_post( "Templates<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-template-inside-tabs-widget/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dropdown',
				'options'   => array(
					'dropdown' => esc_html__( 'Template', 'theplus' ),
					'manually' => esc_html__( 'Shortcode', 'theplus' ),
				),
				'condition' => array(
					'content_source' => array( 'page_template' ),
				),
			)
		);
		$repeater->add_control(
			'content_template',
			array(
				'label'       => esc_html__( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => array(
					'content_source'        => 'page_template',
					'content_template_type' => 'dropdown',
				),
			)
		);
		$repeater->add_control(
			'content_template_id',
			array(
				'label'       => esc_html__( 'Elementor Templates Shortcode', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => '',
				'placeholder' => '[elementor-template id="70"]',
				'condition'   => array(
					'content_source'        => 'page_template',
					'content_template_type' => 'manually',
				),
			)
		);
		$repeater->add_control(
			'backend_preview_template',
			array(
				'label'       => esc_html__( 'Backend Visibility', 'theplus' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'label_on'    => esc_html__( 'Show', 'theplus' ),
				'label_off'   => esc_html__( 'Hide', 'theplus' ),
				'description' => esc_html__( 'Note : If disabled, Template will not visible/load in the backend for better page loading performance.', 'theplus' ),
				'separator'   => 'after',
				'condition'   => array(
					'content_source' => 'page_template',
				),
			)
		);
		$repeater->add_control(
			'tab_title_description',
			array(
				'label'       => esc_html__( 'Description', 'theplus' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => '',
				'separator'   => 'before',
				'placeholder' => esc_html__( 'Type your Description', 'theplus' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'tab_title_hint',
			array(
				'label'       => esc_html__( 'Hint', 'theplus' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Type your Hint', 'theplus' ),
				'separator'   => 'before',
				'dynamic'     => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'display_icon',
			array(
				'label'     => wp_kses_post( "Show Inner Icon<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-icons-to-elementor-tabs/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'icon_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
					'icon_mind'      => esc_html__( 'Icons Mind', 'theplus' ),
					'image'          => esc_html__( 'Image', 'theplus' ),
				),
				'condition' => array(
					'display_icon' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-plus',
				'separator' => 'before',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'separator' => 'before',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'font_awesome_5',
				),
			)
		);
		$repeater->add_control(
			'icons_mind',
			array(
				'label'       => esc_html__( 'Icon Library', 'theplus' ),
				'type'        => Controls_Manager::SELECT2,
				'default'     => 'iconsmind-Add',
				'label_block' => true,
				'options'     => theplus_icons_mind(),
				'condition'   => array(
					'display_icon' => 'yes',
					'icon_style'   => 'icon_mind',
				),
			)
		);
		$repeater->add_control(
			'icon_image',
			array(
				'label'     => esc_html__( 'Icon Image', 'theplus' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => '',
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icon_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'display_icon' => 'yes',
					'icon_style'   => 'image',
				),
			)
		);
		$repeater->add_control(
			'display_icon1',
			array(
				'label'     => wp_kses_post( "Show Outer Icon<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-icons-to-elementor-tabs/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'separator' => 'before',
			)
		);
		$repeater->add_control(
			'icon_fontawesome_type',
			array(
				'label'     => esc_html__( 'Icon Font', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome'   => esc_html__( 'Font Awesome', 'theplus' ),
					'font_awesome_5' => esc_html__( 'Font Awesome 5', 'theplus' ),
				),
				'condition' => array(
					'display_icon1' => 'yes',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome1',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-plus',
				'separator' => 'before',
				'condition' => array(
					'display_icon1'         => 'yes',
					'icon_fontawesome_type' => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome1_5',
			array(
				'label'     => esc_html__( 'Icon Library', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				),
				'condition' => array(
					'display_icon1'         => 'yes',
					'icon_fontawesome_type' => 'font_awesome_5',
				),
			)
		);
		$repeater->add_control(
			'tab_hashid',
			array(
				'label'       => wp_kses_post( "Unique ID<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "anchor-link-a-tab-item-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'dynamic'     => array(
					'active' => true,
				),
				'title'       => __( 'Add custom ID WITHOUT the Pound key. e.g: tab-id', 'theplus' ),
				'description' => 'Note : Use this option to give anchor id to individual tabs.',
				'label_block' => false,
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'tabs',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'tab_title'   => esc_html__( 'Tab #1', 'theplus' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					),
					array(
						'tab_title'   => esc_html__( 'Tab #2', 'theplus' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					),
				),
				'title_field' => '{{{ tab_title }}}',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'layout_content_section',
			array(
				'label' => esc_html__( 'Layout', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'tabs_type',
			array(
				'label'        => wp_kses_post( ' Layout ' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'horizontal',
				'options'      => array(
					'horizontal' => esc_html__( 'Horizontal', 'theplus' ),
					'vertical'   => esc_html__( 'Vertical', 'theplus' ),
				),
				'prefix_class' => 'elementor-tabs-view-',

			)
		);
		$this->add_control(
			'tabs_align_horizontal',
			array(
				'label'       => esc_html__( 'Navigation Position', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'     => 'top',
				'label_block' => false,
				'condition'   => array(
					'tabs_type' => array( 'horizontal' ),
				),
			)
		);
		$this->add_control(
			'tabs_align_vertical',
			array(
				'label'       => wp_kses_post( "Navigation Position <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "vertical-tabs-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
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
				'label_block' => false,
				'condition'   => array(
					'tabs_type' => array( 'vertical' ),
				),
			)
		);
		$this->add_control(
			'tabs_swiper',
			array(
				'label'     => wp_kses_post( "Swiper Effect<a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "swipe-or-slide-effect-on-elementor-tabs/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'separator' => 'before',
				'condition' => array(
					'tabs_type' => array( 'horizontal' ),
				),
			)
		);
		$this->add_control(
			'tabs_mode',
			array(
				'label'     => esc_html__( 'Mode', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'swipe',
				'options'   => array(
					'swipe' => esc_html__( 'Swipe', 'theplus' ),
					'slide' => esc_html__( 'Slide', 'theplus' ),
				),
				'condition' => array(
					'tabs_type'   => 'horizontal',
					'tabs_swiper' => 'yes',
				),
			)
		);
		$this->add_control(
			'swiper_loop',
			array(
				'label'     => esc_html__( 'Loop', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'tabs_type'   => 'horizontal',
					'tabs_swiper' => 'yes',
				),
			)
		);
		$this->add_control(
			'swiper_loop_note',
			array(
				'type'            => \Elementor\Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Note : It\'s not work with Carousel.', 'theplus' ),
				'content_classes' => 'tp-widget-description',
				'condition'       => array(
					'tabs_type'   => 'horizontal',
					'tabs_swiper' => 'yes',
					'tabs_mode'   => 'slide',
					'swiper_loop' => 'yes',
				),
			)
		);
		$this->add_control(
			'swiper_centermode',
			array(
				'label'     => esc_html__( 'Center Mode', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'tabs_type'   => 'horizontal',
					'tabs_swiper' => 'yes',
					'tabs_mode'   => 'slide',
				),
			)
		);
		$this->add_control(
			'default_active_tab',
			array(
				'label'     => wp_kses_post( "Default Active Tab <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "openclose-specific-tab-by-default-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),

				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => theplus_get_numbers( 'tabs' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'on_hover_tabs',
			array(
				'label'     => wp_kses_post( "On Hover Tab <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-tab-on-hover/' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'second_click_close',
			array(
				'label'     => esc_html__( 'On Second Click Closed', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'on_tabs_arrow',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'on_tabs_arrow_type',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Type', 'theplus' ),
				'default'   => 'out',
				'options'   => array(
					'in'  => esc_html__( 'In', 'theplus' ),
					'out' => esc_html__( 'Out', 'theplus' ),
				),
				'condition' => array(
					'on_tabs_arrow' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'layout_extra_options_section',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'connection_unique_id',
			array(
				'label'       => wp_kses_post( "Carousel Connection ID <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "multiple-columned-elementor-carousel-slider/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => 'Note : This option is to connect Tabs with Anything Carousel widget. Use same id both places for deep connection.',
			)
		);
		$this->add_control(
			'tabs_columns',
			array(
				'label'     => wp_kses_post( "Tab Columns <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "divide-elementor-tabs-into-multiple-columns/' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'tabs_columns_no',
			array(
				'label'     => esc_html__( 'Column', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'1' => esc_html__( '1', 'theplus' ),
					'2' => esc_html__( '2', 'theplus' ),
					'3' => esc_html__( '3', 'theplus' ),
					'4' => esc_html__( '4', 'theplus' ),
					'5' => esc_html__( '5', 'theplus' ),
					'6' => esc_html__( '6', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav li' => 'display: inline-flex;width: calc(100% * 1 / {{VALUE}});',
				),
				'condition' => array(
					'tabs_columns' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tabs_columns_padding',
			array(
				'label'      => esc_html__( 'Column Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_columns' => 'yes',
				),
			)
		);

		$this->add_control(
			'tabs_autoplay',
			array(
				'label'     => wp_kses_post( "Tab Autoplay <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "elementor-tabs-autoplay/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tabs_autoplaypause',
			array(
				'label'     => esc_html__( 'Play/Pause Button', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tabs_autoplay' => 'yes',
				),
			)
		);
		$this->add_control(
			'autoplayicon',
			array(
				'label'     => esc_html__( 'Play Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-play',
					'library' => 'solid',
				),
				'condition' => array(
					'tabs_autoplay'      => 'yes',
					'tabs_autoplaypause' => 'yes',
				),
			)
		);
		$this->add_control(
			'autopauseicon',
			array(
				'label'     => esc_html__( 'Pause Icon', 'theplus' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-pause',
					'library' => 'solid',
				),
				'condition' => array(
					'tabs_autoplay'      => 'yes',
					'tabs_autoplaypause' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tabs_autoplay_duration',
			array(
				'label'     => esc_html__( 'Duration', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 5,
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-playloop .plus-tab-header.active:after' => 'transition: transform {{VALUE}}000ms ease-in;',
				),
				'condition' => array(
					'tabs_autoplay' => 'yes',
				),
			)
		);
		$this->add_control(
			'tabs_autoplay_border_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'condition' => array(
					'tabs_autoplay' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tabs_autoplay_border_size',
			array(
				'label'     => esc_html__( 'Border Size', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 10,
				'step'      => 1,
				'default'   => 3,
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-playloop .plus-tab-header:after' => 'border-bottom: solid {{VALUE}}px {{tabs_autoplay_border_color.VALUE}};',
				),
				'condition' => array(
					'tabs_autoplay' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_icon',
			array(
				'label' => esc_html__( 'Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
						'min'  => 6,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-image,
					{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .tab-icon-wrap .tab-icon-image' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active .tab-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active .tab-icon-wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_space',
			array(
				'label'     => esc_html__( 'Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav:not(.full-width-icon) .plus-tab-header .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav:not(.full-width-icon) .plus-tab-header .tab-icon-wrap svg,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title .tab-icon-wrap svg' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav.full-width-icon .plus-tab-header .tab-icon-wrap,
					{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav.full-width-icon .plus-tab-header .tab-icon-wrap svg' => 'padding-right: 0;padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'full_icon',
			array(
				'label'     => esc_html__( 'Full Width Icon', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_icon_outer',
			array(
				'label' => esc_html__( 'Outer Icon', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'icon_o_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Icon Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 6,
						'max'  => 200,
						'step' => 1,
					),
				),
				'default'     => array(
					'unit' => 'px',
					'size' => 15,
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .theplus-tabs-nav-wrapper .plus-tabs-nav .tab-sep-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-nav-wrapper .plus-tabs-nav .tab-sep-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'icon_o_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-nav-wrapper .plus-tabs-nav .tab-sep-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-nav-wrapper .plus-tabs-nav .tab-sep-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'icon_o_ah_color',
			array(
				'label'     => esc_html__( 'Active/Hover Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .elementor-tab-title:hover + .tab-sep-icon,
					{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .elementor-tab-title.active + .tab-sep-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .elementor-tab-title:hover + .tab-sep-icon svg,
					{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .elementor-tab-title.active + .tab-sep-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'res_outer_icon',
			array(
				'label'     => esc_html__( 'Hide on Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Tab Title Bar', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_vertical_width',
			array(
				'label'      => esc_html__( 'Navigation Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 600,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 25,
				),
				'selectors'  => array(
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-nav-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_type' => 'vertical',
				),
			)
		);
		$this->add_responsive_control(
			'nav_vertical_titlewidth',
			array(
				'label'      => esc_html__( 'Navigation Title Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 2,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tabs_type' => 'vertical',
				),
			)
		);
		$this->add_control(
			'nav_vertical_align',
			array(
				'label'       => esc_html__( 'Vertical Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'align-top'    => array(
						'title' => esc_html__( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					),
					'align-center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'align-bottom' => array(
						'title' => esc_html__( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'     => 'align-top',
				'label_block' => false,
				'separator'   => 'after',
				'condition'   => array(
					'tabs_type' => 'vertical',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
			)
		);
		$this->add_control(
			'nav_align',
			array(
				'label'       => esc_html__( 'Nav Alignment', 'theplus' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'text-left'   => array(
						'title' => esc_html__( 'Left', 'theplus' ),
						'icon'  => 'eicon-text-align-left',
					),
					'text-center' => array(
						'title' => esc_html__( 'Center', 'theplus' ),
						'icon'  => 'eicon-text-align-center',
					),
					'text-right'  => array(
						'title' => esc_html__( 'Right', 'theplus' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'     => 'text-left',
				'label_block' => false,
			)
		);
		$this->add_control(
			'nav_full_width',
			array(
				'label'     => esc_html__( 'Nav Full-Width', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_control(
			'nav_title_display',
			array(
				'label'     => esc_html__( 'Title On/Off', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'theplus' ),
				'label_off' => esc_html__( 'Off', 'theplus' ),
				'default'   => 'yes',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'nav_same_width',
			array(
				'label'     => esc_html__( 'Nav Equal Width', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'theplus' ),
				'label_off' => esc_html__( 'No', 'theplus' ),
				'default'   => 'no',
			)
		);
		$this->add_responsive_control(
			'nav_same_width_size',
			array(
				'label'      => esc_html__( 'Width Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
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
				'default'    => array(
					'unit' => '%',
					'size' => 80,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'max-width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-tp-tabs-tours ul.plus-tabs-nav li,{{WRAPPER}} .theplus-tabs-wrapper ul.plus-tabs-nav' => 'display: inline-block;',
				),
				'condition'  => array(
					'nav_same_width' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_color_options',
			array(
				'label'     => esc_html__( 'Title Color Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
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
			'tab_title_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'title_active_color_option',
			array(
				'label'       => esc_html__( 'Title Active Color', 'theplus' ),
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
				'default'     => 'solid',
				'label_block' => false,
			)
		);
		$this->add_control(
			'title_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3351a6',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'title_active_color_option' => 'solid',
				),
			)
		);
		$this->add_control(
			'title_active_gradient_color1',
			array(
				'label'     => esc_html__( 'Color 1', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'orange',
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color1_control',
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
					'title_active_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color2',
			array(
				'label'     => esc_html__( 'Color 2', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'cyan',
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_color2_control',
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
					'title_active_color_option' => 'gradient',
				),
				'of_type'     => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Gradient Style', 'theplus' ),
				'default'   => 'linear',
				'options'   => theplus_get_gradient_styles(),
				'condition' => array(
					'title_active_color_option' => 'gradient',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_angle',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
				),
				'condition'  => array(
					'title_active_color_option'   => 'gradient',
					'title_active_gradient_style' => array( 'linear' ),
				),
				'of_type'    => 'gradient',
			)
		);
		$this->add_control(
			'title_active_gradient_position',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Position', 'theplus' ),
				'options'   => theplus_get_position_options(),
				'default'   => 'center center',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active span:not(.tab-icon-wrap),{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active span:not(.tab-icon-wrap)' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_active_gradient_color1.VALUE}} {{title_active_gradient_color1_control.SIZE}}{{title_active_gradient_color1_control.UNIT}}, {{title_active_gradient_color2.VALUE}} {{title_active_gradient_color2_control.SIZE}}{{title_active_gradient_color2_control.UNIT}});-webkit-background-clip: text;-webkit-text-fill-color: transparent;',
				),
				'condition' => array(
					'title_active_color_option'   => 'gradient',
					'title_active_gradient_style' => 'radial',
				),
				'of_type'   => 'gradient',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_desc_style',
			array(
				'label' => esc_html__( 'Tab Description', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'title_desc_margin',
			array(
				'label'      => esc_html__( 'Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-tab-title-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'title_desc_max_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Max. Width', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-tab-title-description' => 'max-width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'title_desc_word_break',
			array(
				'label'     => esc_html__( 'Word Break', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'break-word',
				'options'   => array(
					'break-word' => esc_html__( 'Break Word', 'theplus' ),
					'break-all'  => esc_html__( 'Break All', 'theplus' ),
					'keep-all'   => esc_html__( 'Keep All', 'theplus' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-title-description' => 'word-break: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_desc_typography',
				'selector' => '{{WRAPPER}} .tp-tab-title-description',
			)
		);
		$this->add_control(
			'title_desc_color_n',
			array(
				'label'     => esc_html__( 'Normal Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-title-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'title_desc_color_a',
			array(
				'label'     => esc_html__( 'Active Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-description,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_hint_style',
			array(
				'label' => esc_html__( 'Tab Hint', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'title_hint_padding',
			array(
				'label'      => esc_html__( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'title_hint_position',
			array(
				'label'   => esc_html__( 'Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tp_hint_pos_right',
				'options' => array(
					'tp_hint_pos_left'  => esc_html__( 'Left', 'theplus' ),
					'tp_hint_pos_right' => esc_html__( 'Right', 'theplus' ),
				),
			)
		);
		$this->add_responsive_control(
			'title_hint_position_top',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Top', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'top: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'title_hint_position_left',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Left', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_hint_position' => 'tp_hint_pos_left',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'right:auto;left:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'title_hint_position_right',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Right', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -250,
						'max'  => 250,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'condition'   => array(
					'title_hint_position' => 'tp_hint_pos_right',
				),
				'selectors'   => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'left:auto;right:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'title_hint_arrow_offset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Arrow Offset', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-tab-title-hint:after' => 'bottom:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_hint_typography',
				'selector' => '{{WRAPPER}} .tp-tab-title-hint',
			)
		);
		$this->start_controls_tabs( 'tabs_title_hint' );
		$this->start_controls_tab(
			'tab_title_hint_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'title_hint_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'title_hint_arrow_color',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-tab-title-hint:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'title_hint_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-tab-title-hint',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'title_hint_border',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .tp-tab-title-hint',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'title_hint_br',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-tab-title-hint' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_hint_shadow',
				'selector' => '{{WRAPPER}} .tp-tab-title-hint',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hint_a',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_control(
			'title_hint_arrow_color_a',
			array(
				'label'     => esc_html__( 'Arrow', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint:after,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_control(
			'title_hint_color_a',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'title_hint_background_a',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'title_hint_border_a',
				'label'     => esc_html__( 'Border', 'theplus' ),
				'selector'  => '{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint',
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'title_hint_br_a',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_hint_shadow_a',
				'selector' => '{{WRAPPER}} .plus-tab-header:hover .tp-tab-title-hint,{{WRAPPER}} .plus-tab-header.active .tp-tab-title-hint',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_underline',
			array(
				'label' => esc_html__( 'Under Line', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'tab_title_underline_display',
			array(
				'label'     => esc_html__( 'Underline', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'default'   => 'no',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'underline_color',
			array(
				'label'     => esc_html__( 'Underline Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav.nav-tab-underline .plus-tab-header.active:before' => 'background: linear-gradient(to right,#fff0 0%,{{VALUE}}  50%,#fff0 100%)',
				),
				'condition' => array(
					'tab_title_underline_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'underline_top_margin',
			array(
				'label'      => esc_html__( 'Top Margin', 'theplus' ),
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
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav.nav-tab-underline .plus-tab-header.active:before,{{WRAPPER}} ul.plus-tabs-nav.nav-tab-underline:before' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_title_underline_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'underline_width',
			array(
				'label'      => esc_html__( 'Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 200,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav.nav-tab-underline .plus-tab-header.active:before' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_title_underline_display' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'underline_height',
			array(
				'label'      => esc_html__( 'Height', 'theplus' ),
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
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav.nav-tab-underline .plus-tab-header.active:before,{{WRAPPER}} ul.plus-tabs-nav.nav-tab-underline:before' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_title_underline_display' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_bg_style',
			array(
				'label' => esc_html__( 'Tab Title Bar Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_inner_margin',
			array(
				'label'      => esc_html__( 'Nav Inner Margin', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .theplus-tabs-wrapper.elementor-tabs.nav-one-by-one ul.plus-tabs-nav li .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'nav_inner_padding',
			array(
				'label'      => esc_html__( 'Nav Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'separator'  => 'after',
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'nav_title_space',
			array(
				'label'      => esc_html__( 'Space Between Navigation', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-left:0;',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-right:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-top:0;',
					'{{WRAPPER}}.elementor-tabs-view-vertical .theplus-tabs-wrapper .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-bottom:0;',

				),
				'separator'  => 'before',
			)
		);
		$this->add_control(
			'nav_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'nav_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'nav_box_border_style' );
		$this->start_controls_tab(
			'nav_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'nav_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_border_active',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_border_active_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_border_active_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'nav_background_style' );
		$this->start_controls_tab(
			'nav_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_background_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_box_active_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'nav_shadow_style' );
		$this->start_controls_tab(
			'nav_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_shadow_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_box_active_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header:hover,{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header.active',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_box_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'nav_box_bf_blur',
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
					'nav_box_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_box_bf_grayscale',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav .plus-tab-header' => '-webkit-backdrop-filter:grayscale({{nav_box_bf_grayscale.SIZE}})  blur({{nav_box_bf_blur.SIZE}}{{nav_box_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{nav_box_bf_grayscale.SIZE}})  blur({{nav_box_bf_blur.SIZE}}{{nav_box_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'nav_box_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->add_control(
			'nav_bg_box_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Hidden', 'theplus' ),
				'label_off' => esc_html__( 'Visible', 'theplus' ),
				'default'   => 'no',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .plus-tabs-nav li .plus-tab-header' => 'overflow: hidden',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrow_style',
			array(
				'label'     => esc_html__( 'Arrow Style', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'on_tabs_arrow' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'     => esc_html__( 'Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 1,
						'max'  => 15,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .plus-tabs-nav .plus-tab-header.active:after' => 'border-width: {{SIZE}}px;',
				),
			)
		);
		$this->add_control(
			'arrow_color',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0000005c',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .plus-tabs-nav .plus-tab-header.active:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_v_right',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => -20,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-vertical.tpc-right .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-vertical.tpc-right .plus-tabs-nav .plus-tab-header.active:after' => 'left : {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'           => 'vertical',
					'tabs_align_vertical' => 'right',
					'on_tabs_arrow_type'  => 'out',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_v_left',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => -20,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-vertical .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-vertical .plus-tabs-nav .plus-tab-header.active:after' => 'right: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'           => 'vertical',
					'tabs_align_vertical' => 'left',
					'on_tabs_arrow_type'  => 'out',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_h_top',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => -20,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-horizontal .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-horizontal .plus-tabs-nav .plus-tab-header.active:after' => 'bottom: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'             => 'horizontal',
					'tabs_align_horizontal' => 'top',
					'on_tabs_arrow_type'    => 'out',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_h_bottom',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => -20,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-horizontal.tpc-bottom .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-show .tpc-horizontal.tpc-bottom .plus-tabs-nav .plus-tab-header.active:after' => 'top: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'             => 'horizontal',
					'tabs_align_horizontal' => 'bottom',
					'on_tabs_arrow_type'    => 'out',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_v_right_in',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-vertical.tpc-right .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-vertical.tpc-right .plus-tabs-nav .plus-tab-header.active:after' => 'left : {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'           => 'vertical',
					'tabs_align_vertical' => 'right',
					'on_tabs_arrow_type'  => 'in',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_v_left_in',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-vertical .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-vertical .plus-tabs-nav .plus-tab-header.active:after' => 'right: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'           => 'vertical',
					'tabs_align_vertical' => 'left',
					'on_tabs_arrow_type'  => 'in',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_h_to_in',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-horizontal .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-horizontal .plus-tabs-nav .plus-tab-header.active:after' => 'bottom: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'             => 'horizontal',
					'tabs_align_horizontal' => 'top',
					'on_tabs_arrow_type'    => 'in',
				),
			)
		);
		$this->add_responsive_control(
			'arrow_offset_h_bottom_in',
			array(
				'label'     => esc_html__( 'Offset', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -50,
						'max'  => 50,
						'step' => 1,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-horizontal.tpc-bottom .plus-tabs-nav .plus-tab-header:hover:after,{{WRAPPER}} .theplus-tabs-wrapper.tp-tab-arrow-in .tpc-horizontal.tpc-bottom .plus-tabs-nav .plus-tab-header.active:after' => 'top: {{SIZE}}px;',
				),
				'condition' => array(
					'tabs_type'             => 'horizontal',
					'tabs_align_horizontal' => 'bottom',
					'on_tabs_arrow_type'    => 'in',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_nav_bg_styling',
			array(
				'label' => esc_html__( 'Navigation Area Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'nav_bg_margin',
			array(
				'label'      => esc_html__( 'Margin Space', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);
		$this->add_responsive_control(
			'nav_bg_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'nav_bg_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_box_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'nav_bg_border_tab' );
		$this->start_controls_tab(
			'nav_bg_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_border_hover',
			array(
				'label'     => esc_html__( 'Hover', 'theplus' ),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'nav_bg_border_hover_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'nav_bg_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'nav_bg_background_style' );
		$this->start_controls_tab(
			'nav_bg_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_bg_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper,{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'nav_bg_box_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_bg_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->start_controls_tabs( 'nav_bg_shadow_style' );
		$this->start_controls_tab(
			'nav_bg_shadow_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_bg_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_bg_shadow_hover',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'nav_bg_box_hover_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'nav_bg_box_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'nav_bg_box_bf_blur',
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
					'nav_bg_box_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'nav_bg_box_bf_grayscale',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-nav-wrapper .plus-tabs-nav' => '-webkit-backdrop-filter:grayscale({{nav_bg_box_bf_grayscale.SIZE}})  blur({{nav_bg_box_bf_blur.SIZE}}{{nav_bg_box_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{nav_bg_box_bf_grayscale.SIZE}})  blur({{nav_bg_box_bf_blur.SIZE}}{{nav_bg_box_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'nav_bg_box_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_swiper_slide_styling',
			array(
				'label'     => esc_html__( 'Swiper Slide', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'tabs_type'   => 'horizontal',
					'tabs_swiper' => 'yes',
					'tabs_mode'   => 'slide',
				),
			)
		);
		$this->add_control(
			'swiper_next_icon',
			array(
				'label'   => esc_html__( 'Next Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-long-arrow-alt-right',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'swiper_prev_icon',
			array(
				'label'   => esc_html__( 'Previous Icon', 'theplus' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-long-arrow-alt-left',
					'library' => 'solid',
				),
			)
		);
		$this->add_responsive_control(
			'swiper_icon_size',
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
					'{{WRAPPER}} .tp-swiper-button'     => 'font-size:{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tp-swiper-button svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'swiper_bg_size',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Background Size', 'theplus' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 300,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-swiper-button' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'swiper_icon_disable_opacity',
			array(
				'label'     => esc_html__( 'Navigation Disabled Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 0.3,
				),
				'selectors' => array(
					'{{WRAPPER}} .swiper-button-disabled' => 'opacity: {{SIZE}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_swiper_icon' );
		$this->start_controls_tab(
			'tab_swiper_icon_n',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_control(
			'swiper_icon_color_n',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-swiper-button'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-swiper-button svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'swiper_icon_background_n',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-swiper-button',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swiper_icon_border_n',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-swiper-button',
			)
		);
		$this->add_responsive_control(
			'swiper_icon_br_n',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swiper_icon_shadow_n',
				'selector' => '{{WRAPPER}} .tp-swiper-button',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_swiper_icon_h',
			array(
				'label' => esc_html__( 'Hover', 'theplus' ),
			)
		);
		$this->add_control(
			'swiper_icon_color_h',
			array(
				'label'     => esc_html__( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tp-swiper-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-swiper-button:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'swiper_icon_background_h',
				'label'    => esc_html__( 'Background', 'theplus' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-swiper-button:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'swiper_icon_border_h',
				'label'    => esc_html__( 'Border', 'theplus' ),
				'selector' => '{{WRAPPER}} .tp-swiper-button:hover',
			)
		);
		$this->add_responsive_control(
			'swiper_icon_br_h',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-swiper-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'swiper_icon_shadow_h',
				'selector' => '{{WRAPPER}} .tp-swiper-button:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_styling',
			array(
				'label' => esc_html__( 'Content', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'     => esc_html__( 'Desc Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor,{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper .plus-tab-content .plus-content-editor > p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_bg_styling',
			array(
				'label' => esc_html__( 'Content Background', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'content_tab_margin',
			array(
				'label'      => esc_html__( 'Content Margin Space', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'content_tab_padding',
			array(
				'label'      => esc_html__( 'Content Inner Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper,{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion.mobile-accordion-tab .theplus-tabs-content-wrapper .plus-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'content_border_options',
			array(
				'label'     => esc_html__( 'Border Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'content_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
			)
		);

		$this->add_control(
			'content_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'content_box_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);

		$this->add_control(
			'content_box_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'content_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'content_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_background_options',
			array(
				'label'     => esc_html__( 'Background Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_box_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper',

			)
		);
		$this->add_control(
			'content_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper',
			)
		);
		$this->add_control(
			'content_box_bf',
			array(
				'label'        => esc_html__( 'Backdrop Filter', 'theplus' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'theplus' ),
				'label_on'     => __( 'Custom', 'theplus' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'content_box_bf_blur',
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
					'content_box_bf' => 'yes',
				),
			)
		);
		$this->add_control(
			'content_box_bf_grayscale',
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
					'{{WRAPPER}} .theplus-tabs-wrapper .theplus-tabs-content-wrapper' => '-webkit-backdrop-filter:grayscale({{content_box_bf_grayscale.SIZE}})  blur({{content_box_bf_blur.SIZE}}{{content_box_bf_blur.UNIT}}) !important;backdrop-filter:grayscale({{content_box_bf_grayscale.SIZE}})  blur({{content_box_bf_blur.SIZE}}{{content_box_bf_blur.UNIT}}) !important;',
				),
				'condition'  => array(
					'content_box_bf' => 'yes',
				),
			)
		);
		$this->end_popover();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_extra_options',
			array(
				'label' => esc_html__( 'Extra Options', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'nav_extra_effect_style' );
		$this->start_controls_tab(
			'nav_extra_effect_normal',
			array(
				'label' => esc_html__( 'Normal', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'nav_tab_opacity',
			array(
				'label'     => esc_html__( 'Navigation Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-tp-tabs-tours .plus-tab-header' => 'opacity: {{SIZE}};',
				),
			)
		);
		$this->add_responsive_control(
			'nav_tab_scale',
			array(
				'label'     => esc_html__( 'Navigation Scale/Zoom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -0.3,
						'max'  => 2,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-tp-tabs-tours .plus-tab-header' => '-webkit-transform:scale({{SIZE}});-moz-transform:scale({{SIZE}});-ms-transform:scale({{SIZE}});-o-transform:scale({{SIZE}});transform:scale({{SIZE}});',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'nav_extra_effect_active',
			array(
				'label' => esc_html__( 'Active', 'theplus' ),
			)
		);
		$this->add_responsive_control(
			'nav_tab_opacity_active',
			array(
				'label'     => esc_html__( 'Navigation Active Opacity', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-tp-tabs-tours .plus-tab-header.active' => 'opacity: {{SIZE}};',
				),
			)
		);
		$this->add_responsive_control(
			'nav_tab_scale_active',
			array(
				'label'     => esc_html__( 'Navigation Active Scale/Zoom', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'' => array(
						'min'  => -0.3,
						'max'  => 2,
						'step' => 0.01,
					),
				),
				'default'   => array(
					'unit' => '',
					'size' => 1,
				),
				'selectors' => array(
					'{{WRAPPER}}.elementor-widget-tp-tabs-tours .plus-tab-header.active' => '-webkit-transform:scale({{SIZE}});-moz-transform:scale({{SIZE}});-ms-transform:scale({{SIZE}});-o-transform:scale({{SIZE}});transform:scale({{SIZE}});',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'tab_nav_responsive',
			array(
				'label'       => esc_html__( 'Tab Navigation Responsive', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''              => esc_html__( 'None', 'theplus' ),
					'nav_full'      => esc_html__( 'Full Width (For Less tabs) ', 'theplus' ),
					'nav_one'       => esc_html__( 'One By One', 'theplus' ),
					'tab_accordion' => esc_html__( 'Force Accordion', 'theplus' ),
				),
				'separator'   => 'before',
				'description' => esc_html__( 'These options are for making your tabs look different in small devices. You can select none, If you want to keep your settings.', 'theplus' ),
			)
		);
		$this->add_control(
			'tab_accordion_options',
			array(
				'label'     => esc_html__( 'Accordion Navigation Options', 'theplus' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'tab_nav_responsive!' => array( '', 'nav_full' ),
				),
			)
		);
		$this->add_responsive_control(
			'nav_vertical_title_space',
			array(
				'label'      => esc_html__( 'Navigation Between Space', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 200,
						'step' => 2,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper.nav-one-by-one .plus-tabs-nav .plus-tab-header' => 'margin-top: {{SIZE}}{{UNIT}};margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper.nav-one-by-one .plus-tabs-nav li:first-child .plus-tab-header' => 'margin-top:0;',
					'{{WRAPPER}}.elementor-tabs-view-horizontal .theplus-tabs-wrapper.nav-one-by-one .plus-tabs-nav li:last-child .plus-tab-header' => 'margin-bottom:0;',

				),
				'condition'  => array(
					'tabs_type'          => 'horizontal',
					'tab_nav_responsive' => 'nav_one',
				),
			)
		);
		$this->add_control(
			'accordion_box_border',
			array(
				'label'     => esc_html__( 'Box Border', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'theplus' ),
				'label_off' => esc_html__( 'Hide', 'theplus' ),
				'default'   => 'no',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);

		$this->add_control(
			'accordion_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'theplus' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => theplus_get_border_style(),
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'accordion_border_width',
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
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->start_controls_tabs( 'accordion__box_border_style' );
		$this->start_controls_tab(
			'accordion_border_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'accordion_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'accordion_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_border_active',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->add_control(
			'accordion_border_active_color',
			array(
				'label'     => esc_html__( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#252525',
				'selectors' => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'accordion_border_active_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tab_nav_responsive'   => 'tab_accordion',
					'accordion_box_border' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'accordion_background_style' );
		$this->start_controls_tab(
			'accordion_background_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_box_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_background_active',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'accordion_box_active_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'accordion_shadow_options',
			array(
				'label'     => esc_html__( 'Box Shadow Options', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->start_controls_tabs( 'accordion_shadow_style' );
		$this->start_controls_tab(
			'accordion_shadow_normal',
			array(
				'label'     => esc_html__( 'Normal', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_box_shadow',
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_shadow_active',
			array(
				'label'     => esc_html__( 'Active', 'theplus' ),
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'accordion_box_active_shadow',
				'selector'  => '{{WRAPPER}} .theplus-tabs-wrapper.mobile-accordion .elementor-tab-mobile-title.active',
				'condition' => array(
					'tab_nav_responsive' => 'tab_accordion',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'fat_tablet',
			array(
				'label'     => esc_html__( 'First Tab Active in Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
				'condition' => array(
					'default_active_tab' => 'all-open',
				),
			)
		);
		$this->add_control(
			'fat_mobile',
			array(
				'label'     => esc_html__( 'First Tab Active in Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'default_active_tab' => 'all-open',
				),
			)
		);

		$this->add_control(
			'fat_close_tablet',
			array(
				'label'     => esc_html__( 'Force All Close in Tablet', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
				'condition' => array(
					'default_active_tab!' => 'all-open',
				),
			)
		);
		$this->add_control(
			'fat_close_mobile',
			array(
				'label'     => esc_html__( 'Force All Close in Mobile', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'condition' => array(
					'default_active_tab!' => 'all-open',
				),
			)
		);

		$this->add_control(
			'description_field_show',
			array(
				'label'     => esc_html__( 'Description Field Show on Active Tab', 'theplus' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__( 'Enable', 'theplus' ),
				'label_off' => esc_html__( 'Disable', 'theplus' ),
				'separator' => 'before',
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
	 * Render Tabs And Tours.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$templates = Theplus_Element_Load::elementor()->templates_manager->get_source( 'local' )->get_items();

		$tabs   = $this->get_settings_for_display( 'tabs' );
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$nav_align = ! empty( $settings['nav_align'] ) ? $settings['nav_align'] : 'text-lefts';
		$full_icon = 'yes' === $settings['full_icon'] ? 'full-width-icon' : '';
		$tabs_type = ! empty( $settings['tabs_type'] ) ? $settings['tabs_type'] : 'horizontal';
		$tabs_mode = ! empty( $settings['tabs_mode'] ) ? $settings['tabs_mode'] : 'horizontal';

		$nav_full_width = ! empty( $settings['nav_full_width'] ) ? $settings['nav_full_width'] : 'no';
		$nav_full_width = 'yes' === $nav_full_width ? 'full-width' : '';
		$nav_underline  = ! empty( $settings['tab_title_underline_display'] ) ? $settings['tab_title_underline_display'] : 'no';
		$nav_underline  = 'yes' === $nav_underline ? 'nav-tab-underline' : '';

		$tabs_align_class = '';
		$tabs_arrow_class = '';
		$on_tabs_arrow    = isset( $settings['on_tabs_arrow'] ) ? $settings['on_tabs_arrow'] : '';

		$nav_vertical_align    = ! empty( $settings['nav_vertical_align'] ) ? $settings['nav_vertical_align'] : 'align-top';
		$tabs_align_vertical   = ! empty( $settings['tabs_align_vertical'] ) ? $settings['tabs_align_vertical'] : 'left';
		$tabs_align_horizontal = ! empty( $settings['tabs_align_horizontal'] ) ? $settings['tabs_align_horizontal'] : 'top';

		$descactive = '';
		if ( isset( $settings['description_field_show'] ) && 'yes' === $settings['description_field_show'] ) {
			$descactive = ' tp-desc-on-active';
		}

		/** Arrow*/
		if ( ! empty( $tabs_type ) && 'yes' === $on_tabs_arrow ) {
			$tabs_arrow_class .= ' tp-tab-arrow-show';

			if ( isset( $settings['on_tabs_arrow_type'] ) && 'in' === $settings['on_tabs_arrow_type'] ) {
				$tabs_arrow_class .= ' tp-tab-arrow-in';
			}
			if ( 'horizontal' === $tabs_type ) {
				$tabs_align_class = ' tpc-' . esc_attr( $tabs_align_horizontal ) . ' tpc-' . esc_attr( $tabs_type );
			} elseif ( 'vertical' === $tabs_type ) {
				$tabs_align_class = ' tpc-' . esc_attr( $tabs_align_vertical ) . ' tpc-' . esc_attr( $tabs_type );
			}
		}

		$uid = uniqid( 'tabs' );

		/** Connection*/
		$connect_carousel = '';
		$row_bg_conn      = '';

		$con_uni_id = ! empty( $settings['connection_unique_id'] ) ? $settings['connection_unique_id'] : 'top';
		if ( ! empty( $settings['connection_unique_id'] ) ) {
			$connect_carousel = 'tpca_' . esc_attr( $con_uni_id );
			$uid              = 'tptab_' . esc_attr( $con_uni_id );
			$row_bg_conn      = ' data-row-bg-conn="bgcarousel' . esc_attr( $con_uni_id ) . '"';
		}

		/*--Plus Extra ---*/
		$PlusExtra_Class = '';
		include THEPLUS_PATH . 'modules/widgets/theplus-widgets-extra.php';
		/*--Plus Extra ---*/

		/*--On Scroll View Animation ---*/
		include THEPLUS_PATH . 'modules/widgets/theplus-widget-animation-attr.php';

		/** Outer icon disable on mobile*/
		$res_outer_class = '';
		if ( ! empty( $settings['res_outer_icon'] ) && 'yes' === $settings['res_outer_icon'] ) {
			$res_outer_class = 'hide_mobile_sep_icon';
		}

		$swiper_container = '';

		$swiper_slide = '';
		$swiper_wrap  = '';

		$tabs_swiper = ! empty( $settings['tabs_swiper'] ) ? $settings['tabs_swiper'] : 'no';
		if ( 'yes' === $tabs_swiper && 'horizontal' === $tabs_type ) {
			if ( 'slide' === $tabs_mode ) {
				$swiper_container = '';

				$swiper_wrap  = '';
				$swiper_slide = '';
			} else {
				$swiper_container = 'swiper-container swiper-free-mode';
				$swiper_wrap      = 'swiper-wrapper';
				$swiper_slide     = 'swiper-slide swiper-slide-active';
			}
		}

		$swiper_wrap_mode      = '';
		$swiper_slide_mode     = '';
		$swiper_container_mode = '';
		if ( 'yes' === $tabs_swiper && 'horizontal' === $tabs_type ) {
			if ( 'slide' === $tabs_mode ) {
				$swiper_wrap_mode      = ' swiper-wrapper';
				$swiper_container_mode = ' swiper-container tp-swiper-slide-mode';
				$swiper_slide_mode     = 'swiper-slide';
			}
		}

			$tab_nav = '<div class="theplus-tabs-nav-wrapper elementor-tabs-wrapper ' . esc_attr( $nav_align ) . ' ' . esc_attr( $nav_vertical_align ) . ' ' . esc_attr( $swiper_wrap ) . ' ' . esc_attr( $tabs_align_class ) . ' ' . esc_attr( $swiper_container_mode ) . '">';
				$lz2 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['nav_bg_box_background_image'] ) : '';

				$tab_nav .= '<ul class="plus-tabs-nav ' . $lz2 . ' ' . esc_attr( $nav_underline ) . ' ' . esc_attr( $nav_full_width ) . ' ' . esc_attr( $full_icon ) . ' ' . esc_attr( $swiper_slide ) . ' ' . esc_attr( $swiper_wrap_mode ) . '">';

		foreach ( $tabs as $index => $item ) {
			$tab_count = $index + 1;

			if ( ! empty( $item['tab_hashid'] ) ) {
				$tab_title_id   = trim( $item['tab_hashid'] );
				$tab_content_id = 'tab-content-' . trim( $item['tab_hashid'] );
			} else {
				$tab_title_id   = 'elementor-tab-title-' . esc_attr( $id_int ) . esc_attr( $tab_count );
				$tab_content_id = 'elementor-tab-content-' . esc_attr( $id_int ) . esc_attr( $tab_count );
			}

			$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

			$lz1 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['nav_box_background_image'], $settings['nav_box_active_background_image'] ) : '';
			$this->add_render_attribute(
				$tab_title_setting_key,
				array(
					'id'            => $tab_title_id,
					'class'         => array( 'elementor-tab-title', 'elementor-tab-desktop-title', 'plus-tab-header', $lz1 ),
					'data-tab'      => $tab_count,
					'tabindex'      => $id_int . $tab_count,
					'role'          => 'tab',
					'aria-controls' => $tab_content_id,
				)
			);

			if ( ! empty( $item['tab_title'] ) || ( ! empty( $item['display_icon'] ) && 'yes' === $item['display_icon'] ) ) {
				$tab_nav  .= '<li class="' . esc_attr( $swiper_slide_mode ) . '">';
				$tab_nav  .= '<div ' . $this->get_render_attribute_string( $tab_title_setting_key ) . '>';
				$image_alt = '';
				if ( 'yes' === $item['display_icon'] ) :
					$icons      = '';
					$icon_image = '';
					if ( 'font_awesome' === $item['icon_style'] ) {
						$icons = $item['icon_fontawesome'];
					} elseif ( 'font_awesome_5' === $item['icon_style'] ) {
						ob_start();
						\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
						$icons = ob_get_contents();
						ob_end_clean();
					} elseif ( 'icon_mind' === $item['icon_style'] ) {
						$icons = $item['icons_mind'];
					} elseif ( 'image' === $item['icon_style'] && ! empty( $item['icon_image']['url'] ) ) {
						$icon_image_id = $item['icon_image']['id'];
						$icon_image    = tp_get_image_rander( $icon_image_id, $item['icon_image_thumbnail_size'], array( 'class' => 'tab-icon tab-icon-image' ) );
					}

					if ( ! empty( $icons ) || ! empty( $icon_image ) ) {
						$tab_nav .= '<span class="tab-icon-wrap" aria-hidden="true">';
						if ( 'image' !== $item['icon_style'] ) {
							if ( 'font_awesome_5' === $item['icon_style'] ) {
								$tab_nav .= '<span>' . $icons . '</span>';
							} else {
								$tab_nav .= '<i class="tab-icon ' . esc_attr( $icons ) . '"></i>';
							}
						} else {
							$tab_nav .= $icon_image;
						}
						$tab_nav .= '</span>';
					}
				endif;

				if ( 'yes' === $settings['nav_title_display'] ) {
					$tab_nav .= '<span>' . wp_kses_post( $item['tab_title'] ) . '</span>';
				}

				if ( ! empty( $item['tab_title_description'] ) ) {
					$tab_nav .= '<div class="tp-tab-title-description">' . wp_kses_post( $item['tab_title_description'] ) . '</div>';
				}

				if ( ! empty( $item['tab_title_hint'] ) ) {
					$tab_nav .= '<span class="tp-tab-title-hint">' . wp_kses_post( $item['tab_title_hint'] ) . '</span>';
				}

				$tab_nav .= '</div>';

				$outicons = '';
				if ( ! empty( $item['display_icon1'] ) && 'yes' === $item['display_icon1'] && ! empty( $item['icon_fontawesome_type'] ) && 'font_awesome_5' === $item['icon_fontawesome_type'] && ! empty( $item['icon_fontawesome1_5'] ) ) {
					ob_start();
					\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome1_5'], array( 'aria-hidden' => 'true' ) );
					$outicons = ob_get_contents();
					ob_end_clean();
					$tab_nav .= '<div class="tab-sep-icon ' . esc_attr( $res_outer_class ) . '"><span class="tab-between-icon ">' . $outicons . '</span></div>';
				} elseif ( ! empty( $item['display_icon1'] ) && 'yes' === $item['display_icon1'] && ! empty( $item['icon_fontawesome1'] ) ) {
					$tab_nav .= '<div class="tab-sep-icon ' . esc_attr( $res_outer_class ) . '"><i class="tab-between-icon ' . esc_attr( $item['icon_fontawesome1'] ) . '"></i></div>';
				}

				$tab_nav .= '</li>';
			}
		}

		$tab_nav .= '</ul>';

		if ( 'yes' === $tabs_swiper && 'horizontal' === $tabs_type ) {
			$swiper_nxt_icon  = '';
			$swiper_prev_icon = '';
			if ( 'slide' === $tabs_mode && ( isset( $settings['swiper_centermode'] ) && 'yes' !== $settings['swiper_centermode'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['swiper_next_icon'], array( 'aria-hidden' => 'true' ) );
				$swiper_nxt_icon = ob_get_contents();
				ob_end_clean();

				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['swiper_prev_icon'], array( 'aria-hidden' => 'true' ) );
				$swiper_prev_icon = ob_get_contents();
				ob_end_clean();

				$tab_nav .= '<div class="tp-swiper-button tp-swiper-button-next">' . $swiper_nxt_icon . '</div><div class="tp-swiper-button tp-swiper-button-prev">' . $swiper_prev_icon . '</div>';
			}
		}

		$tab_nav .= '</div>';

		$lz3 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['content_box_background_image'] ) : '';

		$tab_content = '<div class="theplus-tabs-content-wrapper ' . $lz3 . ' elementor-tabs-content-wrapper">';

		foreach ( $tabs as $index => $item ) {
			$tab_count = $index + 1;

			$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

			$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

			$this->add_render_attribute(
				$tab_content_setting_key,
				array(
					'class'    => array( 'elementor-tab-content', 'elementor-clearfix', 'plus-tab-content' ),
					'data-tab' => $tab_count,
					'role'     => 'tabpanel',
				)
			);

			$lz4 = function_exists( 'tp_has_lazyload' ) ? tp_bg_lazyLoad( $settings['accordion_box_background_image'], $settings['accordion_box_active_background_image'] ) : '';
			$this->add_render_attribute(
				$tab_title_mobile_setting_key,
				array(
					'class'    => array( 'elementor-tab-title', 'elementor-tab-mobile-title', $nav_align, $lz4 ),
					'tabindex' => $id_int . $tab_count,
					'data-tab' => $tab_count,
					'role'     => 'tab',
				)
			);

			$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );

			$tab_content .= '<div ' . $this->get_render_attribute_string( $tab_title_mobile_setting_key ) . '>';
			$image_alt    = '';

			if ( 'yes' === $item['display_icon'] ) {
				$icons      = '';
				$icon_image = '';
				$IconStyle  = ! empty( $item['icon_style'] ) ? $item['icon_style'] : '';

				if ( 'font_awesome' === $IconStyle ) {
					$icons = $item['icon_fontawesome'];
				} elseif ( 'font_awesome_5' === $IconStyle ) {
					ob_start();
						\Elementor\Icons_Manager::render_icon( $item['icon_fontawesome_5'], array( 'aria-hidden' => 'true' ) );
						$icons = ob_get_contents();
					ob_end_clean();
				} elseif ( 'icon_mind' === $IconStyle ) {
					$icons = $item['icons_mind'];
				} elseif ( 'image' === $IconStyle && ! empty( $item['icon_image']['url'] ) ) {
					$icon_image_id = $item['icon_image']['id'];
					$icon_image    = tp_get_image_rander( $icon_image_id, $item['icon_image_thumbnail_size'], array( 'class' => 'tab-icon tab-icon-image' ) );
				}

				if ( ! empty( $icons ) || ! empty( $icon_image ) ) {
					$tab_content .= '<span class="tab-icon-wrap" aria-hidden="true">';
					if ( 'image' !== $item['icon_style'] ) {
						if ( 'font_awesome_5' === $IconStyle ) {
							$tab_content .= $icons;
						} else {
							$tab_content .= '<i class="tab-icon ' . esc_attr( $icons ) . '"></i>';
						}
					} else {
						$tab_content .= $icon_image;
					}

					$tab_content .= '</span>';
				}
			}

			$tab_content .= '<span>' . wp_kses_post( $item['tab_title'] ) . '</span>';

			if ( ! empty( $item['tab_title_description'] ) ) {
				$tab_content .= '<div class="tp-tab-title-description">' . wp_kses_post( $item['tab_title_description'] ) . '</div>';
			}

			if ( ! empty( $item['tab_title_hint'] ) ) {
				$tab_content .= '<span class="tp-tab-title-hint">' . wp_kses_post( $item['tab_title_hint'] ) . '</span>';
			}

			$tab_content .= '</div>';
			$tab_content .= '<div ' . $this->get_render_attribute_string( $tab_content_setting_key ) . '>';

			if ( 'content' === $item['content_source'] && ! empty( $item['tab_content'] ) ) {
				$tab_content .= '<div class="plus-content-editor">' . $this->parse_text_editor( $item['tab_content'] ) . '</div>';
			}

			if ( ( ! empty( $item['content_source'] ) && 'page_template' === $item['content_source'] ) && ( ! empty( $item['content_template_type'] ) && 'manually' === $item['content_template_type'] ) && ! empty( $item['content_template_id'] ) ) {
				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'page_template' === $item['content_source'] && ! empty( $item['content_template_id'] ) ) {
					if ( ! empty( $item['backend_preview_template'] ) && 'yes' === $item['backend_preview_template'] ) {
						$tab_content .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $item['content_template_id'], 24, -2 ) ) . '</div>';
					} else {
						$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">Selected Template : <b>"' . esc_attr( $item['content_template_id'] ) . '"</b></div><div class="preview-temp-notice-desc"><b>Note :</b> We have turn off visibility of template in the backend due to performance improvements. This will be visible perfectly on the frontend.</div></div>';
					}
				} elseif ( 'page_template' === $item['content_source'] && ! empty( $item['content_template_id'] ) ) {

					$tab_content .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( substr( $item['content_template_id'], 24, -2 ) ) . '</div>';
				}
			} elseif ( \Elementor\Plugin::$instance->editor->is_edit_mode() && 'page_template' === $item['content_source'] && ! empty( $item['content_template'] ) ) {
				if ( ! empty( $item['backend_preview_template'] ) && 'yes' === $item['backend_preview_template'] ) {
					$tab_content .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['content_template'] ) . '</div>';
				} else {
					$get_template_name = '';
					$get_template_id   = $item['content_template'];
					if ( ! empty( $templates ) && ! empty( $get_template_id ) ) {
						foreach ( $templates as $value ) {
							if ( $value['template_id'] === $get_template_id ) {
								$get_template_name = $value['title'];
							}
						}
					}

					$tab_content .= '<div class="tab-preview-template-notice"><div class="preview-temp-notice-heading">Selected Template : <b>"' . esc_attr( $get_template_name ) . '"</b></div><div class="preview-temp-notice-desc"><b>Note :</b> We have turn off visibility of template in the backend due to performance improvements. This will be visible perfectly on the frontend.</div></div>';
				}
			} elseif ( 'page_template' === $item['content_source'] && ! empty( $item['content_template'] ) ) {

				$tab_content .= '<div class="plus-content-editor">' . Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['content_template'] ) . '</div>';
			}

				$tab_content .= '</div>';

		}

			$tab_content .= '</div>';

		$default_active = '';
		if ( ! empty( $settings['default_active_tab'] ) && 'all-open' !== $settings['default_active_tab'] ) {
			$default_active .= ' data-tab-default="' . ( $settings['default_active_tab'] - 1 ) . '"';

			if ( isset( $settings['fat_close_tablet'] ) && 'yes' === $settings['fat_close_tablet'] ) {
				$default_active .= ' data-tab-closeforce-tablet="1"';
			}

			if ( isset( $settings['fat_close_mobile'] ) && 'yes' === $settings['fat_close_mobile'] ) {
				$default_active .= ' data-tab-closeforce-mobile="1"';
			}
		} elseif ( ! empty( $settings['default_active_tab'] ) && 'all-open' === $settings['default_active_tab'] ) {
			$default_active .= ' data-tab-default="-1"';

			if ( isset( $settings['fat_tablet'] ) && 'yes' === $settings['fat_tablet'] ) {
				$default_active .= ' data-tab-tabletmode="1"';
			}

			if ( isset( $settings['fat_mobile'] ) && 'yes' === $settings['fat_mobile'] ) {
				$default_active .= ' data-tab-mobilemode="1"';
			}
		} else {
			$default_active .= ' data-tab-default="0"';
		}

		if ( ! empty( $settings['second_click_close'] ) ) {
			$default_active .= ' data-tab-second="true"';
		}

		if ( ! empty( 'yes' === $settings['on_hover_tabs'] ) ) {
			$default_active .= ' data-tab-hover="yes"';
		} else {
			$default_active .= ' data-tab-hover="no"';
		}

		$tabAutoPlayClass = '';
		if ( isset( $settings['tabs_autoplay'] ) && 'yes' === $settings['tabs_autoplay'] ) {
			$tabs_autoplay_duration = ! empty( $settings['tabs_autoplay_duration'] ) ? $settings['tabs_autoplay_duration'] : 5;
			$tabAutoPlayClass      .= ' tp-tab-playloop';

			if ( isset( $settings['tabs_autoplaypause'] ) && 'yes' === $settings['tabs_autoplaypause'] ) {
				$tabAutoPlayClass .= ' tp-tab-playpause-button';
			}

			$default_active .= ' data-tab-autoplay="yes"';
			$default_active .= ' data-tab-autoplay-duration="' . esc_attr( $tabs_autoplay_duration ) . '"';
		}

		$scenterclass = '';
		if ( 'yes' === $tabs_swiper && 'horizontal' === $tabs_type ) {
			$default_active .= isset( $settings['swiper_loop'] ) ? "data-swiper-loop ='" . esc_attr( $settings['swiper_loop'] ) . "'" : 'no';

			if ( 'slide' === $tabs_mode ) {
				$default_active .= isset( $settings['swiper_centermode'] ) ? "data-swiper-centermode ='" . ( $settings['swiper_centermode'] ) . "'" : 'no';
				$scenterclass    = ' tp-swiper-center-mode';
			}
		}

		$responsive_class = '';
		if ( 'nav_full' === $settings['tab_nav_responsive'] ) {
			$responsive_class = 'nav-full-width';
		} elseif ( 'nav_one' === $settings['tab_nav_responsive'] ) {
			$responsive_class = 'nav-one-by-one';
		} elseif ( 'tab_accordion' === $settings['tab_nav_responsive'] ) {
			$responsive_class = 'mobile-accordion';
		}

		$output = '<div class="theplus-tabs-wrapper ' . esc_html( $tabs_arrow_class ) . ' elementor-tabs ' . esc_attr( $animated_class ) . ' ' . esc_attr( $responsive_class ) . ' ' . esc_attr( $swiper_container ) . ' ' . esc_attr( $scenterclass ) . ' ' . esc_attr( $tabAutoPlayClass ) . ' ' . esc_attr( $descactive ) . '" id="' . esc_attr( $uid ) . '" data-tabs-id="' . esc_attr( $uid ) . '"  data-connection="' . esc_attr( $connect_carousel ) . '" ' . $row_bg_conn . ' ' . $default_active . ' ' . $animation_attr . ' role="tablist">';

		if ( 'horizontal' === $tabs_type ) {
			if ( 'top' === $settings['tabs_align_horizontal'] ) {
				$output .= $tab_nav . $tab_content;
			}
			if ( 'bottom' === $settings['tabs_align_horizontal'] ) {
				$output .= $tab_content . $tab_nav;
			}
		}

		if ( 'vertical' === $tabs_type ) {
			if ( 'left' === $settings['tabs_align_vertical'] ) {
				$output .= $tab_nav . $tab_content;
			}
			if ( 'right' === $settings['tabs_align_vertical'] ) {
				$output .= $tab_content . $tab_nav;
			}
		}

		/*playpausebutton*/
		if ( isset( $settings['tabs_autoplay'] ) && 'yes' === $settings['tabs_autoplay'] && isset( $settings['tabs_autoplaypause'] ) && 'yes' === $settings['tabs_autoplaypause'] ) {
			$iconsPlay  = '';
			$iconsPause = '';
			if ( ! empty( $settings['autopauseicon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['autopauseicon'], array( 'aria-hidden' => 'true' ) );
				$iconsPlay = ob_get_contents();
				ob_end_clean();
			}
			if ( ! empty( $settings['autoplayicon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['autoplayicon'], array( 'aria-hidden' => 'true' ) );
				$iconsPause = ob_get_contents();
				ob_end_clean();
			}

			$output .= '<div class="tp-tab-play-pause-wrap"><div class="tp-tab-play-pause tpplay active">' . $iconsPlay . '</div><div class="tp-tab-play-pause tppause">' . $iconsPause . '</div></div>';
		}

		$output .= '</div>';
		echo $before_content . $output . $after_content;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {
	}
}
